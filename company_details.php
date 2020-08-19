<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");
require_once("include/dmCompany.php");
require_once("include/ziparchive.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtpagecontrol.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");

define('TAB_DETAILS', 0);
define('TAB_CONTACT', 1);
define('TAB_TAXMODEL', 2);

session_start();

//Class definition
class company_details extends fmstrong
{
    public $dsBilling_entity = null;
    public $sqlBilling_entity = null;
    public $lbFillAs = null;
    public $lbCountry_id = null;
    public $dsCompany_activity_code = null;
    public $sqlCompany_activity_code = null;
    public $company_id = null;
    public $ImageList = null;
    public $SiteTheme = null;
    public $btnCompany = null;
    public $contact_list_id = null;
    public $CheckBox1 = null;
    public $winCompanyTemp = null;
    public $dsCompany_administrator = null;
    public $sqlCompany_administrator = null;
    public $lbCompany_name = null;
    public $gbConstitution = null;
    public $const_dt = null;
    public $lbConst_dt = null;
    public $lbConst_notary = null;
    public $const_notary = null;
    public $tomo = null;
    public $lbTomo = null;
    public $lbFolio = null;
    public $folio = null;
    public $hoja = null;
    public $lbHoja = null;
    public $gridCompany_activity_code = null;
    public $btnActivity = null;
    public $gridCompany_administrator = null;
    public $lbAdministrators = null;
    public $company_activity_code_id = null;
    public $notes_me = null;
    public $gbRegistered_address = null;
    public $regaddress_floor = null;
    public $regaddress_city = null;
    public $regaddress_door = null;
    public $lbRegaddress_street = null;
    public $lbRegaddress_street_no = null;
    public $lbRegaddress_city = null;
    public $regaddress_street_no = null;
    public $regaddress_street_type_id = null;
    public $regaddress_street = null;
    public $lbRegaddress_floor = null;
    public $lbRegaddress_door = null;
    public $lbRegaddress_province = null;
    public $regaddress_province = null;
    public $lbStreet_type = null;
    public $lbRegaddress_post_code = null;
    public $regaddress_post_code = null;
    public $tax_ident_type_cd = null;
    public $company_name = null;
    public $gbParameter = null;
    public $accounting_provider_id = null;
    public $user_id = null;
    public $lbUsername = null;
    public $short_name = null;
    public $lbShort_name = null;
    public $lbAcct_manager_id = null;
    public $acct_manager_id = null;
    public $lbAccounting_provider_id = null;
    public $payroll_provider_id = null;
    public $lbPayroll_provider_id = null;
    public $payment_method_id = null;
    public $lbPayment_method = null;
    public $is_default_company_yn = null;
    public $lbTax_ident_type_cd = null;
    public $lbTax_ident = null;
    public $tax_ident = null;
    public $gbCreated = null;
    public $created_by_user = null;
    public $created_dt = null;
    public $gbMailing_address = null;
    public $lbMail_street_address = null;
    public $lbMail_city = null;
    public $lbMail_province = null;
    public $lbMail_post_code = null;
    public $lbMail_country_id = null;
    public $mail_city = null;
    public $mail_province = null;
    public $mail_post_code = null;
    public $mail_country_id = null;
    public $mail_street_address = null;
    public $company_cd = null;
    public $btnCreateNew = null;
    public $btnAddNote = null;
    public $lbNotes = null;
    public $country_id = null;
    public $cbAddress = null;
    public $lbBilling_entity = null;
    public $billing_entity_id = null;

    function company_detailsCreate($sender, $params)
    {
      Global $StyleTheme;

      $this->SiteTheme->Theme = $StyleTheme;

      $this->ParameterCompany();
    }

    function ParameterCompany()
    {
      Global $aLegacyTaxType;

			$this->gbRegistered_address->Caption = SW_CAPTION_REGISTERED_ADDRESS;
			$this->gbMailing_address->Caption = SW_CAPTION_MAILING_ADDRESS;

      if (!isset($_POST['btnCompanySubmitEvent'])) {
        $this->company_id->Value = $_SESSION['company_id'];
      }

      if (isset($_POST['btnEnter_email']) || isset($_POST['btnClose_email'])){
        $this->winCompanyTemp->Include = "";
        $this->winCompanyTemp->Hide();
        if (isset($_POST['btnEnter_email'])){
	        $company_id = $_SESSION['company_id'];
          $get_enter_email = $_POST['get_enter_email'];
          $server = $_SERVER['SERVER_NAME'];
          $dir = $_SERVER['DOCUMENT_ROOT'];
          $cmd = "/kunden/homepages/0/d530163901/htdocs/temposw/executable/download_all_company_file.sh '{$company_id}' '{$get_enter_email}' '{$server}' > /dev/null &";
			//		$this->gbMailing_address->Caption = $cmd;
          exec($cmd);
          die;
        }
      }
    }

