<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtradiobuttonlist.inc.php");

define('INVOICE_ISSUED', 0);
define('INVOICE_RECEIVED', 1);
define('PENDING_ACCOUNTED', 0);
define('WITHOUT_REGISTERED', 1);

//Class definition
class relation_invoice_accounting extends fmstrong
{
    public $rbStatus = null;
    public $rbInvoice = null;
    public $gridData = null;
    public $company_id = null;
    public $rowUpload = null;
    public $sqlInvoice_accounting = null;
    public $dsInvoice_accounting = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $pnParameter = null;
    public $lbFrom = null;
    public $lbTo = null;
    public $From_dt = null;
    public $To_dt = null;

    function relation_invoice_accountingCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->Parameter();
    }


    function Parameter()
    {
      //Create Button
      $this->From_dt->Date = date("Y-m-d", mktime(0, 0, 0, 1, 1, date("Y")));
      $this->To_dt->Date = date("Y-m-d", mktime(0, 0, 0, 12, 31, date("Y")));
    }



    function gridDataSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;


      $sql  = "SELECT DISTINCT company.company_id, company.short_name, vw_accountant_manager.accounting_provider_name ";
      $from = "FROM company
                  INNER JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id ";

      $where = "WHERE (registered_in_acctg_software_dt BETWEEN '{$this->From_dt->Date}' AND '{$this->To_dt->Date}') ";

      $table = "invoice_issued";
      if ($this->rbInvoice->ItemIndex === INVOICE_RECEIVED) {
        $table = "invoice_received";
      }


      //Status
      if ($this->rbStatus->ItemIndex === PENDING_ACCOUNTED) {
          $from .= " INNER JOIN {$table} ON company.company_id = {$table}.company_id ";
          $where .= " AND (accounted_yn = false) ";
      } else if ($this->rbStatus->ItemIndex === WITHOUT_REGISTERED) {
          $from .= " LEFT JOIN {$table} ON company.company_id = {$table}.company_id ";
          $where = "WHERE ({$table}.company_id IS NULL) ";
      }

      $sql .= ($from . $where);

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlInvoice_accounting->SQL = $sql;
    }



    function From_dtJSChange($sender, $params)
    {
//        echo $this->From_dt->ajaxCall("ParameterChange", array(), array("gridUpload"));
        ?>
        //begin js
        gridData.Refresh();
        //end
        <?php
    }

    function ParameterChange()
    {
      $this->gridUpload->SortBy = 'upload_dt';
    }


}

global $application;

global $relation_invoice_accounting;

//Creates the form
$relation_invoice_accounting=new relation_invoice_accounting($application);

//Read from resource file
$relation_invoice_accounting->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $relation_invoice_accounting->show();

?>