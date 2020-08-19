<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("comctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("db.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit('platinumgrid/lib/Spreadsheet_Excel_Writer.php');
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");


//Class definition
class relation_account_manager extends fmstrong
{
    public $gridCompany = null;
    public $company_id = null;
    public $rowCompany = null;
    public $btnCompany = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $cbIncludeInactive = null;
    public $winProcess = null;
    public $lbSubject = null;
    public $subject = null;
    public $body_template = null;
    public $btnClose = null;
    public $lbTemplate = null;
    public $email_template_id = null;
    public $btnSave = null;
    public $lbContact = null;
    public $cbContact = null;
    public $SelectedKeysField = null;

    function relation_account_managerCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Relation_Account_Manager;
      $this->lbTitle->Visible = True;

      $this->Parameter();
    }

    function Parameter()
    {
      //Grid Company
      Define('COL_SHORT_NAME', $this->gridCompany->findColumnByName('short_name'));
      Define('COL_TAX_ID', $this->gridCompany->findColumnByName('tax_ident'));
      Define('COL_ACCT_MANAGER_ID', $this->gridCompany->findColumnByName('acct_manager_id'));
      Define('COL_ACCOUNTING_ID', $this->gridCompany->findColumnByName('accounting_provider_id'));
      Define('COL_PAYROLL_ID', $this->gridCompany->findColumnByName('payroll_provider_id'));
      Define('COL_CREATED_USER', $this->gridCompany->findColumnByName('created_by_user_id'));
      Define('COL_COMPANY_ID', $this->gridCompany->findColumnByName('company_id'));

      if (!$this->gridCompany->inSession('')){
				$this->winProcess->Caption = btnSendStandardEmail;
        $this->btnSave->Caption = btnCreate . " emails";
        $this->btnClose->Caption = btnCancel;
        $sql = "SELECT email_template_id, subject, body FROM email_template
                 WHERE to_client_yn = 1 AND trigger_type_cd = 'MAN'
                 ORDER BY subject";
        $record = sw_records_array($sql, array('email_template_id', 'subject'));
        $record[0] = "";
        $this->email_template_id->items = $record;
      }

      //Create Button
      if ($_SESSION['IsSuperadmin']){
        $items['btnFilter'] = array(btnFilter, 1, "10");
        $items['btnEdit'] = array(btnEdit, 1, "3");
        $items['btnSave'] = array(btnSave, 1, "5");
        $items['btnCancel'] = array(btnCancel, 1, "4");
        $items['btnSendStandardEmail'] = array(btnSendStandardEmail, 1, "11");
        $items['btnExcel'] = array('Export excel', 1, "12");
      }

      $this->gridCompany->KeyField = 'company_id';
      $this->gridCompany->SortBy = 'short_name';

      $this->btnCompany->Items = $items;
      $this->btnCompany->Visible = isset($items);
      unset($_POST['btnCompanySubmitEvent']);
    }

    function gridCompanyShow($sender, $params)
    {
      Global $language;

      //Column Acct manager
      $sql = 'SELECT acct_manager_id, account_manager_name FROM vw_account_manager ORDER BY account_manager_name';
      $records = sw_records_array($sql, Array('acct_manager_id', 'account_manager_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_ACCT_MANAGER_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_ACCT_MANAGER_ID]->FilterOptions = $records;

      $sql = 'SELECT payroll_provider_id, payroll_provider_name FROM vw_payroll_manager ORDER BY payroll_provider_name';
      $records = sw_records_array($sql, Array('payroll_provider_id', 'payroll_provider_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_PAYROLL_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_PAYROLL_ID]->FilterOptions = $records;

      $sql = 'SELECT accounting_provider_id, accounting_provider_name FROM vw_accountant_manager ORDER BY accounting_provider_name';
      $records = sw_records_array($sql, Array('accounting_provider_id', 'accounting_provider_name'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->FilterOptions = $records;

      $sql = 'SELECT provider_contact_id, username FROM vw_provider_contact ORDER BY username';
      $records = sw_records_array($sql, Array('provider_contact_id', 'username'));
      $records[0] = "";
      $this->gridCompany->Columns[COL_CREATED_USER]->ComboBoxEditor->Values = $records;
      $this->gridCompany->Columns[COL_CREATED_USER]->FilterOptions = $records;

      $this->gridCompany->Columns[COL_ACCT_MANAGER_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_PAYROLL_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_ACCOUNTING_ID]->Visible = $_SESSION['IsSuperadmin'];
      $this->gridCompany->Columns[COL_CREATED_USER]->Visible = $_SESSION['IsSuperadmin'];

			$this->gridCompany->Header->ShowFilterBar = True;
    }


    function gridCompanySQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      Global $language;

      $user_id = $_SESSION['user_id'];

      $this->gridCompany->ReadOnly = (!$_SESSION['IsSuperadmin']);

      $sql = "SELECT company.*, country.{$language}, vw_provider_contact.username,
                     account_manager_name, payroll_provider_name, accounting_provider_name,
										 invoice.invoice_dt
              FROM company
              LEFT JOIN country ON company.country_id = country.country_id
              LEFT JOIN vw_account_manager ON company.acct_manager_id = vw_account_manager.acct_manager_id
              LEFT JOIN vw_payroll_manager ON company.payroll_provider_id = vw_payroll_manager.payroll_provider_id
              LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id
              LEFT JOIN (SELECT user_id, user.status_cd FROM user) as user ON company.user_id = user.user_id
              LEFT JOIN vw_provider_contact ON company.created_by_user_id = vw_provider_contact.provider_contact_id
              LEFT JOIN
								(SELECT company_join_client.company_id, MAX(invoice_issued.invoice_dt) As invoice_dt
								 FROM company
								      INNER JOIN company_join_client ON company.company_id = company_join_client.company_id
							        INNER JOIN invoice_issued ON company_join_client.company_client_id = invoice_issued.company_client_id
							   GROUP BY company_join_client.company_id) AS invoice
							ON company.company_id = invoice.company_id ";

      if (!$_SESSION['IsSuperadmin']){
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "(company.company_id in ({$_SESSION['company_user']}))";
      }

      if (!$this->cbIncludeInactive->Checked) {
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "((user.status_cd = 'a') OR (user.status_cd is null))";
      }

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql))){
          $sql .=  "WHERE " . $filterSql;
			}

      if ($sortSql) {
				$sortSql = " ORDER BY {$sortSql}";
			}

      $this->sqlCompany->SQL = $sql . $sortSql;
    }


    function btnCompanyJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowCompany").value;

          if (toolButton == 'btnCompany'){
        		if (toolButtonName == 'btnFilter') {
          		gridCompany.deselectAll();
							gridCompany._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridCompany->ajaxCall('filter_grid', array(), array($this->gridCompany->Name)); ?>
          		return false;
        		}
            else if ((toolButtonName == 'btnSendStandardEmail')){
              var keys = [];
              for (var row in gridCompany.SelectedCells) {
                if (typeof(gridCompany.SelectedCells[row]) != "function" &&
              	  (gridCompany.SelectedCells[row] != '') &&
                  (gridCompany.SelectedCells[row] != null)) {
                  keys.push(gridCompany.getPrimaryKey(row));
                }
              }

              if (findObj('SelectedKeysField').value = keys.join(',')){
                if (toolButtonName == 'btnSendStandardEmail'){
                  var email_draft = '<?php $email = sw_get_data_table("email", "(user_id = {$_SESSION['user_id']}) AND (sent_yn = 0)", "subject"); echo $email["subject"];?>'
                  if ((email_draft.length > 0) && confirm('<?php echo $lblFileViewDraftEmailBeforeMsg; ?>')) {
                    window.location.href = "email_draft.php?email_type=draft";
                    return false;
                  }
                }
                return true;
              }
              return false;
            }
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridCompany.Edit(row); return false; }
            else if (toolButtonName == 'btnCancel') { gridCompany.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridCompany.Post(); return false;}
          }

        //end
        <?php
    }

    function gridCompanyJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("rowCompany").value = row;
        document.getElementById("company_id").value = gridCompany.getSelectedPrimaryKey();
        //end
        <?php
    }


    function btnCompanyClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnExcel")
      {
        $this->gridCompany->exportGridToXLSDownload("{$this->lbTitle->Caption}.xls", "{$this->lbTitle->Caption}", true);
      } else  if ($toolButtonName == "btnSendStandardEmail"){
        $this->email_template_id->ItemIndex = 0;
        $this->subject->Text = '';
        $this->body_template->Text = '';
        $this->cbContact->items = array();
        $this->lbContact->Visible = False;
        $this->cbContact->Visible = False;
        $this->winProcess->ShowModal();
      }

    }

    function cbIncludeInactiveJSChange($sender, $params)
    {
        ?>
        //begin js
        gridCompany.Refresh();
        //end
        <?php
    }

    function gridCompanyUpdate($sender, $params)
    {
      Global $aLegacyTaxType;

      $fields = &$params[ 1 ];
      $fields['company_id'] = &$params[ 0 ];
      $fields['dh_legacy_tax_type'] = $aLegacyTaxType[$fields['dh_legacy_tax_type']];

      $where = "company_id = " . $fields['company_id'];
      sw_notify_change_account_manager($fields, $where);
      sw_update_table("company", $fields, $where);
    }

    function email_template_idChange($sender, $params)
    {
      Global $email_to_cd_template, $email_to_cd, $lbClientWithoutContactMarked;

      $this->btnSave->Enabled = false;
      $this->subject->Text = '';
      $this->body_template->Text = '';
      $this->cbContact->items = array();
      $this->lbContact->Visible = False;
      $this->cbContact->Visible = False;
      if ($record = sw_get_data_table("email_template", "email_template_id = {$this->email_template_id->ItemIndex}")){
        $this->subject->Text = $record['subject'];
        $this->body_template->Text = $record['body'];
        $this->btnSave->Enabled = True;

         //search email contact
        $email_cd = $email_to_cd_template[$record['email_to_cd']];
        $sql = "SELECT company.company_id, company.short_name FROM company INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
                WHERE (company.company_id in ({$this->SelectedKeysField->Value})) AND (contact.{$email_cd} = true) AND (LENGTH(TRIM(email)) != 0)";
        $record_contact = sw_records_array($sql, array('company_id', 'short_name'));

        $sql = "SELECT company.company_id, company.short_name FROM company
                WHERE (company.company_id in ({$this->SelectedKeysField->Value}))";
        $company = sw_records_array($sql, array('company_id', 'short_name'));
        $record_contact = array_diff($company, $record_contact);
        $this->cbContact->items = $record_contact;

        $this->lbContact->Visible = True;
        $this->cbContact->Visible = True;
        $email_to = $email_to_cd[$record['email_to_cd']] ? $email_to_cd[$record['email_to_cd']] : "Unspecified";
        $this->lbContact->Caption = $lbClientWithoutContactMarked . ": {$email_to} (" . count($this->cbContact->items) . ")";
      }
    }

    function btnCloseClick($sender, $params)
    {
      $this->winProcess->Hide();
    }

    function btnSaveClick($sender, $params)
    {
      Global $email_to_cd_template;

      $company = explode(",", $this->SelectedKeysField->Value);
      $record_template = sw_get_data_table("email_template", "email_template_id = '{$this->email_template_id->ItemIndex}'");
      $record_template['body'] = $this->body_template->Text;

      foreach ($company as $company_id){
        //search email contact
        $email_cd = $email_to_cd_template[$record_template['email_to_cd']];
        $sql = "SELECT contact.* FROM company INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
                WHERE (company.company_id = {$company_id}) AND (contact.{$email_cd} = true) AND (LENGTH(TRIM(email)) != 0)";
        $record_contact = sw_records_array($sql, array('contact_id', 'email', 'first_name'));

        sw_created_email_draft($company_id, $record_template, $record_contact);
      }
      $this->winProcess->Hide();
      redirect_url( "email_draft.php?email_type=draft" );

    }


    function relation_account_managerJSLoad($sender, $params)
    {
      $create_email_template = $_SESSION['create_email_template'];
        ?>
        //begin js
        var create_email = '<?php echo $create_email_template;?>';
        if ((create_email !== '') && confirm(create_email)) {
          window.location.href = "email_draft.php?email_type=draft";
        }
				<?php unset($_SESSION['create_email_template']);?>
        //end
        <?php
    }

    function relation_account_managerShowHeader($sender, $params)
    {
      Global $language;
      echo "<script type='text/javascript' src='include/strongweber.js'></script>
            <link href='include/tinybox.css' rel='stylesheet' type='text/css' />
            <script type='text/javascript' src='include/tinybox.js'></script>";

      echo "<script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
            <script type='text/javascript'>
            tinyMCE.init({
                // General options
                forced_root_block : false,
                convert_urls : false,
                relative_urls : false,
                remove_script_host : false,
                mode : 'textareas',
                language : '" . $language . "',
                theme : 'advanced',
                plugins : 'autolink,style,layer,table,save,advhr,inlinepopups,searchreplace,print,paste,noneditable,nonbreaking,xhtmlxtras,template',

                // Theme options
                theme_advanced_buttons1 : 'newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect',
                theme_advanced_buttons2 : 'search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
                theme_advanced_buttons3 : 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
                theme_advanced_buttons4 : 'insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage',

                theme_advanced_toolbar_location : 'top',
                theme_advanced_toolbar_align : 'left',
                theme_advanced_statusbar_location : 'none',
                theme_advanced_resizing : false,

                // Skin options
                skin : 'o2k7',
                skin_variant : 'silver',

                // Example content CSS (should be your site CSS)
                //content_css : 'css/example.css',

                // Drop lists for link/image/media/template dialogs
                template_external_list_url : 'js/template_list.js',
                external_link_list_url : 'js/link_list.js',
                external_image_list_url : 'js/image_list.js',
                media_external_list_url : 'js/media_list.js',

                // Replace values for the template plugin
                template_replace_values : {
                  username : 'Some User',
                  staffid : '991234'
                }
            });

            </script> ";
    }



}

global $application;

global $relation_account_manager;

//Creates the form
$relation_account_manager=new relation_account_manager($application);

//Read from resource file
$relation_account_manager->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $relation_account_manager->show();

?>