    function company_detailsShow($sender, $params)
    {
      if ($_POST['btnClose'] || $_POST['btnSaveSubmitEvent']){
        $this->winCompanyTemp->Hide();
      }

//      $this->lbTitle->Caption = Title_Company . (($this->company_id->Value!=0) ? " (" . $_SESSION['short_name'] . ")" : "");
//      $this->lbTitle->Visible = True;

      //Toolbar of Company
      if ($_SESSION['IsSuperadmin']) {
      	$items['btnAdd'] = array(btnAdd, 1, "2");
      	$items['btnDeleteCompany'] = array(btnDelete, ($this->company_id->Value != 0), "6");
      }
      $items['btnSave'] = array(btnSave, 1, "5");
      $items['btnCancel'] = array(btnCancel, 1, "4");
      if (!$_SESSION['IsProvider']) $items['btnDownloadCompanyFile'] = array(btnDownloadCompanyFile, ($this->company_id->Value !=0));
      $this->btnCompany->Items = $items;

      //Data load company table
      if (($_POST['btnCompanySubmitEvent']!=='btnCompany_btnSave')) {
        $this->Company_load();
      }

			//Active Controls
      $this->ActiveControl();
    }

		function ActiveControl()
    {
  		$sql = "SELECT regaddress_id, regaddress_description FROM regaddress ORDER BY regaddress_description";
			$record = sw_records_array($sql, Array('regaddress_id', 'regaddress_description'));
			$record[0] = "";
      $this->cbAddress->Items = $record;
      $this->cbAddress->ItemIndex = 0;

    	$active = $_SESSION['IsSuperadmin'] || $_SESSION['IsProvider'];

      //Company
      $this->company_name->Enabled = $active;
      $this->tax_ident_type_cd->Enabled = $active;
      $this->tax_ident->Enabled = $active;
      $this->short_name->Enabled = $active;
      $this->user_id->Enabled = $active;
      $this->acct_manager_id->Enabled = $active;

      $this->lbAccounting_provider_id->Visible = $this->accounting_provider_id->Visible = $active || (!$active && $_SESSION['can_see_accounting_yn']);
			$this->accounting_provider_id->Enabled = $active;
      $this->lbPayroll_provider_id->Visible = $this->payroll_provider_id->Visible = $active || (!$active && $_SESSION['can_see_employee_general_yn']);;
			$this->payroll_provider_id->Enabled = $active;

			$this->lbBilling_entity->Visible = $this->billing_entity_id->Visible = $active;
    	$this->lbFillAs->Visible = $active;
      $this->cbAddress->Visible = $active;

      //Notes
    	$this->lbNotes->Visible = $active;
      $this->btnAddNote->Visible = $active;
      $this->notes_me->Visible = $active;

      //Button create user
      $this->btnCreateNew->Enabled = (($this->user_id->SelectedValue == 0) && ($this->short_name->Text) && $_SESSION['IsSuperadmin']);
      $this->btnCreateNew->ImageSource = $this->btnCreateNew->Enabled ? 'images/button/add_16x16.png' : 'images/button/add_16x16_disable.png';
      $this->gbConstitution->Visible = ($this->company_id->Value == 0) || ($this->tax_ident_type_cd->ItemIndex == 1) || ($this->tax_ident_type_cd->ItemIndex == 3);

			//Constitution
      $this->const_dt->Enabled = $active;
      $this->const_notary->Enabled = $active;
      $this->tomo->Enabled = $active;
      $this->folio->Enabled = $active;
      $this->hoja->Enabled = $active;
      $this->gridCompany_activity_code->ReadOnly = !$active;

      //Toolbar of Activity
      $items = array();
      $items['btnAdd'] = array(btnAdd, $active, "2");
      $items['btnDeleteActivity'] = array(btnDelete, $active, "6");
      $items['btnEdit'] = array(btnEdit, $active, "3");
      $this->btnActivity->Items = $items;

    }

