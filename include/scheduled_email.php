<?php
require_once("configure.php");
require_once("dbconnection.php");
require_once("PHPMailer/class.phpmailer.php");

Global $connectionDB, $email_to_cd_template, $email_from_template,
	   $email_username, $email_password,
	   $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;

$trigger_file_keyword = $argv[1];
$where = $argv[2];

//Settings
$sql = "SELECT * FROM setting";
$result = mysql_query($sql, $connectionDB);
if (!$result) {
  die('Invalid query in template: ' . mysql_error($connectionDB));
}
$setting = mysql_fetch_array($result);


echo $trigger_file_keyword . "\n\n";

$sql = "SELECT * FROM email_template
        WHERE (trigger_type_cd = 'SCH') AND (trigger_file_keyword = '{$trigger_file_keyword}') AND
              (NOT email_from IS NULL) AND (NOT email_to_cd IS NULL)";

echo $sql . "\n\n";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

$template = mysql_fetch_array($result);

$from_email = $setting[$template['email_from']];
$provider = sw_get_provider_contact($from_email);
$from_name  = $provider['provider_contact_name'];

$from_email = $setting[$template['email_from']];
$from_name  = $email_from_template[$template['email_from']];
$email_to_cd = $email_to_cd_template[$template['email_to_cd']];

if ($where) $where = " AND " . $where;

$sql = "SELECT DISTINCT company.contact_list_id, contact.first_name, contact.last_name, contact.email
        FROM company
             INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
             INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
        WHERE (length(trim(contact.email)) > 0) AND (contact.{$email_to_cd} = 1) {$where}
	      ORDER BY company.contact_list_id";

echo "Where {$where}\n\n";
echo $sql . "\n\n";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}
$num_rows = mysql_num_rows($result);

$mail = new PHPMailer(false);
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->CharSet = "UTF-8";
$mail->Priority = 1;

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


echo "From: $from_name ($from_email) \n";
$mail->AddBCC($setting['se_internal_email']);

//Replace Field Macro
$ReplaceField['month'] = date('F');
$ReplaceField['year'] = date('Y');
$ReplaceField['-year'] = date('Y')-1;

foreach ($ReplaceField as $key => $fieldvalue) {
	$template['subject'] = str_replace('{' . $key . '}', $fieldvalue, $template['subject']);
}

foreach ($ReplaceField as $key => $fieldvalue) {
	$template['body'] = str_replace('{' . $key . '}', $fieldvalue, $template['body']);
}


$mail->Subject = $template['subject'];
$mail->Body = $template['body'] . $setting['se_standard_email_foot'];

echo "To : $num_rows items \n";

$count = 1;
While ($query = mysql_fetch_array($result)){
  $email = $query['email'];
  $first_name = $query['first_name'];
  $mail->AddAddress($email, $first_name);
  if ($mail->Send()) {
    echo $count++ . " {$query['short_name']}: $first_name ($email) \n";
  }
  else {
    echo "Send Error:  {$query['short_name']}: $first_name ($email) \n";
  }
  $mail->ClearAddresses();
}


echo "\nEmail: \n";
echo "Subject {$template['subject']}\n";

echo "Body {$template['body']}\n";

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