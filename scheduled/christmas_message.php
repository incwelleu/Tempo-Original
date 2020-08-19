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


$sql = "SELECT * FROM email_template
        WHERE (trigger_type_cd = 'SCH') AND (trigger_file_keyword = 'NAVIDAD') AND
              (NOT email_from IS NULL) AND (NOT email_to_cd IS NULL)";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

$template = mysql_fetch_array($result);

$from_email = $setting['se_director_email'];
$from_name  = $setting['se_director_name'];
$email_to_cd = $email_to_cd_template[$template['email_to_cd']];

$sql = "SELECT DISTINCT company.contact_list_id, contact.first_name, contact.last_name, contact.email
	FROM company
		INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
		INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
	WHERE company.company_id = 1303 AND length(trim(contact.email)) > 0 AND contact.{$email_to_cd} = 1 ";


$sql = "SELECT DISTINCT company.contact_list_id, contact.first_name, contact.last_name, contact.email
	FROM company
		INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
		INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
		INNER JOIN line_item ON company.company_id = line_item.company_id AND line_item.status_cd = 'SV'
	WHERE length(trim(contact.email)) > 0 AND contact.{$email_to_cd} = 1 ";



$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}
$num_rows = mysql_num_rows($result);

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

$mail->SetFrom($from_email, $from_name);
$mail->AddBCC('monicar@incwell.eu');


echo "From: $from_name ($from_email) </br>";
$mail->AddBCC($setting['se_internal_email']);
$mail->Subject = $template['subject'];
$mail->Body = $template['body'] . $setting['se_standard_email_foot'];

echo "To : $num_rows items </br>";

$count = 1;
While ($query = mysql_fetch_array($result)){
  $email = $query['email'];
  $first_name = $query['first_name'];
  $mail->AddAddress($email, $first_name);
  if ($mail->Send()) {
    echo $count++ . " $first_name ($email) </br>";
    $mail->ClearAddresses();
  }
}

unset($mail);

?>