<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");


//Class definition
class company_provider extends fmstrong
{
    public $record_accounting = null;
    public $lbMessage_merge = null;
    public $dsMerge_provider = null;
    public $sqlMerge_provider = null;
    public $btnProvider = null;
    public $col_provider_name = null;
    public $col_accounting_code = null;
    public $lbBeginning_row = null;
    public $beginning_row = null;
    public $lbAccounting_code = null;
    public $lbProvider_name = null;
    public $lbTax_id = null;
    public $btnImport = null;
    public $Upload = null;
    public $btnClose = null;
    public $winUpload = null;
    public $gridCompany_provider = null;
    public $company_id = null;
    public $SiteTheme = null;
    public $sqlCompany_provider = null;
    public $dsCompany_provider = null;
    public $gbParameter = null;
    public $col_tax_ident = null;
    public $ImageList = null;
    public $rowProvider = null;
    public $winMergeProvider = null;
    public $btnCloseMerge = null;
    public $btnSaveMerge = null;
    public $lbSourceProvider = null;
    public $lbTargetProvider = null;
    public $cbSourceProvider = null;
    public $cbTargetProvider = null;
    public $sqlTax_type_key = null;
    public $dsTax_type_key = null;
    public $winTypeTax = null;
    public $lbTypeInputTax = null;
    public $btnSaveInputTax = null;
    public $btnCloseInputTax = null;
    public $tax_type_key_id = null;

