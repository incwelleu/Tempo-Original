<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("checklst.inc.php");


//Class definition
class add_service_agreement extends fmstrong
{
    public $cbBilling_entity = null;
    public $lbBilling_entity = null;
    public $contact_id = null;
    public $company_id = null;
    public $sqlContact = null;
    public $dsContact = null;
    public $gridContact = null;
    public $imSelect_contact = null;
    public $lbProposal = null;
    public $sqlService = null;
    public $dsService = null;
    public $service_agreement_id = null;
    public $sqlLine_item = null;
    public $dsLine_item = null;
    public $lbFirst_name = null;
    public $first_name = null;
    public $last_name = null;
    public $lbLast_name = null;
    public $lbEmail = null;
    public $email = null;
    public $notes_service_agreement = null;
    public $lbNotes = null;
    public $lbServices = null;
    public $btnSave = null;
    public $btnClose = null;
    public $SiteTheme = null;
    public $lbTitle = null;
    public $winSelect_contact = null;
    public $window_hide = null;
    public $short_name = null;
    public $lbCompany = null;
    public $cbLanguage = null;
    public $gridLine_item = null;
    public $proposal_id = null;

    function add_service_agreementCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->Details_service_agreement();
    }

    function Details_service_agreement()
    {
      $service_agreement = isset($_REQUEST['ID']) && ($this->service_agreement_id->Value != $_REQUEST['ID']) ;
      if ($service_agreement) $this->service_agreement_id->Value = $_REQUEST['ID'];
      $primaryKey = $this->service_agreement_id->Value;

      $record = sw_get_data_table("service_agreement", "service_agreement_id = {$primaryKey}");

      $enabled_yn = (!isset($record['status_cd']) || $record['status_cd'] == SW_STATUS_SVC_NEW);
      $this->first_name->Enabled = $enabled_yn;
      $this->last_name->Enabled = $enabled_yn;
      $this->email->Enabled = $enabled_yn;
      $this->notes_service_agreement->Enabled = $enabled_yn;
      $this->notes_service_agreement->ReadOnly = !$enabled_yn;
      $this->gridLine_item->ReadOnly = !$enabled_yn;
      $this->gridLine_item->ShowEditColumn = $enabled_yn;
      $this->short_name->Enabled = $enabled_yn;
      $this->imSelect_contact->Enabled = $enabled_yn;
			$this->cbBilling_entity->Items = sw_records_array("Select * from billing_entity", array("billing_entity_id", "billing_entity_name"));
			$this->cbBilling_entity->ItemIndex = $record['billing_entity_id'] ? $record['billing_entity_id'] : 1;

      if ($enabled_yn){
        $this->gridLine_item->CommandBar->CustomCommands = array(
          new JTPlatinumGridCommandBarItem( null, btnAdd, "add" ));
      }
      $this->btnSave->Enabled = $enabled_yn;

      //Grid Select
      if( !$this->gridContact->inSession( '' ) )
      {
        $this->CreateGridLineItem();
        $this->CreateGridContact();
      }

      if ($service_agreement){
    		Global $languages;

      	$languages_cd = $languages;
      	$languages_cd['zh'] = 'chinese';

      	$this->cbLanguage->Items = $languages_cd;
        $this->cbLanguage->ItemIndex = 'en';
        $this->SelectProposal($record);

      	$sql = "SELECT line_item.*, service.description_en
              	FROM line_item
                    	INNER JOIN service ON line_item.service_id = service.service_id
                    	INNER JOIN service_category ON service.service_category_id = service_category.service_category_id
              	WHERE line_item.service_agreement_id = ?";
      	$this->sqlLine_item->close();
      	$this->sqlLine_item->SQL = $sql;
      	$this->sqlLine_item->Params = array($primaryKey);
      	$this->sqlLine_item->open();

      	$record_service = array();
      	$line_item = array();
      	While (!$this->sqlLine_item->EOF){
        	$record_service['description'] = $this->sqlLine_item->Fields['description'];
        	$record_service['service_id'] = $this->sqlLine_item->Fields['service_id'];
        	$record_service['quantity_no'] = $this->sqlLine_item->Fields['quantity_no'];
        	$record_service['price_amt'] = $this->sqlLine_item->Fields['price_amt'];
        	$record_service['total_amt'] = $this->sqlLine_item->Fields['total_amt'];
        	$record_service['line_item_id'] = $this->sqlLine_item->Fields['line_item_id'];

        	array_push($line_item, $record_service);
        	$this->sqlLine_item->next();
      	}

  			foreach( $this->gridContact->Columns as $Columna )
  			{
    			$Columna->Filter = "";
  			}

      	$record_company = sw_get_data_table("company", "company_id = {$record['company_id']}", "short_name");
        $this->short_name->Text =  sw_checked_file_valid_name($record_company['short_name']);
        $this->company_id->value = $record['company_id'];
        $this->contact_id->value = $record['contact_id'];

        $this->first_name->Text = ucwords(trim($record['first_name']));
        $this->last_name->Text = ucwords(trim($record['last_name']));
        $this->email->Text = $record['email'];
        $this->notes_service_agreement->Text = $record['notes_service_agreement'];
        $this->gridLine_item->CellData = $line_item;
      }

      Define('COL_SERVICE', $this->gridLine_item->findColumnByName('service_id'));
    }

		function CreateGridLineItem()
    {
      $property = array(TYPE_COLUMN => 'JTPlatinumGridCustomColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '',
                        WIDTH => 1);
      $columns[] = sw_create_grid_column('selected_service_id', $this->gridLine_item, $property);

      $columns[] = sw_create_grid_column('description_service', $this->gridLine_item);
      $columns[] = sw_create_grid_column('quantity_no', $this->gridLine_item);
      $columns[] = sw_create_grid_column('price_amt', $this->gridLine_item);
      $columns[] = sw_create_grid_column('total_amt', $this->gridLine_item);
      $columns[] = sw_create_grid_column('service_id', $this->gridLine_item);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agLeft',
      									CAN_FILTER => False, CAN_SELECT => False,
      								  CAN_SORT => False, CAPTION => '',
                        VISIBLE => FALSE);
      $columns[] = sw_create_grid_column('line_item_id', $this->gridLine_item, $property);

    	$this->gridLine_item->Columns = $columns;

      $this->gridLine_item->init();
    }

		function CreateGridContact()
    {
      $columns[] = sw_create_grid_column('short_name', $this->gridContact);
      $columns[] = sw_create_grid_column('first_name', $this->gridContact);
      $columns[] = sw_create_grid_column('last_name', $this->gridContact);
      $columns[] = sw_create_grid_column('company_id', $this->gridContact, array(VISIBLE => FALSE));
      $columns[] = sw_create_grid_column('contact_id', $this->gridContact, array(VISIBLE => FALSE));
      $columns[] = sw_create_grid_column('email', $this->gridContact, array(VISIBLE => FALSE));

      $property = array(TYPE_COLUMN => 'JTPlatinumGridCommandColumn', WIDTH => 50);
      $columns[] = sw_create_grid_column('command', $this->gridContact, $property);

    	$this->gridContact->Columns = $columns;

    	Define('COL_COMMAND', $this->gridContact->findColumnByName('command'));
      $this->gridContact->Columns[ COL_COMMAND ]->Add( "Select" );

      $this->gridContact->init();
    }

		function SelectProposal($record = array())
    {
    	$sql = "SELECT service_proposal_id, proposal_name FROM service_proposal ";
      if (isset($record['language_cd'])){
        $record_proposal = sw_get_data_table("service_proposal", "language_cd = '{$record['language_cd']}'", "language_cd");
        $this->cbLanguage->ItemIndex = $record_proposal['language_cd'] ? $record_proposal['language_cd'] : $this->cbLanguage->ItemIndex;
      }

      $sql .= "WHERE language_cd = '{$this->cbLanguage->ItemIndex}' AND billing_entity_id = {$this->cbBilling_entity->ItemIndex} ORDER BY sort_no";
      $record_proposal = sw_records_array($sql, array('service_proposal_id', 'proposal_name'));

			$proposal_checked = array();
			$this->proposal_id->Items = array();

      $proposal_id = unserialize($record['proposal_id']);
      foreach ($record_proposal as $key => $proposal){
				  $this->proposal_id->AddItem($proposal);
      }
			$this->proposal_id->Checked = $proposal_id;
    }


    function add_service_agreementShowHeader($sender, $params)
    {
      echo SW_HEADER_HTML;
      if (!$this->notes_service_agreement->ReadOnly) echo SW_HEADER_MEMO_HTML;
      else echo SW_HEADER_MEMO_HTML_READONLY;
    }



    function gridLine_itemInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1){
        $fields = &$params[ 0 ];
        //search max index

        $line_item_id = 0;
        foreach($this->gridLine_item->CellData as $record_line){
          if ($record_line['line_item_id'] > $line_item_id){
            $line_item_id = $record_line['line_item_id'];
          }
        }
      }
      else { //update
      	$fields = &$params[ 1 ];
        $fields[ 'line_item_id' ] = $params[ 0 ];

        $line_item_id = 0;
        foreach($this->gridLine_item->CellData as $key => $record_line){
        	if ($record_line['line_item_id'] == $fields[ 'line_item_id' ]){
        		$line_item_id = $key;
          	break;
        	}
        }

      }

      $fields['description'] = sw_replace_date_macro($fields['description'], Date('Y-m-d'));
      $fields['quantity_no'] = sw_convert_comma_point($fields[ 'quantity_no' ]);
      $fields['price_amt'] = sw_convert_comma_point($fields[ 'price_amt' ]);
      $fields['total_amt'] = round($fields['quantity_no'] * $fields['price_amt'], 2);

      $where = "service_id = {$fields['service_id']}";
      if ($record = sw_get_data_table('service', $where)) {
        $record_line = $this->gridLine_item->CellData;

        if (!$fields[ 'line_item_id' ]){
          $fields[ 'line_item_id' ] = ++$line_item_id;
          array_push($record_line, $fields);
        }else
        {
          $record_line[$line_item_id] = $fields;
        }


        $this->gridLine_item->CellData = $record_line;
      }
      else {
        return false;
      }
    }

    function gridLine_itemDelete($sender, $params)
    {
      $fields = &$params[ 0 ];

      $record_line = $this->gridLine_item->CellData;
      foreach( $this->gridLine_item->CellData as $key => $record) {
        if ($record['line_item_id'] == $fields[0]){
            array_splice($record_line, $key, 1);
        }
      }
      $this->gridLine_item->CellData = $record_line;
    }


    function gridLine_itemJSCustomCommand($sender, $params)
    {
        ?>
        //begin js
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
        //end
        <?php
    }



    function btnCloseClick($sender, $params)
    {
    	$this->service_agreement_id->Value = "";
      redirect_url("service_agreement.php");
    }


    function gridLine_itemSummaryData($sender, $params)
    {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '');
      $fields = array();
      $fields["&nbsp;" . $Columna->Caption] = $Total;
    }

    function btnSaveJSClick($sender, $params)
    {
      Global $lbRequiredFieldError, $lbEmailErrorMsg;
        ?>
        //begin js

        var msgError = '';
        var email = document.getElementById("email").value;
        email = email.trim();

        if (document.getElementById("first_name").value === '') {
          msgError = msgError + document.getElementById('lbFirst_name').innerHTML + '</br>';
        }
        if (document.getElementById("last_name").value === '') {
          msgError = msgError + document.getElementById('lbLast_name').innerHTML + '</br>';
        }

        if (email === '') {
          msgError = msgError + document.getElementById('lbEmail').innerHTML + '</br>';
        }else {
          if (!(<?php echo SW_MASK_EMAIL;?>.test(email))){
            msgError = msgError + "<?php echo $lbEmailErrorMsg; ?>" + '</br>';
          }
        }

				if (gridLine_item.getPrimaryKey(0) === ''){
            msgError = msgError + "<?php echo SW_MESSAGE_ERROR_WITHOUT_SERVICE;?>" + '</br>';
				}

        if (msgError != ''){
          msgError = "<?php echo $lbRequiredFieldError; ?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
          return false;
        }
        gridLine_item.Post();
        return true;
        //end
        <?php
    }


    function btnSaveClick($sender, $params)
    {
      $total_amt = 0;
      foreach ($this->gridLine_item->CellData as $line_item){
        $total_amt += $line_item['total_amt'];
      }
      if ($this->company_id->value) $record['company_id'] = $this->company_id->value;
      if ($this->contact_id->value) $record['contact_id'] = $this->contact_id->value;
      $record['first_name'] = ucwords(trim($this->first_name->Text));
      $record['last_name'] = ucwords(trim($this->last_name->Text));
      $record['email'] = trim($this->email->Text);
      $record['notes_service_agreement'] = $this->notes_service_agreement->Text;
      $record['total_amt'] = $total_amt;
			$record['billing_entity_id'] = $this->cbBilling_entity->ItemIndex;

			//proposal_id

			$record['language_cd']         = $this->cbLanguage->ItemIndex;
      $record['proposal_id']         = serialize($this->proposal_id->Checked);
      $record['service_proposal_id'] = serialize($this->proposal_id->Items);

      //Insert Service Agreement
      if ($this->service_agreement_id->Value == 0){
        $record['created_by_user_id'] = $_SESSION['user_id'];
        $record['created_dt'] = date('Y-m-d H:i:s');

        sw_insert_table("service_agreement", $record);
        $this->service_agreement_id->Value = mysql_insert_id();
      }
      //Update Service agreement
      else {
        $where = "service_agreement_id = {$this->service_agreement_id->Value}";
        sw_update_table("service_agreement", $record, $where);
        $record = sw_get_data_table("service_agreement", $where);
      }

      //Update Tax
      $line_item = $this->gridLine_item->CellData;

      $this->sqlLine_item->close();
      $this->sqlLine_item->Open();
      While (!$this->sqlLine_item->EOF){
        $line_item_id = $this->sqlLine_item->Fields['line_item_id'];
        $where = "(service_agreement_id = {$this->service_agreement_id->Value}) AND (line_item_id = {$line_item_id})";
        $search = false;

        foreach( $line_item as $key => $record_line ) {
          //Update Linea exist
          if ($search = ($record_line['line_item_id'] == $line_item_id)){
              sw_update_table("line_item", $line_item[$key], $where);
              array_splice($line_item, $key, 1);
              break;
          }
        }

        if (!$search) sw_delete_table("line_item", $where);
        $this->sqlLine_item->next();
      }

      //Insert new record
      foreach ($line_item as $key => $record_line) {
      	if ($record_service = sw_get_data_table("service", "service_id = {$record_line['service_id']}")) {
      		$record_line['service_agreement_id'] = $this->service_agreement_id->Value;
      		$record_line['created_by_user_id'] 	= $record['created_by_user_id'];
      		$record_line['created_dt'] 				 	= $record['created_dt'];
      		$record_line['status_cd'] 				 	= SW_STATUS_LI_PROFORMA; // PROFORMA

        	$record_line['line_item_id'] = '';
        	$record_line['service_type_id'] = $record_service['service_type_id'];
        	$record_line['with_supplement_yn'] = $record_service['with_supplement_yn'];
          $record_line['applies_to_user_id'] = $record['created_by_user_id'];
      		$record_line['sort_no'] = $record_service['sort_no'];

        	sw_insert_table("line_item", $record_line);
        }
      }

      $this->service_agreement_id->Value = "";
      redirect_url("service_agreement.php");
    }


    function imSelect_contactJSClick($sender, $params)
    {
        ?>
        //begin js
				document.getElementById( "winSelect_contact" ).ShowModal();
        //end
        <?php
    }


    function gridContactJSCommand($sender, $params)
    {
        ?>
        //begin js
        	document.getElementById('short_name').value = gridContact.getCellText(row, 0);//First;
        	document.getElementById('first_name').value = gridContact.getCellText(row, 1);//First;
        	document.getElementById('last_name').value = gridContact.getCellText(row, 2);//company;
        	document.getElementById('company_id').value = gridContact.getCellText(row, 3);//company;
					document.getElementById('contact_id').value = gridContact.getCellText(row, 4);//contact;
        	document.getElementById('email').value = gridContact.getCellText(row, 5);//company;
      		document.getElementById('winSelect_contact').Hide();
          return true;
        //end
        <?php
    }

    function cbLanguageJSChange($sender, $params)
    {
    	echo $this->cbLanguage->ajaxCall("cbLanguageChange", array(), array("proposal_id"));
        ?>
        //begin js

        //end
        <?php
    }


    function cbLanguageChange($sender, $params)
    {
    	$this->SelectProposal($record);
    }


    function gridLine_itemJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        $(document).ready(function() {
          if (document.getElementById("gridLine_item_service_id_Editor")){
          	var cellValue = gridLine_item.getCellText(rowIndex, <?php echo COL_SERVICE;?>);
            $('#gridLine_item_selected_service_id_Editor').val(cellValue);
          }

        	$('#gridLine_item_selected_service_id_Editor').change(function() {
          	var service_description = $('#gridLine_item_selected_service_id_Editor option:selected').text();
            var service = service_description.split('|');
          	var service_id = $('#gridLine_item_selected_service_id_Editor option:selected').val();
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

      // Render an HTML text box.
      return sw_created_combobox_service($name, 'OnlyService');
    }

}


global $application;

global $add_service_agreement;

//Creates the form
$add_service_agreement=new add_service_agreement($application);

//Read from resource file
$add_service_agreement->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$add_service_agreement->show();

?>