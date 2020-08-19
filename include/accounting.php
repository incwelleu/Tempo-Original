<?php
// Configuration Accounting
define('GLOBAL_DIGIT_ACCOUNT', 8);
define('GLOBAL_REGIME_FISCAL', 1);
define('GLOBAL_ACCOUNT_CLIENT', '43000000');
define('GLOBAL_ACCOUNT_SALE', '70500000');
define('GLOBAL_ACCOUNT_CLIENT_WITHHOLDING', '47300000');
define('GLOBAL_ACCOUNT_PAYROLL_WITHHOLDING', '47510001');
define('GLOBAL_ACCOUNT_PROFESSIONAL_WITHHOLDING', '47510002');
define('GLOBAL_ACCOUNT_RENTAL_WITHHOLDING', '47300003');
define('GLOBAL_ACCOUNT_PROVIDER', '40000000');
define('GLOBAL_ACCOUNT_BANK', '57200000');
define('GLOBAL_OUTPUT_TAX', 1);
define('GLOBAL_INPUT_TAX', 2);
define('GLOBAL_ACCOUNT_OTHER_INCOME', '75900000');
define('GLOBAL_PROFESSIONAL_WITHHOLDING', 15.00);
define('GLOBAL_PROFESSIONAL_WITHHOLDING_BEGINING', 7.00);

/* Si el tipo de Operacion son
	C => Deducible en adquisiciones intracomunitarias de bienes
  Z => Deducible en adquisiciones intracomunitarias de servicios
  P => Deducible por inversión del sujeto pasivo
  J => Deducible No Sujeto
  K => No Deducible
*/
$GLOBAL_SPECIAL_ACCOUNT_VAT = array("C", "Z", "P", "K");

$GLOBAL_INVOICE_ACCOUNTING = Array("invoice_dt"=>"",
                                   "invoice_number"=>"",
                                   "concept"=>"",
                                   "account_cd"=>"",
																	 "account_name"=>"",
                                   "counterpart"=>"",
                                   "active_amt"=>"",
                                   "pasive_amt"=>"",
                                   "base_amt"=>"",
                                   "rate_no"=>"",
                                   "document_ident"=>"",
                                   "withholding"=>"",
																	 "overhead_rate_no"=>"",
																	 "overhead_amt"=>"");

