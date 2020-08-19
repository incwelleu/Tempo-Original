<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/PHPMailer/class.phpmailer.php");
require_once("include/PHPMailer/class.smtp.php");
require_once("include/ziparchive.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");

define('COL_NOTES', 1);
define('COL_PROCESSED_DT', 4);
define('COL_PROCESSED_BY_USER', 5);

//Class definition
class upload_employee extends fmstrong
{
    public $winDateProcessed = null;
    public $lbDateProcessed = null;
    public $date_processed = null;
    public $btnSaveDateProcessed = null;
    public $btnCloseDateProcessed = null;
    public $winUpload = null;
    public $rowUpload = null;
    public $company_id = null;
    public $SiteTheme = null;
    public $gridUpload = null;
    public $sqlUpload_employee = null;
    public $dsUpload_employee = null;
    public $btnUpload = null;
    public $ImageList = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $SelectedKeysField = null;

    function upload_employeeCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterUpload();

      $this->lbTitle->Caption = ($this->company_id->Value==0) ? Title_Upload_employee : Title_Upload_employee . " (" . $_SESSION['short_name'] . ")";
      $this->lbTitle->Visible = True;
    }


    function ParameterUpload()
    {
      Global $lblUploadFile, $lblDeleteFile, $MonthLetter, $lblDownload;

		if (isset($_REQUEST['BtnClose'])){

			if (isset($_SESSION['email_upload_files_client']))
			{
				$this->Email_send_upload();
				unset($_SESSION['email_upload_files_client']);
			}
			$this->winUpload->Hide();
		}


		$this->company_id->Value = 0;
		if (isset($_SESSION['company_id'])) {
			$this->company_id->Value = $_SESSION['company_id'];
		}

		//Create Button
		$items['btnFilter'] = array(btnFilter, 1, "8");
		$items['btnDelete'] = array($lblDeleteFile, True, "5");
		$items['btnEdit'] = array(btnEdit, True, "2");
		$items['btnSave'] = array(btnSave, True, "4");
		$items['btnCancel'] = array(btnCancel, True, "3");
		$items['btnUpload'] = array($lblUploadFile, $this->company_id->Value);
		$items['btnDownloadHiringForm'] = array(btnDownloadHiringForm, True);
		$items['btnDownLoadTerminationForm'] = array(btnDownLoadTerminationForm, True);
		$items['btnDown145Form'] = array(btnDown145Form, True);

		if ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']){
			$items['btnDateProcessed'] = array(btnDateProcessed, True);
			$items['btnDownload'] = array($lblDownload, True);
		}
		$this->btnUpload->Items = $items;
		$this->lbDateProcessed->Caption = btnDateProcessed;
		$this->winDateProcessed->Caption = btnDateProcessed;

		$this->gridUpload->Columns[COL_PROCESSED_DT]->CanEdit = $_SESSION['IsSuperadmin'];
		$this->gridUpload->Columns[COL_PROCESSED_BY_USER]->Visible = $_SESSION['IsSuperadmin'];
    }


    function btnUploadJSClick($sender, $params)
    {
      Global $lblDeleteFileMsg, $VirtualFile;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowUpload").value;

          if (toolButton == 'btnUpload'){
        		if (toolButtonName == 'btnFilter') {
          		gridUpload.deselectAll();
							gridUpload._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridUpload->ajaxCall('filter_grid', array(), array($this->gridUpload->Name)); ?>
          		return false;
        		}
          	else if ((toolButtonName == 'btnDelete') || (toolButtonName == 'btnDateProcessed') ||
            		(toolButtonName == 'btnDownload')) {
            	var keys = [];
            	for (var row in gridUpload.SelectedCells) {
              	if (typeof(gridUpload.SelectedCells[row]) != "function" &&
                		(gridUpload.SelectedCells[row] != '') &&
                    (gridUpload.SelectedCells[row] != null)) {
                  keys.push(gridUpload.getPrimaryKey(row));
              	}
            	}

            	if (findObj('SelectedKeysField').value = keys.join(',')){
              	if (toolButtonName == 'btnDelete') { return confirm("<?php echo $lblDeleteFileMsg ?>");}
              	else if (toolButtonName == 'btnDateProcessed') { document.getElementById( "winDateProcessed" ).ShowModal(); }
                else if (toolButtonName == 'btnDownload') { return true; }
            	}
            	return false;
            }
            else if ((toolButtonName == 'btnEdit') && (row != "-1") && (row != "")) { gridUpload.Edit(row); return false;}
            else if (toolButtonName == 'btnCancel') { gridUpload.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridUpload.Post(); return false;}
            else if (toolButtonName == 'btnDownload'){
              if ((row == "-1") || (row == "")) return false;
            }
            else if (toolButtonName == 'btnDownloadHiringForm'){
							 var doc = "<?php echo $VirtualFile . TMP_EMPLOYEE_UPLOAD . '/new employee registration form.xlsx'?>";
               window.open(doc);
							 return false;
            }
            else if (toolButtonName == 'btnDownLoadTerminationForm'){
							 var doc = "<?php echo $VirtualFile . TMP_EMPLOYEE_UPLOAD . '/employee termination form.xlsx'?>";
               window.open(doc);
							 return false;
            }
            else if (toolButtonName == 'btnDown145Form'){
							 var doc = "<?php echo $VirtualFile . TMP_EMPLOYEE_UPLOAD . '/mod 145.pdf'?>";
               window.open(doc);
							 return false;
            }
          }

        //end
        <?php
    }


    function btnUploadClick($sender, $params)
    {
      Global $VirtualFile, $lblUploadFile, $upload_employee;

      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnUpload")
      {
        $_SESSION['DirUploadFile'] = $VirtualFile . $upload_employee;
		$_SESSION['FunctionUploadFile'] = "upload_employee";

        $this->winUpload->Caption = $lblUploadFile;
        $this->winUpload->Width = 600;
        $this->winUpload->height = 400;
        $this->winUpload->Include = 'upload.php';
        $this->winUpload->ShowModal();
      }
      else if ($toolButtonName == "btnDelete")
      {
        $this->DeleteFileSelected();
      }
      else if ($toolButtonName == "btnDownload")
      {
        $this->DownloadFileSelected();
      }

    }


    function DeleteFileSelected()
    {
      $upload_employee_id = $this->SelectedKeysField->Value;
      Global $connectionDB;

      $sql = "SELECT * FROM upload_employee WHERE upload_employee_id in (" . $upload_employee_id . ")";
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->SQL = $sql;
      $query->open();

      While (!$query->EOF) {
      	$file = $query->Fields['link'];
        if ((!file_exists($file)) || unlink($file)) {
        	$connectionDB->DbConnection->BeginTrans();
          $connectionDB->DbConnection->execute("DELETE FROM upload_employee WHERE upload_employee_id = " . $query->Fields['upload_employee_id']);
          $connectionDB->DbConnection->CompleteTrans();
        }
        $query->next();
      }
      $this->gridUpload->writeSelectedCells(array());
    }


    function DownloadFileSelected()
    {
      Global $VirtualFile, $TempDir;

      $upload_employee_id = $this->gridUpload->SelectedPrimaryKeys;
      $upload_employee_id = implode(",", $upload_employee_id);

      if ($upload_employee_id){
        Global $connectionDB;

        $sql = "SELECT * FROM upload_employee WHERE upload_employee_id in (" . $upload_employee_id . ")";
        $query = new query();
        $query->Database = $connectionDB->DbConnection;
        $query->LimitStart = -1;
        $query->LimitCount = -1;
        $query->SQL = $sql;
        $query->open();

        $filezip = $TempDir . "/upload_file_{$_SESSION['short_name']}" . date("Ymd_His") . ".zip";
        $zip = new zipArchiveLib();

        While (!$query->EOF) {
          $file = $query->Fields['link'];
          if (file_exists($file)) {
            $DirFile = str_replace($VirtualFile . "/", "", $file);
            $zip->addFile($file, $DirFile);
          }
          $query->next();
        }

        $zip->saveZip($filezip);
        $zip->downloadZip($filezip);
        unlink($filezip);
        $this->gridUpload->writeSelectedCells(array());
      }
    }

    function gridUploadSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT upload_employee.*, short_name, processed_by_user, uploaded_by_user
              FROM upload_employee
                LEFT JOIN
                  (SELECT user_id AS processed_by_user_id, user.username as processed_by_user FROM user) AS processed_user
                ON upload_employee.processed_by_user_id = processed_user.processed_by_user_id
                LEFT JOIN
                  (SELECT user_id AS uploaded_by_user_id, user.username as uploaded_by_user FROM user) AS uploaded_user
                ON upload_employee.created_by_user_id = uploaded_user.uploaded_by_user_id
                INNER JOIN company ON upload_employee.company_id = company.company_id
              WHERE upload_employee.company_id = " . $this->company_id->Value;

      $this->FilterMonth($filterSql);

      if (($filterSql) AND (sw_valid_sql($sql . " AND " . $filterSql)))
          $sql .= " AND " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlUpload_employee->SQL = $sql;
    }

    function FilterMonth(&$filterSql)
    {
      $Column = $this->gridUpload->Columns[$this->gridUpload->findColumnByFieldName('month_data_no')];
      if (!eregi("NoFilter", $Column->FilterMethod) && ($Column->Filter))
      {
        Global $MonthLetter;

        $month_index = (string)array_search($Column->Filter, $MonthLetter);
        $month = $MonthLetter[$month_index];
        $filterSql = str_replace($month, $month_index, $filterSql);
      }
    }

    function gridUploadJSSelect($sender, $params)
    {
        ?>
        //begin js
        var a = getEventTarget(event);

        document.getElementById("rowUpload").value = row;

        if (a.tagName == "A" && a.href) {
          a.target = "_blank";
        }
        //end
        <?php
    }

    function gridUploadRowData($sender, $params)
    {
      Global $MonthLetter;

      $fields = &$params[ 1 ];

      $fields[ "month_data_no" ] = $MonthLetter[$fields[ "month_data_no" ]];
    }


    function gridUploadUpdate($sender, $params)
    {
      $fields = &$params[ 1 ];
      $fields[ 'upload_employee_id' ] = $params[ 0 ];

      if ($fields[ 'processed_dt' ] == '') unset($fields[ 'processed_dt' ]);
      else $fields[ 'processed_by_user_id' ] = $_SESSION['user_id'];

      //Update upload
      sw_update_table("upload_employee", $fields, "upload_employee_id = {$fields['upload_employee_id']}");
    }

    function gridUploadJSRowEditing($sender, $params)
    {
        ?>
        //begin js
        /* yaear_data  */
        var cellProcessed_dt = gridUpload.getCellText(rowIndex, <?php echo COL_PROCESSED_DT;?>);
        if (cellProcessed_dt != "") return false;

        //end
        <?php
    }


    function Email_send_upload()
    {
		Global $MessageEmailUploadFile, $email_username, $email_password,
		     $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;

		ob_start();

		$mail = new PHPMailer(false);
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->CharSet = "UTF-8";

		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Host = "smtp.gmail.com";  // specify main and backup server
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->Username = $email_username;   // SMTP username
		$mail->Password = $email_password; // SMTP password

		$mail->DKIM_domain = $email_DKIM_domain;
		$mail->DKIM_private_string = "v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAreMFYJeMLakGZmK1h3HYu3jLaVVohJ0kwCgj/GE2c/bjknn/zSrOD3ZV3wWy6EspL/zxd+9SPQvseUofeGvO++FZNA75F2PfTKVW+2aZloPaqEjw9+4c/VveuWfWtALLndCWgj3kUpxyro8PoxBxzCXox+mxGNLAmUoA0tfSWG9Ly+Ca5ANIfNpNRitPxVOHeybsaGRb1Q+cOsHrzyLlNLGLVDi16DE1QfjLOsOreuWjypMrjhOa6D0fVemT81FWnXqIDRALcQPjMysQW8m9JFQSbtth/Wf7GSqdg0fvzBNv8+vt7atG/1wZs7ujyBOG49mM2GhuDMTXA2FmsH27XQIDAQAB";
		$mail->DKIM_copyHeaderFields = false;
		$mail->DKIM_selector = $email_DKIM_selector;
		$mail->DKIM_identity = $_SESSION['settings']['se_internal_email'];
		
		$mail->SetFrom($_SESSION['settings']['se_internal_email'], 'Client Area');
		$mail->AddBCC('monicar@incwell.eu');

		$replace_field['username'] = $_SESSION['username'];
		$replace_field['short_name'] = $_SESSION['short_name'];
		$replace_field['FILES'] = $_SESSION['email_upload_files_client'];

		if (($_SESSION['payroll_provider_id']) &&
			($record = sw_get_data_table("vw_payroll_manager", "payroll_provider_id = " . $_SESSION['payroll_provider_id'])) &&
			($record['email'])) {
			$email = $record['email'];
			$name_manager = $record['payroll_provider_name'];

			sw_set_email_template($mail, 'upload file client', $replace_field, true, $_SESSION['settings']);
		} else {
			$record = sw_get_data_table("vw_account_manager", "acct_manager_id = " . $_SESSION['acct_manager_id']);
			$email = $record['email'];
			$name_manager = $record['account_manager_name'];
			sw_set_email_template($mail, 'no payroll provider', $replace_field, true, $_SESSION['settings']);
		}

		$mail->AddAddress($email, $name_manager);

		$mail->Send();
		$mail->ClearAddresses();
		$_SESSION['confirm_email_sending'] = $MessageEmailUploadFile . $email;

		ob_end_clean();

    }

    function btnCloseDateProcessedJSClick($sender, $params)
    {
        ?>
        //begin js
        document.getElementById( "winDateProcessed" ).Hide();
        return false;
        //end
        <?php
    }

    function btnSaveDateProcessedClick($sender, $params)
    {
    	Global $connectionDB;

      $upload_employee_id = $this->SelectedKeysField->Value;
      $date_processed = ($this->date_processed->date == "") ? "null" : "'" . $this->date_processed->date . "'";
      $processed_by_user_id = ($this->date_processed->date == "") ? "0" : $_SESSION['user_id'];
      $sql = "UPDATE upload_employee
      				SET processed_dt = {$date_processed}, processed_by_user_id = {$processed_by_user_id}
              WHERE upload_employee_id in ({$upload_employee_id})";
      $connectionDB->DbConnection->BeginTrans();
      $connectionDB->DbConnection->execute($sql);
      $connectionDB->DbConnection->CompleteTrans();

      $this->date_processed->date = '';
      $this->gridUpload->writeSelectedCells(array());
    }


    function upload_employeeJSLoad($sender, $params)
    {
      $confirm_email_sending = $_SESSION['confirm_email_sending'];

        ?>
        //begin js
        var confirm_email_sending = '<?php echo $confirm_email_sending;?>';
        if ((confirm_email_sending !== '')) {
					alert(confirm_email_sending);
        }
				<?php unset($_SESSION['confirm_email_sending']);?>
        //end
        <?php
    }


}

global $application;

global $upload_employee;

//Creates the form
$upload_employee=new upload_employee($application);

//Read from resource file
$upload_employee->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $upload_employee->show();

?>