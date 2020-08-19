<?php
require_once("rpcl/rpcl.inc.php");
require_once("functions.php");
require_once("acceso.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");

session_start();

//Class definition
class add_company_tax_model extends Page
{
    public $btnClose = null;
    public $btnSave = null;
    public $gridTax_model = null;
    public $SiteTheme = null;

    function add_company_tax_modelCreate($sender, $params)
    {
      sw_style_selected($this);
    }

    function add_company_tax_modelShow($sender, $params)
    {
      $sql = "SELECT tax_model.*, tax_regime.regime_name
              FROM tax_model
                  INNER JOIN tax_regime ON tax_model.tax_regime_id = tax_regime.tax_regime_id
                  LEFT JOIN (SELECT * FROM company_tax_model WHERE company_id = {$_SESSION['company_id']}) as company_tax_model
                  ON tax_model.tax_model_id = company_tax_model.tax_model_id
              WHERE tax_regime.country_id = {$_SESSION['country_id']} AND (company_tax_model.company_tax_model_id IS NULL)
              ORDER BY tax_model_name ";
      $field = array('tax_model_id', 'tax_model_name', 'regime_name', 'description', 'presentation_type_cd');
      $this->gridTax_model->CellData = sw_records_array($sql, $field);
    }

    function btnSaveClick($sender, $params)
    {
			Global $company_tax_model;

      if ((count($this->gridTax_model->SelectedPrimaryKeys) > 0)) {
        $keys = implode(",", $this->gridTax_model->SelectedPrimaryKeys);
        $sql = "INSERT INTO company_tax_model (tax_model_id, company_id, presentation_type_cd)
                SELECT tax_model_id, {$_SESSION['company_id']}, presentation_type_cd
                FROM tax_model
                WHERE tax_model_id in ({$keys})";

        Global $connectionDB;
        $connectionDB->DbConnection->execute($sql);

        //Refresh;
      	?>
        	<script type="text/javascript">gridCompany_tax_model.Refresh(); </script>
      	<?php

				$company_tax_model->winAddTaxModel->Hide();
      }

    }


}

global $application;

global $add_company_tax_model;

//Creates the form
$add_company_tax_model=new add_company_tax_model($application);

//Read from resource file
$add_company_tax_model->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $add_company_tax_model->show();

?>