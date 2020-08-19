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


//Class definition
class report_regular_service_client extends fmstrong
{
    public $lbContact = null;
    public $btnSave = null;
    public $SelectedKeysField = null;
    public $btnClose = null;
    public $body_template = null;
    public $subject = null;
    public $lbSubject = null;
    public $winEmail = null;
    public $service_type_id = null;
    public $gbServiceType = null;
    public $gridCompany = null;
    public $company_id = null;
    public $rowCompany = null;
    public $btnCompany = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $lbTemplate = null;
    public $email_template_id = null;
    public $cbContact = null;
    public $cbIncludeServicesEnded = null;
    public $winChange = null;
    public $btnCloseChange = null;
    public $lbChange = null;
    public $cbChange = null;
    public $btnChange = null;

    function report_regular_service_clientCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Regular_service_client;
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
        $this->cbIncludeServicesEnded->Caption = SW_INCLUDE_SERVICES_ENDED;
        $sql = "SELECT service_type_id, description_{$language} AS service_type_name FROM service_type
                WHERE send_standard_email_yn = 1
                ORDER BY description_{$language}";
        $record_service_type = sw_records_array($sql, array('service_type_id', 'service_type_name'));
        $service_type_item = array();
        foreach ($record_service_type as $key => $service_type){
				  $service_type_item[$key] = array($service_type, ($key == 10 ? true : false));
        }
        $this->service_type_id->Items = $service_type_item;
      }

      Define('COL_SHORT_NAME', $this->gridCompany->findColumnByName('short_name'));
      Define('COL_COUNTRY', $this->gridCompany->findColumnByName('country_id'));
      Define('COL_TAX_ID', $this->gridCompany->findColumnByName('tax_ident'));
      Define('COL_ACCT_MANAGER_ID', $this->gridCompany->findColumnByName('acct_manager_id'));
      Define('COL_ACCOUNTING_ID', $this->gridCompany->findColumnByName('accounting_provider_id'));
      Define('COL_PAYROLL_ID', $this->gridCompany->findColumnByName('payroll_provider_id'));
      Define('COL_CREATED_USER', $this->gridCompany->findColumnByName('created_by_user_id'));
      Define('COL_COMPANY_ID', $this->gridCompany->findColumnByName('company_id'));
      Define('COL_STATUS_CD', $this->gridCompany->findColumnByName('status_cd'));

      //Create Button
      if ($_SESSION['IsSuperadmin']){
        $items['btnFilter'] = array(btnFilter, 1, "2");
        $items['btnSendStandardEmail'] = array(btnSendStandardEmail, 1, "4");
        $items['btnExcel'] = array('Export excel', 1, "3");
        $items['btnChangeAccountManager'] = array(btnChangeAccountManager, 1);
        $items['btnChangeAccountant'] = array(btnChangeAccountant, 1);
        $items['btnChangePayroll'] = array(btnChangePayroll, 1);
      }

      $this->btnCompany->Items = $items;
      $this->btnCompany->Visible = isset($items);
      unset($_POST['btnCompanySubmitEvent']);

    }

    function CreatedColumnGrid()
    {
      GLOBAL $language, $GLOBAL_DOCUMENT_TYPE;

      $property = array(CAN_EDIT => False);  //CAN_EDIT => False
      $columns[] = sw_create_grid_column('short_name', $this->gridCompany, $property);

      $columns[] = sw_create_grid_column('tax_ident_type_cd', $this->gridCompany, array(CAN_EDIT => False, FILTER_OPTIONS => $GLOBAL_DOCUMENT_TYPE));

      $columns[] = sw_create_grid_column('tax_ident', $this->gridCompany, $property);
      $columns[] = sw_create_grid_column('account_manager_name', $this->gridCompany);
      $columns[] = sw_create_grid_column('accounting_provider_name', $this->gridCompany);
      $columns[] = sw_create_grid_column('payroll_provider_name', $this->gridCompany);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
      									CAPTION => SW_CAPTION_START_DT,
      									DISPLAY => 'DateOnly', FORMAT=>'M/Y', ALIGNMENT => 'agCenter',
                        DEFAULT_FILTER => 'FilterLessThanOrEqualTo', WIDTH => 100, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('service_start_dt', $this->gridCompany, $property);
    	$property[CAPTION] = SW_CAPTION_END_DT;
      $columns[] = sw_create_grid_column('service_end_dt', $this->gridCompany, $property);

      $columns[] = sw_create_grid_column('status_cd', $this->gridCompany, array(CAN_EDIT => False));
      $columns[] = sw_create_grid_column('description', $this->gridCompany, array(CAN_EDIT => False));

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_BANK_ACCOUNT,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 200, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('account_number_cd', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_REGADDRESS,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 200, CAN_EDIT => False, CAN_SORT => FALSE);
      $columns[] = sw_create_grid_column('address', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_REGCITY,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 100, CAN_EDIT => False, CAN_SORT => FALSE);
      $columns[] = sw_create_grid_column('city', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => SW_CAPTION_MAILCOUNTRY,
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 100, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('country_name', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Notario',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 100, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('const_notary', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Tomo',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('tomo', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Folio',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('folio', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Hoja',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50, CAN_EDIT => False);
      $columns[] = sw_create_grid_column('hoja', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridDateTimeColumn',
                        CAN_MOVE => False,
                        CAN_FILTER => False,
                        ALIGNMENT => 'agCenter',
                        CAPTION => 'Fecha alta',
                        DEFAULT_FILTER => 'Contains',
                        DISPLAY => 'DateOnly',
                        FORMAT => 'Y-m-d',
                        TIME_FORMAT => 'tt24Hour',
                        WIDTH => 90,
												CAN_EDIT => False);
      $columns[] = sw_create_grid_column('start_dt', $this->gridCompany, $property);
      $property[CAPTION] = 'Fecha baja';
      $columns[] = sw_create_grid_column('end_dt', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'IAE',
                        DEFAULT_FILTER => 'Equal',
                        WIDTH => 50,
												CAN_EDIT => False);
      $columns[] = sw_create_grid_column('iae_cd', $this->gridCompany, $property);

      $property = array(TYPE_COLUMN => 'JTPlatinumGridTextColumn', CAN_MOVE => False,
                        CAPTION => 'Actividad',
                        DEFAULT_FILTER => 'Contains',
                        WIDTH => 250,
												CAN_EDIT => False);
      $columns[] = sw_create_grid_column('economic_activity_name', $this->gridCompany, $property);


      $property = array(CAN_EDIT => False);  //CAN_EDIT => False
      $columns[] = sw_create_grid_column('company_name', $this->gridCompany, $property);

      $columns[] = sw_create_grid_column('created_by_user_id', $this->gridCompany);
      $columns[] = sw_create_grid_column('created_dt', $this->gridCompany);


      $property = array(CAN_EDIT => False, VISIBLE => False);
      $columns[] = sw_create_grid_column('company_id', $this->gridCompany, $property);


      $this->gridCompany->Columns = $columns;
      $this->gridCompany->KeyField = 'company_id';
      $this->gridCompany->SortBy = 'short_name';
      $this->gridCompany->ReadOnly = True;
			$this->gridCompany->Header->ShowFilterBar = True;
			$this->gridCompany->ShowEditColumn = False;
      $this->gridCompany->init();
    }

    function gridCompanyShow($sender, $params)
    {
      Global $language, $GLOBAL_USER_STATUS_CODE;

      //Column Country
      $sql = "SELECT country.*, {$language} FROM country ORDER BY {$language}";
      $records = sw_records_array($sql, Array('country_id', $language));
      $this->gridCompany->Columns[COL_COUNTRY]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridCompany->Columns[COL_COUNTRY]->FilterOptions = $records;
      $this->gridCompany->Columns[COL_COUNTRY]->TextField = $language;


      $this->gridCompany->Columns[COL_STATUS_CD]->ComboBoxEditor->Values = $GLOBAL_USER_STATUS_CODE;
      $filter = $GLOBAL_USER_STATUS_CODE;
      $filter[''] = '';
      $this->gridCompany->Columns[COL_STATUS_CD]->FilterOptions = $filter;

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
    }


    function gridCompanySQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      Global $language, $GLOBAL_DOCUMENT_TYPE, $GLOBAL_USER_STATUS_CODE;

      $user_id = $_SESSION['user_id'];

      $this->gridCompany->ReadOnly = (!$_SESSION['IsSuperadmin']);

      $sql = "SELECT DISTINCT company.company_id, company.short_name, company.company_name,
			 						   company.tax_ident_type_cd, company.tax_ident, company.created_dt,
  	  							 company.regaddress_street, company.regaddress_street_no, company.regaddress_floor,
	    							 company.regaddress_door, company.regaddress_post_code,
										 company.regaddress_city, company.regaddress_province,
                     country.{$language} as country_name, vw_provider_contact.username,
                     account_manager_name, payroll_provider_name, accounting_provider_name,
                     CONCAT(company_bank_account.iban_prefix_cd, ' ', company_bank_account.account_number_cd) as account_number_cd,
                     company_bank_account.have_online_access_yn,
											vw_company_activity.const_notary, vw_company_activity.tomo,
                      vw_company_activity.folio, vw_company_activity.hoja,
                      vw_company_activity.iae_cd, vw_company_activity.start_dt,
                      vw_company_activity.end_dt, vw_company_activity.economic_activity_name,
											street_type.description AS street_type,
                      MIN(line_item.service_start_dt) AS service_start_dt,
											MAX(line_item.service_end_dt) AS service_end_dt, service.description_{$language} AS description,
											user.status_cd
              FROM company
                INNER JOIN line_item ON company.company_id = line_item.company_id
                INNER JOIN service ON line_item.service_id = service.service_id AND service.service_type_id != 0
                LEFT JOIN country ON company.mail_country_id = country.country_id
                LEFT JOIN vw_account_manager ON company.acct_manager_id = vw_account_manager.acct_manager_id
                LEFT JOIN vw_payroll_manager ON company.payroll_provider_id = vw_payroll_manager.payroll_provider_id
                LEFT JOIN vw_accountant_manager ON company.accounting_provider_id = vw_accountant_manager.accounting_provider_id
                LEFT JOIN (SELECT user_id, user.status_cd FROM user) as user ON company.user_id = user.user_id
                LEFT JOIN vw_provider_contact ON company.created_by_user_id = vw_provider_contact.provider_contact_id
                LEFT JOIN company_bank_account On company.company_id = company_bank_account.company_id AND is_primary_account_yn = 1
                LEFT JOIN vw_company_activity ON company.company_id = vw_company_activity.company_id AND vw_company_activity.main_activity_yn = 1
								LEFT JOIN street_type ON company.regaddress_street_type_id = street_type.street_type_id
              WHERE (line_item.status_cd = '" . SW_STATUS_LI_SERVICE . "')";

      if(strpos($filterSql, 'tax_ident_type_cd') !== False)
      {
         $Column = $sender->Columns[$sender->findColumnByFieldName('tax_ident_type_cd')];
         $tax_ident_type_cd = array_search($Column->Filter, $GLOBAL_DOCUMENT_TYPE);
         $filterSql = str_replace("tax_ident_type_cd LIKE '%{$Column->Filter}%'", "tax_ident_type_cd = {$tax_ident_type_cd}", $filterSql);
      }

      if(strpos($filterSql, 'status_cd') !== False)
      {
         $Column = $sender->Columns[$sender->findColumnByFieldName('status_cd')];
         $filterSql = str_replace("status_cd LIKE '{$Column->Filter}%'", "user.status_cd = '{$Column->Filter}'", $filterSql);
      }

      if (!$_SESSION['IsSuperadmin']){
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "(company.company_id in ({$_SESSION['company_user']}))";
      }

      if (!$this->cbIncludeServicesEnded->Checked) {
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "((CURDATE() >= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
                    		 (CURDATE() <= DATE_FORMAT(line_item.service_start_dt ,'%Y-%m-01')) OR
                         (line_item.service_start_dt IS NULL) OR
                         (line_item.service_start_dt = '0000-00-00')
                        ) AND
                        ((CURDATE() <= LAST_DAY(line_item.service_end_dt)) OR
                         (line_item.service_end_dt IS NULL) OR
                         (line_item.service_end_dt = '0000-00-00')) ";
      }else

      $filter_service_type = array();
      foreach ($this->service_type_id->items as $key => $service_type){
				if ($service_type[1]) {
					$filter_service_type[] = $key;
				}
      }
      if ($filter_service_type) {
         $service_type_id = implode(",", $filter_service_type);
         $filterSql .= $filterSql ? " AND " : "";
         $filterSql .= "(service.service_type_id in ({$service_type_id}))";
      }


      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql))){
          $sql .=  " AND " . $filterSql;
			}

      $sql .= " GROUP BY company.company_id, company.short_name, company.company_name, company.tax_ident_type_cd, company.tax_ident,
                     company.created_dt, country.{$language}, vw_provider_contact.username,
                     account_manager_name, payroll_provider_name, accounting_provider_name,
                     CONCAT(company_bank_account.iban_prefix_cd, ' ', company_bank_account.account_number_cd),
                     company_bank_account.have_online_access_yn,
											vw_company_activity.const_notary, vw_company_activity.tomo,
                      vw_company_activity.folio, vw_company_activity.hoja,
                      vw_company_activity.iae_cd, vw_company_activity.start_dt,
                      vw_company_activity.end_dt, vw_company_activity.economic_activity_name,
											street_type.description,
											service.description_{$language}, user.status_cd";

      if ($sortSql){
				$sortSql = " ORDER BY {$sortSql}";
			}

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
            else if ((toolButtonName == 'btnSendStandardEmail') ||
										 (toolButtonName == 'btnChangeAccountManager') ||
							 			 (toolButtonName == 'btnChangeAccountant') ||
							 			 (toolButtonName == 'btnChangePayroll')){
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
        //end
        <?php
    }


    function btnCompanyClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnSendStandardEmail"){

				$this->winEmail->Caption = btnSendStandardEmail;
        $this->btnSave->Caption = btnCreate . " emails";
        $this->btnClose->Caption = btnCancel;
        $sql = "SELECT email_template_id, subject, body FROM email_template
                 WHERE to_client_yn = 1 AND trigger_type_cd = 'MAN'
                 ORDER BY subject";
        $record = sw_records_array($sql, array('email_template_id', 'subject'));
        $record[0] = "";
        $this->email_template_id->items = $record;

        $this->email_template_id->ItemIndex = 0;
        $this->subject->Text = '';
        $this->body_template->Text = '';
        $this->cbContact->items = array();
        $this->lbContact->Visible = False;
        $this->cbContact->Visible = False;
        $this->winEmail->ShowModal();
      }
			else if ($toolButtonName == "btnChangeAccountManager" ||
							 $toolButtonName == "btnChangeAccountant" ||
							 $toolButtonName == "btnChangePayroll"){

        $this->winChange->Caption = constant($toolButtonName);
        $this->btnChange->Caption = btnSave;
        $this->btnCloseChange->Caption = btnCancel;
				$this->lbChange->Caption = SW_CAPTION_USER;

				if ($toolButtonName == "btnChangeAccountManager") {
					$sql = "SELECT acct_manager_id as id, username FROM vw_account_manager
                 	 WHERE status_cd = 'a'
                 	 ORDER BY username";
				} else if ($toolButtonName == "btnChangeAccountant") {
					$sql = "SELECT 	accounting_provider_id as id, username FROM vw_accountant_manager
                 	 WHERE status_cd = 'a'
                 	 ORDER BY username";
				} else if ($toolButtonName == "btnChangePayroll") {
					$sql = "SELECT payroll_provider_id as id, username FROM vw_payroll_manager
                 	 WHERE status_cd = 'a'
                 	 ORDER BY username";
				}

        $record = sw_records_array($sql, array('id', 'username'));
        $record[0] = "";
        $this->cbChange->items = $record;
				$this->cbChange->ItemIndex = 0;

        $this->winChange->ShowModal();
      }
      else if ($toolButtonName == "btnExcel"){
        $this->gridCompany->exportGridToXLSDownload("{$this->lbTitle->Caption}.xls", "{$this->lbTitle->Caption}", true);
      }
    }

    function report_regular_service_clientShowHeader($sender, $params)
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
      $this->winEmail->Hide();
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
      $this->winEmail->Hide();
      redirect_url( "email_draft.php?email_type=draft" );
    }

    function gridCompanyRowData($sender, $params)
    {
			Global $GLOBAL_DOCUMENT_TYPE, $GLOBAL_USER_STATUS_CODE;
      $fields = &$params[ 1 ];

      $fields['service_start_dt'] = $fields['service_start_dt'] == '0000-00-00' ? '' : $fields['service_start_dt'];
      $fields['service_end_dt'] = $fields['service_end_dt'] == '0000-00-00' ? '' : $fields['service_end_dt'];
      $fields['tax_ident_type_cd'] = $GLOBAL_DOCUMENT_TYPE[$fields['tax_ident_type_cd']];

	  	$fields['address'] = trim($fields["street_type"]);
  	  $fields['address'] .= trim($fields["regaddress_street"]) != "" ? " " . trim($fields["regaddress_street"]) : "";
    	$fields['address'] .= trim($fields["regaddress_street_no"]) != "" ? " " . trim($fields["regaddress_street_no"]) : "";
    	$fields['address'] .= trim($fields["regaddress_floor"]) != "" ? ", " . trim($fields["regaddress_floor"]) : "";
	    $fields['address'] .= trim($fields["regaddress_door"]) != "" ? " " . trim($fields["regaddress_door"]) : "";
			$fields['post_code'] = trim($fields["regaddress_post_code"]);
			$fields['city'] = trim($fields["regaddress_city"]);
			$fields['province'] = trim($fields["regaddress_province"]);
      $fields[ "status_cd" ] = $GLOBAL_USER_STATUS_CODE[$fields[ "status_cd" ]];
    }


    function report_regular_service_clientJSLoad($sender, $params)
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

    function cbIncludeInactiveJSChange($sender, $params)
    {
        ?>
        //begin js
        gridCompany.Refresh();
        //end
        <?php
    }

    function btnCloseChangeClick($sender, $params)
    {
      $this->winChange->Hide();
    }

    function btnChangeClick($sender, $params)
    {
			Global $connectionDB;

			if ($this->winChange->Caption == constant("btnChangeAccountManager")) {
				$field = "acct_manager_id";

				$record_user = sw_get_data_table("vw_account_manager", "acct_manager_id = {$this->cbChange->ItemIndex}", "account_manager_name");
				$record_user['account_manager_name'] = $record_user ? $record_user['account_manager_name'] : "(blank)";
				$message = "assigned account manager to {$record_user['account_manager_name']}";
				$note = "<strong>Auto " . date('Y-m-d') . " ({$_SESSION['username']}):</strong> {$message} <br/><br/>";

			} else if ($this->winChange->Caption == constant("btnChangeAccountant")) {
				$field = "accounting_provider_id";

				$record_user = sw_get_data_table("vw_accountant_manager", "accounting_provider_id = {$this->cbChange->ItemIndex}", "accounting_provider_name");
				$record_user['accounting_provider_name'] = $record_user ? $record_user['accounting_provider_name'] : "(blank)";
				$message = "assigned accounting provider to {$record_user['accounting_provider_name']}";
				$note = "<strong>Auto " . date('Y-m-d') . " ({$_SESSION['username']}):</strong> {$message} <br/><br/>";

			} else if ($this->winChange->Caption == constant("btnChangePayroll")) {
				$field = "payroll_provider_id";

				$record_user = sw_get_data_table("vw_payroll_manager", "payroll_provider_id = {$this->cbChange->ItemIndex}", "payroll_provider_name");
				$record_user['payroll_provider_name'] = $record_user ? $record_user['payroll_provider_name'] : "(blank)";
				$message = "assigned payroll provider to {$record_user['payroll_provider_name']}";
				$note = "<strong>Auto " . date('Y-m-d') . " ({$_SESSION['username']}):</strong> {$message} <br/><br/>";
			}


			$updateRS = "UPDATE line_item
											INNER JOIN company
        							ON line_item.company_id = company.company_id AND
        									line_item.applies_to_user_id = company.{$field} AND
            							line_item.status_cd = 'SV'
									SET line_item.applies_to_user_id = {$this->cbChange->ItemIndex}
									WHERE company.company_id in ({$this->SelectedKeysField->Value})";

			$sql = "UPDATE company
							SET {$field} = {$this->cbChange->ItemIndex},
							    notes_me = CONCAT('{$note}', ' ', notes_me)
             	WHERE company.company_id in ({$this->SelectedKeysField->Value})";

		 	$connectionDB->DbConnection->BeginTrans();
		 	$connectionDB->DbConnection->execute($updateRS);
		 	$connectionDB->DbConnection->execute($sql);
		 	$connectionDB->DbConnection->CompleteTrans();
		 	$this->gridCompany->writeSelectedCells(array());

      $this->winChange->Hide();
    }

}

global $application;

global $report_regular_service_client;

//Creates the form
$report_regular_service_client=new report_regular_service_client($application);

//Read from resource file
$report_regular_service_client->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $report_regular_service_client->show();

?>