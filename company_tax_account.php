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
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");

session_start();

//Class definition
class company_tax_account extends fmstrong
{
    public $company_code_accounting = null;
    public $btnSave = null;
    public $cbDefault_account = null;
    public $accountant_period_last_closed_dt = null;
    public $lbAccountant_period_last_closed_dt = null;
    public $lbDefault_tax_rate = null;
    public $lbTax_regime = null;
    public $lbDigit_account = null;
    public $tax_rate_id = null;
    public $digit_account = null;
    public $lbAccount_provider = null;
    public $lbAccount_client = null;
    public $account_client = null;
    public $account_provider = null;
    public $tax_regime_id = null;
    public $gbIncomeAccounts = null;
    public $lbAccount_sale = null;
    public $account_sale = null;
    public $lbAccount_sale_within_europe = null;
    public $account_sale_within_europe = null;
    public $lbAccount_sale_outside_europe = null;
    public $account_sale_outside_europe = null;
    public $lbAccount_transport = null;
    public $account_transport = null;
    public $lbOther_income = null;
    public $account_other_income = null;
    public $lbaccount_client_withholding = null;
    public $account_client_withholding = null;
    public $gridCompany_tax_account = null;
    public $btnTaxAccount = null;
    public $rowSelected = null;
    public $winUpload = null;
    public $gbParameter = null;
    public $col_accounting_code = null;
    public $lbAccounting_code = null;
    public $lbBeginning_row = null;
    public $lbType_operation = null;
    public $lbTax_rate = null;
    public $col_type_operation = null;
    public $col_tax_rate = null;
    public $beginning_row = null;
    public $btnCloseUpload = null;
    public $btnImport = null;
    public $lbError = null;
    public $Upload_accounting = null;
    public $ImageList = null;
    public $SiteTheme = null;
    public $sqlCompany_tax_account = null;
    public $dsCompany_tax_account = null;
    public $sqlTax_type_key = null;
    public $dsTax_type_key = null;
    public $sqlTax_rate = null;
    public $dsTax_rate = null;
    public $sqlTax_regime = null;
    public $dsTax_regime = null;
    public $btnClose = null;
    public $lbCompanyCodeAccounting = null;


    function company_tax_accountCreate($sender, $params)
    {
      Global $acceso;

      //Evaluated if the user has logged session
      $acceso->sw_login_check();

      sw_style_selected($this);

      $this->CompanyAccountingParameter();
      $this->ParameterCompanyTaxAccount();
      $this->CreateGridAccount();
    }


    function CompanyAccountingParameter()
    {
      Global $company;

      $this->lbTitle->Caption = Title_Parameters_Accounting;
      $this->lbTitle->Visible = True;

      if ($company_id = $_SESSION['company_id']) {
        $record_accounting = sw_get_company_accounting($company_id);

        if (($company_id != 0) && (!$record_accounting['company_id'])){
          //Erase position 0, 1 of array
          $record = array_slice($record_accounting, 0, 2);
          $record_accounting = array_slice($record_accounting, 2);

          $record_accounting['company_id'] = $company_id;
          $record_accounting['tax_rate_id'] = '0';
          $record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
          $record_accounting['accountant_period_last_closed_dt'] = date('Y-m-d');

          $record_accounting['account_client'] = GLOBAL_ACCOUNT_CLIENT;
          $record_accounting['account_sale'] = GLOBAL_ACCOUNT_SALE;
          $record_accounting['account_provider'] = GLOBAL_ACCOUNT_PROVIDER;
          $record_accounting['account_client_withholding'] = GLOBAL_ACCOUNT_CLIENT_WITHHOLDING;

          //Insert record
          sw_insert_table("company_accounting", $record_accounting);
          $record_accounting = array_merge($record, $record_accounting);
        }

        $sql = "SELECT * FROM tax_regime
                WHERE country_id = {$record_accounting['country_id']}
                ORDER BY regime_name";
        $this->tax_regime_id->Items = sw_records_array($sql, array("tax_regime_id","regime_name"));
        $this->tax_regime_id->ItemIndex = $record_accounting['tax_regime_id'];


        $sql = "SELECT * FROM tax_rate
                WHERE tax_regime_id = {$record_accounting['tax_regime_id']}
                ORDER BY rate_no";
        $this->tax_rate_id->Items = sw_records_array($sql, array("tax_rate_id","rate_no"));

        if (($_POST['btnCompanySubmitEvent']!=='btnCompany_btnSave')) {
          $this->tax_rate_id->ItemIndex = $record_accounting['tax_rate_id'];

          $this->digit_account->Text = $record_accounting['digit_account'];
          $this->accountant_period_last_closed_dt->Date = $record_accounting['accountant_period_last_closed_dt'] ? $record_accounting['accountant_period_last_closed_dt'] : null;
          $this->account_client->text = $record_accounting['account_client'];
          $this->account_provider->text = $record_accounting['account_provider'];
          $this->account_sale->text = $record_accounting['account_sale'];
          $this->account_sale_within_europe->text = $record_accounting['account_sale_within_europe'];
          $this->account_sale_outside_europe->text = $record_accounting['account_sale_outside_europe'];
          $this->account_other_income->text = $record_accounting['account_other_income'];
          $this->account_transport->text = $record_accounting['account_transport'];
          $this->account_client_withholding->text = $record_accounting['account_client_withholding'];
					$this->company_code_accounting->Text = $record_accounting['company_code_accounting'];
        }
      }
    }


