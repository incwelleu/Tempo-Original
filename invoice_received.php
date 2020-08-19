<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once('include/accounting.php');
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
use_unit("components4phpfull/jtgrid.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");

//Class definition
class invoice_received extends fmstrong
{
    public $imgOpenInvoice = null;
    public $cbTypeExport = null;
    public $SelectedKeysField = null;
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
    public $col_other_amount = null;
    public $lbWithholding_rate = null;
    public $col_withholding_rate = null;
    public $lbBase_withholding1 = null;
    public $col_base_withholding_amount = null;
    public $invoice_received_id = null;
    public $rowTax = null;
    public $btnInvoices = null;
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
    public $lbTypeExport = null;
    public $lbDownloadOurTemplate = null;
    public $beginning_row = null;
    public $overhead_amt = null;
    public $lbOverhead_amt = null;

    function invoice_receivedCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterInvoiceReceived();
    }

    function ParameterInvoiceReceived()
    {
      Global $connectionDB, $MonthLetter, $VirtualFile,
						 $template_import_invoice, $download_our_template;

      Define('COL_YEAR_REGISTERED', $this->gridInvoice_received->findColumnByName('year_registered'));
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

      $this->sqlTax_rate->close();
      $this->sqlTax_rate->Params = array($_SESSION['country_id']);
      $this->sqlTax_rate->open();

      if( ! $this->gridInvoice_received->inSession(''))
      {
      	$this->gridInvoice_received->Columns[COL_YEAR_REGISTERED]->Filter = date("m") == '01' ? date("Y")-1 : date("Y");
      	$this->gridInvoice_received->Columns[COL_YEAR_REGISTERED]->FilterMethod = 'Equals';
				$this->gridInvoice_received->Header->ShowFilterBar = True;
      }

      $company_id = 0;
      if (isset($_SESSION['company_id'])) {
          $company_id = $_SESSION['company_id'];
      }
      $enable = ($company_id != 0);
      $visible = ($enable && ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']));

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
      $this->gridInvoice_received->Columns[COL_ACCOUNTED_YN]->CanEdit = $visible;
      $this->gridInvoice_received->Columns[COL_REGISTRATION_DT]->CanEdit = $visible;

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

			$this->lbDownloadOurTemplate->Caption = $download_our_template;
			$this->lbDownloadOurTemplate->Link = $VirtualFile . TMP_ACCOUNTING_UPLOAD . "/form%20-%20accounting%20sheet.xlsx";

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
                invoice_received.provider_name, invoice_received.subtotal_amt, invoice_received.tax_amt, invoice_received.overhead_amt,
                invoice_received.withholding_amt, invoice_received.other_expense_amt, invoice_received.total_amt,
                invoice_received.accounted_yn, invoice_received.export_dt, invoice_received.document_ident,
                invoice_received.registered_in_acctg_software_dt, invoice_received.link,
                invoice_received.created_by_user_id, invoice_received.created_dt, YEAR(invoice_received.registered_in_acctg_software_dt) AS year_registered,
								user.username, company_provider.account_cd
              FROM invoice_received
                  LEFT JOIN
                    (SELECT company_provider_id, account_cd FROM company_provider) AS company_provider
                    ON invoice_received.company_provider_id = company_provider.company_provider_id
                  LEFT JOIN user ON invoice_received.created_by_user_id = user.user_id
              WHERE (invoice_received.company_id = {$_SESSION['company_id']})";

      if (strpos($filterSql, 'year_registered') !== false){
				$filterSql = str_replace('year_registered', 'YEAR(registered_in_acctg_software_dt)', $filterSql);
			}

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
      $this->overhead_amt->text = number_format($record['overhead_amt'], 2, '.', '');

      $this->other_expense_amt->text = number_format($record['other_expense_amt'], 2, '.', '');
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
      	$import->col_name = $this->col_provider_name->ItemIndex;
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

				$import->import_invoice_received_excel();

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
      $file_invoice_received = tempnam($dir, "TMP");
      if ($this->cbTypeExport->ItemIndex == 0 && class_exists('ExportA3ConLib')){
        $export = new ExportA3ConLib();
				$export->codigo_empresa = $this->record_accounting['company_code_accounting'];
      } else if ($this->cbTypeExport->ItemIndex == 1 && class_exists('ExportContaPlusLib')){
        $export = new ExportContaPlusLib();
      }

      if (isset($export)) {
				$export->file_subaccount = $file_account_code;
  	    $export->file_movement = $file_invoice_received;

				$export->fromDate = $this->dtFromExport->Date;
				$export->toDate = $this->dtToExport->Date;
				$export->selectedInvoices = $this->cbExportSelectedInvoices->Checked;
				$export->selectedKeysInvoices = $this->SelectedKeysField->Value;
				$export->createAccount = $this->cbCreateAccount->Checked;
				$export->exportAccounting = $this->cbExportAccounting->Checked;
				$export->record_accounting = $this->record_accounting;

			  $export->export_Subaccount_ProviderTax();
        $export->export_Invoice_received();

        if (file_exists($file_account_code) && file_exists($file_invoice_received) && class_exists('zipArchiveLib')){
          $filename = sw_checked_file_valid_name(str_replace(",", "", str_replace(" ", "_", $_SESSION['short_name'])) . "_" .
                      $this->dtFromExport->Date . "_" . $this->dtToExport->Date . ".zip");
          $filezip = $dir . "/Accounting_received_" . $filename;
					$export->create_zip_file($filezip);
          unlink($filezip);

          if ($this->record_accounting['accountant_period_last_closed_dt'] < $this->dtToExport->date){
            sw_set_accountant_period_closed($this->dtToExport->date);
          }
        }
      }

      unlink($file_account_code);
      unlink($file_invoice_received);
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
        document.getElementById("invoice_received_id").value = sender.getSelectedPrimaryKey();
        if ((col == <?php echo COL_PDF;?>))
        {
            var cellValue = sender.getCellText(row, <?php echo COL_LINK; ?>);
            if (cellValue){
              window.open(cellValue + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000),"_blank","", false);
							sender.SelectedCol = 0;
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
      $this->provider_name->text = $record["provider_name"] ? $record["provider_name"] : $this->provider_name->text;
      $this->tax_ident->text = $record['tax_ident'] ? $record['tax_ident'] : $this->tax_ident->text;
      $this->expense_type_id->SelectedValue = $record['expense_type_id'] ? $record['expense_type_id'] : $this->expense_type_id->SelectedValue;
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
						$record_tax[$key]['overhead_rate_no'] = $fields['overhead_rate_no'];
            $record_tax[$key]['overhead_amt'] = round($record_tax[$key]['base_amt'] * ($fields['overhead_rate_no']/100),2);
            break;
          }
        }

        if ((!$fields[ 'invoice_received_tax_id' ]) && (!$search)){
          $fields['tax_amt'] = round($fields['base_amt'] * ($fields['rate_no']/100), 2);
          $fields['overhead_amt'] = round($fields['base_amt'] * ($fields['overhead_rate_no']/100),2);
          $fields['invoice_received_tax_id'] = count($this->gridInvoice_received_tax->CellData)+1;
          array_push($record_tax, $fields);
        }

        $this->gridInvoice_received_tax->CellData = $record_tax;
      } else return false;
    }


    function gridInvoice_received_taxDelete($sender, $params)
    {
      $fields = &$params[ 0 ];

      $record_tax = $this->gridInvoice_received_tax->CellData;
      foreach( $this->gridInvoice_received_tax->CellData as $key => $record) {
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

      $tax_ident = strtoupper($this->tax_ident->text);
      if (!$this->company_provider_id->SelectedValue) {
        $record_provider = sw_get_data_table('company_provider', "tax_ident = '{$tax_ident}' AND company_id = {$_SESSION['company_id']}", "company_provider_id");
        $record['company_provider_id'] = $record_client['company_provider_id'];
      }
      else $record['company_provider_id'] = $this->company_provider_id->SelectedValue;

      $record['provider_name']   = strtoupper($this->provider_name->text);
      $record['tax_ident']       = strtoupper($this->tax_ident->text);
      $record['expense_type_id'] = $this->expense_type_id->SelectedValue;
      $record['invoice_number']  = strtoupper($this->invoice_number->text);
      $record['invoice_dt']      = $this->invoice_dt->Date;

      $record['subtotal_amt'] = '0';
      $record['tax_amt'] = '0';
      $record['overhead_amt'] = '0';
      foreach( $this->gridInvoice_received_tax->CellData as $key => $record_tax) {
        $record['subtotal_amt'] += $record_tax['base_amt'];
        $record['tax_amt'] += $record_tax['tax_amt'];
        $record['overhead_amt'] += $record_tax['overhead_amt'];
      }

      $record['other_expense_amt'] = $this->other_expense_amt->text ? floatval(sw_convert_comma_point($this->other_expense_amt->text)) : 0;
      $record['base_withholding_amt'] = $this->base_withholding_amt->text ? floatval(sw_convert_comma_point($this->base_withholding_amt->text)) : 0;
      $record['withholding_rate_no'] = $this->withholding_rate_no->text ? floatval(sw_convert_comma_point($this->withholding_rate_no->text)) : 0;
      $record['withholding_amt'] =  number_format($record['base_withholding_amt'] * ($record['withholding_rate_no']/100), 2, '.', '');

      //Total amount invoice
      $record['subtotal_amt'] = number_format($record['subtotal_amt'], 2, '.', '');
      $record['tax_amt']      = number_format($record['tax_amt'], 2, '.', '');
      $record['overhead_amt'] = number_format($record['overhead_amt'], 2, '.', '');
      $record['total_amt'] = number_format(($record['subtotal_amt'] + $record['tax_amt'] + $record['overhead_amt'] + $record['other_expense_amt']) - $record['withholding_amt'], 2, '.', '');

      $this->View_total_invoice($record);

      //Valid and Update Invoice
      if (($update) && ($return = $this->ValidInvoice())) {
        //Assign registered accountant
        sw_assign_registered_accountant($record, $this->registration_date->Date);

        //Assign value
        list( $year, $month, $day ) = explode( '-', $record['registered_in_acctg_software_dt'] );
        $record['document_ident'] = ($this->document_ident->text) ? $this->document_ident->text : sw_get_last_document_received($year) + 1;

        //Add Invoice
        if (!$this->invoice_received_id->value) {
          $record['company_id'] = $_SESSION['company_id'];
      		$record['created_by_user_id']  = $_SESSION['user_id'];
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
        $this->gridInvoice_received->writeSelectedCells(array());
      }

      return $return;
    }

    function Attached_invoice_received($invoice_received_id, &$record)
    {
      Global $VirtualFile, $lblFileSizeTooBig, $ftpMaxFileSize;

      if (!$this->Attached->filename) return true;

      $msg = "";
      $file = "";

      if ($return = $this->Attached->isUploadedFile()){
        if (strtoupper($this->Attached->FileExt) == 'PDF'){

          $year = date("Y", strtotime($record["registered_in_acctg_software_dt"]));
          $provider = utf8_decode($record["provider_name"]);

          $dir = $VirtualFile . TMP_INVOICE_RECEIVED_UPLOAD;
          $dir = strtolower($dir . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR);
          if (!file_exists($dir))
          {
            mkdir($dir, 0777, true);
          }

          $file = utf8_encode("invoice " . $year . " {$invoice_received_id} " . $_SESSION["short_name"] . " {$provider}.pdf");
					$file = sw_checked_file_valid_name(sw_clean_characters_spanish($file));
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

          if (toolButton == 'btnInvoices'){
        		if (toolButtonName == 'btnFilter') {
          		gridInvoice_received.deselectAll();
							gridInvoice_received._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridInvoice_received->ajaxCall('filter_grid', array(), array($this->gridInvoice_received->Name)); ?>
          		return false;
        		}
          	else if ((toolButtonName == 'btnDelete') || (toolButtonName == 'btnUnMark') ||
              	(toolButtonName == 'btnRegistrationChange') ||
                (toolButtonName == 'btnExportAccounting')) {
            	var keys = [];
            	for (var row in gridInvoice_received.SelectedCells) {
              	if (typeof(gridInvoice_received.SelectedCells[row]) != "function" &&
                		(gridInvoice_received.SelectedCells[row] != '') &&
                    (gridInvoice_received.SelectedCells[row] != null)) {
                  keys.push(gridInvoice_received.getPrimaryKey(row));
              	}
            	}

            	if (findObj('SelectedKeysField').value = keys.join(',')){
              	if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
              	else if (toolButtonName == 'btnUnMark') { return confirm("<?php echo $lbUnmarkSelectedInvoiceMsg ?>");}
            		else if (toolButtonName == 'btnRegistrationChange') { document.getElementById( "winRegistrationChange" ).ShowModal(); }
            	}

            	if (toolButtonName == 'btnExportAccounting') { document.getElementById( "winExport" ).ShowModal(); }
            	return false;
          	}
            else if (toolButtonName == 'btnCancel') { gridInvoice_received.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridInvoice_received.Post(); return false;}
          }
          //end
        <?php
    }


    function btnInvoicesClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if (($toolButtonName == 'btnAdd') || ($toolButtonName == 'btnEdit' && $this->invoice_received_id->Value)) {
        $primaryKey = ($toolButtonName == 'btnAdd') ? 0 : $this->invoice_received_id->Value;
        $this->Details_invoice($primaryKey);
      }else if ($toolButtonName == 'btnDelete') {
        $this->DeleteInvoiceSelected();
      }else if ($toolButtonName == 'btnUnMark') {
        $this->Dis_accounting();
      }else if ($toolButtonName == 'btnProvider') {
        $_SESSION['page_return'] = array('invoice_received.php', $this->invoice_received_id->Value);
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
        $record_tax['overhead_rate_no'] = $this->sqlInvoice_received_tax->Fields['overhead_rate_no'];
        $record_tax['overhead_amt'] = $this->sqlInvoice_received_tax->Fields['overhead_amt'];
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
      $this->other_expense_amt->Enabled = !$accounted_yn;
      $this->base_withholding_amt->Enabled = !$accounted_yn;
      $this->withholding_rate_no->Enabled = !$accounted_yn;
      $this->gridInvoice_received_tax->ReadOnly = $accounted_yn;
      $this->lbError->Caption = "";
			$this->Attached->Visible = !$accounted_yn;
			$this->imgOpenInvoice->Visible = (!empty($record['link']) && file_exists($record['link']));
			$this->imgOpenInvoice->Link = $record['link'];
			$this->lbAttached_invoice->Visible = $this->Attached->Visible || $this->imgOpenInvoice->Visible;
      if ($accounted_yn) {
				//Accounting provider data
				$record_accounting_provider = sw_get_data_table("vw_accountant_manager", "accounting_provider_id = {$_SESSION['accounting_provider_id']}");
        $this->lbError->Caption = "Invoice already accounted, please contact " . ($record_accounting_provider['email'] ? $record_accounting_provider['accounting_provider_name'] . " ({$record_accounting_provider['email']})" : $_SESSION['settings']['se_accounting_email']);
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
      $this->lbRegistration_date->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->registration_date->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->registration_date->Date = $record['registered_in_acctg_software_dt'];
      $this->registration_date->Enabled = !$accounted_yn;

      $this->lbDocument_ident->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $this->document_ident->text = $record['document_ident'];
      $this->document_ident->visible = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);

      $this->View_total_invoice($record);
      $this->winDetail->ShowModal();
    }


    function DeleteInvoiceSelected()
    {
      $sql = "SELECT * FROM invoice_received
      				WHERE (company_id = {$_SESSION['company_id']}) AND (accounted_yn = 0) AND
              			(invoice_received_id in ({$this->SelectedKeysField->Value})) ";
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


    function Dis_accounting()
    {
    	Global $connectionDB;

      $sql = "UPDATE invoice_received
      				SET accounted_yn = !accounted_yn
              WHERE (company_id = {$_SESSION['company_id']}) AND (invoice_received_id in ({$this->SelectedKeysField->Value}))";
      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->gridInvoice_received->writeSelectedCells(array());
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
      }else $field['link'] = "";
    }


    function add_providerClick($sender, $params)
    {
      $_SESSION['page_return'] = array('invoice_received.php', $this->invoice_received_id->Value);
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
    	Global $connectionDB;

      $sql = "UPDATE invoice_received SET registered_in_acctg_software_dt = '{$this->registration_change->date}'
      				WHERE (accounted_yn = 0) AND (invoice_received_id in ({$this->SelectedKeysField->Value}))";
      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();

      $this->registration_change->date = '';
    }


    function btnTaxesJSClick($sender, $params)
    {
        $components = array('subtotal_amt', 'tax_amt', 'overhead_amt', 'other_expense_amt', 'base_withholding_amt', 'withholding_rate_no', 'withholding_amt', 'total_amt');
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowTax").value;

          if (toolButton == 'btnTaxes'){
              if (toolButtonName == 'btnAdd') { gridInvoice_received_tax.Insert(); return false;}
              else if (toolButtonName == 'btnEdit') {
                 if ((row != "-1") && (row != "")) { gridInvoice_received_tax.Edit(row); }
                 return false;
              }
              else if (toolButtonName == 'btnCancel') { gridInvoice_received_tax.Cancel(); return false;}
              else if (toolButtonName == 'btnSave') { gridInvoice_received_tax.Post(); }
              else if (toolButtonName == 'btnDelete' && (row != "-1") && (row != "")) { gridInvoice_received_tax.Delete(row);}

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

			$this->col_provider_name->Enabled = $enabled;
      $this->col_provider_name->ItemIndex = $template_invoice_strong[$this->cbTemplateImport->ItemIndex]['col_client_name'];

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


    function gridInvoice_received_taxJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowTax").value = row;
        //end
        <?php
    }


    function gridInvoice_received_taxJSDataLoad($sender, $params)
    {

        ?>
        //begin js
        var session = '<?php echo session_id(); ?>';
				["change", "focus"].forEach(function(event) {
       		document.getElementById("gridInvoice_received_tax_tax_rate_id_Editor").addEventListener(event, function(){
						sw_change_tax_rate('gridInvoice_received_tax_tax_rate_id_Editor', 'gridInvoice_received_tax_overhead_rate_no_Editor', session); });
				});

				["focus"].forEach(function(event) {
       		document.getElementById("gridInvoice_received_tax_overhead_rate_no_Editor").addEventListener(event, function(){
						sw_change_tax_rate('gridInvoice_received_tax_tax_rate_id_Editor', 'gridInvoice_received_tax_overhead_rate_no_Editor', session); });
				});

        //end
        <?php
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