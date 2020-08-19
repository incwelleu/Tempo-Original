<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
require_once("include/acceso.php");
require_once("include/accounting.php");
require_once("include/create_grid_column.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtdatepicker.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtradiobuttonlist.inc.php");

session_start();

//Class definition
class report_company_tax_model extends JTBasicPage
{
    public $cbYear = null;
    public $gridData = null;
    public $sqlCompany_tax_model = null;
    public $dsInvoice_accounting = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $pnParameter = null;
    public $lbMonth = null;
    public $btnViewdata = null;
    public $cbMonth = null;
    public $imXLS = null;

    function report_company_tax_modelCreate($sender, $params)
    {
      Global $MonthLetter;

      sw_style_selected($this);

      if ( !$this->cbMonth->inSession( '' ) ){
				$this->CreatedColumnGrid();

      	$this->cbMonth->Items = $MonthLetter;
      	$this->cbMonth->ItemIndex = date('m');

       $sql = "SELECT description_en AS year FROM `virtual_file`
               WHERE folder LIKE '%modelos%' AND parent_id != 0
               ORDER BY year desc";
       $record = sw_records_array($sql, array('year', 'year'));
      	$this->cbYear->Items = $record;
      	$this->cbYear->ItemIndex = date('Y')-1;
      }

      Define('COL_COMPANY', $this->gridData->findColumnByName('short_name'));
      Define('COL_TAX_MODEL', $this->gridData->findColumnByName('tax_model_id'));
      Define('COL_STATUS_CD', $this->gridData->findColumnByName('status_cd'));

      unset($_POST['imXLSSubmitEvent']);
    }

