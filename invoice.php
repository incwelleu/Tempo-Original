<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");
require_once("include/accounting.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("db.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jttabcontrol.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");

use_unit("imglist.inc.php");
use_unit("buttons.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtlookuplabel.inc.php");



//Class definition
class invoice extends fmstrong
{
   public $invoice_dt = null;
   public $lbInvoice_dt = null;
   public $btnCreateInvoice = null;
   public $gridInvoice = null;
   public $TabInvoice = null;
   public $btnInvoices = null;
   public $active_tab = null;
   public $SelectedKeysField = null;
   public $winWorkCompleted = null;
   public $lbWork_completed_dt = null;
   public $work_completed_yn = null;
   public $work_completed_dt = null;
   public $btnSaveWorkCompleted = null;
   public $winProcess = null;
   public $SiteTheme = null;
   public $sqlInvoice = null;
   public $dsInvoice = null;
   public $sqlCompany = null;
   public $dsCompany = null;
   public $ImageList = null;
   public $sqlProvider_contact = null;
   public $dsProvider_contact = null;
   public $winInvoice = null;
   public $cbIncludeServicesEnded = null;
   public $FutureInvoiceDate = null;
   public $lbBilling_entity = null;
   public $cbBilling_entity = null;

   function invoiceCreate($sender, $params)
   {
      sw_style_selected($this);

      $this->ParameterInvoices();
   }

   function ParameterInvoices()
   {
      Global $SW_INVOICES_TAB;

      $this->lbTitle->Caption = Title_Invoicing;
      $this->lbTitle->Visible = True;
      $this->cbIncludeServicesEnded->Caption = SW_INCLUDE_SERVICES_ENDED;

      $sql = "Select * from billing_entity ";
      $this->cbBilling_entity->Items = sw_records_array($sql, array('billing_entity_id', 'billing_entity_name'));

      if( ! $this->btnInvoices->inSession(''))
      {
         $this->TabInvoice->TabIndex = 1;
         $this->TabInvoice->Tabs = $SW_INVOICES_TAB;

         $this->TabChange();
      }
   }

   //Get Invoice date
   function GetFutureInvoiceDate()
   {
      Global $connectionDB;
      $sql = "SELECT MAX(future_invoice_dt) AS future_invoice_dt FROM line_item
              WHERE status_cd = 'IV' AND frequency_no != 0";

      $connectionDB->Connected();
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->SQL = $sql;
      $query->open();

      $future_invoice_dt = $query->EOF ? date('Y-m-d'): $query->Fields['future_invoice_dt'];
      return sw_future_invoice_date($future_invoice_dt);
   }

   function TabInvoiceJSChange($sender, $params)
   {
      echo $this->TabInvoice->ajaxCall("TabChange");
      ?>
        //begin js
        gridInvoice.selectAll(false);
        gridInvoice._showWaitWindow();
        document.getElementById("cbIncludeServicesEnded_outer").style.display ='none';
        if (document.getElementById( "TabInvoice" ).TabIndex == 0){
          document.getElementById("cbIncludeServicesEnded_outer").style.display ='block';
        }
 				return false;
        //end
      <?php
   }

   function TabChange()
   {
      Global $SW_INVOICES_TAB;

      $this->TabInvoice->TabIndex = $this->TabInvoice->TabIndex;
      $this->active_tab->Value = $SW_INVOICES_TAB[$this->TabInvoice->TabIndex][1];

      $this->sqlInvoice->close();
      $this->gridInvoice->Columns = array();
      foreach($this->gridInvoice->Columns as $Column)
      {
        $Column->Filter = "";
      }

      if($this->active_tab->Value == 'TabService')
      {
      	$this->ViewService();
      }
      else if($this->active_tab->Value == 'TabProforma')
      {
      	$this->ViewProforma();
      }
      else if($this->active_tab->Value == 'TabToInvoice')
      {
      	$this->ViewToInvoice();
      }
      else if($this->active_tab->Value == 'TabInvoiced')
      {
      	$this->ViewInvoiced();
      }
      else if($this->active_tab->Value == 'TabCommission')
			{
				$this->ViewCommission();
      }

      $this->sqlInvoice->open();
      $this->gridInvoice->init();
   }

   function ViewService()
   {
      Global $period_type, $GRID_COLUMN;

      $enable = 1;
      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "7");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      $items['btnSave'] = array(btnSave, $enable, "5");
      $items['btnCancel'] = array(btnCancel, $enable, "4");
      $items['btnExportXLS'] = array(btnExportXLS, $enable, "8");
      $this->btnInvoices->Items = $items;

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany, VALUE_FIELD=>'company_id', TEXT_FIELD=>'short_name');
      $property = array(TEXT_FIELD=>'short_name', EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('company_id', $this->gridInvoice, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsProvider_contact, VALUE_FIELD=>'provider_contact_id', TEXT_FIELD=>'provider_contact_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_CHARGE_TO, WIDTH=>100,
                        TEXT_FIELD=>'provider_contact_name',
                        DEFAULT_FILTER=>'Contains',
                        EDITOR_TYPE=>'LookupComboBox',
                        LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('applies_to_user_id', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridCustomColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'',
                        WIDTH=>1);
      $columns[] = sw_create_grid_column('selected_service_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridInvoice);

      $sql = "SELECT service_category_id, service_category_name FROM service_category ORDER BY sort_no";
      $record = sw_records_array($sql, array('service_category_id', 'service_category_name'));
      $record[] = '';
      $property = array(FILTER_OPTIONS=>$record, CAN_EDIT=>false);
      $columns[] = sw_create_grid_column('service_category_name', $this->gridInvoice, $property);

      $property = $GRID_COLUMN['quantity_no'];
      $property[SHOW_SUM] = True;
      $columns[] = sw_create_grid_column('quantity_no', $this->gridInvoice, $property);
      $columns[] = sw_create_grid_column('price_amt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice);

      unset($period_type[0]);
      $frequency = $period_type;
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_FREQUENCY, EDITOR_TYPE=>'ComboBox',
                        DEFAULT_FILTER=>'FilterEquals', COMBOBOX_EDITOR=>$frequency,
                        WIDTH=>80);
      $columns[] = sw_create_grid_column('frequency_no', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_START_DT,
                        DISPLAY=>'DateOnly', FORMAT=>'M/Y', ALIGNMENT=>'agCenter',
                        DEFAULT_FILTER=>'FilterLessThanOrEqualTo', WIDTH=>80);
      $columns[] = sw_create_grid_column('service_start_dt', $this->gridInvoice, $property);
      $property[CAPTION] = SW_CAPTION_END_DT;
      $columns[] = sw_create_grid_column('service_end_dt', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_NOTES, MAX_LENGTH=>255, WIDTH=>250);
      $columns[] = sw_create_grid_column('notes', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('tax_ident', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('client_name', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('tax_type_name', $this->gridInvoice, array(CAN_EDIT=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAN_EDIT=>False, CAN_MOVE=>False, CAPTION=>btnInvoiceAddress,
                        CAN_FILTER=>False, WIDTH=>200);
      $columns[] = sw_create_grid_column('company_client_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('short_name', $this->gridInvoice, array(VISIBLE=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>'', WIDTH=>0, VISIBLE=>false);
      $columns[] = sw_create_grid_column('sort_no', $this->gridInvoice, $property);
      $columns[] = sw_create_grid_column('service_id', $this->gridInvoice);

      $this->gridInvoice->Columns = $columns;
      $this->gridInvoice->ReadOnly = False;
      $this->gridInvoice->Header->ShowFilterBar = True;
      $this->gridInvoice->SortBy = 'short_name, service_category_name, sort_no';

      Define('COL_SERVICE_ID', $this->gridInvoice->findColumnByName('service_id'));
   }

   function ViewProforma()
   {
      Global $SW_STATUS_SERVICE_AGREEMENT_CD;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "7");
      $this->btnInvoices->Items = $items;

      $columns[] = sw_create_grid_column('short_name', $this->gridInvoice);
      $columns[] = sw_create_grid_column('company_name', $this->gridInvoice);
      $columns[] = sw_create_grid_column('description_service', $this->gridInvoice);

      $record = $SW_STATUS_SERVICE_AGREEMENT_CD;
      $columns[] = sw_create_grid_column('status_cd', $this->gridInvoice, array(FILTER_OPTIONS=>$record));
      $columns[] = sw_create_grid_column('quantity_no', $this->gridInvoice);
      $columns[] = sw_create_grid_column('price_amt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice);

      $this->gridInvoice->Columns = $columns;
      $this->gridInvoice->ReadOnly = True;
      $this->gridInvoice->SortBy = 'short_name';
   }

   function ViewToInvoice()
   {
      $enable = 1;
      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "7");
      $items['btnAdd'] = array(btnAdd, $enable, "2");
      $items['btnDelete'] = array(btnDelete, $enable, "6");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      $items['btnSave'] = array(btnSave, $enable, "5");
      $items['btnCancel'] = array(btnCancel, $enable, "4");
      $items['btnCreateMonthlyInvoice'] = array(btnCreateMonthlyInvoice, $enable);
      $items['btnExportXLS'] = array(btnExportXLS, $enable, "8");
      $this->btnInvoices->Items = $items;

      $record_provider = sw_get_data_table("vw_provider_contact", "provider_contact_id = {$_SESSION['user_id']}");

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_INVOICE_DT, DISPLAY=>'DateOnly',
                        FORMAT=>'M/Y', WIDTH=>80);
      $columns[] = sw_create_grid_column('future_invoice_dt', $this->gridInvoice, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany, VALUE_FIELD=>'company_id', TEXT_FIELD=>'short_name');
      $property = array(TEXT_FIELD=>'short_name', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('company_id', $this->gridInvoice, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsProvider_contact, VALUE_FIELD=>'provider_contact_id', TEXT_FIELD=>'provider_contact_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_CHARGE_TO, WIDTH=>100,
                        TEXT_FIELD=>'provider_contact_name',
                        DEFAULT_FILTER=>'Contains', EDITOR_TYPE=>'LookupComboBox',
                        LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('applies_to_user_id', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridCustomColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'',
                        WIDTH=>1);
      $columns[] = sw_create_grid_column('selected_service_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridInvoice);

      $sql = "SELECT service_category_id, service_category_name FROM service_category ORDER BY service_category_name";
      $record = sw_records_array($sql, array('service_category_id', 'service_category_name'));
      $record[] = '';
      $property = array(FILTER_OPTIONS=>$record, CAN_EDIT=>false);
      $columns[] = sw_create_grid_column('service_category_name', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('quantity_no', $this->gridInvoice);
      $columns[] = sw_create_grid_column('price_amt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_NOTES, MAX_LENGTH=>255, WIDTH=>150);
      $columns[] = sw_create_grid_column('notes', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('paid_dt', $this->gridInvoice, array(CAN_EDIT=>False));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_COMPLETED_DT, DISPLAY=>'DateOnly',
                        FORMAT=>'Y-m-d', ALIGNMENT=>'agCenter', WIDTH=>90);
      $columns[] = sw_create_grid_column('work_completed_dt', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridBooleanColumn',
                        CAPTION=>'Serv. Agreement', DISPLAY_FORMAT=>'CheckBox',
                        TRUE_TEXT=>SW_CAPTION_YES, FALSE_TEXT=>SW_CAPTION_NO,
                        ALIGNMENT=>'agCenter', WIDTH=>100, CAN_EDIT=>False);
      $columns[] = sw_create_grid_column('was_service_agreement', $this->gridInvoice, $property);

      $property = array(DATA_FIELD=>'service_type_id', 'Name'=>'service_type_id');
      $columns[] = sw_create_grid_column('service_type_name', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridBooleanColumn',
                        CAPTION=>SW_CAPTION_SUPPLEMENT_YN, DISPLAY_FORMAT=>'CheckBox',
                        TRUE_TEXT=>SW_CAPTION_YES, FALSE_TEXT=>SW_CAPTION_NO,
                        ALIGNMENT=>'agCenter', WIDTH=>90);
      $columns[] = sw_create_grid_column('with_supplement_yn', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('tax_ident', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('client_name', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('tax_type_name', $this->gridInvoice, array(CAN_EDIT=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAN_EDIT=>False, CAN_MOVE=>False, CAPTION=>btnInvoiceAddress,
                        CAN_FILTER=>False, WIDTH=>200);
      $columns[] = sw_create_grid_column('company_client_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('short_name', $this->gridInvoice, array(VISIBLE=>false));
      $columns[] = sw_create_grid_column('service_id', $this->gridInvoice);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'',
                        VISIBLE=>FALSE);
      $columns[] = sw_create_grid_column('sort_no', $this->gridInvoice, $property);

      $this->gridInvoice->Columns = $columns;
      $this->gridInvoice->ReadOnly = False;
      $this->gridInvoice->Header->ShowFilterBar = True;
      $this->gridInvoice->SortBy = 'short_name, service_category_name, sort_no';

      Define('COL_SERVICE_ID', $this->gridInvoice->findColumnByName('service_id'));
   }

   function ViewInvoiced()
   {
      $enable = 1;
      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "7");
      $items['btnExportXLS'] = array(btnExportXLS, $enable, "8");

      $this->btnInvoices->Items = $items;

      $columns[] = sw_create_grid_column('invoice_dt', $this->gridInvoice, array(FORMAT=>'M/Y'));
      $columns[] = sw_create_grid_column('invoice_number', $this->gridInvoice);
      $columns[] = sw_create_grid_column('invoice_pdf', $this->gridInvoice);

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany, VALUE_FIELD=>'company_id', TEXT_FIELD=>'short_name');
      $property = array(TEXT_FIELD=>'short_name', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('company_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridInvoice);

      $sql = "SELECT service_category_id, service_category_name FROM service_category ORDER BY service_category_name";
      $record = sw_records_array($sql, array('service_category_id', 'service_category_name'));
      $record[] = '';
      $property = array(FILTER_OPTIONS=>$record, CAN_EDIT=>false);
      $columns[] = sw_create_grid_column('service_category_name', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('quantity_no', $this->gridInvoice);
      $columns[] = sw_create_grid_column('price_amt', $this->gridInvoice);
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_NOTES, MAX_LENGTH=>255, WIDTH=>150);
      $columns[] = sw_create_grid_column('notes', $this->gridInvoice, $property);
      $columns[] = sw_create_grid_column('paid_dt', $this->gridInvoice, array(CAN_EDIT=>False));

      $lookupComboBox = array(DATASOURCE=>$this->dsProvider_contact, VALUE_FIELD=>'provider_contact_id', TEXT_FIELD=>'provider_contact_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_CHARGE_TO, WIDTH=>100,
                        TEXT_FIELD=>'provider_contact_name',
                        DEFAULT_FILTER=>'Contains',
                        EDITOR_TYPE=>'LookupComboBox', LOOKUP_COMBOBOX=>$lookupComboBox);
      $columns[] = sw_create_grid_column('applies_to_user_id', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_COMPLETED_DT, DISPLAY=>'DateOnly',
                        FORMAT=>'Y-m-d', ALIGNMENT=>'agCenter', WIDTH=>100);
      $columns[] = sw_create_grid_column('work_completed_dt', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice, array(CAN_EDIT=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'',
                        VISIBLE=>FALSE);
      $columns[] = sw_create_grid_column('sort_no', $this->gridInvoice, $property);
      $columns[] = sw_create_grid_column('link', $this->gridInvoice);

      $this->gridInvoice->Columns = $columns;
      $this->gridInvoice->ReadOnly = True;
      $this->gridInvoice->Header->ShowFilterBar = True;
      $this->gridInvoice->SortBy = 'invoice_dt desc, invoice_number desc, service_category_name, sort_no';
   }

   function ViewCommission()
   {
      $enable = 1;
      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "7");
      $items['btnEdit'] = array(btnEdit, $enable, "3");
      $items['btnSave'] = array(btnSave, $enable, "5");
      $items['btnCancel'] = array(btnCancel, $enable, "4");
      $items['btnWorkCompleted'] = array(btnWorkCompleted, $enable);
      $items['btnExportXLS'] = array(btnExportXLS, $enable, "8");
      $this->btnInvoices->Items = $items;

      $record_provider = sw_get_data_table("vw_provider_contact", "provider_contact_id = {$_SESSION['user_id']}");
      $lookupComboBox = array(DATASOURCE=>$this->dsProvider_contact, VALUE_FIELD=>'provider_contact_id', TEXT_FIELD=>'provider_contact_name');
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_CHARGE_TO, WIDTH=>100,
                        TEXT_FIELD=>'provider_contact_name',
                        DEFAULT_FILTER=>'Contains', EDITOR_TYPE=>'LookupComboBox',
                        LOOKUP_COMBOBOX=>$lookupComboBox, FILTER=>$record_provider['provider_contact_name']);
      $columns[] = sw_create_grid_column('applies_to_user_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('paid_dt', $this->gridInvoice, array(CAN_EDIT=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_COMPLETED_DT, DISPLAY=>'DateOnly',
                        FORMAT=>'Y-m-d', ALIGNMENT=>'agCenter', WIDTH=>100);
      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>SW_CAPTION_COMPLETED_DT, DISPLAY=>'DateOnly',
                        FORMAT=>'M/Y', ALIGNMENT=>'agCenter', WIDTH=>120);

      $columns[] = sw_create_grid_column('work_completed_dt', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('commission_amt', $this->gridInvoice, array(CAN_EDIT=>false));

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        ALIGNMENT=>'agRight', CAN_MOVE=>False,
                        CAPTION=>SW_CAPTION_FUTURE_COMMISSION, DEFAULT_FILTER=>'Equal',
                        DATA_FORMAT=>'%01.2f', WIDTH=>90, SHOW_SUM=>True);
      $columns[] = sw_create_grid_column('future_commission_amt', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn',
                        CAPTION=>SW_CAPTION_NOTES, MAX_LENGTH=>255, WIDTH=>150);
      $columns[] = sw_create_grid_column('notes', $this->gridInvoice, $property);

      $lookupComboBox = array(DATASOURCE=>$this->dsCompany, VALUE_FIELD=>'company_id', TEXT_FIELD=>'short_name');
      $property = array(TEXT_FIELD=>'short_name', LOOKUP_COMBOBOX=>$lookupComboBox, CAN_EDIT=>false);
      $columns[] = sw_create_grid_column('company_id', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridInvoice, array(CAN_EDIT=>false));

      $sql = "SELECT service_category_id, service_category_name FROM service_category ORDER BY service_category_name";
      $record = sw_records_array($sql, array('service_category_id', 'service_category_name'));
      $record[] = '';
      $property = array(FILTER_OPTIONS=>$record, CAN_EDIT=>false);
      $columns[] = sw_create_grid_column('service_category_name', $this->gridInvoice, $property);

      $property = array(TYPE_COLUMN=>'JTPlatinumGridDateTimeColumn',
                        CAPTION=>'Invoice date', DISPLAY=>'DateOnly',
                        FORMAT=>'M/Y', ALIGNMENT=>'agCenter', WIDTH=>120);
      $columns[] = sw_create_grid_column('invoice_dt', $this->gridInvoice, $property);

      $columns[] = sw_create_grid_column('invoice_number', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('quantity_no', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('price_amt', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('total_amt', $this->gridInvoice, array(CAN_EDIT=>false));

      $columns[] = sw_create_grid_column('created_dt', $this->gridInvoice, array(CAN_EDIT=>false));
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridInvoice, array(CAN_EDIT=>false));
      $property = array(TYPE_COLUMN=>'JTPlatinumGridTextColumn', ALIGNMENT=>'agLeft',
                        CAN_FILTER=>False, CAN_SELECT=>False,
                        CAN_SORT=>False, CAPTION=>'',
                        VISIBLE=>FALSE);
      $columns[] = sw_create_grid_column('sort_no', $this->gridInvoice, $property);

      $this->gridInvoice->Columns = $columns;
      $this->gridInvoice->Header->ShowFilterBar = True;
      $this->gridInvoice->ReadOnly = False;
      $this->gridInvoice->SortBy = 'work_completed_dt, paid_dt, invoice_number desc, service_category_name, sort_no';
   }

   function btnInvoicesJSClick($sender, $params)
   {
      Global $lbDeleteInformationMsg;
      ?>
        //begin js
        var info = getEventTarget( event ).id.split( "_" );
        var toolButton = info[ 0 ];
        var toolButtonName = info[ 1 ];

        if (toolButton == 'btnInvoices'){
        	if (toolButtonName == 'btnFilter') {
          	gridInvoice.deselectAll();
						gridInvoice._showWaitWindow();
          	params = [0];
        		<?php echo $this->gridInvoice->ajaxCall('filter_grid', array(), array($this->gridInvoice->Name));?>
          	return false;
          }
        	else if (toolButtonName == 'btnAdd') {
            gridInvoice.Insert();
            gridInvoice.setEditorValue("frequency_no", "1");
            if (document.getElementById( "TabInvoice" ).TabIndex == 1){
              gridInvoice.setEditorValue("future_invoice_dt", "<?php echo $this->GetFutureInvoiceDate();?>");
              gridInvoice.setEditorValue("applies_to_user_id", "<?php echo $_SESSION['user_id'];?>");
            }
            return false;
          }
          else if (toolButtonName == 'btnCancel') { gridInvoice.Cancel(); return false;}
          else if (toolButtonName == 'btnSave') { gridInvoice.Post(); return false;}
          else if ((toolButtonName == 'btnDelete') || (toolButtonName == 'btnEdit') ||
                   (toolButtonName == 'btnWorkCompleted') ||
                   (toolButtonName == 'btnCreateMonthlyInvoice')){
            var keys = [];
            for (var row in gridInvoice.SelectedCells) {
              if (typeof(gridInvoice.SelectedCells[row]) != "function" &&
              	 (gridInvoice.SelectedCells[row] != '') &&
                 (gridInvoice.SelectedCells[row] != null)) {
          			 if (toolButtonName == 'btnEdit'){ gridInvoice.Edit(row); return false;}
                 keys.push(gridInvoice.getPrimaryKey(row));
              }
            }

            if (findObj('SelectedKeysField').value = keys.join(',')){
              if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg?>");}
							if (toolButtonName == 'btnWorkCompleted') { document.getElementById( "winWorkCompleted" ).ShowModal();}
            }
          	if (toolButtonName == 'btnCreateMonthlyInvoice') { document.getElementById( "winInvoice" ).ShowModal(); }
            return false;
          }
        }
        //end
      <?php
   }

   function btnInvoicesClick($sender, $params)
   {
      list($toolButton, $toolButtonName) = explode('_', $params[0]);

      if($toolButtonName == "btnDelete")
      {
         $this->DeleteRecordSelected();
      }
      else
         if($toolButtonName == "btnAddService")
         {
            $this->winProcess->ActiveLayer = 0;
            $this->winProcess->Height = 500;
            $this->winProcess->Width = 650;
            $this->winProcess->Caption = btnAddService;
            $this->winProcess->Include = 'include/add_service_item_company.php';
            $this->winProcess->ShowModal();
         }
         else
            if($toolButtonName == 'btnExportXLS')
            {
               $filename = sw_clean_characters_spanish($this->TabInvoice->Tabs[$this->TabInvoice->TabIndex][0]);
               $this->gridInvoice->exportGridToXLSDownload($filename . ".xls", $filename, True);
            }

   }

   function DeleteRecordSelected()
   {
      if($this->SelectedKeysField->Value)
      {
         Global $connectionDB, $SW_STATUS_LI_TO_INVOICE;
         $sqlUpdate = "";
         $sqlDelete = "DELETE FROM line_item
        			  		  WHERE {$this->gridInvoice->KeyField} in ({$this->SelectedKeysField->Value}) ";

         if($this->active_tab->Value == 'TabToInvoice')
         {
            $sqlDelete .= " AND IsNull(service_agreement_id)";
            $sqlUpdate = "UPDATE line_item
          							SET status_cd = '" . SW_STATUS_LI_PROFORMA . "'
                        WHERE {$this->gridInvoice->KeyField} in ({$this->SelectedKeysField->Value}) AND
                        			Not IsNull(service_agreement_id) ";
         }

         $connectionDB->DbConnection->BeginTrans();
         $connectionDB->DbConnection->execute($sqlDelete);
         if($sqlUpdate)
            $connectionDB->DbConnection->execute($sqlUpdate);
         $connectionDB->DbConnection->CompleteTrans();
         $this->gridInvoice->writeSelectedCells(array());
      }
   }

   function gridInvoiceRowData($sender, $params)
   {
      $fields = &$params[1];

      if($fields['future_invoice_dt'] == '0000-00-00')
         $fields['future_invoice_dt'] = '';
      if($this->active_tab->Value == 'TabProforma')
      {
         Global $SW_STATUS_SERVICE_AGREEMENT_CD;
         $fields["status_cd"] = $SW_STATUS_SERVICE_AGREEMENT_CD[$fields["status_cd"]];
      }
      else
         if($this->active_tab->Value == 'TabService')
         {
            Global $period_type;
            $fields["frequency_no"] = $period_type[$fields["frequency_no"]];
            $fields['service_start_dt'] = $fields['service_start_dt'] == '0000-00-00'? '': $fields['service_start_dt'];
            $fields['service_end_dt'] = $fields['service_end_dt'] == '0000-00-00'? '': $fields['service_end_dt'];
         }
         else
            if($this->active_tab->Value == 'TabToInvoice')
            {
               $fields['work_completed_dt'] = $fields['work_completed_dt'] == '0000-00-00'? '': $fields['work_completed_dt'];
            }
            else
               if($this->active_tab->Value == 'TabInvoiced' || $this->active_tab->Value == 'TabCommission')
               {
                  $fields['work_completed_dt'] = $fields['work_completed_dt'] == '0000-00-00'? '': $fields['work_completed_dt'];
                  $fields['paid_dt'] = $fields['paid_dt'] == '0000-00-00'? '': $fields['paid_dt'];
               }

      if(isset($fields['invoice_pdf']) && $fields['link'])
      {
         $fields['invoice_pdf'] = 'images/ftp/1px.gif';
         $file = utf8_decode($fields['link']);
         if(($file != "") && file_exists($file))
         {
            $fields['invoice_pdf'] = 'images/ftp/pdf.gif';
         }
         else
            $fields['link'] = "";
      }

      if(isset($fields['company_client_id']))
      {
         $client_data = sw_get_client_data($fields['company_client_id']);
         $fields['company_client_id'] = $client_data['address'];
      }
   }

   function gridInvoiceJSRowEdited($sender, $params)
   {
      Global $lbRequiredFieldError, $lbInvoiceDateInvalid;
      ?>
        //begin js
        var msgError = '';
        var now = new Date()
        var now = new Date(now.getFullYear().toString() + "-" + (now.getMonth()+1).toString() + "-" + now.getDate().toString());
        var future_invoice_dt = new Date(gridInvoice.getEditorValue("future_invoice_dt"));

        var companyID = gridInvoice.getEditorValue("company_id");
        var serviceID = gridInvoice.getEditorValue("service_id");
        var description = gridInvoice.getEditorValue("description_service");
        var quantity_no = gridInvoice.getEditorValue("quantity_no");
        var price_amt = gridInvoice.getEditorValue("price_amt");

        if ((document.getElementById( "TabInvoice" ).TabIndex == 1) &&
            (future_invoice_dt !== '') &&
            (future_invoice_dt.getMonth()+1 < now.getMonth()+1) &&
            (future_invoice_dt.getFullYear() <= now.getFullYear())) {
        	msgError = msgError + "<?php echo $lbInvoiceDateInvalid;?>" + '</br>';
        }

        if (companyID === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_SHORT_NAME;?>" + '</br>';
        }

        if (serviceID === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_SERVICE;?>" + '</br>';
        }

        if (description === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_DESCRIPTION;?>" + '</br>';
        }

        if (msgError != ''){
        	msgError = "<?php echo $lbRequiredFieldError;?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
        }
        return (msgError == '');
        //end
      <?php
   }

   function gridInvoiceUpdate($sender, $params)
   {
      $key = $sender->KeyField;
      $table = $sender->Datasource->DataSet->TableName;
      //Insert
      if(count($params) == 1)
      {
         $fields = &$params[0];
         $fields['created_by_user_id'] = $_SESSION['user_id'];
         $fields['created_dt'] = date('Y-m-d H:i:s');
      }
      else
      {
         // Update
         $fields = &$params[1];
         $fields[$key] = $params[0];
      }

      //Data
      $record_service = sw_get_data_table("service", "service.service_id = {$fields['service_id']}");
      $fields['sort_no'] = $record_service['sort_no'];
      $fields['work_completed_yn'] = ($fields['work_completed_dt'] && $fields['work_completed_dt'] !== '0000-00-00');

      if($this->active_tab->Value != 'TabCommission')
      {
         //ts 7/11/2016: added condition
         $fields['quantity_no'] = sw_convert_comma_point($fields['quantity_no']);
         $fields['price_amt'] = sw_convert_comma_point($fields['price_amt']);
         $fields['total_amt'] = round($fields['quantity_no'] * $fields['price_amt'], 2);
      }

      if($this->active_tab->Value == 'TabService')
      {
         $fields['status_cd'] = SW_STATUS_LI_SERVICE;
         $fields['status_previous_cd'] = SW_STATUS_LI_SERVICE;
         $fields["frequency_no"] =  ! $fields["frequency_no"]? 1: $fields["frequency_no"];
      }
      else
         if($this->active_tab->Value == 'TabToInvoice')
         {
            $fields['status_cd'] = SW_STATUS_LI_TO_INVOICE;
            $fields['status_previous_cd'] = SW_STATUS_LI_TO_INVOICE;
            $fields['description'] = sw_replace_date_macro($fields['description'], Date('Y-m-d'));
            $fields['commission_amt'] = $record_service['commission_amt'];
            $fields['future_commission_amt'] = $record_service['future_commission_amt'];
         }

      if( ! $fields[$key])
      {
         $fields['future_invoice_dt'] = $record_service['with_supplement_yn'] || $fields['future_invoice_dt'] === ''? '': $fields['future_invoice_dt'];
         $fields['with_supplement_yn'] = $record_service['with_supplement_yn'];
         sw_insert_table($table, $fields);
      }
      else
      {
         if($fields['future_invoice_dt'] && ($record = $this->WithSupplied($fields['line_item_id'])))
         {
            $fields['future_invoice_dt'] = '';
         }
         sw_update_table($table, $fields, $key . " = " . $fields[$key]);
      }
   }

   function gridInvoiceJSRowEditing($sender, $params)
   {
      ?>
        //begin js
        $(document).ready(function($) {
          if (document.getElementById("gridInvoice_frequency_no_Editor")){
            var col = sw_SearchStringInArray(sender.FEditableColumns, 'Name', 'frequency_no');
        		var cellValue = gridInvoice.getCellText(rowIndex, col);
        		sw_SelectComboBox(document.getElementById("gridInvoice_frequency_no_Editor"), cellValue);
          }

          if (document.getElementById("gridInvoice_service_id_Editor")){
            var col = sw_SearchStringInArray(sender.FEditableColumns, 'Name', 'service_id');
            var cellValue = gridInvoice.getCellText(rowIndex, col);
            $('#gridInvoice_selected_service_id_Editor').val(cellValue);
          }

        	$('#gridInvoice_selected_service_id_Editor').change(function() {
          	var service_description = $('#gridInvoice_selected_service_id_Editor option:selected').text();
            var service = service_description.split('|');
          	var service_id = $('#gridInvoice_selected_service_id_Editor option:selected').val();

            var description = $('#gridInvoice_description_service_Editor').val();
            var quantity_no = $('#gridInvoice_quantity_no_Editor').val();
            var price_amt = parseFloat($('#gridInvoice_price_amt_Editor').val());

            $('#gridInvoice_description_service_Editor').val($.trim(service[0]));
            $('#gridInvoice_quantity_no_Editor').val(1);
            $('#gridInvoice_price_amt_Editor').val($.trim(service[1]));

            $('#gridInvoice_service_id_Editor').val(service_id);
            return false;
          });
        });

        //end
      <?php
   }

   function gridInvoiceCustomEditorGenerate($sender, $params)
   {
      list($grid, $column) = $params;

      // This is the special name that editor fields must use.
      $name = $grid->Name . '_' . $column->Name . '_Editor';
      $select = ($this->active_tab->Value == 'TabService')? "RegularService": "All";

      // Render an HTML text box.
      return sw_created_combobox_service($name, $select);
   }

   function gridInvoiceCustomFieldGenerate($sender, $params)
   {
      list($grid, $column, $fields) = $params;
   }

   function gridInvoiceSQL($sender, $params)
   {
      list($sortSql, $sortFields, $filterSql) = $params;

      $sql = $this->assigned_sql();

      if($_SESSION['accounting_year'] && ($this->gridInvoice->findColumnByFieldName('invoice_dt') != -1))
      {
         $sql .= " AND (YEAR(invoice_dt) = {$_SESSION['accounting_year']})";
      }

      $filterSql = $this->FilterFutureInvoiceDate($filterSql);

      $filterSql = $this->FilterInvoiceDate($filterSql);

      $filterSql = $this->FilterFrequency($filterSql);

      $filterSql = $this->FilterServAgreement($filterSql);

      //      $filterSql = $this->FilterPaid($filterSql);

      $filterSql = $this->FilterWorkCompletedDate($filterSql);

      if($this->active_tab->Value == 'TabService')
      {
         if( ! $this->cbIncludeServicesEnded->Checked)
         {
            $filterSql .= $filterSql? " AND ": "";
            $filterSql .= "((CURDATE() >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
                          (CURDATE() <= LAST_DAY(line_item.service_start_dt)) OR
                          (line_item.service_start_dt IS NULL) OR
                          (line_item.service_start_dt = '0000-00-00')
                         ) AND
                         ((CURDATE() <= LAST_DAY(line_item.service_end_dt)) OR
                          (line_item.service_end_dt IS NULL) OR
                          (line_item.service_end_dt = '0000-00-00')
                         ) ";
         }
      }
      else
         if($this->active_tab->Value == 'TabInvoiced')
         {
            $filterSql =  ! $filterSql? " (invoice_issued.invoice_dt > DATE_SUB(CURDATE(), INTERVAL 3 MONTH)) ": $filterSql;
         }

      if(($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
         $sql .= " AND " . $filterSql;

			if($this->active_tab->Value == 'TabToInvoice')
		  {
			   $sortSql = $sortSql? "YEAR(IFNULL(future_invoice_dt, '0000-00-00')), DATE_FORMAT(IFNULL(future_invoice_dt, '0000-00-00'), '%m'), " . $sortSql: $sortSql;
		  }

      $sortSql = " ORDER BY " . $sortSql;
      $this->sqlInvoice->SQL = $sql . $sortSql;
   }

   function assigned_sql()
   {
      Global $language;
      $company_strong_id = sw_get_company_strong();
      $sql = $this->sqlInvoice->SQL;
      $defaultFilter = " ";
      if($this->active_tab->Value == 'TabService')
      {
         $sql = "SELECT line_item_id, line_item.company_id,
      							 company.company_name, company.short_name,
                     line_item.created_dt, line_item.status_cd,
       							 line_item.description, line_item.quantity_no, line_item.price_amt,
       							 line_item.total_amt, line_item.notes, line_item.future_invoice_dt,
                     line_item.created_by_user_id, user.username, line_item.frequency_no,
                     line_item.service_start_dt, line_item.service_end_dt,
                     line_item.service_id, line_item.sort_no, vw_service.service_category_name,
                     line_item.applies_to_user_id, vw_provider_contact.provider_contact_name,
                     vw_company_client_strong.tax_ident, vw_company_client_strong.client_name,
                     vw_company_client_strong.tax_type_name, vw_company_client_strong.company_client_id
								FROM line_item
       							LEFT JOIN company ON line_item.company_id = company.company_id
       							LEFT JOIN user ON line_item.created_by_user_id = user.user_id
                    LEFT JOIN vw_service ON line_item.service_id = vw_service.service_id
     								LEFT JOIN (SELECT provider_contact_id, provider_contact_name FROM vw_provider_contact) AS vw_provider_contact
                    ON line_item.applies_to_user_id = vw_provider_contact.provider_contact_id
                    LEFT JOIN vw_company_client_strong
                    ON company.company_id = vw_company_client_strong.company_id AND
                    vw_company_client_strong.company_strong_id in ({$company_strong_id})
              	WHERE line_item.status_cd = '" . SW_STATUS_LI_SERVICE . "' ";

      }
      else
         if($this->active_tab->Value == 'TabProforma')
         {
            $sql = "SELECT line_item_id, CASE IFNULL(company.company_name, '') WHEN '' THEN CONCAT(service_agreement.`last_name`, ', ', service_agreement.`first_name`)
       							 ELSE company.company_name END AS company_name,
										 CASE IFNULL(company.short_name, '') WHEN '' THEN CONCAT(service_agreement.`last_name`, ', ', service_agreement.`first_name`)
       							 ELSE company.short_name END AS short_name,
                     line_item.created_dt, service_agreement.status_cd,
       							 line_item.description, line_item.quantity_no, line_item.price_amt,
       							 line_item.total_amt, line_item.created_by_user_id, vw_provider_contact.username
								FROM line_item
       							INNER JOIN (SELECT service_agreement_id, last_name, first_name, status_cd, company_id
                    						FROM service_agreement
                                WHERE status_cd in ('" . SW_STATUS_SVC_SENT . "','" . SW_STATUS_SVC_ACCEPTED . "')) as service_agreement
       							ON line_item.service_agreement_id = service_agreement.service_agreement_id AND
                    	 line_item.status_cd = '" . SW_STATUS_LI_PROFORMA . "'
       							LEFT JOIN company ON service_agreement.company_id = company.company_id
     								LEFT JOIN (SELECT provider_contact_id, provider_contact_name, username FROM vw_provider_contact) AS vw_provider_contact
                    ON line_item.applies_to_user_id = vw_provider_contact.provider_contact_id";

         }
         else
            if($this->active_tab->Value == 'TabToInvoice')
            {
               $sql = "SELECT line_item_id, line_item.future_invoice_dt, line_item.company_id,
      							 company.company_name, company.short_name,
                     line_item.created_dt, line_item.status_cd,
       							 line_item.description, line_item.quantity_no, line_item.price_amt,
       							 line_item.total_amt, line_item.created_by_user_id, user.username,
                     line_item.applies_to_user_id, vw_provider_contact.provider_contact_name,
                     line_item.work_completed_yn, line_item.work_completed_dt,
                     line_item.service_type_id, service_type.description_{$language} AS service_type_name,
                     line_item.with_supplement_yn, line_item.service_id, line_item.sort_no, line_item.notes,
                     service_agreement.paid_dt,
										 CASE IFNULL(line_item.service_agreement_id, '') WHEN '' THEN 0
       							 ELSE 1 END AS was_service_agreement, vw_service.service_category_name,
                     vw_company_client_strong.tax_ident, vw_company_client_strong.client_name,
                     vw_company_client_strong.tax_type_name, vw_company_client_strong.company_client_id
								FROM line_item
       							LEFT JOIN (SELECT service_agreement_id, paid_dt, paid_by
                    						FROM service_agreement WHERE status_cd = '" . SW_STATUS_SVC_PAID . "') as service_agreement
                    ON line_item.service_agreement_id = service_agreement.service_agreement_id
                    LEFT JOIN service_type ON line_item.service_type_id = service_type.service_type_id
       							LEFT JOIN company ON line_item.company_id = company.company_id
       							LEFT JOIN user ON line_item.created_by_user_id = user.user_id
     								LEFT JOIN (SELECT provider_contact_id, provider_contact_name FROM vw_provider_contact) AS vw_provider_contact
                    ON line_item.applies_to_user_id = vw_provider_contact.provider_contact_id
     								LEFT JOIN (SELECT vw_service.service_id, service_category_name FROM vw_service) AS vw_service ON line_item.service_id = vw_service.service_id
                    LEFT JOIN vw_company_client_strong
                    ON company.company_id = vw_company_client_strong.company_id AND
                    vw_company_client_strong.company_strong_id in ({$company_strong_id})
              	WHERE line_item.status_cd = '" . SW_STATUS_LI_TO_INVOICE . "'";
            }
            else
               if($this->active_tab->Value == 'TabInvoiced')
               {
                  $sql = "SELECT line_item_id, line_item.company_id, company.company_name,
                      IFNULL(company.short_name, invoice_issued.client_name) AS short_name,
                      line_item.created_dt, line_item.status_cd,
                      line_item.description, line_item.quantity_no, line_item.price_amt,
                      line_item.total_amt, line_item.created_by_user_id, user.username,
                      line_item.applies_to_user_id, vw_provider_contact.provider_contact_name,
                      line_item.service_type_id, service_type.description_{$language} AS service_type_name,
                      line_item.with_supplement_yn, line_item.work_completed_yn, line_item.work_completed_dt,
                      line_item.sort_no, line_item.notes,
                      invoice_issued.invoice_number, invoice_issued.invoice_dt,
                      invoice_issued.paid_yn, invoice_issued.paid_dt,
                      '' AS invoice_pdf, invoice_issued.link,
                      vw_service.service_category_name
                FROM line_item
                    LEFT JOIN company ON line_item.company_id = company.company_id
                    LEFT JOIN service_type ON line_item.service_type_id = service_type.service_type_id
                    LEFT JOIN user ON line_item.created_by_user_id = user.user_id
                    LEFT JOIN invoice_issued ON line_item.invoice_issued_id = invoice_issued.invoice_issued_id
                    LEFT JOIN (SELECT provider_contact_id, provider_contact_name FROM vw_provider_contact) AS vw_provider_contact
                    ON line_item.applies_to_user_id = vw_provider_contact.provider_contact_id
                    LEFT JOIN (SELECT vw_service.service_id, service_category_name FROM vw_service) AS vw_service
                    ON line_item.service_id = vw_service.service_id
                WHERE line_item.status_cd = '" . SW_STATUS_LI_INVOICED . "'";
               }
               else
                  if($this->active_tab->Value == 'TabCommission')
                  {
                     $sql = "SELECT line_item_id, line_item.company_id, company.company_name,
                      IFNULL(company.short_name, invoice_issued.client_name) AS short_name,
                      line_item.created_dt, line_item.status_cd,
                      line_item.description, line_item.quantity_no, line_item.price_amt,
                      line_item.total_amt, line_item.created_by_user_id, user.username,
                      line_item.applies_to_user_id, vw_provider_contact.provider_contact_name,
                      line_item.work_completed_yn, line_item.work_completed_dt,
                      line_item.commission_amt, line_item.future_commission_amt,
                      line_item.future_commission_dt, line_item.sort_no, line_item.notes,
                      invoice_issued.invoice_number, invoice_issued.invoice_dt,
                      invoice_issued.paid_yn, invoice_issued.paid_dt,
                      vw_service.service_category_name
                FROM line_item line_item
                		LEFT JOIN vw_service ON line_item.service_id = vw_service.service_id
       							LEFT JOIN company ON line_item.company_id = company.company_id
       							LEFT JOIN user ON line_item.created_by_user_id = user.user_id
                		LEFT JOIN invoice_issued ON line_item.invoice_issued_id = invoice_issued.invoice_issued_id
     								LEFT JOIN (SELECT provider_contact_id, provider_contact_name FROM vw_provider_contact) AS vw_provider_contact
                    ON line_item.applies_to_user_id = vw_provider_contact.provider_contact_id
              	WHERE vw_service.supplement_yn != 1 AND line_item.status_cd = '" . SW_STATUS_LI_INVOICED . "'";
                  }

      return $sql;
   }

   function FilterFutureInvoiceDate($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('future_invoice_dt')];
      if($Column->Filter !== "")
      {
         list($year, $month, $day) = explode("-", $Column->Filter);
         $search = "future_invoice_dt LIKE '%" . $Column->Filter . "%'";
         $filter = "MONTH(future_invoice_dt) = {$month} AND YEAR(future_invoice_dt) = {$year}";
         $filterSql = str_replace($search, $filter, $filterSql);
      }

      return $filterSql;
   }

   function FilterInvoiceDate($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('invoice_dt')];
      if($Column->Filter !== "")
      {
         list($year, $month, $day) = explode("-", $Column->Filter);
         $search = "invoice_dt LIKE '%" . $Column->Filter . "%'";
         $filter = "MONTH(invoice_dt) = {$month} AND YEAR(invoice_dt) = {$year}";
         $filterSql = str_replace($search, $filter, $filterSql);
      }

      return $filterSql;
   }

   function FilterFrequency($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('frequency_no')];
      if($Column->Filter !== "")
      {
         Global $period_type;

         $index = (string)array_search($Column->Filter, $period_type);
         $value = $period_type[$index];
         $filterSql = str_replace($value, $index, $filterSql);
      }

      return $filterSql;
   }

   function FilterServAgreement($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('was_service_agreement')];
      if($Column->Filter !== "")
      {
         $search = "was_service_agreement = " . $Column->Filter;
         $filter = $Column->Filter == 1? "Not IsNull(line_item.service_agreement_id)": "IsNull(line_item.service_agreement_id)";
         $filterSql = str_replace($search, $filter, $filterSql);
      }

      return $filterSql;
   }

   function FilterPaid($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('paid_yn')];
      if($Column->Filter !== "")
      {
         $search = "paid_yn = " . $Column->Filter;
         $filter = $Column->Filter == 1? "Not IsNull(service_agreement.paid_dt)": "IsNull(service_agreement.paid_dt)";
         $filterSql = str_replace($search, $filter, $filterSql);
      }

      return $filterSql;
   }

   function FilterWorkCompletedDate($filterSql)
   {
      $Column = $this->gridInvoice->Columns[$this->gridInvoice->findColumnByFieldName('work_completed_dt')];
      if($Column->Filter !== "")
      {
         list($year, $month, $day) = explode("-", $Column->Filter);
         $search = "work_completed_dt LIKE '%" . $Column->Filter . "%'";
         $filter = "MONTH(work_completed_dt) = {$month} AND YEAR(work_completed_dt) = {$year}";
         $filterSql = str_replace($search, $filter, $filterSql);
      }

      return $filterSql;
   }

   function CloseWindows()
   {
      $this->winProcess->ActiveLayer = 0;
      $this->winProcess->Include = '';
      $this->winProcess->Hide();
   }

   function btnSaveWorkCompletedClick($sender, $params)
   {
      if(($this->winWorkCompleted->Caption == btnWorkCompleted) && $this->SelectedKeysField->Value)
      {
         Global $connectionDB;

         if($this->work_completed_yn->Checked && $this->active_tab->Value == 'TabToInvoice')
         {
            if($record = $this->WithSupplied($this->SelectedKeysField->Value))
            {
               $company = implode(',', array_keys($record));
               $error_company = strtoupper(implode('</br>', $record));
               $this->msgError->Value = "No han sido asignados los suplidos para la(s) empresa(s)</br>" . $error_company;
            }
         }

         $work_completed_yn = $this->work_completed_yn->Checked;
         $work_completed_dt =  ! $this->work_completed_dt->Date? date('Y-m-d'): $this->work_completed_dt->Date;
         $work_completed_dt =  ! $work_completed_yn? '': $work_completed_dt;
         $future_invoice_dt =  ! $work_completed_yn? '': sw_future_invoice_date($work_completed_dt);

         $sql = "UPDATE line_item
        				SET work_completed_yn = {$work_completed_yn},
                    work_completed_dt = '{$work_completed_dt}'";
         $sql .= $this->active_tab->Value == 'TabToInvoice'? ", future_invoice_dt = '{$future_invoice_dt}'": "";
         $sql .= " WHERE {$this->gridInvoice->KeyField} in ({$this->SelectedKeysField->Value}) ";
         $sql .= isset($company)? " AND NOT (line_item.company_id in ({$company}))": "";

         $connectionDB->DbConnection->BeginTrans();
         $connectionDB->DbConnection->execute($sql);
         $connectionDB->DbConnection->CompleteTrans();

         $this->work_completed_yn->Checked = True;
         $this->work_completed_dt->Date = date('Y-m-d');
         $this->gridInvoice->writeSelectedCells(array());
      }
   }

   //Supplied Checked
   function WithSupplied($line_item)
   {
      $sql = "SELECT DISTINCT line_item.company_id, company.`short_name`
							FROM line_item
     							LEFT JOIN company ON line_item.company_id = company.company_id
     							LEFT JOIN
          					(SELECT line_item.company_id, company.`short_name`
           					FROM line_item
                				LEFT JOIN company ON line_item.company_id = company.company_id
                				LEFT JOIN service ON line_item.service_id = service.service_id
                				LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id
           					WHERE line_item.status_cd = '" . SW_STATUS_LI_TO_INVOICE . "' AND line_item.work_completed_yn = 0 AND
                 					line_item.service_type_id = 0 AND
                 					service_category.service_category_name like '%Suplido%') as service_company
     							ON line_item.`company_id` = service_company.company_id
							WHERE line_item.line_item_id in ({$line_item}) AND
              			line_item.status_cd = '" . SW_STATUS_LI_TO_INVOICE . "' AND service_company.company_id IS NULL AND
      							line_item.work_completed_yn = 0 AND line_item.with_supplement_yn = 1";
      $record = sw_records_array($sql, array('company_id', 'short_name'));

      return $record;
   }

   function gridInvoiceSummaryData($sender, $params)
   {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
   }

   function winWorkCompletedShow($sender, $params)
   {
      $this->winWorkCompleted->Caption = btnWorkCompleted;
      $this->work_completed_yn->Caption = SW_CAPTION_COMPLETED_YN;
      $this->lbWork_completed_dt->Caption = SW_CAPTION_COMPLETED_DT;
      $this->work_completed_yn->Checked = True;
      $this->work_completed_dt->Date = date('Y-m-d');
      $this->btnSaveWorkCompleted->Caption = btnSave;
   }

   function winInvoiceShow($sender, $params)
   {
      $this->winInvoice->Caption = btnCreateMonthlyInvoice;
      $this->lbInvoice_dt->Caption = SW_CAPTION_INVOICE_DT;
      $this->btnCreateInvoice->Caption = btnCreate;
			$this->invoice_dt->Date = $this->GetFutureInvoiceDate();
   }

   function btnCreateInvoiceClick($sender, $params)
   {
      $this->MonthlyBilling();
   }

   function MonthlyBilling()
   {
      Global $connectionDB;

      list($year, $month, $day) = explode("-", $this->invoice_dt->Date);

      $sql = "";
      if( ! $this->SelectedKeysField->Value)
      {
         //Line item Monthly
         $sql = "SELECT line_item.*, company.short_name
      					FROM line_item
              			INNER JOIN company ON line_item.company_id = company.company_id AND company.billing_entity_id = {$this->cbBilling_entity->ItemIndex}
     								INNER JOIN (SELECT vw_service.service_id, vw_service.service_category_name, vw_service.sort_no FROM vw_service) AS vw_service ON line_item.service_id = vw_service.service_id
										LEFT JOIN
          						(SELECT line_item.service_id, line_item.company_id FROM line_item
          						 WHERE line_item.status_cd = 'IV' AND
                						 YEAR(line_item.future_invoice_dt) = YEAR('{$this->invoice_dt->Date}') AND
                						 MONTH(line_item.future_invoice_dt) = MONTH('{$this->invoice_dt->Date}')) AS line_item_invoiced
     								ON line_item.service_id = line_item_invoiced.service_id AND
        						   line_item.company_id = line_item_invoiced.company_id
								WHERE (line_item.status_cd = '" . SW_STATUS_LI_SERVICE . "') AND
                      (line_item_invoiced.service_id IS NULL) AND
                      (
                        -- Mensual
                        ( (line_item.frequency_no = 1) AND
                          ( ('{$this->invoice_dt->Date}' >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
                            (line_item.service_start_dt IS NULL) OR
                            (line_item.service_start_dt = '0000-00-00')
                          )
                        )
                        OR
                        -- Anual
                        ( (line_item.frequency_no = 12) AND
                          ('{$this->invoice_dt->Date}' >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) AND
                          (MONTH('{$this->invoice_dt->Date}') = MONTH(line_item.service_start_dt))
                        )
                        OR
                        -- Trimestral
                        ( (line_item.frequency_no = 3) AND
                          ('{$this->invoice_dt->Date}' >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) AND
                          (MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 3 MONTH)) OR
                           MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 6 MONTH)) OR
                           MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 9 MONTH)) OR
                           MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 12 MONTH)))
                        )
                        OR
                        -- Semestral
                        ( (line_item.frequency_no = 6) AND
                          ('{$this->invoice_dt->Date}' >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) AND
                          (MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 6 MONTH)) OR
                           MONTH('{$this->invoice_dt->Date}') = MONTH(DATE_ADD(line_item.service_start_dt, INTERVAL 12 MONTH)))
                        )
                      ) AND
                    ( ('{$this->invoice_dt->Date}' <= LAST_DAY(line_item.service_end_dt)) OR
                      (line_item.service_end_dt IS NULL) OR
                      (line_item.service_end_dt = '0000-00-00')
                    )

                UNION ALL ";
      }

      $sql .= " SELECT line_item.*, company.short_name
                FROM line_item
                			INNER JOIN company ON line_item.company_id = company.company_id AND company.billing_entity_id = {$this->cbBilling_entity->ItemIndex}
     									INNER JOIN (SELECT vw_service.service_id, vw_service.service_category_name, vw_service.sort_no FROM vw_service) AS vw_service ON line_item.service_id = vw_service.service_id
								WHERE YEAR(line_item.future_invoice_dt) = YEAR('{$this->invoice_dt->Date}') AND
              				MONTH(line_item.future_invoice_dt) = MONTH('{$this->invoice_dt->Date}') AND
              				line_item.status_cd = '" . SW_STATUS_LI_TO_INVOICE . "' ";

      $sql .= $this->SelectedKeysField->Value? " AND {$this->gridInvoice->KeyField} in ({$this->SelectedKeysField->Value}) ": "";
      $sql .= "ORDER BY short_name, sort_no";

      $connectionDB->Connected();
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->SQL = $sql;
      $query->open();

      $company_id = 0;
      $invoice_issued = array();

      While( ! $query->EOF)
      {
         $line_item = $query->fieldbuffer;

         //Obtengo los parametros de la empresa de Strong por el pais que pertenece el cliente
         // AQUI IMPLEMENTO el nuevo SETTING
         $record_strong = sw_company_country_strong($query->Fields['company_id']);

         //Invoice new
         if($record_strong['company_id'] && $record_strong['tax_regime_id'])
         {

            if($company_id !== $query->Fields['company_id'])
            {
               //Totalizo la factura
               TotalInvoice($invoice_issued['invoice_issued_id']);

               //Crear el registro de Company_client para la empresa de Strong
               if( ! $record_strong['company_client_id'])
               {
                  $record_strong['company_client_id'] = sw_create_company_client_strong($record_strong['company_id'], $query->Fields['company_id']);
               }

               //Created Header Invoice
               $company_id = $query->Fields['company_id'];
               $invoice_issued = $this->CreateHeaderInvoice($company_id, $record_strong);
            }

            $this->CreateLineItemInvoice($invoice_issued, $record_strong, $line_item);
         }
         $query->next();
      }

      //Totalizo Factura
      TotalInvoice($invoice_issued['invoice_issued_id']);
   }

   function CreateHeaderInvoice($company_id, $record_strong)
   {
      list($year, $month, $day) = explode("-", $this->invoice_dt->Date);

      $company_client = sw_get_data_table("company_client", "company_client_id = {$record_strong['company_client_id']}");
      $invoice_issued['company_id'] = $record_strong['company_id'];
      $invoice_issued['created_by_user_id'] = $_SESSION['user_id'];
      $invoice_issued['company_client_id'] = $company_client['company_client_id'];
      $invoice_issued['payment_method_id'] = $company_client['payment_method_id'];
      $invoice_issued['tax_type_key_id'] = $company_client['tax_type_key_id'];

      //Get Last invoice number
      $invoice_issued['invoice_number'] = sw_last_invoice_issued($record_strong['company_id']);
      $invoice_issued['invoice_dt'] = $this->invoice_dt->Date;

      $invoice_issued['tax_ident'] = $company_client['tax_ident'];
      $invoice_issued['client_name'] = $company_client['client_name'];
      $invoice_issued['document_ident'] = $invoice_issued['invoice_number'];
      $invoice_issued['registered_in_acctg_software_dt'] = $this->invoice_dt->Date;
      $invoice_issued['created_dt'] = date('Y-m-d H:i:s');
      $invoice_issued['status_cd'] = SW_STATUS_IS_OPEN;

      sw_insert_table("invoice_issued", $invoice_issued);
      $invoice_issued['invoice_issued_id'] = mysql_insert_id();

      return $invoice_issued;
   }

   function CreateLineItemInvoice($invoice_issued, $record_strong, $line_item)
   {
      //Obtengo parametros de los servicio
      $where = "service.service_category_id = service_category.service_category_id AND service.service_id = {$line_item['service_id']}";
      $record_service = sw_get_data_table("service, service_category", $where);

      $this->AssignsTaxRateID($record_strong, $invoice_issued, $line_item, $record_service['supplement_yn']);

      $line_item['invoice_issued_id'] = $invoice_issued['invoice_issued_id'];
      $line_item['description'] = sw_replace_date_macro($line_item['description'], $this->invoice_dt->Date);
      $line_item['commission_amt'] = floatval($record_service['commission_amt']) > 0 ? $line_item['quantity_no'] * $record_service['commission_amt']: $line_item['total_amt'];
      $line_item['future_commission_amt'] = ($record_service['commission_amt']) > 0 ? $line_item['quantity_no'] * $record_service['commission_amt']: $line_item['total_amt'];

      if($line_item['status_cd'] == SW_STATUS_LI_SERVICE)
      {
         unset($line_item['line_item_id']);
         unset($line_item['service_agreement_id']);
         $line_item['created_by_user_id'] = $invoice_issued['created_by_user_id'];
         $line_item['created_dt'] = $invoice_issued['created_dt'];
         $line_item['future_invoice_dt'] = $invoice_issued['invoice_dt'];
         $line_item['status_cd'] = SW_STATUS_LI_INVOICED;

         sw_insert_table("line_item", $line_item);
      }
      else
      {
         $line_item['status_cd'] = SW_STATUS_LI_INVOICED;
         $where = "line_item_id = {$line_item['line_item_id']}";
         sw_update_table("line_item", $line_item, $where);

         //Si la Line Item pertecene a un Service Agreement actualizo su estado y los pagos
         if($line_item['service_agreement_id'])
         {
            $where = "service_agreement_id = {$line_item['service_agreement_id']}";
            $service_agreement['status_cd'] = SW_STATUS_SVC_INVOICED;
            $service_agreement['invoice_issued_id'] = $invoice_issued['invoice_issued_id'];
            sw_update_table("service_agreement", $service_agreement, $where);
            sw_update_table("invoice_issued_paid", $service_agreement, $where);
         }
      }
   }

   //Asigno el tipo de impuesto al servicio
   function AssignsTaxRateID($record_strong, $invoice_issued, &$line_item, $supplement_yn)
   {
      if($supplement_yn)
      {
         $where = "tax_regime_id = {$record_strong['tax_regime_id']} AND rate_no = 0";
         $record = sw_get_data_table('vw_tax_rate_country', $where);
      }
      else
         $record = sw_get_tax_rate_default($invoice_issued['tax_type_key_id'], $invoice_issued['company_id']);

      foreach($record as $key=>$value)
      {
         if(array_key_exists($key, $line_item))
            $line_item[$key] = $value;
      }
   }

   function gridInvoiceJSSelect($sender, $params)
   {
      ?>
        //begin js
          //Click Invoice PDF
        	if ((document.getElementById( "TabInvoice" ).TabIndex == 2) && (col == 2))
        	{
        		var cellValue = sender.getCellText(row, 16);
          	if (cellValue){
          		window.open(cellValue + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000),"_blank","", false);
							sender.SelectedCol = 0;
          	}
          }
        //end
      <?php
   }

   function gridInvoiceShow($sender, $params)
   {
      Global $language;
      Define('COL_SERVICE_TYPE', $this->gridInvoice->findColumnByName('service_type_id'));

      //Column Service Type
      $sql = "SELECT service_type_id, description_{$language} FROM service_type ORDER BY description_{$language}";
      $records = sw_records_array($sql, array("service_type_id", "description_{$language}"));
      $records[0] = '';
      $this->gridInvoice->Columns[COL_SERVICE_TYPE]->ComboBoxEditor->Values = $records;
      $this->gridInvoice->Columns[COL_SERVICE_TYPE]->FilterOptions = $records;
      $this->gridInvoice->Columns[COL_SERVICE_TYPE]->TextField = "service_type_name";
   }

   function invoiceJSLoad($sender, $params)
   {
      ?>
        //begin js
        document.getElementById("cbIncludeServicesEnded_outer").style.display ='none';
        if (document.getElementById( "TabInvoice" ).TabIndex == 0){
          document.getElementById("cbIncludeServicesEnded_outer").style.display ='block';
        }
        //end
      <?php
   }

   function cbIncludeServicesEndedJSChange($sender, $params)
   {
      ?>
        //begin js
        gridInvoice.Refresh();
        //end
      <?php
   }

}

global $application;

global $invoice;

//Creates the form
$invoice = new invoice($application);

//Read from resource file
$invoice->loadResource(__FILE__);

header("Content-type: text/html; charset=utf-8");

//Shows the form
$invoice->show();

?>