<?php
require_once("rpcl/rpcl.inc.php");
require_once("fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtnavbar.inc.php");
use_unit("components4phpfull/jthnavbar.inc.php");

session_start();

//Class definition
class send_proposal extends fmstrong
{
    public $JTNavigationBar1 = null;
    public $SiteTheme = null;
    public $gridData = null;
    public $sqlData = null;
    public $dsData = null;
    public $Label1 = null;
    public $tbForm = null;

    function gridDataSort($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;
      $sql = "SELECT service_proposal.*, service_category.service_category_name
              FROM service_proposal
                  INNER JOIN
                    (SELECT service_category_id AS type_id, service_category_name FROM service_category) AS service_category
                  ON service_category.type_id = service_proposal.service_category_id";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlData->SQL = $sql;
    }


    function send_proposalCreate($sender, $params)
    {
      $this->lbTitle->Caption = 'Prueba';

      $this->gridData->CommandBar->CustomCommands = array(
          new JTPlatinumGridCommandBarItem( null, "Add", "btnadd" ));
    }


    function send_proposalTemplate($sender, $params)
    {
      $template=$params['template'];
      $template->_smarty->assign('lbTitle',$this->lbTitle->Caption);
    }


}

global $application;

global $send_proposal;

//Creates the form
$send_proposal=new send_proposal($application);

//Read from resource file
$send_proposal->loadResource(__FILE__);

//Shows the form
$send_proposal->show();

?>