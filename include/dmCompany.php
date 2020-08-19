<?php
require_once("rpcl/rpcl.inc.php");

//Includes
use_unit("db.inc.php");
use_unit("dbtables.inc.php");
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");

session_start();

//Class definition
class dmCompany extends DataModule
{
    public $sqlStreet_type = null;
    public $dsStreet_type = null;
    public $vw_payroll_manager = null;
    public $dsPayroll_manager = null;
    public $vw_accountant_manager = null;
    public $dsAccountant_manager = null;
    public $vw_account_manager = null;
    public $dsAccount_manager = null;
    public $sqlCountry = null;
    public $dsCountry = null;
    public $dsPayment_method = null;
    public $sqlPayment_method = null;
    public $sqlUser = null;
    public $dsUser = null;

    function Table_open()
    {
      Global $language;

      //Query with country language
      $this->sqlCountry->Active = False;
      $this->sqlCountry->SQL = "SELECT country_id, {$language} as country_name FROM country ORDER BY {$language}";
      $this->sqlCountry->Active = True;

      //Query with Payment method language
			$billing_entity_id = $_SESSION['settings']['billing_entity_id'] ? $_SESSION['settings']['billing_entity_id'] : 1;
			$sql = "SELECT payment_method_id, {$language} as payment_method_name
							FROM payment_method
							WHERE billing_entity_id = {$billing_entity_id}
							ORDER BY {$language}";
      $this->sqlPayment_method->Active = False;
      $this->sqlPayment_method->SQL = $sql;
      $this->sqlPayment_method->Active = True;

      $this->sqlUser->refresh();
    }


}

global $application;

global $dmCompany;

//Creates the form
$dmCompany=new dmCompany($application);

//Read from resource file
$dmCompany->loadResource(__FILE__);

?>