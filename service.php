<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');

//Class definition
class service extends fmstrong
{
    public $SelectedKeysField = null;
    public $sqlService_category = null;
    public $dsService_category = null;
    public $sqlService = null;
    public $dsService = null;
    public $gridService = null;
    public $ImageList = null;
    public $btnService = null;
    public $SiteTheme = null;

    function serviceCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->Parameter();
    }

    function Parameter()
    {
      $this->lbTitle->Caption = Title_Service;
      $this->lbTitle->Visible = True;

      if (!$this->gridService->inSession('')){
				$this->CreatedColumnGridService();
      }

      Define('COL_CATEGORY', $this->gridService->findColumnByName('service_category_id'));
      Define('COL_SERVICE_TYPE', $this->gridService->findColumnByName('service_type_id'));
      Define('COL_SERVICE_ID', $this->gridService->findColumnByName('service_id'));

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "9");
      $items['btnAdd'] = array(btnAdd, 1, "2");
      $items['btnDelete'] = array(btnDelete, 1, "6");
      $items['btnEdit'] = array(btnEdit, 1, "3");
      $items['btnSave'] = array(btnSave, 1, "5");
      $items['btnCancel'] = array(btnCancel, 1, "4");
      $items['btnExportXLS'] = array(btnExportXLS, 1, "10");

      $this->btnService->Items = $items;
    }


    function CreatedColumnGridService()
    {
      GLOBAL $language, $GRID_COLUMN;

      $property = array(DATA_FIELD => 'service_category_id', 'Name' => 'service_category_id');
      $columns[] = sw_create_grid_column('service_category_name', $this->gridService, $property);

      $property = array(DATA_FIELD => 'service_type_id', 'Name' => 'service_type_id');
      $columns[] = sw_create_grid_column('service_type_name', $this->gridService, $property);

			$property = array(DATA_FIELD => 'description_en', 'Name' => 'description_en');
      $columns[] = sw_create_grid_column('description', $this->gridService, $property);

      $columns[] = sw_create_grid_column('price_amt', $this->gridService);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
      								  CAPTION => SW_CAPTION_NOTES, MAX_LENGTH => 255, WIDTH => 150);
      $columns[] = sw_create_grid_column('notes', $this->gridService, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agRight',
      								  CAPTION => SW_CAPTION_SORT_NO, MAX_LENGTH => 5, WIDTH => 50);
      $columns[] = sw_create_grid_column('sort_no', $this->gridService, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => SW_CAPTION_SORT_SERVICE_AGREEMENT_YN, DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 120 );
      $columns[] = sw_create_grid_column('sort_service_agreement_yn', $this->gridService, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => SW_CAPTION_SUPPLEMENT_YN, DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 100 );
      $columns[] = sw_create_grid_column('with_supplement_yn', $this->gridService, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => 'Old?', DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        ALIGNMENT => 'agCenter', WIDTH => 40 );
      $columns[] = sw_create_grid_column('old_yn', $this->gridService, $property);

			$property = $GRID_COLUMN['commission_amt'];
			$property[CAN_EDIT] = True;
      $columns[] = sw_create_grid_column('commission_amt', $this->gridService, $property);

      $property = array(DATA_FIELD => 'future_commission_amt', 'Name' => 'future_commission_amt',
                        CAPTION => SW_CAPTION_FUTURE_COMMISSION);
      $columns[] = sw_create_grid_column('commission_amt', $this->gridService, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', ALIGNMENT => 'agRight',
                        CAN_MOVE => False,
                        CAPTION => SW_CAPTION_NUMMER_MONTH,
                        DEFAULT_FILTER => 'Equal',
                        DATA_FORMAT => '%01.0f',
                        WIDTH => 70, SHOW_SUM => True);
      $columns[] = sw_create_grid_column('future_commission_months_no', $this->gridService, $property);
      $columns[] = sw_create_grid_column('service_id', $this->gridService);

      $this->gridService->Columns = $columns;
      $this->gridService->KeyField = 'service_id';
      $this->gridService->SortBy = 'service_category_id, old_yn, sort_no';
      $this->gridService->init();
    }


    function btnServiceJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
        var info = getEventTarget( event ).id.split( "_" );
        var toolButton = info[ 0 ];
        var toolButtonName = info[ 1 ];

        if (toolButton == 'btnService'){
        	if (toolButtonName == 'btnFilter') {
          	gridService.deselectAll();
						gridService._showWaitWindow();
          	params = [0];
        		<?php echo $this->gridService->ajaxCall('filter_grid', array(), array($this->gridService->Name)); ?>
          	return false;
        	}
        	else if (toolButtonName == 'btnAdd') { gridService.Insert(); return false;}
          else if (toolButtonName == 'btnCancel') { gridService.Cancel(); return false;}
          else if (toolButtonName == 'btnSave') { gridService.Post(); return false;}
          else if ((toolButtonName == 'btnDelete') || (toolButtonName == 'btnEdit')){
            var keys = [];
            for (var row in gridService.SelectedCells) {
              if (typeof(gridService.SelectedCells[row]) != "function" &&
              	 (gridService.SelectedCells[row] != '') &&
                 (gridService.SelectedCells[row] != null)) {
          			 if (toolButtonName == 'btnEdit'){ gridService.Edit(row); return false;}
                 keys.push(gridService.getPrimaryKey(row));
              }
            }

            if (findObj('SelectedKeysField').value = keys.join(',')){
              if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
            }
            else return false;
          }
        }
        return true;
        //end
        <?php
    }

    function btnServiceClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == 'btnDelete') {
        $this->DeleteService();
      }else if ($toolButtonName == 'btnExportXLS') {
        $filename = sw_clean_characters_spanish(Title_Service);
      	$this->gridService->exportGridToXLSDownload($filename . ".xls", $filename, True);
      }

    }


    function DeleteService()
    {
      Global $connectionDB;
      $sql = "DELETE FROM service
              WHERE service_id in ({$this->SelectedKeysField->Value})";

      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();
      $this->gridService->writeSelectedCells(array());
    }


    function gridServiceShow($sender, $params)
    {
    	Global $language;

      //Column Category
      $sql = "SELECT * FROM service_category ORDER BY service_category_name";
      $records = sw_records_array($sql, Array('service_category_id', 'service_category_name'));
      $records[0] = "";
      $this->gridService->Columns[COL_CATEGORY]->ComboBoxEditor->Values = $records;
      $this->gridService->Columns[COL_CATEGORY]->FilterOptions = $records;
      $this->gridService->Columns[COL_CATEGORY]->TextField = 'service_category_name';

      //Column Service Type
			$sql = "SELECT service_type_id, description_{$language} FROM service_type ORDER BY description_{$language}";
      $records = sw_records_array($sql, array("service_type_id", "description_{$language}"));
      $records[0] = '';
      $this->gridService->Columns[COL_SERVICE_TYPE]->ComboBoxEditor->Values = $records;
      $this->gridService->Columns[COL_SERVICE_TYPE]->FilterOptions = $records;
      $this->gridService->Columns[COL_SERVICE_TYPE]->TextField = "service_type_name";
    }


    function gridServiceJSRowInserted($sender, $params)
    {
        ?>
        //begin js
        if (fieldValues['service_category_id'] === "") return false;
        //end
        <?php
    }


    function gridServiceSQL($sender, $params)
    {
      GLOBAL $language;

      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT service.*,
                     service_type.description_{$language} AS service_type_name,
                     service_category.service_category_name
							FROM service
                   LEFT JOIN service_type ON service.service_type_id = service_type.service_type_id
                   LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id";

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql)))
          $sql .= " WHERE " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->gridService->Datasource->DataSet->SQL = $sql;
    }

}

global $application;

global $service;

//Creates the form
$service=new service($application);

//Read from resource file
$service->loadResource(__FILE__);

//Shows the form
$service->show();

?>