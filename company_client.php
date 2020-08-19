<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/accounting.php");
require_once("include/fmstrong.php");

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
class company_client extends fmstrong
{
    public $tax_type_key_id = null;
    public $btnCloseOutputTax = null;
    public $btnSaveOutputTax = null;
    public $winTypeTax = null;
    public $record_accounting = null;
    public $lbMessage_merge = null;
    public $dsMerge_client = null;
    public $sqlMerge_client = null;
    public $cbTargetClient = null;
    public $cbSourceClient = null;
    public $lbTargetClient = null;
    public $lbSourceClient = null;
    public $btnSaveMerge = null;
    public $btnCloseMerge = null;
    public $rowClient = null;
    public $btnClient = null;
    public $col_client_name = null;
    public $col_accounting_code = null;
    public $lbBeginning_row = null;
    public $beginning_row = null;
    public $lbAccounting_code = null;
    public $lbClient_name = null;
    public $lbTax_id = null;
    public $btnImport = null;
    public $Upload = null;
    public $btnClose = null;
    public $winUpload = null;
    public $gridCompany_client = null;
    public $SiteTheme = null;
    public $sqlCompany_client = null;
    public $dsCompany_client = null;
    public $gbParameter = null;
    public $col_tax_ident = null;
    public $ImageList = null;
    public $winMergeClient = null;
    public $sqlTax_type_key = null;
    public $dsTax_type_key = null;
    public $lbTypeOutputTax = null;

