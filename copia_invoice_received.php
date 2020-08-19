<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once('include/accounting.php');

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgrid.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");

//Class definition
class invoice_received extends fmstrong
{
    public $record_accounting = null;
    public $dtToExport = null;
    public $lbSelectTemplate = null;
    public $cbTemplateImport = null;
    public $lbDocument_id = null;
    public $col_document_id = null;
    public $btnCloseRegistration = null;
    public $btnSaveRegistration = null;
    public $registration_change = null;
    public $lbRegistration_change = null;
    public $registration_dt = null;
    public $Attached = null;
    public $gridInvoice_received = null;
    public $winExport = null;
    public $cbExportAccounting = null;
    public $BtnCloseExport = null;
    public $BtnExport = null;
    public $cbCreateAccount = null;
    public $lbFromExport = null;
    public $lbToExport = null;
    public $winUpload = null;
    public $btnCloseUpload = null;
    public $btnImport = null;
    public $gbParameter = null;
    public $lbTax_id = null;
    public $lbSubtotal_amount = null;
    public $lbTax_amount = null;
    public $lbBeginning_row = null;
    public $beginning_row = null;
    public $lbInvoice_dt = null;
    public $lbInvoice_number1 = null;
    public $lbTax_percentage = null;
    public $lbTransport_amt = null;
    public $lbTotal_amount = null;
    public $lbClient_name = null;
    public $col_invoice_date = null;
    public $col_tax_ident = null;
    public $col_subtotal_amount = null;
    public $col_tax_rate = null;
    public $col_total_amount = null;
    public $col_invoice_number = null;
    public $col_provider_name = null;
    public $col_transport_amount = null;
    public $col_tax_amount = null;
    public $lbOther_expense_amount = null;
    public $col_other_expense_amount = null;
    public $lbWithholding_rate = null;
    public $col_withholding_rate = null;
    public $lbBase_withholding1 = null;
    public $col_base_withholding_amount = null;
    public $invoice_received_id = null;
    public $rowTax = null;
    public $btnInvoices = null;
    public $rowInvoice = null;
    public $winDetail = null;
    public $gbProviderData = null;
    public $lbprovider_id = null;
    public $company_provider_id = null;
    public $lbprovider_name = null;
    public $lbtax_ident = null;
    public $provider_name = null;
    public $tax_ident = null;
    public $add_provider = null;
    public $lbExpense_type = null;
    public $expense_type_id = null;
    public $gbInvoice = null;
    public $lbInvoice_number = null;
    public $invoice_number = null;
    public $lbInvoice_date = null;
    public $invoice_dt = null;
    public $payment_due_dt = null;
    public $lbPayment_due_dt = null;
    public $lbSubtota_amt = null;
    public $subtotal_amt = null;
    public $lbTax_amt = null;
    public $tax_amt = null;
    public $total_amt = null;
    public $lbTotal_amt = null;
    public $lbOther_expense_amt = null;
    public $other_expense_amt = null;
    public $lbBase_withholding = null;
    public $base_withholding_amt = null;
    public $lbWithholding_rate_no = null;
    public $withholding_rate_no = null;
    public $lbwithholding_amt = null;
    public $withholding_amt = null;
    public $gridInvoice_received_tax = null;
    public $btnTaxes = null;
    public $BtnAgreeInvoiceDetail = null;
    public $btnCloseInvoiceDetail = null;
    public $sqlInvoice_received_tax = null;
    public $dsInvoice_received_tax = null;
    public $sqlInvoice_received = null;
    public $dsInvoice_received = null;
    public $sqlCompany_provider = null;
    public $dsCompany_provider = null;
    public $SiteTheme = null;
    public $sqlTax_rate = null;
    public $dsTax_rate = null;
    public $ImageList = null;
    public $sqlExpense_type = null;
    public $dsExpense_type = null;
    public $lbCol_provider_name = null;
    public $lbError = null;
    public $lbAttached_invoice = null;
    public $lbRegistration_dt = null;
    public $lbRegistration_date = null;
    public $registration_date = null;
    public $winRegistrationChange = null;
    public $lbDocument_ident = null;
    public $document_ident = null;
    public $Upload = null;
    public $dtFromExport = null;
    public $cbExportSelectedInvoices = null;


