<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
require_once("include/acceso.php");
require_once("include/language/english.lang.php");
require_once("include/PHPMailer/class.phpmailer.php");
require_once("include/PHPMailer/class.smtp.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("styles.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtverticalline.inc.php");
use_unit("components4phpfull/jthorizontalline.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");

//Class definition
class form_service_agreement extends Page
{
   public $notes_service_agreement = null;
   public $lbProvince = null;
   public $province = null;
   public $lbAccount_manager = null;
   public $sqlLine_item = null;
   public $dsLine_item = null;
   public $service_agreement_id = null;
   public $lbServices = null;
   public $gridLine_item = null;
   public $lbLOPD = null;
   public $dsAccountant_manager = null;
   public $sqlAccountant_manager = null;

   public $btnSubmitForm = null;
   public $cbLOPD = null;
   public $lbBank = null;
   public $gbBank = null;
   public $lbEmail = null;
   public $email = null;
   public $lbPhone = null;
   public $phone = null;
   public $lbMobile = null;
   public $mobile = null;
   public $StyleSheet = null;
   public $lbServiceAgreement = null;
   public $SiteTheme = null;
   public $subtitle = null;
   public $logo = null;
   public $gbPersonal = null;
   public $lbFirst_name = null;
   public $first_name = null;
   public $lbLast_name = null;
   public $last_name = null;
   public $lbPassport_num = null;
   public $passport_num = null;
   public $lbCompany = null;
   public $company_name = null;
   public $JTHorizontalLine1 = null;
   public $lbVat = null;
   public $vat_num = null;
   public $lbAddress = null;
   public $address = null;
   public $lbCity = null;
   public $city = null;
   public $postcode = null;
   public $lbPostcode = null;
   public $lbCountry = null;
   public $sqlCountry = null;
   public $dsCountry = null;
   public $country_id = null;
   public $lbFieldRequired = null;
   public $lbNotes = null;

   function form_service_agreementCreate($sender, $params)
   {
      $this->InitializeData();
   }

   function InitializeData()
   {
      Global $language;

      $where = "(service_agreement.created_by_user_id = vw_provider_contact.provider_contact_id)";
      if(isset($_REQUEST['ID']) && isset($_REQUEST['login']))
      {
         $ID = $_REQUEST['ID'];
         $login_data = $_REQUEST['login'];
         $where .= " AND (service_agreement_id = '{$ID}') AND (login_data = '{$login_data}')";
      }
      else
         $where .= " AND (service_agreement_id = {$this->service_agreement_id->Value})";

      if($record = sw_get_data_table("service_agreement, vw_provider_contact", $where, "service_agreement.*, vw_provider_contact.provider_contact_name"))
      {
         //Query with Payment method language
         $settings = sw_get_data_table("setting, payment_method", "setting.payment_method_id = payment_method.payment_method_id AND setting.billing_entity_id = {$record['billing_entity_id']}");

         //Setting Service Agreement
         $this->lbBank->Caption = $settings['payment_message'];
         $this->lbLOPD->Caption = $settings['sa_LOPD'];
         $this->cbLOPD->Caption = $settings['sa_accept_message_service_agreement'];

         $record_company = sw_get_data_table("company", "company_id = '{$record['company_id']}'");
         $record_contact = sw_get_data_table("contact", "contact_id = '{$record['contact_id']}'");
         $this->service_agreement_id->Value = $record['service_agreement_id']? $record['service_agreement_id']: 0;
         $this->notes_service_agreement->text = $record['notes_service_agreement'];
         $this->first_name->text = ucwords(trim($record['first_name']));
         $this->last_name->text = ucwords(trim($record['last_name']));
         $this->passport_num->text = $record_contact['tax_ident'];
         $this->company_name->text = $record_company['company_name'];
         $this->vat_num->text = $record_company['tax_ident'];

         $this->address->text = $record_company['mail_street_address'];
         $this->city->text = $record_company['mail_city'];
         $this->province->text = $record_company['mail_province'];
         $this->postcode->text = $record_company['mail_post_code'];
         $this->country_id->SelectedValue = $record_company['mail_country_id'];
         $this->phone->text = $record_contact['fixed_phone'];
         $this->mobile->text = $record_contact['mobile_phone'];
         $this->email->text = $record['email'];
         $this->lbAccount_manager->Caption = 'Account manager: ' . $record['provider_contact_name'];

         $sql = "SELECT line_item.* FROM line_item WHERE service_agreement_id = ?";
         $this->sqlLine_item->close();
         $this->sqlLine_item->SQL = $sql;
         $this->sqlLine_item->Params = array($record['service_agreement_id']);
         $this->sqlLine_item->open();

         $record_service = array();
         $line_item = array();
         While( ! $this->sqlLine_item->EOF)
         {
            $record_service['description'] = $this->sqlLine_item->Fields['description'];
            $record_service['quantity_no'] = $this->sqlLine_item->Fields['quantity_no'];
            $record_service['price_amt'] = $this->sqlLine_item->Fields['price_amt'];
            $record_service['total_amt'] = $this->sqlLine_item->Fields['total_amt'];

            array_push($line_item, $record_service);
            $this->sqlLine_item->next();
         }
         $this->gridLine_item->CellData = $line_item;
      }
      $this->cbLOPD->Enabled = ( ! $record['accepted_yn']);
   }

   function cbLOPDJSChange($sender, $params)
   {
      ?>
        //begin js
        document.getElementById('btnSubmitForm').disabled = !document.getElementById('cbLOPD').checked;
        //end
      <?php
   }



   function btnSubmitFormJSClick($sender, $params)
   {
      Global $lbEmailErrorMsg, $lbSpecifyValueMsg;
      ?>
        //begin js
              var xValue = null;
              var cadena = '';

              //Validate information
              xValue = document.getElementById( 'first_name' ).value;
              if (xValue == 0) {
                cadena = cadena + 'First name' + '</br>';
              }

              xValue = document.getElementById( 'last_name' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Last name' + '</br>';
              }

              xValue = document.getElementById( 'passport_num' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Passport' + '</br>';
              }

              xValue = document.getElementById( 'address' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Address' + '</br>';
              }

              xValue = document.getElementById( 'city' ).value;
              if (xValue == 0) {
                cadena = cadena + 'City/Town' + '</br>';
              }

              xValue = document.getElementById( 'postcode' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Postcode' + '</br>';
              }

              xValue = document.getElementById( 'country_id' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Country' + '</br>';
              }

/*              xValue = document.getElementById( 'phone' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Phone' + '</br>';
              }
*/
              xValue = document.getElementById( 'email' ).value;
              if (xValue == 0) {
                cadena = cadena + 'Email' + '</br>';
              }else {

                var lreturn = (<?php echo SW_MASK_EMAIL;?>.test(document.getElementById("email").value));
                if (!lreturn){
                  cadena = cadena + '<?php echo $lbEmailErrorMsg;?>' + '</br>';
                }
              }

              //Si la cadena que hemos creado no está vacía es que hay un error de validación
              if (cadena != '')
              {
                msg = '<?php echo $lbSpecifyValueMsg;?></br><hr/>' + cadena;
                TINY.box.show({html:msg,width:300,animate:false,close:false,boxid:'error',height:'auto',width:'300px'});
                return false;
              }

              TINY.box.show({html:'All correct, thank you. The service agreement has been emailed to you.',animate:false,close:false,boxid:'success',mask:false,autohide:10,height:'auto',width:'300px'});
              return true;
        //end
      <?php
   }

   function form_service_agreementJSLoad($sender, $params)
   {
      $url = $_SERVER["HTTPS"] === 'on'? 'https://': 'http://';
      $url .= $_SERVER['HTTP_HOST'];
      ?>
        //begin js
        if (document.getElementById('service_agreement_id').value == 0){
          alert('The service agreement is not valid, contact the Account manager');
          window.open('<?php echo $url;?>','_parent');
        }
        document.getElementById('btnSubmitForm').disabled = true;
        document.getElementById('cbLOPD').checked = false;
        //end
      <?php
   }

   function btnSubmitFormClick($sender, $params)
   {
      //Create Company
      $record_service_agreement = $this->Create_company();

      $this->Create_PDF($record_service_agreement);
   }

   function Create_company()
   {
      Global $connectionDB;

      $sql = "SELECT service_agreement.*, company.short_name
    					FROM service_agreement LEFT JOIN company ON service_agreement.company_id = company.company_id
              WHERE service_agreement_id = {$this->service_agreement_id->Value}";
      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Prepare();
      $query->Open();
      $record_service_agreement = $query->fieldbuffer;

      if( ! $record_service_agreement['company_id'])
      {
         //Insert company
         $record['created_by_user_id'] = $record_service_agreement['created_by_user_id'];
         $record['acct_manager_id'] = $record_service_agreement['created_by_user_id'];
         $record['tax_ident'] = trim($this->vat_num->Text)? $this->vat_num->Text: $this->passport_num->text;
         $record['tax_ident'] = sw_clean_caracter_tax_ident($record['tax_ident']);
         $record['company_name'] = trim($this->company_name->Text)? trim($this->company_name->Text): $record_service_agreement['last_name'] . ", " . $record_service_agreement['first_name'];
         $record['mail_street_address'] = trim($this->address->Text);
         $record['mail_city'] = trim($this->city->Text);
         $record['mail_province'] = trim($this->province->Text);
         $record['mail_post_code'] = trim($this->postcode->Text);
         $record['mail_country_id'] = $this->country_id->SelectedValue;
         $record['created_dt'] = date('Y-m-d H:i:s');
         $record['short_name'] = sw_checked_file_valid_name(strtolower($record['company_name']));
         $record['billing_entity_id'] = $record_service_agreement['billing_entity_id'];

         $record['contact_list_id'] = sw_insert_contact_list(0, $record);
         sw_insert_table("company", $record);
         $record_service_agreement['company_id'] = mysql_insert_id();
         $record_service_agreement['short_name'] = $record['short_name'];

         //Created directory FTP Server
         sw_created_directory_client_ftp_server($record['short_name']);

         //Insert contact
         $record_contact['first_name'] = $record_service_agreement['first_name'];
         $record_contact['last_name'] = $record_service_agreement['last_name'];
         $record_contact['email'] = $record_service_agreement['email'];
         $record_contact['fixed_phone'] = trim($this->phone->text);
         $record_contact['mobile_phone'] = trim($this->mobile->text);
         $record_contact['tax_ident'] = trim($this->passport_num->text);
         $record_contact['receive_standard_accounting_emails_yn'] = True;
         $record_contact['receive_standard_hr_emails_yn'] = True;
         $record_contact['receive_standard_billing_emails_yn'] = True;
         $record_contact['reminder_standard_accounting_emails_yn'] = True;
         $record_contact['reminder_standard_personal_taxes_yn'] = True;
         $record_contact['contact_list_id'] = $record['contact_list_id'];
         sw_insert_table("contact", $record_contact);
         $record_service_agreement['contact_id'] = mysql_insert_id();
      }

      $record_service_agreement['status_cd'] = $record_service_agreement['status_cd'] !== SW_STATUS_SVC_PAID? SW_STATUS_SVC_ACCEPTED: $record_service_agreement['status_cd'];//Accepted
      $record_service_agreement['accepted_yn'] = True;
      $record_service_agreement['accepted_dt'] = date('Y-m-d H:i:s');
      $record_service_agreement['login_data'] = '';
      $record_service_agreement['remote_address'] = sw_get_client_ip();
      sw_update_table("service_agreement", $record_service_agreement, "service_agreement_id = {$this->service_agreement_id->Value}");
      $this->cbLOPD->Enabled = false;

      //Create PDF
      return $record_service_agreement;
   }

   function Create_PDF($record_service_agreement)
   {
      Global $VirtualFile;

      require_once("include/pdf.php");
      $fontname = 'Arial';
      $ln = 35;

      $pdf = new PDF();
      $pdf->author = $_SESSION['company_name'];
      $pdf->title = "Service Agreement";
      $pdf->SetY($ln);

      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetFont($fontname, '', 11);
      $pdf->Cell(0, 0, 'Service Agreement', 0, 0, 'C');

      $pdf->SetX(10);
      $col1 = 10;
      $col2 = 50;

      //Details
      $pdf->SetY($ln);
      $pdf->SetFont($fontname, 'B', 8);
      $pdf->Text($col1, $ln, $this->gbPersonal->Caption);
      $pdf->Text($col2 + 60, $ln, $this->lbAccount_manager->Caption);

      $pdf->SetFont($fontname, '', 8);
      $pdf->Text($col1, ($ln += 6), $this->lbFirst_name->Caption);
      $pdf->Text($col2, $ln, $_POST['first_name']);
      $pdf->Text($col2 + 60, $ln, $this->lbLast_name->Caption);
      $pdf->Text($col2 + 80, $ln, $_POST['last_name']);
      $pass = html_entity_decode($this->lbPassport_num->Caption);
      $pdf->Text($col1, ($ln += 5), html_entity_decode($this->lbPassport_num->Caption));
      $pdf->Text($col2, $ln, $_POST['passport_num']);

      $pdf->Text($col1, ($ln += 5), $this->lbCompany->Caption);
      $pdf->Text($col2, $ln, $_POST['company_name']);
      $pdf->Text($col1, ($ln += 5), $this->lbVat->Caption);
      $pdf->Text($col2, $ln, $_POST['vat_num']);
      $pdf->Text($col1, ($ln += 5), $this->lbAddress->Caption);
      $pdf->Text($col2, $ln, $_POST['address']);
      $pdf->Text($col1, ($ln += 5), $this->lbCity->Caption);
      $pdf->Text($col2, $ln, $_POST['city']);
      $pdf->Text($col2 + 60, $ln, $this->lbPostcode->Caption);
      $pdf->Text($col2 + 80, $ln, $_POST['postcode']);
      $pdf->Text($col1, ($ln += 5), $this->lbCountry->Caption);
      $record = sw_get_data_table('country', "country_id = " . $_POST['country_id'], "en");
      $pdf->Text($col2, $ln, $record['en']);

      $pdf->Text($col1, ($ln += 5), $this->lbPhone->Caption);
      $pdf->Text($col2, $ln, $_POST['phone']);
      $pdf->Text($col2 + 60, $ln, $this->lbMobile->Caption);
      $pdf->Text($col2 + 80, $ln, $_POST['mobile']);

      $pdf->Text($col1, ($ln += 5), $this->lbEmail->Caption);
      $pdf->Text($col2, $ln, $_POST['email']);

      //Service
      $pdf->SetFont($fontname, 'B', 8);
      $pdf->Text($col1, $ln += 8, $this->lbServices->Caption);
      $pdf->SetFont($fontname, '', 8);
      $pdf->SetY($ln += 2);

      //Column widths
      $data = $this->gridLine_item->CellData;
      $columns = $this->gridLine_item->Columns;
      $w = array();
      $width = 0;
      //Header
      $pdf->SetFont($fontname, 'B', 8);
      foreach($columns as $column)
      {
         if($column->Visible)
         {
            $w[] = array('field'=>$column->Datafield,
                         'width'=>$column->width / 4,
                         'align'=>substr($column->Alignment, 2, 1),
                         'format'=>$column->DataFormat);
            $pdf->Cell($column->width / 4, 5, strip_tags($column->caption), 1, 0, substr($column->Alignment, 2, 1));
            $width += $column->width / 4;
         }
      }
      $pdf->Ln();

      //Data
      $pdf->SetFont($fontname, '', 8);
      $total = 0;
      foreach($data as $row)
      {
         for($i = 0; $i <= count($w) - 1; $i++)
         {
            $value = $w[$i]['format']? sprintf($w[$i]['format'], $row[$w[$i]['field']]): $row[$w[$i]['field']];
            $pdf->Cell($w[$i]['width'], 5, $value, 'LR', 0, $w[$i]['align']);
         }
         $total += floatval($row['total_amt']);
         $pdf->Ln();
      }
      //Closure line
      $pdf->SetFont($fontname, 'B', 8);
      $value = "Total: " . sprintf('%01.2f', $total);
      $pdf->Cell($width, 6, $value, 1, 0, 'R');
      $pdf->Ln(9);
      $ln = $pdf->GetY();

      //Notes
      $pdf->SetFont($fontname, 'B', 8);
      $pdf->Text($col1, ($ln += 2), $this->lbNotes->Caption);
      $pdf->SetFont($fontname, '', 8);
      $note = html_entity_decode($this->notes_service_agreement->Text);
      $pdf->WriteHTML($col1, $ln, $note);
      $ln = $pdf->GetY();

      //Bank
      $pdf->SetFont($fontname, 'B', 8);
      $pdf->Text($col1, ($ln += 10), $this->gbBank->Caption);

      $pdf->SetFont($fontname, '', 8);
      $pdf->WriteHTML($col1, $ln, $this->lbBank->Caption);
      $ln = $pdf->GetY();

      $pdf->WriteHTML($col1, ($ln += 2), $this->lbLOPD->Caption);
      $ln = $pdf->GetY();

      $pdf->Image('images/checkbox.png', $col1, ($ln += 8));

      $LOPD = preg_replace("/<a(.*)>(.*)<\/a>/i", "$2", $this->cbLOPD->Caption);
      $pdf->WriteHTML($col1 + 5, $ln, $LOPD);
      $ln = $pdf->GetY();

      $date = date('Y-m-d');
      $pdf->Text($col1, ($ln += 8), "Date:  {$date}");

      $where = "(service_agreement.created_by_user_id = vw_provider_contact.provider_contact_id) AND
      				  (service_agreement_id = {$this->service_agreement_id->Value})";
      if(($record = sw_get_data_table("service_agreement, vw_provider_contact", $where, "service_agreement.*, vw_provider_contact.email AS account_manager_email, vw_provider_contact.provider_contact_name AS account_manager")))
      {
         $directory = $VirtualFile . TMP_CLIENT_FTP_SERVER . "/{$record_service_agreement['short_name']}/";
         $filename = "service agreement ({$record['service_agreement_id']}) " . date("Y-m-d His", strtotime($record["created_dt"])) . ".pdf";
         $file_service_agreement = $directory . $filename;

         if(file_exists($file_service_agreement))
            unlink($file_service_agreement);

         if( ! $pdf->Output($file_service_agreement, 'F'))
         {
            //Query with Payment method language
            $settings = sw_get_data_table("setting", "billing_entity_id = {$record_service_agreement['billing_entity_id']}");

            $pdf_concat = &new concat_pdf();
            $file_concat[] = $file_service_agreement;

            //Proposal include
            $proposal_id = unserialize($record['proposal_id']);
            $service_proposal_id = unserialize($record['service_proposal_id']);
            foreach($proposal_id as $key => $proposal )
            {
						   $porposal_name = utf8_decode($service_proposal_id[$key]);
               $record_proposal = sw_get_data_table("service_proposal", 'proposal_name = "' . $porposal_name . '"');
							 $file_proposal = $VirtualFile . $settings['dir_proposal'] . "/{$record_proposal['proposal_file']}";
							 if($record_proposal && file_exists($file_proposal)){
               		$file_concat[] = $file_proposal;
							 }
            }

            //File Include LOPD
            $filePrivate = $VirtualFile . $settings['dir_proposal'] . "/politica privacidad english.pdf";
            if(file_exists($filePrivate))
            {
               $file_concat[] = $filePrivate;
            }

            // ejecuto la concatenacion de mis archivos origen
            $pdf_concat->setFiles($file_concat);
            $pdf_concat->concatFiles();

            // Escribir el archivo PDF resultado el directorio de salida debera tener permisos de escritura.
            if(file_exists($file_service_agreement))
               unlink($file_service_agreement);

            if( ! $pdf_concat->Output($file_service_agreement, 'F'))
            {
               $this->Email_service_agreement($file_service_agreement, $record, $settings);

               //Registro el Service agreement al cliente
               sw_register_file($directory, $filename, $record["created_dt"]);
            }
         }
      }
   }

   function Email_service_agreement($filename, $record, $settings)
   {
	  Global $email_username, $email_password,
			 $email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;

      ob_start();

      $mail = new PHPMailer(false);
      $mail->IsSMTP();
      $mail->IsHTML(true);
      $mail->CharSet = "UTF-8";
      $mail->Priority = 1;

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
      $mail->DKIM_identity = 'clientarea@incwell.eu';

      $from_email = $record['account_manager_email'];
      $from_name = $record['account_manager'];
      $mail->SetFrom($from_email, $from_name);
	  $mail->AddBCC('monicar@incwell.eu');


      $mail->AddAddress($record['email'], $record['last_name'] . ", " . $record['first_name']);
      $mail->AddBCC($from_email, $from_name);
      $mail->AddAttachment($filename);

      sw_set_email_template($mail, 'SERVICE AGREEMENT', $record, true, $settings);

      $mail->Send();

      ob_end_clean();
   }

   function form_service_agreementShowHeader($sender, $params)
   {
      echo SW_HEADER_HTML;
      echo SW_HEADER_MEMO_HTML_READONLY;
   }

   function gridLine_itemSummaryData($sender, $params)
   {
      $Columna = &$params[1];
      $fields = &$params[2];
      $Total = number_format($fields['Sum'], 2, '.', '') . "€";
      $fields = array();
      $fields["&nbsp;&nbsp;&nbsp;" . $Columna->Caption . "&nbsp;"] = $Total;
   }

    function gridLine_itemRowData($sender, $params)
    {
		   $field = &$params[1];
			 $field['price_amt'] = number_format($field['price_amt'], 2, '.', '') . "€";
			 $field['total_amt'] = number_format($field['total_amt'], 2, '.', '') . "€";
    }

}

global $application;

global $form_service_agreement;

//Creates the form
$form_service_agreement = new form_service_agreement($application);

//Read from resource file
$form_service_agreement->loadResource(__FILE__);

header("Content-type: text/html; charset=utf-8");

//Shows the form
$form_service_agreement->show();

?>