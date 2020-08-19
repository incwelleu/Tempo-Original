<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");


session_start();

//Class definition
class company_tax_model extends fmstrong
{
    public $ImageList = null;
    public $sqlVirtual_file = null;
    public $dsVirtual_file = null;
    public $btnTaxModel = null;
    public $SiteTheme = null;
    public $gridCompany_tax_model = null;
    public $sqlCompany_tax_model = null;
    public $dsCompany_tax_model = null;
    public $gridVirtual_file = null;
    public $tax_model_id = null;
    public $winAddTaxModel = null;
    public $SelectedKeysField = null;

    function company_tax_modelCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterCompanyTaxModel();
    }

    function ParameterCompanyTaxModel()
    {
      $company_id = $_SESSION['company_id'];
      $this->lbTitle->Caption = Title_TaxModel . (($company_id != 0) ? " (" . $_SESSION['short_name'] . ")" : "");
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, $company_id, "2");
      $items['btnDelete'] = array(btnDelete, $company_id, "6");
      $items['btnEdit'] = array(btnEdit, $company_id, "3");
      $items['btnSave'] = array(btnSave, $company_id, "5");
      $items['btnCancel'] = array(btnCancel, $company_id, "4");
      $items['btnUnMarkTaxModel'] = array(btnUnMarkTaxModel, $company_id);

      $this->btnTaxModel->Items = $items;

      Define('COL_PRESENTATION_TYPE', $this->gridCompany_tax_model->findColumnByName('presentation_type_cd'));
      Define('COL_TAX_MODEL', $this->gridCompany_tax_model->findColumnByName('tax_model_id'));
      Define('COL_TAX_MODEL_LINK', $this->gridVirtual_file->findColumnByName('name'));
    }

    function company_tax_modelShow($sender, $params)
    {
      if (isset($_POST['btnClose']) || ($_POST['btnSaveSubmitEvent'] === "btnSave_btnSaveClick")){
        unset($_POST['btnSaveSubmitEvent']);
        $this->winAddTaxModel->Hide();
      }
    }

    function gridCompany_tax_modelSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT company_tax_model.*, tax_model.tax_model_name, tax_model.description
              FROM company_tax_model
              INNER JOIN (SELECT tax_model_id, tax_model_name, tax_model.description FROM tax_model) AS tax_model ON company_tax_model.tax_model_id = tax_model.tax_model_id
              WHERE (company_id = {$_SESSION['company_id']})";

      $filterSql = $this->FilterPresentation_Type($filterSql);

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlCompany_tax_model->SQL = $sql;
    }


    function FilterPresentation_Type(&$filterSql)
    {
      $Column = $this->gridCompany_tax_model->Columns[$this->gridCompany_tax_model->findColumnByFieldName('presentation_type_cd')];
      if (($Column->Filter))
      {
        Global $period_type;

        $index = (string)array_search($Column->Filter, $period_type);
        $value = $period_type[$index];
        $filterSql = str_replace($value, $index, $filterSql);
      }

      return $filterSql;
    }



    function gridCompany_tax_modelShow($sender, $params)
    {
      Global $period_type;

      //Column Country
      $this->gridCompany_tax_model->Columns[COL_PRESENTATION_TYPE]->ComboBoxEditor->Values = $period_type;
      $this->gridCompany_tax_model->Columns[COL_PRESENTATION_TYPE]->FilterOptions = $period_type;
    }


    function gridCompany_tax_modelRowData($sender, $params)
    {
      Global $period_type;

      $fields = &$params[ 1 ];

      $fields[ "presentation_type_cd" ] = $period_type[$fields['presentation_type_cd']];
    }

    function btnTaxModelJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];

          if (toolButton == 'btnTaxModel'){
        		if (toolButtonName == 'btnFilter') {
          		gridCompany_tax_model.deselectAll();
							gridCompany_tax_model._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridCompany_tax_model->ajaxCall('filter_grid', array(), array($this->gridCompany_tax_model->Name)); ?>
          		return false;
        		}
          	else if ((toolButtonName == 'btnDelete') || (toolButtonName == 'btnUnMarkTaxModel')) {
            	var keys = [];
            	for (var row in gridCompany_tax_model.SelectedCells) {
              	if (typeof(gridCompany_tax_model.SelectedCells[row]) != "function" &&
                		(gridCompany_tax_model.SelectedCells[row] != '') &&
                    (gridCompany_tax_model.SelectedCells[row] != null)) {
                  keys.push(gridCompany_tax_model.getPrimaryKey(row));
              	}
            	}

            	if (findObj('SelectedKeysField').value = keys.join(',')){
              	if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
              	else if (toolButtonName == 'btnUnMarkTaxModel') { return true ;}
            	}
            	return false;
          	}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridCompany_tax_model.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridCompany_tax_model.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany_tax_model.Post(); return false;}
          }
        //end
        <?php
    }

    function btnTaxModelClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == 'btnFilter') {
        sw_view_filter_grid($this->gridCompany_tax_model);
      }
      else if ($toolButtonName == "btnAdd") {
        $this->winAddTaxModel->Height = 390;
        $this->winAddTaxModel->Width = 650;
        $this->winAddTaxModel->Include = 'include/add_company_tax_model.php';
        $this->winAddTaxModel->ShowModal();
      }
      else if ($toolButtonName == "btnDelete"){
        sw_delete_record_grid($this->gridCompany_tax_model);
      }
      else if ($toolButtonName == "btnUnMarkTaxModel"){
        $this->UnMarckTaxModels();
      }
    }

		function UnMarckTaxModels()
    {
    	if ($this->SelectedKeysField->Value){
    		Global $connectionDB;

      	$sql = "UPDATE company_tax_model
      					SET submit_tax_model_yn = !submit_tax_model_yn
              	WHERE (company_id = {$_SESSION['company_id']}) AND (company_tax_model_id in ({$this->SelectedKeysField->Value}))";
      	$connectionDB->DbConnection->BeginTrans();
      	$connectionDB->DbConnection->execute($sql);
      	$connectionDB->DbConnection->CompleteTrans();
      	$this->gridCompany_tax_model->writeSelectedCells(array());
      }
    }

    function gridCompany_tax_modelJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        var cellvalue = gridCompany_tax_model.getCellText(rowIndex, <?php echo COL_PRESENTATION_TYPE;?>);
        var objComboBox = document.getElementById("gridCompany_tax_model_presentation_type_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);
        //end
        <?php
    }


    function gridVirtual_fileSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT DISTINCT tax_model_id, virtual_file.company_id,
                    virtual_file.nodo_id, virtual_file.description_en AS name,
                    virtual_file.created_dt, virtual_file.link
              FROM virtual_file
              INNER JOIN tax_model on (LOCATE(CONCAT('/', tax_model.tax_model_name, '/'), virtual_file.link) > 0)
              WHERE (virtual_file.link like '%/modelos/%') AND (company_id = {$_SESSION['company_id']}) AND
                    (tax_model_id = {$this->tax_model_id->Value})";

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlVirtual_file->SQL = $sql;
    }


    function gridCompany_tax_modelJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("tax_model_id").value =  gridCompany_tax_model.getCellText(row, <?php echo COL_TAX_MODEL; ?>);
        //end
        <?php
    }

    function gridVirtual_fileJSSelect($sender, $params)
    {
        ?>
        //begin js
        var a = getEventTarget(event);
        if (a.tagName == "A"){
          a.target = "_blank";
        }
        //end
        <?php
    }

}

global $application;

global $company_tax_model;

//Creates the form
$company_tax_model=new company_tax_model($application);

//Read from resource file
$company_tax_model->loadResource(__FILE__);

//Shows the form
if (isset($_SESSION['username'])) $company_tax_model->show();

?>