    function Company_load()
    {
      Global $aLegacyTaxType, $dmCompany, $company_country_default, $GLOBAL_DOCUMENT_TYPE;

      $dmCompany->Table_open();

      $this->sqlCompany_activity_code->close();
      $this->sqlCompany_activity_code->Params = array($this->company_id->Value);
      $this->sqlCompany_activity_code->open();

      $this->sqlCompany_administrator->close();
      $this->sqlCompany_administrator->Params = array($this->company_id->Value);
      $this->sqlCompany_administrator->open();


      $record_company = sw_get_data_table("company", "(company.company_id = {$this->company_id->value})");
      $record_user = sw_get_data_table("user", "(user_id = {$record_company['created_by_user_id']})");
      $this->contact_list_id->Value = $record_company['contact_list_id'];

      $this->company_name->text = $record_company['company_name'];
      $this->company_cd->text = $record_company['company_id'];
      $this->tax_ident_type_cd->Items = $GLOBAL_DOCUMENT_TYPE;
      $this->tax_ident_type_cd->ItemIndex = $record_company['tax_ident_type_cd'];
      $this->tax_ident->text = $record_company['tax_ident'];

      //Created
      $this->created_by_user->Text = $record_user['username'];
      $this->created_dt->Text = $record_company['created_dt'];

      //Parameter
      $this->is_default_company_yn->Checked = !isset($record_company['is_default_company_yn']) ? True : $record_company['is_default_company_yn'];
      $this->short_name->text = $record_company['short_name'];
      $this->user_id->SelectedValue = $record_company['user_id'];
      $this->acct_manager_id->SelectedValue = $record_company['acct_manager_id'];
      $this->accounting_provider_id->SelectedValue = $record_company['accounting_provider_id'];
      $this->payroll_provider_id->SelectedValue = $record_company['payroll_provider_id'];
      $this->payment_method_id->SelectedValue = $record_company['payment_method_id'] ? $record_company['payment_method_id'] : $_SESSION['settings']['payment_method_id'];
      $this->billing_entity_id->SelectedValue = $record_company['billing_entity_id'];

      //Mailing address
      $this->mail_street_address->Text = $record_company['mail_street_address'];
      $this->mail_city->Text = $record_company['mail_city'];
      $this->mail_province->Text = $record_company['mail_province'];
      $this->mail_post_code->Text = $record_company['mail_post_code'];
      $this->mail_country_id->SelectedValue = $record_company['mail_country_id'];

      //Registered address
      if ($_POST['cbAddressSubmitEvent']==""){
      	$this->regaddress_street_type_id->SelectedValue = $record_company['regaddress_street_type_id'];
      	$this->regaddress_street->Text = $record_company['regaddress_street'];
      	$this->regaddress_street_no->Text = $record_company['regaddress_street_no'];
      	//$this->regaddress_stairwell->Text = $record_company['regaddress_stairwell'];
      	$this->regaddress_floor->Text = $record_company['regaddress_floor'];
      	$this->regaddress_door->Text = $record_company['regaddress_door'];
      	$this->regaddress_city->Text = $record_company['regaddress_city'];
      	$this->regaddress_province->Text = $record_company['regaddress_province'];
      	$this->regaddress_post_code->Text = $record_company['regaddress_post_code'];
      	$this->country_id->SelectedValue = $record_company['country_id'] ? $record_company['country_id'] : $company_country_default;
      	$this->country_id->Enabled = false;  // Temporal
      }

      $this->const_dt->Date = $record_company['const_dt'] != '0000-00-00' ? $record_company['const_dt'] : '';
      $this->notes_me->Text = $record_company['notes_me'];

      $this->ConstitutionView();
    }


