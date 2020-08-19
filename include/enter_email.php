<?php
require_once("rpcl/rpcl.inc.php");
require_once("configure.php");
require_once("language.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");

//Class definition
class enter_email extends Page
{
    public $get_confirm_email = null;
    public $get_enter_email = null;
    public $lbEnter_email = null;
    public $lbConfirm_email = null;
    public $btnEnter_email = null;
    public $btnClose_email = null;
    public $lbError_email = null;

    function enter_emailShow($sender, $params)
    {
      $this->get_enter_email->Text = "";
      $this->get_confirm_email->Text = "";
      $this->btnEnter_email->Enabled = False;
      $this->lbError_email->Caption = '';
    }

    function get_confirm_emailJSKeyUp($sender, $params)
    {
      Global $lbEmailErrorMsg;
        ?>
        //begin js
        var email_enter = document.getElementById("get_enter_email").value;
        var email_confirm = document.getElementById("get_confirm_email").value;
        document.getElementById("btnEnter_email").disabled=true;
        document.getElementById("lbError_email").innerHTML = "";

        if (!(<?php echo SW_MASK_EMAIL;?>.test(email_enter)) || !(<?php echo SW_MASK_EMAIL;?>.test(email_confirm))){
           document.getElementById("lbError_email").innerHTML = "<?php echo $lbEmailErrorMsg; ?>";
        }

        if ((email_enter.length > 0) && (email_confirm.length > 0) && (email_enter == email_confirm)){
          document.getElementById("btnEnter_email").disabled= (document.getElementById("lbError_email").innerHTML != "");
        }
        //end
        <?php
    }


}

global $application;

global $enter_email;

//Creates the form
$enter_email=new enter_email($application);

//Read from resource file
$enter_email->loadResource(__FILE__);

//Shows the form
$enter_email->show();

?>