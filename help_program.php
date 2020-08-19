<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
require_once("include/acceso.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jttreeview.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtiframe.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");

session_start();

//Class definition
class help_program extends JTBasicPage
{
    public $sqlMenu = null;
    public $dsMenu = null;
    public $tvMenu = null;
    public $SiteTheme = null;
    public $fmMain = null;

    function help_programCreate($sender, $params)
    {
      Global $homepage_adm, $homepage, $acceso;

      //Evaluated if the user has logged session
      $acceso->sw_login_check();

      sw_style_selected($this);

//      if (!$this->tvMenu->inSession('')){
        $this->MenuCreate();
//      }

      //initialize the frame
      $this->Link_check($this->fmMain->URL);

    }


    function MenuCreate()
    {
      $this->tvMenu->Items = array();

      $this->sqlMenu->close();

      $description = "description_{$_SESSION['language']}";
      $sql = "SELECT DISTINCT *
              FROM
                (SELECT DISTINCT vw_application_menu.nodo_id, vw_application_menu.parent_id, vw_application_menu.sort,
                    CASE IFNULL(vw_application_menu.{$description}, '') WHEN '' THEN vw_application_menu.description_en
                    ELSE vw_application_menu.{$description} END AS name, '' AS link
                FROM vw_application_menu
                    INNER JOIN vw_application_form ON vw_application_menu.nodo_id = vw_application_form.menu_id

                UNION ALL

                SELECT DISTINCT vw_application_submenu.nodo_id, vw_application_submenu.parent_id, vw_application_submenu.sort,
                    CASE IFNULL(vw_application_submenu.{$description}, '') WHEN '' THEN vw_application_submenu.description_en
                    ELSE vw_application_submenu.{$description} END AS name,
                    CASE IFNULL(vw_application_submenu.link, '') WHEN '' THEN '' ELSE CONCAT('help.php?nodo_id=',vw_application_submenu.nodo_id) END AS link
                FROM vw_application_submenu
                    INNER JOIN vw_application_form ON vw_application_submenu.nodo_id = vw_application_form.submenu_id
                    INNER JOIN help_content ON vw_application_form.nodo_id = help_content.nodo_id

                UNION ALL

                SELECT DISTINCT vw_application_form.nodo_id, vw_application_form.parent_id, vw_application_form.sort,
                    CASE IFNULL(vw_application_form.{$description}, '') WHEN '' THEN vw_application_form.description_en
                    ELSE vw_application_form.{$description} END AS name,
                    CASE IFNULL(vw_application_form.link, '') WHEN '' THEN '' ELSE CONCAT('help.php?nodo_id=',vw_application_form.nodo_id) END AS link
                FROM vw_application_form
                INNER JOIN help_content ON vw_application_form.nodo_id = help_content.nodo_id
                ) as menu
               ";

      $sql .= "ORDER BY menu.parent_id, menu.sort, menu.name";

      $this->sqlMenu->SQL = $sql;
      $this->sqlMenu->open();
    }


    Function Link_check($link)
    {
      $link = $this->fmMain->URL;
      if (isset($_REQUEST['nodo_id'])){
        $link = "help.php?nodo_id={$_REQUEST['nodo_id']}";
      }
      $this->fmMain->URL = $link;
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
          }
          return false;
        //end
        <?php
    }

}

global $application;

global $help_program;

//Creates the form
$help_program=new help_program($application);

//Read from resource file
$help_program->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$help_program->show();

?>