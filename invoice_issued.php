<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once('include/accounting.php');
require_once('include/create_grid_column.php');
require_once("include/ziparchive.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("styles.inc.php");
use_unit("components4phpfull/jtinputvalidator.inc.php");
use_unit("components4phpfull/jtheadercode.inc.php");
use_unit("components4phpfull/jtjavascript.inc.php");
use_unit("components4phpfull/jttemplatepanel.inc.php");

//Class definition
class invoice_issued extends fmstrong
{
    public $beginning_row = null;
   public $StyleSheet1 = null;
   public $lbDownloadOurTemplate = null;
   public $winPaid = null;
   public $paid_dt = null;
   public $lbPaid_dt = null;
   public $lbPaid_by = null;
   public $paid_by = null;
   public $btnSavePayment = null;
   public $lbPayment_method = null;
   public $payment_method_id = null;
   public $lbBank_account = null;
   public $bank_account_id = null;
   public $paid_amt = null;
   public $lbPaid_amt = null;
   public $sqlCompany_bank_account = null;
   public $dsCompany_bank_account = null;
   public $sqlInvoice_issued_paid = null;
   public $dsInvoice_issued_paid = null;
   public $sqlPayment_method = null;
   public $dsPayment_method = null;
   public $record_accounting = null;
   public $sqlCompany_client = null;
   public $dsCompany_client = null;
   public $company_client_id = null;
   public $lbToExport = null;
   public $dtToExport = null;
   public $dtFromExport = null;
   public $lbSelectTemplate = null;
   public $cbTemplateImport = null;
   public $lbBase_withholding1 = null;
   public $col_base_withholding_amount = null;
   public $lbWithholding_rate = null;
   public $col_withholding_rate = null;
   public $rowTax = null;
   public $btnInvoices = null;
   public $winUpload = null;
   public $gbParameter = null;
   public $lbTax_id = null;
   public $lbSubtotal_amount = null;
   public $lbTax_amount = null;
   public $lbBeginning_row = null;
   public $lbInvoice_date = null;
   public $lbCol_invoice_number = null;
   public $lbTax_percentage = null;
   public $lbTransport_amount = null;
   public $lbTotal_amount = null;
   public $lbClient_name_import = null;
   public $col_invoice_date = null;
   public $col_tax_ident = null;
   public $col_subtotal_amount = null;
   public $col_tax_rate = null;
   public $col_total_amount = null;
   public $col_invoice_number = null;
   public $col_client_name = null;
   public $col_transport_amount = null;
   public $col_tax_amount = null;
   public $lbOther_income_amount = null;
   public $col_other_amount = null;
   public $btnCloseUpload = null;
   public $btnImport = null;
   public $winExport = null;
   public $cbExportAccounting = null;
   public $BtnCloseExport = null;
   public $BtnExport = null;
   public $cbCreateAccount = null;
   public $gridInvoice_issued = null;
   public $invoice_issued_id = null;
   public $sqlInvoice_issued_tax = null;
   public $dsInvoice_issued_tax = null;
   public $sqlInvoice_issued = null;
   public $dsInvoice_issued = null;
   public $SiteTheme = null;
   public $ImageList = null;
   public $registration_dt = null;
   public $lbRegistration_dt = null;
   public $winRegistrationChange = null;
   public $lbRegistration_change = null;
   public $registration_change = null;
   public $btnSaveRegistration = null;
   public $btnCloseRegistration = null;
   public $winDetail = null;
   public $gbData = null;
   public $lbclient_id = null;
   public $lbclient_name = null;
   public $lbtax_ident = null;
   public $client_name = null;
   public $tax_ident = null;
   public $add_client = null;
   public $subtotal_amt = null;
   public $tax_amt = null;
   public $gbInvoice = null;
   public $lbInvoice_number = null;
   public $invoice_number = null;
   public $lbInvoice_dt = null;
   public $invoice_dt = null;
   public $lbSubtota_amt = null;
   public $lbTax_amt = null;
   public $total_amt = null;
   public $lbTotal_amt = null;
   public $lbOther_expense_amt = null;
   public $other_income_amt = null;
   public $lbBase_withholding = null;
   public $base_withholding_amt = null;
   public $lbWithholding_rate_no = null;
   public $withholding_rate_no = null;
   public $lbwithholding_amt = null;
   public $withholding_amt = null;
   public $gridInvoice_issued_tax = null;
   public $btnTaxes = null;
   public $BtnAgreeInvoiceDetail = null;
   public $btnCloseInvoiceDetail = null;
   public $lbError = null;
   public $lbAttached_invoice = null;
   public $Attached = null;
   public $lbRegistration_date = null;
   public $registration_date = null;
   public $lbDocument_ident = null;
   public $document_ident = null;
   public $dsTax_rate = null;
   public $sqlTax_rate = null;
   public $lbDocument_id = null;
   public $col_document_id = null;
   public $Upload = null;
   public $lbFromExport = null;
   public $cbExportSelectedInvoices = null;
   public $SelectedKeysField = null;
   public $gridInvoice_issued_paid = null;
   public $lbTypeExport = null;
   public $cbTypeExport = null;
   public $imgOpenInvoice = null;
    public $lbOverhead_amt = null;
    public $overhead_amt = null;

   function invoice_issuedCreate($sender, $params)
   {
      sw_style_selected($this);

      $this->ParameterInvoiceIssued();
   }

   function ParameterInvoiceIssued()
   {
      Global $connectionDB, $MonthLetter, $language, $template_import_invoice,
      $VirtualFile, $lbSelectValue, $SW_STASTUS_INVOICE_ISSUED_CD, $download_our_template;

      Define('COL_INVOICE_YEAR', $this->gridInvoice_issued->findColumnByName('invoice_year'));
      Define('COL_TAX_IDENT', $this->gridInvoice_issued->findColumnByName('tax_ident'));
      Define('COL_PDF', $this->gridInvoice_issued->findColumnByName('img_pdf'));
      Define('COL_ACCOUNT_CD', $this->gridInvoice_issued->findColumnByName('account_cd'));
      Define('COL_REGISTRATION_DT', $this->gridInvoice_issued->findColumnByName('registered_in_acctg_software_dt'));
      Define('COL_DOCUMENT_IDENT', $this->gridInvoice_issued->findColumnByName('document_ident'));
      Define('COL_ACCOUNTED_YN', $this->gridInvoice_issued->findColumnByName('accounted_yn'));
      Define('COL_EXPORT_DT', $this->gridInvoice_issued->findColumnByName('export_dt'));
      Define('COL_CREATED_USER', $this->gridInvoice_issued->findColumnByName('created_by_user_id'));
      Define('COL_CREATED_DT', $this->gridInvoice_issued->findColumnByName('created_dt'));
      Define('COL_LINK', $this->gridInvoice_issued->findColumnByName('link'));
      Define('COL_PAID_AMT', $this->gridInvoice_issued->findColumnByName('paid_amt'));
      Define('COL_PENDIENTE_AMT', $this->gridInvoice_issued->findColumnByName('pendiente_amt'));
      Define('COL_STATUS_CD', $this->gridInvoice_issued->findColumnByName('status_cd'));

      if( ! $this->gridInvoice_issued_paid->inSession(''))
      {
         //$this->CreatedColumnGridInvoice();
         $this->CreatedColumnGridPaid();
         $this->gridInvoice_issued->Columns[COL_INVOICE_YEAR]->Filter = date("Y");
         $this->gridInvoice_issued->Columns[COL_INVOICE_YEAR]->FilterMethod = 'Equals';
         $this->gridInvoice_issued->Header->ShowFilterBar = True;
      }

      $this->TableOpen();

      $records = $SW_STASTUS_INVOICE_ISSUED_CD;
      $records[''] = "";
      $this->gridInvoice_issued->Columns[COL_STATUS_CD]->FilterOptions = $records;

      $this->record_accounting = sw_get_company_accounting($_SESSION['company_id']);

      $company_id = 0;
      if(isset($_SESSION['company_id']))
      {
         $company_id = $_SESSION['company_id'];
      }
      $enable = ($company_id != 0);
      $visible = ($enable && ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']));
      $this->winDetail->Include = "";

      $this->lbTitle->Caption = $enable? Title_Invoice_issued . " (" . $_SESSION['short_name'] . ")": Title_Invoice_issued;
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "9");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");

      if($visible)
      {
         $items['btnSave'] = array(btnSave, $visible, "5");
         $items['btnCancel'] = array(btnCancel, $visible, "4");
         $items['btnUnMark'] = array(btnUnMark, $visible);
      }

      if($company_is_strong = sw_company_is_strong())
      {
         $items['btnPaid'] = array(btnPaid, $visible);
         $items['btnUnPaid'] = array(btnUnPaid, $visible);
         $items['btnPDF'] = array('Generate PDF', $visible);
      }

      $this->gridInvoice_issued->DetailView->Enabled = $company_is_strong;//sw_company_is_strong();
      $this->gridInvoice_issued->Columns[COL_STATUS_CD]->Visible = $company_is_strong;//sw_company_is_strong();
      $this->gridInvoice_issued->Columns[COL_PAID_AMT]->Visible = $company_is_strong;//sw_company_is_strong();
      $this->gridInvoice_issued->Columns[COL_PENDIENTE_AMT]->Visible = $company_is_strong;//sw_company_is_strong();

      $this->gridInvoice_issued->Columns[COL_ACCOUNT_CD]->Visible = $visible;
      $this->gridInvoice_issued->Columns[COL_REGISTRATION_DT]->Visible = $visible;
      $this->gridInvoice_issued->Columns[COL_EXPORT_DT]->Visible = $visible;
      $this->gridInvoice_issued->Columns[COL_DOCUMENT_IDENT]->Visible = $visible;
      $this->gridInvoice_issued->Columns[COL_REGISTRATION_DT]->CanEdit = $visible;
      $this->gridInvoice_issued->Columns[COL_ACCOUNTED_YN]->CanEdit = $visible;
      $this->gridInvoice_issued->Columns[COL_EXPORT_DT]->CanEdit = $visible;

      if($visible)
      {
        $items['btnRegistrationChange'] = array(btnRegistrationChange, $enable);
      	$items['btnImportInvoice'] = array(btnImportExcel, $enable);
        $items['btnExportAccounting'] = array(btnExportAccounting, $enable);
        $this->winRegistrationChange->Caption = btnRegistrationChange;
        $this->lbRegistration_change->Caption = btnRegistrationChange;
        $this->btnSaveRegistration->Caption = btnSave;
        $this->btnCloseRegistration->Caption = btnClose;
      }
      $this->btnInvoices->Items = $items;

      //Parameter Import excel
      $this->cbTemplateImport->Items = $template_import_invoice;
      $this->cbTemplateImport->ItemIndex = 0;
      $this->SelectTemplateImport();

      $this->lbDownloadOurTemplate->Caption = $download_our_template;
      $this->lbDownloadOurTemplate->Link = $VirtualFile . TMP_ACCOUNTING_UPLOAD . "/form%20-%20accounting%20sheet.xlsx";

      $this->winPaid->Hide();
   }

   function TableOpen()
   {
      Global $language;

      //Company bank account
      $this->sqlCompany_bank_account->close();
      $this->sqlCompany_bank_account->Params = $_SESSION['company_id'];
      $this->sqlCompany_bank_account->open();

      //Tax rate
      $this->sqlTax_rate->close();
      $this->sqlTax_rate->Params = array($_SESSION['country_id']);
      $this->sqlTax_rate->open();

      //Company client
      $this->sqlCompany_client->close();
      $this->sqlCompany_client->Params = array($_SESSION['company_id']);
      $this->sqlCompany_client->open();

      //Query with Payment method language
      $sql = "SELECT payment_method_id, {$language} as payment_method_name
						  FROM payment_method
							WHERE billing_entity_id = {$_SESSION['settings']['billing_entity_id']}
							ORDER BY {$language}";
      $this->sqlPayment_method->Active = False;
      $this->sqlPayment_method->SQL = $sql;
      $this->sqlPayment_method->Active = True;
   }

   //Created column Invoice
   function CreatedColumnGridInvoice()
   {
      $this->gridInvoice_issued->Columns = array();

      $columns[] = sw_create_grid_column('invoice_number', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('invoice_dt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('invoice_pdf', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('tax_ident', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('client_name', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('subtotal_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('transport_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('tax_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('other_income_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('base_withholding_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('paid_amt', $this->gridInvoice_issued);
      $columns[] = sw_create_grid_column('pending_amt', $this->gridInvoice_issued);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_PAID_BY, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains');
      $columns[] = sw_create_grid_column('paid_by', $this->gridInvoice_issued_paid, $property);
      $columns[] = sw_create_grid_column('paid_amt', $this->gridInvoice_issued_paid, array(CAN_EDIT=>True));

      $lookupComboBox = array(DATASOURCE=>$this->dsPayment_method, VALUE_FIELD=>'payment_method_id', TEXT_FIELD=>'payment_method_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_PAYMENT_METHOD, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains', TEXT_FIELD=>'payment_method_name',
                        EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('payment_method_id', $this->gridInvoice_issued_paid, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany_bank_account, VALUE_FIELD=>'bank_account_id', TEXT_FIELD=>'bank_account_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_BANK_ACCOUNT, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains', TEXT_FIELD=>'bank_account_name',
                        EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('bank_account_id', $this->gridInvoice_issued_paid, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice_issued_paid);
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice_issued_paid);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridBooleanColumn',
                        CAPTION=>SW_CAPTION_ACCOUNTED_YN, DISPLAY_FORMAT=>'CheckBox',
                        TRUE_TEXT=>SW_CAPTION_YES, FALSE_TEXT=>SW_CAPTION_NO,
                        ALIGNMENT=>'agCenter', WIDTH=>90);
      $columns[] = sw_create_grid_column('accounted_yn', $this->gridInvoice_issued_paid, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'', VISIBLE=>FALSE);
      $columns[] = sw_create_grid_column('invoice_issued_id', $this->gridInvoice_issued_paid, $property);

      $this->gridInvoice_issued_paid->Columns = $columns;
      $this->gridInvoice_issued_paid->SortBy = 'paid_dt';
      $this->gridInvoice_issued_paid->Datasource->DataSet->open();
      Define('COL_ACCOUNTED_PAID', $this->gridInvoice_issued_paid->findColumnByName('accounted_yn'));
   }

   //Created column paid
   function CreatedColumnGridPaid()
   {
      $this->gridInvoice_issued_paid->Datasource->DataSet->close();
      $this->gridInvoice_issued_paid->Columns = array();

      $columns[] = sw_create_grid_column('paid_dt', $this->gridInvoice_issued_paid);
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_PAID_BY, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains');
      $columns[] = sw_create_grid_column('paid_by', $this->gridInvoice_issued_paid, $property);
      $columns[] = sw_create_grid_column('paid_amt', $this->gridInvoice_issued_paid, array(CAN_EDIT=>True));

      $lookupComboBox = array(DATASOURCE=>$this->dsPayment_method, VALUE_FIELD=>'payment_method_id', TEXT_FIELD=>'payment_method_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_PAYMENT_METHOD, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains', TEXT_FIELD=>'payment_method_name',
                        EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('payment_method_id', $this->gridInvoice_issued_paid, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany_bank_account, VALUE_FIELD=>'bank_account_id', TEXT_FIELD=>'bank_account_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_BANK_ACCOUNT, WIDTH=>200,
                        DEFAULT_FILTER=>'Contains', TEXT_FIELD=>'bank_account_name',
                        EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('bank_account_id', $this->gridInvoice_issued_paid, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice_issued_paid);
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice_issued_paid);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridBooleanColumn',
                        CAPTION=>SW_CAPTION_ACCOUNTED_YN, DISPLAY_FORMAT=>'CheckBox',
                        TRUE_TEXT=>SW_CAPTION_YES, FALSE_TEXT=>SW_CAPTION_NO,
                        ALIGNMENT=>'agCenter', WIDTH=>90);
      $columns[] = sw_create_grid_column('accounted_yn', $this->gridInvoice_issued_paid, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'', VISIBLE=>FALSE);
      $columns[] = sw_create_grid_column('invoice_issued_id', $this->gridInvoice_issued_paid, $property);

      $this->gridInvoice_issued_paid->Columns = $columns;
      $this->gridInvoice_issued_paid->SortBy = 'paid_dt';
      $this->gridInvoice_issued_paid->Datasource->DataSet->open();
      Define('COL_ACCOUNTED_PAID', $this->gridInvoice_issued_paid->findColumnByName('accounted_yn'));
   }

   function gridInvoice_issuedSQL($sender, $params)
   {
      list($sortSql, $sortFields, $filterSql) = $params;

      $filterSql = str_replace("client_name", "invoice_issued.client_name", $filterSql);
      $filterSql = str_replace("tax_ident", "invoice_issued.tax_ident", $filterSql);

      if(strpos($filterSql, 'account_cd') !== False)
      {
         $Column = $sender->Columns[$sender->findColumnByFieldName('account_cd')];
         $account_cd = sw_check_account($Column->Filter, $this->record_accounting['digit_account']);
         $filterSql = str_replace("account_cd LIKE '%{$Column->Filter}%'", "account_cd LIKE '%{$account_cd}%'", $filterSql);
         $Column->Filter = $account_cd;
      }

      $sql = "SELECT invoice_issued.invoice_issued_id, invoice_issued.company_id, invoice_issued.company_client_id,
                invoice_issued.invoice_number, invoice_issued.invoice_dt, invoice_issued.tax_ident,
                invoice_issued.client_name, invoice_issued.subtotal_amt, invoice_issued.transport_amt, invoice_issued.tax_amt, invoice_issued.overhead_amt,
                invoice_issued.withholding_amt, invoice_issued.other_income_amt, invoice_issued.total_amt,
                invoice_issued.paid_amt, (invoice_issued.total_amt - invoice_issued.paid_amt) AS pendiente_amt,
                invoice_issued.accounted_yn, invoice_issued.export_dt, invoice_issued.document_ident,
                invoice_issued.registered_in_acctg_software_dt, invoice_issued.link,
                invoice_issued.created_by_user_id, invoice_issued.created_dt,
								invoice_issued.status_cd, YEAR(invoice_issued.invoice_dt) AS invoice_year,
                user.username, company_client.account_cd
              FROM invoice_issued
                  LEFT JOIN company_client ON invoice_issued.company_client_id = company_client.company_client_id
                  LEFT JOIN (SELECT user_id, username FROM user) AS user ON invoice_issued.created_by_user_id = user.user_id
              WHERE (invoice_issued.company_id = {$_SESSION['company_id']})";

      //      if($_SESSION['accounting_year'])
      //      {
      //         $sql .= " AND (YEAR(registered_in_acctg_software_dt) = {$_SESSION['accounting_year']})";
      //      }
      if(strpos($filterSql, 'invoice_year') !== false)
      {
         $filterSql = str_replace('invoice_year', 'YEAR(invoice_issued.invoice_dt)', $filterSql);
      }

      if(($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
         $sql .= " AND " . $filterSql;

      if($sortSql)
         $sql .= " ORDER BY " . $sortSql;

      $this->sqlInvoice_issued->SQL = $sql;
   }

   function gridInvoice_issuedDelete($sender, $params)
   {
      $fields = &$params[0];
      $invoice_issued_id = $fields[0];

      $record = sw_get_data_table("invoice_issued", "invoice_issued_id = {$invoice_issued_id}");
      if(( ! $record['accounted_yn']) && ( ! $record['accounted_yn']))
      {
         sw_delete_table("invoice_issued", "invoice_issued_id = {$invoice_issued_id}");
      }
   }

   function gridInvoice_issuedRowEdited($sender, $params)
   {
      $fields = &$params[0];

      $invoice_issued_id = $fields['invoice_issued_id'];
      $record = sw_get_data_table("invoice_issued", "invoice_issued_id = {$invoice_issued_id}");
      return (( ! $record['accounted_yn']) || ( ! $fields['accounted_yn']));
   }

   function View_total_invoice($record)
   {
      $this->subtotal_amt->text = number_format($record['subtotal_amt'], 2, '.', '');
      $this->tax_amt->text = number_format($record['tax_amt'], 2, '.', '');
      $this->overhead_amt->text = number_format($record['overhead_amt'], 2, '.', '');
      $this->other_income_amt->text = number_format($record['other_income_amt'], 2, '.', '');
      $this->base_withholding_amt->text = number_format($record['base_withholding_amt'], 2, '.', '');
      $this->withholding_rate_no->text = number_format($record['withholding_rate_no'], 2, '.', '');
      $this->withholding_amt->text = number_format($record['withholding_amt'], 2, '.', '');

      $this->total_amt->text = number_format($record['total_amt'], 2, '.', '');
   }


		function btnImportClick($sender, $params)
  	{
  		if($this->Upload->isUploadedFile())
    	{
         if(strtoupper($this->Upload->FileExt) == 'XLS' || strtoupper($this->Upload->FileExt) == 'XLSX')
         {
            Global $TempDir;

            $dir = $TempDir;
            if(!file_exists($dir))
            {
               if(!mkdir($dir)) {
                  $return = false;
	 						 }
            }

            $file = $dir . "/invoice_issued_" . $_SESSION['company_id'] . "." . $this->Upload->FileExt;
	 					$file = sw_clean_characters_spanish($file);
            $this->Upload->moveUploadedFile($file);
         }
         else {
				 		$this->msgError->Value = SW_ERROR_FILE_EXCEL_FORMAT;
         		return false;
         }
			}
      else {
				$this->msgError->Value = SW_ERROR_FILE_IMPORT;
        return false;
			}

			$this->DataImport($file);
		}

		function DataImport($file) {

			require_once('include/PHPExcel.php');
			require_once("include/importTemplate/import_tempo_template.php");

      $dir = dirname(__FILE__) . "/tmp";
      $fileError = tempnam($dir, "TMP");

      if($this->cbTemplateImport->ItemIndex != 0 && class_exists('ImportTempoTemplate'))
      {
				 $objPHPExcel = PHPExcel_IOFactory::load($file);

         $import = new ImportTempoTemplate($_SESSION['company_id'], $objPHPExcel, $fileError);
      }

      if(isset($import))
      {
				$import->col_invoice_date = $this->col_invoice_date->ItemIndex;
      	$import->col_invoice_number = $this->col_invoice_number->ItemIndex;
      	$import->col_tax_ident = $this->col_tax_ident->ItemIndex;
      	$import->col_name = $this->col_client_name->ItemIndex;
      	$import->col_subtotal_amount = $this->col_subtotal_amount->ItemIndex;
      	$import->col_transport_amount = $this->col_transport_amount->ItemIndex;
      	$import->col_other_amount = $this->col_other_amount->ItemIndex;
      	$import->col_tax_rate = $this->col_tax_rate->ItemIndex;
      	$import->col_tax_amount = $this->col_tax_amount->ItemIndex;
      	$import->col_base_withholding_amount = $this->col_base_withholding_amount->ItemIndex;
      	$import->col_withholding_rate = $this->col_withholding_rate->ItemIndex;
      	$import->col_total_amount = $this->col_total_amount->ItemIndex;
      	$import->col_document_id = $this->col_document_id->ItemIndex;
				$import->beginning_row = $this->beginning_row->Text;
				$import->registration_date = $this->registration_dt->Date;

				$import->import_invoice_issued_excel();

				if (filesize($import->fileError) !== 0)
				{
        	$this->msgError->Value = SW_ERROR_FILE_IMPORT;

					$filename = sw_checked_file_valid_name(str_replace(",", "", str_replace(" ", "_", $_SESSION['short_name'])) . ".zip");
					$filezip = $dir . "/Import_from_excel_" . $filename;
					$import->create_zip_file($filezip);
					unlink($filezip);
				}

      	if(file_exists($file)){
					unlink($file);
      	}

      	$this->winUpload->Hide();
      	Unset($objPHPExcel);
				Unset($import);
			}

			$this->cbTemplateImport->ItemIndex = 0;
      $this->SelectTemplateImport();
   }

   function BtnExportClick($sender, $params)
   {
      require_once("include/export_contaplus.php");
      require_once("include/export_a3con.php");

      $dir = dirname(__FILE__) . "/tmp";

      $file_account_code = tempnam($dir, "TMP");
      $file_invoice_issued = tempnam($dir, "TMP");

      if($this->cbTypeExport->ItemIndex == 0 && class_exists('ExportA3ConLib'))
      {
         $export = new ExportA3ConLib();
         $export->codigo_empresa = $this->record_accounting['company_code_accounting'];
      }
      else
         if($this->cbTypeExport->ItemIndex == 1 && class_exists('ExportContaPlusLib'))
         {
            $export = new ExportContaPlusLib();
         }

      if(isset($export))
      {
         $export->file_subaccount = $file_account_code;
         $export->file_movement = $file_invoice_issued;

         $export->fromDate = $this->dtFromExport->Date;
         $export->toDate = $this->dtToExport->Date;
         $export->selectedInvoices = $this->cbExportSelectedInvoices->Checked;
         $export->selectedKeysInvoices = $this->SelectedKeysField->Value;
         $export->createAccount = $this->cbCreateAccount->Checked;
         $export->exportAccounting = $this->cbExportAccounting->Checked;
         $export->record_accounting = $this->record_accounting;

         $export->export_Subaccount_ClientTax();
         $export->export_Invoice_Issued();

         if(file_exists($file_account_code) && file_exists($file_invoice_issued) && class_exists('zipArchiveLib'))
         {
            $filename = sw_checked_file_valid_name(str_replace(",", "", str_replace(" ", "_", $_SESSION['short_name'])) . "_" .
            $this->dtFromExport->Date . "_" . $this->dtToExport->Date . ".zip");
            $filezip = $dir . "/Accounting_issued_" . $filename;
            $export->create_zip_file($filezip);
            unlink($filezip);

            if($this->record_accounting['accountant_period_last_closed_dt'] < $this->dtToExport->date)
            {
               sw_set_accountant_period_closed($this->dtToExport->date);
            }
         }
      }

      unlink($file_account_code);
      unlink($file_invoice_issued);
   }


   function btnCloseUploadClick($sender, $params)
   {
      $this->winUpload->Hide();
			$this->cbTemplateImport->ItemIndex = 0;
      $this->SelectTemplateImport();
   }

   function BtnCloseExportClick($sender, $params)
   {
      $_POST['BtnExportSubmitEvent'] = "";
      $this->winExport->Hide();
   }

   function gridInvoice_issuedJSSelect($sender, $params)
   {
      ?>
        //begin js
				document.getElementById("invoice_issued_id").value = gridInvoice_issued.getPrimaryKey(row);


        if (sender.id == 'gridInvoice_issued' && selected)
        {
        	if (col == <?php echo COL_PDF;?>)
        	{
        		var cellValue = gridInvoice_issued.getCellText(row, <?php echo COL_LINK;?>);
          	if (cellValue){
          		window.open(cellValue + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000),"_blank","", false);
							gridInvoice_issued.SelectedCol = 0;
          	}
          }
        }
        //end
      <?php
   }

   function gridInvoice_issuedRowData($sender, $params)
   {
      Global $SW_STASTUS_INVOICE_ISSUED_CD;
      $field = &$params[1];

      $field['export_dt'] = $field['export_dt'] == '0000-00-00 00:00:00'? '': $field['export_dt'];
      $field['img_pdf'] = 'images/ftp/1px.gif';
      $file = utf8_decode($field['link']);
      if(($file != "") && file_exists($file))
      {
         $field['img_pdf'] = 'images/ftp/pdf.gif';
      }
      else
         $field['link'] = "";

      $field['status_cd'] = $SW_STASTUS_INVOICE_ISSUED_CD[$field['status_cd']];
   }

   function btnInvoicesJSClick($sender, $params)
   {
      Global $lbDeleteInformationMsg, $lbUnmarkSelectedInvoiceMsg, $lbUnpaidSelectInvoiceMsg;
      ?>
          //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];

          if (toolButton == 'btnInvoices'){
        		if (toolButtonName == 'btnFilter') {
          		gridInvoice_issued.deselectAll();
							gridInvoice_issued._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridInvoice_issued->ajaxCall('filter_grid', array(), array($this->gridInvoice_issued->Name));?>
          		return false;
        		}
          	else if ((toolButtonName == 'btnDelete') ||
                (toolButtonName == 'btnUnMark') ||
              	(toolButtonName == 'btnRegistrationChange') ||
                (toolButtonName == 'btnExportAccounting') ||
                (toolButtonName == 'btnPaid') ||
                (toolButtonName == 'btnUnPaid') ||
                (toolButtonName == 'btnPDF')) {
            	var keys = [];
            	for (var row in gridInvoice_issued.SelectedCells) {
              	if (typeof(gridInvoice_issued.SelectedCells[row]) != "function" &&
                		(gridInvoice_issued.SelectedCells[row] != '') &&
                    (gridInvoice_issued.SelectedCells[row] != null)) {
                  keys.push(gridInvoice_issued.getPrimaryKey(row));
          			  if (toolButtonName == 'btnPaid'){ break; }
              	}
            	}

              if (toolButtonName == 'btnExportAccounting') { document.getElementById( "winExport" ).ShowModal(); return false;}

            	if (findObj('SelectedKeysField').value = keys.join(',')){
              	if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg?>");}
              	else if (toolButtonName == 'btnUnMark') { return confirm("<?php echo $lbUnmarkSelectedInvoiceMsg?>");}
                else if (toolButtonName == 'btnPaid' || toolButtonName == 'btnPDF') { return true; }
              	else if (toolButtonName == 'btnUnPaid') { return confirm("<?php echo $lbUnpaidSelectInvoiceMsg?>");}
            		else if (toolButtonName == 'btnRegistrationChange') { document.getElementById( "winRegistrationChange" ).ShowModal(); return false;}
            	}
            	return false;
          	}
            else if (toolButtonName == 'btnCancel') { gridInvoice_issued.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridInvoice_issued.Post(); return false;}
          }
          //end
      <?php
   }

   function btnInvoicesClick($sender, $params)
   {
      list($toolButton, $toolButtonName) = explode('_', $params[0]);

      if(($toolButtonName == 'btnAdd') || ($toolButtonName == 'btnEdit'))
      {
         $primaryKey = ($toolButtonName == 'btnAdd') || ( ! $this->invoice_issued_id->Value)? 0: $this->invoice_issued_id->Value;
         if(sw_company_is_strong())
            redirect_url("invoice_issued_edit.php?ID=" . $primaryKey);
         else
            $this->Details_invoice($primaryKey);
      }
      else if($toolButtonName == 'btnDelete')
			{
				$this->DeleteInvoiceSelected();
			}
			else if($toolButtonName == 'btnUnMark')
			{
				$this->Dis_accounting();
			}
			else if($toolButtonName == 'btnImportInvoice')
			{
				$this->winUpload->ShowModal();
			}
			else if($toolButtonName == 'btnPaid')
			{
				$this->PaidInvoiceIssued();
			}
			else if($toolButtonName == 'btnUnPaid')
			{
				$this->UnPaidInvoiceIssued();
			}
		 	else if($toolButtonName == 'btnPDF')
			{
				$invoice_isssued = explode(",", $this->SelectedKeysField->Value);
				foreach($invoice_isssued as $key=>$invoice_issued_id)
				{
					sw_create_PDF_invoice($invoice_issued_id, true);
				}
			}
   }

   function Details_invoice($primaryKey)
   {
      $this->invoice_issued_id->Value = $primaryKey;

      $record = sw_get_data_table("invoice_issued", "invoice_issued_id = {$primaryKey}");

      $this->sqlInvoice_issued_tax->close();
      $this->sqlInvoice_issued_tax->sql = "SELECT * FROM invoice_issued_tax Where invoice_issued_id = {$primaryKey} ORDER BY rate_no ";
      $this->sqlInvoice_issued_tax->open();

      $record_tax = array();
      $issued_tax = array();
      While( ! $this->sqlInvoice_issued_tax->EOF)
      {
      	$record_tax['base_amt'] = $this->sqlInvoice_issued_tax->Fields['base_amt'];
        $record_tax['tax_rate_id'] = $this->sqlInvoice_issued_tax->Fields['tax_rate_id'];
        $record_tax['tax_amt'] = $this->sqlInvoice_issued_tax->Fields['tax_amt'];
        $record_tax['rate_no'] = $this->sqlInvoice_issued_tax->Fields['rate_no'];
        $record_tax['overhead_rate_no'] = $this->sqlInvoice_issued_tax->Fields['overhead_rate_no'];
        $record_tax['overhead_amt'] = $this->sqlInvoice_issued_tax->Fields['overhead_amt'];

        $record_tax['invoice_issued_tax_id'] = $this->sqlInvoice_issued_tax->Fields['invoice_issued_tax_id'];

        array_push($issued_tax, $record_tax);
        $this->sqlInvoice_issued_tax->next();
      }
      $this->gridInvoice_issued_tax->CellData = $issued_tax;

      $accounted_yn = $record['accounted_yn'];
      $this->company_client_id->Enabled =  ! $accounted_yn;
      $this->tax_ident->Enabled =  ! $accounted_yn;
      $this->client_name->Enabled = ( ! $record['client_name'] &&  ! $accounted_yn)? true: false;
      $this->tax_ident->Enabled = ( ! $record['tax_ident'] &&  ! $accounted_yn)? true: false;

      $this->invoice_number->Enabled =  ! $accounted_yn;
      $this->invoice_dt->Enabled =  ! $accounted_yn;
      $this->other_income_amt->Enabled =  ! $accounted_yn;
      $this->base_withholding_amt->Enabled =  ! $accounted_yn;
      $this->withholding_rate_no->Enabled =  ! $accounted_yn;
      $this->gridInvoice_issued_tax->ReadOnly = $accounted_yn;
      $this->lbError->Caption = "";
      $this->Attached->Visible =  ! $accounted_yn;
      $this->imgOpenInvoice->Visible = ( ! empty($record['link']) && file_exists($record['link']));
      $this->imgOpenInvoice->Link = $record['link'];
      $this->lbAttached_invoice->Visible = $this->Attached->Visible || $this->imgOpenInvoice->Visible;
      if($accounted_yn)
      {
         //Accounting provider data
         $record_accounting_provider = sw_get_data_table("vw_accountant_manager", "accounting_provider_id = {$_SESSION['accounting_provider_id']}");
         $this->lbError->Caption = "Invoice already accounted, please contact " . ($record_accounting_provider['email']? $record_accounting_provider['accounting_provider_name'] . " ({$record_accounting_provider['email']})": $_SESSION['settings']['se_accounting_email']);
      }

      $items['btnAdd'] = array(btnAdd,  ! $accounted_yn, "2");
      $items['btnDelete'] = array(btnDelete,  ! $accounted_yn, "6");
      $items['btnEdit'] = array(btnEdit,  ! $accounted_yn, "3");
      $items['btnSave'] = array(btnSave,  ! $accounted_yn, "5");
      $items['btnCancel'] = array(btnCancel,  ! $accounted_yn, "4");
      $this->btnTaxes->Items = $items;

      $this->BtnAgreeInvoiceDetail->Enabled =  ! $accounted_yn;

      $this->company_client_id->SelectedValue = $record['company_client_id'];
      $this->client_name->text = $record['client_name'];
      $this->tax_ident->text = $record['tax_ident'];
      $this->invoice_number->text = $record['invoice_number'];
      $this->invoice_dt->Date = $record['invoice_dt'];
      $this->lbRegistration_date->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->registration_date->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->registration_date->Date = $record['registered_in_acctg_software_dt'];
      $this->registration_date->Enabled =  ! $accounted_yn;

      $this->lbDocument_ident->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->document_ident->text = $record['document_ident'];
      $this->document_ident->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->document_ident->enabled =  ! $record['document_ident'];

      $this->View_total_invoice($record);
      $this->winDetail->ShowModal();
   }

   function DeleteInvoiceSelected()
   {
      Global $connectionDB;

      $sql = "SELECT * FROM invoice_issued
              WHERE (company_id = {$_SESSION['company_id']}) AND (accounted_yn = 0) AND
               			(invoice_issued_id in ({$this->SelectedKeysField->Value}))";
      $record = sw_records_array($sql, array("invoice_issued_id", "link"));

      foreach($record as $invoice_issued_id=>$link)
      {
         if($record[$invoice_issued_id] != "")
         {
            $file = utf8_decode($record[$invoice_issued_id]);
            if(file_exists($file))
            {
               unlink($file);
               sw_delete_register_file($file);
            }
         }

         //$sw_company_is_strong = sw_company_is_strong();
         //$sql = "CALL sp_delete_invoice_issued($invoice_issued_id, $sw_company_is_strong)";
         //TS 11/2016: boolean false converts to empty string which gives SQL error.
         $is_strong_string = (sw_company_is_strong())? '1': '0';
         $sql = "CALL sp_delete_invoice_issued($invoice_issued_id, $is_strong_string)";
         $connectionDB->DbConnection->BeginTrans();
         $connectionDB->DbConnection->execute($sql);
         $connectionDB->DbConnection->CompleteTrans();
      }
      $this->gridInvoice_issued->writeSelectedCells(array());
      $this->invoice_issued_id->Value = 0;
   }

   function Dis_accounting()
   {
      Global $connectionDB;

      $sql = "UPDATE invoice_issued
              SET accounted_yn = !accounted_yn,
                  status_cd = CASE WHEN accounted_yn THEN '" . SW_STATUS_IS_CLOSE . "' ELSE '" . SW_STATUS_IS_OPEN . "' END
      				WHERE (company_id = {$_SESSION['company_id']}) AND (invoice_issued_id in ({$this->SelectedKeysField->Value}))";
      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->gridInvoice_issued->writeSelectedCells(array());
      $this->invoice_issued_id->Value = 0;
   }

   Function PaidInvoiceIssued()
   {
      if($this->SelectedKeysField->Value)
      {

         $this->lbPaid_amt->Caption = SW_CAPTION_PAID_AMT;
         $this->lbPaid_by->Caption = SW_CAPTION_PAID_BY;
         $this->lbPaid_dt->Caption = SW_CAPTION_PAID_DT;
         $this->lbPayment_method->Caption = SW_CAPTION_PAYMENT_METHOD;
         $this->lbBank_account->Caption = SW_CAPTION_BANK_ACCOUNT;

         $invoice_issued_id = $this->SelectedKeysField->Value;
         $record = sw_get_data_table("invoice_issued", "invoice_issued_id = {$invoice_issued_id}");
         $this->paid_dt->date = date('Y-m-d');
         $this->paid_by->Text = '';
         $this->paid_amt->Text = ($record['total_amt'] - $record['paid_amt']);
         $this->winPaid->Caption = btnPaid;
         $this->winPaid->ActiveLayer = 'Paid';
         $this->winPaid->ShowModal();
      }
   }

   function UnPaidInvoiceIssued()
   {
      if($this->SelectedKeysField->Value)
      {
         Global $connectionDB;

         $sql = "UPDATE invoice_issued
                SET status_cd = CASE WHEN status_cd != '" . SW_STATUS_IS_UNPAID . "' THEN '" . SW_STATUS_IS_UNPAID . "'
                                     WHEN accounted_yn THEN '" . SW_STATUS_IS_CLOSE . "' ELSE '" . SW_STATUS_IS_OPEN . "' END
      				  WHERE (invoice_issued_id in ({$this->SelectedKeysField->Value})) AND
                      (total_amt != paid_amt)";
         $connectionDB->DbConnection->BeginTrans();
         $connectionDB->DbConnection->execute($sql);
         $connectionDB->DbConnection->CompleteTrans();
         $this->gridInvoice_issued->writeSelectedCells(array());
         $this->invoice_issued_id->Value = 0;
      }
   }

   function btnCloseRegistrationJSClick($sender, $params)
   {
      ?>
        //begin js
        document.getElementById( "winRegistrationChange" ).Hide();
        return false;
        //end
      <?php
   }

   function btnSaveRegistrationClick($sender, $params)
   {
      Global $connectionDB;

      $sql = "UPDATE invoice_issued SET registered_in_acctg_software_dt = '{$this->registration_change->date}'
      				WHERE (accounted_yn = 0) AND (invoice_issued_id in ({$this->SelectedKeysField->Value}))";
      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->registration_change->date = '';
   }

   function btnCloseInvoiceDetailClick($sender, $params)
   {
      $this->winDetail->Hide();
   }

   function company_client_idJSChange($sender, $params)
   {
      $components = array("client_name", "tax_ident");
      echo $this->company_client_id->ajaxCall("ClientData", array(), $components);
      ?>
        //begin js
        return false;
        //end
      <?php
   }

   function ClientData()
   {
      $client_id = $this->company_client_id->SelectedValue;

      $record = sw_get_data_table("company_client", "company_client_id = {$client_id}");
      $this->client_name->Enabled =  ! $record['client_name']? true: false;
      $this->tax_ident->Enabled =  ! $record['tax_ident']? true: false;
      $this->client_name->text = $record['client_name']? $record["client_name"]: $this->client_name->text;
      $this->tax_ident->text = $record['tax_ident']? $record['tax_ident']: $this->tax_ident->text;
   }

   function other_income_amtJSChange($sender, $params)
   {
      $components = array("other_income_amt", "total_amt");
      echo "params = [0];";
      echo $this->base_withholding_amt->ajaxCall("Calculate_invoice", array(), $components);
      ?>
        //begin js
        return false;
        //end
      <?php
   }

   function base_withholding_amtJSChange($sender, $params)
   {
      $components = array("base_withholding_amt", "withholding_amt", "total_amt");
      echo "params = [0];";
      echo $this->base_withholding_amt->ajaxCall("Calculate_invoice", array(), $components);
      ?>
        //begin js
        return false;
        //end
      <?php
   }

   function withholding_rate_noJSChange($sender, $params)
   {
      $components = array("withholding_rate_no", "withholding_amt", "total_amt");
      echo "params = [0];";
      echo $this->base_withholding_amt->ajaxCall("Calculate_invoice", array(), $components);
      ?>
        //begin js
        return false;
        //end
      <?php
   }

   //Calculate invoice
   function Calculate_invoice($sender, $params)
   {
      $update = $params[0];

      $invoice_issued_id = $this->invoice_issued_id->value;
      $where = "(invoice_issued_id = {$invoice_issued_id})";

      $tax_ident = sw_clean_caracter_tax_ident($this->tax_ident->text);
      if( ! $this->company_client_id->SelectedValue){
		 		$record_client = sw_get_data_table('company_client', "tax_ident = '{$tax_ident}' AND company_id = {$_SESSION['company_id']}", "company_client_id");
        $record['company_client_id'] = $record_client['company_client_id'];
      }
			else $record['company_client_id'] = $this->company_client_id->SelectedValue;

      $record['client_name'] = strtoupper($this->client_name->text);
      $record['tax_ident'] = $tax_ident;
      $record['invoice_number'] = strtoupper($this->invoice_number->text);
      $record['invoice_dt'] = $this->invoice_dt->Date;

      $record['subtotal_amt'] = '0';
      $record['tax_amt'] = '0';
      $record['overhead_amt'] = '0';
      foreach($this->gridInvoice_issued_tax->CellData as $key=>$record_tax){
				$record['subtotal_amt'] += $record_tax['base_amt'];
        $record['tax_amt'] += $record_tax['tax_amt'];
        $record['overhead_amt'] += $record_tax['overhead_amt'];
      }

      $record['other_income_amt'] = $this->other_income_amt->text? floatval(sw_convert_comma_point($this->other_income_amt->text)): 0;
      $record['base_withholding_amt'] = $this->base_withholding_amt->text? floatval(sw_convert_comma_point($this->base_withholding_amt->text)): 0;
      $record['withholding_rate_no'] = $this->withholding_rate_no->text? floatval(sw_convert_comma_point($this->withholding_rate_no->text)): 0;
      $record['withholding_amt'] = number_format($record['base_withholding_amt'] * ($record['withholding_rate_no'] / 100), 2, '.', '');

      //Total amount invoice
      $record['subtotal_amt'] = number_format($record['subtotal_amt'], 2, '.', '');
      $record['tax_amt'] = number_format($record['tax_amt'], 2, '.', '');
      $record['overhead_amt'] = number_format($record['overhead_amt'], 2, '.', '');
      $record['total_amt'] = number_format(($record['subtotal_amt'] + $record['tax_amt'] + $record['overhead_amt'] + $record['other_income_amt']) - $record['withholding_amt'], 2, '.', '');

      $this->View_total_invoice($record);

      //Valid and Update Invoice
      if(($update) && ($return = $this->ValidInvoice())) {
      	//Assign registered accountant
        sw_assign_registered_accountant($record, $this->registration_date->Date);

        //Assign value
        list($year, $month, $day) = explode('-', $record['registered_in_acctg_software_dt']);
        $record['document_ident'] = ($this->document_ident->text)? $this->document_ident->text: sw_get_last_document_issued($year) + 1;

        //Add Invoice
        if( ! $this->invoice_issued_id->value){
					$record['company_id'] = $_SESSION['company_id'];
          $record['created_by_user_id'] = $_SESSION['user_id'];
          $record['created_dt'] = date('Y-m-d H:i:s');
          sw_insert_table("invoice_issued", $record);
          $this->invoice_issued_id->value = mysql_insert_id();
        } else {
					//Update Invoice received
          sw_update_table('invoice_issued', $record, $where);
        }

        //Update Tax
        $record_tax = $this->gridInvoice_issued_tax->CellData;

        $this->sqlInvoice_issued_tax->close();
        $this->sqlInvoice_issued_tax->sql = "SELECT * FROM invoice_issued_tax Where invoice_issued_id = {$this->invoice_issued_id->value}";
        $this->sqlInvoice_issued_tax->open();
        While( ! $this->sqlInvoice_issued_tax->EOF){
					$invoice_issued_tax_id = $this->sqlInvoice_issued_tax->Fields['invoice_issued_tax_id'];
          $where_tax = $where . " AND (invoice_issued_tax_id = {$invoice_issued_tax_id})";
          $search = false;

          foreach($record_tax as $key=>$tax_record){
				 		//Update Tax exist
            if($search = ($tax_record['invoice_issued_tax_id'] == $invoice_issued_tax_id)){
							sw_update_table("invoice_issued_tax", $record_tax[$key], $where_tax);
              array_splice($record_tax, $key, 1);
              break;
            }
          }

          if (!$search) sw_delete_table("invoice_issued_tax", $where_tax);
					$this->sqlInvoice_issued_tax->next();
			 	}

        //Insert new record
        foreach($record_tax as $key=>$tax_record){
					$tax_record['invoice_issued_tax_id'] = '';
          $tax_record['invoice_issued_id'] = $this->invoice_issued_id->value;
          sw_insert_table("invoice_issued_tax", $tax_record);
			 	}

        //Attached invoice
        $attached['registered_in_acctg_software_dt'] = $record['registered_in_acctg_software_dt'];
        $attached['client_name'] = $record["client_name"];
        if($return = $this->Attached_invoice_issued($this->invoice_issued_id->value, $attached)) {
					$where = "(invoice_issued_id = {$this->invoice_issued_id->value})";
          sw_update_table('invoice_issued', $attached, $where);
			 	}

        $this->gridInvoice_issued->writeSelectedCells(array());
			}

      return $return;
   }

   function invoice_numberJSChange($sender, $params)
   {
      $components = array("lbError");
      echo $this->invoice_number->ajaxCall("ValidInvoice", array(), $components);
      ?>
        //begin js
        return false;
        //end
      <?php
   }

   function ValidInvoice()
   {
      Global $lbInvoiceIsAlreadyCreate_error, $lbInvoiceDateInvalid, $lbSelectClient_error;

      $invoice_number = $this->invoice_number->text;
      $invoice_dt = $this->invoice_dt->date;
      $msg = "";

      //Valid Invoice date
      if( ! $invoice_dt)
      {
         $msg = $lbInvoiceDateInvalid;
      }

      //Valid Invoice
      $where = "(company_id = {$_SESSION['company_id']}) AND (invoice_issued_id != {$this->invoice_issued_id->Value}) AND
                (invoice_number = '{$invoice_number}') AND (invoice_dt = '{$invoice_dt}') AND (tax_ident = '{$this->tax_ident->text}')";
      if(( ! $msg) && $record = sw_get_data_table("invoice_issued", $where))
      {
         $msg = $lbInvoiceIsAlreadyCreate_error;
      }

      //Valid client
      if(( ! $msg) && ( ! $this->company_client_id->SelectedValue))
      {
         $msg = $lbSelectClient_error;
      }
      $this->ClientData();

      $this->lbError->caption = $msg;

      return ($msg == "");
   }

   function Attached_invoice_issued($invoice_issued_id, &$record)
   {
      Global $VirtualFile, $lblFileSizeTooBig, $ftpMaxFileSize;

      if( ! $this->Attached->filename)
         return true;

      $msg = "";
      $file = "";

      if($return = $this->Attached->isUploadedFile())
      {
         if(strtoupper($this->Attached->FileExt) == 'PDF')
         {

            $year = date("Y", strtotime($record["registered_in_acctg_software_dt"]));
            $client = utf8_decode($record["client_name"]);

            $dir = $VirtualFile . TMP_INVOICE_ISSUED_UPLOAD;
            $dir = strtolower($dir . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR);
            if( ! file_exists($dir))
            {
               mkdir($dir, 0777, true);
            }

            $file = utf8_encode("invoice " . $year . " {$invoice_issued_id} " . $_SESSION["short_name"] . " {$client}.pdf");
						$file = sw_checked_file_valid_name(sw_clean_characters_spanish($file));
            $file = strtolower($dir . $file);
            if(file_exists($file))
               unlink($file);

            if( ! $this->Attached->moveUploadedFile($file))
               $file = "";
            $record["link"] = $file;
         }
         else
         {
            $msg = "Invalid format, only PDF files";
         }
      }
      else
         if($file)
         {
            $msg = $lblFileSizeTooBig . " (max. " . $ftpMaxFileSize . " bytes)";
         }

      $this->lbError->Caption = $msg;

      return ($msg == "");
   }

   function add_clientClick($sender, $params)
   {
      $_SESSION['page_return'] = 'invoice_issued.php';
      $_SESSION['selected_company_client_id'] = 0;
      if(sw_company_is_strong())
         redirect_url("company_client_edit.php");
      else
         redirect_url("company_client.php");
   }

   function gridInvoice_issued_taxJSSelect($sender, $params)
   {
      ?>
        //begin js
        document.getElementById("rowTax").value = row;
        //end
      <?php
   }

   function gridInvoice_issued_taxInsert($sender, $params)
   {
      //Insert
      if(count($params) == 1){
      	$fields = &$params[0];
      }
      else {
         //update
         $fields = &$params[1];
         $fields['invoice_issued_tax_id'] = $params[0];
      }

      $fields['base_amt'] = sw_convert_comma_point($fields['base_amt']);
      $where = $fields['tax_rate_id']? "tax_rate_id = {$fields['tax_rate_id']}": "rate_no = 0";
      if($record_tax = sw_get_data_table('tax_rate', $where)) {
      	//Search tax_rate_id
        $fields['tax_rate_id'] = $record_tax['tax_rate_id'];
        $fields['rate_no'] = $record_tax['rate_no'];

        $record_tax = $this->gridInvoice_issued_tax->CellData;
        foreach($record_tax as $key=>$record){
					if($search = ($record['tax_rate_id'] == $fields['tax_rate_id'])){
				 		if($record['invoice_issued_tax_id'] == $fields['invoice_issued_tax_id'])
            	$record_tax[$key]['base_amt'] = $fields['base_amt'];
            else
            	$record_tax[$key]['base_amt'] += $fields['base_amt'];

            $record_tax[$key]['tax_amt'] = round($record_tax[$key]['base_amt'] * ($fields['rate_no'] / 100), 2);
						$record_tax[$key]['overhead_rate_no'] = $fields['overhead_rate_no'];
            $record_tax[$key]['overhead_amt'] = round($record_tax[$key]['base_amt'] * ($fields['overhead_rate_no']/100),2);
            break;
          }
        }

        if(( ! $fields['invoice_issued_tax_id']) && ( ! $search)){
					$fields['tax_amt'] = round($fields['base_amt'] * ($fields['rate_no'] / 100), 2);
          $fields['overhead_amt'] = round($fields['base_amt'] * ($fields['overhead_rate_no']/100),2);
          $fields['invoice_issued_tax_id'] = count($this->gridInvoice_issued_tax->CellData) + 1;
					array_push($record_tax, $fields);
			 	}

        $this->gridInvoice_issued_tax->CellData = $record_tax;
      }
      else
         return false;
   }

   function gridInvoice_issued_taxDelete($sender, $params)
   {
      $fields = &$params[0];

      $record_tax = $this->gridInvoice_issued_tax->CellData;
      foreach($this->gridInvoice_issued_tax->CellData as $key=>$record) {
		 		if($record['invoice_issued_tax_id'] == $fields[0]){
            array_splice($record_tax, $key, 1);
        }
      }
      $this->gridInvoice_issued_tax->CellData = $record_tax;
   }

   function BtnAgreeInvoiceDetailClick($sender, $params)
   {
      $params[0] = True;
      if($this->Calculate_invoice($sender, $params))
      {
         $this->winDetail->Hide();
      }
   }

   function btnTaxesJSClick($sender, $params)
   {
      $components = array('subtotal_amt', 'tax_amt', 'overhead_amt', 'other_income_amt', 'base_withholding_amt', 'withholding_rate_no', 'withholding_amt', 'total_amt');
      ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowTax").value;

          if (toolButton == 'btnTaxes'){
              if (toolButtonName == 'btnAdd') { gridInvoice_issued_tax.Insert(); return false;}
              else if (toolButtonName == 'btnEdit') {
                 if ((row != "-1") && (row != "")) { gridInvoice_issued_tax.Edit(row); }
                 return false;
              }
              else if (toolButtonName == 'btnCancel') { gridInvoice_issued_tax.Cancel(); return false;}
              else if (toolButtonName == 'btnSave') { gridInvoice_issued_tax.Post(); }
              else if (toolButtonName == 'btnDelete' && (row != "-1") && (row != "")) { gridInvoice_issued_tax.Delete(row);}

              params = [0];
      				<?php
      					echo $this->btnTaxes->ajaxCall("Calculate_invoice", array(), $components);
      				?>
              return false;
          }
        //end
      	<?php
   	}

   function SelectTemplateImport()
   {
			Global $template_invoice_strong;

			$enabled = $this->cbTemplateImport->ItemIndex != 0;

			$this->Upload->Visible = $enabled;

      //Template Strong Abogados
			$this->col_invoice_date->Enabled = $enabled;
      $this->col_invoice_date->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_invoice_date'];

			$this->col_invoice_number->Enabled = $enabled;
      $this->col_invoice_number->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_invoice_number'];

			$this->col_tax_ident->Enabled = $enabled;
      $this->col_tax_ident->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_tax_ident'];

			$this->col_client_name->Enabled = $enabled;
      $this->col_client_name->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_client_name'];

			$this->col_subtotal_amount->Enabled = $enabled;
      $this->col_subtotal_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_subtotal_amount'];

			$this->col_transport_amount->Enabled = $enabled;
      $this->col_transport_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_transport_amount'];

			$this->col_other_amount->Enabled = $enabled;
      $this->col_other_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_other_amount'];

			$this->col_tax_rate->Enabled = $enabled;
      $this->col_tax_rate->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_tax_rate'];

			$this->col_tax_amount->Enabled = $enabled;
      $this->col_tax_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_tax_amount'];

			$this->col_total_amount->Enabled = $enabled;
      $this->col_total_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_total_amount'];

			$this->col_base_withholding_amount->Enabled = $enabled;
      $this->col_base_withholding_amount->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_base_withholding_amount'];

			$this->col_withholding_rate->Enabled = $enabled;
      $this->col_withholding_rate->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_withholding_rate'];

			$this->registration_dt->Enabled = $enabled;
      $this->beginning_row->Text = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['beginning_row'];
   }


   function cbTemplateImportJSChange($sender, $params)
   {
      echo $this->cbTemplateImport->ajaxCall("SelectTemplateImport");
      ?>
        //begin js
        return false;
        //end
      <?php
   }


   function gridInvoice_issuedSummaryData($sender, $params)
   {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
   }

   function gridInvoice_issued_paidSQL($sender, $params)
   {
      list($sortSql, $sortFields, $filterSql) = $params;

      GLOBAL $language;

      $sql = "SELECT invoice_issued_paid.*, company_bank_account.bank_account_name,
      				payment_method.{$language} as payment_method_name, user.username
							FROM invoice_issued_paid
       						LEFT JOIN user ON invoice_issued_paid.created_by_user_id = user.user_id
     							LEFT JOIN company_bank_account ON invoice_issued_paid.bank_account_id = company_bank_account.bank_account_id
     							LEFT JOIN payment_method ON invoice_issued_paid.payment_method_id = payment_method.payment_method_id
							WHERE invoice_issued_paid.invoice_issued_id = '{$this->invoice_issued_id->Value}' ";

      if(($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
         $sql .= " AND " . $filterSql;

      if($sortSql)
         $sql .= " ORDER BY $sortSql";

      $sender->Datasource->DataSet->SQL = $sql;
   }

   function gridInvoice_issued_paidUpdate($sender, $params)
   {
      $paid = $params[0];
      $fields = $params[1];

      $fields['paid_amt'] = sw_convert_comma_point($fields['paid_amt']);

      sw_update_table("invoice_issued_paid", $fields, "invoice_issued_paid_id in ({$paid})");
      sw_UpdateInvoiceIssuedPaid($fields['invoice_issued_id']);
   }

   function gridInvoice_issued_paidDelete($sender, $params)
   {
      $paid = implode(",", $params[0]);

      if($fields = sw_get_data_table("invoice_issued_paid", "accounted_yn = 0 AND invoice_issued_paid_id in ({$paid})"))
      {
         sw_delete_table("invoice_issued_paid", "accounted_yn = 0 AND invoice_issued_paid_id in ({$paid})");
         sw_UpdateInvoiceIssuedPaid($fields['invoice_issued_id']);
      }
   }

   function btnSavePaymentClick($sender, $params)
   {
      $where = "invoice_issued_id in ({$this->SelectedKeysField->Value})";

      //Insert Service Agreement Paid
      $record_paid['invoice_issued_id'] = $this->SelectedKeysField->Value;
      $record_paid['payment_method_id'] = $this->payment_method_id->SelectedValue;
      $record_paid['bank_account_id'] = $this->bank_account_id->SelectedValue;
      $record_paid['paid_dt'] = $this->paid_dt->Date;
      $record_paid['paid_by'] = $this->paid_by->Text;
      $record_paid['paid_amt'] = $this->paid_amt->Text;
      $record_paid['created_by_user_id'] = $_SESSION['user_id'];
      $record_paid['created_dt'] = date('Y-m-d H:i:s');

      sw_insert_table("invoice_issued_paid", $record_paid);
      sw_UpdateInvoiceIssuedPaid($this->SelectedKeysField->Value);
   }

   function winPaidJSShow($sender, $params)
   {
      ?>
        //begin js
        document.getElementById("paid_amt").focus();
        //end
      <?php
   }

    function gridInvoice_issued_taxJSDataLoad($sender, $params)
    {
        ?>
        //begin js
        var session = '<?php echo session_id(); ?>';
				["change", "focus"].forEach(function(event) {
       		document.getElementById("gridInvoice_issued_tax_tax_rate_id_Editor").addEventListener(event, function(){
						sw_change_tax_rate('gridInvoice_issued_tax_tax_rate_id_Editor', 'gridInvoice_issued_tax_overhead_rate_no_Editor', session); });
				});

				["focus"].forEach(function(event) {
       		document.getElementById("gridInvoice_issued_tax_overhead_rate_no_Editor").addEventListener(event, function(){
						sw_change_tax_rate('gridInvoice_issued_tax_tax_rate_id_Editor', 'gridInvoice_issued_tax_overhead_rate_no_Editor', session); });
				});
        //end
        <?php
    }


}

global $application;

global $invoice_issued;

//Creates the form
$invoice_issued = new invoice_issued($application);

//Read from resource file
$invoice_issued->loadResource(__FILE__);

header("Content-type: text/html; charset=utf-8");

//Shows the form
if(isset($_SESSION['username']))
   $invoice_issued->show();

?>
