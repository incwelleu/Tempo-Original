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
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtbevel.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");

session_start();

//Class definition
class ten_most_recent_file extends JTBasicPage
{
    public $lbTitulo = null;
    public $pnInformation = null;
    public $winInformation = null;
    public $lbAcct_manager = null;
    public $lbHR_manager = null;
    public $lbOverview_payroll = null;
    public $lbAccounting_team = null;
    public $lbOverview_accounting = null;
    public $lbOur_phone = null;
    public $lbGive_feedback = null;
    public $lbYourContacts = null;
    public $pnNews = null;
    public $gridDocuments = null;
    public $lbLastTen = null;
    public $sqlDocuments = null;
    public $dsDocuments = null;
    public $SiteTheme = null;

    function ten_most_recent_fileCreate($sender, $params)
    {
      Global $acceso;

      $acceso->sw_login_check();
      sw_style_selected($this);
    }

    function gridDocumentsSQL($sender, $params)
    {

      list( $sortSql, $sortFields, $filterSql ) = $params;

      $access = $_SESSION['GLOBAL_ACCESS'] ? $_SESSION['GLOBAL_ACCESS'] : 0;
      $company_id = isset($_SESSION['company_id']) ? $_SESSION['company_id'] : 0;
      $sql = "SELECT nodo_id, LOWER(description_en) as name, parent_id, folder, link, created_dt, company_id, sort
              FROM virtual_file
              WHERE (company_id in ({$company_id})) AND (link != '') AND (Not link like '%.php%') AND (parent_id in ({$access}))
              ORDER BY created_dt DESC ";

      $this->sqlDocuments->SQL = $sql;
    }


    function Account_manager_inf()
    {
      Global $connectionDB, $VirtualFile;

      $sql = "SELECT * FROM vw_account_manager WHERE acct_manager_id = " . $_SESSION['acct_manager_id'];
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      $email = '';
      $account_manager = $_SESSION['settings']['se_director_name'];
      $email_account_manager = $_SESSION['settings']['se_director_email'];
      if (!$query->EOF) {
        $account_manager = $query->Fields['account_manager_name'];
        $email_account_manager = $query->Fields['email'];
      }

      $sql = "SELECT * FROM vw_accountant_manager WHERE accounting_provider_id = " . $_SESSION['accounting_provider_id'];
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      $email_accounting_provider = $_SESSION['settings']['se_accounting_email'];
      if (!$query->EOF) {
        $email_accounting_provider = $query->Fields['email'];
      }

      $sql = "SELECT * FROM vw_payroll_manager WHERE payroll_provider_id = " . $_SESSION['payroll_provider_id'];
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      $email_payroll_provider = $_SESSION['settings']['se_hr_email'];
      if (!$query->EOF) {
        $email_payroll_provider = $query->Fields['email'];
      }

      $this->lbAcct_manager->Caption = "<STRONG>Account manager:</STRONG> ({$account_manager}) {$email_account_manager}";
      $this->lbHR_manager->Caption = "<STRONG>Payroll:</STRONG> {$email_payroll_provider}";
      $this->lbOverview_payroll->Caption = 'Overview of payroll service';
      $this->lbOverview_payroll->link = $VirtualFile . '/docs/employees/payroll service overview.pdf';
      $this->lbAccounting_team->Caption = "<STRONG>Accounting:</STRONG> {$email_accounting_provider}";
      $this->lbOverview_accounting->Caption = 'Overview of accounting service';
      $this->lbOverview_accounting->link = $VirtualFile . '/docs/accounting/accounting service overview.pdf';
      $this->lbOur_phone->Caption = '<STRONG>Our phone:</STRONG> ' . $_SESSION['settings']['se_our_phone'];
    }

    function ten_most_recent_fileShow($sender, $params)
    {
      $this->Account_manager_inf();
    }

    function winInformationJSShow($sender, $params)
    {
        ?>
        //begin js
        document.getElementById( "winInformation" ).Maximize();
        //end
        <?php
    }

}

global $application;

global $ten_most_recent_file;

//Creates the form
$ten_most_recent_file=new ten_most_recent_file($application);

//Read from resource file
$ten_most_recent_file->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $ten_most_recent_file->show();

?>