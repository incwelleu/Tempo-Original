<?php
require_once("configure.php");
require_once("dbconnection.php");
require_once("language.php");
require_once("html2pdf/html2pdf.class.php");
require_once('dompdf/dompdf_config.inc.php');
echo "hola";
$company_id = $argv[1];
$invoice_issued_id = $argv[2];
$created_email_draft = $argv[3];
echo $invoice_issued_id;

Global $VirtualFile, $language, $connectionDB, $format_money_mysql;

$sql = "SELECT invoice_issued.*, (invoice_issued.total_amt - invoice_issued.paid_amt) AS pay_amt,
				company.company_name, company.company_id, tax_type_key.tax_law_description,
				invoice_issued_tax.rate_no, tax_regime.tax_label, payment_method.payment_message
		FROM invoice_issued
			INNER JOIN company ON invoice_issued.company_id = company.company_id
			LEFT JOIN tax_type_key ON invoice_issued.tax_type_key_id = tax_type_key.tax_type_key_id
			LEFT JOIN invoice_issued_tax ON invoice_issued.invoice_issued_id = invoice_issued_tax.invoice_issued_id
			LEFT JOIN tax_rate ON invoice_issued_tax.tax_rate_id = tax_rate.tax_rate_id
			LEFT JOIN tax_regime ON tax_rate.tax_regime_id = tax_regime.tax_regime_id
			LEFT JOIN payment_method
				ON invoice_issued.payment_method_id = payment_method.payment_method_id
		WHERE invoice_issued.invoice_issued_id in ({$invoice_issued_id})";
		
$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

if ($num_rows = mysql_num_rows($result) !== 0){
  $fields = mysql_fetch_array($result);
  if ($fields['invoice_issued_id']) {

    $record = sw_get_client_data($fields['company_client_id']);
    $fields['address'] = $record['address'];
    $record_strong = sw_company_client_strong($fields['company_client_id']);
	
	$settings = sw_setting_company($record_strong ? $record_strong['company_id'] : $company_id);

    $fields['biller_address'] = $settings['biller_address'];

    list($year, $month, $day) = explode("-", $fields['invoice_dt']);
    $fields['invoice_dt'] = $day . "-" . $month . "-" . $year;
    $fields['invoice_caption'] = floatval($fields['total_amt']) >= 0 ? SW_CAPTION_INVOICE_NUMBER : SW_CAPTION_CREDIT_NOTE;

    //Payment_method
	if ($fields['pay_amt'] > 0){
      	$fields['payment_message'] = str_replace("{month}", $month, $fields['payment_message']);
      	$fields['payment_message'] = str_replace("{year}", $year, $fields['payment_message']);
	} else {
		$fields['payment_message'] = "";
	}

    $template_invoice = file_get_contents('../html/template_invoice.html');
	
	$sql = "SELECT line_item.*, service.supplement_yn
    		FROM line_item
    			LEFT JOIN (SELECT vw_service.service_id, supplement_yn, vw_service.sort_no FROM vw_service) AS service ON line_item.service_id = service.service_id
       		WHERE invoice_issued_id = {$invoice_issued_id} ORDER BY service.sort_no";

    $result = mysql_query($sql, $connectionDB);
			
	$fmt = new NumberFormatter( $format_money_mysql, NumberFormatter::CURRENCY );

	$fields['line_item'] = '';
    $fields['supplement'] = round($fields['other_income_amt']) != '0' ? '<strong>Suplidos:</strong><br />' : '';
    $fields['line_item_supplement'] = '';
  	While ($line_item = mysql_fetch_array($result)){
		$line_item['quantity_no'] = sw_convert_comma_point($line_item['quantity_no']);
		$line_item['price_amt'] = $fmt->formatCurrency($line_item['price_amt'], "EUR");
		$line_item['total_amt'] = $fmt->formatCurrency($line_item['total_amt'], "EUR");
		if (!$line_item['supplement_yn']){
  			$line = "<tr>
    								<td style='width:60%; height:12px'><div style='text-align: left; margin-left: 15px;'>{$line_item['description']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right;'>{$line_item['quantity_no']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right; margin-right: 15px;'>{$line_item['total_amt']}</div></td>
  									</tr>";
			$fields['line_item'] .= $line;
		} else {
  			$line_supplement = "<tr>
    								<td style='width:50%; height:12px'><div style='text-align: left; margin-left: 15px;'>{$line_item['description']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right; margin-right: 15px;'>{$line_item['total_amt']}</div></td>
  									</tr>";
			$fields['line_item_supplement'] .= $line_supplement;
		}
	}

  	//Totales
	$fields['subtotal_amt'] = $fmt->formatCurrency($fields['subtotal_amt'], "EUR");
	$fields['tax_amt'] = $fmt->formatCurrency($fields['tax_amt'], "EUR");
	$fields['rate_no'] = sw_convert_comma_point($fields['rate_no']);
	$fields['other_income_amt'] = $fmt->formatCurrency($fields['other_income_amt'], "EUR");
	$fields['total_amt_convert'] = $fmt->formatCurrency(currency_converter("EUR", "USD", $fields['total_amt']), "USD");
	$fields['total_amt'] = $fmt->formatCurrency($fields['total_amt'], "EUR");
	$fields['paid_amt'] = $fmt->formatCurrency($fields['paid_amt'], "EUR");
	$fields['pay_amt'] = $fmt->formatCurrency($fields['pay_amt'], "EUR");

    foreach ($fields as $field => $value)
    {
    	$template_invoice = str_replace("{{$field}}", $value, $template_invoice);
    }

    $directory = "../" . $VirtualFile . TMP_INVOICE_STRONG . "/{$year}/{$month}" . substr($year, 2, 2) . "/";
    $filename = "invoice {$year} {$month} {$fields['invoice_number']} " . $record_strong['short_name'] . ".pdf";
    $file_invoice = $directory . $filename;

    if(file_exists($file_invoice)){
	   unlink($file_invoice);
	}
	
  	//Erase PDF file before
//    if (file_exists($fields['link']) && unlink($fields['link']) && $created_email_draft) sw_delete_register_file($fields['link']);

	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "portrait");
	$dompdf->load_html(utf8_decode($template_invoice));
	$dompdf->render();
	$output = $dompdf->output();

    if (file_put_contents( $file_invoice, $output)){
      //Create email draft
//      if ($created_email_draft) sw_register_file($directory, $filename, date('Y-m-d H:i:s'));
    //  sw_update_table("invoice_issued", array("link"=>$file_invoice), "invoice_issued_id = {$invoice_issued_id}");
    }
	unset($dompdf);
}	

}

// Get Address Company Client
function sw_get_client_data($company_client_id = 0)
{
  Global $connectionDB, $language;

  $company_client_id = $company_client_id == "" ? 0 : $company_client_id;

  $sql = "SELECT company_client.*, street_type.description, country.{$language} AS country_name
  				FROM company_client
          		LEFT JOIN street_type ON company_client.address_street_type_id = street_type.street_type_id
              LEFT JOIN country ON company_client.country_id = country.country_id
  				WHERE company_client.company_client_id = {$company_client_id}";
				
  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }

  if ($client_data = mysql_fetch_array($result)) {
  	$client_data['address'] = trim($client_data["description"]);
    $client_data['address'] .= trim($client_data["address_street"]) != "" ? " " . trim($client_data["address_street"]) : "";
    $client_data['address'] .= trim($client_data["address_street_no"]) != "" ? " " . trim($client_data["address_street_no"]) : "";
    $client_data['address'] .= trim($client_data["address_floor"]) != "" ? ", " . trim($client_data["address_floor"]) : "";
    $client_data['address'] .= trim($client_data["address_door"]) != "" ? " " . trim($client_data["address_door"]) : "";
    $client_data['address'] .= trim($client_data["address_city"]) != "" ? ", " . trim($client_data["address_city"]) : "";
    $client_data['address'] .= trim($client_data["postal_cd"]) != "" ? ", " . trim($client_data["postal_cd"]) : "";
    $client_data['address'] .= trim($client_data["address_province"]) != "" ? " " . trim($client_data["address_province"]) : "";
    $client_data['address'] .= trim($client_data["country_name"]) != "" ? " " . trim($client_data["country_name"]) : "";
  }

  return $client_data;
}