$GLOBAL_TAX_ACCOUNT = Array( // Regimen Spain
														 1 => Array (
                             				Array( tax_type_key_id => 1, rate_no => 4, account_cd => '477.4'),
                             				Array( tax_type_key_id => 1, rate_no => 8, account_cd => '477.8'),
                             				Array( tax_type_key_id => 1, rate_no => 10, account_cd => '477.10'),
                             				Array( tax_type_key_id => 1, rate_no => 18, account_cd => '477.18'),
                             				Array( tax_type_key_id => 1, rate_no => 21, account_cd => '477.21'),
                             				Array( tax_type_key_id => 2, rate_no => 21, account_cd => '47702.21'), //ADQ INTRA BIENES
                             				Array( tax_type_key_id => 3, rate_no => 21, account_cd => '47701.21'), //ADQ INTRA SERVICI
                             				Array( tax_type_key_id => 4, rate_no => 0, account_cd => '47707.'), // ENTREGA INTRA EXENTA BIENES
                             				Array( tax_type_key_id => 5, rate_no => 0, account_cd => '47706.'), // ENTREGA INTRA EXENTA SERVICIO
                             				Array( tax_type_key_id => 6, rate_no => 0, account_cd => '47705.0'), //EXPORTACIONES
                             				Array( tax_type_key_id => 7, rate_no => 21, account_cd => '47703.21'), //ISP
                             				Array( tax_type_key_id => 8, rate_no => 0, account_cd => '47704.'), // DEVENGADO NO SUJETO
                             				Array( tax_type_key_id => 9, rate_no => 4, account_cd => '472.4'),
                             				Array( tax_type_key_id => 9, rate_no => 8, account_cd => '472.8'),
                             				Array( tax_type_key_id => 9, rate_no => 10, account_cd => '472.10'),
                             				Array( tax_type_key_id => 9, rate_no => 18, account_cd => '472.18'),
                             				Array( tax_type_key_id => 9, rate_no => 21, account_cd => '472.21'),
                             				Array( tax_type_key_id => 10, rate_no => 10, account_cd => '47205.10'), //IMPORTACIONES
                             				Array( tax_type_key_id => 10, rate_no => 21, account_cd => '47205.21'), //IMPORTACIONES
                             				Array( tax_type_key_id => 11, rate_no => 21, account_cd => '47202.21'), //ADQ INTRA BIENES
                             				Array( tax_type_key_id => 12, rate_no => 21, account_cd => '47201.21'), //ADQ INTRA SERVICI
                             				Array( tax_type_key_id => 13, rate_no => 21, account_cd => '47203.21'), //ISP
                             				Array( tax_type_key_id => 14, rate_no => 0, account_cd => '47204.'), // DEDUCIBLE NO SUJETO
                             				Array( tax_type_key_id => 16, rate_no => 21, account_cd => '47206.21'), // NO DEDUCIBLE AL 21%
                             				Array( tax_type_key_id => 16, rate_no => 10, account_cd => '47206.10') // NO DEDUCIBLE AL 21%
                                    		),
                             // Regimen Canario
														 2 => Array (
                             				Array( tax_type_key_id => 1, rate_no => 2, account_cd => '4777.2'),
                             				Array( tax_type_key_id => 1, rate_no => 3, account_cd => '4777.3'),
                             				Array( tax_type_key_id => 1, rate_no => 5, account_cd => '4777.5'),
                             				Array( tax_type_key_id => 1, rate_no => 7, account_cd => '4777.7'),
                             				Array( tax_type_key_id => 1, rate_no => 13.5, account_cd => '4777.13'),
                             				Array( tax_type_key_id => 6, rate_no => 0, account_cd => '47775.0'), //EXPORTACIONES
                             				Array( tax_type_key_id => 7, rate_no => 7, account_cd => '47773.7'), //ISP
                             				Array( tax_type_key_id => 8, rate_no => 0, account_cd => '47774.'), // DEVENGADO NO SUJETO
                             				Array( tax_type_key_id => 9, rate_no => 2, account_cd => '4727.2'),
                             				Array( tax_type_key_id => 9, rate_no => 3, account_cd => '4727.3'),
                             				Array( tax_type_key_id => 9, rate_no => 5, account_cd => '4727.5'),
                             				Array( tax_type_key_id => 9, rate_no => 7, account_cd => '4727.7'),
                             				Array( tax_type_key_id => 9, rate_no => 13.5, account_cd => '4727.135'),
                             				Array( tax_type_key_id => 10, rate_no => 3, account_cd => '47275.3'), //IMPORTACIONES
                             				Array( tax_type_key_id => 10, rate_no => 7, account_cd => '47275.7'), //IMPORTACIONES
                             				Array( tax_type_key_id => 13, rate_no => 7, account_cd => '47273.7'), //ISP
                             				Array( tax_type_key_id => 14, rate_no => 0, account_cd => '47274.'), // DEDUCIBLE NO SUJETO
                             				Array( tax_type_key_id => 16, rate_no => 7, account_cd => '47276.7'), // NO DEDUCIBLE AL 7%
                             				Array( tax_type_key_id => 16, rate_no => 3, account_cd => '47276.3') // NO DEDUCIBLE AL 3%
                                    		)
													 );

function sw_check_account($account_code, $lenght)
{
  if ($pr = stripos($account_code, '.')) {
    $account_code = trim($account_code);
    $prr = strrpos($account_code, '.');
    $account_home = substr($account_code, 0, stripos($account_code, '.'));
    $account_end = substr($account_code, strrpos($account_code, '.')+1);
    $zero = ABS($lenght - (strlen($account_home) + strlen($account_end)));
    $account_code = $account_home . str_repeat("0", $zero) . $account_end;
  }

  return $account_code;
}


