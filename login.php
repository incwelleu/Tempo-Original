<?php
require_once("rpcl/rpcl.inc.php");

//Includes
require_once("include/functions.php");
require_once("include/acceso.php");

use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("styles.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");

session_start();

//Class definition
class login extends JTBasicPage
{
    public $lbLenpassword = null;
    public $lbChangePassword = null;
    public $lbNewpassword = null;
    public $newpassword = null;
    public $confirmpassword = null;
    public $lbConfirmpassword = null;
    public $BtnChange = null;
    public $BtnCancelPassword = null;
    public $lbErrorChange = null;
    public $subtitle = null;
    public $StyleSheet = null;
    public $logo = null;
    public $dwSignIn = null;
    public $lbCookies = null;
    public $lbUser = null;
    public $lbPassword = null;
    public $lbSignIn = null;
    public $BtnLogin = null;
    public $BtnCancel = null;
    public $SiteTheme = null;
    public $username = null;
    public $password = null;
    public $lbError = null;


    function loginCreate($sender, $params)
    {
      //redirect_url("html/construccion.htm");
      sw_style_selected($this);

      if (!isset($_SESSION['css_strong'])){
        $_SESSION['css_strong'] = "spaincorp.css";
      }
      /* TS 27/6/2016 Keep as Tempo
      if (!isset($_SESSION['css_strong'])){
        $_SESSION['css_strong'] = "spaincorp.css";
        if (!$_SERVER['HTTP_REFERER'] && (stripos(strtolower($_SERVER['HTTP_REFERER']), "spaincorp") !== false)){
          $_SESSION['css_strong'] = "strongabogados.css";
        }
      }
      */

      $this->StyleSheet->FileName = "css/" . $_SESSION['css_strong'];

      $this->username->text = "";
      $this->password->text = "";
      $this->newpassword->text = "";
      $this->confirmpassword->text = "";
      $this->subtitle->Top = 0;
      $this->subtitle->left = 0;
      $this->logo->top = 0;
      $this->logo->left = 0;
      $this->lbError->Caption = "";
      $this->lbError->Layer = 0;
      $this->dwSignIn->ActiveLayer = 0;

      if (isset($_SESSION['changepassword'])) {
        $this->lbError->Layer = (!isset($_GLOBALS['changepassword']));
        $this->dwSignIn->ActiveLayer = (!isset($_GLOBALS['changepassword']));
      }
      $this->dwSignIn->ShowWindow();

      if (isset($_POST["username"]) || isset($_POST["password"])){
        $this->InSignUser();
      }
    }


    function BtnCancelJSClick($sender, $params)
    {
      $domain = $_SERVER["HTTP_HOST"];
        ?>
        //begin js
            CloseSession("<?php echo $domain; ?>");
            return (false);
        //end
        <?php
    }


    function InSignUser()
    {
      Global $connectionDB, $acceso;

      $message = "";
      $username = $_POST["username"];
      $password = $_POST["password"];

      if (!isset($_SESSION['user_id'])){
          if (empty($username) || empty($password)) {
              $message = "Please enter your username and password.";
          }
          else {
            // checked access
            $connectionDB->Connected();
            if ($acceso->Login_session($username, $password, $message))
            {
              //update access user and time_zone mysql
              $login_data = $_SESSION['JTUserLogin_StrongWeber'];
              $sql = "Update user Set login_dt = '" . date("Y-m-d H:i:s") . "', login_data = '{$login_data}' " .
                     "Where user_id = " . $_SESSION['user_id'];
              $connectionDB->DbConnection->execute($sql);
              session_name("StrongWeberID");
            }
            $connectionDB->DisConnected();
          }

          //show message
          $this->lbError->Caption = $message;
      }
      if (!$message) redirect_url("index.php");
    }

    function loginJSLoad($sender, $params)
    {
        ?>
        //begin
        document.getElementById( "username" ).focus();
        //end
        <?php
    }


    function loginShowHeader($sender, $params)
    {
      echo "<script type='text/javascript' src='include/strongweber.js'></script>
            <link rel='icon' type='image/icon' href='favicon.ico'/>
            <title>Tempo software, built for European businesses</title>
            <meta name='description' content='Tempo software, built so you can focus on your business.'>";
    }

    function BtnCancelPasswordClick($sender, $params)
    {
        unset($_SESSION['changepassword']);
        $this->BtnChange->Enabled = True;
        redirect_url("index.php");
    }

    function BtnChangeClick($sender, $params)
    {
        Global $connectionDB, $acceso;

        $message = "";
        $newpassword = $_POST["newpassword"];
        $confirmpassword = $_POST["confirmpassword"];

        if (empty($newpassword) or empty($confirmpassword) or
            (strlen($newpassword) < 4)) {
          $message = "Please enter your new password and confirmation.";
        }
        elseif ($newpassword != $confirmpassword) {
          $message = "Your password did not match the confirmed password!";
        }
        else {
            // change password
            $sql = "UPDATE user SET password=PASSWORD('$newpassword') WHERE username='" . $_SESSION['username'] . "'";
            if ($connectionDB->DbConnection->execute($sql)) {
              unset($_SESSION['changepassword']);
            }
            else { $message = "Your password could not be changed due to a system error. We apologize for any inconvenience.";
            }
        }

        //show message
        $this->lbError->Caption = $message;
        if (!$message) redirect_url("index.php");
    }

}

global $application;

global $login;

//Creates the form
$login=new login($application);

//Read from resource file
$login->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$login->show();

?>