    function invoice_receivedCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterInvoiceIssued();
    }

    function ParameterInvoiceIssued()
    {
      Global $connectionDB, $MonthLetter, $template_import_invoice;

      Define('COL_TAX_IDENT', $this->gridInvoice_received->findColumnByName('tax_ident'));
      Define('COL_PDF', $this->gridInvoice_received->findColumnByName('img_pdf'));
      Define('COL_ACCOUNT_CD', $this->gridInvoice_received->findColumnByName('account_cd'));
      Define('COL_REGISTRATION_DT', $this->gridInvoice_received->findColumnByName('registered_in_acctg_software_dt'));
      Define('COL_DOCUMENT_IDENT', $this->gridInvoice_received->findColumnByName('document_ident'));
      Define('COL_ACCOUNTED_YN', $this->gridInvoice_received->findColumnByName('accounted_yn'));
      Define('COL_EXPORT_DT', $this->gridInvoice_received->findColumnByName('export_dt'));
      Define('COL_CREATED_USER', $this->gridInvoice_received->findColumnByName('created_by_user_id'));
      Define('COL_CREATED_DT', $this->gridInvoice_received->findColumnByName('created_dt'));
      Define('COL_LINK', $this->gridInvoice_received->findColumnByName('link'));
      $this->record_accounting = sw_get_company_accounting($_SESSION['company_id']);

      if (isset($_SESSION['page_return'])){
        $this->invoice_received_id->Value = $_SESSION['page_return'][1];
        unset($_SESSION['page_return']);
      }

      $company_id = 0;
      if (isset($_SESSION['company_id'])) {
          $company_id = $_SESSION['company_id'];
      }
      $enable = ($company_id != 0);
      $visible = ($enable && ($_SESSION['IsSuperadmin']));

      $this->lbTitle->Caption = $enable ? Title_Invoice_receive . " (" . $_SESSION['short_name'] . ")" : Title_Invoice_receive;
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "9");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      if ($visible){
        $items['btnSave'] = array(btnSave, $visible, "5");
        $items['btnCancel'] = array(btnCancel, $visible, "4");
        $items['btnUnMark'] = array(btnUnMark, $visible, "3");
      }

      $this->gridInvoice_received->ReadOnly = !$enable;
      $this->gridInvoice_received->Columns[COL_ACCOUNT_CD]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_REGISTRATION_DT]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_EXPORT_DT]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_DOCUMENT_IDENT]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_CREATED_USER]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_CREATED_DT]->Visible = $visible;
      $this->gridInvoice_received->Columns[COL_ACCOUNTED_YN]->CanEdit = $visible;
      $this->gridInvoice_received->Columns[COL_REGISTRATION_DT]->CanEdit = $visible;
      $this->gridInvoice_received->Columns[COL_EXPORT_DT]->CanEdit = $visible;

      if ($visible){
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

      //Company Provider
      $this->sqlCompany_provider->close();
      $this->sqlCompany_provider->Params = array($company_id);
      $this->sqlCompany_provider->open();

      //Expense type
      $language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
      $this->sqlExpense_type->close();
      $this->sqlExpense_type->OrderField = $language;
      $this->sqlExpense_type->SQL = "SELECT expense_type_id, {$language} as expense_name FROM expense_type ";
      $this->sqlExpense_type->open();
    }



    function gridInvoice_receivedSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql) = $params;

      if (strpos($filterSql, 'account_cd') !== False){
        $Column = $sender->Columns[$sender->findColumnByFieldName('account_cd')];
        $account_cd = sw_check_account($Column->Filter, $this->record_accounting['digit_account']);
        $filterSql = str_replace("account_cd LIKE '%{$Column->Filter}%'","account_cd LIKE '%{$account_cd}%'",$filterSql);
        $Column->Filter = $account_cd;
      }

      $sql = "SELECT invoice_received.invoice_received_id, invoice_received.company_id, invoice_received.company_provider_id,
                invoice_received.invoice_number, invoice_received.invoice_dt, invoice_received.tax_ident,
                invoice_received.provider_name, invoice_received.subtotal_amt, invoice_received.tax_amt,
                invoice_received.withholding_amt, invoice_received.other_expense_amt, invoice_received.total_amt,
                invoice_received.accounted_yn, invoice_received.export_dt, invoice_received.document_ident,
                invoice_received.registered_in_acctg_software_dt, invoice_received.link,
                invoice_received.created_by_user_id, invoice_received.created_dt, user.username, company_provider.account_cd
              FROM invoice_received
                  LEFT JOIN
                    (SELECT company_provider_id, account_cd FROM company_provider) AS company_provider
                    ON invoice_received.company_provider_id = company_provider.company_provider_id
                  LEFT JOIN user ON invoice_received.created_by_user_id = user.user_id
              WHERE (invoice_received.company_id = {$_SESSION['company_id']})";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlInvoice_received->SQL = $sql;
    }



    function gridInvoice_receivedDelete($sender, $params)
    {
      $fields = &$params[ 0 ];
      $invoice_received_id = $fields[ 0 ];

      sw_delete_table("invoice_received", "accounted_yn = 0 AND invoice_received_id = {$invoice_received_id}");
    }

    function gridInvoice_receivedRowEdited($sender, $params)
    {
      $fields = &$params[ 0 ];

      $invoice_received_id = $fields['invoice_received_id'];
      $record = sw_get_data_table("invoice_received", "invoice_received_id = {$invoice_received_id}", array('accounted_yn'));
      return ((!$record['accounted_yn']) || (!$fields['accounted_yn']));
    }

    function View_total_invoice($record)
    {
      $this->subtotal_amt->text = number_format($record['subtotal_amt'], 2, '.', '');
      $this->tax_amt->text = number_format($record['tax_amt'], 2, '.', '');
      $this->other_expense_amt->text = number_format($record['other_expense_amt'], 2, '.', '');
      $this->base_withholding_amt->text = number_format($record['base_withholding_amt'], 2, '.', '');
      $this->withholding_rate_no->text = number_format($record['withholding_rate_no'], 2, '.', '');
      $this->withholding_amt->text = number_format($record['withholding_amt'], 2, '.', '');

      $this->total_amt->text = number_format($record['total_amt'], 2, '.', '');
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
            if (!mkdir($dir)) $return = false;
          }

          $file = $dir . "/invoice_received_" . $_SESSION['company_id'] . "." . $this->Upload->FileExt;
          $this->Upload->moveUploadedFile($file);
        }
        else
        {
          $msg = "The selected file must be in excel format";
        }
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

      $col_invoice_date = $this->col_invoice_date->ItemIndex;
      $col_invoice_number = $this->col_invoice_number->ItemIndex;
      $col_tax_ident = $this->col_tax_ident->ItemIndex;
      $col_provider_name = $this->col_provider_name->ItemIndex;
      $col_subtotal_amount = $this->col_subtotal_amount->ItemIndex;
      $col_transport_amount = $this->col_transport_amount->ItemIndex;
      $col_other_expense_amount = $this->col_other_expense_amount->ItemIndex;
      $col_tax_rate = $this->col_tax_rate->ItemIndex;
      $col_tax_amount = $this->col_tax_amount->ItemIndex;
      $col_base_withholding_amount = $this->col_base_withholding_amount->ItemIndex;
      $col_withholding_rate = $this->col_withholding_rate->ItemIndex;
      $col_total_amount = $this->col_total_amount->ItemIndex;
      $col_document_id = $this->col_document_id->ItemIndex;

      $beginning_row = $this->beginning_row->position;
      $invoice_date_tmp   = "";
      $invoice_number_tmp = "";
      $invoice_tax_id_tmp = "";

      for ($row = (($beginning_row) ? $beginning_row : 2); $row <= $rows; $row++)
      {
        $invoice_date     = ($col_invoice_date) ? $worksheet->getCellByColumnAndRow($col_invoice_date - 1, $row)->getCalculatedValue() : "";
        if (gettype($invoice_date) !== 'string'){
          $invoice_date     = date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($invoice_date));
        }
        $invoice_number   = ($col_invoice_number) ? substr(trim($worksheet->getCellByColumnAndRow($col_invoice_number - 1, $row)->getCalculatedValue()), 0, 30) : "";
        $tax_ident        = ($col_tax_ident) ? substr(trim($worksheet->getCellByColumnAndRow($col_tax_ident - 1, $row)->getCalculatedValue()), 0, 20) : "";
        $tax_ident        = sw_clean_caracter_tax_ident($tax_ident);
        $provider_name    = ($col_provider_name) ? strtoupper(substr(trim($worksheet->getCellByColumnAndRow($col_provider_name - 1, $row)->getCalculatedValue()), 0, 200)) : "";
        $subtotal_amount  = ($col_subtotal_amount) ? trim($worksheet->getCellByColumnAndRow($col_subtotal_amount - 1, $row)->getCalculatedValue()) : "0";
        $transport_amount = ($col_transport_amount) ? trim($worksheet->getCellByColumnAndRow($col_transport_amount - 1, $row)->getCalculatedValue()) : "0";
        $other_expense_amount = ($col_other_expense_amount) ? trim($worksheet->getCellByColumnAndRow($col_other_expense_amount - 1, $row)->getCalculatedValue()) : "0";
        $tax_rate_no      = ($col_tax_rate) ? trim($worksheet->getCellByColumnAndRow($col_tax_rate - 1, $row)->getCalculatedValue()) : "0";
        $tax_rate_no      = ($tax_rate_no < 1) ? $tax_rate_no * 100 : $tax_rate_no;
        $tax_amount       = ($col_tax_amount) ? trim($worksheet->getCellByColumnAndRow($col_tax_amount - 1, $row)->getCalculatedValue()) : "0";
        $base_withholding_amount = ($col_base_withholding_amount) ? trim($worksheet->getCellByColumnAndRow($col_base_withholding_amount - 1, $row)->getCalculatedValue()) : "0";
        $withholding_rate_no = ($col_withholding_rate) ? trim($worksheet->getCellByColumnAndRow($col_withholding_rate - 1, $row)->getCalculatedValue()) : "0";
        $withholding_rate_no = ($withholding_rate_no < 1) ? $withholding_rate_no * 100 : $withholding_rate_no;
        $total_amount     = ($col_total_amount) ? trim($worksheet->getCellByColumnAndRow($col_total_amount - 1, $row)->getCalculatedValue()) : "0";
        $document_id      = ($col_document_id) ? trim($worksheet->getCellByColumnAndRow($col_document_id - 1, $row)->getCalculatedValue()) : "0";

        list( $year, $month, $day ) = explode( '-', $invoice_date );
        if (checkdate($month, $day, $year) && (strlen($invoice_date) != 0) && (strlen($invoice_number) != 0) && (strlen($tax_ident) != 0)){
          //Insert provider company
          $sql = "(company_id = {$company_id}) AND (tax_ident = '{$tax_ident}') ";
          if (!$record_provider = sw_get_data_table('company_provider', $sql)){
              $record_provider['company_id'] = $company_id;
              $record_provider['tax_ident']  = $tax_ident;
              $record_provider['provider_name'] = ($provider_name = !mb_check_encoding($provider_name, 'UTF-8') ? utf8_encode($provider_name) : $provider_name);
              $record_provider['country_id'] = sw_country_tax_ident($record_provider['tax_ident']);

              sw_insert_table("company_provider", $record_provider);
              $record_provider = sw_get_data_table('company_provider', $sql);
          }

          $company_provider_id = $record_provider['company_provider_id'];

          $sql = "(company_id = {$company_id}) AND
                  (invoice_number = '{$invoice_number}') AND
                  (invoice_dt = '{$invoice_date}') AND
                  (tax_ident = '{$tax_ident}')";
          $field = "invoice_received_id, company_id, invoice_number, invoice_dt, tax_ident, document_ident";
          $record = sw_get_data_table( 'invoice_received', $sql);
          if (!$record['accounted_yn']){
              $record['company_id']          = $company_id;
              $record['created_by_user_id']  = $_SESSION['master_user_id'];
              $record['invoice_number']      = strtoupper($invoice_number);
              $record['invoice_dt']          = $invoice_date;
              $record['company_provider_id'] = $company_provider_id;
              $record['tax_ident']           = $record_provider['tax_ident'];
              $record['provider_name']       = $provider_name;
              $record['expense_type_id']     = $record_provider['expense_type_id'];

              //Assign value
              sw_assign_registered_accountant($record, $this->registration_dt->Date);

              list( $year, $month, $day ) = explode( '-', $record['registered_in_acctg_software_dt'] );
              $document_id = ($document_id) ? $document_id : $this->get_last_document_ident($year) + 1;
              $record['document_ident'] = ($record['document_ident']) ? $record['document_ident'] : $document_id;

              if (!$record['invoice_received_id']) {
                 $record['created_dt'] = date('Y-m-d H:i:s');
                 sw_insert_table("invoice_received", $record);
              }

              if ($record_invoice = sw_get_data_table('invoice_received', $sql)){
                $record['invoice_received_id'] = $record_invoice['invoice_received_id'];

                //Insert invoice tax
                $sql = "(invoice_received_id = {$record['invoice_received_id']})";
                if (($invoice_date != $invoice_date_tmp) || ($invoice_number != $invoice_number_tmp)) {
                    sw_delete_table('invoice_received_tax', $sql);
                }

                //search invoice tax
                if ($record_tax_rate = sw_get_tax_rate($tax_rate_no)){
                  $sql_tax = "(invoice_received_id = {$record['invoice_received_id']}) AND (tax_rate_id = {$record_tax_rate['tax_rate_id']})";
                  if (!$record_tax = sw_get_data_table('invoice_received_tax', $sql_tax)) {
                    $record_tax['invoice_received_id'] = $record_invoice['invoice_received_id'];
                    $record_tax['tax_rate_id'] = $record_tax_rate['tax_rate_id'];
                    $record_tax['rate_no'] = $record_tax_rate['rate_no'];
                    $record_tax['base_amt'] = round(floatval($subtotal_amount) + floatval($transport_amount), 2);
                    $record_tax['tax_amt'] = round($record_tax['base_amt'] * ($record_tax['rate_no']/100), 2);
                    sw_insert_table("invoice_received_tax", $record_tax);
                  }
                  else {
                    $record_tax['base_amt'] += round(floatval($subtotal_amount) + floatval($transport_amount), 2);
                    $record_tax['tax_amt'] = round($record_tax['base_amt'] * ($record_tax['rate_no']/100), 2);
                    sw_update_table("invoice_received_tax", $record_tax, $sql_tax);
                  }
                }

                //Calc Invoice
                if (($invoice_date === $invoice_date_tmp) AND
                    ($invoice_number === $invoice_number_tmp) AND
                    ($tax_ident === $invoice_tax_id_tmp)) {
                  $record['subtotal_amt']     += round(floatval($subtotal_amount), 2);
                  $record['transport_amt']    += round(floatval($transport_amount), 2);

                  $record['other_expense_amt'] += round(floatval($other_expense_amount), 2);
                  $record['base_withholding_amt'] += round(floatval($base_withholding_amount), 2);
                  $record['withholding_rate_no']  += round(floatval($withholding_rate_no), 2);
                  $record['withholding_amt'] += round((floatval($base_withholding_amount) * (floatval($withholding_rate_no)/100)), 2);
                }
                else {
                  $record['subtotal_amt']     = round(floatval($subtotal_amount), 2);
                  $record['transport_amt']    = round(floatval($transport_amount), 2);

                  $record['other_expense_amt'] = round(floatval($other_expense_amount), 2);
                  $record['base_withholding_amt'] = round(floatval($base_withholding_amount), 2);
                  $record['withholding_rate_no']  = round(floatval($withholding_rate_no), 2);
                  $record['withholding_amt'] = round((floatval($base_withholding_amount) * (floatval($withholding_rate_no)/100)), 2) ;
                  $invoice_date_tmp     = $invoice_date;
                  $invoice_number_tmp   = $invoice_number;
                  $invoice_tax_id_tmp   = $tax_ident;
                }

                $tax_amount = sw_get_data_table('invoice_received_tax', "(invoice_received_id = {$record['invoice_received_id']})", "SUM(tax_amt) AS tax_amt");
                $record['tax_amt'] = $tax_amount['tax_amt'];

                $record['total_amt'] = ($record['subtotal_amt'] + $record['tax_amt'] + $record['other_expense_amt']) - $record['withholding_amt'];

                sw_update_table("invoice_received", $record, $sql);
              }
          }
	      }
      }

      if (file_exists($file)) unlink($file);
      Unset($worksheet);
      Unset($objPHPExcel);

      $this->winUpload->Hide();
    }

    function BtnExportClick($sender, $params)
    {
      require_once("include/export_contaplus.php");
      require_once("include/ziparchive.php");

      $dir = dirname(__FILE__) . "/tmp";

      $file_account_code = tempnam($dir, "TMP");
      $file_invoice_received = tempnam($dir, "TMP");

      if (class_exists('ExportContaPlusLib')){
        $export = new ExportContaPlusLib();
        $export->file_subaccount = $file_account_code;
        $export->file_movement = $file_invoice_received;
      }

      if (isset($export)) {
        $this->Export_Account_code($export);
        $this->Export_Invoice_received($export);

        if (file_exists($file_account_code) && file_exists($file_invoice_received) && class_exists('zipArchiveLib')){
          $filename = sw_checked_file_valid_name(str_replace("% %", "_", $_SESSION['short_name']) . "_" .
                      $this->dtFromExport->Date . "_" . $this->dtToExport->Date . ".zip");
          $filezip = $dir . "/Accounting_received_" . $filename;
          $zip = new zipArchiveLib();
          $zip->addFile($file_account_code, "XSubCta.txt");
          $zip->addFile($file_invoice_received, "XDiario.txt");
          $zip->saveZip($filezip);
          $zip->downloadZip($filezip);
          unlink($filezip);

          if ($this->record_accounting['accountant_period_last_closed_dt'] < $this->dtToExport->date){
            sw_set_accountant_period_closed($this->dtToExport->date);
          }
        }
      }

      unlink($file_account_code);
      unlink($file_invoice_received);
    }


    function Export_Account_code($export)
    {
      Global $connectionDB;
      $company_id = $_SESSION['company_id'];

      $sql = "SELECT company_provider.*, country.iso_cd, MID(expense_type.account_expense_cd,1,2) as prefix
              FROM company_provider
              INNER JOIN country ON company_provider.country_id = country.country_id
              INNER JOIN expense_type ON company_provider.expense_type_id = expense_type.expense_type_id
              WHERE company_provider.company_id = {$company_id} ORDER BY company_provider.account_cd ";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->open();

      While (!$query->EOF){
          $account_cd = trim($query->Fields['account_cd']);
          $prefix = ($query->Fields['prefix'] === "60") ? "400" : "410";
          if (($this->cbCreateAccount->Checked) && ($account_cd == "")) {
            $account_cd = sw_create_account($company_id, "company_provider", $prefix, $this->record_accounting['digit_account']);

            $record['account_cd'] = $account_cd;
            sw_update_table("company_provider", $record, "company_provider_id = {$query->Fields['company_provider_id']}");
          }
          $provider_name = utf8_decode($query->Fields['provider_name']);

          $export->record_subaccount['cod'] = $account_cd;
          $export->record_subaccount['titulo'] = substr($provider_name, 0, 40);
          $export->record_subaccount['nif'] = substr($query->Fields['tax_ident'], 0, 15);
          $export->record_subaccount['codpostal'] = substr($query->Fields['postal_cd'], 0, 5);
          $export->record_subaccount['coddivisa'] = "EUR";
          $export->record_subaccount['codpais'] = $query->Fields['iso_cd'];

          $export->Add_record_subaccount();

          //Account Expense
          if ($query->Fields['account_expense_cd']){
            $export->record_subaccount['cod'] = $query->Fields['account_expense_cd'];
            $export->record_subaccount['titulo'] = substr($provider_name, 0, 40);
            $export->record_subaccount['nif'] = "";
            $export->record_subaccount['codpostal'] = "";
            $export->record_subaccount['codpais'] = "";
            $export->Add_record_subaccount();
          }

          //Account Other Expense
          if ($query->Fields['account_other_expense_cd']){
            $export->record_subaccount['cod'] = $query->Fields['account_other_expense_cd'];
            $export->record_subaccount['titulo'] = substr($provider_name, 0, 40);
            $export->record_subaccount['nif'] = "";
            $export->record_subaccount['codpostal'] = "";
            $export->record_subaccount['codpais'] = "";
            $export->Add_record_subaccount();
          }

          if ($query->Fields['account_withholding_cd']){
            $export->record_subaccount['cod'] = $query->Fields['account_withholding_cd'];
            $export->record_subaccount['titulo'] = substr($provider_name, 0, 40);
            $export->record_subaccount['nif'] = "";
            $export->record_subaccount['codpostal'] = "";
            $export->record_subaccount['codpais'] = "";
            $export->Add_record_subaccount();
          }

          $query->next();
      }
    }


    function Export_invoice_received($export)
    {
      Global $connectionDB, $GLOBAL_INVOICE_ACCOUNTING;

      $company_id = $_SESSION['company_id'];

      list( $year, $month, $day ) = explode( '-', $this->dtToExport->Date);
      $year = $year ? $year : Date('Y');

      $FromExport = $this->dtFromExport->Date;
      $ToExport = $this->dtToExport->Date;

      $where = " (invoice_received.company_id = {$company_id}) ";
      if ($this->cbExportSelectedInvoices->Checked && $this->gridInvoice_received->SelectedPrimaryKeys){
          $invoice = implode(",", $this->gridInvoice_received->SelectedPrimaryKeys);
          $where .= " AND (invoice_received_id in ({$invoice})) ";
      }
      else $where .= " AND (invoice_received.registered_in_acctg_software_dt BETWEEN '{$FromExport}' AND '{$ToExport}') ";

      $sql = "SELECT invoice_received.*, company_provider.expense_type_id AS expense_type_provider_id, " .
             "company_provider.account_cd, company_provider.account_expense_cd, " .
             "company_provider.account_other_expense_cd, company_provider.account_withholding_cd, " .
             "company_provider.country_id, company_provider.type_tax_cd, country.community_european_yn, " .
             "'provider' as type " .
             "FROM invoice_received INNER JOIN company_provider ON invoice_received.company_provider_id = company_provider.company_provider_id " .
             "INNER JOIN country ON company_provider.country_id = country.country_id " .
             "WHERE {$where} " .
             "ORDER BY invoice_received.registered_in_acctg_software_dt, invoice_received.invoice_number";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->open();

      $count = 0;
      $document_ident = $this->get_last_document_ident($year);
      $invoice_received_id = 0;

      While (!$query->EOF){
        $record = $query->fieldbuffer;
        if (($this->cbExportAccounting->Checked) || (!$record["accounted_yn"])){

          //Initialize data
          if (!$record['document_ident']) $record['document_ident'] = ++$document_ident;

          foreach ($GLOBAL_INVOICE_ACCOUNTING as $key => $value) {
            $GLOBAL_INVOICE_ACCOUNTING[$key] = $record[$key] ? $record[$key] : " ";
          }

          $tax_amt = 0;
          ++$count;
          $total_amt = (floatval($record["subtotal_amt"]) +
                        floatval($record["transport_amt"]) +
                        floatval($record["tax_amt"]) +
                        floatval($record["other_expense_amt"])) -
                        floatval($record["withholding_amt"]);

          $invoice_received_id = $record["invoice_received_id"];

          $invoice_date = explode('-', $record['invoice_dt']);
          $registration_dt = explode('-', $record['registered_in_acctg_software_dt']);
          $invoice_dt = $invoice_date[0] . $invoice_date[1] . $invoice_date[2];
          //Verify date, if quarter is diferent
          if (($registration_dt[0]!=$invoice_date[0]) || (sw_quarter_date($record['invoice_dt']) != sw_quarter_date($record['registered_in_acctg_software_dt']))){
            $invoice_dt = $registration_dt[0] . $registration_dt[1] . $registration_dt[2];
          }

          $GLOBAL_INVOICE_ACCOUNTING['invoice_dt'] = $invoice_dt;
          $GLOBAL_INVOICE_ACCOUNTING["invoice_number"] = $record["invoice_number"];

          $account_code = $record["account_cd"] ? $record["account_cd"] : " ";
          $record["account_cd"] = (($account_code == " ") && ($this->record_accounting['account_provider'])) ? $this->record_accounting['account_provider'] : $account_code;
          $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_cd"];

          $record['account_expense_cd'] = sw_get_account_expense($record, $this->record_accounting['digit_account']);
          $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record['account_expense_cd'];

          $GLOBAL_INVOICE_ACCOUNTING['concept'] = "FR.Núm. " . $record['invoice_number'];
          $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
          $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $total_amt;
          $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = 0;
          $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = 0;

          //Save line 400
          $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);

          //Save line 4751 withholding
          if (floatval($record['withholding_amt']) != 0) {
            $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_withholding_cd"];
            $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
            $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = "";
            $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = $record['withholding_amt'];
            $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = 0;
            $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = 0;

            $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);
          }

          //Save lines 472
          $sql = "SELECT * FROM invoice_received_tax " .
                 "WHERE invoice_received_id = {$record['invoice_received_id']}";

          $query_tax = New Query();
          $query_tax->Database = $connectionDB->DbConnection;
          $query_tax->SQL = $sql;
          $query_tax->LimitStart = -1;
          $query_tax->LimitCount = -1;
          $query_tax->open();

          While (!$query_tax->EOF){
            $record_tax = $query_tax->fieldbuffer;

            if ($record['type_tax_cd'] != 3) {

              $return_tax = sw_get_account_taxable_person("invoice_received_tax", $record_tax['invoice_received_tax_id'], $record, $this->record_accounting);

              //Account 472
              if ($return_tax['vat_include']) {
                $GLOBAL_INVOICE_ACCOUNTING['account_cd']  = $return_tax['account_active'];
                $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $return_tax['counterpart'];
                $GLOBAL_INVOICE_ACCOUNTING['active_amt']  = $return_tax['tax_amt'];
                $GLOBAL_INVOICE_ACCOUNTING['pasive_amt']  = "";
                $GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $return_tax['base_amt'];
                $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = $return_tax['rate_no'];
                $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);
              }

              //Account 477
              if ($return_tax["account_passive"] != ''){
                $GLOBAL_INVOICE_ACCOUNTING['account_cd']  = $return_tax['account_passive'];
                $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $return_tax['counterpart'];
                $GLOBAL_INVOICE_ACCOUNTING['active_amt']  = "";
                $GLOBAL_INVOICE_ACCOUNTING['pasive_amt']  = $return_tax['tax_amt'];
                $GLOBAL_INVOICE_ACCOUNTING['base_amt']    = $return_tax['base_amt'];
                $GLOBAL_INVOICE_ACCOUNTING['rate_no']     = $return_tax['rate_no'];
                $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);
              }
            }
            $query_tax->next();
          }

          //Save lines 600
          $expense_amt = floatval($record['subtotal_amt']) +
                         floatval($record['transport_amt']) +
                         floatval($record['other_expense_amt']);

          //Other Expense
          if ((($this->record_accounting["account_other_expense"]) || ($record["account_other_expense_cd"])) &&
              ($record['other_expense_amt']!=0)) {
              $expense_amt -= floatval($record['other_expense_amt']);

              $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record["account_other_expense_cd"] ? $record["account_other_expense_cd"] : $this->record_accounting['account_other_expense'];
              $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
              $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $record['other_expense_amt'];
              $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
              $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
              $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";

              $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);
          }

          //Save lines 600 Sale
          if (($record['type_tax_cd'] != 0) || ($record['country_id'] != $this->record_accounting['country_id'])) {
            $expense_amt += floatval($record['tax_amt']);
          }

          $GLOBAL_INVOICE_ACCOUNTING['account_cd'] = $record['account_expense_cd'];
          $GLOBAL_INVOICE_ACCOUNTING['counterpart'] = $record["account_cd"];
          $GLOBAL_INVOICE_ACCOUNTING['active_amt'] = $expense_amt;
          $GLOBAL_INVOICE_ACCOUNTING['pasive_amt'] = "";
          $GLOBAL_INVOICE_ACCOUNTING['base_amt'] = "";
          $GLOBAL_INVOICE_ACCOUNTING['rate_no'] = "";

          $this->Save_record_movement($export, $count, $record, $GLOBAL_INVOICE_ACCOUNTING);

          //Last document_ident
          if (!$record['accounted_yn']){
            $record['export_dt'] = date('Y-m-d H:i:s');
          }

          $fieldValues['accounted_yn'] = 1;
          $fieldValues['export_dt'] = $record['export_dt'];
          $fieldValues['document_ident'] = $GLOBAL_INVOICE_ACCOUNTING['document_ident'];
          sw_update_table("invoice_received", $fieldValues, "invoice_received_id = {$record['invoice_received_id']}");
        }

        $query->next();
      }
    }


    function get_last_document_ident($year)
    {
      Global $connectionDB;

      $company_id = $_SESSION['company_id'];
      $sql = "SELECT document_ident FROM invoice_received " .
             "WHERE (YEAR(registered_in_acctg_software_dt) = {$year}) AND (company_id = {$company_id})" .
             "ORDER BY document_ident DESC";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = 0;
      $query->LimitCount = 1;
      $query->open();

      $document_ident = 0;
      if (!$query->EOF) $document_ident = $query->Fields['document_ident'];

      return floatval($document_ident);
    }


    function Save_record_movement($export, $count, $record, $invoice_accounting)
    {
      $export->record_movement['asien'] = $count; //Asiento
      $export->record_movement['fecha'] = $invoice_accounting['invoice_dt'];    //Fecha
      $export->record_movement['subcta'] = $invoice_accounting['account_cd']; //SubCuenta
      $export->record_movement['contra'] = $invoice_accounting['counterpart'];
      $export->record_movement['concepto'] = substr($invoice_accounting['concept'], 0, 25); // Concepto del asiento
      $export->record_movement['factura'] = substr($record['document_ident'],-8);  //Factura

      $rate_no = ($invoice_accounting['rate_no'] != "") ? number_format($invoice_accounting['rate_no'], 2, '.', '') : "0.00";
      $export->record_movement['iva'] = $rate_no; //IVA
      $export->record_movement['documento'] = substr($record['document_ident'],0,10); //Documento(10)
      $export->record_movement['auxiliar'] = " "; //(floatval($record["tax_amt"]) == 0) ? "*": " "; //Auxiliar
      $export->record_movement['monedauso'] = "2"; //MonedaUso

      $active_amt = ($invoice_accounting['active_amt'] != "") ? number_format($invoice_accounting['active_amt'], 2, '.', '') : "0.00";
      $pasive_amt = ($invoice_accounting['pasive_amt'] != "") ? number_format($invoice_accounting['pasive_amt'], 2, '.', '') : "0.00";
      $base_amt   = ($invoice_accounting['base_amt'] != "") ? number_format($invoice_accounting['base_amt'], 2, '.', '') : "0.00";

      $export->record_movement['eurodebe'] = $active_amt; //EuroDebe
      $export->record_movement['eurohaber'] = $pasive_amt; //EuroHaber
      $export->record_movement['baseeuro'] = $base_amt; //BaseEuro
      $export->record_movement['fecha_op'] = str_replace('-', '', $record['registered_in_acctg_software_dt']); //Fecha_OP(8)
      $export->record_movement['fecha_ex'] = str_replace('-', '', $record['invoice_dt']); //Fecha_EX(8)
      $export->record_movement['facturaex'] = $record['invoice_number']; //FacturaEx(40)
      $export->record_movement['tipofac'] = "R"; //TipoFac(1)

      //Type TAX
      if ($record['type_tax_cd'] == 0) $TypeTAX = "O";
      else if ($record['type_tax_cd'] == 1) $TypeTAX = "P";
      else $TypeTAX = "J";

      $export->record_movement['tipoiva'] = $TypeTAX; //TipoIva(1)
      $export->record_movement['l340'] = "T"; //L340

      $export->Add_record_movement();
    }



    function btnCloseInvoiceDetailClick($sender, $params)
    {
      $this->winDetail->Hide();
    }


    function gridInvoice_receivedSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
    }


    function btnCloseUploadClick($sender, $params)
    {
      $this->winUpload->Hide();
    }


    function BtnCloseExportClick($sender, $params)
    {
      $_POST['BtnExportSubmitEvent']="";
      $this->winExport->Hide();
    }


    function gridInvoice_receivedJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("invoice_received_id").value = gridInvoice_received.getSelectedPrimaryKey();
        document.getElementById("rowInvoice").value = row;
        if ((col == <?php echo COL_PDF;?>))
        {
            var cellValue = gridInvoice_received.getCellText(row, <?php echo COL_LINK; ?>);
            if (cellValue){
              window.open(cellValue,"_blank","", false);
              return false;
            }
        }
        //end
        <?php
    }


    function company_provider_idJSChange($sender, $params)
    {
        $components = array("provider_name", "tax_ident", "expense_type_id");
        echo $this->company_provider_id->ajaxCall("ProviderData", array(), $components);
        ?>
        //begin js
        return false;
        //end
        <?php
    }


    function ProviderData()
    {
        $provider_id = $this->company_provider_id->SelectedValue;

        $record = sw_get_data_table("company_provider", "company_provider_id = {$provider_id}");
        $this->provider_name->Enabled = !$record['provider_name'] ? true : false;
        $this->tax_ident->Enabled = !$record['tax_ident'] ? true : false;
        $this->provider_name->text = $record["provider_name"];
        $this->tax_ident->text = $record['tax_ident'];
        $this->expense_type_id->SelectedValue = $record['expense_type_id'];
    }


    function gridInvoice_received_taxJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowTax").value = row;
        //end
        <?php
    }


    function gridInvoice_received_taxInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1){
        $fields = &$params[ 0 ];
      }
      else { //update
          $fields = &$params[ 1 ];
          $fields[ 'invoice_received_tax_id' ] = $params[ 0 ];
      }

      $fields[ 'base_amt' ] = sw_convert_comma_point($fields[ 'base_amt' ]);
      $where = $fields['tax_rate_id'] ? "tax_rate_id = {$fields['tax_rate_id']}" : "rate_no = 0";
      if ($record_tax = sw_get_data_table('tax_rate', $where)) {
        //Search tax_rate_id
        $fields['tax_rate_id'] = $record_tax['tax_rate_id'];
        $fields['rate_no'] = $record_tax['rate_no'];

        $record_tax = $this->gridInvoice_received_tax->CellData;
        foreach( $record_tax as $key => $record) {
          if ($search = ($record['tax_rate_id'] == $fields[ 'tax_rate_id' ])) {
            if ($record['invoice_received_tax_id'] == $fields[ 'invoice_received_tax_id' ])
              $record_tax[$key]['base_amt'] = $fields['base_amt'];
            else
              $record_tax[$key]['base_amt'] += $fields['base_amt'];

            $record_tax[$key]['tax_amt'] = round($record_tax[$key]['base_amt'] * ($fields['rate_no']/100),2);
            break;
          }
        }

        if ((!$fields[ 'invoice_received_tax_id' ]) && (!$search)){
          $fields['tax_amt'] = round($fields['base_amt'] * ($fields['rate_no']/100), 2);
          $fields[ 'invoice_received_tax_id' ] = count($this->gridInvoice_received_tax->CellData)+1;
          array_push($record_tax, $fields);
        }

        $this->gridInvoice_received_tax->CellData = $record_tax;
      } else return false;
    }


    function gridInvoice_received_taxDelete($sender, $params)
    {
      $fields = &$params[ 0 ];

      $record_tax = $this->gridInvoice_received_tax->CellData;
      foreach( $record_tax as $key => $record) {
        if ($record['invoice_received_tax_id'] == $fields[0]){
            array_splice($record_tax, $key, 1);
        }
      }
      $this->gridInvoice_received_tax->CellData = $record_tax;
    }


    function other_expense_amtJSChange($sender, $params)
    {
        $components = array("other_expense_amt", "total_amt");

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

    function BtnAgreeInvoiceDetailClick($sender, $params)
    {
      $params[0] = True;
      if ($this->Calculate_invoice($sender, $params)){
          $this->winDetail->Hide();
      }
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
      Global $lbInvoiceIsAlreadyCreate_error, $lbInvoiceDateInvalid, $lbSelectProvider_error;

      $invoice_number = $this->invoice_number->text;
      $invoice_dt = $this->invoice_dt->date;
      $msg = "";

      //Valid Invoice date
      if (!$invoice_dt){
         $msg = $lbInvoiceDateInvalid;
      }

      //Valid Invoice
      $where = "(company_id = {$_SESSION['company_id']}) AND (invoice_received_id != {$this->invoice_received_id->Value}) AND
                (invoice_number = '{$invoice_number}') AND (invoice_dt = '{$invoice_dt}') AND (tax_ident = '{$this->tax_ident->text}')";
      if ((!$msg) && $record = sw_get_data_table("invoice_received", $where)) {
        $msg = $lbInvoiceIsAlreadyCreate_error;
      }

      //Valid provider
      if ((!$msg) && (!$this->company_provider_id->SelectedValue)){
        $msg = $lbSelectProvider_error;
      }
      $this->ProviderData();

      $this->lbError->caption = $msg;

      return ($msg=="");
    }

    //Calculate invoice
    function Calculate_invoice($sender, $params)
    {
      $update = $params[0];

      $invoice_received_id = $this->invoice_received_id->value;
      $where = "(invoice_received_id = {$invoice_received_id})";

      $record['company_provider_id'] = $this->company_provider_id->SelectedValue;
      $record['created_by_user_id']  = $_SESSION['master_user_id'];
      $record['provider_name']   = strtoupper($this->provider_name->text);
      $record['tax_ident']       = strtoupper($this->tax_ident->text);
      $record['expense_type_id'] = $this->expense_type_id->SelectedValue;
      $record['invoice_number']  = strtoupper($this->invoice_number->text);
      $record['invoice_dt']      = $this->invoice_dt->Date;
      $record['payment_due_dt']  = $this->payment_due_dt->Date ? $this->payment_due_dt->Date : '';

      $record['subtotal_amt'] = '0';
      $record['tax_amt'] = '0';
      foreach( $this->gridInvoice_received_tax->CellData as $key => $record_tax) {
        $record['subtotal_amt'] += $record_tax['base_amt'];
        $record['tax_amt'] += $record_tax['tax_amt'];
      }

      $record['other_expense_amt'] = $this->other_expense_amt->text ? floatval(sw_convert_comma_point($this->other_expense_amt->text)) : 0;
      $record['base_withholding_amt'] = $this->base_withholding_amt->text ? floatval(sw_convert_comma_point($this->base_withholding_amt->text)) : 0;
      $record['withholding_rate_no'] = $this->withholding_rate_no->text ? floatval(sw_convert_comma_point($this->withholding_rate_no->text)) : 0;
      $record['withholding_amt'] =  number_format($record['base_withholding_amt'] * ($record['withholding_rate_no']/100), 2, '.', '');

      //Total amount invoice
      $record['subtotal_amt'] = number_format($record['subtotal_amt'], 2, '.', '');
      $record['tax_amt']      = number_format($record['tax_amt'], 2, '.', '');
      $record['total_amt'] = number_format(($record['subtotal_amt'] + $record['tax_amt'] + $record['other_expense_amt']) - $record['withholding_amt'], 2, '.', '');


      $this->View_total_invoice($record);

      //Valid and Update Invoice
      if (($update) && ($return = $this->ValidInvoice())) {
        //Assign registered accountant
        sw_assign_registered_accountant($record, $this->registration_date->Date);

        //Assign value
        list( $year, $month, $day ) = explode( '-', $record['registered_in_acctg_software_dt'] );
        $record['document_ident'] = ($this->document_ident->text) ? $this->document_ident->text : $this->get_last_document_ident($year) + 1;

        //Add Invoice
        if (!$this->invoice_received_id->value) {
          $record['company_id'] = $_SESSION['company_id'];
          $record['created_dt'] = date('Y-m-d H:i:s');
          sw_insert_table("invoice_received", $record);
          $this->invoice_received_id->value = mysql_insert_id();
        } else { //Update Invoice received
          sw_update_table('invoice_received', $record, $where);
        }

        //Update Tax
        $record_tax = $this->gridInvoice_received_tax->CellData;

        $this->sqlInvoice_received_tax->close();
        $this->sqlInvoice_received_tax->sql = "SELECT * FROM invoice_received_tax Where invoice_received_id = {$this->invoice_received_id->value}";
        $this->sqlInvoice_received_tax->open();
        While (!$this->sqlInvoice_received_tax->EOF){
          $invoice_received_tax_id = $this->sqlInvoice_received_tax->Fields['invoice_received_tax_id'];
          $where_tax = $where . " AND (invoice_received_tax_id = {$invoice_received_tax_id})";
          $search = false;

          foreach( $record_tax as $key => $tax_record) {
            //Update Tax exist
            if ($search = ($tax_record['invoice_received_tax_id'] == $invoice_received_tax_id)){
              sw_update_table("invoice_received_tax", $record_tax[$key], $where_tax);
              array_splice($record_tax, $key, 1);
              break;
            }
          }

          if (!$search) sw_delete_table("invoice_received_tax", $where_tax);
          $this->sqlInvoice_received_tax->next();
        }

        //Insert new record
        foreach($record_tax as $key => $tax_record) {
          $tax_record['invoice_received_tax_id'] = '';
          $tax_record['invoice_received_id'] = $this->invoice_received_id->value;
          sw_insert_table("invoice_received_tax", $tax_record);
        }

        //Attached invoice
        $attached['registered_in_acctg_software_dt'] = $record['registered_in_acctg_software_dt'];
        $attached['provider_name'] = $record["provider_name"];
        if ($return = $this->Attached_invoice_received($this->invoice_received_id->value, $attached)){
          $where = "(invoice_received_id = {$this->invoice_received_id->value})";
          sw_update_table('invoice_received', $attached, $where);
        }
      }

      return $return;
    }

    function Attached_invoice_received($invoice_received_id, &$record)
    {
      Global $VirtualFile, $InvoiceReceived, $lblFileSizeTooBig, $ftpMaxFileSize;

      if (!$this->Attached->filename) return true;

      $msg = "";
      $file = "";

      if ($return = $this->Attached->isUploadedFile()){
        if (strtoupper($this->Attached->FileExt) == 'PDF'){

          $year = date("Y", strtotime($record["registered_in_acctg_software_dt"]));
          $provider = utf8_decode($record["provider_name"]);

          $dir = $VirtualFile . $InvoiceReceived;
          $dir = strtolower($dir . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR);
          if (!file_exists($dir))
          {
            mkdir($dir, 0777, true);
          }

          $file = utf8_encode("invoice " . $year . " {$invoice_received_id} " . $_SESSION["short_name"] . " {$provider}.pdf");
          $file = sw_clean_characters_spanish($file);
          $file = strtolower($dir . $file);
          if (file_exists($file)) unlink($file);

          if (!$this->Attached->moveUploadedFile($file)) $file = "";
          $record["link"] = $file;
        }
        else
        {
          $msg = "Invalid format, only PDF files";
        }
      }
      else if ($file){
        $msg = $lblFileSizeTooBig . " (max. " . $ftpMaxFileSize . " bytes)";
      }

      $this->lbError->Caption = $msg;

      return ($msg=="");
    }


    function btnInvoicesJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbUnmarkSelectedInvoiceMsg;
        ?>
          //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowInvoice").value

          if (toolButton == 'btnInvoices'){
            if (toolButtonName == 'btnUnMark') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbUnmarkSelectedInvoiceMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnCancel') { gridInvoice_received.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridInvoice_received.Post(); return false;}
            else if (toolButtonName == 'btnExportAccounting') { document.getElementById( "winExport" ).ShowModal(); return false; }
            else if (toolButtonName == 'btnRegistrationChange') {
                if ((row != "-1") && (row != "")) { document.getElementById( "winRegistrationChange" ).ShowModal(); }
                return false;
            }
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
          }
          //end
        <?php
    }


    function btnInvoicesClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == 'btnFilter') {
        sw_view_filter_grid($this->gridInvoice_received);
      }else if (($toolButtonName == 'btnAdd') || ($toolButtonName == 'btnEdit')) {
        $primaryKey = ($toolButtonName == 'btnAdd') || (!$this->invoice_received_id->Value) ? 0 : $this->invoice_received_id->Value;
        $this->Details_invoice($primaryKey);
      }else if ($toolButtonName == 'btnDelete') {
        $this->DeleteInvoiceSelected();
      }else if ($toolButtonName == 'btnUnMark') {
        $this->Dis_accounting();
      }else if ($toolButtonName == 'btnProvider') {
        $_SESSION['page_return'] = array($_SERVER['PHP_SELF'], $this->invoice_received_id->Value);
        header("Location: company_provider.php") ;
      }else if ($toolButtonName == 'btnImportInvoice') {
        $this->winUpload->ShowModal();
      }
    }


    function Details_invoice($primaryKey)
    {
      $this->invoice_received_id->Value = $primaryKey;

      $record = sw_get_data_table("invoice_received", "invoice_received_id = {$primaryKey}");

      $this->sqlInvoice_received_tax->close();
      $this->sqlInvoice_received_tax->sql = "SELECT * FROM invoice_received_tax Where invoice_received_id = {$primaryKey} ORDER BY rate_no ";
      $this->sqlInvoice_received_tax->open();

      $record_tax = array();
      $received_tax = array();
      While (!$this->sqlInvoice_received_tax->EOF){
        $record_tax['base_amt'] = $this->sqlInvoice_received_tax->Fields['base_amt'];
        $record_tax['tax_rate_id'] = $this->sqlInvoice_received_tax->Fields['tax_rate_id'];
        $record_tax['tax_amt'] = $this->sqlInvoice_received_tax->Fields['tax_amt'];
        $record_tax['rate_no'] = $this->sqlInvoice_received_tax->Fields['rate_no'];
        $record_tax['invoice_received_tax_id'] = $this->sqlInvoice_received_tax->Fields['invoice_received_tax_id'];

        array_push($received_tax, $record_tax);
        $this->sqlInvoice_received_tax->next();
      }
      $this->gridInvoice_received_tax->CellData = $received_tax;

      $accounted_yn = $record['accounted_yn'];
      $this->company_provider_id->Enabled = !$accounted_yn;
      $this->provider_name->Enabled = !$accounted_yn;
      $this->tax_ident->Enabled = !$accounted_yn;
      $this->provider_name->Enabled = (!$record['provider_name'] && !$accounted_yn) ? true : false;
      $this->tax_ident->Enabled = (!$record['tax_ident'] && !$accounted_yn) ? true : false;
      $this->expense_type_id->Enabled = !$accounted_yn;

      $this->invoice_number->Enabled = !$accounted_yn;
      $this->invoice_dt->Enabled = !$accounted_yn;
      $this->payment_due_dt->Enabled = !$accounted_yn;
      $this->other_expense_amt->Enabled = !$accounted_yn;
      $this->base_withholding_amt->Enabled = !$accounted_yn;
      $this->withholding_rate_no->Enabled = !$accounted_yn;
      $this->gridInvoice_received_tax->ReadOnly = $accounted_yn;
      $this->lbError->Caption = "";
      if ($accounted_yn) {
        $this->lbError->Caption = "Invoice already accounted, please contact accountant@strongabogados.com";
      }

      $items['btnAdd'] = array(btnAdd, !$accounted_yn, "2");
      $items['btnDelete'] = array(btnDelete, !$accounted_yn, "6");
      $items['btnEdit'] = array(btnEdit, !$accounted_yn, "3");
      $items['btnSave'] = array(btnSave, !$accounted_yn, "5");
      $items['btnCancel'] = array(btnCancel, !$accounted_yn, "4");
      $this->btnTaxes->Items = $items;

      $this->BtnAgreeInvoiceDetail->Enabled = !$accounted_yn;

      $this->company_provider_id->SelectedValue = $record['company_provider_id'];
      $this->provider_name->text = $record['provider_name'];
      $this->tax_ident->text = $record['tax_ident'];
      $this->expense_type_id->SelectedValue = $record['expense_type_id'];
      $this->invoice_number->text = $record['invoice_number'];
      $this->invoice_dt->Date = $record['invoice_dt'];
      $this->payment_due_dt->Date = $record['expiration_dt'];
      $this->lbRegistration_date->visible = $_SESSION['IsSuperadmin'];
      $this->registration_date->visible = $_SESSION['IsSuperadmin'];
      $this->registration_date->Date = $record['registered_in_acctg_software_dt'];
      $this->registration_date->Enabled = !$accounted_yn;

      $this->lbDocument_ident->visible = $_SESSION['IsSuperadmin'];
      $this->document_ident->text = $record['document_ident'];
      $this->document_ident->visible = $_SESSION['IsSuperadmin'];

      $this->View_total_invoice($record);
      $this->winDetail->ShowModal();
    }


    function DeleteInvoiceSelected()
    {
      Global $InvoiceDir;

      if (count($this->gridInvoice_received->SelectedPrimaryKeys) > 0) {
        $invoice = implode(",", $this->gridInvoice_received->SelectedPrimaryKeys);

        $sql = "SELECT * FROM invoice_received
                WHERE (company_id = {$_SESSION['company_id']}) AND (accounted_yn = 0) AND
                      (invoice_received_id in ({$invoice})) ";
        $record = sw_records_array($sql, array("invoice_received_id","link"));
        foreach ($record as $key => $invoice_received_id)
        {
          if ($record[$key]!="") {
              $file = utf8_decode($record[$key]);
              if (file_exists($file)) unlink($file);
          }
          $sql = "(invoice_received_id = {$key})";
          sw_delete_table("invoice_received", $sql);
        }
        $this->gridInvoice_received->writeSelectedCells(array());
      }
    }


    function Dis_accounting()
    {
      if (count($this->gridInvoice_received->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $invoice_received_id = implode(",", $this->gridInvoice_received->SelectedPrimaryKeys);

        if ($invoice_received_id){
//                      export_dt = IF((accounted_yn = 1) AND (export_dt IS Null), DATE(NOW()), IF(accounted_yn = 0, Null, export_dt))
          $sql = "UPDATE invoice_received
                  SET accounted_yn = !accounted_yn
                  WHERE (company_id = {$_SESSION['company_id']}) AND (invoice_received_id in ({$invoice_received_id}))";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridInvoice_received->writeSelectedCells(array());
        }
      }
    }


    function gridInvoice_receivedRowData($sender, $params)
    {
      $field = &$params[1];

      $field['export_dt'] = $field['export_dt'] == '0000-00-00 00:00:00' ? '' : $field['export_dt'];

      $field['img_pdf'] = 'images/ftp/1px.gif';
      $file = utf8_decode($field['link']);
      if (($file != "") && file_exists($file))
      {
        $field['img_pdf'] = 'images/ftp/pdf.gif';
      }
    }


    function add_providerClick($sender, $params)
    {
      $_SESSION['page_return'] = array($_SERVER['PHP_SELF'], $this->invoice_received_id->Value);
      @header("Location: company_provider.php") ;
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
      if ((count($this->gridInvoice_received->SelectedPrimaryKeys) > 0) && ($this->registration_change->date)) {
        Global $connectionDB;

        $invoice_id = implode(",", $this->gridInvoice_received->SelectedPrimaryKeys);
        if ($invoice_id){
          $sql = "UPDATE invoice_received SET registered_in_acctg_software_dt = '" . $this->registration_change->date . "' WHERE accounted_yn = 0 AND invoice_received_id in (" . $invoice_id . ")";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();

          $this->registration_change->date = '';
        }
      }
    }


    function btnTaxesJSClick($sender, $params)
    {
        $components = array('subtotal_amt', 'tax_amt', 'other_expense_amt', 'base_withholding_amt', 'withholding_rate_no', 'withholding_amt', 'total_amt');
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowTax").value;

          if (toolButton == 'btnTaxes'){
              if (toolButtonName == 'btnAdd') { gridInvoice_received_tax.Insert(); return false;}
              else if (toolButtonName == 'btnEdit') {
                 if ((row != "-1") && (row != "")) { gridInvoice_received_tax.Edit(row);}
                 return false;
              }
              else if (toolButtonName == 'btnCancel') { gridInvoice_received_tax.Cancel(); return false;}
              else if (toolButtonName == 'btnSave') { gridInvoice_received_tax.Post(); }
              else if (toolButtonName == 'btnDelete') { gridInvoice_received_tax.Delete(document.getElementById("rowTax").value); return true;}

              params = [0];
              <?php
                  echo $this->btnTaxes->ajaxCall("Calculate_invoice", array(), $components);
              ?>
              return false;
          }
        //end
        <?php
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

    function SelectTemplateImport()
    {
      //Template Strong Abogados
      if ($this->cbTemplateImport->ItemIndex == 1){
        Global $template_invoice_strong;

        $this->col_invoice_date->ItemIndex = $template_invoice_strong['col_invoice_date'];
        $this->col_invoice_number->ItemIndex = $template_invoice_strong['col_invoice_number'];
        $this->col_tax_ident->ItemIndex = $template_invoice_strong['col_tax_ident'];
        $this->col_provider_name->ItemIndex = $template_invoice_strong['col_client_name'];
        $this->col_subtotal_amount->ItemIndex = $template_invoice_strong['col_subtotal_amount'];
        $this->col_tax_rate->ItemIndex = $template_invoice_strong['col_tax_rate'];
        $this->col_tax_amount->ItemIndex = $template_invoice_strong['col_tax_amount'];
        $this->col_total_amount->ItemIndex = $template_invoice_strong['col_total_amount'];
        $this->col_base_withholding_amount->ItemIndex = $template_invoice_strong['col_base_withholding_amount'];
        $this->col_withholding_rate->ItemIndex = $template_invoice_strong['col_withholding_rate'];
        $this->beginning_row->Position = $template_invoice_strong['beginning_row'];
      }
    }

}

global $application;

global $invoice_received;

//Creates the form
$invoice_received=new invoice_received($application);

//Read from resource file
$invoice_received->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $invoice_received->show();

?>