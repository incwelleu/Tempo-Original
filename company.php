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
use_unit("components4phpfull/jttabcontrol.inc.php");
use_unit("components4phpfull/jtiframe.inc.php");

define('TAB_DETAILS', 0);
define('TAB_CONTACT', 1);
define('TAB_TAXMODEL', 2);

session_start();

//if (!$_SESSION['IsSuperadmin'] && !$_SESSION['IsProvider']) { redirect_url('company_details.php'); }

//Class definition
class company extends fmstrong
{
    public $active_tab = null;
    public $fmCompany = null;
    public $SiteTheme = null;
    public $CheckBox1 = null;
    public $TabCompany = null;
    public $company_id = null;

    function companyCreate($sender, $params)
    {
      Global $StyleTheme;

      $this->SiteTheme->Theme = $StyleTheme;

      $this->ParameterCompany();
    }

    function ParameterCompany()
    {
    	Global $SW_COMPANY_TAB;

      $this->lbTitle->Caption = Title_Company . (($_SESSION['company_id']!=0) ? " (" . $_SESSION['short_name'] . ")" : "");
      $this->lbTitle->Visible = True;

      //Oculto los Tab para los clientes;
      if (!$this->TabCompany->inSession('')){
      	$tab_active = array();
      	foreach ($SW_COMPANY_TAB as $Tab){
        	if ($Tab[2]){ $tab_active[] = $Tab; }
      	}
				$this->TabCompany->Tabs = $tab_active;
      }

      if (isset($_SESSION['company_id']) && $this->company_id->Value != $_SESSION['company_id']){
      	$this->company_id->Value = $_SESSION['company_id'];
        $this->TabCompany->TabIndex = 0;
        $this->TabChange();
      }
    }

    function TabCompanyJSChange($sender, $params)
    {
			echo $this->TabCompany->ajaxCall("TabChange");
        ?>
        //begin js
				return false;
        //end
        <?php
    }

    function TabChange()
    {
    	Global $SW_COMPANY_TAB;

      $this->TabCompany->TabIndex = $this->TabCompany->TabIndex;
      $this->active_tab->Value = $this->TabCompany->Tabs[$this->TabCompany->TabIndex][1];

      if ($this->active_tab->Value == 'TabDetails'){
      	$this->fmCompany->URL = 'company_details.php';
      }else if ($this->active_tab->Value == 'TabInvoiceAddress'){
      	$_SESSION['page_return'] = 'company_client_edit.php';
      	$_SESSION['selected_company_id'] = $_SESSION['settings']['company_id'];
        $_SESSION['selected_company_client_id'] = 0;
        if ($record = sw_get_data_table("vw_company_client_strong", "company_id = {$_SESSION['company_id']} AND company_strong_id = {$_SESSION['selected_company_id']}")){
        	$_SESSION['selected_company_client_id'] = $record['company_client_id'];
        }
      	$this->fmCompany->URL = 'company_client_edit.php';
      }else if ($this->active_tab->Value == 'TabContacts'){
      	$this->fmCompany->URL = 'contact.php';
      }else if ($this->active_tab->Value == 'TabBankAccounts'){
      	$this->fmCompany->URL = 'company_bank_account.php';
      }else if ($this->active_tab->Value == 'TabTaxModels'){
      	$this->fmCompany->URL = 'company_tax_model.php';
      }else if ($this->active_tab->Value == 'TabAccounting'){
      	$this->fmCompany->URL = 'company_tax_account.php';
      }

    }

}

global $application;

global $company;

//Creates the form
$company=new company($application);

//Read from resource file
$company->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company->show();

?>