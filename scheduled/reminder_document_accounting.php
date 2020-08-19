<?php
require_once("../include/configure.php");
require_once("../include/dbconnection.php");
require_once("../include/PHPMailer/class.phpmailer.php");

Global $connectionDB, $email_to_cd_template, $email_password;

//Template email
$sql = "SELECT * FROM email_template
        WHERE (trigger_file_keyword = 'ACCOUNTING DATA') AND
              (NOT email_from IS NULL) AND (NOT email_to_cd IS NULL)";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

$template = mysql_fetch_array($result);

$email_to_cd = $email_to_cd_template[$template['email_to_cd']];

$sql = "SELECT DISTINCT company.short_name, company.contact_list_id,
               contact.first_name, contact.last_name, contact.email,
               vw_accountant_manager.email AS email_provider, vw_accountant_manager.accounting_provider_name,
               setting.se_internal_email, se_standard_email_foot, setting.{$template['email_from']}
	FROM company
	     INNER JOIN line_item ON company.company_id = line_item.company_id
	     INNER JOIN service ON line_item.service_id = service.service_id
	     INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
	     INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
	     INNER JOIN setting ON company.billing_entity_id = setting.billing_entity_id
            LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id
	WHERE (line_item.status_cd = '" . SW_STATUS_LI_SERVICE . "') AND (service.service_type_id = 10) AND
	      ((CURDATE() >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
     		 (CURDATE() <= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
				 (line_item.service_start_dt IS NULL) OR
				 (line_item.service_start_dt = '0000-00-00')) AND
        ((CURDATE() <= LAST_DAY(line_item.service_end_dt)) OR
         (line_item.service_end_dt IS NULL) OR
         (line_item.service_end_dt = '0000-00-00')) AND
	      (length(trim(contact.email)) > 0) AND (contact.{$email_to_cd} = 1)
	ORDER BY company.short_name";

echo $sql . "\n\n";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}
$num_rows = mysql_num_rows($result);

$mail = new PHPMailer(false);
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->isSendmail();


$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Host = "smtp.gmail.com";  // specify main and backup server
$mail->Port = 587;                                    // TCP port to connect to
$mail->Username = "clientarea@incwell.eu";  // SMTP username
$mail->Password = "tempo_2018"; // SMTP password
$mail->CharSet = "UTF-8";

$mail->DKIM_domain = "incwell.eu";
$mail->DKIM_private_string = "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAreMFYJeMLakGZmK1h3HYu3jLaVVohJ0kwCgj/GE2c/bjknn/zSrOD3ZV3wWy6EspL/zxd+9SPQvseUofeGvO++FZNA75F2PfTKVW+2aZloPaqEjw9+4c/VveuWfWtALLndCWgj3kUpxyro8PoxBxzCXox+mxGNLAmUoA0tfSWG9Ly+Ca5ANIfNpNRitPxVOHeybsaGRb1Q+cOsHrzyLlNLGLVDi16DE1QfjLOsOreuWjypMrjhOa6D0fVemT81FWnXqIDRALcQPjMysQW8m9JFQSbtth/Wf7GSqdg0fvzBNv8+vt7atG/1wZs7ujyBOG49mM2GhuDMTXA2FmsH27XQIDAQAB";
$mail->DKIM_copyHeaderFields = false;
$mail->DKIM_selector = "google";
$mail->Subject = $template['subject'];


echo "To : $num_rows items \n";


$count = 1;
While ($query = mysql_fetch_array($result)){

	// Contable por defecto
	$from_email_default = $query[$template['email_from']];
	$provider = sw_get_provider_contact($from_email);
	$from_name_default  = $provider['provider_contact_name'];

  $from_email = !empty($query['email_provider']) ? $query['email_provider'] : $from_email_default;
  $from_name  = !empty($query['accounting_provider_name']) ? $query['accounting_provider_name'] : $from_name_default;

  $mail->DKIM_identity = $query['se_internal_email'];
  $mail->SetFrom($from_email, $from_name);
  $mail->AddBCC('monicar@incwell.eu');

  $mail->Body = $template['body'] . $query['se_standard_email_foot'];

  $email = $query['email'];
  $first_name = $query['first_name'];
  $mail->AddAddress($email, $first_name);
  $mail->AddReplyTo($from_email, $from_name);

  echo "Address: {$email} ($first_name) \n";
  echo "Replay: {$from_name} ({$from_email}) \n";
  echo $mail->DKIM_identity . "\n";

  echo $count++ . " $first_name ($email) \n";
  if ($mail->Send()) {
    echo $count++ . " $first_name ($email) \n";
  }
  else {
    echo "Send Error:  {$query['short_name']}: $first_name ($email) \n";
  }

  $mail->ClearAddresses();
	$mail->ClearReplyTos();
}

unset($mail);



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



?>