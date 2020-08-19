<?php
require_once("rpcl/rpcl.inc.php");
require_once("functions.php");
require_once("acceso.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");

session_start();

//Class definition
class fmstrong extends JTBasicPage
{
    public $msgWarning = null;
    public $msgError = null;
    public $msgSuccess = null;
    public $lbTitle = null;

    function __construct($aowner = null)
    {
      parent::__construct($aowner);

      Global $acceso;

      //Evaluated if the user has logged session
      $acceso->sw_login_check();
    }


    function fmstrongJSLoad($sender, $params)
    {
        ?>
        //begin js
        var msgError = '<?php echo $this->msgError->Value; ?>';
        var msgSuccess = '<?php echo $this->msgSuccess->Value; ?>';
        var msgWarning = '<?php echo $this->msgWarning->Value; ?>';

        if (msgError) {
          TINY.box.show({html:msgError,animate:true,close:true,boxid:'error'});
        }

        if (msgSuccess) {
          TINY.box.show({html:msgSuccess,animate:true,close:false,boxid:'success',mask:false,autohide:5});
        }

        if (msgWarning) {
          TINY.box.show({html:msgWarning,animate:true,close:false,boxid:'warning',mask:true,top:-15});
        }
        //end
        <?php
      $this->msgError->Value = '';
      $this->msgSuccess->Value = '';
      $this->msgWarning->Value = '';
    }

    function fmstrongShowHeader($sender, $params)
    {
      echo SW_HEADER_HTML;
    }

		function filter_grid($sender, $params)
		{
    	if ($sender->Header->SimpleFilter){ $sender->Header->ShowFilterBar = !$sender->Header->ShowFilterBar; }
      $sender->Header->SimpleFilter = True;
  		foreach( $sender->Columns as $Column )
  		{
    		$Column->Filter = "";
  		}
		}

		function custom_filter_grid($sender, $params)
		{
			if (!$sender->Header->ShowFilterBar) {$sender->Header->ShowFilterBar = True; }
      $sender->Header->SimpleFilter = False;
		}

    function lbTitleShow($sender, $params)
    {
      $link = basename($_SERVER['REQUEST_URI']);
      $caption = $this->lbTitle->Caption;
      if ($_SESSION['IsSuperadmin'] && $this->lbTitle->Visible && $record = sw_get_data_table('vw_application_form', "link like '{$link}%'")){
        $caption = $this->lbTitle->Caption . " <a href='help_program.php?nodo_id={$record['nodo_id']}' target='blank'><img align=center src='images/help.png'></a>";
      }
      echo $caption;
    }

    function msgErrorJSChange($sender, $params)
    {
        ?>
        //begin js
        if (msgError) {
          TINY.box.show({html:msgError,animate:true,close:true,boxid:'error',height:'auto',width:'300px'});
        }
				//end
        <?php
    }

}

global $application;

global $fmstrong, $language;

//Creates the form
$fmstrong=new fmstrong($application);

//Read from resource file
$fmstrong->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $fmstrong->show();

?>