<?php
require_once("rpcl/rpcl.inc.php");
require_once("functions.php");
require_once("acceso.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("components4phpfull/jtdatepicker.inc.php");

session_start();

//Class definition
class add_company_activity_code extends Page
{
    public $start_dt = null;
    public $cnae_code_id = null;
    public $activity_code_id = null;
    public $lbEconomic_activity = null;
    public $lbCNAE = null;
    public $SiteTheme = null;
    public $main_activity_yn = null;
    public $btnClose = null;
    public $btnSave = null;
    public $lbStart_dt = null;
    public $lbEnd_dt = null;
    public $end_dt = null;

    function add_company_activity_codeCreate($sender, $params)
    {
      Global $company_details;

      $sql = "SELECT activity_code_id, concat(iae_cd, ' ', description) AS description FROM activity_code WHERE (country_id = {$_SESSION['country_id']}) ORDER BY concat(iae_cd, ' ', description)";
      $record = sw_records_array($sql, array('activity_code_id', 'description'));
      $record[0] = "";
      $this->activity_code_id->Items = $record;
      $sql = "SELECT cnae_code_id, concat(cnae_cd, ' ', description) AS description FROM cnae_code WHERE (country_id = {$_SESSION['country_id']}) ORDER BY concat(cnae_cd, ' ', description)";
      $record = sw_records_array($sql, array('cnae_code_id', 'description'));
      $record[0] = "";
      $this->cnae_code_id->Items = $record;

      $this->activity_code_id->ItemIndex = 0;
      $this->cnae_code_id->ItemIndex = 0;
      $this->start_dt->Date = '';
      $this->end_dt->Date = '';

      if (!isset($_REQUEST['btnSaveSubmitEvent']) &&
      	 ($record = sw_get_data_table('company_activity_code', "(company_id = {$_SESSION['company_id']}) AND (company_activity_code_id = {$company_details->company_activity_code_id->Value})"))){
        $this->activity_code_id->ItemIndex = $record['activity_code_id'];
        $this->cnae_code_id->ItemIndex = $record['cnae_code_id'];
        $this->main_activity_yn->Checked = $record['main_activity_yn'];
        $this->start_dt->Date = $record['start_dt'];
        $this->end_dt->Date = $record['end_dt'] != '0000-00-00' ? $record['end_dt'] : '';
      }
    }



    function btnSaveClick($sender, $params)
    {
      If ($this->activity_code_id->ItemIndex) {
        Global $company_details;

        $record['company_id'] = $_SESSION['company_id'];
        $record['activity_code_id'] = $this->activity_code_id->ItemIndex;
        $record['cnae_code_id'] = $this->cnae_code_id->ItemIndex;
        $record['main_activity_yn'] = $this->main_activity_yn->Checked;
        $record['start_dt'] = $this->start_dt->Date;
        $record['end_dt'] = $this->end_dt->Date;


        if ((!$this->main_activity_yn->Checked) && (!sw_get_data_table('company_activity_code', "(company_id = {$_SESSION['company_id']}) AND (main_activity_yn = True) AND (company_activity_code_id != {$company_details->company_activity_code_id->Value})"))){
          $record['main_activity_yn'] = !$this->main_activity_yn->Checked;
        }

        If ($this->main_activity_yn->Checked) {
          Global $connectionDB;
          $sql = "UPDATE company_activity_code SET main_activity_yn = 0
                  WHERE company_id = {$_SESSION['company_id']}";
          $connectionDB->DbConnection->execute($sql);
        }

        if (!$company_details->company_activity_code_id->Value) sw_insert_table('company_activity_code', $record);
        else sw_update_table('company_activity_code', $record, "(company_id = {$_SESSION['company_id']}) AND (company_activity_code_id = {$company_details->company_activity_code_id->Value})");

        ?>
           <script type="text/javascript">
            gridCompany_activity_code.Refresh();
           </script>
        <?php
      }
    }

    function btnSaveJSClick($sender, $params)
    {
      Global $lbSelectValue;
        ?>
        //begin js
        var start_dt = document.getElementById("start_dt").value;

        if (start_dt.length<1) {
            alert("<?php echo $lbSelectValue . ' ' . $this->lbStart_dt->Caption ?> ");
            start_dt.focus;
            return false;
        }

        return true;
        //end
        <?php
    }


}

global $application;

global $add_company_activity_code;

//Creates the form
$add_company_activity_code=new add_company_activity_code($application);

//Read from resource file
$add_company_activity_code->loadResource(__FILE__);

//Shows the form
if (isset($_SESSION['username'])) $add_company_activity_code->show();

?>