    function company_providerCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterCompanyAccounting();
    }


    function ParameterCompanyAccounting()
    {
      Define('COL_TAX_IDENT', $this->gridCompany_provider->findColumnByName('tax_ident'));
      Define('COL_PROVIDER_NAME', $this->gridCompany_provider->findColumnByName('provider_name'));
      Define('COL_COUNTRY', $this->gridCompany_provider->findColumnByName('country_id'));
      Define('COL_POSTAL_CD', $this->gridCompany_provider->findColumnByName('postat_cd'));
      Define('COL_EXPENSE', $this->gridCompany_provider->findColumnByName('expense_type_id'));
      Define('COL_TYPE_TAX', $this->gridCompany_provider->findColumnByName('tax_type_key_id'));
      Define('COL_ACCOUNT', $this->gridCompany_provider->findColumnByName('account_cd'));
      Define('COL_ACCOUNT_EXPENSE', $this->gridCompany_provider->findColumnByName('account_expense_cd'));
      Define('COL_OTHER_EXPENSE', $this->gridCompany_provider->findColumnByName('account_other_expense_cd'));
      Define('COL_WITHHOLDING', $this->gridCompany_provider->findColumnByName('account_withholding_cd'));

      $this->record_accounting = sw_get_company_accounting($_SESSION['company_id']);

      $this->lbTypeInputTax->Caption = SW_CAPTION_TYPE_INPUT_TAX;
      $this->winTypeTax->Caption = SW_CAPTION_TYPE_INPUT_TAX;
      $this->btnCloseMerge->Caption = btnCancel;
      $this->btnClose->Caption = btnCancel;
      $this->btnCloseInputTax->Caption = btnCancel;
      $this->btnSaveMerge->Caption = btnSave;
      $this->btnImport->Caption = btnSave;
      $this->btnSaveInputTax->Caption = btnSave;

      $company_id = 0;
      if (isset($_SESSION['company_id'])) {
          $company_id = $_SESSION['company_id'];
      }
      $enable = ($company_id != 0);
      $visible = ($enable && ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']));

      $this->lbTitle->Caption = $enable ? Title_Provider . " (" . $_SESSION['short_name'] . ")" : Title_Provider;
      $this->lbTitle->Visible = True;

      $sql = "SELECT * FROM tax_type_key
              WHERE (type_tax_cd = " . GLOBAL_INPUT_TAX . ") AND (visible_yn = True) AND (country_id = {$_SESSION['country_id']})";
      $this->sqlTax_type_key->close();
      $this->sqlTax_type_key->SQL = $sql;
      $this->sqlTax_type_key->open();

      $this->sqlMerge_provider->close();
      $this->sqlMerge_provider->Params = array($company_id);
      $this->sqlMerge_provider->open();
      $this->winMergeProvider->Caption = btnMergeProvider;
      $this->cbSourceProvider->SelectedValue = -1;
      $this->cbTargetProvider->SelectedValue = -1;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      $items['btnSave'] = array(btnSave, $enable, "5");
      $items['btnCancel'] = array(btnCancel, $enable, "4");
      $items['btnMergeProvider'] = array(btnMergeProvider, $enable);

      $this->gridCompany_provider->ReadOnly = !$enable;
      $this->gridCompany_provider->Columns[COL_ACCOUNT]->Visible = $visible;
      $this->gridCompany_provider->Columns[COL_ACCOUNT_EXPENSE]->Visible = $visible;
      $this->gridCompany_provider->Columns[COL_OTHER_EXPENSE]->Visible = $visible;
      $this->gridCompany_provider->Columns[COL_WITHHOLDING]->Visible = $visible;
      $this->gridCompany_provider->Columns[COL_TYPE_TAX]->Visible = $visible;
      if ($_SESSION['IsSuperadmin']){
        $items['btnUpdateProviderInvoice'] = array(btnUpdateProviderInvoice, $enable);
        $items['btnImportProvider'] = array(btnImportExcel, $enable);
        $items['btnImportAccounting'] = array(btnImportAccounting, $enable);
        $items['btnChangeTypeTax'] = array(btnChangeTypeTax, $enable);
      }

      if (isset($_SESSION['page_return'])) {
//          $items['btnReturnPage'] = array(btnReturnPage, ($_SESSION['company_id'] != 0));
      }
      $this->btnProvider->Items = $items;
    }

    function gridCompany_providerSQL($sender, $params)
    {
      Global $language;

      list( $sortSql, $sortFields, $filterSql) = $params;

      if (strpos($filterSql, 'account_') !== False){
        foreach ($sender->Columns as $Column){
          if ($Column->Filter && strpos($Column->DataField, 'account_') !== False){
            $account_cd = sw_check_account($Column->Filter, $this->record_accounting['digit_account']);
            $filterSql = str_replace("{$Column->DataField} LIKE '%{$Column->Filter}%'","{$Column->DataField} LIKE '%{$account_cd}%'",$filterSql);
            $Column->Filter = $account_cd;
          }
        }
      }

      $sql = "SELECT company_provider.*, country.country_name, expense_type.expense_name, tax_type_key.tax_type_name
              FROM company_provider
              LEFT JOIN tax_type_key ON company_provider.tax_type_key_id = tax_type_key.tax_type_key_id
              LEFT JOIN (SELECT country_id, country.{$language} AS country_name FROM country) AS country ON company_provider.country_id = country.country_id
              LEFT JOIN (SELECT expense_type_id, expense_type.{$language} AS expense_name FROM expense_type) AS expense_type ON company_provider.expense_type_id = expense_type.expense_type_id
              WHERE (company_id = {$_SESSION['company_id']})";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlCompany_provider->SQL = $sql;
    }


    function gridCompany_providerInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1) $fields = &$params[ 0 ];
      else {  //Update
          $fields = &$params[ 1 ];
          $fields[ 'company_provider_id' ] = $params[ 0 ];
      }

      $company_id = $_SESSION['company_id'];
      if (!$record = sw_get_company_accounting($company_id)){
          $record['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
          $record['account_provider'] = GLOBAL_ACCOUNT_PROVIDER;
      }

      //checked account
      $fields[ 'account_cd' ] = $fields[ 'account_cd' ] ? sw_check_account($fields[ 'account_cd' ], $record['digit_account']) : "";
      $fields[ 'account_expense_cd' ] = ($fields[ 'account_expense_cd' ]) ? sw_check_account($fields[ 'account_expense_cd' ], $record['digit_account']) : "";
      $fields[ 'account_other_expense_cd' ] = ($fields[ 'account_other_expense_cd' ]) ? sw_check_account($fields[ 'account_other_expense_cd' ], $record['digit_account']) : "";
      $fields[ 'account_withholding_cd' ] = ($fields[ 'account_withholding_cd' ]) ? sw_check_account($fields[ 'account_withholding_cd' ], $record['digit_account']) : "";
      $fields[ 'company_id' ] = $company_id;
      $fields[ 'tax_ident' ] = sw_clean_caracter_tax_ident($fields[ 'tax_ident' ]);
      $fields[ 'provider_name' ] = strtoupper($fields[ 'provider_name' ]);

      if (!$fields[ 'company_provider_id' ]) {
      		$record['created_by_user_id']  = $_SESSION['user_id'];
          $record['created_dt'] = date('Y-m-d H:i:s');
          sw_insert_table($this->gridCompany_provider->Datasource->DataSet->TableName, $fields);
      }
      else {
        sw_update_table("company_provider", $fields, "company_provider_id = {$fields['company_provider_id']}");
      }
    }


    function ValidTax_Id($sender, $params)
    {
      $fields = &$params[ 0 ];

      $tax_ident = sw_clean_caracter_tax_ident($fields['tax_ident']);
			$company_provider_id = $fields['company_provider_id'];
      $company_id = $_SESSION['company_id'];
      $msg = "";
      if (!$tax_ident) {
         $msg = "Tax Id can not be empty</br>";
      }
      else {
        $sql = "(tax_ident = '{$tax_ident}') AND (company_id = {$company_id})";
        $sql .= ($company_provider_id) ? " AND (company_provider_id != {$company_provider_id})" : "";
        if ($record = sw_get_data_table('company_provider', $sql))
          $msg = "Tax Id: {$tax_ident} - {$record['provider_name']}, is already created <br/>";
      }

      $this->msgError->Value = $msg;
      return $msg;
    }


    function Deleteproviderselected()
    {
      if (count($this->gridCompany_provider->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $provider = implode(",", $this->gridCompany_provider->SelectedPrimaryKeys);

        $sql = "DELETE company_provider FROM company_provider LEFT JOIN invoice_received " .
	             "ON company_provider.company_provider_id = invoice_received.company_provider_id " .
               "WHERE (invoice_received.company_provider_id IS NULL) AND (company_provider.company_provider_id IN ({$provider})) ";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_provider->writeSelectedCells(array());
      }
    }


    function btnImportClick($sender, $params)
    {
      $msg = "";
      if($return = $this->Upload->isUploadedFile())
      {
        if (strtoupper($this->Upload->FileExt) == 'XLS' || strtoupper($this->Upload->FileExt) == 'XLSX')
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

          $file = $dir . "/provider_" . $_SESSION['company_id'] . "." . $this->Upload->FileExt;
          $this->Upload->moveUploadedFile($file);
        }
        else {  $msg = "The selected file must be in excel format"; }
      }
      else { $msg = "Error in file import"; }

      if ($msg) {
        $this->msgError->Value = $msg;
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

      $col_tax_ident = $this->col_tax_ident->ItemIndex;
      $col_provider_name = $this->col_provider_name->ItemIndex;
      $col_accounting_code = $this->col_accounting_code->ItemIndex;
      $beginning_row = $this->beginning_row->position;

      for ($row = (($beginning_row) ? $beginning_row : 2); $row <= $rows; $row++)
      {
        $tax_ident      = ($col_tax_ident) ? substr(trim($worksheet->getCellByColumnAndRow($col_tax_ident - 1, $row)->getCalculatedValue()), 0, 20) : "";
        $tax_ident      = sw_clean_caracter_tax_ident($tax_ident);
        $provider_name  = ($col_provider_name) ? substr(trim($worksheet->getCellByColumnAndRow($col_provider_name - 1, $row)->getCalculatedValue()), 0, 200) : "";
        $account_cd     = ($col_accounting_code) ? substr(trim($worksheet->getCellByColumnAndRow($col_accounting_code - 1, $row)->getCalculatedValue()), 0, 12) : "";

        if (strlen($tax_ident) != 0){
          //accounting parameter
          if (!$this->record_accounting) {
              $this->record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
              $this->record_accounting['account_provider'] = GLOBAL_ACCOUNT_PROVIDER;
          }
          $account_cd = ($account_cd == "") && (trim($this->record_accounting['account_provider']) != "") ? $this->record_accounting['account_provider'] : $account_cd;

          //$sql = "(company_id = {$company_id}) AND (tax_ident = '{$tax_ident}') ";
          $sql = "(company_id = {$company_id}) AND (tax_ident LIKE '%{$tax_ident}%') ";
          $record = sw_get_data_table('company_provider', $sql);

          if (!$this->btnImport->tag){
              $record['company_id'] = $company_id;
              $record['tax_ident']  = $tax_ident;
              $record['provider_name'] = strtoupper($provider_name);
              $record['account_cd'] = ($account_cd!="") ? $account_cd : $record['account_cd'];
              $record['country_id'] = sw_country_tax_ident($record['tax_ident']);

              if (!$record['company_provider_id'])
                  sw_insert_table("company_provider", $record);
              else {
                 $sql .= " AND company_provider_id = {$record['company_provider_id']}";
                 sw_update_table("company_provider", $record, $sql);
              }
          }
          else if ($record['company_provider_id']){
              //accounting parameter
              if (!$this->record_accounting) {
                $this->record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
                $this->record_accounting['account_provider'] = GLOBAL_ACCOUNT_PROVIDER;
              }
              $account_cd = ($account_cd == "") && ($this->record_accounting['account_provider'] != "") ? $this->record_accounting['account_provider'] : $account_cd;
              $record['account_cd'] = ($account_cd!="") ? $account_cd : $record['account_cd'];
              $sql .= " AND company_provider_id = {$record['company_provider_id']}";
              sw_update_table("company_provider", $record, $sql);
          }
	      }
      }

      if (file_exists($file)) unlink($file);
      Unset($worksheet);
      Unset($objPHPExcel);
      $this->winUpload->Hide();
    }


    function gridCompany_providerDelete($sender, $params)
    {
      $fields = &$params[ 0 ];
      $company_provider_id = $fields[ 0 ];

      if (!$record = sw_get_data_table("invoice_received", "company_provider_id = {$company_provider_id}")) {
          sw_delete_table("company_provider", "company_provider_id = {$company_provider_id}");
      }
    }



    function btnCloseJSClick($sender, $params)
    {
        ?>
          document.getElementById( "winUpload" ).Hide();
          return true;
        <?php
    }

    function btnCloseClick($sender, $params)
    {
      $this->winUpload->Hide();
    }

    function btnProviderJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbUpdateProviderInvoiceMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowProvider").value;

          if (toolButton == 'btnProvider'){
        		if (toolButtonName == 'btnFilter') {
          		gridCompany_provider.deselectAll();
							gridCompany_provider._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridCompany_provider->ajaxCall('filter_grid', array(), array($this->gridCompany_provider->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridCompany_provider.Insert(); return false;}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridCompany_provider.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridCompany_provider.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany_provider.Post(); return false;}
            else if ((toolButtonName == 'btnDelete') && (row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
            else if (toolButtonName == 'btnUpdateProviderInvoice') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbUpdateProviderInvoiceMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnMergeProvider') { document.getElementById( "winMergeProvider" ).ShowModal(); return false; }
            else if (toolButtonName == 'btnChangeTypeTax') { document.getElementById( "winTypeTax" ).ShowModal(); return false; }
          }
        //end
        <?php
    }


    function gridCompany_providerJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowProvider").value = row;
        //end
        <?php
    }


    function btnProviderClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnImportProvider")
      {
        $this->btnImport->tag = 0;
        $this->winUpload->Caption = "Upload providers";
        $this->winUpload->ShowModal();
        return false;
      }else if ($toolButtonName == "btnImportAccounting")
      {
        $this->btnImport->tag = 1;
        $this->winUpload->Caption = "Upload accounting code";
        $this->winUpload->ShowModal();
        return false;
      }else if ($toolButtonName == "btnDelete")
      {
        $this->Deleteproviderselected();
        $this->gridCompany_provider->writeSelectedCells(array());
      }else if ($toolButtonName == "btnUpdateProviderInvoice")
      {
        $this->update_invoice_received();
      }else if ($toolButtonName == "btnReturnPage")
      {
        if (isset($_SESSION['page_return'])) {
          $page_return = $_SESSION['page_return'][0];
          @header("Location: $page_return");
        }
      }

    }


    function update_invoice_received()
    {
      if (count($this->gridCompany_provider->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $provider = implode(",", $this->gridCompany_provider->SelectedPrimaryKeys);

        $sql = "UPDATE invoice_received
                      INNER JOIN company_provider
                      ON company_provider.company_id = invoice_received.company_id AND
                      company_provider.company_provider_id = invoice_received.company_provider_id
                SET invoice_received.expense_type_id = CASE WHEN invoice_received.expense_type_id OR NOT accounted_yn  THEN company_provider.expense_type_id ELSE invoice_received.expense_type_id END,
                    invoice_received.tax_ident = company_provider.tax_ident,
                    invoice_received.provider_name = company_provider.provider_name
                WHERE (company_provider.company_id = {$company_id}) AND (company_provider.company_provider_id IN ({$provider}))";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_provider->writeSelectedCells(array());
      }
    }


    function gridCompany_providerShow($sender, $params)
    {
      Global $language;

      $this->gridCompany_provider->Columns[COL_TAX_IDENT]->Caption = SW_CAPTION_TAX_IDENT;
      $this->gridCompany_provider->Columns[COL_CLIENT_NAME]->Caption = SW_CAPTION_CLIENT_NAME;
      $this->gridCompany_provider->Columns[COL_COUNTRY]->Caption = SW_CAPTION_COUNTRY;
      $this->gridCompany_provider->Columns[COL_POSTAL_CD]->Caption = SW_CAPTION_POST_CODE;
      $this->gridCompany_provider->Columns[COL_TYPE_TAX]->Caption = SW_CAPTION_TYPE_OUTPUT_TAX;
      $this->gridCompany_provider->Columns[COL_ACCOUNT]->Caption = SW_CAPTION_ACCOUNT_CD;
      $this->gridCompany_provider->Columns[COL_ACCOUNT_EXPENSE]->Caption = SW_CAPTION_ACCOUNT_EXPENSE;
      $this->gridCompany_provider->Columns[COL_OTHER_EXPENSE]->Caption = SW_CAPTION_ACCOUNT_OTHER_EXPENSE;
      $this->gridCompany_provider->Columns[COL_WITHHOLDING]->Caption = SW_CAPTION_ACCOUNT_WITHHOLDING;

      //Column Country
      $sql = "SELECT country_id, {$language} as country_name FROM country ORDER BY {$language}";
      $records = sw_records_array($sql, Array('country_id', 'country_name'));
      $this->gridCompany_provider->Columns[COL_COUNTRY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridCompany_provider->Columns[COL_COUNTRY]->FilterOptions = $records;
      $this->gridCompany_provider->Columns[COL_COUNTRY]->TextField = "country_name";

      //Column Expense type
      $sql = "SELECT expense_type.*, {$language} AS expense_name FROM expense_type ORDER BY {$language}";
      $records = sw_records_array($sql, Array('expense_type_id', 'expense_name'));
      $records[0] = "";
      $this->gridCompany_provider->Columns[COL_EXPENSE]->ComboBoxEditor->Values = $records;
      $this->gridCompany_provider->Columns[COL_EXPENSE]->FilterOptions = $records;
      $this->gridCompany_provider->Columns[COL_EXPENSE]->TextField = 'expense_name';

      //Column Type TAX
      $sql = $this->sqlTax_type_key->SQL;
      $records = sw_records_array($sql, Array('tax_type_key_id', 'tax_type_name'));
      $records[''] = "";
      $this->gridCompany_provider->Columns[COL_TYPE_TAX]->FilterOptions = $records;
    }



    function btnSaveMergeJSClick($sender, $params)
    {
      Global $lbMergeProviderMsg;
        ?>
        //begin js
        return confirm("<?php echo $lbMergeProviderMsg ?>");
        //end
        <?php
    }

    function btnSaveMergeClick($sender, $params)
    {
      $sourceprovider = $this->cbSourceProvider->SelectedValue;
      $targetprovider = $this->cbTargetProvider->SelectedValue;

      If (($sourceprovider) && ($targetprovider) && ($sourceprovider != $targetprovider)){
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        if ($record = sw_get_data_table("company_provider", "(company_provider.company_id = {$company_id}) AND (company_provider_id = {$targetprovider})")){
      		$record['provider_name'] = sw_replace_quotes($record['provider_name']);
      		if (!mb_check_encoding($record['provider_name'], 'UTF-8')) {
        		$record['provider_name'] = utf8_encode($record['provider_name']);
      		}
          $sql = "UPDATE invoice_received
                  SET company_provider_id = {$record['company_provider_id']},
                      tax_ident = '{$record['tax_ident']}',
                      provider_name = '{$record['provider_name']}',
                      expense_type_id = {$record['expense_type_id']}
                  WHERE (company_id = {$company_id}) AND (company_provider_id = {$sourceprovider})";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->execute("DELETE FROM company_provider WHERE (company_id = {$company_id}) AND (company_provider_id = {$sourceprovider})");
          $connectionDB->DbConnection->CompleteTrans();
        }
      }
      $this->cbSourceProvider->SelectedValue = 0;
      $this->cbTargetProvider->SelectedValue = 0;
    }

    function btnCloseMergeJSClick($sender, $params)
    {
        ?>
        //begin js
				document.getElementById( "winMergeProvider" ).Hide();
        return false;
        //end
        <?php
    }

    function btnSaveInputTaxClick($sender, $params)
    {
      if ($this->gridCompany_provider->SelectedPrimaryKeys &&
          $this->tax_type_key_id->SelectedValue) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $provider = implode(",", $this->gridCompany_provider->SelectedPrimaryKeys);

        $sql = "UPDATE company_provider
                SET tax_type_key_id = {$this->tax_type_key_id->SelectedValue}
                WHERE (company_provider.company_id = {$company_id}) AND (company_provider.company_provider_id IN ({$provider}))";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_provider->writeSelectedCells(array());
      }
    }

    function btnCloseInputTaxJSClick($sender, $params)
    {
        ?>
        //begin js
        document.getElementById( "winTypeTax" ).Hide();
        //end
        <?php
    }

    function gridCompany_providerJSDataLoad($sender, $params)
    {
        ?>
        //begin js
				var msgError = document.getElementById("msgError").value;
        if (msgError != '') {
				  TINY.box.show({html:msgError,animate:false,close:true,boxid:'error',height:'auto',width:'300px'});
				}
        //end
        <?php
    }

    function company_providerShow($sender, $params)
    {
        $this->msgError->Value = "";
    }

    //Valid before insert
    function gridCompany_providerRowEdited($sender, $params)
    {
			$msg = $this->ValidTax_Id($sender, $params);

			return ($msg==="");
    }


}

global $application;

global $company_provider;

//Creates the form
$company_provider=new company_provider($application);

//Read from resource file
$company_provider->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company_provider->show();

?>