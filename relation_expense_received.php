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


//Class definition
class relation_expense_received extends JTBasicPage
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
    public $sqlExpense_type = null;
    public $dsExpense_type = null;
    public $rbDateQuery = null;


    function relation_expense_receivedCreate($sender, $params)
    {
      sw_style_selected($this);
      unset($_POST['imXLSSubmitEvent']);
    }

    function relation_expense_receivedShow($sender, $params)
    {
      Global $language;

      Define('COL_EXPENSE', $this->gridResults->findColumnByName('expense_type_id'));
      Define('COL_TAX_TYPE', $this->gridResults->findColumnByName('tax_type_key_id'));
      define('COL_INVOICE_DT', $this->gridResults->findColumnByName('invoice_dt'));
      define('COL_INVOICE', $this->gridResults->findColumnByName('invoice_number'));
      define('COL_WITHHOLDING_RATE', $this->gridResults->findColumnByName('withholding_rate_no'));
      define('COL_TAX_IDENT', $this->gridResults->findColumnByName('tax_ident'));
      define('COL_POSTAL_CD', $this->gridResults->findColumnByName('postal_cd'));
      define('COL_ACCOUNT_CD', $this->gridResults->findColumnByName('account_cd'));
      define('COL_REGISTRATION_DT', $this->gridResults->findColumnByName('registered_in_acctg_software_dt'));
      define('COL_DOCUMENT_IDENT', $this->gridResults->findColumnByName('document_ident'));
      define('COL_PDF', $this->gridResults->findColumnByName('img_pdf'));
      define('COL_LINK', $this->gridResults->findColumnByName('link'));

      if (!$this->From_dt->inSession('')){
      	$this->From_dt->Date = date("Y-m-d", mktime(0, 0, 0, date("m"), 1, date("Y")));
      	$this->To_dt->Date = date("Y-m-d", mktime(0, 0, 0, date("m")+1, 0, date("Y")));
      	$this->rbDateQuery->itemindex = $_SESSION['IsSuperadmin'] ? 1 : 0;
      	$this->rbDateQuery->Visible = $_SESSION['IsSuperadmin'];
      }

      //Column Expense type
      $sql = "Select expense_type.*, {$language} as expense_name from expense_type ";
      $this->sqlExpense_type->close();
      $this->sqlExpense_type->SQL = $sql;
      $this->sqlExpense_type->open();


      $records = sw_records_array($sql . "ORDER BY {$language}", Array('expense_type_id', 'expense_name'));
      $records[0] = "";
      $this->gridResults->Columns[COL_EXPENSE]->ComboBoxEditor->Values = $records;
      $this->gridResults->Columns[COL_EXPENSE]->FilterOptions = $records;
      $this->gridResults->Columns[COL_EXPENSE]->TextField = $language;

      $records = sw_records_array("SELECT * FROM tax_type_key WHERE type_tax_cd = 2 ORDER BY tax_type_name", Array('tax_type_key_id', 'tax_type_name'));
      $records[0] = "";
      $this->gridResults->Columns[COL_TAX_TYPE]->ComboBoxEditor->Values = $records;
      $this->gridResults->Columns[COL_TAX_TYPE]->FilterOptions = $records;
      $this->gridResults->Columns[COL_TAX_TYPE]->TextField = 'tax_type_name';

      $this->gridResults->Columns[COL_TAX_TYPE]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridResults->Columns[COL_POSTAL_CD]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridResults->Columns[COL_ACCOUNT_CD]->Visible = $_SESSION['IsSuperadmin'];
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

      $sql = "SELECT invoice_received_id, company_id, invoice_dt, invoice_number,
                    provider_name, subtotal_amt, tax_amt, other_expense_amt,
                    base_withholding_amt, withholding_rate_no, withholding_amt,
                    total_amt, registered_in_acctg_software_dt, account_cd,
                    document_ident, link, expense_type_id, country_id,
                    account_expense_cd, tax_ident, postal_cd, $language, tax_type_key_id, tax_type_name
              FROM vw_expense_received
              WHERE (company_id in ({$company_id})) " . $query_date;
      if (!$this->cbDetail->Checked) {
        $sql = "SELECT expense_type_id, $language, provider_name,
                SUM(subtotal_amt) AS subtotal_amt, SUM(tax_amt) AS tax_amt,
                SUM(other_expense_amt) AS other_expense_amt,
                SUM(base_withholding_amt) AS base_withholding_amt,
                SUM(withholding_amt) AS withholding_amt, SUM(total_amt) AS total_amt,
                tax_ident, postal_cd, account_cd, tax_type_key_id, tax_type_name
                FROM vw_expense_received
                WHERE (company_id in ({$company_id})) " . $query_date;
      }

       if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if (!$this->cbDetail->Checked) {
        $sql .= " GROUP BY expense_type_id, {$language}, provider_name, account_cd, tax_type_name ";
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
      $this->gridResults->Columns[COL_PDF]->Visible        = $this->cbDetail->Checked;

      $this->gridResults->SortBy = 'provider_name';
      if ($this->cbDetail->Checked) {
        $this->gridResults->SortBy = 'provider_name, invoice_dt';
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
      $this->gridResults->Columns[COL_PDF]->Visible = False;
      $this->gridResults->exportGridToXLSDownload("Expense report {$company_name}.xls", 'Expense', true);
      $this->gridResults->Columns[COL_PDF]->Visible        = $this->cbDetail->Checked;
    }


    function gridResultsRowData($sender, $params)
    {
      $field = &$params[1];

      $field['img_pdf'] = 'images/ftp/1px.gif';
      $file = utf8_decode($field['link']);
      if (($file != "") && file_exists($file))
      {
        $field['img_pdf'] = 'images/ftp/pdf.gif';
      }
    }

    function gridResultsJSSelect($sender, $params)
    {
        ?>
        //begin js
        if ((col == <?php echo COL_PDF;?>))
        {
            var cellValue = gridResults.getCellText(row, <?php echo COL_LINK; ?>);
            if (cellValue){
              window.open(cellValue,"_blank","", false);
              return false;
            }
        }
        //end
        <?php
    }
}

global $application;

//global $company;

//Creates the form
$relation_expense_received=new relation_expense_received($application);

//Read from resource file
$relation_expense_received->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $relation_expense_received->show();

?>