<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/acceso.php");
require_once("include/functions.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");

//Class definition
class company_parameter extends JTBasicPage
{
    public $accountant_period_last_closed_dt = null;
    public $lbAccountant_period_last_closed_dt = null;
    public $lbDefault_tax_rate = null;
    public $lbAccount_affected_not_subjet = null;
    public $account_affected_not_subjet_tax = null;
    public $lbAccount_endured_not_subjet_tax = null;
    public $account_endured_not_subjet_tax = null;
    public $rowCompanyTax = null;
    public $btnSave_parameter_accounting = null;
    public $btnClose_parameter_accounting = null;
    public $ImageList = null;
    public $dsTax_regime = null;
    public $sqlTax_regime = null;
    public $sqlCompany_tax = null;
    public $dsCompany_tax = null;
    public $sqlCompany_accounting = null;
    public $dsCompany_accounting = null;
    public $SiteTheme = null;
    public $cbDefault_account = null;
    public $account_sale = null;
    public $lbAccount_sale = null;
    public $lbAccount_sale_within_europe = null;
    public $account_sale_within_europe = null;
    public $lbAccount_sale_outside_europe = null;
    public $account_sale_outside_europe = null;
    public $lbAccount_transport = null;
    public $account_transport = null;
    public $lbOther_income = null;
    public $account_other_income = null;
    public $account_client = null;
    public $lbAccount_client = null;
    public $lbAccount_provider = null;
    public $account_provider = null;
    public $lbaccount_client_withholding = null;
    public $account_client_withholding = null;
    public $gridCompany_tax = null;
    public $btnCompanyTax = null;
    public $tax_regime_id = null;
    public $lbTax_regime = null;
    public $lbDigit_account = null;
    public $tax_rate_id = null;
    public $digit_account = null;

    function company_parameterCreate($sender, $params)
    {
      sw_style_selected($this);
    }

    function company_parameterShow($sender, $params)
    {
      $this->ParameterCompany_parameter();
    }

    function ParameterCompany_parameter()
    {
      Global $company;

      if ($company_id = $company->company_id->Value) {
        $record_accounting = sw_get_company_accounting($company_id);

        if (($company_id != 0) && (!$record_accounting['company_id'])){
          //Erase position 0, 1 of array
          $record = array_slice($record_accounting, 0, 2);
          $record_accounting = array_slice($record_accounting, 2);

          $record_accounting['company_id'] = $company_id;
          $record_accounting['tax_rate_id'] = '0';
          $record_accounting['digit_account'] = GLOBAL_DIGIT_ACCOUNT;
          $record_accounting['accountant_period_last_closed_dt'] = date('Y-m-d');

          $record_accounting['account_client'] = GLOBAL_ACCOUNT_CLIENT;
          $record_accounting['account_sale'] = GLOBAL_ACCOUNT_SALE;
          $record_accounting['account_client_withholding'] = GLOBAL_ACCOUNT_CLIENT_WITHHOLDING;

          $record_accounting['account_provider'] = GLOBAL_ACCOUNT_PROVIDER;

          //Insert record
          sw_insert_table("company_accounting", $record_accounting);
          $record_accounting = array_merge($record, $record_accounting);
        }

        //Insert registre company_tax
        if ($company_id){
          sw_insert_company_tax($company_id);
        }

        $this->sqlTax_regime->Filter = 'country_id = ' . $record_accounting['country_id'];
        $this->sqlTax_regime->refresh();
        $this->tax_regime_id->SelectedValue = $record_accounting['tax_regime_id'];

        $sql = "SELECT tax_rate.*
                FROM tax_rate INNER JOIN tax_regime
                      ON tax_rate.tax_regime_id = tax_regime.tax_regime_id
                WHERE country_id = {$record_accounting['country_id']}
                ORDER BY tax_rate.rate_no";
        $this->tax_rate_id->Items = sw_records_array($sql, array("tax_rate_id","rate_no"));

        if (($_POST['btnCompanySubmitEvent']!=='btnCompany_btnSave')) {
          $this->tax_rate_id->ItemIndex = $record_accounting['tax_rate_id'];

          $this->digit_account->Text = $record_accounting['digit_account'];
          $this->accountant_period_last_closed_dt->Date = $record_accounting['accountant_period_last_closed_dt'] ? $record_accounting['accountant_period_last_closed_dt'] : null;
          $this->account_client->text = $record_accounting['account_client'];
          $this->account_provider->text = $record_accounting['account_provider'];
          $this->account_sale->text = $record_accounting['account_sale'];
          $this->account_sale_within_europe->text = $record_accounting['account_sale_within_europe'];
          $this->account_sale_outside_europe->text = $record_accounting['account_sale_outside_europe'];
          $this->account_other_income->text = $record_accounting['account_other_income'];
          $this->account_transport->text = $record_accounting['account_transport'];
          $this->account_client_withholding->text = $record_accounting['account_client_withholding'];
          $this->account_affected_not_subjet_tax->text = $record_accounting['account_affected_not_subjet_tax'];
          $this->account_endured_not_subjet_tax->text = $record_accounting['account_endured_not_subjet_tax'];
        }
      }
    }