    function btnCompanyJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];

          if (toolButton == 'btnCompany'){
            if (toolButtonName == 'btnDeleteCompany') {
                return confirm("<?php echo $lbDeleteInformationMsg ?>");
            }
          }

        //end
        <?php
    }


    function btnCompanyClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnAdd")
      {
        $this->company_id->Value = 0;
        $this->tax_ident_type_cd->ItemIndex = 0;
      }
      else if ($toolButtonName == "btnCancel")
      {
        $this->company_id->Value = $_SESSION['company_id'];
      }
      else if ($toolButtonName == "btnSave")
      {
        if ($this->Validate_data()) {
          $this->Save_company();
        }
      }
      else if ($toolButtonName == "btnDeleteCompany")
      {
        $this->DeleteCompanySelected();
      }
      else if (($toolButtonName == 'btnParameterAccounting')) {
        $this->winCompanyTemp->Caption = Title_Parameters_Accounting;
        $this->winCompanyTemp->Height = 580;
        $this->winCompanyTemp->Width = 595;
        $this->winCompanyTemp->Include = 'company_tax_account.php';
        $this->winCompanyTemp->ShowModal();
      }
      else if (($toolButtonName == 'btnDownloadCompanyFile')) {
      	$this->winCompanyTemp->Caption = 'Enter email';
        $this->winCompanyTemp->Width = 475;
        $this->winCompanyTemp->height = 125;
        $this->winCompanyTemp->Include = "include/enter_email.php";
        $this->winCompanyTemp->ShowModal();
      }
    }


    function Validate_data()
    {
      Global $lbCompanyCompanyName_error, $lbCompanyDocumentType_error,
              $lbCompanyTaxIdent_error, $lbCompanyShortNameNotAvailable_error,
              $lbCompanyShortNameAlreadyExists_error, $lbCompanyCountry_error,
							$lbCompanyPaymentMethod_error, $lbCompanyBillingEntity_error;
      $msg = '';

      //Valid company
      if (!$this->company_name->Text){
        $msg .= $lbCompanyCompanyName_error . "<br/>";
      }

      if ($this->tax_ident_type_cd->ItemIndex < 1){
        $msg .= $lbCompanyDocumentType_error . "<br/>";
      }

      $msg .= $this->Validate_Tax_ident();

      //Valid country_id
      if (!$this->country_id->SelectedValue) {
        $msg .= $lbCompanyCountry_error . "<br/>";
      }

      //Valid Billing entity
      if (!$this->billing_entity_id->SelectedValue) {
        $msg .= $lbCompanyBillingEntity_error . "<br/>";
      }


      //Valid short_name
      $this->short_name->text = ($_POST['short_name'] = strtolower(trim(sw_checked_file_valid_name($this->short_name->text))));
      if (!$this->short_name->text) { $msg .= $lbCompanyShortNameNotAvailable_error . "<br/>"; }
      else {
        if (sw_valid_username($this->user_id->SelectedValue, $this->short_name->text)){
          $msg .= $lbCompanyShortNameAlreadyExists_error . "<br/>";
        }else{
          $msg .= sw_valid_short_name($this->company_id->Value, $this->short_name->text);
        }
      }

      //Valid Constitution Data CIF/NIF
      //1 => 'CIF' , 2 => 'NIF', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT'
      if ($this->tax_ident_type_cd->ItemIndex == 1 || $this->tax_ident_type_cd->ItemIndex == 2 || $this->tax_ident_type_cd->ItemIndex == 3){
        if ($this->created_by_user->Text){
          $msg .= $this->Validate_registered_address();
          //$msg .= ($this->tax_ident_type_cd->ItemIndex == 1) || ($this->tax_ident_type_cd->ItemIndex == 3) ? $this->Validate_data_const() : "";
        }
      }

      $this->msgError->Value = $msg;
      return (!$msg);
    }


    function Validate_Tax_ident()
    {
      Global $lbCompanyTaxIdent_error, $lbCompanyTaxIdentExist;

      $company_id = $this->company_id->Value;
      $_POST['tax_ident'] = $this->tax_ident->text = sw_clean_caracter_tax_ident($this->tax_ident->text);
      $msg = "";
      if (!$this->tax_ident->text) {
        $msg .= $lbCompanyTaxIdent_error . "<br/>";
      }
      else {
        $where = "(tax_ident_type_cd = {$this->tax_ident_type_cd->ItemIndex}) AND (tax_ident = '{$this->tax_ident->text}')";
        $where .= ($company_id) ? " AND (company_id != {$company_id})" : "";
        if ($record = sw_get_data_table('company', $where))
          $msg .= $lbCompanyTaxIdentExist . "<br/>";
      }

      return $msg;
    }


    function Validate_Mail_Street()
    {
      Global $lbCompanyCompanyMail_Street, $lbCompanyCompanyMail_City,
             $lbCompanyCompanyMail_Province, $lbCompanyCompanyMail_PostCode,
             $lbCompanyCountry_error;

      $msg = '';
      if (!$this->mail_street_address->Text){
        $msg .= $lbCompanyCompanyMail_Street . "<br/>";
      }

      if (!$this->mail_city->Text){
        $msg .= $lbCompanyCompanyMail_City . "<br/>";
      }

      if (!$this->mail_province->Text){
        $msg .= $lbCompanyCompanyMail_Province . "<br/>";
      }

      if (!$this->mail_post_code->Text){
        $msg .= $lbCompanyCompanyMail_PostCode . "<br/>";
      }

      if (!$this->mail_country_id->SelectedValue) {
        $msg .= $lbCompanyCountry_error . "<br/>";
      }

      $msg = $msg ? "<br/><strong>{$this->gbMailing_address->Caption}</strong><br/>{$msg}" : $msg;
      return $msg;
    }


    function Validate_registered_address()
    {
      Global $lbCompanyCompanyStreet_Type, $lbCompanyCompanyMail_Street,
             $lbCompanyCompanyMail_City, $lbCompanyCompanyMail_Province,
             $lbCompanyCompanyMail_PostCode,
             $lbCompanyCountry_error;

      $msg = '';
      if (!$this->regaddress_street_type_id->SelectedValue) {
        $msg .= $lbCompanyCompanyStreet_Type . "<br/>";
      }

      if (!$this->regaddress_street->Text){
        $msg .= $lbCompanyCompanyMail_Street . "<br/>";
      }

      if (!$this->regaddress_city->Text){
        $msg .= $lbCompanyCompanyMail_City . "<br/>";
      }

      if (!$this->regaddress_province->Text){
        $msg .= $lbCompanyCompanyMail_Province . "<br/>";
      }

      if (!$this->regaddress_post_code->Text){
        $msg .= $lbCompanyCompanyMail_PostCode . "<br/>";
      }

      $msg = $msg ? "<br/><strong>{$this->gbRegistered_address->Caption}</strong><br/>{$msg}" : $msg;
      return $msg;
    }

    function Validate_data_const()
    {
      Global $lbCompanyConstDate_error, $lbCompanyConstNotary_error,
            $lbCompanyConstTomo_error, $lbCompanyConstFolio_error,
            $lbCompanyConstHoja_error;

      $msg = '';

      //Valid Contitution data
      if (!$this->const_dt->Date){
        $msg .= $lbCompanyConstDate_error . "<br/>";
      }

      if ($this->tax_ident_type_cd->ItemIndex == 1) {
        if (!$this->const_notary->Text){
          $msg .= $lbCompanyConstNotary_error . "<br/>";
        }
        if (!$this->tomo->Text){
          $msg .= $lbCompanyConstTomo_error . "<br/>";
        }
        if (!$this->folio->Text){
          $msg .= $lbCompanyConstFolio_error . "<br/>";
        }
        if (!$this->hoja->Text){
          $msg .= $lbCompanyConstHoja_error . "<br/>";
        }
      }

      $msg = $msg ? "<br/><strong>{$this->gbConstitution->Caption}</strong><br/>{$msg}" : $msg;

      return $msg;
    }


    function Save_company()
    {
      if (!$this->company_id->Value){
        $record['user_id'] = $this->user_id->SelectedValue;
        $record['tax_regime_id'] = GLOBAL_REGIME_FISCAL;
        $record['created_by_user_id'] = $_SESSION['user_id'];
        $record['created_dt'] = date("Y-m-d H:i:s");
      	$record['short_name'] = $this->short_name->Text;
				$record['billing_entity_id'] = $this->billing_entity_id->SelectedValue;

        sw_insert_table("company", $record);
        $_POST['company_id'] = $record['company_id'] = $this->company_id->Value = mysql_insert_id();

				sw_created_directory_client_ftp_server($record['short_name']);
      }else
      {
        $where = "company_id = " . $this->company_id->Value;
        $record = sw_get_data_table("company", $where);
      }

      $this->Save_contact_list($record);

      $reload = $this->Update_company($record);

      $this->Save_company_country_specific($this->company_id->Value);

      sw_get_company_parameter($this->company_id->Value);

      if (($_SESSION['company_id'] !== $this->company_id->Value) || $reload){
        $_SESSION['company_id'] = $this->company_id->Value;
        $this->Reload_main();
      }

      //Update Default company
      if ($this->is_default_company_yn->Checked) {
        Global $connectionDB;
        $sql = "UPDATE company SET is_default_company_yn = 0
                WHERE (user_id = '{$this->user_id->SelectedValue}') AND company_id != '{$this->company_id->Value}'";
        $connectionDB->DbConnection->execute($sql);
      }
    }


    function Save_contact_list($record)
    {
      $_POST['contact_list_id'] = sw_insert_contact_list($this->user_id->SelectedValue, $record);

      //Si tiene asignado el cliente
      if ($this->user_id->SelectedValue){
        $where = "user_id = {$this->user_id->SelectedValue}";
        $record = sw_get_data_table("company", $where);
        $record['contact_list_id'] = sw_insert_contact_list($this->user_id->SelectedValue, $record);

        if ($record['contact_list_id'] != $_POST['contact_list_id']){
          sw_update_table("contact", $record, "contact_list_id = {$_POST['contact_list_id']}");
          $_POST['contact_list_id'] = $record['contact_list_id'];
        }
      }

      if ($_POST['contact_list_id'] !== $_SESSION['contact_list_id']) {
        $_SESSION['contact_list_id'] = $_POST['contact_list_id'];
      }
    }


    function Update_company($record)
    {
      Global $aLegacyTaxType, $email_from_notify;

      $_POST['is_default_company_yn'] = $this->is_default_company_yn->Checked;
			if (isset($_POST['short_name'])) {$_POST['short_name'] = sw_checked_file_valid_name(strtolower(trim($_POST['short_name'])));}

      $where = "company_id = {$record['company_id']}";
      sw_notify_change_account_manager($_POST, $where);

      //If the client modifies the data, notify account manager and Billing
      $email_notify = array();
      if (!$_SESSION['IsSuperadmin'] && !$_SESSION['IsProvider'] &&
      	  ($provider_contact = sw_get_data_table("provider_contact", "provider_contact_id = {$record['acct_manager_id']}"))){
      	$email_notify[] = $provider_contact['sw_email'];
      	$email_notify[] = $_SESSION['settings']['se_billing_email'];
      }
      sw_update_table("company", $_POST, $where, $email_notify);

      //Compruebo si el short_name cambio 			//Comprobamos si se cambio elk Account Manager, Accounting provider, Payroll provider

      return $this->Change_shortname($record['short_name'], $_POST['short_name']) || $this->ChangeAccountManagerProvider($record, $_POST);
    }

		function ChangeAccountManagerProvider($old, $new){
			Global $connectionDB;

			$reload = false;

			if ($old["acct_manager_id"] != $new["acct_manager_id"]) {

				$udate = True;

				if ($old["acct_manager_id"] && $new["acct_manager_id"]) {
					$updateRS = "UPDATE line_item
											SET line_item.applies_to_user_id = {$new['acct_manager_id']}
											WHERE line_item.status_cd = 'SV' AND
										      	line_item.applies_to_user_id = {$old['acct_manager_id']} AND
										      	company_id = {$old['company_id']}";

		 			$connectionDB->DbConnection->BeginTrans();
		 			$connectionDB->DbConnection->execute($updateRS);
					$udate = $connectionDB->DbConnection->CompleteTrans();
				}

		 		if ($udate && (!empty($new["acct_manager_id"]) || !empty($old["acct_manager_id"]))) {
					$record_user = sw_get_data_table("vw_account_manager", "acct_manager_id = {$new['acct_manager_id']}", "account_manager_name");
					$record_user['account_manager_name'] = $record_user ? $record_user['account_manager_name'] : "(blank)";
					$message = "assigned account manager to {$record_user['account_manager_name']}";
					sw_add_note_company($old['company_id'], $message);
					$reload = true;
				}
			}

			if ($old["accounting_provider_id"] != $new["accounting_provider_id"]) {

				$udate = True;

				if ($old["accounting_provider_id"] && $new["accounting_provider_id"]) {
					$updateRS = "UPDATE line_item
											SET line_item.applies_to_user_id = {$new['accounting_provider_id']}
											WHERE line_item.status_cd = 'SV' AND
										      	line_item.applies_to_user_id = {$old['accounting_provider_id']} AND
										      	company_id = {$old['company_id']}";

		 			$connectionDB->DbConnection->BeginTrans();
		 			$connectionDB->DbConnection->execute($updateRS);
					$udate = $connectionDB->DbConnection->CompleteTrans();
				}

		 		if ($udate && (!empty($new["accounting_provider_id"]) || !empty($old["accounting_provider_id"]))) {
					$record_user = sw_get_data_table("vw_accountant_manager", "accounting_provider_id = {$new['accounting_provider_id']}", "accounting_provider_name");
					$record_user['accounting_provider_name'] = $record_user ? $record_user['accounting_provider_name'] : "(blank)";
					$message = "assigned accounting provider to {$record_user['accounting_provider_name']}";
					sw_add_note_company($old['company_id'], $message);
					$reload = true;
				}
			}

			if ($old["payroll_provider_id"] != $new["payroll_provider_id"]) {

				$udate = True;

				if ($old["payroll_provider_id"] && $new["payroll_provider_id"]) {
					$updateRS = "UPDATE line_item
											SET line_item.applies_to_user_id = {$new['payroll_provider_id']}
											WHERE line_item.status_cd = 'SV' AND
										      line_item.applies_to_user_id = {$old['payroll_provider_id']} AND
										      company_id = {$old['company_id']}";

		 			$connectionDB->DbConnection->BeginTrans();
		 			$connectionDB->DbConnection->execute($updateRS);
					$udate = $connectionDB->DbConnection->CompleteTrans();
				}

		 		if ($udate && (!empty($new["payroll_provider_id"]) || !empty($old["payroll_provider_id"]))) {
					$record_user = sw_get_data_table("vw_payroll_manager", "payroll_provider_id = {$new['payroll_provider_id']}", "payroll_provider_name");
					$record_user['payroll_provider_name'] = $record_user ? $record_user['payroll_provider_name'] : "(blank)";
					$message = "assigned payroll provider to {$record_user['payroll_provider_name']}";
					sw_add_note_company($old['company_id'], $message);
					$reload = true;
				}
			}

			return $reload;
		}

		function Change_shortname($short_name_old, $short_name_new)
		{
			$reload = false;

    	if ($short_name_old !== $short_name_new){
  			Global $VirtualFile, $Directory_client_ftp_server;

      	$dir_old = $VirtualFile . TMP_CLIENT_FTP_SERVER . "/" . $short_name_old . "/";
      	$dir_new = $VirtualFile . TMP_CLIENT_FTP_SERVER . "/" . $short_name_new . "/";

      	if (rename($dir_old, $dir_new)){
        	Global $connectionDB;

      		$sql = "UPDATE virtual_file
      					SET link = REPLACE(link, '{$dir_old}', '{$dir_new}')
		          	WHERE link LIKE '{$dir_old}%'";

        	$connectionDB->DbConnection->BeginTrans();
        	$connectionDB->DbConnection->execute($sql);
        	if ($connectionDB->DbConnection->CompleteTrans()) {
						$reload = true;
					}
      	}
      }

			return $reload;
		}


    function Save_company_country_specific($company_id)
    {
      $where = "company_id = {$company_id}";

      if (!($record = sw_get_data_table("company_country_specific", $where))){
        $record['company_id'] = $company_id;
        $record['const_notary'] = $_POST['const_notary'];
        $record['tomo'] = $_POST['tomo'];
        $record['folio'] = $_POST['folio'];
        $record['hoja'] = $_POST['hoja'];
        sw_insert_table("company_country_specific", $record);
      } else
        sw_update_table("company_country_specific", $_POST, $where);
    }


    function DeleteCompanySelected()
    {
      Global $connectionDB, $VirtualFile, $Directory_client_ftp_server;

       $dir = $VirtualFile . TMP_CLIENT_FTP_SERVER . "/" . $this->short_name->Text;

      //Extract user_id of Client admin
      $company_id = $this->company_id->Value;

      if ($company_id){
        $sql = "SELECT *
                FROM company
	                  LEFT JOIN invoice_issued ON company.company_id = invoice_issued.company_id
   	                LEFT JOIN invoice_received ON company.company_id = invoice_received.company_id
                WHERE company.company_id = " . $company_id . " AND (invoice_received.company_id is null) AND (invoice_issued.company_id is null)";
				$record = sw_records_array($sql, Array('company_id', 'short_name'));

				if ($record){
        	$sql = "DELETE company
                	FROM company
	                  	LEFT JOIN invoice_issued ON company.company_id = invoice_issued.company_id
   	                	LEFT JOIN invoice_received ON company.company_id = invoice_received.company_id
                	WHERE company.company_id = " . $company_id . " AND (invoice_received.company_id is null) AND (invoice_issued.company_id is null)";
        	$connectionDB->DbConnection->BeginTrans();
        	$connectionDB->DbConnection->execute($sql);

        	if ($connectionDB->DbConnection->CompleteTrans()){
						deleteFtpFile($dir);
						$this->company_id->Value = ($_SESSION['company_id'] = 0);
					}

				} else {
					$this->msgError->Value = SW_ERROR_DELETE_COMPANY_INVOICE;
				}

				$this->Reload_main();
      }
    }

    function Reload_main()
    {
        ?>
          <script type="text/javascript">
						window.parent.parent.location.reload();
          </script>
        <?php
        die;
    }


    function btnAddNoteJSClick($sender, $params)
    {
      $note = ' (' . $_SESSION['username'] . '):</b> <br/><br/><br/>';

        ?>
        //begin js
        var edit = findObj('notes_me');
        var xdate = new Date();
        var xday = xdate.getDate();
        var xmonth = (xdate.getMonth() +1);

        if (xday < 10) { xday = "0" + xday; }
        if (xmonth < 10) { xmonth = "0" + xmonth; }

        var xdatetime = " " + xdate.getFullYear() + "-" + xmonth + "-" + xday;
        var xchange = "<b>" + xdatetime + "<?php echo $note; ?>";
        edit.value = xchange + edit.value;
        tinyMCE.execInstanceCommand('notes_me', 'mceSetContent' , false, edit.value, true);
        //end
        <?php
    }


    function company_detailsShowHeader($sender, $params)
    {
      echo SW_HEADER_HTML;
      echo SW_HEADER_MEMO_HTML;

      //Button Save of Notes
      echo "<script type='text/javascript'>
							function ButtonSaveMemo(){
	    					btnCompanyClickHandler('btnCompany_btnSave', event);
							}
            </script>
			     ";
    }



    function btnCreateNewClick($sender, $params)
    {
      Global $password_user;

      if (!$record = sw_get_data_table('user', "username = '{$this->short_name->Text}'")) {
        $record = array();
        $record['username'] = $this->short_name->Text;
        $record['parent_user_id'] = 0;
        $record['password'] = $password_user;
        $record['can_see_companies_yn'] = 1;
        $record['can_see_employee_general_yn'] = 1;
        $record['can_modify_employee_payroll_yn'] = 1;
        $record['can_see_accounting_yn'] = 1;
        $record['can_see_tax_forms_yn'] = 1;
        $record['can_see_real_estate_yn'] = 1;
        $record['can_see_immigration_yn'] = 1;

        $roles[] = 'Client admin';
        $record['user_id'] =  sw_insert_user($record, $roles);
      }

      if ($record['user_id']){
        $record_company['user_id'] = $record['user_id'];
        sw_update_table('company', $record_company, "company_id = {$this->company_id->Value}");
        $this->user_id->SelectedValue = $record['user_id'];
      }
    }

