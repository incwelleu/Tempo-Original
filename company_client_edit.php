<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/dmCompany.php");
require_once("include/accounting.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");

session_start();

//Class definition
class company_client_edit extends fmstrong
{
    public $lbFillAs = null;
    public $cbAddress = null;
    public $lbSeleced_client_id = null;
    public $selected_cliente_id = null;
    public $lbTax_ident = null;
    public $tax_ident = null;
    public $lbClient_name = null;
    public $client_name = null;
    public $gbInvoice_address = null;
    public $address_floor = null;
    public $address_door = null;
    public $address_city = null;
    public $lbRegaddress_street = null;
    public $lbRegaddress_street_no = null;
    public $lbRegaddress_city = null;
    public $address_street_no = null;
    public $address_street_type_id = null;
    public $address_street = null;
    public $lbRegaddress_floor = null;
    public $lbRegaddress_door = null;
    public $lbRegaddress_province = null;
    public $address_province = null;
    public $lbStreet_type = null;
    public $lbRegaddress_post_code = null;
    public $postal_cd = null;
    public $country_id = null;
    public $lbCountry = null;
    public $lbPayment_method = null;
    public $lbTax_type = null;
    public $payment_method_id = null;
    public $tax_type_key_id = null;
    public $btnSave = null;
    public $btnClose = null;
    public $company_client_id = null;
    public $sqlCompany_join_client = null;
    public $dsCompany_join_client = null;
    public $SiteTheme = null;
    public $sqlCompany_client = null;
    public $dsCompany_client = null;
    public $sqlTax_type_key = null;
    public $dsTax_type_key = null;
    public $company_id = null;
    public $winCompany_client_edit = null;

    function company_client_editCreate($sender, $params)
    {
      Global $StyleTheme;

      $this->SiteTheme->Theme = $StyleTheme;

      $this->ChangeLanguage();
      $this->ParameterClientEdit();
    }

    function ChangeLanguage()
    {
  		$this->lbTax_ident->Caption = SW_CAPTION_TAX_IDENT;
  		$this->lbClient_name->Caption = SW_CAPTION_CLIENT_NAME;
			$this->lbStreet_type->Caption = SW_CAPTION_STREET_TYPE;
      $this->lbRegaddress_street->Caption = SW_CAPTION_ADDRESS;
      $this->lbRegaddress_street_no->Caption = SW_CAPTION_ADDRESS_NUMBER;
      $this->lbRegaddress_floor->Caption = SW_CAPTION_ADDRESS_FLOOR;
      $this->lbRegaddress_door->Caption = SW_CAPTION_ADDRESS_DOOR;
      $this->lbRegaddress_city->Caption = SW_CAPTION_ADDRESS_CITY;
      $this->lbRegaddress_province->Caption = SW_CAPTION_ADDRESS_PROVINCE;
  		$this->lbRegaddress_post_code->Caption = SW_CAPTION_POST_CODE;
  		$this->lbCountry->Caption = SW_CAPTION_COUNTRY;
      $this->lbPayment_method->Caption = SW_CAPTION_PAYMENT_METHOD;
      $this->lbTax_type->Caption = SW_CAPTION_TAX_TYPE;

			//Buttons
      $this->btnSave->Caption = btnSave;
      $this->btnClose->Caption = btnClose;
    }

    function ParameterClientEdit()
    {
      Global $dmCompany, $GLOBAL_INVOICE_ADDRESS;

      $dmCompany->Table_open();

      $this->winCompany_client_edit->Caption = Title_Client . ( isset($_SESSION['short_name']) ? " (" . $_SESSION['short_name'] . ")" : "");

      $sql = "SELECT * FROM tax_type_key
              WHERE (type_tax_cd = " . GLOBAL_OUTPUT_TAX . ") AND (visible_yn = True) AND (country_id = {$_SESSION['country_id']})";
      $this->sqlTax_type_key->close();
      $this->sqlTax_type_key->SQL = $sql;
      $this->sqlTax_type_key->open();

      $this->cbAddress->Items = $GLOBAL_INVOICE_ADDRESS;
      $this->lbSeleced_client_id->Visible = False;
      $this->selected_cliente_id->Visible = False;
      if (isset($_SESSION['selected_company_id']) && $_SESSION['selected_company_id'] !== $_SESSION['company_id']){
      	$this->company_id->Value = $_SESSION['selected_company_id'];
      	$this->lbSeleced_client_id->Visible = True;
      	$this->selected_cliente_id->Visible = True;
        $this->lbFillAs->Visible = True;
        $this->cbAddress->Visible = True;
        $this->cbAddress->ItemIndex = 0;
      }

      $this->sqlCompany_join_client->close();
      $this->sqlCompany_join_client->Params = array($this->company_id->Value);
      $this->sqlCompany_join_client->open();

      if (isset($_SESSION['selected_company_client_id'])){
      	$this->company_client_id->Value = $_SESSION['selected_company_client_id'];
        unset($_SESSION['selected_company_client_id']);
      }

			$this->ViewInvoiceAddress();
    }


