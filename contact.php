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
class contact extends fmstrong
{
    public $sqlContact = null;
    public $dsContact = null;
    public $ImageList = null;
    public $SiteTheme = null;
    public $gridContacts = null;
    public $btnContact = null;
    public $rowContact = null;


    function contactCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Contact;
      $this->lbTitle->Visible = True;

      Define('COL_TYPE', $this->gridContacts->findColumnByName('contact_type_cd'));
      Define('COL_EMAIL', $this->gridContacts->findColumnByName('email'));

      $company_id = $_SESSION['company_id'];

      //Create Button
      $items['btnFilter'] = array(btnFilter, 1, "8");
      $items['btnAdd'] = array(btnAdd, ($company_id != 0), "2");
      $items['btnDelete'] = array(btnDelete, ($company_id != 0), "6");
      $items['btnEdit'] = array(btnEdit, ($company_id != 0), "3");
      $items['btnSave'] = array(btnSave, ($company_id != 0), "5");
      $items['btnCancel'] = array(btnCancel, ($company_id != 0), "4");

      $this->btnContact->Items = $items;

    }

    function gridContactsShow($sender, $params)
    {
      Global $GLOBAL_CONTACT_TYPE_COMPANY, $GLOBAL_CONTACT_TYPE_PERSONAL;

      $this->gridContacts->Columns[COL_TYPE]->Visible = $_SESSION['IsSuperadmin'];

      //Array(0=> '', 1 => 'CIF' , 2 => 'NIF', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT');
      $records = ($_SESSION['tax_ident_type_cd'] == 1) || ($_SESSION['tax_ident_type_cd'] == 3) ? $GLOBAL_CONTACT_TYPE_COMPANY : $GLOBAL_CONTACT_TYPE_PERSONAL;
      $this->gridContacts->Columns[COL_TYPE]->ComboBoxEditor->Values = $records;
      $this->gridContacts->Columns[COL_TYPE]->FilterOptions = $records;
      $this->gridContacts->ReadOnly = ($_SESSION['company_id'] == 0);
    }


    function gridContactsSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $user_id = ($_SESSION['parent_user_id'] == 0) || $_SESSION['IsSuperadmin'] ? $_SESSION['user_id'] : $_SESSION['parent_user_id'];
      $company_id = $_SESSION['company_id'];

      $sql = "SELECT contact.*
              FROM contact
                  INNER JOIN company ON contact.contact_list_id = company.contact_list_id
              WHERE company.company_id = {$company_id}";

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlContact->SQL = $sql;
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
          		gridContacts.deselectAll();
							gridContacts._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridContacts->ajaxCall('filter_grid', array(), array($this->gridContacts->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') {
							gridContacts.Insert();
							if (gridContacts.FRowCount == 0) {
								gridContacts_receive_standard_billing_emails_yn_Editor.checked = true;
								gridContacts_receive_standard_accounting_emails_yn_Editor.checked = true;
								gridContacts_receive_standard_hr_emails_yn_Editor.checked = true;
								gridContacts_receive_standard_billing_emails_yn_Editor.checked = true;
								gridContacts_reminder_standard_accounting_emails_yn_Editor.checked = true;
								gridContacts_reminder_standard_personal_taxes_yn_Editor.checked = true;
							}
							return false;
						}
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridContacts.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridContacts.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridContacts.Post(); return false;}
            else if (toolButtonName == 'btnDelete' && (row != "-1") && (row != "")) {
                if (confirm("<?php echo $lbDeleteInformationMsg ?>")) {
										gridContacts.Delete(row);
								}
                else return false;
            }
          }
        //end
        <?php
    }


    function DeleteContactSelected()
    {
      if (count($this->gridContacts->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;

        //Extract user_id of Client admin
        $contact    = $this->gridContacts->SelectedPrimaryKeys;
        $contact_id = implode(",", $contact);

				$this->msgError->Value = '';
	    	$record = sw_get_data_table("contact", "(NOT contact_id in ({$contact_id})) AND contact_list_id = {$_SESSION['contact_list_id']} AND receive_standard_billing_emails_yn = 1");
			  if (!$record) {
				  	$this->msgError->Value = SW_ERROR_RECEIVE_EMAIL_BILLING;
				}

        if ($contact_id && ($this->msgError->Value == '')){
          $connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute("DELETE FROM contact WHERE contact_id in (" . $contact_id . ")");
          $connectionDB->DbConnection->CompleteTrans();
          $this->gridContacts->writeSelectedCells(array());
        }
      }
    }


    function gridContactsJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowContact").value = row;
        //end
        <?php
    }


    function gridContactsInsert($sender, $params)
    {
      //Insert
      if (count($params) == 1)
      {
        $fields = &$params[ 0 ];
      }
      else { //Update
          $fields = &$params[ 1 ];
          $fields[ 'contact_id' ] = $params[ 0 ];
      }

      $fields[ 'tax_ident' ] = sw_clean_caracter_tax_ident($fields[ 'tax_ident' ]);
      $fields[ 'email' ]     = strtolower(trim($fields[ 'email' ]));
      $fields[ 'first_name' ] = ucwords(trim($fields[ 'first_name' ]));
      $fields[ 'last_name' ] = ucwords(trim($fields[ 'last_name' ]));

			$this->msgError->Value = '';
			if (!$fields[ 'receive_standard_billing_emails_yn' ] && $fields[ 'contact_id' ]) {
	    	 $record = sw_get_data_table("contact", "contact_id != {$fields[ 'contact_id' ]} AND contact_list_id = {$_SESSION['contact_list_id']} AND receive_standard_billing_emails_yn = 1");
			   if (!$record) {
				    $this->msgError->Value = SW_ERROR_RECEIVE_EMAIL_BILLING;
				 }
			}

			if ($this->msgError->Value == ''){

	    		//Insert contact
      		if (!$fields[ 'contact_id' ]) {
        		$fields['contact_list_id'] = $_SESSION['contact_list_id'];

		        sw_insert_table($this->gridContacts->Datasource->DataSet->TableName, $fields);
    		  }
      		else {
//        	  $email_notify = array('tstrong@strongabogados.com', 'cvcobo@strongabogados.com');
          	$email_notify = array();
          	if (!$_SESSION['IsSuperadmin']) $email_notify = array('tstrong@strongabogados.com');

	          sw_update_table($this->gridContacts->Datasource->DataSet->TableName, $fields, "contact_id = {$fields['contact_id']}", $email_notify);
      		}
			}

			return ($this->msgError->Value == '');
    }




    function gridContactsRowData($sender, $params)
    {
      Global $GLOBAL_CONTACT_TYPE_COMPANY, $GLOBAL_CONTACT_TYPE_PERSONAL;

      $fields = &$params[ 1 ];

      //Array(0=> '', 1 => 'CIF' , 2 => 'NIF', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT');
      $records = ($_SESSION['tax_ident_type_cd'] == 1) || ($_SESSION['tax_ident_type_cd'] == 3) ? $GLOBAL_CONTACT_TYPE_COMPANY : $GLOBAL_CONTACT_TYPE_PERSONAL;

      $fields[ "contact_type_cd" ] = $records[$fields[ "contact_type_cd" ]];
    }


    function gridContactsJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        var cellvalue = gridContacts.getCellText(rowIndex, <?php echo COL_TYPE;?>);
        var objComboBox = document.getElementById("gridContacts_contact_type_cd_Editor");

        sw_SelectComboBox(objComboBox, cellvalue);

        //end
        <?php
    }



    function gridContactsJSRowEdited($sender, $params)
    {
      Global $lbEmailErrorMsg, $lbRequiredFieldError;
        ?>
        //begin js
        var email = gridContacts.getEditorValue("email");
        var msgError = '';
        email = email.trim();

        if (email != '' && !(<?php echo SW_MASK_EMAIL;?>.test(email))){
        	msgError = msgError + "<?php echo $this->gridContacts->Columns[COL_EMAIL]->Caption . ', ' . $lbEmailErrorMsg; ?>" + '</br>';
        }

        if (msgError != ''){
        	msgError = "<?php echo $lbRequiredFieldError; ?></br><hr/>" + msgError;
          TINY.box.show({html:msgError,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
        }

        return (msgError == '');

        //end
        <?php
    }

    function gridContactsJSDataLoad($sender, $params)
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

    function gridContactsDelete($sender, $params)
    {
			 $this->DeleteContactSelected();
    }

}

global $application;

global $contact;

//Creates the form
$contact=new contact($application);

//Read from resource file
$contact->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $contact->show();

?>