    function ParameterCompanyTaxAccount()
    {
      $company_id = $_SESSION['company_id'];

      //Create Button
      $items['btnAdd'] = array(btnAdd, $company_id, "1");
      $items['btnDelete'] = array(btnDelete, $company_id, "5");
      $items['btnEdit'] = array(btnEdit, $company_id, "2");
      $items['btnSave'] = array(btnSave, $company_id, "4");
      $items['btnCancel'] = array(btnCancel, $company_id, "3");
      $items['btnTaxAccountDefault'] = array(btnTaxAccountDefault, $company_id);
      $items['btnImportExcel'] = array(btnImportExcel, $company_id);
      $this->btnTaxAccount->Items = $items;

      $this->sqlTax_type_key->close();
      $this->sqlTax_type_key->Params = array($_SESSION['country_id']);
      $this->sqlTax_type_key->open();

      $this->sqlTax_rate->close();
      $this->sqlTax_rate->Params = array($_SESSION['country_id']);
      $this->sqlTax_rate->open();

      $this->sqlCompany_tax_account->close();
      $this->sqlCompany_tax_account->Params = array($company_id);
      $this->sqlCompany_tax_account->open();
    }

    function CreateGridAccount()
    {
    	if ($this->gridCompany_tax_account->inSession('')) return false;

    	$this->gridCompany_tax_account->Columns = array();
			$col1 = new JTPlatinumGridTextColumn( $this->gridCompany_tax_account );
			$col1->Caption = SW_CAPTION_ACCOUNT_CD;
			$col1->DataField = 'account_cd';
			$col1->Name = $col1->DataField;
      $col1->Width = 100;

			$col2 = new JTPlatinumGridTextColumn( $this->gridCompany_tax_account );
			$col2->Caption = SW_CAPTION_TAX_TYPE;
			$col2->DataField = 'tax_type_key_id';
			$col2->Name = $col2->DataField;
      $col2->EditorType = 'LookupComboBox';
      $col2->LookupComboBoxEditor->Datasource = $this->dsTax_type_key;
      $col2->LookupComboBoxEditor->TextField = 'tax_type_name';
      $col2->LookupComboBoxEditor->ValueField = 'tax_type_key_id';
			$col2->TextField = 'tax_type_name';
      $col2->Width = 300;

			$col3 = new JTPlatinumGridTextColumn( $this->gridCompany_tax_account );
			$col3->Caption = SW_CAPTION_TAX_RATE;
			$col3->DataField = 'tax_rate_id';
			$col3->Name = $col3->DataField;
      $col3->EditorType = 'LookupComboBox';
      $col3->LookupComboBoxEditor->Datasource = $this->dsTax_rate;
      $col3->LookupComboBoxEditor->TextField = 'tax_description';
      $col3->LookupComboBoxEditor->ValueField = 'tax_rate_id';
			$col3->TextField = 'rate_no';
      $col3->Alignment = 'agRight';
      $col3->Width = 100;

			$col4 = new JTPlatinumGridTextColumn( $this->gridCompany_tax_account );
			$col4->Caption = 'company_id';
			$col4->DataField = 'company_id';
			$col4->Name = 'company_id';
      $col4->Visible = false;

			$col5 = new JTPlatinumGridTextColumn( $this->gridCompany_tax_account );
			$col5->Caption = 'company_tax_account_id';
			$col5->DataField = 'company_tax_account_id';
			$col5->Name = 'company_tax_account_id';
      $col5->Visible = false;

    	$this->gridCompany_tax_account->Columns = array( $col1, $col2, $col3, $col4, $col5 );
      $this->gridCompany_tax_account->init();
    }


    function btnTaxAccountJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowSelected").value;

