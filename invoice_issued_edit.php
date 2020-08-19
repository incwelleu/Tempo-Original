<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");
require_once("include/accounting.php");
require_once("include/dmCompany.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("styles.inc.php");
use_unit("components4phpfull/jthorizontalline.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("stdctrls.inc.php");

//Class definition
class invoice_issued_edit extends fmstrong
{
    public $sqlPayment_method = null;
    public $dsPayment_method = null;
    public $lbPay = null;
    public $pay_amt = null;
    public $tax_amt = null;
		public $tax_rate_default = null;
    public $gridLine_item = null;
    public $dsService = null;
    public $dsTax_type_key = null;
    public $dsCompany_client = null;
    public $dsTax_rate = null;
    public $dsSupplement = null;
    public $dsInvoice_issued_tax = null;
    public $dsLine_item = null;
    public $dsInvoice_issued = null;
    public $sqlService = null;
    public $sqlTax_type_key = null;
    public $sqlCompany_client = null;
    public $sqlTax_rate = null;
    public $sqlSupplement = null;
    public $sqlInvoice_issued_tax = null;
    public $sqlLine_item = null;
    public $sqlInvoice_issued = null;
    public $lbInvoice_number = null;
    public $lbInvoice_dt = null;
    public $lbTax_ident = null;
    public $tax_ident = null;
    public $client_name = null;
    public $company_client_id = null;
    public $add_client = null;
    public $lbAddress = null;
    public $address = null;
    public $invoice_number = null;
    public $invoice_dt = null;
    public $lbClient = null;
    public $lbClient_name = null;
    public $gridSupplement = null;
    public $gridInvoice_issued_tax = null;
    public $notes = null;
    public $btnSave = null;
    public $btnClose = null;
    public $lbNotes = null;
    public $invoice_issued_id = null;
    public $lbTax_type = null;
    public $lbPayment_method = null;
    public $payment_method_id = null;
    public $tax_type_key_id = null;
    public $lbTotal_amt = null;
    public $SiteTheme = null;
    public $total_amt = null;
    public $supplement_amt = null;
    public $subtotal_amt = null;
    public $lbPaid = null;
    public $paid_amt = null;

    function invoice_issued_editCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ChangeLanguage();

      $this->ParameterInvoice();
    }

    function ParameterInvoice()
    {
      Global $dmCompany;

      $dmCompany->Table_open();

      $enable = isset($_SESSION['company_id']) && $_SESSION['company_id'] != 0 ? True : False;
      $this->lbTitle->Caption = $enabled ? btnInvoice . " (" . $_SESSION['short_name'] . ")" : Title_Client;
      $this->lbTitle->Visible = True;

      $invoice_issued_id = isset($_REQUEST['ID']) && ($this->invoice_issued_id->Value != $_REQUEST['ID']);
      if ($invoice_issued_id) $this->invoice_issued_id->Value = $_REQUEST['ID'];

      $this->TableOpen();

			$this->ViewInvoiceData($invoice_issued_id);
      $this->ActivateObjetc();
    }

    function TableOpen()
    {
			Global $language;

      //Query with Payment method language
			$sql = "SELECT payment_method_id, {$language} as payment_method_name
							FROM payment_method
										INNER JOIN billing_entity ON payment_method.billing_entity_id = billing_entity.billing_entity_id
							WHERE billing_entity.company_id = {$_SESSION['company_id']}
							ORDER BY {$language}";
      $this->sqlPayment_method->Active = False;
      $this->sqlPayment_method->SQL = $sql;
      $this->sqlPayment_method->Active = True;

      //Company client
      $this->sqlCompany_client->close();
      $this->sqlCompany_client->Params = array($_SESSION['company_id']);
      $this->sqlCompany_client->open();

			//Tax rate
      $this->sqlTax_rate->close();
      $this->sqlTax_rate->Params = array($_SESSION['tax_regime_id']);
      $this->sqlTax_rate->open();

      //Type TAX
      $sql = "SELECT * FROM tax_type_key
              WHERE (type_tax_cd = " . GLOBAL_OUTPUT_TAX . ") AND (visible_yn = True) AND (country_id = {$_SESSION['country_id']})";
      $this->sqlTax_type_key->close();
      $this->sqlTax_type_key->SQL = $sql;
      $this->sqlTax_type_key->open();
    }


		function ViewInvoiceData($invoice_issued_id)
    {
      if ($invoice_issued_id || !$this->invoice_number->inSession('')){
      	//Creted Grid
      	$this->CreateGridLineItem();
      	$this->CreateGridTax();
				$this->CreateGridSupplement();

				//Header Invoice
      	$sql = "SELECT * FROM invoice_issued
      					WHERE invoice_issued_id = {$this->invoice_issued_id->Value} ";
      	$this->sqlInvoice_issued->close();
      	$this->sqlInvoice_issued->SQL = $sql;
      	$this->sqlInvoice_issued->open();

        $this->paid_amt->text = sw_convert_comma_point($this->sqlInvoice_issued->Fields['paid_amt']);
      	$record = sw_get_client_data($this->sqlInvoice_issued->Fields['company_client_id']);

      	$this->company_client_id->SelectedValue = $this->sqlInvoice_issued->Fields['company_client_id'];
      	$this->tax_ident->Text  = $this->sqlInvoice_issued->Fields['tax_ident'];
      	$this->client_name->Text = $this->sqlInvoice_issued->Fields['client_name'];
      	$this->address->Text = $record['address'];

      	$this->invoice_number->Text = $this->sqlInvoice_issued->Fields['invoice_number'];
      	$this->invoice_dt->Date  = $this->sqlInvoice_issued->Fields['invoice_dt'];
      	$this->payment_method_id->SelectedValue = $this->sqlInvoice_issued->Fields['payment_method_id'];
      	$this->tax_type_key_id->SelectedValue = $this->sqlInvoice_issued->Fields['tax_type_key_id'];
        $this->notes->Text = $this->sqlInvoice_issued->Fields['notes'];

        //Line Item
      	$sql = "SELECT line_item.*, service_category.supplement_yn,
        							 vw_tax_rate_country.tax_description
        				FROM line_item
                 		 LEFT JOIN service ON line_item.service_id = service.service_id
                     LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id
                     LEFT JOIN vw_tax_rate_country ON line_item.tax_rate_id = vw_tax_rate_country.tax_rate_id
              	WHERE invoice_issued_id = {$this->invoice_issued_id->Value}";
      	$this->sqlLine_item->close();
      	$this->sqlLine_item->SQL = $sql;
      	$this->sqlLine_item->open();

      	$line_item = array();
      	$line_supplement = array();
      	While (!$this->sqlLine_item->EOF){
      		$record = array();
          if (!$this->sqlLine_item->Fields['supplement_yn']){
        		$record['description'] = $this->sqlLine_item->Fields['description'];
        		$record['quantity_no'] = $this->sqlLine_item->Fields['quantity_no'];
        		$record['price_amt'] = $this->sqlLine_item->Fields['price_amt'];
        		$record['total_amt'] = $this->sqlLine_item->Fields['total_amt'];
        		$record['tax_rate_id'] = $this->sqlLine_item->Fields['tax_rate_id'];
        		$record['tax_description'] = $this->sqlLine_item->Fields['tax_description'];
        		$record['rate_no'] = $this->sqlLine_item->Fields['rate_no'];
        		$record['notes'] = $this->sqlLine_item->Fields['notes'];
        		$record['sort_no'] = $this->sqlLine_item->Fields['sort_no'];
        		$record['service_id'] = $this->sqlLine_item->Fields['service_id'];
        		$record['line_item_id'] = $this->sqlLine_item->Fields['line_item_id'];

        		array_push($line_item, $record);
          }else {
        		$record['description'] = $this->sqlLine_item->Fields['description'];
        		$record['quantity_no'] = $this->sqlLine_item->Fields['quantity_no'];
        		$record['price_amt'] = $this->sqlLine_item->Fields['price_amt'];
        		$record['total_amt'] = $this->sqlLine_item->Fields['total_amt'];
        		$record['service_id'] = $this->sqlLine_item->Fields['service_id'];
        		$record['tax_rate_id'] = $this->sqlLine_item->Fields['tax_rate_id'];
        		$record['rate_no'] = $this->sqlLine_item->Fields['rate_no'];
        		$record['line_item_id'] = $this->sqlLine_item->Fields['line_item_id'];
        		array_push($line_supplement, $record);
          }
        	$this->sqlLine_item->next();
      	}
        $this->gridLine_item->CellData = $line_item;
        $this->gridSupplement->CellData = $line_supplement;

        // Invoice Tax
      	$sql = "SELECT * FROM invoice_issued_tax
              	WHERE invoice_issued_id = {$this->invoice_issued_id->Value}";
      	$this->sqlInvoice_issued_tax->close();
      	$this->sqlInvoice_issued_tax->SQL = $sql;
      	$this->sqlInvoice_issued_tax->open();

      	$record = array();
      	$invoice_tax = array();
      	While (!$this->sqlInvoice_issued_tax->EOF){
        	$record['base_amt'] = $this->sqlInvoice_issued_tax->Fields['base_amt'];
        	$record['rate_no'] = $this->sqlInvoice_issued_tax->Fields['rate_no'];
        	$record['tax_amt'] = $this->sqlInvoice_issued_tax->Fields['tax_amt'];
        	$record['tax_rate_id'] = $this->sqlInvoice_issued_tax->Fields['tax_rate_id'];
        	$record['invoice_issued_tax_id'] = $this->sqlInvoice_issued_tax->Fields['invoice_issued_tax_id'];

        	array_push($invoice_tax, $record);
        	$this->sqlInvoice_issued_tax->next();
      	}
        $this->gridInvoice_issued_tax->CellData = $invoice_tax;

				$this->TotalInvoice($this, array(0));
      }
      Define('COL_SERVICE_LINE', $this->gridLine_item->findColumnByName('service_id'));
      Define('COL_TAX_RATE', $this->gridLine_item->findColumnByName('tax_rate_id'));
      Define('COL_SERVICE_SUPPLEMENT', $this->gridSupplement->findColumnByName('service_id'));
    }

    function ActivateObjetc()
    {
    	$enabled = (!$this->sqlInvoice_issued->Fields['accounted_yn']) || !$this->sqlInvoice_issued->Fields['invoice_issued_id'];
      $this->company_client_id->Enabled = $enabled;
      $this->client_name->Enabled = $enabled;
      $this->tax_ident->Enabled = $enabled;
      $this->invoice_number->Enabled = $enabled;
      $this->invoice_dt->Enabled = $enabled;
      $this->payment_method_id->Enabled = $enabled;
      $this->tax_type_key_id->Enabled = $enabled;
      $this->gridLine_item->ReadOnly = !$enabled;
      $this->gridSupplement->ReadOnly = !$enabled;
      $this->notes->Enabled = $enabled;
      $this->btnSave->Enabled = $enabled;
    }

    function ChangeLanguage()
    {
      // Client and Invoice
  		$this->lbClient->Caption = SW_CAPTION_CLIENT;
  		$this->lbClient_name->Caption = SW_CAPTION_CLIENT_NAME;
  		$this->lbTax_ident->Caption = SW_CAPTION_TAX_IDENT;
  		$this->lbAddress->Caption = SW_CAPTION_ADDRESS;
  		$this->lbInvoice_number->Caption = SW_CAPTION_INVOICE_NUMBER;
      $this->lbInvoice_dt->Caption = SW_CAPTION_INVOICE_DT;
      $this->lbPayment_method->Caption = SW_CAPTION_PAYMENT_METHOD;
      $this->lbTax_type->Caption = SW_CAPTION_TAX_TYPE;
      $this->lbNotes->Caption = SW_CAPTION_NOTES;
      $this->lbTotal_amt->Caption = SW_CAPTION_TOTAL;
      $this->lbPaid->Caption = SW_CAPTION_PROVISION_FONDO_AMT;
      $this->lbPay->Caption = SW_CAPTION_PAY_AMT;

			//Buttons
      $this->btnSave->Caption = btnSave;
      $this->btnClose->Caption = btnClose;
    }

    //Creted Grid Line_item
    function CreateGridLineItem()
    {
      $property = array(TYPE_COLUMN => 'JTPlatinumGridCustomColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => "",
                        WIDTH => 1);
      $columns[] = sw_create_grid_column('selected_service_id', $this->gridLine_item, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridLine_item);
      $columns[] = sw_create_grid_column('quantity_no', $this->gridLine_item);
      $columns[] = sw_create_grid_column('price_amt', $this->gridLine_item);
      $columns[] = sw_create_grid_column('total_amt', $this->gridLine_item);

 	    $lookupComboBox = array(DATASOURCE => $this->dsTax_rate, VALUE_FIELD=>'tax_rate_id', TEXT_FIELD=>'tax_description');
			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      									CAN_MOVE => False,
                        CAPTION => SW_CAPTION_TAX_RATE, WIDTH => 100,
      									TEXT_FIELD => 'tax_description',
                        DEFAULT_FILTER => 'Contains',
												EDITOR_TYPE => 'LookupComboBox', LOOKUP_COMBOBOX => $lookupComboBox);
      $columns[] = sw_create_grid_column('tax_rate_id', $this->gridLine_item, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								  CAPTION => '', VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('tax_description', $this->gridLine_item, $property);

      $property = array(VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('rate_no', $this->gridLine_item, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								  CAPTION => SW_CAPTION_NOTES, MAX_LENGTH => 255,
                        VISIBLE => FALSE, WIDTH => 250);
      $columns[] = sw_create_grid_column('notes', $this->gridLine_item, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => SW_CAPTION_SUPPLEMENT_YN, DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 90 );
      $columns[] = sw_create_grid_column('with_supplement_yn', $this->gridLine_item, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agRight',
      								  CAPTION => SW_CAPTION_SORT_NO, MAX_LENGTH => 4, WIDTH => 40);
      $columns[] = sw_create_grid_column('sort_no', $this->gridLine_item, $property);
      $columns[] = sw_create_grid_column('service_id', $this->gridLine_item);
      $columns[] = sw_create_grid_column('line_item_id', $this->gridLine_item, $property);

    	$this->gridLine_item->Columns = $columns;
      $this->gridLine_item->SortBy = 'sort_no';
    }

    //Creted Grid Tax
    function CreateGridTax()
    {
      $columns[] = sw_create_grid_column('base_amt', $this->gridInvoice_issued_tax);
      $columns[] = sw_create_grid_column('rate_no', $this->gridInvoice_issued_tax);
      $columns[] = sw_create_grid_column('tax_amt', $this->gridInvoice_issued_tax);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agRight',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '',
                        VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('tax_rate_id', $this->gridInvoice_issued_tax, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '',
                        VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('invoice_issued_tax_id', $this->gridInvoice_issued_tax, $property);

    	$this->gridInvoice_issued_tax->Columns = $columns;
      $this->gridInvoice_issued_tax->SortBy = 'rate_no';
    }

    //Creted Grid Supplement
    function CreateGridSupplement()
    {
      $property = array(TYPE_COLUMN => 'JTPlatinumGridCustomColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => "",
                        WIDTH => 1);
      $columns[] = sw_create_grid_column('selected_service_id', $this->gridSupplement, $property);

    	$property = array(CAPTION => SW_CAPTION_SUPPLEMENT);
      $columns[] = sw_create_grid_column('description_service', $this->gridSupplement, $property);
      $columns[] = sw_create_grid_column('quantity_no', $this->gridSupplement, array(VISIBLE => False));
      $columns[] = sw_create_grid_column('price_amt', $this->gridSupplement);
      $columns[] = sw_create_grid_column('total_amt', $this->gridSupplement, array(VISIBLE => False));

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', VISIBLE => False);
      $columns[] = sw_create_grid_column('sort_no', $this->gridSupplement, $property);
      $columns[] = sw_create_grid_column('service_id', $this->gridSupplement);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      									CAN_MOVE => False,
												VISIBLE => False);
      $columns[] = sw_create_grid_column('tax_rate_id', $this->gridSupplement, $property);

      $property = array(VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('rate_no', $this->gridSupplement, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '',
                        VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('line_item_id', $this->gridSupplement, $property);

    	$this->gridSupplement->Columns = $columns;
      $this->gridSupplement->SortBy = 'line_item_id';
    }

    function gridLine_itemShow($sender, $params)
    {
    	if ((!$this->sqlInvoice_issued->Fields['accounted_yn']) || !$this->sqlInvoice_issued->Fields['invoice_issued_id'])
      {
				$sender->CommandBar->CustomCommands = array(
    			new JTPlatinumGridCommandBarItem( null, btnAdd, "add" ),
    			new JTPlatinumGridCommandBarItem( null, btnDelete, "delete" ),
    			new JTPlatinumGridCommandBarItem( null, btnEdit, "edit" ),
    			new JTPlatinumGridCommandBarItem( null, btnSave, "save" ),
    			new JTPlatinumGridCommandBarItem( null, btnCancel, "cancel" )
				);
      	if ($sender->name == 'gridLine_item'){
      		$sender->CommandBar->addCustomCommand( 'supplement', btnDiscountingSupplement );
      	}
			}
    }


    function gridLine_itemJSCustomCommand($sender, $params)
    {
        ?>
        //begin js
        var lreturn = false;
        if (command == 'filter') {
          params = [0];
        	<?php echo $sender->ajaxCall('filter_grid', array(), array($sender->name)); ?>
          return false;
        }
        if (command == 'add') {
          sender.Insert();
          return false;
        }
        if ((command == 'edit') || (command == 'delete')){
        	for (var row in sender.SelectedCells) {
          	if (typeof(sender.SelectedCells[row]) != "function" &&
            		(sender.SelectedCells[row] != '') &&
                (sender.SelectedCells[row] != null))
            {
            	if (command == 'edit'){ sender.Edit(row); break;}
              if (command == 'delete'){ sender.Delete(row); }
            }
          }
        }
        if (command == 'save') { sender.Post(); }
        if (command == 'cancel') { sender.Cancel(); return false; }
        if (command == 'supplement') {
          for (var row in sender.SelectedCells) {
          	if (typeof(sender.SelectedCells[row]) != "function" &&
              	 (sender.SelectedCells[row] != '') &&
                 (sender.SelectedCells[row] != null)) {
							lreturn = true;
            }
          }
        }

        params = [0];
        <?php
        	$components = array('gridInvoice_issued_tax', 'total_amt', 'paid_amt', 'pay_amt');
        	echo $this->gridLine_item->ajaxCall("TotalInvoice", array(), $components);
        ?>

        return lreturn;
        //end
        <?php
    }

    function gridLine_itemCustomCommand($sender, $params)
    {
    	$command = $params[0];

      if ($command == 'supplement'){
      	$supplement_amt = $this->supplement_amt->Value;
        $record_line = $this->gridLine_item->CellData;
        foreach ($record_line as $key => $line_item)
        {
          if (array_search($line_item['line_item_id'], $this->gridLine_item->SelectedPrimaryKeys) !== False){
        	  $remainder = ($supplement_amt / $line_item['quantity_no']);
            $supplement_amt -= $line_item['total_amt'];

            $price_amt = $line_item['price_amt'] < $remainder ? 0 : $line_item['price_amt'] - $remainder;
            $line_item['price_amt'] = $price_amt;
      		  $line_item['total_amt'] = sw_convert_comma_point(round($line_item['quantity_no'] * $line_item['price_amt'], 2));
					  $record_line[$key] = $line_item;
          }
          if (($supplement_amt -= $total_amt) <= 0) break;
        }
        $this->gridLine_item->CellData = $record_line;
        $this->TotalInvoice($sender, $params);
      }
    }

    function company_client_idJSChange($sender, $params)
    {
    	$components = array("client_name", "tax_ident", "address", "payment_method_id", "tax_type_key_id");
      echo $this->company_client_id->ajaxCall("GetClientData", array(), $components);
        ?>
        //begin js
        return false;
        //end
        <?php
    }

    function GetClientData()
    {
      $client_id = $this->company_client_id->SelectedValue ? $this->company_client_id->SelectedValue : 0;

      $record = sw_get_client_data($client_id);

      $this->tax_ident->Text = $record['tax_ident'];
      $this->client_name->Text = $record['client_name'];
      $this->address->Text = $record['address'];
      $this->payment_method_id->SelectedValue = $record['payment_method_id'];
      $this->tax_type_key_id->SelectedValue = $record['tax_type_key_id'];
			$this->ChangeTaxTypeKey();
    }

    function tax_identJSChange($sender, $params)
    {
    	$component = array("tax_ident", "company_client_id");
    	echo $this->tax_ident->ajaxCall("ChangeTaxIdent", array(), $component);
        ?>
        //begin js
        return false;
        //end
        <?php
    }


    function ChangeTaxIdent()
    {
    	$this->tax_ident->Text = sw_clean_caracter_tax_ident($this->tax_ident->Text);

    	$record_client = sw_valid_client_tax_ident($this->tax_ident->Text);
      if ($record_client['tax_ident']){
      	$this->company_client_id->SelectedValue = $record_client['company_client_id'];
      	$this->tax_ident->Text = $record_client['tax_ident'];
      }
    }

    function gridLine_itemJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        $(document).ready(function($) {
          if (document.getElementById("gridLine_item_service_id_Editor")){
          	var cellValue = gridLine_item.getCellText(rowIndex, <?php echo COL_SERVICE_LINE; ?>);
            $('#gridLine_item_selected_service_id_Editor').val(cellValue);
          }

        	$('#gridLine_item_selected_service_id_Editor').change(function() {
          	var service_description = $('#gridLine_item_selected_service_id_Editor option:selected').text();
            var service = service_description.split('|');
          	var service_id = $('#gridLine_item_selected_service_id_Editor option:selected').val();

            var description = $('#gridLine_item_description_service_Editor').val();
            var quantity_no = $('#gridLine_item_quantity_no_Editor').val();
            var price_amt = parseFloat($('#gridLine_item_price_amt_Editor').val());

            $('#gridLine_item_description_service_Editor').val($.trim(service[0]));
            $('#gridLine_item_quantity_no_Editor').val(1);
            $('#gridLine_item_price_amt_Editor').val($.trim(service[1]));

            $('#gridLine_item_service_id_Editor').val(service_id);
            return false;
          });
        });
        //end
        <?php
    }


    function gridLine_itemCustomEditorGenerate($sender, $params)
    {
    	list( $grid, $column ) = $params;

      // This is the special name that editor fields must use.
      $name = $grid->Name . '_' . $column->Name . '_Editor';
      $select = $sender->name == 'gridLine_item' ? 'OnlyService' : 'Supplement';

      // Render an HTML text box.
      return sw_created_combobox_service($name, $select);
    }


    function btnCloseClick($sender, $params)
    {
    	$this->Close();
    }


		function Close()
    {
    	redirect_url('invoice_issued.php');
    }


    function gridLine_itemInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1){
        $fields = &$params[ 0 ];
        //search max index
        $line_item_id = 0;
        foreach($sender->CellData as $record_line){
          if ($record_line['line_item_id'] > $line_item_id){
            $line_item_id = $record_line['line_item_id'];
          }
        }
      }
      else { //update
      	$fields = &$params[ 1 ];
        $fields[ 'line_item_id' ] = $params[ 0 ];

        $line_item_id = 0;
        foreach($sender->CellData as $key => $record_line){
        	if ($record_line['line_item_id'] == $fields[ 'line_item_id' ]){
        		$line_item_id = $key;
          	break;
        	}
        }
      }

			$fields['description'] = sw_replace_date_macro($fields['description'], $this->invoice_dt->Date);
			$fields['quantity_no'] = $sender->name !== 'gridLine_item' ? '1' : $fields['quantity_no'];
      $fields['quantity_no'] = sw_convert_comma_point($fields['quantity_no']);
      $fields['price_amt'] = sw_convert_comma_point($fields['price_amt']);
      $fields['total_amt'] = sw_convert_comma_point(round($fields['quantity_no'] * $fields['price_amt'], 2));

      //Asigno el tipo de impuesto
      $fields['rate_no'] = 0;
      if ($sender->name == "gridSupplement"){
        $where = "tax_regime_id = {$_SESSION['tax_regime_id']} AND rate_no = 0";
        $record = sw_get_data_table('vw_tax_rate_country', $where);
      }
      else {
        $where = "tax_rate_id = '{$fields['tax_rate_id']}'";
        if (!$record = sw_get_data_table('vw_tax_rate_country', $where)){
          $record = sw_get_tax_rate_default($this->tax_type_key_id->SelectedValue);
        }
      }
      foreach ($record as $key => $value){
        if (isset($fields[$key])){
          $fields[$key] = $value;
        }
      }

      $where = "service_id = {$fields['service_id']}";
      if ($record = sw_get_data_table('service', $where)) {
        $record_line = $sender->CellData;
        if (!$fields[ 'line_item_id' ]){
        	$fields['sort_no'] 						= $record['sort_no'];
        	$fields['with_supplement_yn'] = $record['with_supplement_yn'];
          $fields['line_item_id'] 			= ++$line_item_id;

          array_push($record_line, $fields);
        }else
        {
          $record_line[$line_item_id] = $fields;
        }

        $sender->CellData = $record_line;
      } else return false;

			$this->TotalInvoice($sender, $params);
    }


    function gridLine_itemDelete($sender, $params)
    {
      $fields = &$params[ 0 ];

      $record_line = $sender->CellData;
      foreach( $sender->CellData as $key => $record) {
        if ($record['line_item_id'] == $fields[0]){
        	array_splice($record_line, $key, 1);
        }
      }
      $sender->CellData = $record_line;
			$this->TotalInvoice($sender, $params);
    }


    function TotalInvoice($sender, $params)
    {
    	//calculate Line_item
      $this->gridInvoice_issued_tax->CellData = array();
      $invoice_tax = array();
      $account_tax_id = 0;
      foreach ($this->gridLine_item->CellData as $row)
      {
        if ($invoice_tax[$row['tax_rate_id']]){
        	$invoice_tax[$row['tax_rate_id']]['base_amt'] += $row['total_amt'];
        }
        else {
        	$invoice_tax[$row['tax_rate_id']]['base_amt'] = $row['total_amt'];
          $invoice_tax[$row['tax_rate_id']]['rate_no']  = $row['rate_no'];
          $invoice_tax[$row['tax_rate_id']]['tax_amt'] 	= 0;
          $invoice_tax[$row['tax_rate_id']]['tax_rate_id'] = $row['tax_rate_id'];
          $invoice_tax[$row['tax_rate_id']]['invoice_issued_tax_id'] = ++$account_tax_id;
        }
        $invoice_tax[$row['tax_rate_id']]['tax_amt'] = round($invoice_tax[$row['tax_rate_id']]['base_amt'] * ($row['rate_no']/100), 2);
      }

      $this->gridInvoice_issued_tax->CellData = $invoice_tax;
      $this->subtotal_amt->Value = 0;
      $this->tax_amt->Value = 0;
      foreach ($invoice_tax as $row)
      {
      	$this->subtotal_amt->Value += $row['base_amt'];
      	$this->tax_amt->Value  += $row['tax_amt'];;
      }

    	//calculate supplement
      $this->supplement_amt->Value = 0;
      foreach ($this->gridSupplement->CellData as $row)
      {
      	$this->supplement_amt->Value += $row['total_amt'];
      }

      $this->subtotal_amt->Value = sw_convert_comma_point($this->subtotal_amt->Value);
      $this->tax_amt->Value = sw_convert_comma_point($this->tax_amt->Value);
      $this->supplement_amt->Value = sw_convert_comma_point($this->supplement_amt->Value);

      $total_amt = $this->subtotal_amt->Value + $this->tax_amt->Value + $this->supplement_amt->Value;
      $pay_amt   = $total_amt - $this->paid_amt->Text;
      $this->total_amt->Text = sw_convert_comma_point($total_amt);
      $this->pay_amt->Text   = sw_convert_comma_point($pay_amt);
    }


    function gridLine_itemJSRowEdited($sender, $params)
    {
      Global $lbRequiredFieldError, $lbInvoiceDateInvalid;
        ?>
        //begin js
        var msgError = '';

        var serviceID = sender.getEditorValue("service_id");
        var description = sender.getEditorValue("description_service");
        var quantity_no = sender.getEditorValue("quantity_no");
        var price_amt = sender.getEditorValue("price_amt");

        if (serviceID === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_SERVICE; ?>" + '</br>';
        }

        if (description === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_DESCRIPTION; ?>" + '</br>';
        }

        if (quantity_no === '' && sender.id == "gridLine_item") {
        	msgError = msgError + "<?php echo SW_CAPTION_QUANTITY; ?>" + '</br>';
        }

        if (price_amt === '') {
        	msgError = msgError + "<?php echo SW_CAPTION_PRICE; ?>" + '</br>';
        }

        if (msgError != ''){
        	msgError = "<?php echo $lbRequiredFieldError; ?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
        }
        return (msgError == '');
        //end
        <?php
    }


    function gridSupplementJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        $(document).ready(function($) {
          if (document.getElementById("gridSupplement_service_id_Editor")){
          	var cellValue = gridSupplement.getCellText(rowIndex, <?php echo COL_SERVICE_SUPPLEMENT; ?>);
            $('#gridSupplement_selected_service_id_Editor').val(cellValue);
          }

        	$('#gridSupplement_selected_service_id_Editor').change(function() {
          	var service_description = $('#gridSupplement_selected_service_id_Editor option:selected').text();
            var service = service_description.split('|');
          	var service_id = $('#gridSupplement_selected_service_id_Editor option:selected').val();
            $('#gridSupplement_description_service_Editor').val($.trim(service[0]));
            $('#gridSupplement_quantity_no_Editor').val(1);
            $('#gridSupplement_price_amt_Editor').val($.trim(service[1]));
            $('#gridSupplement_service_id_Editor').val(service_id);
            return false;
          });
        });
        //end
        <?php
    }


    function tax_type_key_idJSChange($sender, $params)
    {
    	echo $this->tax_type_key_id->ajaxCall("ChangeTaxTypeKey");
        ?>
        //begin js
        return false;
        //end
        <?php
    }

    function ChangeTaxTypeKey()
    {
    	$tax_type_key_id = $this->tax_type_key_id->SelectedValue;
    	$record = sw_get_tax_rate_default($tax_type_key_id);

			$record_line = array();
      foreach ($this->gridLine_item->CellData as $key => $row)
      {
      	$row['tax_rate_id'] = $record['tax_rate_id'];
      	$row['rate_no'] = $record['rate_no'];
        $row['tax_description'] = $record['tax_description'];
        $record_line[$key] = $row;
      }
      $this->gridLine_item->CellData = $record_line;

      $this->TotalInvoice($this, array(0));
    }


    function btnSaveJSClick($sender, $params)
    {
    	Global $lbCreateClientMsg;
        ?>
        //begin js
        var TaxIdent = $('#tax_ident').val();
        var ClientName = $('#client_name').val();
        var ClientId = $('#company_client_id').val();

        if (TaxIdent !== '' && ClientName !== '' && ClientId === ''){
        	 return confirm("<?php echo $lbCreateClientMsg; ?>");
        }
        return true;
        //end
        <?php
    }


    function btnSaveClick($sender, $params)
    {
      $this->TotalInvoice($this, array(0));

      if (!$this->WithSupplied()){
      	$this->msgError->Value = "No han sido asignados los suplidos en la factura";
        return false;
      }

    	//Created Client
    	if (!$this->company_client_id->SelectedValue){
      	$client['company_id'] = $_SESSION['company_id'];
      	$client['country_id'] = sw_country_tax_ident($this->tax_ident->Text);
        $client['tax_type_key_id'] = $this->tax_type_key_id->SelectedValue;
        $client['created_by_user_id'] = $_SESSION['user_id'];
        $client['payment_method_id'] = $this->payment_method_id->SelectedValue;
        $client['tax_ident'] 	= $this->tax_ident->Text;
        $client['client_name'] = $this->client_name->Text;
        $client['created_dt'] = date('Y-m-d H:i:s');

        sw_insert_table("company_client", $client);
        $company_client_id = mysql_insert_id();
        $this->sqlCompany_client->refresh();
        $this->company_client_id->SelectedValue = $company_client_id;
      }

  		$invoice['company_id'] = $_SESSION['company_id'];
  		$invoice['invoice_issued_id'] = $this->invoice_issued_id->Value;
  		$invoice['invoice_number'] = strtoupper(trim($this->invoice_number->Text));
  		$invoice['company_client_id'] = $this->company_client_id->SelectedValue;

      //Get Last invoice number
      $abono = floatval($this->total_amt->Text) < 0 ? True : False;
  		$invoice['invoice_dt'] = $this->invoice_dt->Date ? $this->invoice_dt->Date : date('Y-m-d');
      $invoice['invoice_number'] = !$invoice['invoice_number'] ? sw_last_invoice_issued($invoice['company_id'], $abono) : $invoice['invoice_number'];

      if (!$msg = sw_valid_invoice_issued($invoice)){
  			$invoice['payment_method_id'] = $this->payment_method_id->SelectedValue;
  			$invoice['tax_type_key_id'] = $this->tax_type_key_id->SelectedValue;
				$invoice['tax_ident'] = $this->tax_ident->text;
      	$invoice['client_name']    = $this->client_name->text;
  			$invoice['subtotal_amt'] = $this->subtotal_amt->Value;
  			$invoice['tax_amt'] = $this->tax_amt->Value;
  			$invoice['other_income_amt'] = $this->supplement_amt->Value;
  			$invoice['total_amt'] = $this->total_amt->Text;
  			$invoice['notes'] = $this->notes->Text;
  			$invoice['status_cd'] = SW_STATUS_IS_OPEN;
      	$invoice['document_ident']     = $invoice['invoice_number'];
      	$invoice['registered_in_acctg_software_dt'] = $this->invoice_dt->Date;
        $invoice['created_by_user_id'] = $_SESSION['user_id'];
        $invoice['created_dt'] 			   = date('Y-m-d H:i:s');

				sw_assign_registered_accountant($invoice);

      	if (!$this->invoice_issued_id->Value){
      		$invoice['company_id']       	= $_SESSION['company_id'];

					sw_insert_table("invoice_issued", $invoice);

        	$this->invoice_issued_id->value = mysql_insert_id();
          $this->invoice_dt->Date = $invoice['invoice_dt'];
      		$this->invoice_number->Text = $invoice['invoice_number'];
				}else {
      		$where = "invoice_issued_id = {$this->invoice_issued_id->Value}";
      		sw_update_table('invoice_issued', $invoice, $where);
				}

      	$this->UpdateLineItemInvoice();
      	$this->UpdateInvoiceTax();
        sw_create_PDF_invoice($this->invoice_issued_id->Value, True);
        $this->Close();
      }

      $this->msgError->Value = $msg;
    }

    //Supplied Checked
		function WithSupplied()
    {
    	$return = true;
      foreach ($this->gridLine_item->CellData as $record){
      	if ($record['with_supplement_yn'] && count($this->gridSupplement->CellData) == 0){
        	$return = false;
          break;
        }
      }

      return $return;
    }


    //Update Line item
		function UpdateLineItemInvoice()
    {
			if (sw_company_is_strong() && ($record = sw_get_data_table("company_join_client", "company_client_id = {$this->company_client_id->SelectedValue}"))){
      	$company_id = $record['company_id'];
      }

			$line_data = array_merge($this->gridLine_item->CellData, $this->gridSupplement->CellData);

    	$sql = "SELECT line_item.line_item_id, line_item.invoice_issued_id
      				FROM line_item
              WHERE invoice_issued_id = {$this->invoice_issued_id->Value} ";
			$key_exist = sw_records_array($sql, array("line_item_id", "invoice_issued_id"));
    	foreach ($line_data as $line_item)
      {
      	$record_service = sw_get_data_table("service", "service_id = {$line_item['service_id']}");
				if ($company_id) $line_item['company_id'] = $company_id;
  			$line_item['future_invoice_dt'] = $this->invoice_dt->Date;
      	$line_item['commission_amt']     		= $line_item['total_amt'];
      	$line_item['future_commission_amt'] = $line_item['total_amt'];

      	if (!array_key_exists($line_item['line_item_id'], $key_exist)){
        	unset($line_item['line_item_id']);
  				$line_item['invoice_issued_id'] = $this->invoice_issued_id->Value;

        	$line_item['created_by_user_id'] = $_SESSION['user_id'];
        	$line_item['created_dt'] 			   = date('Y-m-d H:i:s');
        	$line_item['status_cd'] 			   = SW_STATUS_LI_INVOICED;
  				$line_item['service_type_id'] 	 = $record_service['service_type_id'];

					sw_insert_table("line_item", $line_item);
				}else {
          unset($key_exist[$line_item['line_item_id']]);

      		$where = "line_item_id = {$line_item['line_item_id']}";
      		sw_update_table('line_item', $line_item, $where);
				}
      }

      if ($key_exist = implode(",", array_keys($key_exist))){
      	sw_delete_table("line_item", "line_item_id in ({$key_exist})");
      }
    }

    //Update Invoice tax
		function UpdateInvoiceTax()
    {
    	$sql = "SELECT tax_rate_id, invoice_issued_id
      				FROM invoice_issued_tax
              WHERE invoice_issued_id = {$this->invoice_issued_id->Value} ";
			$key_exist = sw_records_array($sql, array("tax_rate_id", "invoice_issued_id"));
    	foreach ($this->gridInvoice_issued_tax->CellData as $invoice_tax)
      {
	    	unset($invoice_tax['invoice_issued_tax_id']);
      	if (!array_key_exists($invoice_tax['tax_rate_id'], $key_exist)){
  				$invoice_tax['invoice_issued_id'] = $this->invoice_issued_id->Value;

					sw_insert_table("invoice_issued_tax", $invoice_tax);
				}else {
          unset($key_exist[$invoice_tax['tax_rate_id']]);

      		$where = "invoice_issued_id = {$this->invoice_issued_id->Value} AND tax_rate_id = {$invoice_tax['tax_rate_id']}";
      		sw_update_table('invoice_issued_tax', $invoice_tax, $where);
				}
      }

      if ($key_exist = implode(",", array_keys($key_exist))){
      	$where = "invoice_issued_id = {$this->invoice_issued_id->Value} AND tax_rate_id in ({$key_exist})";
      	sw_delete_table("invoice_issued_tax", $where);
      }
    }


    function gridLine_itemSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption] = $Total;
    }


}

global $application;

global $invoice_issued_edit;

//Creates the form
$invoice_issued_edit=new invoice_issued_edit($application);

//Read from resource file
$invoice_issued_edit->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$invoice_issued_edit->show();

?>