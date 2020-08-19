<?php
//Includes
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
require_once("include/acceso.php");

use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttreeview.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtmenubar.inc.php");
use_unit("components4phpfull/jtiframe.inc.php");
use_unit("imglist.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("styles.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");

session_start();

//Class definition
class main extends JTBasicPage
{
    public $fmMain = null;
    public $pnClient = null;
    public $changepassword = null;
    public $lbUser = null;
    public $lbLogout = null;
    public $logo = null;
    public $subtitle = null;
    public $menu = null;
    public $tvMenu = null;
    public $lbCompany = null;
    public $lbStatusCompany = null;
    public $msgWarning = null;
    public $cbCompany = null;
    public $SiteTheme = null;
    public $StyleSheet = null;
    public $sqlMenu = null;
    public $dsMenu = null;
    public $imRefresh = null;
    public $lbLastInvoice = null;

    function mainCreate($sender, $params)
    {
      Global $homepage_adm, $homepage, $acceso;

      //Evaluated if the user has logged session
      $acceso->sw_login_check();

      sw_style_selected($this);

      $this->subtitle->Top = 0;
      $this->subtitle->left = 0;
      $this->logo->top = 0;
      $this->logo->left = 0;

      $this->lbUser->Visible = isset($_SESSION['username']);
      $this->changepassword->Visible = isset($_SESSION['username']);
      $this->lbLogout->Visible = isset($_SESSION['username']);
      $this->lbUser->Caption = 'User name: ' . $_SESSION['username'];
      $this->StyleSheet->FileName = "css/" . $_SESSION['css_strong'];

      if( !$this->cbCompany->inSession( '' ) || ($this->cbCompany->ItemIndex != $_SESSION['company_id'])){
         $this->CompanyChangeView($sender, array(True));
      }

    }


    function btnCloseClick($sender, $params)
    {
      Global $acceso;

      $acceso->Login_user->LogoutUser();
    }


    function lbLogoutClick($sender, $params)
    {
      Global $acceso;
      $acceso->Login_user->LogoutUser();
    }


    function mainShowHeader($sender, $params)
    {
      echo "<script type='text/javascript' src='include/strongweber.js'></script>
            <link rel='icon' type='image/icon' href='favicon.ico'/>
            <link href='css/{$_SESSION['css_strong']}' rel='stylesheet' type='text/css' />
            <link href='include/tinybox.css' rel='stylesheet' type='text/css' />
            <script type='text/javascript' src='include/tinybox.js'></script>";
    }


    function changepasswordClick($sender, $params)
    {
        $_SESSION['changepassword'] = '1';
        redirect_url("login.php");
    }



    Function Link_check($link)
    {
      Global $homepage_adm, $homepage;

      if (strpos($link, ".php") === false) {
        if ($_SESSION['IsProvider']) $this->fmMain->URL = $homepage_adm;
        else $this->fmMain->URL = $homepage;
      }
      else $this->fmMain->URL = $link;
    }



    function mainJSLoad($sender, $params)
    {
        ?>
        //begin js
        var msgWarning = '<?php echo $this->msgWarning->Value; ?>';
        var tvMenu = document.getElementById("tvMenu");
        var caption = tvMenu.getSelectedCaption();
        if (!caption) {
          jQuery("#tvMenu ul li.jttreerootnode").each(function() { tvMenu.setNodeState(this, true);})
        }

        if (msgWarning) {
          TINY.box.show({html:msgWarning,animate:false,close:false,boxid:'warning',mask:false,left:10,height:'auto',width:'300px'});
        }

        //end
        <?php
    }


    function logoJSClick($sender, $params)
    {
        $url = $_SERVER['HTTP_HOST'];
        ?>
        //begin js
            CloseSession("<?php echo $url; ?>");
            return (false);
        //end
        <?php

    }


    function CompanyChangeView($sender, $params)
    {
      Global $acceso;
      $refresh = $params[0];

      if ($refresh)  {
        Global $connectionDB;

        $sql = "Select * from company Where company_id in ({$_SESSION['company_user']}) Order by is_default_company_yn desc, short_name";
        if ($_SESSION['IsSuperadmin']) {
          $sql = "Select company_id, short_name from company Order by short_name ";
        } else if ($_SESSION['IsProvider']){
        	$sql = "Select * from company Where company_id in ({$_SESSION['company_user']}) Order by short_name";
				}
        $this->cbCompany->Items = sw_records_array($sql, array('company_id', 'short_name'));

        if ($_SESSION['company_id'] === 0) {
          $_SESSION['company_id'] = $this->cbCompany->ItemIndex = key($this->cbCompany->Items);
        }
        else if (isset($_SESSION['company_id'])) {
          $this->cbCompany->ItemIndex = $_SESSION['company_id'];
        }
      }

      $company_id = $this->cbCompany->ItemIndex ? $this->cbCompany->ItemIndex : 0;
      sw_get_company_parameter($company_id);

      $acceso->Access_active();

      $this->lbStatusCompany->Caption = sw_status_user();
			$this->lbLastInvoice->Caption = sw_last_company_invoice();

      $this->MenuCreate();
    }


    function MenuCreate()
    {
      Global $homepage;
      $this->tvMenu->Items = array();

      //initialize the frame
      $this->Link_check($this->fmMain->URL);

      $this->sqlMenu->close();
      $company_id = isset($_SESSION['company_id']) ? $_SESSION['company_id'] : 0;
      $access = isset($_SESSION['GLOBAL_ACCESS']) ? $_SESSION['GLOBAL_ACCESS'] : '0';

      //checking access
      if (!$access) exit;

      $status_block_dt = "";
      if ($_SESSION['status_block_dt']) {
        $status_block_dt = "AND (Not link like '%.php')";
      }


      $description = "description_{$_SESSION['language']}";
      $sql = "SELECT DISTINCT nodo_id, parent_id, link, company_id, sort,
                CASE company_id WHEN 0 THEN
                			CASE IFNULL({$description}, '') WHEN '' THEN description_en
                      ELSE {$description} END
                  	ELSE LOWER(description_en) END as name
                FROM virtual_file
                WHERE (nodo_id in ({$access})) AND ((Not link like '%help.php%') OR (link IS NULL))

              UNION ALL

              SELECT DISTINCT nodo_id, parent_id, link, company_id, sort,
                CASE company_id WHEN 0 THEN
                			CASE IFNULL({$description}, '') WHEN '' THEN description_en
                      ELSE {$description} END
                  	ELSE LOWER(description_en) END as name
              FROM virtual_file
              WHERE (link like '%help.php%') ";

      if (!$_SESSION['IsSuperadmin']){
          $sql .= "AND (parent_id in ({$access})) AND (nodo_id in (" . sw_check_menu_help() . ")) ";
      }
      $sql .= "ORDER BY parent_id, sort, name";

      $this->sqlMenu->SQL = $sql;
      $this->sqlMenu->open();
    }

    function tvMenuJSClick($sender, $params)
    {
        ?>
        //begin js

          var a = getEventTarget(event);
          var xparam1 = params[ 0 ];
          var xparam2 = params[ 1 ];
          var ref = a.href

          if ((a.tagName == "SPAN") && (a.href == undefined)) {
            JTTreeViewPlusClick(event,'tvMenu');
          }
          else {
            if (/pdf/.test(a.href)) document.getElementById("fmMain").src = a.href + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000);
	          else document.getElementById("fmMain").src = a.href;
            <?php echo $this->tvMenu->ajaxCall("tvMenuClick", array(), array("tvMenu")); ?>
          }
          return false;
        //end
        <?php
    }


    function tvMenuClick($sender, $params)
    {
      if (strlen($this->tvMenu->SelectedNode->Link) > 0)
      {
        $this->fmMain->URL = $this->tvMenu->SelectedNode->Link;
      }
    }


    function cbCompanyChange($sender, $params)
    {
      $this->CompanyChangeView($sender, array(0));
    }


    function imRefreshJSClick($sender, $params)
    {
      echo "params = [1];";
      echo $this->fmMain->ajaxCall("CompanyChangeView", array(), array('tvMenu', 'cbCompany', 'lbStatusCompany'));
        ?>
        //begin js
        return false;
        //end
        <?php
    }






}

global $application;

global $main;

//Creates the form
$main = new main($application);

//Read from resource file
$main->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $main->show();
else redirect_url('login.php');


?>