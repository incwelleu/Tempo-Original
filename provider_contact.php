<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("components4phpfull/jttreeview.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");

//Class definition
class provider_contact extends fmstrong
{
    public $sqlProvider_contact = null;
    public $dsProvider_contact = null;
    public $ImageList = null;
    public $SiteTheme = null;
    public $gridProvider_contact = null;
    public $btnContact = null;
    public $rowContact = null;
    public $cbIncludeInactive = null;


    function provider_contactCreate($sender, $params)
    {
      sw_style_selected($this);
      Define('COL_STATUS_CD', $this->gridProvider_contact->findColumnByName('status_cd'));
      Define('COL_SW_EMAIL', $this->gridProvider_contact->findColumnByName('sw_email'));
      Define('COL_HOME_EMAIL', $this->gridProvider_contact->findColumnByName('home_email'));

      $this->lbTitle->Caption = Title_Provider_Contact;
      $this->lbTitle->Visible = True;

      //Create Button
      $items['btnFilter'] = array(btnFilter, $_SESSION['IsSuperadmin'], "8");
      $items['btnDelete'] = array(btnDelete, $_SESSION['IsSuperadmin'], "6");
      $items['btnEdit'] = array(btnEdit, $_SESSION['IsSuperadmin'], "3");
      $items['btnSave'] = array(btnSave, $_SESSION['IsSuperadmin'], "5");
      $items['btnCancel'] = array(btnCancel, $_SESSION['IsSuperadmin'], "4");
      $this->btnContact->Items = $items;
    }


    function gridProvider_contactSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT provider_contact.*, user.status_cd, user.username, CASE WHEN user_role.role_id IS NULL THEN false ELSE true END AS isProvider
      				FROM provider_contact
                   INNER JOIN user ON provider_contact.provider_contact_id = user.user_id
									 LEFT JOIN user_role ON user.user_id = user_role.user_id AND user_role.role_id = 2";


      if (!$this->cbIncludeInactive->Checked) {
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "(user.status_cd = 'a')";
      }

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql)))
          $sql .= " WHERE " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlProvider_contact->SQL = $sql;
    }



    function btnContactJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowContact").value;

          if (toolButton == 'btnContact'){
        		if (toolButtonName == 'btnFilter') {
          		gridProvider_contact.deselectAll();
							gridProvider_contact._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridProvider_contact->ajaxCall('filter_grid', array(), array($this->gridProvider_contact->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridProvider_contact.Insert(); return false; }
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridProvider_contact.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridProvider_contact.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridProvider_contact.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
          }
        //end
        <?php
    }

    function btnContactClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnDelete")
      {
        $this->DeleteContactSelected();
      }
      return true;
    }



    function DeleteContactSelected()
    {
      if (count($this->gridProvider_contact->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $provider_contact = $this->gridProvider_contact->SelectedPrimaryKeys;
        $provider_contact = implode(",", $provider_contact);

        if ($provider_contact){
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute("DELETE FROM provider_contact WHERE provider_contact_id in (" . $provider_contact . ")");
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridProvider_contact->writeSelectedCells(array());
        }
      }
    }

    function gridProvider_contactJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowContact").value = row;
        //end
        <?php
    }


    function gridProvider_contactInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1)
      {
        $fields = &$params[ 0 ];
      }
      else { //Update
          $fields = &$params[ 1 ];
          $fields[ 'provider_contact_id' ] = $params[ 0 ];
      }

      $fields[ 'sw_email' ] = strtolower($fields[ 'sw_email' ]);
      $fields[ 'home_email' ] = strtolower($fields[ 'home_email' ]);

      //checked account
      if (!$fields[ 'provider_contact_id' ]) {
        sw_insert_table($this->gridProvider_contact->Datasource->DataSet->TableName, $fields);
      }
      else {
          sw_update_table($this->gridProvider_contact->Datasource->DataSet->TableName, $fields, "provider_contact_id = {$fields['provider_contact_id']}");
      }
    }

    function gridProvider_contactJSRowEdited($sender, $params)
    {
      Global $lbRequiredFieldError, $lbEmailErrorMsg;
        ?>
        //begin js
        var sw_email = gridProvider_contact.getEditorValue("sw_email");
        var home_email = gridProvider_contact.getEditorValue("home_email");
        var msgError = '';

        if (!(<?php echo SW_MASK_EMAIL;?>.test(sw_email))){
        	msgError = msgError + "<?php echo $this->gridProvider_contact->Columns[COL_SW_EMAIL]->Caption . ', ' . $lbEmailErrorMsg; ?>" + '</br>';
        }

        if (home_email != '' && !(<?php echo SW_MASK_EMAIL;?>.test(home_email))){
        	msgError = msgError + "<?php echo $this->gridProvider_contact->Columns[COL_HOME_EMAIL]->Caption . ', ' . $lbEmailErrorMsg; ?>" + '</br>';
        }

        if (msgError != ''){
        	msgError = "<?php echo $lbRequiredFieldError; ?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
        }

        return (msgError == '');
        //end
        <?php
    }

    function cbIncludeInactiveJSChange($sender, $params)
    {
        ?>
        //begin js
        gridProvider_contact.Refresh();
        //end
        <?php
    }

    function gridProvider_contactRowData($sender, $params)
    {
    	Global $GLOBAL_STATUS_CODE;

      $fields = &$params[ 1 ];

      $fields[ "status_cd" ] = $GLOBAL_STATUS_CODE[$fields[ "status_cd" ]];
    }

    function gridProvider_contactShow($sender, $params)
    {
      Global $GLOBAL_STATUS_CODE, $languages;

      $this->gridProvider_contact->Columns[COL_STATUS_CD]->ComboBoxEditor->Values = $GLOBAL_STATUS_CODE;
      $filtre = $GLOBAL_STATUS_CODE;
      $filtre[''] = '';
      $this->gridProvider_contact->Columns[COL_STATUS_CD]->FilterOptions = $filtre;
    }


}

global $application;

global $provider_contact;

//Creates the form
$provider_contact=new provider_contact($application);

//Read from resource file
$provider_contact->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $provider_contact->show();

?>