          if (toolButton == 'btnTaxAccount'){
            if (toolButtonName == 'btnAdd') { gridCompany_tax_account.Insert(); return false;}
            if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridCompany_tax_account.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridCompany_tax_account.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany_tax_account.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnImportExcel') {document.getElementById( "winUpload" ).ShowModal(); return false;}
          }
        //end
        <?php
    }

    function gridCompany_tax_accountJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowSelected").value = row;
        //end
        <?php
    }

    function gridCompany_tax_accountUpdate($sender, $params)
    {
      $key = $sender->KeyField;
      $table = $sender->Datasource->DataSet->TableName;
      //Insert
      if (count($params) == 1) $fields = &$params[ 0 ];
      else { // Update
          $fields = &$params[ 1 ];
          $fields[ $key ] = $params[ 0 ];
      }

      $company_id = $_SESSION['company_id'];
      if (!$record = sw_get_company_accounting($company_id)){
          $record['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
      }

      //checked account
      $fields[ 'account_cd' ] = $fields[ 'account_cd' ] ? sw_check_account($fields[ 'account_cd' ], $record['digit_account']) : "";
      $fields[ 'company_id' ] = $company_id;

      if (!$fields[ $key ]) {
          sw_insert_table($table, $fields);
      }
      else {
        sw_update_table($table, $fields, $key . " = " . $fields[$key]);
      }
    }

    function btnCloseUploadJSClick($sender, $params)
    {
        ?>
        //begin js
          document.getElementById( "winUpload" ).Hide();
        //end
        <?php
    }


    function btnImportClick($sender, $params)
    {
      $msg = "";
      if($return = $this->Upload_accounting->isUploadedFile())
      {
        if (strtoupper($this->Upload_accounting->FileExt) == 'XLS' || strtoupper($this->Upload_accounting->FileExt) == 'XLSX')
        {
          Global $TempDir;

          $dir = $TempDir;

          if (!file_exists($dir))
          {
            if (!mkdir($dir)) {
              $msg = "Directory is not create";
              return false;
            }
          }

          $file = $dir . "/upload_vat_account_" . $_SESSION['company_id'] . "." . $this->Upload_accounting->FileExt;
          $this->Upload_accounting->moveUploadedFile($file);
        }
        else { $msg = "The selected file must be in excel format"; }
      }
      else { $msg = "Error in file import"; }

      if ($msg) {
        $this->lbError->Caption = $msg;
        return false;
      }

      $this->DataImport($file);
    }

    function DataImport($file)
    {
      require_once('include/PHPExcel.php');

      $company_id = $_SESSION['company_id'];

      $objPHPExcel = PHPExcel_IOFactory::load($file);
      $worksheet = $objPHPExcel->getActiveSheet();
      $rows = $worksheet->getHighestRow();

      $col_accounting_code = $this->col_accounting_code->ItemIndex;
      $col_type_operation = $this->col_type_operation->ItemIndex;
      $col_tax_rate = $this->col_tax_rate->ItemIndex;

      $beginning_row = $this->beginning_row->Text;

      for ($row = (($beginning_row) ? $beginning_row : 2); $row <= $rows; $row++)
      {
        $account_cd     = ($col_accounting_code) ? substr(trim($worksheet->getCellByColumnAndRow($col_accounting_code - 1, $row)->getCalculatedValue()), 0, 12) : "";
        $type_operation = ($col_type_operation) ? substr(trim($worksheet->getCellByColumnAndRow($col_type_operation - 1, $row)->getCalculatedValue()), 0, 5) : "";
        $tax_rate       = ($col_tax_rate) ? substr(trim($worksheet->getCellByColumnAndRow($col_tax_rate - 1, $row)->getCalculatedValue()), 0, 5) : "";

        if (strlen($account_cd) != 0 && strlen($type_operation) != 0 && strlen($tax_rate) != 0){
          if ((!$this->btnImport->tag) &&
              ($tax_type_key = sw_get_data_table('tax_type_key', "(tax_type_cd = '{$type_operation}') AND (country_id = {$_SESSION['country_id']})")) &&
              ($tax_rate = sw_get_data_table('tax_rate', "(rate_no = {$tax_rate}) AND (tax_regime_id = {$_SESSION['tax_regime_id']})"))){

            if (!$record = sw_get_data_table('company_tax_account', "(company_id = {$company_id}) AND (account_cd = '{$accound_cd}')")) {
              $record['company_id'] = $company_id;
              $record['account_cd'] = $account_cd;
            }
            $record['tax_type_key_id'] = $tax_type_key['tax_type_key_id'];
            $record['tax_rate_id'] = $tax_rate['tax_rate_id'];

            if (!$record['company_tax_account_id'])
                sw_insert_table("company_tax_account", $record);
            else {
              $sql .= " AND company_tax_account_id = {$record['company_tax_account_id']}";
              sw_update_table("company_tax_account", $record, $sql);
            }
	        }
        }
      }

      if (file_exists($file)) unlink($file);
      Unset($worksheet);
      Unset($objPHPExcel);
    }

    function btnTaxAccountClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnDelete")
      {
        sw_delete_record_grid($this->gridCompany_tax_account);
      }else if ($toolButtonName == "btnTaxAccountDefault")
      {
        $this->TaxAccountDefault();
      }
    }

    function TaxAccountDefault()
    {
			Global $GLOBAL_TAX_ACCOUNT;

      $tax_account = $GLOBAL_TAX_ACCOUNT[$this->tax_regime_id->ItemIndex];
      foreach ($tax_account as $account){
      	$tax_rate = sw_get_data_table('tax_rate', "(tax_regime_id = {$this->tax_regime_id->ItemIndex}) AND (rate_no = {$account['rate_no']})");
				$company_tax_account = sw_get_data_table( "company_tax_account", "(tax_rate_id = {$tax_rate['tax_rate_id']}) AND (tax_type_key_id = {$account['tax_type_key_id']}) AND (company_id = {$_SESSION['company_id']})");

      	if ($tax_rate && !$company_tax_account) {
        	$company_tax_account['company_id'] = $_SESSION['company_id'];
        	$company_tax_account['tax_type_key_id'] = $account['tax_type_key_id'];
        	$company_tax_account['tax_rate_id'] = $tax_rate['tax_rate_id'];
        	$company_tax_account['account_cd'] = sw_check_account($account['account_cd'], $this->digit_account->Text);
        	sw_insert_table("company_tax_account", $company_tax_account);
        }
      }
    }

    function tax_regime_idChange($sender, $params)
    {
      $this->sqlTax_rate->close();
      $this->sqlTax_rate->Params = array($this->tax_regime_id->ItemIndex);
      $this->sqlTax_rate->open();

      $sql = "SELECT * FROM tax_rate
              WHERE tax_regime_id = {$this->tax_regime_id->ItemIndex}
              ORDER BY rate_no";
      $this->tax_rate_id->Items = sw_records_array($sql, array("tax_rate_id","rate_no"));
    }

    function btnSaveClick($sender, $params)
    {
      $this->account_client->text = $_POST['account_client'] = $_POST['account_client'] ? sw_check_account($_POST['account_client'], $_POST['digit_account']) : "";
      $this->account_sale->text = $_POST['account_sale'] = $_POST['account_sale'] ? sw_check_account($_POST['account_sale'], $_POST['digit_account']) : "";
      $this->account_sale_within_europe->text = $_POST['account_sale_within_europe'] = $_POST['account_sale_within_europe'] ? sw_check_account($_POST['account_sale_within_europe'], $_POST['digit_account']) : "";
      $this->account_sale_outside_europe->text = $_POST['account_sale_outside_europe'] = $_POST['account_sale_outside_europe'] ? sw_check_account($_POST['account_sale_outside_europe'], $_POST['digit_account']) : "";
      $this->account_other_income->text = $_POST['account_other_income'] = $_POST['account_other_income'] ? sw_check_account($_POST['account_other_income'], $_POST['digit_account']) : "";
      $this->account_transport->text = $_POST['account_transport'] = $_POST['account_transport'] ? sw_check_account($_POST['account_transport'], $_POST['digit_account']) : "";
      $this->account_provider->text = $_POST['account_provider'] = $_POST['account_provider'] ? sw_check_account($_POST['account_provider'], $_POST['digit_account']) : "";
      $this->account_client_withholding->text = $_POST['account_client_withholding'] = $_POST['account_client_withholding'] ? sw_check_account($_POST['account_client_withholding'], $_POST['digit_account']) : "";

      $where = "company_id = {$_SESSION['company_id']}";
      sw_update_table("company_accounting", $_POST, $where);
      sw_update_table("company", $_POST, $where);
    }


    function btnSaveJSClick($sender, $params)
    {
    	  echo $this->btnSave->ajaxCall("btnSaveClick");
        ?>
        //begin js
        gridCompany_tax_account.Post();
        //end
        <?php
    }
}

global $application;

global $company_tax_account;

//Creates the form
$company_tax_account=new company_tax_account($application);

//Read from resource file
$company_tax_account->loadResource(__FILE__);

//header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$company_tax_account->show();

?>