function sw_create_account($company_id, $table, $prefix, $lenght, $where)
{
  Global $connectionDB;

  $sql = "SELECT account_cd FROM {$table} " .
         "WHERE company_id = {$company_id} AND trim(account_cd) != '' AND MID(account_cd, 1, 3) = '{$prefix}'" .
         "ORDER BY account_cd desc";
  $query = New Query();
  $query->Database = $connectionDB->DbConnection;
  $query->SQL = $sql;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->Prepare();
  $query->Open();

  $record['account_cd'] = sw_check_account($prefix . ".1", $lenght);
  if (!$query->EOF) {
    $record['account_cd'] = (int) $query->Fields['account_cd'];
    ++$record['account_cd'];
  }

  //update account_cd
  sw_update_table($table, $record, $where);

  return $record['account_cd'];
}


function sw_get_company_accounting($company_id)
{
  Global $connectionDB;

  $result = array();
  $sql = "SELECT company.country_id, company.tax_regime_id, company_accounting.*
          FROM company LEFT JOIN company_accounting ON company.company_id = company_accounting.company_id
          WHERE company.company_id = {$company_id}";
  if (sw_valid_sql($sql)) {
    $query = New Query();
    $query->Database = $connectionDB->DbConnection;
    $query->SQL = $sql;
    $query->LimitStart = -1;
    $query->LimitCount = -1;
    $query->Prepare();
    $query->Open();
    $result = $query->fieldbuffer;
  }

  return $result;
}


function sw_get_tax_rate($tax_rate_no)
{
  Global $connectionDB;

  $result = array();
  $sql = "SELECT * FROM tax_rate
          WHERE (tax_rate.rate_no = {$tax_rate_no}) AND (tax_regime_id = {$_SESSION['tax_regime_id']})";

  if (sw_valid_sql($sql)) {
    $query = New Query();
    $query->Database = $connectionDB->DbConnection;
    $query->SQL = $sql;
    $query->LimitStart = -1;
    $query->LimitCount = -1;
    $query->open();
    $result = $query->fieldbuffer;
  }

  return $result;
}


function sw_insert_company_tax($company_id)
{
  Global $connectionDB;

  $sql = "INSERT INTO company_tax(company_id, tax_rate_id, " .
          "account_paid, account_paid_taxable_person, account_paid_within_europe, account_paid_outside_europe, account_paid_adqusicion_good, " .
          "account_received, account_received_within_europe, account_received_outside_europe, account_received_adqusicion_good) " .
          "SELECT company.company_id, tax_rate.tax_rate_id, " .
          "tax_rate.account_paid, tax_rate.account_paid_taxable_person, tax_rate.account_paid_within_europe, tax_rate.account_paid_outside_europe, tax_rate.account_paid_adqusicion_good, " .
	        "tax_rate.account_received, tax_rate.account_received_within_europe, tax_rate.account_received_outside_europe, tax_rate.account_received_adqusicion_good " .
          "FROM company INNER JOIN tax_regime ON company.country_id = tax_regime.country_id " .
          "INNER JOIN tax_rate ON tax_regime.tax_regime_id = tax_rate.tax_regime_id " .
	        "LEFT JOIN company_tax ON company.company_id = company_tax.company_id AND " .
          "tax_rate.tax_rate_id = company_tax.tax_rate_id " .
          "WHERE company_tax.tax_rate_id is null AND company.company_id = " . $company_id;

  //Insert record
  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
}


function sw_get_account_expense($record, $digit_account = 8)
{
  $expense_account = '';
  $account_expense_provedor_yn = (strlen(trim($record['account_expense_cd'])) != 0);
  if ($record['expense_type_provider_id'] == $record['expense_type_id'] && $account_expense_provedor_yn){
    $expense_account = $record['account_expense_cd'];
  }
  else {
    $expense_type_id = $record['expense_type_id'] ? $record['expense_type_id'] : $record['expense_type_provider_id'];
    $record = sw_get_data_table("expense_type", "expense_type_id = {$expense_type_id}", "account_expense_cd");
    $expense_account = $record['account_expense_cd'];
  }

  return ($expense_account = sw_check_account($expense_account, $digit_account));
}