//Obtengo los datos de la empresa con el Cliente de la empresa STRONG
function sw_company_client_strong($company_client_id)
{
  //Obtengo el Codigo de cliente en la Empresa de Strong
  $where = "company.company_id = company_join_client.company_id AND company_join_client.company_client_id = {$company_client_id}";
	$record_strong = sw_get_data_table("company, company_join_client", $where);

	return $record_strong;
}

function sw_get_data_table($Table, $where, $fields = "*", $limitStart = -1, $limitCount = -1)
{
  Global $connectionDB;

  $record = array();
  if (is_array($fields)){
    $fields = implode(',', $fields);
  }

  if ($where) $where = " WHERE " . $where;
  $sql = "SELECT {$fields} FROM " . $Table . $where;
  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }
  $record = mysql_fetch_array($result);
  
  return $record;
}


// Get setting of company
function sw_setting_company($company_id)
{
	Global $connectionDB;

	$sql = "SELECT setting.*, billing_entity.company_id
			FROM setting
				INNER JOIN billing_entity ON setting.billing_entity_id = billing_entity.billing_entity_id
				INNER JOIN company ON setting.billing_entity_id = company.billing_entity_id
			WHERE company.company_id = {$company_id}";
	$result = mysql_query($sql, $connectionDB);
	if (!$result) {
		die('Invalid query in template: ' . mysql_error($connectionDB));
	}

	$record = mysql_fetch_array($result);
	if ($record['billing_entity_id']) {
		return $record;
	} else return null;
	
}

function sw_convert_comma_point($number)
{
  if ((strpos($number, ',')>0) && (!strpos($number, '.'))){
    $number = str_replace(',', '.', $number);
  }else {
      $number = str_replace(',', '', $number);
  }
  return number_format($number, 2, '.', '');
//  return $number;
}

function currency_converter($moneda_origen,$moneda_destino,$cantidad) {
	$get = file_get_contents("https://www.google.com/finance/converter?a=$cantidad&from=$moneda_origen&to=$moneda_destino");
	$get = explode("<span class=bld>",$get);
	$get = explode("</span>",$get[1]);
	return preg_replace("/[^0-9\.]/", null, $get[0]);
}

?>