    function ViewInvoiceAddress()
    {
    	//Create client of StrongWeber for country
    	if ($this->selected_cliente_id->Visible && !$this->company_client_id->Value){
      	$record_strong = sw_company_country_strong($_SESSION['company_id']);
      	$this->company_client_id->Value = sw_create_company_client_strong($record_strong['company_id'], $_SESSION['company_id']);
        $this->sqlCompany_join_client->refresh();
      }

      $this->sqlCompany_client->close();
      $this->sqlCompany_client->Params = array($this->company_client_id->Value);
      $this->sqlCompany_client->open();

      $this->address_street_type_id->SelectedValue = $this->sqlCompany_client->Fields['address_street_type_id'];
      $this->payment_method_id->SelectedValue = $this->sqlCompany_client->Fields['payment_method_id'];
      $this->country_id->SelectedValue = $this->sqlCompany_client->Fields['country_id'];
      $this->tax_type_key_id->SelectedValue = $this->sqlCompany_client->Fields['tax_type_key_id'];
      $this->selected_cliente_id->SelectedValue = $this->company_client_id->Value;
    }

    function btnSaveClick($sender, $params)
    {
      $fields = $this->dsCompany_client->DataSet->fieldbuffer;
      $fields['tax_ident'] = sw_clean_caracter_tax_ident($fields['tax_ident']);
			if (!$msg = sw_valid_TaxID_client($fields['tax_ident'], $fields['company_id'], $this->company_client_id->Value)) {
      	if (!$this->company_client_id->Value){
      		$fields['company_id'] = $this->company_id->Value ? $this->company_id->Value : $_SESSION['company_id'];
      		sw_insert_table('company_client', $fields);
        	$this->company_client_id->Value = mysql_insert_id();
      	}
      	else{
      		$where = "company_client_id = {$this->company_client_id->Value}";
      		sw_update_table('company_client', $fields, $where);
      	}

      	//Si Es visualizado desde Company Details
      	if ($this->company_id->Value){
        	$where = "company_id = {$_SESSION['company_id']} AND company_client_id = {$fields['company_client_id']}";
      		if (!$record = sw_get_data_table("company_join_client", $where)) {
          	$record['company_id'] = $_SESSION['company_id'];
          	$record['company_client_id'] = $this->company_client_id->Value;
          	sw_insert_table("company_join_client", $record);
        	}
        	else{
          	$record['company_client_id'] = $this->company_client_id->Value;
        		sw_update_table("company_join_client", $record, $where);
        	}
      	}

    		$this->Close();
      }
      else {
  			$this->msgError->Value = $msg;
      }
    }


    function btnCloseClick($sender, $params)
    {
    	$this->Close();
    }


		function Close()
    {
    	if ($page_return = $_SESSION['page_return']){
      	unset($_SESSION['page_return']);
      	redirect_url($page_return);
      }
    }

    function selected_cliente_idJSChange($sender, $params)
    {
    	echo $this->selected_cliente_id->ajaxCall("ChangeInvoiceAddress");
        ?>
        //begin js
        return false;
        //end
        <?php
    }

    function ChangeInvoiceAddress()
    {
    	$this->company_client_id->Value = $this->selected_cliente_id->SelectedValue;
      $this->ViewInvoiceAddress();
    }

    function cbAddressJSChange($sender, $params)
    {
     	$components = array("address_street_type_id", "address_street", "address_street_no", "address_floor",
  												"address_door", "address_city", "address_province", "postal_cd", "country_id");
    	echo $this->cbAddress->ajaxCall("cbAddressChange", array(), $components);
        ?>
        //begin js
        return false;
        //end
        <?php
    }


    function cbAddressChange($sender, $params)
    {
    	$where = "company_id = {$_SESSION['company_id']}";
    	if (($company = sw_get_data_table("company", $where)) && $this->cbAddress->ItemIndex !== 0)
      {
      	if ($this->cbAddress->ItemIndex == 1){
     			$this->address_street_type_id->SelectedValue = $company['regaddress_street_type_id'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_street'] = $company['regaddress_street'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_street_no'] = $company['regaddress_street_no'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_floor'] = $company['regaddress_floor'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_door'] = $company['regaddress_door'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_city'] = $company['regaddress_city'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_province'] = $company['regaddress_province'];
  				$this->dsCompany_client->DataSet->fieldbuffer['postal_cd'] = $company['regaddress_post_code'];
  				$this->country_id->SelectedValue = $company['country_id'];
     		}
     		else {
     			$this->address_street_type_id->SelectedValue = 0;
  				$this->dsCompany_client->DataSet->fieldbuffer['address_street'] = $company['mail_street_address'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_street_no'] = '';
  				$this->dsCompany_client->DataSet->fieldbuffer['address_floor'] = '';
  				$this->dsCompany_client->DataSet->fieldbuffer['address_door'] = '';
  				$this->dsCompany_client->DataSet->fieldbuffer['address_city'] = $company['mail_city'];
  				$this->dsCompany_client->DataSet->fieldbuffer['address_province'] = $company['mail_province'];
  				$this->dsCompany_client->DataSet->fieldbuffer['postal_cd'] = $company['mail_post_code'];
  				$this->country_id->SelectedValue = $company['mail_country_id'];
        }
  	 	}
		}

}

global $application;

global $company_client_edit;

//Creates the form
$company_client_edit=new company_client_edit($application);

//Read from resource file
$company_client_edit->loadResource(__FILE__);

//Shows the form
$company_client_edit->show();

?>