function sw_quarter_date($date = null)
{
  $date = is_null($date) ? date() : $date;
  $date = explode('-', $date);
  $month = $date[1];

  $quarter = floor(($month-1) / 3)+1;

  return $quarter;
}


function sw_assign_registered_accountant(&$record, $registered_dt = "")
{
  $record['registered_in_acctg_software_dt'] = $registered_dt ? $registered_dt : sw_get_accountant_period_closed();
  $invoice_date = explode('-', $record['invoice_dt']);
  $registration_dt = explode('-', $record['registered_in_acctg_software_dt']);
  //Verify date, if quarter is diferent
  if ($record['invoice_dt'] >= $record['registered_in_acctg_software_dt']) { //&&
    $record['registered_in_acctg_software_dt'] = $record['invoice_dt'];
  }
}


function sw_get_accountant_period_closed()
{
  $record_accountant = sw_get_data_table("company_accounting", "company_id = " . $_SESSION['company_id'], array('accountant_period_last_closed_dt'));

  if ((!$record_accountant['accountant_period_last_closed_dt']) ||
      ($record_accountant['accountant_period_last_closed_dt'] == '0000-00-00')) {
     $record_accountant['accountant_period_last_closed_dt'] = date('Y-m-d');
  }
  else {
    $date = explode("-", $record_accountant['accountant_period_last_closed_dt']);
    $accountant_dt = mktime(0, 0, 0, $date[1], $date[2]+1, $date[0]);
    $record_accountant['accountant_period_last_closed_dt'] = date("Y-m-d", $accountant_dt);
  }

  return $record_accountant['accountant_period_last_closed_dt'];
}



function sw_set_accountant_period_closed($period_last_closed_dt)
{
  $where = "company_id = " . $_SESSION['company_id'];
  $record['accountant_period_last_closed_dt'] = $period_last_closed_dt;
  sw_update_table("company_accounting", $record, $where);
}


function sw_country_tax_ident($tax_ident)
{
  $country_id = 724;

  $sql = "(LOCATE(iso_cd, SUBSTRING('{$tax_ident}',1,2)) > 0)";
  if ($record = sw_get_data_table("country", $sql)){
    $country_id = $record['country_id'];
  }

  return $country_id;
}


function sw_get_last_document_issued($year)
{
	Global $connectionDB;

	$company_id = $_SESSION['company_id'];
	$sql = "SELECT document_ident FROM invoice_issued " .
	"WHERE (YEAR(registered_in_acctg_software_dt) = {$year}) AND (company_id = {$company_id})" .
	"ORDER BY document_ident DESC";

	$query = New Query();
	$query->Database = $connectionDB->DbConnection;
	$query->SQL = $sql;
	$query->LimitStart = 0;
	$query->LimitCount = 1;
	$query->open();

	$document_ident = 0;
	if( ! $query->EOF)
		 $document_ident = $query->Fields['document_ident'];

	return floatval($document_ident);
}


function sw_get_last_document_received($year)
{
	Global $connectionDB;

	$company_id = $_SESSION['company_id'];
	$sql = "SELECT document_ident FROM invoice_received " .
				 "WHERE (YEAR(registered_in_acctg_software_dt) = {$year}) AND (company_id = {$company_id})" .
				 "ORDER BY document_ident DESC";

	$query = New Query();
	$query->Database = $connectionDB->DbConnection;
	$query->SQL = $sql;
	$query->LimitStart = 0;
	$query->LimitCount = 1;
	$query->open();

	$document_ident = 0;
	if (!$query->EOF) $document_ident = $query->Fields['document_ident'];

	return floatval($document_ident);
}

?>