    function CreatedColumnGrid()
    {
      Global $lblName;
      $property = array(DEFAULT_FILTER => 'Equal', EDITOR_TYPE => 'Edit');
      $columns[] = sw_create_grid_column('short_name', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_TAX_MODEL,
                        DEFAULT_FILTER => 'Equal',
												EDITOR_TYPE => 'ComboBox',
                        WIDTH => 80);
      $columns[] = sw_create_grid_column('tax_model_name', $this->gridData, $property);
      $columns[] = sw_create_grid_column('status', $this->gridData);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                        CAPTION => SW_CAPTION_NOTES, MAX_LENGTH => 255, WIDTH => 200);
      $columns[] = sw_create_grid_column('notes', $this->gridData, $property);
      $property = array(DEFAULT_FILTER => 'Equal');
      $columns[] = sw_create_grid_column('accounting_provider_name', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_FREQUENCY,
                        DEFAULT_FILTER => 'Equal',
												EDITOR_TYPE => 'ComboBox',
                        WIDTH => 80);
      $columns[] = sw_create_grid_column('presentation_type_cd', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => $lblName,
                        DEFAULT_FILTER => 'Equal',
                        HYPER_LINK_FIELD => 'link',
                        WIDTH => 150);
      $columns[] = sw_create_grid_column('file_name', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_ADDRESS,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 200);
      $columns[] = sw_create_grid_column('address', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Notario',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 100);
      $columns[] = sw_create_grid_column('const_notary', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Tomo',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50);
      $columns[] = sw_create_grid_column('tomo', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Folio',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50);
      $columns[] = sw_create_grid_column('folio', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Hoja',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50);
      $columns[] = sw_create_grid_column('hoja', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                        CAN_MOVE => False,
                        CAN_FILTER => False,
                        ALIGNMENT => 'agCenter',
                        CAPTION => 'Fecha alta',
                        DEFAULT_FILTER => 'Contains',
                        DISPLAY => 'DateOnly',
                        FORMAT => 'Y-m-d',
                        TIME_FORMAT => 'tt24Hour',
                        WIDTH => 90);
      $columns[] = sw_create_grid_column('start_dt', $this->gridData, $property);
      $property[CAPTION] = 'Fecha baja';
      $columns[] = sw_create_grid_column('end_dt', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'IAE',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50);
      $columns[] = sw_create_grid_column('iae_cd', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Actividad',
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 250);
      $columns[] = sw_create_grid_column('economic_activity_name', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_BANK_ACCOUNT,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 150);
      $columns[] = sw_create_grid_column('account_number_cd', $this->gridData, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => SW_CAPTION_ONLINE_ACCESS,
                        DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES,
                        FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 100, CAN_EDIT => False );
      $columns[] = sw_create_grid_column('have_online_access_yn', $this->gridData, $property);

      $columns[] = sw_create_grid_column('link', $this->gridData);

      $property = array( TYPE_COLUMN => 'JTPlatinumGridTextColumn',
												CAN_MOVE => False,
                        CAPTION => SW_CAPTION_SHORT_NAME,
                        DEFAULT_FILTER => 'Equal',
                        VISIBLE => False,
                        WIDTH => 0);
      $columns[] = sw_create_grid_column('key_id', $this->gridData, $property);

      $this->gridData->Columns = $columns;
      $this->gridData->KeyField = 'key_id';
      $this->gridData->SortBy = 'short_name, file_name';
      $this->gridData->init();
    }


    function btnViewdataJSClick($sender, $params)
    {
        echo $this->btnViewdata->ajaxCall("btnViewdataClick", array(), array('gridData'));
        ?>
        //begin js
        gridData._showWaitWindow();
				return false;
        //end
        <?php
    }

    function btnViewdataClick($sender, $params)
    {
      Global $connectionDB, $period_type, $tax_model_state;

      $sql = "SELECT DISTINCT company.company_id, company.short_name,
                      company_tax_model.presentation_type_cd, vw_accountant_manager.accounting_provider_name,
                      tax_model.tax_model_name, company_tax_model.notes,
                      vw_company_activity.const_notary, vw_company_activity.tomo,
                      vw_company_activity.folio, vw_company_activity.hoja,
                      vw_company_activity.iae_cd, vw_company_activity.start_dt,
                      vw_company_activity.end_dt, vw_company_activity.economic_activity_name,
                      CONCAT(company_bank_account.iban_prefix_cd, ' ', company_bank_account.account_number_cd) as account_number_cd,
                      company_bank_account.have_online_access_yn
              FROM company
                  INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'
                  INNER JOIN company_tax_model
                  ON company.company_id = company_tax_model.company_id AND
                  	 company_tax_model.presentation_type_cd != 0 AND
                     company_tax_model.submit_tax_model_yn = 1
                  INNER JOIN tax_model ON company_tax_model.tax_model_id = tax_model.tax_model_id
                  LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id
                  LEFT JOIN vw_company_activity ON company.company_id = vw_company_activity.company_id AND vw_company_activity.main_activity_yn = 1
                  LEFT JOIN company_bank_account On company.company_id = company_bank_account.company_id AND is_primary_account_yn = 1
              WHERE (NOT company_tax_model.presentation_type_cd IS NULL) AND
                    (company_tax_model.presentation_type_cd = 1) OR
                    ((company_tax_model.presentation_type_cd = 12) AND (tax_model.month_of_presentation_cd like '%" . sprintf("%02d", $this->cbMonth->ItemIndex) . "%'))";

      $quarter_month = array(1,4,7,10);

      //Quarter, Annual, Semiannual
      if (in_array($this->cbMonth->ItemIndex, $quarter_month)) {
        $sql .= " OR (company_tax_model.presentation_type_cd = 3)";
//
//        if ($this->cbMonth->ItemIndex == 1) $sql .= " ";
//        if ($this->cbMonth->ItemIndex == 7) $sql .= " OR (company_tax_model.presentation_type_cd = 6) ";
      }

      $this->sqlCompany_tax_model->close();
      $this->sqlCompany_tax_model->SQL = $sql;
      $this->sqlCompany_tax_model->open();

      $sql_company = new query();
      $sql_company->Database = $connectionDB->DbConnection;
      $sql_company->LimitStart = -1;
      $sql_company->LimitCount = -1;

      $tax_model  = array();
      $tax_models = array();
      $counter = 1;

      While (!$this->sqlCompany_tax_model->EOF) {

        //Tax model type
        $model_type = "";
        $type = $this->sqlCompany_tax_model->Fields['presentation_type_cd'];

        $month = $this->cbMonth->ItemIndex == 1 ? 12 : $this->cbMonth->ItemIndex - 1;
        $year =  ($this->cbMonth->ItemIndex == 1) || ($type == 12)  ? $this->cbYear->Items[$this->cbYear->ItemIndex] - 1 : $this->cbYear->Items[$this->cbYear->ItemIndex];
        $date = "{$year}-{$month}-01";
        $quarter = sw_quarter_date($date);

        if ($type == 1) $model_type = sprintf("%02d", $month);
        else if ($type == 3) $model_type = "{$quarter}t";

        $sql_company->close();
        $sql  = "SELECT DISTINCT * FROM virtual_file
                  WHERE (virtual_file.company_id = {$this->sqlCompany_tax_model->Fields['company_id']}) AND
                        (virtual_file.link like '%/modelos/%') AND
                        (LOCATE(CONCAT('/', '{$this->sqlCompany_tax_model->Fields['tax_model_name']}', '/'), virtual_file.link) > 0) AND
                        (virtual_file.link like '%{$year}%') AND
                        (virtual_file.link like '%{$model_type}%')";
        $sql_company->SQL = $sql;
        $sql_company->open();

        $filename = "{$this->sqlCompany_tax_model->Fields['tax_model_name']} {$year} {$model_type} {$this->sqlCompany_tax_model->Fields['short_name']}";
        $tax_model['short_name'] = $this->sqlCompany_tax_model->Fields['short_name'];
        $tax_model['tax_model_name'] = $this->sqlCompany_tax_model->Fields['tax_model_name'];
        $tax_model['status'] = $sql_company->Fields['description_en'] ? $tax_model_state[1] : $tax_model_state[0];
        $tax_model['notes'] = $this->sqlCompany_tax_model->Fields['notes'];
        $tax_model['accounting_provider_name'] = $this->sqlCompany_tax_model->Fields['accounting_provider_name'];
        $tax_model['presentation_type_cd'] = $period_type[$this->sqlCompany_tax_model->Fields['presentation_type_cd']];
        $tax_model['file_name'] = $sql_company->Fields['description_en'] ? $sql_company->Fields['description_en'] : $filename;

        $address_company = sw_get_address_active_company($this->sqlCompany_tax_model->Fields['company_id']);
        $tax_model['address'] = $address_company['address'];

        $tax_model['const_notary'] = $this->sqlCompany_tax_model->Fields['const_notary'];
        $tax_model['tomo'] = $this->sqlCompany_tax_model->Fields['tomo'];
        $tax_model['folio'] = $this->sqlCompany_tax_model->Fields['folio'];
        $tax_model['hoja'] = $this->sqlCompany_tax_model->Fields['hoja'];
        $tax_model['iae_cd'] = $this->sqlCompany_tax_model->Fields['iae_cd'];
        $tax_model['start_dt'] = $this->sqlCompany_tax_model->Fields['start_dt'] ? $this->sqlCompany_tax_model->Fields['start_dt'] : '';
        $tax_model['end_dt'] = $this->sqlCompany_tax_model->Fields['end_dt'] ? $this->sqlCompany_tax_model->Fields['end_dt'] : '';
        $tax_model['economic_activity_name'] = $this->sqlCompany_tax_model->Fields['economic_activity_name'];
        $tax_model['account_number_cd'] = $this->sqlCompany_tax_model->Fields['account_number_cd'];
        $tax_model['have_online_access_yn'] = $this->sqlCompany_tax_model->Fields['have_online_access_yn'];

        $tax_model['link'] = $sql_company->Fields['link'];
        $tax_model['key_id'] = $counter;
        array_push($tax_models, $tax_model);

        $counter++;
        $this->sqlCompany_tax_model->next();
      }
      $this->gridData->CellData = $tax_models;
    }

    function gridDataJSSelect($sender, $params)
    {
        $link = $_SERVER["SCRIPT_URI"];
        ?>
        //begin js
          var a = getEventTarget(event);

          if (a.href.indexOf('undefined') != -1) return true;

          if (a.tagName == "A"){
             if (a.href == "<?php echo $link;?>") return false;
             else a.target = "_blank";
          }
        //end
        <?php
    }


    function imXLSClick($sender, $params)
    {
      $this->gridData->exportGridToXLSDownload("Company Tax model.xls", 'Company Tax Model', true);
    }



    function gridDataRowData($sender, $params)
    {
      $fields = &$params[ 1 ];
      $fields['start_dt'] = $fields['start_dt'] == '0000-00-00' ? '' : $fields['start_dt'];
      $fields['end_dt'] = $fields['end_dt'] == '0000-00-00' ? '' : $fields['end_dt'];
    }


}

global $application;

global $report_company_tax_model;

//Creates the form
$report_company_tax_model=new report_company_tax_model($application);

//Read from resource file
$report_company_tax_model->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $report_company_tax_model->show();

?>