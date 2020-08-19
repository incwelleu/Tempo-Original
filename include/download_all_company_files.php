<?php
require_once("configure.php");
require_once("dbconnection.php");
require_once("ziparchive.php");
require_once("PHPMailer/class.phpmailer.php");

Global $connectionDB, $TempDir;

$company_id = $argv[1];
$email = $argv[2];
$server = $argv[3];

echo "Email: {$email} \n";
echo "Date: " . date("Y-m-d H:i:s") . "\n";

$sql = "SELECT company.short_name, virtual_file.link, virtual_file.parent_id
        FROM company INNER JOIN virtual_file ON company.company_id = virtual_file.company_id
        WHERE virtual_file.company_id = {$company_id}
        ORDER BY virtual_file.link";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
}

if ($num_rows = mysql_num_rows($result) !== 0){
  $query = mysql_fetch_array($result);
  $filename = "download_{$query['short_name']}_" . date("Ymd_His") . ".zip";
  $filezip = "../{$TempDir}/{$filename}";
  $zip = new zipArchiveLib();

//  set_time_limit(0); // At the beginning of the page
//  ini_set('memory_limit', '-1');

  Do {

  	if (check_access_parent($query['parent_id'])){
  		$file = "../" . $query['link'];
    	$DirFile = str_replace($VirtualFile . "/", "", $query['link']);
    	$zip->addFile($file, $DirFile);
  		$zip->saveZip($filezip);
    }
  } While ($query = mysql_fetch_array($result));

  send_email($email, $server, $filename, $company_id);
}


function check_access_parent($parent_id){
  Global $connectionDB;

  $sql = "SELECT nodo_id FROM virtual_file
          WHERE (nodo_id = {$parent_id}) AND (superadmin_yn = 0)";

  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }
  $record = mysql_fetch_array($result);
  return (isset($record['nodo_id']));
}


//download file
function download_file_Zip($filename, &$zip)
{
  Global $VirtualFile;
  $file = "../" . $filename;

  if (!is_dir($file)){
    $DirFile = str_replace($VirtualFile . "/", "", $filename);
    $zip->addFile($file, $DirFile);
  }
  else
  {
    $list = @scandir($file);
		if (is_array($list)) {
      foreach($list as $item){
        if (($item != ".") && ($item != "..")){
			    $localFile = $file. "/" . $item;
			    $DirFile = $filename . "/" . $item;
          $DirFile = str_replace($VirtualFile . "/", "", $DirFile);

				  if (is_dir($localFile))
				  {
            $zip->addDir($DirFile);
					  sw_download_file_Zip($localFile, $zip);
				  }
          else {
            $zip->addFile($localFile, $DirFile);
          }
			  }
		  }
	  }
  }
}


function send_email($email, $server, $filename, $company_id)
{
  Global $connectionDB, $email_to_cd_template, $TempDir,
	     $email_username, $email_password,
		 $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;



  //Settings
  $sql = "SELECT setting.*
					FROM setting INNER JOIN billing_entity ON setting.billing_entity_id = billing_entity.billing_entity_id
				  WHERE billing_entity.company = {$company_id}";
  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }
  $setting = mysql_fetch_array($result);

  //Template emails
  $sql = "SELECT * FROM email_template
          WHERE (trigger_type_cd = 'UPL') AND (trigger_file_keyword = 'Download company files') AND
                (NOT email_from IS NULL) AND (NOT email_to_cd IS NULL)";
  $result = mysql_query($sql, $connectionDB);
  if (!$result) {
    die('Invalid query in template: ' . mysql_error($connectionDB));
  }
  $template = mysql_fetch_array($result);

  $from_email = $setting[$template['email_from']];
  $provider = sw_get_provider_contact($from_email);
  $from_name  = $provider['provider_contact_name'];

  $email_to_cd = $email;

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
  $mail->AddBCC($setting['se_internal_email']);
  $mail->AddBCC('monicar@incwell.eu');

  $mail->Subject = $template['subject'];

  $body = $template['body'];

  $link = "http://{$server}/clientarea/{$TempDir}/{$filename}";
  echo $link . "\n";
  $link = "<a href='{$link}' target='_new'>{$filename}</a><br/>";
  $body = str_replace('{FILES}', $link, $body);

  $mail->Body = $body . $setting['se_standard_email_foot'];
  $mail->AddAddress($email);
  $mail->Send();
  unset($mail);
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


?>