    function company_clientCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterCompanyAccounting();
    }


    function ParameterCompanyAccounting()
    {
      Define('COL_TAX_IDENT', $this->gridCompany_client->findColumnByName('tax_ident'));
      Define('COL_CLIENT_NAME', $this->gridCompany_client->findColumnByName('client_name'));
      Define('COL_COUNTRY', $this->gridCompany_client->findColumnByName('country_id'));
      Define('COL_POSTAL_CD', $this->gridCompany_client->findColumnByName('postat_cd'));
      Define('COL_TYPE_TAX', $this->gridCompany_client->findColumnByName('tax_type_key_id'));
      Define('COL_ACCOUNT', $this->gridCompany_client->findColumnByName('account_cd'));
      $this->record_accounting = sw_get_company_accounting($_SESSION['company_id']);

      $this->lbTypeOutputTax->Caption = SW_CAPTION_TYPE_OUTPUT_TAX;
      $this->winTypeTax->Caption = SW_CAPTION_TYPE_OUTPUT_TAX;
      $this->btnCloseMerge->Caption = btnCancel;
      $this->btnClose->Caption = btnCancel;
      $this->btnCloseOutputTax->Caption = btnCancel;
      $this->btnSaveMerge->Caption = btnSave;
      $this->btnImport->Caption = btnSave;
      $this->btnSaveOutputTax->Caption = btnSave;

      $company_id = 0;
      if (isset($_SESSION['company_id'])) {
          $company_id = $_SESSION['company_id'];
      }
      $enable = ($company_id != 0);
      $visible = ($enable && ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']));

      $this->lbTitle->Caption = $enable ? Title_Client . " (" . $_SESSION['short_name'] . ")" : Title_Client;
      $this->lbTitle->Visible = True;

      $sql = "SELECT * FROM tax_type_key
              WHERE (type_tax_cd = " . GLOBAL_OUTPUT_TAX . ") AND (visible_yn = True) AND (country_id = {$_SESSION['country_id']})";
      $this->sqlTax_type_key->close();
      $this->sqlTax_type_key->SQL = $sql;
      $this->sqlTax_type_key->open();

      $this->sqlMerge_client->close();
      $this->sqlMerge_client->Params = array($company_id);
      $this->sqlMerge_client->open();
      $this->winMergeClient->Caption = btnMergeClient;
      $this->cbSourceClient->SelectedValue = -1;
      $this->cbTargetClient->SelectedValue = -1;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      $items['btnSave'] = array(btnSave, $enable, "5");
      $items['btnCancel'] = array(btnCancel, $enable, "4");
      $items['btnMergeClient'] = array(btnMergeClient, $enable);

      $this->gridCompany_client->ReadOnly = !$enable;
      $this->gridCompany_client->Columns[COL_TYPE_TAX]->Visible = $visible;
      $this->gridCompany_client->Columns[COL_ACCOUNT]->Visible = $visible;
      if ($_SESSION['IsSuperadmin']) {
        $items['btnUpdateClientInvoice'] = array(btnUpdateClientInvoice, $enable);
        $items['btnImportClient'] = array(btnImportExcel, $enable);
        $items['btnImportAccounting'] = array(btnImportAccounting, $enable);
        $items['btnChangeTypeTax'] = array(btnChangeTypeTax, $enable);
      }

      if (isset($_SESSION['page_return'])) {
//          $items['btnReturnPage'] = array(btnReturnPage, ($_SESSION['company_id'] != 0));
      }

      $this->btnClient->Items = $items;
    }


    function gridCompany_clientSQL($sender, $params)
    {
      Global $language;

      list( $sortSql, $sortFields, $filterSql ) = $params;

      if (strpos($filterSql, 'account_cd') !== False){
        $Column = $sender->Columns[$sender->findColumnByFieldName('account_cd')];
        $account_cd = sw_check_account($Column->Filter, $this->record_accounting['digit_account']);
        $filterSql = str_replace("account_cd LIKE '%{$Column->Filter}%'","account_cd LIKE '%{$account_cd}%'",$filterSql);
        $Column->Filter = $account_cd;
      }

      $sql = "SELECT company_client.*, country.country_name, tax_type_key.tax_type_name
              FROM company_client
              LEFT JOIN tax_type_key ON company_client.tax_type_key_id = tax_type_key.tax_type_key_id
              LEFT JOIN (SELECT country_id, country.{$language} AS country_name FROM country) AS country ON company_client.country_id = country.country_id
              WHERE (company_id = {$_SESSION['company_id']}) ";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlCompany_client->SQL = $sql;
    }


    function gridCompany_clientInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1) $fields = &$params[ 0 ];
      else { // Update
          $fields = &$params[ 1 ];
          $fields[ 'company_client_id' ] = $params[ 0 ];
      }

      $company_id = $_SESSION['company_id'];
      if (!$record = sw_get_company_accounting($company_id)){
          $record['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
          $record['account_client'] = GLOBAL_ACCOUNT_CLIENT;
      }

      //checked account
      $fields[ 'account_cd' ] = $fields[ 'account_cd' ] ? sw_check_account($fields[ 'account_cd' ], $record['digit_account']) : "";
      $fields[ 'company_id' ] = $company_id;
      $fields[ 'tax_ident' ] = sw_clean_caracter_tax_ident($fields[ 'tax_ident' ]);
      $fields[ 'client_name' ] = strtoupper($fields[ 'client_name' ]);

      if (!$fields[ 'company_client_id' ]) {
      		$record['created_by_user_id']  = $_SESSION['user_id'];
          $record['created_dt'] = date('Y-m-d H:i:s');
          sw_insert_table($this->gridCompany_client->Datasource->DataSet->TableName, $fields);
      }
      else {
        sw_update_table("company_client", $fields, "company_client_id = " . $fields['company_client_id']);
      }
    }

    //Valid before insert
    function gridCompany_clientRowInserted($sender, $params)
    {
      $fields = &$params[ 0 ];

      $fields['tax_ident'] = sw_clean_caracter_tax_ident($fields['tax_ident']);
			$msg = sw_valid_TaxID_client($fields['tax_ident'], $_SESSION['company_id'], $fields['company_client_id']);

			$this->msgError->Value = $msg;

      return ($msg==="");
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

          $file = $dir . "/client_" . $_SESSION['company_id'] . "." . $this->Upload->FileExt;
          $this->Upload->moveUploadedFile($file);
        }
        else { $msg = "The selected file must be in excel format"; }
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
      $col_client_name = $this->col_client_name->ItemIndex;
      $col_accounting_code = $this->col_accounting_code->ItemIndex;

      $beginning_row = $this->beginning_row->position;

      for ($row = (($beginning_row) ? $beginning_row : 2); $row <= $rows; $row++)
      {
        $tax_ident    = ($col_tax_ident) ? substr(trim($worksheet->getCellByColumnAndRow($col_tax_ident - 1, $row)->getCalculatedValue()), 0, 20) : "";
        $tax_ident    = sw_clean_caracter_tax_ident($tax_ident);
        $client_name  = ($col_client_name) ? substr(trim($worksheet->getCellByColumnAndRow($col_client_name - 1, $row)->getCalculatedValue()), 0, 200) : "";
        $account_cd   = ($col_accounting_code) ? substr(trim($worksheet->getCellByColumnAndRow($col_accounting_code - 1, $row)->getCalculatedValue()), 0, 12) : "";

        if (strlen($tax_ident) != 0){
          //accounting parameter
          if (!$this->record_accounting) {
              $this->record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
              $this->record_accounting['account_client'] = GLOBAL_ACCOUNT_CLIENT;
          }
          $account_cd = ($account_cd == "") && (trim($this->record_accounting['account_client']) != "") ? $this->record_accounting['account_client'] : $account_cd;

//          $sql = "(company_id = {$company_id}) AND (tax_ident = '{$tax_ident}') ";
          $sql = "(company_id = {$company_id}) AND (tax_ident LIKE '%{$tax_ident}%') ";
          $record = sw_get_data_table('company_client', $sql);

          if (!$this->btnImport->tag){
              $record['company_id'] = $company_id;
              $record['tax_ident']  = $tax_ident;
              $record['client_name'] = strtoupper($client_name);
              $record['account_cd'] = ($account_cd!="") ? $account_cd : $record['account_cd'];
              $record['country_id'] = sw_country_tax_ident($record['tax_ident']);

              if (!$record['company_client_id'])
                  sw_insert_table("company_client", $record);
              else {
                 $sql .= " AND company_client_id = {$record['company_client_id']}";
                 sw_update_table("company_client", $record, $sql);
              }
          }
          else if ($record['company_client_id']){
              //accounting parameter
              if (!$this->record_accounting) {
                $this->record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
                $this->record_accounting['account_client'] = GLOBAL_ACCOUNT_CLIENT;
              }
              $account_cd = ($account_cd == "") && ($this->record_accounting['account_client'] != "") ? $this->record_accounting['account_client'] : $account_cd;

              $record['account_cd'] = ($account_cd!="") ? $account_cd : $record['account_cd'];

              $sql .= " AND company_client_id = {$record['company_client_id']}";
              sw_update_table("company_client", $record, $sql);
          }
	      }
      }

      if (file_exists($file)) unlink($file);
      Unset($worksheet);
      Unset($objPHPExcel);
      $this->winUpload->Hide();
    }


    function gridCompany_clientDelete($sender, $params)
    {
      $fields = &$params[ 0 ];
      $company_client_id = $fields[ 0 ];

      if (!$record = sw_get_data_table("invoice_issued", "company_client_id = {$company_client_id}")) {
          sw_delete_table("company_client", "company_client_id = {$company_client_id}");
      }
    }


    function btnCloseJSClick($sender, $params)
    {
        ?>
        //begin js
          document.getElementById( "winUpload" ).Hide();
          return true;
        //end
        <?php
    }

    function btnCloseClick($sender, $params)
    {
      $this->winUpload->Hide();
    }

    function btnClientJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbUpdateClientInvoiceMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowClient").value;
          var laccess = "<?php echo sw_company_is_strong(); ?>";

          if (toolButton == 'btnClient'){
        		if (toolButtonName == 'btnFilter') {
          		gridCompany_client.deselectAll();
							gridCompany_client._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridCompany_client->ajaxCall('filter_grid', array(), array($this->gridCompany_client->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') {
            	if ( laccess != '1') { gridCompany_client.Insert(); return false; }
              return true;
            }
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) {
            	if ( laccess != '1') { gridCompany_client.Edit(row); return false; }
            	return true;
            }
            else if (toolButtonName == 'btnCancel') { gridCompany_client.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany_client.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnUpdateClientInvoice') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbUpdateClientInvoiceMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnMergeClient') { document.getElementById( "winMergeClient" ).ShowModal(); return false; }
            else if (toolButtonName == 'btnChangeTypeTax') { document.getElementById( "winTypeTax" ).ShowModal(); return false; }
          }
        //end
        <?php
    }

    function gridCompany_clientJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowClient").value = row;
        //end
        <?php
    }

    function btnClientClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnAdd" || $toolButtonName == "btnEdit"){
        unset($_SESSION['selected_company_id']);
      	$_SESSION['page_return'] = 'company_client.php';
      	$_SESSION['selected_company_client_id'] = 0;
				if ($toolButtonName == "btnEdit" && $this->gridCompany_client->SelectedPrimaryKeys[0]){
        	$_SESSION['selected_company_client_id'] = $this->gridCompany_client->SelectedPrimaryKeys[0];
        }
      	$url = "company_client_edit.php";
      	redirect_url($url);
      }else if ($toolButtonName == "btnImportClient"){
        $this->btnImport->tag = 0;
        $this->winUpload->Caption = "Upload clients";
        $this->winUpload->ShowModal();
      }else if ($toolButtonName == "btnImportAccounting"){
        $this->btnImport->tag = 1;
        $this->winUpload->Caption = "Upload accounting code";
        $this->winUpload->ShowModal();
        return false;
      }else if ($toolButtonName == "btnDelete"){
        $this->DeleteClientSelected();
      }else if ($toolButtonName == "btnUpdateClientInvoice"){
        $this->update_invoice_issued();
      }else if ($toolButtonName == "btnReturnPage"){
        if (isset($_SESSION['page_return'])) {
          $page_return = $_SESSION['page_return'][0];
      		redirect_url($page_return);
        }
      }

    }


    function DeleteClientSelected()
    {
      if (count($this->gridCompany_client->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $client = implode(",", $this->gridCompany_client->SelectedPrimaryKeys);

        $sql = "DELETE company_client FROM company_client LEFT JOIN invoice_issued " .
	             "ON company_client.company_client_id = invoice_issued.company_client_id " .
               "WHERE (invoice_issued.company_client_id IS NULL) AND (company_client.company_client_id IN ({$client})) ";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_client->writeSelectedCells(array());
      }
    }


    function update_invoice_issued()
    {
      if (count($this->gridCompany_client->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $client = implode(",", $this->gridCompany_client->SelectedPrimaryKeys);

        $sql = "UPDATE invoice_issued
                      INNER JOIN company_client
                      ON company_client.company_id = invoice_issued.company_id AND
                      company_client.company_client_id = invoice_issued.company_client_id
                SET invoice_issued.tax_ident = company_client.tax_ident,
                    invoice_issued.client_name = company_client.client_name
                WHERE (company_client.company_id = {$company_id}) AND (company_client.company_client_id IN ({$client}))";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_client->writeSelectedCells(array());
      }
    }


    function gridCompany_clientShow($sender, $params)
    {
      Global $language;

      $this->gridCompany_client->Columns[COL_TAX_IDENT]->Caption = SW_CAPTION_TAX_IDENT;
      $this->gridCompany_client->Columns[COL_CLIENT_NAME]->Caption = SW_CAPTION_CLIENT_NAME;
      $this->gridCompany_client->Columns[COL_COUNTRY]->Caption = SW_CAPTION_COUNTRY;
      $this->gridCompany_client->Columns[COL_POSTAL_CD]->Caption = SW_CAPTION_POST_CODE;
      $this->gridCompany_client->Columns[COL_TYPE_TAX]->Caption = SW_CAPTION_TYPE_OUTPUT_TAX;
      $this->gridCompany_client->Columns[COL_ACCOUNT]->Caption = SW_CAPTION_ACCOUNT_CD;

      //Column Country
      $sql = "SELECT country_id, {$language} as country_name FROM country ORDER BY {$language}";
      $records = sw_records_array($sql, Array('country_id', 'country_name'));
      $this->gridCompany_client->Columns[COL_COUNTRY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridCompany_client->Columns[COL_COUNTRY]->FilterOptions = $records;
      $this->gridCompany_client->Columns[COL_COUNTRY]->TextField = "country_name";

      $sql = "SELECT * FROM tax_type_key
              WHERE (type_tax_cd = " . GLOBAL_OUTPUT_TAX . ") AND (visible_yn = True) AND (country_id = {$_SESSION['country_id']})";
      $records = sw_records_array($sql, Array('tax_type_key_id', 'tax_type_name'));
      $records[''] = "";
      $this->gridCompany_client->Columns[COL_TYPE_TAX]->FilterOptions = $records;
    }

    function btnSaveMergeJSClick($sender, $params)
    {
      Global $lbMergeClientMsg;
        ?>
        //begin js
        return confirm("<?php echo $lbMergeClientMsg ?>");
        //end
        <?php
    }

    function btnSaveMergeClick($sender, $params)
    {
      $sourceclient = $this->cbSourceClient->SelectedValue;
      $targetclient = $this->cbTargetClient->SelectedValue;

      If (($sourceclient) && ($targetclient) && ($sourceclient != $targetclient)){
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        if ($record = sw_get_data_table("company_client", "(company_client.company_id = {$company_id}) AND (company_client_id = {$targetclient})")){
      		$record['client_name'] = sw_replace_quotes($record['client_name']);
      		if (!mb_check_encoding($record['client_name'], 'UTF-8')) {
        		$record['client_name'] = utf8_encode($record['client_name']);
      		}
          $sql = "UPDATE invoice_issued
                  SET company_client_id = {$record['company_client_id']},
                      tax_ident = '{$record['tax_ident']}',
                      client_name = '{$record['client_name']}'
                  WHERE (company_id = {$company_id}) AND (company_client_id = {$sourceclient})";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->execute("DELETE FROM company_client WHERE (company_id = {$company_id}) AND (company_client_id = {$sourceclient})");
          $connectionDB->DbConnection->CompleteTrans();
        }
      	$this->cbSourceClient->SelectedValue = 0;
      	$this->cbTargetClient->SelectedValue = 0;
      }
    }

    function btnCloseMergeJSClick($sender, $params)
    {
        ?>
        //begin js
				document.getElementById( "winMergeClient" ).Hide();
        return false;
        //end
        <?php
    }


    function btnSaveOutputTaxClick($sender, $params)
    {
      if ($this->gridCompany_client->SelectedPrimaryKeys &&
          $this->tax_type_key_id->SelectedValue) {
        Global $connectionDB;
        $company_id = $_SESSION['company_id'];
        $client = implode(",", $this->gridCompany_client->SelectedPrimaryKeys);

        $sql = "UPDATE company_client
                SET tax_type_key_id = {$this->tax_type_key_id->SelectedValue}
                WHERE (company_client.company_id = {$company_id}) AND (company_client.company_client_id IN ({$client}))";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridCompany_client->writeSelectedCells(array());
      }
    }

    function btnCloseOutputTaxJSClick($sender, $params)
    {
        ?>
        //begin js
        document.getElementById( "winTypeTax" ).Hide();
        //end
        <?php
    }

    function gridCompany_clientJSDataLoad($sender, $params)
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

}

global $application;

global $company_client;

//Creates the form
$company_client=new company_client($application);

//Read from resource file
$company_client->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company_client->show();

?>