    function gridCompany_taxSQL($sender, $params)
    {
      Global $company;
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $company_id = $company->company_id->Value ? $company->company_id->Value : 0;

      $sql = "SELECT company_tax.*, tax_rate.rate_no, tax_rate.apply_of_tax_dt " .
              "FROM company_tax INNER JOIN tax_rate ON company_tax.tax_rate_id = tax_rate.tax_rate_id " .
              "WHERE company_id = " . $company_id .
              " ORDER BY " . $sortSql;

      $this->sqlCompany_tax->SQL = $sql;
    }

    function gridCompany_taxUpdate($sender, $params)
    {
      $company_tax_id = $params[ 0 ];
      $fields = &$params[ 1 ];

      //checked account
      $digito_account = $this->digit_account->Text;
      $fields['account_paid'] = $fields['account_paid'] ? sw_check_account($fields['account_paid'], $digito_account) : "";
      $fields['account_paid_taxable_person'] = $fields['account_paid_taxable_person'] ? sw_check_account($fields['account_paid_taxable_person'], $digito_account) : "";
      $fields['account_paid_within_europe'] = $fields['account_paid_within_europe'] ? sw_check_account($fields['account_paid_within_europe'], $digito_account) : "";
      $fields['account_paid_outside_europe'] = $fields['account_paid_outside_europe'] ? sw_check_account($fields['account_paid_outside_europe'], $digito_account) : "";
      $fields['account_paid_adqusicion_good'] = $fields['account_paid_adqusicion_good'] ? sw_check_account($fields['account_paid_adqusicion_good'], $digito_account) : "";
      $fields['account_received'] = $fields['account_received'] ? sw_check_account($fields['account_received'], $digito_account) : "";
      $fields['account_received_taxable_person'] = $fields['account_received_taxable_person'] ? sw_check_account($fields['account_received_taxable_person'], $digito_account) : "";
      $fields['account_received_within_europe'] = $fields['account_received_within_europe'] ? sw_check_account($fields['account_received_within_europe'], $digito_account) : "";
      $fields['account_received_outside_europe'] = $fields['account_received_outside_europe'] ? sw_check_account($fields['account_received_outside_europe'], $digito_account) : "";
      $fields['account_received_adqusicion_good'] = $fields['account_received_adqusicion_good'] ? sw_check_account($fields['account_received_adqusicion_good'], $digito_account) : "";

      sw_update_table("company_tax", $fields, "company_tax_id = {$company_tax_id}");
    }

    function gridCompany_taxJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowCompanyTax").value = row;
        //end
        <?php
    }

    function btnCompanyTaxJSClick($sender, $params)
    {
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowCompanyTax").value

          if (toolButton == 'btnCompanyTax'){
            if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridCompany_tax.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridCompany_tax.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany_tax.Post(); return false;}
          }
        //end
        <?php
    }

    function btnSave_parameter_accountingClick($sender, $params)
    {
      $this->Save_accounting();
    }

    function Save_accounting()
    {
      Global $company;

      $record_accounting['digit_account'] = $this->digit_account->text;
      $record_accounting['tax_rate_id'] = $this->tax_rate_id->ItemIndex;
      $record_accounting['accountant_period_last_closed_dt'] = $this->accountant_period_last_closed_dt->Date;
      $record_accounting['account_client'] = $this->account_client->text ? sw_check_account($this->account_client->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_sale'] = $this->account_sale->text ? sw_check_account($this->account_sale->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_sale_within_europe'] = $this->account_sale_within_europe->text ? sw_check_account($this->account_sale_within_europe->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_sale_outside_europe'] = $this->account_sale_outside_europe->text ? sw_check_account($this->account_sale_outside_europe->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_other_income'] = $this->account_other_income->text ? sw_check_account($this->account_other_income->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_transport'] = $this->account_transport->text ? sw_check_account($this->account_transport->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_client_withholding'] = $this->account_client_withholding->text ? sw_check_account($this->account_client_withholding->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_provider'] = $this->account_provider->text ? sw_check_account($this->account_provider->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_affected_not_subjet_tax'] = $this->account_affected_not_subjet_tax->text ? sw_check_account($this->account_affected_not_subjet_tax->text, $record_accounting['digit_account']) : "";
      $record_accounting['account_endured_not_subjet_tax'] = $this->account_endured_not_subjet_tax->text ? sw_check_account($this->account_endured_not_subjet_tax->text, $record_accounting['digit_account']) : "";

      $where = "company_id = " . $company->company_id->Value;
      sw_update_table("company_accounting", $record_accounting, $where);

      $record['tax_regime_id'] = $this->tax_regime_id->SelectedValue;
      sw_update_table("company", $record, $where);

      unset($_REQUEST['btnSave_parameter_accountingSubmitEvent']);
    }

    function btnClose_parameter_accountingClick($sender, $params)
    {
      Global $company;

      unset($_REQUEST['btnClose_parameter_accounting']);
    }
}

global $application;

global $company_parameter;

//Creates the form
$company_parameter=new company_parameter($application);

//Read from resource file
$company_parameter->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $company_parameter->show();

?>