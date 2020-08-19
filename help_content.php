<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/create_grid_column.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");

//Class definition
class help_content extends fmstrong
{
    public $btnHelp = null;
    public $ImageList = null;
    public $winProcess = null;
    public $gridHelp_content = null;
    public $sqlHelp_content = null;
    public $dsHelp_content = null;
    public $SiteTheme = null;
    public $rowHelp = null;
    public $type_help = null;

    function help_contentCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterForm();
    }

    function ParameterForm()
    {
      if ((!$this->type_help->value) || (isset($_REQUEST['type_help']) && ($this->type_help->value !== $_REQUEST['type_help']))) {
        $this->type_help->value = $_REQUEST['type_help'];
        $this->CreatedColumnGrid();
      }

      $this->lbTitle->Caption = Title_Help_content . (($this->type_help->value !== 'help_program') ? ': General' : ': Tempo');
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, 1, "2");
      $items['btnDelete'] = array(btnDelete, 1, "6");
      $items['btnEdit'] = array(btnEdit, 1, "3");
      $items['btnSave'] = array(btnSave, 1, "5");
      $items['btnCancel'] = array(btnCancel, 1, "4");
      $items['btnAnswer'] = array('Design answer', 1, "7");

      $this->btnHelp->Items = $items;

      if ($_POST['BtnSaveContent_edit']=="Save"){
        $this->Save_design_answer();
      }

      if ($_POST['BtnCloseContent_edit']=="Close"){
        $this->winProcess->Hide();
      }
    }

    //Created column paid
    function CreatedColumnGrid()
    {
      $this->gridHelp_content->Datasource->DataSet->close();
      $this->gridHelp_content->Columns = array();

      $columns[] = sw_create_grid_column('country_id', $this->gridHelp_content);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
			                  CAN_MOVE => False,
                        CAPTION => 'Menu Item',
                        DEFAULT_FILTER => 'Contains',
												EDITOR_TYPE => 'ComboBox', TEXT_FIELD => 'application_form',
                        WIDTH => 150);
      $columns[] = sw_create_grid_column('nodo_id', $this->gridHelp_content, $property);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
			                  CAN_MOVE => False,
                        CAPTION => 'Directory',
                        DEFAULT_FILTER => 'Contains',
												EDITOR_TYPE => 'ComboBox', TEXT_FIELD => 'directory_name',
                        WIDTH => 100);
      $columns[] = sw_create_grid_column('directory_id', $this->gridHelp_content, $property);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
			                  CAN_MOVE => False,
                        CAPTION => 'Category',
                        DEFAULT_FILTER => 'Contains',
												EDITOR_TYPE => 'ComboBox', TEXT_FIELD => 'category_name',
                        WIDTH => 100);
      $columns[] = sw_create_grid_column('help_category_id', $this->gridHelp_content, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridBooleanColumn',
      								  CAPTION => 'Clients can see',DISPLAY_FORMAT => 'CheckBox',
                        TRUE_TEXT => SW_CAPTION_YES, FALSE_TEXT => SW_CAPTION_NO,
                        CAN_MOVE => False, ALIGNMENT => 'agCenter', WIDTH => 100 );
      $columns[] = sw_create_grid_column('clients_can_see_yn', $this->gridHelp_content, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                        ALIGNMENT => 'agLeft', CAN_MOVE => False,
                        CAN_FILTER => True, CAN_SORT => False,
                        DEFAULT_FILTER => 'Contains',
                        CAPTION => 'Question', WIDTH => 200);
      $columns[] = sw_create_grid_column('question', $this->gridHelp_content, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridMemoColumn', ALIGNMENT => 'agLeft',
                        CAN_MOVE => False, CAN_FILTER => True, CAN_SELECT => False,
      								  CAN_SORT => False, CAN_EDIT => False, CAPTION => 'Answer',
                        DEFAULT_FILTER => 'Contains', WIDTH => 350, VISIBLE => True,
                        LIMIT => 'Words', WORD_LIMIT => 0);
      $columns[] = sw_create_grid_column('answer', $this->gridHelp_content, $property);

      $property = array(ALIGNMENT => 'agRight', CAN_MOVE => False,
                        CAPTION => 'Sort', WIDTH => 50);
      $columns[] = sw_create_grid_column('sort_no', $this->gridHelp_content, $property);

      $property = array(TEXT_FIELD => 'user_create');
      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridHelp_content, $property);

      $columns[] = sw_create_grid_column('created_dt', $this->gridHelp_content);

      $property = array(CAPTION => 'Modified', CAN_EDIT => False,
                        CAN_MOVE => False, TEXT_FIELD => 'user_modified', WIDTH => 70);
      $columns[] = sw_create_grid_column('last_mod_user_id', $this->gridHelp_content, $property);

			$property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                        ALIGNMENT => 'agCenter',
												CAN_MOVE => False,
                        CAPTION => 'Modified date',
                        DEFAULT_FILTER => 'Contains',
                        DISPLAY => 'DateOnly',
                        FORMAT => 'Y-m-d H:i:s',
                        TIME_FORMAT => 'tt24Hour',
                        WIDTH => 100,
                        CAN_EDIT => false);
      $columns[] = sw_create_grid_column('last_mod_dt', $this->gridHelp_content, $property);

      $columns[] = sw_create_grid_column('help_content_id', $this->gridHelp_content, array(VISIBLE => False));

    	$this->gridHelp_content->Columns = $columns;
      $this->gridHelp_content->SortBy = 'directory_id, sort_no';
      $this->gridHelp_content->KeyField = 'help_content_id';
      $this->gridHelp_content->init();
    }


    function gridHelp_contentShow($sender, $params)
    {
      Global $language;
      Define('COL_COUNTRY', $this->gridHelp_content->findColumnByName('country_id'));
      Define('COL_NODO', $this->gridHelp_content->findColumnByName('nodo_id'));
      Define('COL_DIRECTORY', $this->gridHelp_content->findColumnByName('directory_id'));
      Define('COL_CATEGORY', $this->gridHelp_content->findColumnByName('help_category_id'));
      Define('COL_CLIENTS_CAN_SEE', $this->gridHelp_content->findColumnByName('clients_can_see_yn'));

      //Column Country
      $sql = "SELECT country_id, {$language} as country_name FROM country ORDER BY {$language}";
      $records = sw_records_array($sql, Array('country_id', 'country_name'));
      $this->gridHelp_content->Columns[COL_COUNTRY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridHelp_content->Columns[COL_COUNTRY]->FilterOptions = $records;
      $this->gridHelp_content->Columns[COL_COUNTRY]->TextField = "country_name";
      $this->gridHelp_content->Columns[COL_COUNTRY]->Visible = false;

      //Column Nodo
      $sql = 'SELECT nodo_id, application_form FROM vw_application_form';
      $records = sw_records_array($sql, Array('nodo_id', 'application_form'));
      $this->gridHelp_content->Columns[COL_NODO]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridHelp_content->Columns[COL_NODO]->FilterOptions = $records;
      $this->gridHelp_content->Columns[COL_NODO]->Visible = ($this->type_help->value == 'help_program');

      //Column Directory
      $sql = 'SELECT directory_id, directory_name FROM vw_directory_help';
      $records = sw_records_array($sql, Array('directory_id', 'directory_name'));
      $this->gridHelp_content->Columns[COL_DIRECTORY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridHelp_content->Columns[COL_DIRECTORY]->FilterOptions = $records;
      $this->gridHelp_content->Columns[COL_DIRECTORY]->Visible = ($this->type_help->value !== 'help_program');

      //Column Help Category
      $where = ($this->type_help->value === 'help_program') ? "(help_category_id = 3)" : "help_category_id != 3";
      $sql = "SELECT help_category_id, category_name FROM help_category WHERE {$where}";
      $records = sw_records_array($sql, Array('help_category_id', 'category_name'));
      $this->gridHelp_content->Columns[COL_CATEGORY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridHelp_content->Columns[COL_CATEGORY]->FilterOptions = $records;
      $this->gridHelp_content->Columns[COL_CATEGORY]->Visible = ($this->type_help->value !== 'help_program');

//      $this->gridHelp_content->Columns[COL_CLIENTS_CAN_SEE]->Visible = ($this->type_help->value !== 'help_program');
    }


    function gridHelp_contentSQL($sender, $params)
    {
      Global $language;

      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT help_content.*, country.country_name, vw_directory_help.directory_name, help_category.category_name,
              creation_user.username As user_create, modified_user.username As user_modified
              FROM help_content
                LEFT JOIN user AS creation_user ON help_content.created_by_user_id = creation_user.user_id
                LEFT JOIN user AS modified_user ON help_content.last_mod_user_id = modified_user.user_id
                LEFT JOIN (SELECT country_id, country.{$language} AS country_name FROM country) AS country ON help_content.country_id = country.country_id
                LEFT JOIN vw_directory_help ON help_content.directory_id = vw_directory_help.directory_id
                LEFT JOIN help_category ON help_content.help_category_id = help_category.help_category_id";

      $where = ($this->type_help->value === 'help_program') ? "(help_content.help_category_id = 3)" : "help_content.help_category_id != 3";
      $filterSql .= $filterSql ? (" AND " . $where) : $where;

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql)))
          $sql .=  " WHERE " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlHelp_content->SQL = $sql;
    }


    function gridHelp_contentJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowHelp").value = row;
        //end
        <?php
    }

    function btnHelpJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowHelp").value;

          if (toolButton == 'btnHelp'){
        		if (toolButtonName == 'btnFilter') {
          		gridHelp_content.deselectAll();
							gridHelp_content._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridHelp_content->ajaxCall('filter_grid', array(), array($this->gridHelp_content->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridHelp_content.Insert(); return false;}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridHelp_content.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridHelp_content.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridHelp_content.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
            else if ((toolButtonName == 'btnAnswer') && ((row == "-1") || (row == ""))) { return false;}
          }
        //end
        <?php
    }

    function Save_design_answer()
    {
      if ($this->gridHelp_content->SelectedPrimaryKeys[0]) {
        $where = "help_content_id = " . $this->gridHelp_content->SelectedPrimaryKeys[0];
        $record['answer'] = $_POST['tinyMCE_content_edit'];
        $record['last_mod_user_id'] = $_SESSION['user_id'];
        $record['last_mod_dt']      = date('Y-m-d h:i:s');
        sw_update_table("help_content", $record, $where);
        $this->winProcess->Hide();
      }
    }

    function btnHelpClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnDelete"){
          $this->DeleteHelp_content();
      }
      else if ($toolButtonName == "btnAnswer")
      {
        $this->Get_design_answer();
      }
    }


    function DeleteHelp_content()
    {
      if (count($this->gridHelp_content->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $help_content_id    = $this->gridHelp_content->SelectedPrimaryKeys;
        $help_content_id = implode(",", $help_content_id);

        if ($help_content_id){
          $sql = "DELETE FROM help_content WHERE help_content_id in (" . $help_content_id . ")";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridHelp_content->writeSelectedCells(array());
        }
      }
    }

    function Get_design_answer()
    {
      if ($this->gridHelp_content->SelectedPrimaryKeys[0]) {
        $where = "help_content_id = " . $this->gridHelp_content->SelectedPrimaryKeys[0];
        $record = sw_get_data_table("help_content", $where, "answer");
        $_SESSION['tinyMCE_content_edit'] = $record['answer'];
        $this->winProcess->Include = "include/edit_content.php";
        $this->winProcess->Height = 410;
        $this->winProcess->Width = 640;
        $this->winProcess->ShowModal();
      }
    }

    function gridHelp_contentInsert($sender, $params)
    {
      $fields = &$params[ 0 ];
      $fields['created_by_user_id'] = $_SESSION['user_id'];
      if (!$fields['country_id']) {
        $fields['country_id'] = 724;
      }
      $fields['created_dt'] = date('Y-m-d h:i:s');
      $fields['help_category_id'] = ($this->type_help->value !== 'help_program') ? $fields['help_category_id'] : 3;
      $fields['nodo_id'] = ($this->type_help->value !== 'help_program') ? $fields['directory_id'] : $fields['nodo_id'];
      $fields['directory_id'] = ($this->type_help->value == 'help_program') ? $fields['nodo_id'] : $fields['directory_id'];

      if(empty($fields['question'])){
         $fields['question'] = ' ';
      }

      if(empty($fields['sort_no'])){
         $fields['sort_no'] = 0;
      }
      sw_insert_table($this->gridHelp_content->Datasource->DataSet->TableName, $fields);
    }


    function gridHelp_contentUpdate($sender, $params)
    {
      $fields = &$params[ 1 ];
      if (!$fields['country_id']) {
        $fields['country_id'] = 724;
      }
      $fields['help_content_id'] = $params[ 0 ];
      //Update record
      sw_update_table($this->gridHelp_content->Datasource->DataSet->TableName, $fields, "help_content_id = " . $fields['help_content_id'] );
    }

    function gridHelp_contentRowData($sender, $params)
    {
      $fields = &$params[ 1 ];

      if ($fields['nodo_id']) {
        if ($record = sw_get_data_table("vw_application_form", "nodo_id = {$fields['nodo_id']}")){
          $fields['application_form'] = $record['application_form'];
        }
      }
    }

}

global $application;

global $help_content;

//Creates the form
$help_content=new help_content($application);

//Read from resource file
$help_content->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $help_content->show();

?>