<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("checklst.inc.php");
use_unit("components4phpfull/jttreeview.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("comctrls.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");


//Class definition
class user extends fmstrong
{
    public $winUser_setting = null;
    public $ImageList = null;
    public $SiteTheme = null;
    public $gridUsers = null;
    public $sqlUser = null;
    public $dsUser = null;
    public $btnUser = null;
    public $rowUser = null;
    public $user_id = null;

    function userCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterUser();
    }


    function ParameterUser()
    {
      Define('COL_USERNAME', $this->gridUsers->findColumnByName('username'));
      Define('COL_STATUS_CD', $this->gridUsers->findColumnByName('status_cd'));
      Define('COL_LANGUAGE_CD', $this->gridUsers->findColumnByName('language_cd'));
      Define('COL_CREATED_USER_ID', $this->gridUsers->findColumnByName('created_by_user_id'));
      Define('COL_CREATED_DT', $this->gridUsers->findColumnByName('created_dt'));
      Define('COL_LOGIN_DT', $this->gridUsers->findColumnByName('login_dt'));
      Define('COL_STATUS_BLOCK_DT', $this->gridUsers->findColumnByName('status_block_dt'));
      Define('COL_SEE_COMPANIES_YN', $this->gridUsers->findColumnByName('can_see_companies_yn'));
      Define('COL_SEE_EMPLOYEE_YN', $this->gridUsers->findColumnByName('can_see_employee_general_yn'));
      Define('COL_MODIFY_EMPLOYEE_YN', $this->gridUsers->findColumnByName('can_modify_employee_payroll_yn'));
      Define('COL_SEE_ACCOUNTING_YN', $this->gridUsers->findColumnByName('can_see_accounting_yn'));
      Define('COL_SEE_TAX_FORMS_YN', $this->gridUsers->findColumnByName('can_see_tax_forms_yn'));
      Define('COL_SEE_REAL_ESTATE_YN', $this->gridUsers->findColumnByName('can_see_real_estate_yn'));
      Define('COL_SEE_IMMIGRATION_YN', $this->gridUsers->findColumnByName('can_see_immigration_yn'));


      $this->lbTitle->Caption = Title_User;
      $this->lbTitle->Visible = True;

      $this->gridUsers->Columns[COL_CREATED_USER_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridUsers->Columns[COL_CREATED_DT]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridUsers->Columns[COL_LOGIN_DT]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridUsers->Columns[COL_STATUS_BLOCK_DT]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridUsers->Columns[COL_STATUS_CD]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_COMPANIES_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_EMPLOYEE_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_MODIFY_EMPLOYEE_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_ACCOUNTING_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_TAX_FORMS_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_REAL_ESTATE_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
      $this->gridUsers->Columns[COL_SEE_IMMIGRATION_YN]->Visible = $_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'];
			$this->gridUsers->Header->ShowFilterBar = True;
    }

    function gridUsersRowData($sender, $params)
    {
      Global $GLOBAL_USER_STATUS_CODE, $languages;

      $fields = &$params[ 1 ];

      $fields[ "status_cd" ] = $GLOBAL_USER_STATUS_CODE[$fields[ "status_cd" ]];
      $fields[ "language_cd" ] = $languages[$fields[ "language_cd" ]];
    }


    function gridUsersSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $where = " WHERE ";
      $user_id = $_SESSION['user_id'];
      $IsSuperadmin = ($_SESSION['IsSuperadmin']) &&
                      (!$_SESSION['IsProvider']) &&
                      (!$_SESSION['IsClientAdmin']) &&
                      (!$_SESSION['IsClientUser']);

      $sql = "SELECT user.*, created_username
              FROM user
                  LEFT JOIN (SELECT user_id AS created_by_user_id, username AS created_username FROM user) AS created_user
                  ON user.created_by_user_id = created_user.created_by_user_id";

      //Only role Superadmin
      if ($IsSuperadmin) {
        $sql .= " INNER JOIN (SELECT DISTINCT user_id FROM user_role WHERE user_role.role_id != 4) AS user_role
	                     ON user.user_id = user_role.user_id";
      }
      // Role Superadmin
      else if ($_SESSION['IsSuperadmin']) {
        $sql .= " INNER JOIN (SELECT DISTINCT user_id FROM user_role WHERE user_role.role_id = 3) AS user_role
	                    ON user.user_id = user_role.user_id";
      }
      // Role Clientadmin
      else if (!$IsSuperadmin && (!$_SESSION['IsSuperadmin'] || $_SESSION['parent_user_id'] == 0)) {
          $sql .= " WHERE user_id = " . $user_id . " OR parent_user_id = " . $user_id;
          $where = " AND ";
      }

      if (($filterSql) AND (sw_valid_sql($sql . $where . $filterSql)))
          $sql .= $where . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      if ($sql != $this->sqlUser->SQL) {
        $this->sqlUser->SQL = $sql;
      }
    }


    function btnUserJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbRecoverPasswordMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowUser").value;

          if (toolButton == 'btnUser'){
        		if (toolButtonName == 'btnFilter') {
          		gridUsers.deselectAll();
							gridUsers._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridUsers->ajaxCall('filter_grid', array(), array($this->gridUsers->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridUsers.Insert(); return false; }
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridUsers.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridUsers.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridUsers.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnRecoverPassword') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbRecoverPasswordMsg ?>"); }
                else  return false;
            }
          }
        //end
        <?php
    }


    function btnUserClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if (($toolButtonName == "btnAddSA") || ($toolButtonName == "btnEditSA"))
      {
        $this->user_id->Value = (count($this->gridUsers->SelectedPrimaryKeys) != 0) && ($toolButtonName == "btnEditSA") ? $this->gridUsers->SelectedPrimaryKeys[0] : 0;

        $this->winUser_setting->Caption = 'User setting';
        $this->winUser_setting->Width = 570;
        $this->winUser_setting->Height = 465;
        $this->winUser_setting->Include = "user_setting.php";
        $this->winUser_setting->ShowModal();
      }
      else if ($toolButtonName == "btnDelete")
      {
        $this->DeleteUserSelected();
      }
      else if ($toolButtonName == "btnRecoverPassword")
      {
        $this->Recover_password();
      }
      else if ($toolButtonName == "btnExportXLS")
      {
        $this->gridUsers->exportGridToXLSDownload("User Tempo.xls", 'Users', true);
      }
    }


    function DeleteUserSelected()
    {
      if (count($this->gridUsers->SelectedPrimaryKeys) > 0) {

        //Extract user_id of Client admin
        $user = $this->gridUsers->SelectedPrimaryKeys;
        $user_id = $_SESSION['user_id'];
        if ((array_search($user_id, $user) !== False) && (!$_SESSION['IsSuperadmin'])){
          array_splice($user, array_search($user_id, $user));
        }
        $user_id = implode(",", $user);

        if ($user_id){
          Global $connectionDB;

          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute("DELETE FROM user WHERE (user_id in (" . $user_id . ")) OR (parent_user_id in (" . $user_id . "))");
          $connectionDB->DbConnection->execute("UPDATE company SET user_id = 0 WHERE (user_id in ({$user_id}))");
//          $connectionDB->DbConnection->execute("DELETE FROM company WHERE user_id in (" . $user_id . ")");
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridUsers->writeSelectedCells(array());
        }

      }
    }


    function Recover_password()
    {
      if (count($this->gridUsers->SelectedPrimaryKeys) > 0) {
        Global $connectionDB, $password_user, $password_admin;

        //Extract user_id of Client admin
        if ($this->gridUsers->SelectedPrimaryKeys[0])
        {
          $user_id = $this->gridUsers->SelectedPrimaryKeys[0];
          $roles = sw_get_user_role($user_id);

          $password = $password_user;
          if ($roles['IsSuperadmin'] || $roles['IsProvider']){
            $password = $password_admin;
          }
          else if ($roles['IsClientUser']){
            $record = sw_get_data_table("user", "user_id = {$user_id}", 'username');
            $password = $record['username'];
          }

          $sql = "UPDATE user SET password = PASSWORD('{$password}') WHERE user_id = {$user_id}";
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute($sql);
          $connectionDB->DbConnection->CompleteTrans();

          Global $lbRecoveredDefaultPasswordMsg;
          $this->msgSuccess->Value = $lbRecoveredDefaultPasswordMsg . ' (' . $password . ')';
        }
      }
      $this->gridUsers->SelectedCells = array();
    }


    function gridUsersJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("user_id").value = gridUsers.getSelectedPrimaryKey();
        document.getElementById("rowUser").value = row;
        //end
        <?php
    }


    function gridUsersInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1)
      {
        $fields = &$params[ 0 ];
      }
      else { //Update
          $fields = &$params[ 1 ];
          $fields[ 'user_id' ] = $params[ 0 ];
      }

      $fields[ 'username' ] = strtolower(trim($fields[ 'username' ]));

      if (!$fields[ 'status_block_dt']){
        unset($fields['status_block_dt']);
      }

      //checked account
      if (!$fields[ 'user_id' ]) {

        $fields['parent_user_id'] = $_SESSION['user_id'];
        $fields['password']       = $fields['username'];

        //Insert user
        $roles[] = 'Client user';
        sw_insert_user($fields, $roles);
      }
      else {
          $record = sw_get_data_table("user", "user_id = {$fields['user_id']}");

          //Change Short_name of Company
          $this->Change_shortname_company($fields['username'], $record);

          //Change status user
          $this->Change_status_user($fields, $record);

					// Elimina los campos de control de acceso a los ClientAdmin y C
					if (($_SESSION['IsClientAdmin'] && $_SESSION['username'] == $fields['username']) || $_SESSION['IsClientUser']){
					   unset($fields['status_cd']);
					   unset($fields['can_see_companies_yn']);
					   unset($fields['can_see_employee_general_yn']);
					   unset($fields['can_modify_employee_payroll_yn']);
					   unset($fields['can_see_accounting_yn']);
					   unset($fields['can_see_tax_forms_yn']);
					   unset($fields['can_see_real_estate_yn']);
					   unset($fields['can_see_immigration_yn']);
					}

          //Update user
          sw_update_table("user", $fields, "user_id = {$fields['user_id']}");

          //Update session user
          if ($fields['username'] == $_SESSION['username']){
          	sw_set_user_session($fields);
          }
      }
    }


    //Change Short_name of Company
    function Change_shortname_company($username, $record)
    {
      if ($_SESSION['IsSuperadmin'] && ($record['username'] != $username)) {
        $record_company['short_name'] = $username;
        sw_update_table("company", $record_company, "(user_id = {$record['user_id']}) AND (short_name = '{$record['username']}')");
      }
    }

    //Change status user
    function Change_status_user(&$fields, $record)
    {
      if (($_SESSION['IsSuperadmin'] || ($_SESSION['IsClientAdmin'] && $_SESSION['username'] !== $fields[ 'username' ])) &&
				  ($fields['status_cd'] != $record['status_cd'])) {

      	Global $connectionDB;

      	$status_block_dt = "null";
      	if ($fields['status_cd'] != 'a'){
        	$status_block_dt = $fields['status_block_dt'] != '' ? "'" . $fields['status_block_dt'] . "'" : "NOW()";
      	}

      	$sql = "UPDATE user
              	SET status_cd = '{$fields['status_cd']}',
                  	status_block_dt = {$status_block_dt}
              	WHERE user_id = {$fields['user_id']} OR parent_user_id = {$fields['user_id']}";

      	$connectionDB->DbConnection->BeginTrans();
      	$connectionDB->DbConnection->execute($sql);
      	$connectionDB->DbConnection->CompleteTrans();
			}
    }


    function gridUsersJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        /* status_cd  */
        var cellvalue = gridUsers.getCellText(rowIndex, <?php echo COL_STATUS_CD;?>);
        var objComboBox = document.getElementById("gridUsers_status_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        /* language cd */
        cellvalue = gridUsers.getCellText(rowIndex, <?php echo COL_LANGUAGE_CD;?>);
        objComboBox = document.getElementById("gridUsers_language_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);
        //end
        <?php
    }


    function gridUsersShow($sender, $params)
    {
      Global $GLOBAL_STATUS_CODE, $GLOBAL_USER_STATUS_CODE, $languages;

      $this->gridUsers->Columns[COL_STATUS_CD]->ComboBoxEditor->Values = $_SESSION['IsSuperadmin'] ? $GLOBAL_USER_STATUS_CODE : $GLOBAL_STATUS_CODE;
      $filtre = $_SESSION['IsSuperadmin'] ? $GLOBAL_USER_STATUS_CODE : $GLOBAL_STATUS_CODE;
      $filtre[''] = '';
      $this->gridUsers->Columns[COL_STATUS_CD]->FilterOptions = $filtre;

      $this->gridUsers->Columns[COL_LANGUAGE_CD]->ComboBoxEditor->Values = $languages;
    }


    function btnUserShow($sender, $params)
    {
      $IsSuperadmin = ($_SESSION['IsSuperadmin']) &&
                      (!$_SESSION['IsProvider']) &&
                      (!$_SESSION['IsClientAdmin']) &&
                      (!$_SESSION['IsClientUser']);

      //Create Button
      if ($IsSuperadmin || ($_SESSION['IsSuperadmin'] && $_SESSION['IsClientUser'])){
          $items['btnFilter'] = array(btnFilter, 1, "8");
          $items['btnAddSA'] = array(btnAdd, True, "2");
          $items['btnDelete'] = array(btnDelete, True, "6");
          $items['btnEditSA'] = array(btnEdit, True, "3");
      }
      else {
        $items['btnAdd'] = array(btnAdd, True, "2");
        $items['btnDelete'] = array(btnDelete, True, "6");
        $items['btnEdit'] = array(btnEdit, True, "3");
      }

      $items['btnSave'] = array(btnSave, True, "5");
      $items['btnCancel'] = array(btnCancel, True, "4");
      $items['btnRecoverPassword'] = array(btnRecoverPassword, True);
      if ($IsSuperadmin || ($_SESSION['IsSuperadmin'] && $_SESSION['IsClientUser'])){
        $items['btnExportXLS'] = array(btnExportXLS, True, "9");
      }
      $this->btnUser->Items = $items;
    }



    function validateUsername($sender, $params)
    {
      Global $lbChangeUserAdmin_error;

			$fields = $params[ 0 ];
      //Insert
      if (!$fields[ 'user_id' ]) $fields[ 'user_id' ] = 0;

      $msg = "";
      $user_role = sw_get_user_role($fields['user_id']);

      if ($_SESSION['IsClientAdmin'] && $_SESSION['username'] !== $fields['username'] && $_SESSION['user_id'] == $fields['user_id'])
      {
        $msg = $lbChangeUserAdmin_error;
      } else
      {
        //Valid username and short_name
        $msg = sw_valid_username($fields['user_id'], $fields['username']);
      }

			$this->msgError->Value = $msg . ($msg != "" ? "({$fields['username']})" : "");

			return $msg;
    }


    function gridUsersRowEdited($sender, $params)
    {
      $fields = &$params[ 0 ];

      $fields[ 'username' ] = strtolower(trim($fields[ 'username' ]));

			$msg = $this->validateUsername($sender, $params);

			return $msg == "";
    }

    function gridUsersJSDataLoad($sender, $params)
    {
        ?>
        //begin js
 				var msgError = document.getElementById("msgError").value;
        if (msgError != '') {
				  TINY.box.show({html:msgError,animate:false,close:true,boxid:'error',height:'auto',width:'300px'});
				}

        //end
        <?php
    }

    function userShow($sender, $params)
    {
        $this->msgError->Value = "";
    }


}

global $application;

global $user;

//Creates the form
$user=new user($application);

//Read from resource file
$user->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $user->show();

?>