/*    function pnContactsShow($sender, $params)
    {
      $this->pnContacts->Include = $this->company_id->Value ? 'contact.php' : '';
    }
*/

    function btnActivityJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbUpdateClientInvoiceMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = gridCompany_activity_code.getSelectedPrimaryKey();

          if (toolButton == 'btnActivity'){
            if (toolButtonName == 'btnDeleteActivity') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
          }
        //end
        <?php
    }

    function btnActivityClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if (($toolButtonName == "btnAdd") || ($toolButtonName == "btnEdit"))
      {
        $this->winCompanyTemp->Caption = 'Economic activity';
        $this->winCompanyTemp->Height = 160;
        $this->winCompanyTemp->Width = 440;
        $this->winCompanyTemp->Include = 'include/add_company_activity_code.php';
        $this->company_activity_code_id->Value = 0;
        if ($toolButtonName == "btnEdit") { $this->company_activity_code_id->Value = $this->gridCompany_activity_code->SelectedPrimaryKeys[0]; }
        $this->winCompanyTemp->ShowModal();
      }
      else if ($toolButtonName == "btnDeleteActivity")
      {
        sw_delete_record_grid($this->gridCompany_activity_code);
        $this->gridCompany_activity_code->writeSelectedCells(array());
      }
    }


    function ConstitutionView()
    {
      //Const 1 => 'CIF', 3 => 'Non-resident VAT'
      $record_country_specific = sw_get_data_table("company_country_specific", "(company_id = {$this->company_id->value})");
      $this->const_notary->Text = $record_country_specific['const_notary'];
      $this->tomo->Text = $record_country_specific['tomo'];
      $this->folio->Text = $record_country_specific['folio'];
      $this->hoja->Text = $record_country_specific['hoja'];
    }


    function gridCompany_activity_codeRowData($sender, $params)
    {
      $field = &$params[1];

      $field['end_dt'] = $field['end_dt'] == '0000-00-00' ? '' : $field['end_dt'];
    }

  	function cbAddressJSChange($sender, $params)
    {
			$component = array_keys(sw_get_data_table("regaddress", "", "regaddress_street_type_id, regaddress_street, regaddress_street_no, regaddress_floor, regaddress_door, regaddress_city, regaddress_province, regaddress_post_code, regaddress_country_id as country_id", 1, 1));
    	echo $this->cbAddress->ajaxCall("cbAddressChange", array(), $component);
				?>
        //begin js
        //end
        <?php
    }

    function cbAddressChange($sender, $params)
    {
      $address = sw_get_data_table("regaddress",
			  													 "regaddress_id = {$this->cbAddress->ItemIndex}",
																	 "regaddress_street_type_id, regaddress_street, regaddress_street_no, regaddress_floor, regaddress_door, regaddress_city, regaddress_province, regaddress_post_code, regaddress_country_id as country_id");

      foreach ($address as $key => $value){
      	eval("\$class = get_class(\$this->{$key});");
        $eval = "";
      	if ($class == 'JTLookupComboBox'){
        	$eval = "\$this->{$key}->SelectedValue = {$value};";
        }
        else{ //if (var_dump(property_exists($class, 'text'))){
        	$eval = "\$this->{$key}->Text = '{$value}';";
        }
        eval($eval);
      }
    }


}

global $application;

global $company_details;

//Creates the form
$company_details=new company_details($application);

//Read from resource file
$company_details->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company_details->show();

?>