<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/PHPMailer/class.phpmailer.php");
require_once("include/PHPMailer/class.smtp.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jtexpandpanel.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");

Define('COL_SENT_YN', 0);
Define('COL_COMPANY_ID', 1);
Define('COL_CREATED', 2);
Define('COL_SENT_DT', 3);
Define('COL_USER_ID', 4);
Define('COL_FROM', 5);
Define('COL_TO', 6);
Define('COL_FIRST_NAME', 7);
Define('COL_CC_EMAIL', 8);
Define('COL_SUBJECT', 9);
Define('COL_BODY',10);

//Class definition
class email_draft extends fmstrong
{
    public $winDesign_email = null;
    public $email_id = null;
    public $SiteTheme = null;
    public $gridEmail = null;
    public $sqlEmail = null;
    public $dsEmail = null;
    public $ImageList = null;
    public $btnEmail = null;
    public $sqlProvider_contact = null;
    public $dsProvider_contact = null;
    public $rowEmail = null;
    public $body_email = null;
    public $email_type = null;

    function email_draftCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->ParameterEmailDraft();
    }

    function ParameterEmailDraft()
    {
      unset($_SESSION['create_email_template']);
      if (($_REQUEST['btnCloseEmailEditSubmitEvent'] != '') || ($_REQUEST['btnSaveEmailEditSubmitEvent'] != '')) {
        $this->winDesign_email->Hide();
      }
      $this->ViewTypeEmail();
    }

    function ViewTypeEmail()
    {
      foreach( $this->gridEmail->Columns as $Columna )
      {
        $Columna->Filter = "";
      }

      if ((!$this->email_type->value) || (isset($_REQUEST['email_type']) && ($this->email_type->value !== $_REQUEST['email_type']))) {
        $this->email_type->value = $_REQUEST['email_type'];
      	$this->gridEmail->Columns[COL_SENT_YN]->Filter = ($this->email_type->value === 'all' ? 0 : '');
      	$this->gridEmail->Columns[COL_SENT_YN]->FilterMethod = ($this->email_type->value === 'all' ? 'Equals' : '');
      }

      $this->lbTitle->Caption = Title_EmailDraft;
      $this->gridEmail->Pager->ShowRecordCount = $this->email_type->value == 'draft';
      $this->gridEmail->Pager->RowsPerPage = $this->email_type->value == 'draft' ? 1000 : 100;
      $this->gridEmail->Pager->Visible = True;
      $this->gridEmail->Header->ShowFilterBar = True;
      if ($this->email_type->value !== 'draft') {
        $this->lbTitle->Caption = ($this->email_type->value === 'sent') ? Title_EmailSent : Title_EmailAll;
      }
      $this->lbTitle->Visible = True;

      $items['btnFilter'] = array(btnFilter, 1, "8");
      if ($this->email_type->value == 'draft'){
      	$items['btnDelete'] = array(btnDelete, 1, "6");
        $items['btnEdit'] = array(btnEdit, 1, "3");
        $items['btnSend'] = array(btnSendEmail, 1);
      } else if ($this->email_type->value == 'all'){
      	$items['btnDelete'] = array(btnDelete, 1, "6");
			}
      $this->btnEmail->Items = $items;
    }


    function gridEmailShow($sender, $params)
    {
      $this->gridEmail->Columns[COL_SENT_YN]->Visible = ($this->email_type->value === 'all');

      $this->gridEmail->Columns[COL_SENT_DT]->Visible = ($this->email_type->value === 'all');
      $this->gridEmail->Columns[COL_USER_ID]->Visible = ($this->email_type->value === 'all');
      $this->gridEmail->Columns[COL_FROM]->Visible = ($this->email_type->value === 'all');

      //Column Provider contact
      $sql = "SELECT * FROM vw_provider_contact ORDER BY username";
      $records = sw_records_array($sql, Array('provider_contact_id', 'username'));
      $this->gridEmail->Columns[COL_USER_ID]->ComboBoxEditor->Values = $records;
      $records[0] = "";
      $this->gridEmail->Columns[COL_USER_ID]->FilterOptions = $records;
      $this->gridEmail->Columns[COL_USER_ID]->TextField = "username";
    }


    function gridEmailSQL($sender, $params)
    {
      list( $sortSql, $sortFields, $filterSql ) = $params;

      $sql = "SELECT email.*, vw_provider_contact.username, short_name
              FROM email
                   LEFT JOIN vw_provider_contact
                   ON email.user_id = vw_provider_contact.provider_contact_id
                   LEFT JOIN (SELECT company_id, short_name FROM company) AS company
                   ON email.to_company_id = company.company_id ";

      $where = "(email.sent_yn = 0) AND (email.user_id = '{$_SESSION[user_id]}')";
      if ($this->email_type->value !== 'draft'){
        $where = ($this->email_type->value === 'sent') ? "(email.sent_yn = 1) AND (email.user_id = '{$_SESSION[user_id]}')" : "";
      }

      $filterSql .= ($filterSql) && ($where) ? " AND " : "";
      $filterSql .= $where;

      if (($filterSql) AND (sw_valid_sql($sql . " WHERE " . $filterSql)))
          $sql .= " WHERE " . $filterSql;

      if ($sortSql) $sql .= " ORDER BY " . $sortSql;

      $this->sqlEmail->SQL = $sql;
    }



    function btnEmailJSClick($sender, $params)
    {
      Global $lbDeleteInformationMsg, $lbEmailMessageSend;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = document.getElementById("rowEmail").value;

          if (toolButton == 'btnEmail'){
        		if (toolButtonName == 'btnFilter') {
          		gridEmail.deselectAll();
							gridEmail._showWaitWindow();
          		params = [0];
        			<?php echo $this->gridEmail->ajaxCall('filter_grid', array(), array($this->gridEmail->Name)); ?>
          		return false;
        		}
            else if (toolButtonName == 'btnAdd') { gridEmail.Insert(); return false;}
            else if (toolButtonName == 'btnCancel') { gridEmail.Cancel(); return false;}
            else if (toolButtonName == 'btnSave') { gridEmail.Post(); return false;}
            else if (toolButtonName == 'btnDelete') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbDeleteInformationMsg ?>");}
                else return false;
            }
            else if (toolButtonName == 'btnSend') {
                if ((row != "-1") && (row != "")) { return confirm("<?php echo $lbEmailMessageSend ?>");}
                else return false;
            }
          }
        //end
        <?php
    }

    function btnEmailClick($sender, $params)
    {
      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnEdit")
      {
        $this->Get_design_email();
      }else if ($toolButtonName == "btnDelete")
      {
        $this->DeleteEmailSelected();
      }else if ($toolButtonName == "btnSend")
      {
        foreach ($this->gridEmail->SelectedPrimaryKeys AS $email_id){
          $lsend = $this->Send_email($email_id);
        }
        $this->gridEmail->writeSelectedCells(array());
      }
    }

    function DeleteEmailSelected()
    {
      if (count($this->gridEmail->SelectedPrimaryKeys) > 0) {
        Global $connectionDB;
        $email = implode(",", $this->gridEmail->SelectedPrimaryKeys);

        $sql = "DELETE FROM email WHERE (email_id IN ({$email})) ";
        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
        $this->gridEmail->writeSelectedCells(array());
      }
    }



    function Send_email($email_id)
    {
	  	Global $email_username, $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector,
             $email_from_template, $email_password;

      if ($record = sw_get_data_table('email', "email_id = {$email_id}")){

        $from_email = $record['from_email'];
        $from_name  = $email_from_template[$record['from_email']];

        ob_start();

        $mail = new PHPMailer(false);
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->SetFrom($from_email, $from_name);
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

        $email = $record['to_email'];
        $first_name = $record['to_first_name'];
        $mail->AddAddress($email, $first_name);

        $email_cc = explode(",", $record['cc_email']);
        foreach ($email_cc AS $email){
          if ($email) $mail->AddAddress($email);
        }

				$settings = sw_setting_company($record['to_company_id']);
        $mail->AddBCC($settings['se_internal_email']);

        $mail->Subject = $record['subject'];
        $mail->Body = $record["body"];

        //update email draft
        if ($send_email = $mail->Send()){
          $record['sent_yn'] = true;
          $record['sent_dt'] = date("Y-m-d H:i:s");
          sw_update_table("email", $record, "email_id = {$email_id}");
        }
        $mail->ClearAddresses();

        ob_end_clean();

        return $send_email;
      }
    }


    function gridEmailJSSelect($sender, $params)
    {
        ?>
        //begin js
        document.getElementById("body_email").innerHTML = '';
        if (row != -1){
          var ISO_text = gridEmail.getCellText(row, <?php echo COL_BODY;?>); // decodeURIComponent(escape(gridEmail.getCellText(row, <?php echo COL_BODY;?>)));
          document.getElementById("email_id").value = gridEmail.getSelectedPrimaryKey();
          document.getElementById("rowEmail").value = row;
          document.getElementById("body_email").innerHTML = ISO_text;
        }
        //end
        <?php
    }


    function ViewerBody()
    {
      $email_id = $this->email_id->Value; // ? $this->email_id->Value : $this->sqlEmail->Fields['email_id'];
      $record = sw_get_data_table('email', "email_id = '{$email_id}'", "body");
      $this->body_email->Caption = $record['body'];
      $this->email_id->Value = $email_id;
    }


    function Get_design_email()
    {
      if ($this->email_id->Value) {
        $this->winDesign_email->Include = "email_edit.php";
        $this->winDesign_email->Height = 480;
        $this->winDesign_email->Width = 700;
        $this->winDesign_email->ShowModal();
      }
    }

    function gridEmailRowData($sender, $params)
    {
      $fields = &$params[ 1 ];

      $fields[ "body" ] =  htmlentities($fields[ "body" ]);
      $fields[ "sent_dt" ] = $fields[ "sent_dt" ] == "0000-00-00 00:00:00" ? "" : $fields[ "sent_dt" ];
    }

    function body_emailShow($sender, $params)
    {
      $this->ViewerBody();
    }

}

global $application;

global $email_draft;

//Creates the form
$email_draft=new email_draft($application);

//Read from resource file
$email_draft->loadResource(__FILE__);

//Shows the form
if (isset($_SESSION['username'])) $email_draft->show();

?>