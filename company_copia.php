<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");
require_once("include/ziparchive.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");

//Grid Company
Define('COL_SHORT_NAME', 1);
Define('COL_COUNTRY', 2);
Define('COL_USERNAME', 3);
Define('COL_DATAHOUSE_ID', 4);
Define('COL_ACCT_MANAGER_ID', 5);
Define('COL_ACCOUNTING_ID', 6);
Define('COL_PAYROLL_ID', 7);
Define('COL_COMPANY_ID', 8);

set_time_limit(0);

//Class definition
class company extends fmstrong
{
    public $lbUser = null;
    public $user_id = null;
    public $btnCloseUser = null;
    public $btnSaveUser = null;
    public $dsUser = null;
    public $sqlUser = null;
    public $gridCompany = null;
    public $winParameter = null;
    public $company_id = null;
    public $rowCompany = null;
    public $btnCompany = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $winUser = null;

    function companyCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Company;
      $this->lbTitle->Visible = True;

      $items['btnDownloadCompanyFile'] = array(btnDownloadCompanyFile, 1);

      $this->btnCompany->Items = $items;
      $this->btnCompany->Visible = isset($items);

      if (isset($_POST['btnEnter_email']) || isset($_POST['btnClose_email'])){
        $this->winParameter->Include = "";
        $this->winParameter->Hide();
        if (isset($_POST['btnEnter_email'])){
	        $company_id = escapeshellcmd($this->gridCompany->SelectedPrimaryKeys[0]);
          $get_enter_email = $_POST['get_enter_email'];
          $server = $_SERVER['SERVER_NAME'];
          $cmd = "/cgi-bin/php5 {$_SERVER['PHPRC']}clientarea/include/download_all_company_files.php '{$company_id}' '{$get_enter_email}' '{$server}' >>{$_SERVER['PHPRC']}clientarea/tmp/out.txt &";
          system($cmd);
        }
      }

    }

    function gridCompanyShow($sender, $params)
    {
      Global $language;

      //Column Country
      $sql = "SELECT country.*, {$language} FROM country ORDER BY {$language}";
      $records = sw_records_array($sql, Array('country_id', $language));
      $this->gridCompany->Columns[COL_COUNTRY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridCompany->Columns[COL_COUNTRY]->FilterOptions = $records;
      $this->gridCompany->Columns[COL_COUNTRY]->TextField = $language;

      //Column Acct manager
      $sql = 'SELECT acct_manager_id, account_manager_name FROM vw_account_manager ORDER BY account_manager_name';
      $records = sw_records_array($sql, Array('acct_manager_id', 'account_manager_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_ACCT_MANAGER_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_ACCT_MANAGER_ID]->FilterOptions = $records;

      $sql = 'SELECT payroll_provider_id, payroll_provider_name FROM vw_payroll_manager ORDER BY payroll_provider_name';
      $records = sw_records_array($sql, Array('payroll_provider_id', 'payroll_provider_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_PAYROLL_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_PAYROLL_ID]->FilterOptions = $records;

      $sql = 'SELECT accounting_provider_id, accounting_provider_name FROM vw_accountant_manager ORDER BY accounting_provider_name';
      $records = sw_records_array($sql, Array('accounting_provider_id', 'accounting_provider_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->FilterOptions = $records;

      $this->gridCompany->Columns[COL_USERNAME]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_DATAHOUSE_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_PAYROLL_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_COMPANY_ID]->Visible = $_SESSION['IsSuperadmin'];
    }


    function gridCompanySQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      Global $language;

      $user_id = $_SESSION['user_id'];

      $this->gridCompany->ReadOnly = (!$_SESSION['IsSuperadmin']);

      $sql = "SELECT company.*, country.{$language}, user.username,
                     account_manager_name, payroll_provider_name, accounting_provider_name
              FROM company
              LEFT JOIN country ON company.country_id = country.country_id
              LEFT JOIN vw_account_manager ON company.acct_manager_id = vw_account_manager.acct_manager_id
              LEFT JOIN vw_payroll_manager ON company.payroll_provider_id = vw_payroll_manager.payroll_provider_id
              LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id
              LEFT JOIN user ON company.user_id = user.user_id ";

      if (!$_SESSION['IsSuperadmin']) {
         $sql .= " WHERE company.user_id = " . $user_id;
      }

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .=  $_SESSION['IsSuperadmin'] ? "WHERE " . $filterSql : " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlCompany->SQL = $sql;
    }


    function btnCompanyJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowCompany").value;

          if (toolButton == 'btnCompany'){
            if ((toolButtonName == 'btnDownloadCompanyFile')) {
              if ((row == "-1") || (row == "")) return false;
            }
          }

        //end
        <?php
    }


    function gridCompanyJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowCompany").value = row;
        document.getElementById("company_id").value = gridCompany.getSelectedPrimaryKey();
        //end
        <?php
    }


    function btnSaveUserJSClick($sender, $params)
    {
      echo $this->btnSaveUser->ajaxCall("btnSaveUserClick", array(), array("gridCompany", "user_id"));
        ?>
        //begin js
        document.getElementById( "winUser" ).Hide();
        return false;
        //end
        <?php
    }

    function btnSaveUserClick($sender, $params)
    {

      if (count($this->gridCompany->SelectedPrimaryKeys) > 0) {

        Global $connectionDB;
        $user_id = $this->user_id->SelectedValue ? $this->user_id->SelectedValue : 0;

        //Extract user_id of Client admin
        $company_id    = $this->gridCompany->SelectedPrimaryKeys;
        $company_id = implode(",", $company_id);

        if ($company_id){
          $sql = "Update company Set user_id = " . $user_id . " Where company_id in (" . $company_id . ")";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
        }
      }
    }

    function btnCloseUserJSClick($sender, $params)
    {
        ?>
        //begin js
        document.getElementById( "winUser" ).Hide();
        return false;
        //end
        <?php
    }


    function btnCompanyClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == 'btnFilter') {
        $this->Filter_data();
      }else if ($toolButtonName == "btnDelete")
      {
        $this->DeleteCompanySelected();
        $this->gridCompany->SelectedCells = array();
      }
      else if (($toolButtonName == 'btnAccounting')) {
        if ($this->company_id->Value){
          $this->winParameter->Caption = 'Accounting parameters';
          $this->winParameter->Width = 760;
          $this->winParameter->height = 510;
          $this->winParameter->Include = "company_parameter.php";
          $this->winParameter->ShowModal();
        }
      }
      else if (($toolButtonName == 'btnDownloadCompanyFile')) {
        if ($this->gridCompany->SelectedPrimaryKeys[0]){
          $this->winParameter->Caption = 'Enter email';
          $this->winParameter->Width = 475;
          $this->winParameter->height = 125;
          $this->winParameter->Include = "include/enter_email.php";
          $this->winParameter->ShowModal();
        }
      }
    }

    function Filter_data()
    {
      foreach( $this->gridCompany->Columns as $Columna )
      {
        $Columna->Filter = "";
      }
      $this->gridCompany->Header->ShowFilterBar = !$this->gridCompany->Header->ShowFilterBar;
      return false;
    }

    function DeleteCompanySelected()
    {
      if (count($this->gridCompany->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $company_id    = $this->gridCompany->SelectedPrimaryKeys;
        $company_id = implode(",", $company_id);

        if ($company_id){
          $sql = "DELETE company
                  FROM company
	                      LEFT JOIN invoice_issued ON company.company_id = invoice_issued.company_id
   	                    LEFT JOIN invoice_received ON company.company_id = invoice_received.company_id
                  WHERE company.company_id in (" . $company_id . ") AND (invoice_received.company_id is null) AND (invoice_issued.company_id is null)";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
        }
      }
    }

    function gridCompanyRowEdited($sender, $params)
    {
      //Insert
      $fields = &$params[ 0 ];
      if (!$fields[ 'company_id' ]) $fields[ 'company_id' ] = 0;
      $fields[ 'short_name' ] = strtolower($fields[ 'short_name' ]);

      //Valid username and short_name
      if ($fields['short_name']) {
        $msg = sw_valid_short_name($fields['company_id'], $fields['short_name']);
      }

      $msg .= sw_valid_legacy_datahouse($fields['legacy_datahouse_id'], $fields['company_id']);

      if ($msg) {
        $this->msgError->Value = $msg;
      }

      return (!$msg);
    }


    function gridCompanyInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1)
      {
        $fields = &$params[ 0 ];
        if (!$_SESSION['IsSuperadmin']) {
          $fields[ 'user_id' ] = $_SESSION['parent_user_id'] != 0 ? $$_SESSION['parent_user_id'] : $_SESSION['user_id'];
        }
      }
      else { //Update
          $fields = &$params[ 1 ];
          $fields[ 'company_id' ] = $params[ 0 ];
      }

      $fields[ 'short_name' ] = strtolower($fields[ 'short_name' ]);

      if (!$fields['company_id']) {
          //Insert record
          sw_insert_table($this->gridCompany->Datasource->DataSet->TableName, $fields);
      }
      else {
          //Update record
          sw_update_table($this->gridCompany->Datasource->DataSet->TableName, $fields, "company_id = " . $fields['company_id'] );
      }
    }

}

global $application;

global $company;

//Creates the form
$company=new company($application);

//Read from resource file
$company->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company->show();

?>