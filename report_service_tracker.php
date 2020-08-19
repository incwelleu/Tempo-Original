<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/accounting.php");
require_once("include/create_grid_column.php");

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
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtradiobuttonlist.inc.php");


//Class definition
class report_service_tracker extends fmstrong
{
    public $service_type_id = null;
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
    public $btnCompany = null;
    public $gbServiceType = null;
    public $cbIncludeInactive = null;
    public $cbShowWorkCompleted = null;
    public $company_id = null;
    public $rowCompany = null;
    public $SelectedKeysField = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $gridCompany = null;

    function report_service_trackerCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Service_tracker;
      $this->lbTitle->Visible = True;

      $this->Parameter();
    }

    function Parameter()
    {
      Global $language, $email_from_template;

      //Grid Company
      if (!$this->gridCompany->inSession('')){
			  $this->CreatedColumnGrid();

        $this->gbServiceType->Caption = SW_CAPTION_SERVICE_TYPE;
        $this->cbIncludeInactive->Caption = SW_INCLUDE_INACTIVE_USER;
        $this->cbShowWorkCompleted->Caption = SW_SHOW_WORK_COMPLETED;

        $sql = "SELECT service_type_id, description_{$language} AS service_type_name FROM service_type
                WHERE service_tracker_yn = 1
                ORDER BY description_{$language}";
        $record_service_type = sw_records_array($sql, array('service_type_id', 'service_type_name'));
        $item = array();
        foreach ($record_service_type as $record_service_name){
          $item[] = $record_service_name;
        }
        $this->service_type_id->Items = $item;
        $this->service_type_id->ItemIndex = 0;

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

      Define('COL_ACCT_MANAGER_ID', $this->gridCompany->findColumnByName('acct_manager_id'));
      Define('COL_CONST_DT', $this->gridCompany->findColumnByName('const_dt'));
      Define('COL_COMPANY_ID', $this->gridCompany->findColumnByName('company_id'));
      Define('COL_PDF', $this->gridCompany->findColumnByName('invoice_pdf'));
      Define('COL_LINK', $this->gridCompany->findColumnByName('link'));

      //Create Button
      if ($_SESSION['IsSuperadmin']){
        $items['btnFilter'] = array(btnFilter, 1, "2");
        $items['btnSendStandardEmail'] = array(btnSendStandardEmail, 1);
        $items['btnExcel'] = array('Export excel', 1);
      }

      $this->btnCompany->Items = $items;
      $this->btnCompany->Visible = isset($items);
      unset($_POST['btnCompanySubmitEvent']);

    }


    function CreatedColumnGrid()
    {
      GLOBAL $language;

      $property = array(CAN_EDIT => False);  //CAN_EDIT => False
      $columns[] = sw_create_grid_column('short_name', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('invoice_number', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('invoice_dt', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('invoice_pdf', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('account_manager_name', $this->gridCompany);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                        CAPTION => SW_CAPTION_CONSTITUTION_DT, CAN_EDIT => False,
      									DISPLAY => 'DateOnly', FORMAT=>'Y-m-d', ALIGNMENT => 'agCenter',
                        DEFAULT_FILTER => 'FilterLessThanOrEqualTo', WIDTH => 100);
      $columns[] = sw_create_grid_column('const_dt', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
      									CAPTION => SW_CAPTION_COMPLETED_DT, DISPLAY => 'DateOnly',
      									FORMAT => 'Y-m-d', ALIGNMENT => 'agCenter',
                        CAN_EDIT => False, WIDTH => 100);
      $columns[] = sw_create_grid_column('work_completed_dt', $this->gridCompany, $property);

      $property = array(CAN_EDIT => False);  //CAN_EDIT => False
      $columns[] = sw_create_grid_column('description', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('tax_ident', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('first_name', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('last_name', $this->gridCompany, $property);

			$property = array(CAN_EDIT => False, CAN_MOVE => False, CAPTION => btnInvoiceAddress,
                        CAN_FILTER => True, WIDTH => 200);
      $columns[] = sw_create_grid_column('mail_address', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn',
                        CAN_EDIT => False, CAPTION => SW_CAPTION_NOTES,
                        MAX_LENGTH => 255, WIDTH => 250);
      $columns[] = sw_create_grid_column('notes', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('link', $this->gridCompany);

      $this->gridCompany->Columns = $columns;
      $this->gridCompany->KeyField = 'company_id';
      $this->gridCompany->SortBy = 'work_completed_dt desc, short_name';
      $this->gridCompany->ReadOnly = True;
      $this->gridCompany->init();
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

      $this->gridCompany->Columns[COL_CONST_DT]->Visible = ($this->service_type_id->ItemIndex == 0);
    }


    function gridCompanySQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      Global $language;

      $user_id = $_SESSION['user_id'];

      $this->gridCompany->ReadOnly = (!$_SESSION['IsSuperadmin']);

      $service_type_id = $this->service_type_id->Items[$this->service_type_id->ItemIndex];

      $sql = "SELECT DISTINCT company.company_id, company.short_name, company.company_name, company.tax_ident,
                invoice_issued.invoice_number, invoice_issued.invoice_dt, '' AS invoice_pdf, invoice_issued.link,
                company.const_dt, account_manager_name, line_item.work_completed_dt,
                line_item.description, contact.first_name, contact.last_name,
                CONCAT(company.mail_street_address, ' - ', company.mail_city, ' - ', company.mail_province, ' - ', company.mail_post_code, ' ', country.{$language}) AS mail_address,
                line_item.notes
              FROM company
                INNER JOIN line_item ON company.company_id = line_item.company_id
                INNER JOIN service_type ON line_item.service_type_id = service_type.service_type_id
                LEFT JOIN country ON company.mail_country_id = country.country_id
                LEFT JOIN vw_account_manager ON company.acct_manager_id = vw_account_manager.acct_manager_id
                LEFT JOIN (SELECT user_id, user.status_cd FROM user) as user ON company.user_id = user.user_id
                LEFT JOIN (SELECT contact.contact_list_id, MIN(contact.contact_id) AS contact_id
                           FROM contact WHERE contact.receive_standard_billing_emails_yn = 1
                           GROUP BY contact_list_id) AS contact_first ON company.contact_list_id = contact_first.contact_list_id
                LEFT JOIN contact ON contact_first.contact_id = contact.contact_id
                LEFT JOIN invoice_issued ON line_item.invoice_issued_id = invoice_issued.invoice_issued_id
              WHERE (line_item.status_cd in ('" . SW_STATUS_LI_TO_INVOICE . "', '" . SW_STATUS_LI_INVOICED . "')) AND
                    (service_type.description_{$language} = '{$service_type_id}')";

      if (!$this->cbIncludeInactive->Checked) {
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "((user.status_cd = 'a') OR (user.status_cd is null))";
      }

      if (!$this->cbShowWorkCompleted->Checked) {
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "((line_item.work_completed_dt = '0000-00-00') OR IsNull(line_item.work_completed_dt))";
      }

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .=  " AND " . $filterSql;

      if ($sortSql) $sortSql = " ORDER BY {$sortSql}";

      $this->sqlCompany->SQL = $sql . $sortSql;
    }


    function btnCompanyJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lblFileViewDraftEmailBeforeMsg;

      $exist_email_draft = sw_get_data_table("email", "(user_id = {$_SESSION['user_id']}) AND (sent_yn = 0)", "subject");
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

        if (col == <?php echo COL_PDF;?> && selected)
        {
          var cellValue = sender.getCellText(row, <?php echo COL_LINK;?>);
          if (cellValue){
            window.open(cellValue + "?random=" + (new Date()).getTime() + Math.floor(Math.random() * 1000000),"_blank","", false);
						sender.SelectedCol = 0;
          }
        }
        //end
        <?php
    }


    function btnCompanyClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnSendStandardEmail"){
        $this->email_template_id->ItemIndex = 0;
        $this->subject->Text = '';
        $this->body_template->Text = '';
        $this->cbContact->items = array();
        $this->lbContact->Visible = False;
        $this->cbContact->Visible = False;
        $this->winProcess->ShowModal();
      }
      else if ($toolButtonName == "btnExcel"){
        $this->gridCompany->exportGridToXLSDownload("{$this->lbTitle->Caption}.xls", "{$this->lbTitle->Caption}", true);
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

    function report_service_trackerShowHeader($sender, $params)
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

    function gridCompanyRowData($sender, $params)
    {
      $fields = &$params[ 1 ];

      $fields['const_dt'] = $fields['const_dt'] == '0000-00-00' ? '' : $fields['const_dt'];
      $fields['work_completed_dt'] = $fields['work_completed_dt'] == '0000-00-00' ? '' : $fields['work_completed_dt'];

      if (isset($fields['invoice_pdf']) && $fields['link']){
        $fields['invoice_pdf'] = 'images/ftp/1px.gif';
        $file = utf8_decode($fields['link']);
        if (($file != "") && file_exists($file))
        {
          $fields['invoice_pdf'] = 'images/ftp/pdf.gif';
        }else $fields['link'] = "";
      }
    }


    function report_service_trackerJSLoad($sender, $params)
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

    function service_type_idJSClick($sender, $params)
    {
        ?>
        //begin js
        gridCompany.Refresh();
        //end
        <?php
    }


//          var ed = tinyMCE.get('body_template');
//          ed.setProgressState(1); // Show progress
//          window.setTimeout(function() {
//            var edit = findObj('body_template');
//            tinyMCE.execInstanceCommand('body_template', 'mceSetContent' , false, edit.value, true);
//            ed.setProgressState(0);
//           }, 3000);
//           return true;

}

global $application;

global $report_service_tracker;

//Creates the form
$report_service_tracker=new report_service_tracker($application);

//Read from resource file
$report_service_tracker->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $report_service_tracker->show();

?>