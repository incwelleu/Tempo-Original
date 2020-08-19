<?php
require_once("../include/configure.php");
require_once("../include/dbconnection.php");
require_once("../include/PHPMailer/class.phpmailer.php");

Global $connectionDB, $email_to_cd_template, 
       $email_username, $email_password,
	   $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;


//Settings
$sql = "SELECT * FROM setting";
$result = mysql_query($sql, $connectionDB);
if (!$result) {
  die('Invalid query in template: ' . mysql_error($connectionDB));
}
$setting = mysql_fetch_array($result);

//Template email
$sql = "SELECT * FROM email_template
        WHERE (trigger_file_keyword = 'regular service expiration')";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

$template = mysql_fetch_array($result);

$to_email = $setting['se_billing_email'];
$provider = sw_get_provider_contact($setting['se_billing_email']);
$to_name  = $provider['provider_contact_name'];

echo  "TO: {$to_email} {$to_name} \n";

$date = sw_future_invoice_date(date('Y-m-d'));

$sql = "SELECT DISTINCT company.short_name,
       line_item.description,
       line_item.service_start_dt, line_item.service_end_dt
FROM company
     INNER JOIN line_item ON company.company_id = line_item.company_id
     INNER JOIN service ON line_item.service_id = service.service_id
     INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
     INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
WHERE (line_item.status_cd = 'SV') AND
      (( MONTH(line_item.service_start_dt) = MONTH('{$date}') AND YEAR(line_item.service_start_dt) = YEAR('{$date}') ) OR
       ( MONTH(line_item.service_end_dt) = MONTH('{$date}') AND YEAR(line_item.service_end_dt) = YEAR('{$date}') ))
ORDER BY company.short_name";

echo "SQL: {$sql} \n\n";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}

if ($num_rows = mysql_num_rows($result)){
  $mail = new PHPMailer(false);
  $mail->IsSMTP();
  $mail->IsHTML(true);
  $mail->CharSet = "UTF-8";

  $mail->SMTPAuth = true;     // turn on SMTP authentication
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Host = "smtp.gmail.com";  // specify main and backup server
  $mail->Port = 587;                                    // TCP port to connect to
  $mail->Username = $email_username;   // SMTP username
  $mail->Password = $email_password; // SMTP password

  $mail->DKIM_domain = $email_DKIM_domain;
  $mail->DKIM_private_string = "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAreMFYJeMLakGZmK1h3HYu3jLaVVohJ0kwCgj/GE2c/bjknn/zSrOD3ZV3wWy6EspL/zxd+9SPQvseUofeGvO++FZNA75F2PfTKVW+2aZloPaqEjw9+4c/VveuWfWtALLndCWgj3kUpxyro8PoxBxzCXox+mxGNLAmUoA0tfSWG9Ly+Ca5ANIfNpNRitPxVOHeybsaGRb1Q+cOsHrzyLlNLGLVDi16DE1QfjLOsOreuWjypMrjhOa6D0fVemT81FWnXqIDRALcQPjMysQW8m9JFQSbtth/Wf7GSqdg0fvzBNv8+vt7atG/1wZs7ujyBOG49mM2GhuDMTXA2FmsH27XQIDAQAB";
  $mail->DKIM_copyHeaderFields = false;
  $mail->DKIM_selector = $email_DKIM_selector;
  $mail->DKIM_identity = 'clientarea@incwell.eu';
  
  $mail->SetFrom($setting['se_internal_email'], 'TEMPO');
  $mail->AddBCC('monicar@incwell.eu');


  echo "Cantidad de registros: {$num_rows} \n";
  echo "From: {$setting['se_internal_email']} ('TEMPO') \n";
  $mail->AddBCC($setting['se_internal_email']);
  $mail->Subject = $template['subject'];

  $body = $template['body'];
  $client = "<table width='50%' border='0' cellspacing='0'>
            <tr>
              <td><strong>Short name</strong></td>
	            <td><strong>Services</strong></td>
            </tr>";

  While ($query = mysql_fetch_array($result)){
    $client .="<tr>
	            <td>{$query['short_name']}</td>
	            <td>{$query['description']}</td>
              </tr>";
  }
  $client .="</table>";


  $body = str_replace('{CLIENTS}', $client, $body);
  $mail->Body = $body;
  echo "{$mail->Body} \n";

  $mail->AddAddress($to_email, $to_name);
  if ($mail->Send()) {
    echo "Envío con exito!!!\n";
  }
  else {
    echo "Send Error\n";
  }

  $mail->ClearAddresses();

  unset($mail);
}
else {
  echo "No existe servicios que expiren";
}


function sw_get_provider_contact($search)
{
  Global $connectionDB;

  $sql = "SELECT * FROM vw_provider_contact WHERE (provider_contact_id = '{$search}') OR (email = '{$search}')";
  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }
  $setting = mysql_fetch_array($result);

  return $setting;
}


function sw_future_invoice_date($date)
{
	list($year, $month, $day) = explode("-", $date);
  return date("Y-m-d", mktime(0,0,0,$month+1,1,$year));
}


?>