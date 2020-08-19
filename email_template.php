<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");

//Class definition
class email_template extends fmstrong
{
    public $email_template_id = null;
    public $sqlEmail_template_body = null;
    public $dsEmail_template_body = null;
    public $winDesign_email = null;
    public $rowEmail = null;
    public $SiteTheme = null;
    public $btnEmail = null;
    public $ImageList = null;
    public $gridEmail_template = null;
    public $sqlEmail_template = null;
    public $dsEmail_template = null;
    public $template = null;
    public $gridEmail_template_body = null;

    function email_templateCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterEmailTemplate();
    }


    function ParameterEmailTemplate()
    {
      foreach( $this->gridEmail_template->Columns as $Columna )
      {
        $Columna->Filter = "";
      }

      Define('COL_TRIGGER_TYPE', $this->gridEmail_template->findColumnByName('trigger_type_cd'));
      Define('COL_DIRECTORY', $this->gridEmail_template->findColumnByName('trigger_file_directory_cd'));
      Define('COL_NOTES', $this->gridEmail_template->findColumnByName('notes'));
      Define('COL_EMAIL_FROM', $this->gridEmail_template->findColumnByName('email_from'));
      Define('COL_EMAIL_TO', $this->gridEmail_template->findColumnByName('email_to_cd'));
      Define('COL_TEMPLATE', $this->gridEmail_template->findColumnByName('email_template_id'));

      $this->template->value = 0;
      if (isset($_REQUEST['email_template']) && ($_REQUEST['email_template'] === 'client')) {
        $this->template->value = 1;
      }
      $this->lbTitle->Caption = $this->template->value ? Title_Standard_Email_Clients : Title_Standard_Email_Internal;
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, 1, "2");
      $items['btnDelete'] = array(btnDelete, 1, "6");
      $items['btnEdit'] = array(btnEdit, 1, "3");
      $items['btnSave'] = array(btnSave, 1, "5");
      $items['btnCancel'] = array(btnCancel, 1, "4");
      $items['btnEmail'] = array('Design email', 1, "7");

      $this->btnEmail->Items = $items;

      if ($_REQUEST['BtnSaveContent_edit']=="Save"){
        $this->Save_design_email();
      }

      if (($_REQUEST['BtnCloseContent_edit']=="Close") || ($_REQUEST['BtnSaveContent_edit']=="Save")){
        $this->winDesign_email->Include = "";
        $this->winDesign_email->Hide();
      }
    }


    function gridEmail_templateJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowEmail").value = row;
        document.getElementById("email_template_id").value =  gridEmail_template.getCellText(row, <?php echo COL_TEMPLATE; ?>);
        //end
        <?php
    }


    function btnEmailJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowEmail").value;

          if (toolButton == 'btnEmail'){
        		if (toolButtonName == 'btnFilter') {
          		gridEmail_template.deselectAll();
							gridEmail_template._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridEmail_template->ajaxCall('filter_grid', array(), array($this->gridEmail_template->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridEmail_template.Insert(); return false;}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridEmail_template.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridEmail_template.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridEmail_template.Post(); return false;}
            else if ((toolButtonName == 'btnDelete') && (row != "-1") && (row != "")){
              if (confirm("<?php echo $lbDeleteInformationMsg ?>")){
                gridEmail_template.Delete(row);
              }
              return false;
            }
            else if ((toolButtonName == 'btnEmail') && ((row == "-1") || (row == ""))) { return false;}
          }
        //end
        <?php
    }

    function btnEmailClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == 'btnFilter') {
        sw_view_filter_grid($this->gridEmail_template);
      }else if ($toolButtonName == "btnEmail")
      {
        $this->Get_design_email();
      }
    }

    function Save_design_email()
    {
      if ($this->gridEmail_template->SelectedPrimaryKeys[0]) {
        $where = "email_template_id = " . $this->gridEmail_template->SelectedPrimaryKeys[0];
        $record['body'] = $_REQUEST['tinyMCE_content_edit'];
        sw_update_table("email_template", $record, $where);
      }
    }


    function Get_design_email()
    {
      if ($this->gridEmail_template->SelectedPrimaryKeys[0]) {
        $where = "email_template_id = " . $this->gridEmail_template->SelectedPrimaryKeys[0];
        $record = sw_get_data_table("email_template", $where, "body");
        $_SESSION['tinyMCE_content_edit'] = $record['body'];
        $this->winDesign_email->Include = "include/edit_content.php";
        $this->winDesign_email->Height = 410;
        $this->winDesign_email->Width = 640;
        $this->winDesign_email->ShowModal();
      }
    }

    function gridEmail_templateShow($sender, $params)
    {
      Global $trigger_type_cd, $trigger_file_directory_cd, $email_from_template, $email_to_cd;

      //Column trigger_type_cd
      $records = $trigger_type_cd;
      $records[''] = "";
      $this->gridEmail_template->Columns[COL_TRIGGER_TYPE]->ComboBoxEditor->Values = $trigger_type_cd;
      $this->gridEmail_template->Columns[COL_TRIGGER_TYPE]->FilterOptions = $records;

      //Column trigger_file_directory_cd
      $records = $trigger_file_directory_cd;
      $records[''] = "";
      $this->gridEmail_template->Columns[COL_DIRECTORY]->ComboBoxEditor->Values = $records;
      $this->gridEmail_template->Columns[COL_DIRECTORY]->FilterOptions = $records;

      //Column trigger_type_cd
      $records = $email_from_template;
      $records[''] = "";
      $this->gridEmail_template->Columns[COL_EMAIL_FROM]->ComboBoxEditor->Values = $records;
      $this->gridEmail_template->Columns[COL_EMAIL_FROM]->FilterOptions = $records;

      //Column email_to_cd
      $records = $email_to_cd;
      $records[''] = "";
      $this->gridEmail_template->Columns[COL_EMAIL_TO]->ComboBoxEditor->Values = $records;
      $this->gridEmail_template->Columns[COL_EMAIL_TO]->FilterOptions = $records;
    }


    function gridEmail_templateRowData($sender, $params)
    {
      Global $trigger_type_cd, $trigger_file_directory_cd, $email_from_template, $email_to_cd;

      $fields = &$params[ 1 ];

      $fields[ "trigger_type_cd" ] = $trigger_type_cd[$fields[ "trigger_type_cd" ]];
      $fields[ "trigger_file_directory_cd" ] = $trigger_file_directory_cd[$fields[ "trigger_file_directory_cd" ]];
      $fields[ "email_from" ] = $email_from_template[$fields[ "email_from" ]];
      $fields[ "email_to_cd" ] = $email_to_cd[$fields[ "email_to_cd" ]];
    }


    function gridEmail_templateJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        var cellvalue = gridEmail_template.getCellText(rowIndex, <?php echo COL_TRIGGER_TYPE;?>);
        var objComboBox = document.getElementById("gridEmail_template_trigger_type_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        cellvalue = gridEmail_template.getCellText(rowIndex, <?php echo COL_DIRECTORY;?>);
        objComboBox = document.getElementById("gridEmail_template_trigger_file_directory_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        cellvalue = gridEmail_template.getCellText(rowIndex, <?php echo COL_EMAIL_FROM;?>);
        objComboBox = document.getElementById("gridEmail_template_email_from_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        cellvalue = gridEmail_template.getCellText(rowIndex, <?php echo COL_EMAIL_TO;?>);
        objComboBox = document.getElementById("gridEmail_template_email_to_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        //end
        <?php
    }

    function gridEmail_templateInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1) $fields = &$params[ 0 ];
      else { // Update
          $fields = &$params[ 1 ];
          $fields[ 'email_template_id' ] = $params[ 0 ];
      }

      if (!$fields[ 'email_template_id' ]) {
        $fields[ 'to_client_yn' ] = $this->template->Value;
        $fields[ 'created_by_user_id' ] = $_SESSION['user_id'];
        $fields[ 'created_dt' ] = date('Y-m-d H:i:s');
        $fields[ 'to_client_yn' ] = $this->template->Value;
        sw_insert_table($this->gridEmail_template->Datasource->DataSet->TableName, $fields);
      }
      else {
        sw_update_table("email_template", $fields, "email_template_id = " . $fields['email_template_id']);
      }
    }

    function gridEmail_templateSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT email_template.*, vw_provider_contact.username
              FROM email_template
                   LEFT JOIN vw_provider_contact ON email_template.created_by_user_id = vw_provider_contact.provider_contact_id
              WHERE (to_client_yn = {$this->template->Value})";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlEmail_template->SQL = $sql;
    }

    function gridEmail_template_bodySQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT email_template_id, body FROM email_template
              WHERE (email_template_id = {$this->gridEmail_template->SelectedPrimaryKeys[0]})";

      if (sw_valid_sql($sql))
        $this->sqlEmail_template_body->SQL = $sql;
    }

}

global $application;

global $email_template;

//Creates the form
$email_template=new email_template($application);

//Read from resource file
$email_template->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $email_template->show();

?>