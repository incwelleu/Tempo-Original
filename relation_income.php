<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
require_once("include/acceso.php");

//Includes
use_unit("forms.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("extctrls.inc.php");
use_unit("components4phpfull/jtradiobuttonlist.inc.php");

session_start();

/*
define('COL_INVOICE_DT', 1);
define('COL_INVOICE', 2);
define('COL_ACCOUNT_CD', 9);
define('COL_REGISTRATION_DT', 10);
define('COL_DOCUMENT_IDENT', 11);
*/

//Class definition
class relation_income extends JTBasicPage
{
    public $imXLS = null;
    public $cbDetail = null;
    public $To_dt = null;
    public $From_dt = null;
    public $lbTo = null;
    public $gridResults = null;
    public $sqlResults = null;
    public $dsResults = null;
    public $SiteTheme = null;
    public $pnParameter = null;
    public $lbFrom = null;
    public $rbDateQuery = null;

    function relation_incomeCreate($sender, $params)
    {
      sw_style_selected($this);
      unset($_POST['imXLSSubmitEvent']);
    }

    function relation_incomeShow($sender, $params)
    {
      define('COL_INVOICE_DT', $this->gridResults->findColumnByName('invoice_dt'));
      define('COL_INVOICE', $this->gridResults->findColumnByName('invoice_number'));
      define('COL_WITHHOLDING_RATE', $this->gridResults->findColumnByName('withholding_rate_no'));
      define('COL_ACCOUNT_CD', $this->gridResults->findColumnByName('account_cd'));
      define('COL_REGISTRATION_DT', $this->gridResults->findColumnByName('registered_in_acctg_software_dt'));
      define('COL_DOCUMENT_IDENT', $this->gridResults->findColumnByName('document_ident'));

      if (!$this->From_dt->inSession('')){
      	$this->From_dt->Date = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
      	$this->To_dt->Date = date("Y-m-d", mktime(0, 0, 0, date("m")+1, 0, date("Y")));
      	$this->rbDateQuery->itemindex = $_SESSION['IsSuperadmin'] ? 1 : 0;
      	$this->rbDateQuery->Visible = $_SESSION['IsSuperadmin'];
      	$this->gridResults->Columns[COL_ACCOUNT_CD]->Visible = $_SESSION['IsSuperadmin'];
      }
    }

    function gridResultsSQL($sender, $params)
    {
      Global $language;

      list( $sortSql, $sortFields, $filterSql ) = $params;

      $company_id = isset($_SESSION['company_id']) ? $_SESSION['company_id'] : 0;
      $query_date = "AND (invoice_dt BETWEEN '{$this->From_dt->Date}' AND '{$this->To_dt->Date}')";
      if ($this->rbDateQuery->ItemIndex) {
        $query_date = "AND (registered_in_acctg_software_dt BETWEEN '{$this->From_dt->Date}' AND '{$this->To_dt->Date}')";
      }

      $sql = "SELECT invoice_issued_id, invoice_dt, invoice_number, client_name, subtotal_amt,
              transport_amt, tax_amt, other_income_amt,
              base_withholding_amt, withholding_rate_no, withholding_amt,
              total_amt, registered_in_acctg_software_dt,
              account_cd, document_ident
              FROM vw_relation_income
              WHERE (vw_relation_income.company_id in ({$company_id})) " . $query_date;
      if (!$this->cbDetail->Checked) {
        $sql = "SELECT client_name, SUM(subtotal_amt) AS subtotal_amt, SUM(transport_amt) AS transport_amt,
                SUM(tax_amt) AS tax_amt, SUM(other_income_amt) AS other_income_amt,
                SUM(base_withholding_amt) AS base_withholding_amt,
                SUM(withholding_amt) AS withholding_amt,
                SUM(total_amt) AS total_amt, account_cd
              FROM vw_relation_income
                WHERE (company_id in ({$company_id})) " . $query_date;
      }

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if (!$this->cbDetail->Checked) {
        $sql .= " GROUP BY client_name, account_cd ";
      }

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlResults->SQL = $sql;
    }


    function From_dtJSChange($sender, $params)
    {
        echo $this->From_dt->ajaxCall("ParameterChange", array(), array("gridResults"));
        ?>
        //begin js
          return false;
        //end
        <?php
    }


    function ParameterChange()
    {
      $this->gridResults->Columns[COL_INVOICE_DT]->Visible = $this->cbDetail->Checked;
      $this->gridResults->Columns[COL_INVOICE]->Visible    = $this->cbDetail->Checked;
      $this->gridResults->Columns[COL_WITHHOLDING_RATE]->Visible = $this->cbDetail->Checked;
      $this->gridResults->Columns[COL_REGISTRATION_DT]->Visible = $this->cbDetail->Checked && $_SESSION['IsSuperadmin'];
      $this->gridResults->Columns[COL_DOCUMENT_IDENT]->Visible  = $this->cbDetail->Checked && $_SESSION['IsSuperadmin'];

      $this->gridResults->SortBy = 'client_name';
      if ($this->cbDetail->Checked) {
        $this->gridResults->SortBy = 'client_name, invoice_dt';
      }
    }

    function gridResultsSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
    }


    function imXLSClick($sender, $params)
    {
      $company_name = $_SESSION['short_name'];
      $this->gridResults->exportGridToXLSDownload("Income report {$company_name}.xls", 'Income', true);
    }

}

global $application;

//global $company;

//Creates the form
$relation_income=new relation_income($application);

//Read from resource file
$relation_income->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $relation_income->show();

?>