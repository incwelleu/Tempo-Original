<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");

//Grid Bank
Define('COL_PRIMARY_ACCOUNT', 3);
Define('COL_NOTES', 4);
Define('COL_ONLINE_ACCESS', 5);
Define('COL_ACCOUNT_CD', 6);

//Class definition
class company_bank_account extends fmstrong
{
    public $SiteTheme = null;
    public $btnBankAccount = null;
    public $ImageList = null;
    public $gridBank_account = null;
    public $sqlCompany_bank_account = null;
    public $dsCompany_bank_account = null;
    public $rowBank = null;

    function company_bank_accountCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = ($_SESSION['company_id']==0) ? Title_Bank_Account : Title_Bank_Account . " (" . $_SESSION['short_name'] . ")";
      $this->lbTitle->Visible = True;

      $items['btnAdd'] = array(btnAdd, 1, "2");
      $items['btnDelete'] = array(btnDelete, 1, "6");
      $items['btnEdit'] = array(btnEdit, 1, "3");
      $items['btnSave'] = array(btnSave, 1, "5");
      $items['btnCancel'] = array(btnCancel, 1, "4");
      $this->btnBankAccount->Items = $items;

      Define('COL_NOTES', $this->gridBank_account->findColumnByName('notes'));
      $this->gridBank_account->Columns[COL_NOTES]->Visible = $_SESSION['IsSuperadmin'];
    }

    function gridBank_accountSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $company_id = isset($_SESSION['company_id']) ? $_SESSION['company_id'] : 0;

      $sql = "SELECT * FROM company_bank_account
              WHERE company_id = {$company_id} " ;

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .=  " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;


      $this->sqlCompany_bank_account->SQL = $sql;
    }

    function gridBank_accountJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowBank").value = row;
        //end
        <?php
    }

    function gridBank_accountInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1)
      {
        $fields = &$params[ 0 ];
        $fields[ 'company_id' ] = $_SESSION['company_id'];

      }
      else { //Update
          $fields = &$params[ 1 ];
          $fields[ 'bank_account_id' ] = $params[ 0 ];
      }

      $fields[ 'bank_account_name' ] = strtoupper($fields[ 'bank_account_name' ]);
      $fields[ 'iban_prefix_cd' ] = strtoupper($fields[ 'iban_prefix_cd' ]);
      $fields[ 'account_number_cd' ] = strtoupper($fields[ 'account_number_cd' ]);

      if (!$record = sw_get_company_accounting($fields[ 'company_id' ])){
          $record['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
          $record['account_bank'] = GLOBAL_ACCOUNT_BANK;
      }

      //checked account
      $account_code = (strlen(trim($fields[ 'account_cd' ]))!=0) ? $fields[ 'account_cd' ] : $record['account_bank'];
      $fields[ 'account_cd' ] = sw_check_account($account_code, $record['digit_account']);
      $this->Check_primary_account($fields);

      if (!$fields['bank_account_id']) {
          //Insert record
          sw_insert_table($this->gridBank_account->Datasource->DataSet->TableName, $fields);
      }
      else {
          //Update record
          $email_notify = array($_SESSION['settings']['se_hr_email'], $_SESSION['settings']['se_accounting_email'], $_SESSION['settings']['se_billing_email']);
          sw_update_table($this->gridBank_account->Datasource->DataSet->TableName, $fields, "bank_account_id = " . $fields['bank_account_id'], $email_from_notify );
      }
    }

    function Check_primary_account(&$fields)
    {
      Global $connectionDB;

      $sql = "SELECT is_primary_account_yn FROM company_bank_account
             WHERE (is_primary_account_yn = true) AND (company_id = {$fields['company_id']})";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = 0;
      $query->LimitCount = 1;
      $query->open();

      $fields['is_primary_account_yn'] = ($query->EOF) ? True : $fields['is_primary_account_yn'];

      if ((!$query->EOF) && ($fields['is_primary_account_yn'])) {
          $sql = "UPDATE company_bank_account
                  SET is_primary_account_yn = false
                  WHERE (is_primary_account_yn = true) AND (company_id = {$fields['company_id']})";

          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
      }
    }

    function gridBank_accountShow($sender, $params)
    {
      $this->gridBank_account->Columns[COL_ONLINE_ACCESS]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridBank_account->Columns[COL_ACCOUNT_CD]->Visible = $_SESSION['IsSuperadmin'];
    }

    function btnBankAccountJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowBank").value;

          if (toolButton == 'btnBankAccount'){
        		if (toolButtonName == 'btnFilter') {
          		gridBank_account.deselectAll();
							gridBank_account._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridBank_account->ajaxCall('filter_grid', array(), array($this->gridBank_account->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridBank_account.Insert(); return false;}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridBank_account.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridBank_account.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridBank_account.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
              if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>"); }
              else return false;
            }
          }
        //end
        <?php
    }

    function btnBankAccountClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnDelete")
      {
        $this->DeleteBankAccountSelected();
      }
    }

    function DeleteBankAccountSelected()
    {
      if (count($this->gridBank_account->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $bank_id    = $this->gridBank_account->SelectedPrimaryKeys;
        $bank_id = implode(",", $bank_id);

        if ($bank_id){
          $sql = "DELETE FROM company_bank_account WHERE bank_account_id in (" . $bank_id . ")";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridBank_account->writeSelectedCells(array());
        }
      }
    }

}

global $application;

global $company_bank_account;

//Creates the form
$company_bank_account=new company_bank_account($application);

//Read from resource file
$company_bank_account->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$company_bank_account->show();

?>