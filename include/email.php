<?php
require_once("PHPMailer/class.phpmailer.php");
require_once("PHPMailer/class.smtp.php");


class SW_EMAIL extends PHPMailer {

  function __construct($exceptions = false)
  {
    parent::__construct($exceptions);

    $this->IsSMTP();
    $this->IsHTML(true);

    $this->SMTPAuth = true;                   // enable SMTP authentication
	$this->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $this->Host = "smtp.gmail.com";           // sets GMAIL as the SMTP server
    $this->Port = 587;                        // set the SMTP port for the GMAIL server
	$this->Username = "clientarea@incwell.eu";  // SMTP username
	$this->Password = "tempo_2018"; // SMTP password
	$this->CharSet = "UTF-8";


	$this->DKIM_domain = "incwell.eu";
	$this->DKIM_private_string = "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAreMFYJeMLakGZmK1h3HYu3jLaVVohJ0kwCgj/GE2c/bjknn/zSrOD3ZV3wWy6EspL/zxd+9SPQvseUofeGvO++FZNA75F2PfTKVW+2aZloPaqEjw9+4c/VveuWfWtALLndCWgj3kUpxyro8PoxBxzCXox+mxGNLAmUoA0tfSWG9Ly+Ca5ANIfNpNRitPxVOHeybsaGRb1Q+cOsHrzyLlNLGLVDi16DE1QfjLOsOreuWjypMrjhOa6D0fVemT81FWnXqIDRALcQPjMysQW8m9JFQSbtth/Wf7GSqdg0fvzBNv8+vt7atG/1wZs7ujyBOG49mM2GhuDMTXA2FmsH27XQIDAQAB";
	$this->DKIM_copyHeaderFields = false;
	$this->DKIM_selector = "google";
	$this->DKIM_identity = $_SESSION['settings']['se_internal_email'];
	
  }


  function SetEmailTemplate($SendKey, $ReplaceField, $Greeting = false, $Farewell = false, $Mail_foot = false)
  {
    Global $connectionDB;
    $where = '';
    foreach ($SendKey as $key => $value){
      $where .= $where ? " AND " : "";
      $where .= "({$key} = '{$value}')";
    }

    $sql = "SELECT * FROM email_template WHERE {$where}";
    $query = new query();
    $query->Database = $connectionDB->DbConnection;
    $query->LimitStart = 0;
    $query->LimitCount = 1;
    $query->SQL = $sql;
    $query->open();

    if (!$query->EOF) {
      $subject = $query->Fields['subject'];
      foreach ($ReplaceField as $key => $fieldvalue) {
        $Subject = str_replace('{' . $key . '}', $fieldvalue, $Subject);
      }

      $body = '';
      if ($Greeting){
        $body = "Dear {first_name}\n";
      }

      $body .= $query->Fields['body'];

      if ($Farewell){
        $body .= "Kind regards,\n {$_SESSION['provider_contact_name']}\n";
      }

      foreach ($ReplaceField as $key => $fieldvalue) {
        $body = str_replace('{' . $key . '}', $fieldvalue, $body);
      }


      if ($Mail_foot) {
        $body .= GLOBAL_EMAIL_FOOT;
      }

      $this->Subject = $subject;
      $this->MsgHTML($body);
    }

    return $query->Fields['email_template_id'];
  }

}

?>