<?php
require_once("PHPMailer/class.phpmailer.php");

//Verifico que la empresa sea del Grupo Strong
function sw_company_is_strong()
{
//	Global $SW_COMPANY_STRONG;
//	return in_array($_SESSION['company_id'], $SW_COMPANY_STRONG);

  $record = sw_get_data_table("billing_entity", "company_id = {$_SESSION['company_id']}");

	return $record != null;
}

//Obtengo los prarametros de Cliente de la empresa de Strong
function sw_company_country_strong($company_id)
{
  Global $SW_COMPANY_STRONG;

  //Obtengo la empresa de Stronf del pais que pertenece el cliente
	//$record = sw_get_data_table("company", "company_id = {$company_id}", "_id");
	$record_strong = sw_setting_company($company_id);
//  $record_strong['company_id'] = $SW_COMPANY_STRONG[$record['country_id']];

  //Obtengo el Codigo de cliente en la Empresa de Strong
  $where = "company_client.company_client_id = company_join_client.company_client_id AND
			company_join_client.company_id = {$company_id} AND
			company_client.company_id = {$record_strong['company_id']}";
  $record = sw_get_data_table("company_client, company_join_client", $where, "company_client.company_client_id");
  $record_strong['company_client_id'] = $record['company_client_id'];

  //Obtengo el TAX Regime de la empresa de Strong
  $record = sw_get_data_table("company", "company_id = {$record_strong['company_id']}", "tax_regime_id");
  $record_strong['tax_regime_id'] = $record['tax_regime_id'];

	return $record_strong;
}


function sw_get_company_strong()
{
	$sql = "SELECT DISTINCT company_client.company_id
				  FROM company_join_client INNER JOIN company_client ON company_join_client.company_client_id = company_client.company_client_id";
	$record =  sw_records_array($sql, array("company_id", "company_id"));
	return implode(',', $record);
}

//Obtengo los datos de la empresa con el Cliente de la empresa STRONG
function sw_company_client_strong($company_client_id)
{
  //Obtengo el Codigo de cliente en la Empresa de Strong
  $where = "company.company_id = company_join_client.company_id AND company_join_client.company_client_id = {$company_client_id}";
	$record_strong = sw_get_data_table("company, company_join_client", $where);

	return $record_strong;
}

//Creo la empresa como cliente de la Empresa de Strong
function sw_create_company_client_strong($company_strong_id, $company_id)
{
	$company = sw_get_data_table("company", "company_id = {$company_id}");
  $where = "company_id = {$company_strong_id} AND tax_ident = '{$company['tax_ident']}'";

  if (!$company_client = sw_get_data_table("company_client", $where)){
     //TS 10/2/2017 $GLOBAL_DOCUMENT_TYPE = Array(0=> '', 1 => 'NIF - Company' , 2 => 'NIF - Personal', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT');
     $GLOBAL_DOCUMENT_TYPE = Array(0=> '', 1 => 'Company tax ID' , 2 => 'Personal tax ID', 3 => 'Non-resident VAT', 4 => 'Passport', 5 => 'Foreign VAT');

		 $address['company_id'] = $company_strong_id;
		 $address['tax_ident'] = $company['tax_ident'];
		 $address['client_name'] = $company['company_name'];

     //Si la empresa es una SL o Persona Fisica obtengo el Domicilio Social
  	 if ($company['tax_ident_type_cd'] == "1" || $company['tax_ident_type_cd'] == "2"){
     	$address['address_street_type_id'] = $company['regaddress_street_type_id'];
  		$address['address_street'] = $company['regaddress_street'];
  		$address['address_street_no'] = $company['regaddress_street_no'];
  		$address['address_stairwell'] = $company['regaddress_stairwell'];
  		$address['address_floor'] = $company['regaddress_floor'];
  		$address['address_door'] = $company['regaddress_door'];
  		$address['address_city'] = $company['regaddress_city'];
  		$address['address_province'] = $company['regaddress_province'];
  		$address['postal_cd'] = $company['regaddress_post_code'];
  		$address['country_id'] = $company['country_id'];
     }
     else {
  		$address['address_street'] = $company['mail_street_address'];
  		$address['address_city'] = $company['mail_city'];
  		$address['address_province'] = $company['mail_province'];
  		$address['postal_cd'] = $company['mail_post_code'];
  		$address['country_id'] = $company['mail_country_id'];
  	 }

     //Inserto el client en la empresa de Strong
     sw_insert_table("company_client", $address);

     $company_client['company_client_id'] = mysql_insert_id();
     $company_client['company_id'] = $company_id;
     sw_insert_table("company_join_client", $company_client);
  }
  else {
     $company_client['company_id'] = $company_id;
     sw_update_table("company_join_client", $company_client, "company_id = {$company_id}");
  }

	return $company_client['company_client_id'];
}


function sw_delete_record_grid($grid)
{
  if ((count($grid->SelectedPrimaryKeys) > 0) && ($grid->Datasource->DataSet->TableName) && ($grid->KeyField)) {
    $keys = implode(",", $grid->SelectedPrimaryKeys);
    $sql = "($grid->KeyField in ({$keys})) ";
    sw_delete_table($grid->Datasource->DataSet->TableName, $sql);
    $grid->writeSelectedCells(array());
  }
}


function sw_directory_access_provider()
{
  Global $trigger_file_directory_cd;
  $Access_directory = array();

  //Access folder provider
  if ($_SESSION['IsSuperadmin'] || $_SESSION['can_see_companies_yn'] || $_SESSION['can_see_real_estate_yn'] || $_SESSION['can_see_immigration_yn']){
    $Access_directory[] = $trigger_file_directory_cd['CLIENTS'];
    $Access_directory[] = $trigger_file_directory_cd['INVOICES'];
  }
  if ($_SESSION['IsSuperadmin'] || $_SESSION['can_see_employee_general_yn']) $Access_directory[] = $trigger_file_directory_cd['PAYROLL'];
  if ($_SESSION['IsSuperadmin'] || $_SESSION['can_see_accounting_yn']) $Access_directory[] = $trigger_file_directory_cd['ACCOUNTING'];
  if ($_SESSION['IsSuperadmin'] || $_SESSION['can_see_tax_forms_yn']) $Access_directory[] = $trigger_file_directory_cd['TAX_FORMS'];

  return $Access_directory;
}



function sw_check_access_file($file, $record, &$lacceso = true)
{
  if(is_dir($file)) {
    if (!$_SESSION['IsSuperadmin']){
      $directories = explode('/', $file);
      $lacceso = (count(array_intersect(sw_directory_access_provider(), $directories)) > 0);
    }
  } else {
    $record = sw_get_data_table("virtual_file", "link = '{$file}'");
    $lacceso = sw_check_access_company($record['company_id']);
    $lacceso = $_SESSION['IsSuperadmin'] ? !$lacceso : $lacceso;
  }

  return $lacceso;
}


function sw_regenerate_virtual_file($directory)
{
   if(substr($directory, -1) == '/')
   {
      $directory = substr($directory, 0, -1);
   }

   if( ! file_exists($directory) ||  ! is_dir($directory))
   {
      return $res;
   }
   elseif(is_readable($directory))
   {
      $directory_list = opendir($directory);

      while(FALSE !== ($file = readdir($directory_list)))
      {
         if($file != '.' && $file != '..')
         {
            $path = $directory . '/' . $file;
            if(is_readable($path))
            {
               $subdirectories = explode('/', $path);
               if(is_dir($path))
               {
                  if(($dirkey == '') || (stripos($dirkey, end($subdirectories)) === false))
                  {
                     $res = sw_getrfiles($path, $dir_parent, $parent_id);
                  }
                  // if the new path is a file
               }
               elseif(is_file($path))
               {
                  //Register file
                  sw_register_file($directory, $file);
               }
            }
         }
      }
      // close the directory
      closedir($directory_list);

      // return file list
      return $res;

      // if the path is not readable ...
   }
   else
   {
      // ... we return false
      return $res;
   }
}


function sw_getrfiles($directory)
{
  if(substr($directory,-1) == DIRECTORY_SEPARATOR) {
    $directory = substr($directory,0,-1);
  }

  if(!file_exists($directory) || !is_dir($directory)) {
    return $res;
  }
  elseif(is_readable($directory)) {
    $directory_list = opendir($directory);

    while (FALSE !== ($file = StripSlashes(readdir($directory_list)))) {
      if($file != '.' && $file != '..') {
        $path = $directory . $file;
        if (is_readable($path)) {
          $subdirectories = explode("/",$path);
          if(is_dir($path)) {
            if (($dirkey == '') || (stripos($dirkey, end($subdirectories)) === false)){
              $res = sw_getrfiles($path, $dir_parent, $parent_id);
            }
            // if the new path is a file
          }  elseif(is_file($path)){
            //Register file
            $file = sw_clean_characters_spanish(strtolower($file));
            if ((!file_exists($directory . $file) && sw_delete_register_file($path))) {
              copy($path, $directory . $file);
              unlink(($path));
            }
          }
        }
      }
    }

    // close the directory
    closedir($directory_list);

    // return file list
    return $res;

    // if the path is not readable ...
  }else {
    // ... we return false
    return $res;
  }
}


function sw_register_file($directory, $file, $date, $error_view_email = false){
  Global $connectionDB, $lblFileCouldNotBeUploaded, $lblFileErrorCompany,
			$lblFileErrorParentTree, $lblFileErrorCompanyUserName;

  $error = "";
  $path = $directory . $file;
  $dir_system_ftp = array('/docs/');
  $file_system_ftp = false;

  //Find if the file is in a special directory
  foreach ($dir_system_ftp as $value){
    if (strpos($directory, $value) !== false){
       $file_system_ftp = true;
       break;
    }
  }

  $parent_id = sw_search_parent_id($directory);
  $company = sw_search_company($directory, $file);

  $sql = 'SELECT * FROM virtual_file WHERE link = "' . $path . '"';
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  if ($query->EOF) {
      //Localize company and parent
      if (($parent_id !== False) && $company && !$file_system_ftp) {
      	$user = $_SESSION['user_id'] ? $_SESSION['user_id'] : 0;
        $date = (!$date) ? date("Y-m-d H:i:s", filemtime($path)) : $date;
        $sql = 'INSERT INTO virtual_file(description_en, parent_id, link, created_dt, company_id, created_by_user_id) ' .
               'VALUE ("' . $file . '", ' . $parent_id . ', "' . $path . '", "' . $date . '", ' . $company['company_id'] . ', ' . $user . ')';

        $connectionDB->DbConnection->BeginTrans();
        if ($connectionDB->DbConnection->execute($sql)){
          $error = sw_create_email_template_upload($directory, $company['company_id'], $file, $error_view_email);
        } else $error = $lblFileCouldNotBeUploaded;

        $connectionDB->DbConnection->CompleteTrans();
      }
  }
  $query->close();

  if (($error == "") && (!$company) && (!$file_system_ftp)) $error = $lblFileErrorCompany;
  if (($error == "") && ($parent_id === False) && (!$file_system_ftp)) $error = $lblFileErrorParentTree;

  if ($error_view_email) echo $error;

  return ($error === "" || $error === $lblFileErrorCompanyUserName);
}


function sw_search_parent_id($directory)
{
  Global $connectionDB;

  //Localizo el cliente
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = 'SELECT folder, nodo_id FROM virtual_file WHERE (LENGTH(TRIM(folder)) > 0) ORDER BY folder DESC';
  $query->open();

  $parent_id = false;

  While (!$query->EOF)
  {
    $path = $query->Fields["folder"];
    $dir_parent = explode('/', $path);
    $assing = true;
    foreach ($dir_parent as $key => $value){
      if (!strpos($directory, $value)){
        $assing = false;
        break;
      }
    }

    if ($assing){
      $parent_id = $query->Fields["nodo_id"];

      break;
    }

    $query->next();
  }

  $query->close();

  return $parent_id;
}


function sw_search_company($directory, $file){
  Global $connectionDB;

	// Search folder clientes
	if (strpos($directory, TMP_CLIENT_FTP_SERVER) == false) {
  	$sql = 'SELECT * FROM company WHERE (short_name <> "") AND ' .
         '((LOCATE(CONCAT(" ", short_name, " "), "' . $file . '") > 0) OR ' .
         ' (LOCATE(CONCAT(" ", short_name, "."), "' . $file . '") > 0) OR ' .
         ' (LOCATE(CONCAT("/", short_name, "/"), "' . addslashes($directory) .'") > 0))';
	} else {
	  	$sql = 'SELECT * FROM company WHERE (short_name <> "") AND ' .
         '((LOCATE(CONCAT("/", short_name, "/"), "' . addslashes($directory) .'") > 0))';
  }

  $query = new query();
  $query->close();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->SQL = $sql;
  $query->open();

  $company = 0;
  if (!$query->EOF) $company = $query->fieldbuffer;

  return $company;
}


function sw_create_email_template_upload($directory, $company_id, $file = '', $error_view_email = false)
{
  Global $trigger_file_directory_cd, $email_to_cd_template;

  $link = "http://" . $_SERVER['SERVER_NAME'] . str_replace('..','',$directory) . $file;
	$error = "";

  $directory = explode('/', $directory);
  array_pop($directory);
  foreach ($directory as $value){
    if ($dir = array_search($value, $trigger_file_directory_cd)){
    	$directory_cd = $dir;
    }
  }

  //Locate Email template - trigger_type_cd, trigger_file_directory_cd, to_client_yn = 1
  $email_template_id = 0;
  $where = "(trigger_type_cd = 'UPL') AND
            (trigger_file_directory_cd = '{$directory_cd}')";
  $trigger_file_keyword = sw_records_array("SELECT * FROM email_template WHERE {$where}", array('email_template_id', 'trigger_file_keyword'));

  //Locate the mail template with the file name
  foreach ($trigger_file_keyword AS $key => $value){
  	if (count($trigger_file_keyword) === 1 && $value == "" && $key !== 0 ){
	 	   $email_template_id = $key;
  	}
    else {
    	$keyword = explode(",", $value);
    	foreach ($keyword AS $value){
    		if (strpos($file, trim(strtolower($value)) . " ") !== False){
	    	$email_template_id = $key;
      	break;
      	}
    	}
    }
    if ($email_template_id) break;
  }

  //Created email draft with template
  if ($record_template = sw_get_data_table("email_template", "email_template_id = '{$email_template_id}'"))
  {
    $posFiles = strpos($record_template['body'], '{FILES}');

    //search email contact
    $email_cd = $email_to_cd_template[$record_template['email_to_cd']];
    $sql = "SELECT contact.* FROM company INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
            WHERE (company.company_id = {$company_id}) AND (contact.{$email_cd} = true) AND (LENGTH(TRIM(email)) != 0)";
    $record_contact = sw_records_array($sql, array('contact_id', 'email', 'first_name'));
    $error = sw_created_email_draft($company_id, $record_template, $record_contact, $link, $file, $error_view_email);
  }
	return $error;
}


function sw_created_email_draft($company_id, $record_template, $record_contact, $link = '', $file = '', $error_view_email = false)
{
  Global $email_to_cd_template,
         $lblFileViewDraftEmailMsg, $lblFileViewDraftEmailBeforeMsg,
         $lblFileMsgNotIncludeDraft, $lblFileErrorCompanyUserName, $password_user;

	$error = "";
  $posFiles = strpos($record_template['body'], '{FILES}');

  //search email contact
  If ($record_contact) {
    $contact = current($record_contact);
    $dear = utf8_decode("Dear {$contact['first_name']},<br/>");

    //Locate for user_id, to_company_id, email_template_id, sunt_yn = 0
    $where = "(email_template_id = {$record_template['email_template_id']}) AND
              (user_id = {$_SESSION['user_id']}) AND (sent_yn = 0) AND
              (to_company_id = {$company_id})";
    If (!$record_email = sw_get_data_table("email", $where)){
      $record_email['email_template_id'] = $record_template['email_template_id'];
      $record_email['user_id'] = $_SESSION['user_id'];
      $record_email['to_company_id'] = $company_id;
      $record_email['to_email'] = $contact['email'];
      $record_email['to_first_name'] = $contact['first_name'];
      $record_email['created_dt'] = date('Y-m-d H:i:s');

      //ts 9/2/2017: if template "from" is blank, use user's email.
      If ($record_template['email_from'] == "") {
        $record_email['from_email'] = "{$_SESSION['provider_contact_email']}";
        $from_name = "{$_SESSION['provider_contact_name']}";
      } else {
				$settings = sw_setting_company($company_id);
        $record_email['from_email'] = $settings[$record_template['email_from']];
        $provider_contact = sw_get_provider_contact($record_email['from_email']);
        $from_name = "{$provider_contact['provider_contact_name']}";
      }

      //cc email
      foreach ($record_contact as $key => $field_contact){
        if ($contact['contact_id'] != $key) {
          $record_email['cc_email'] .= $record_email['cc_email'] ? ", " . $field_contact['email'] : $field_contact['email'];
        }
      }

      //Subjet and Body replace
      $subject = sw_replace_date_macro($record_template['subject'], Date('Y-m-d'));
      $record_user = sw_get_data_table("company, user", "company.user_id = user.user_id AND company_id = $company_id", "username");
			if (!$record_user) {
				$record_user['username'] = "";
			}
      $record_user['password_user'] = $password_user;
      $ReplaceField = array_merge($_SESSION, $record_user);
      $ReplaceField['FILES'] = "<a href='{$link}' target='_new'>{$file}</a><br/>";

      foreach ($ReplaceField as $key => $fieldvalue) {
        $subject = str_replace('{' . $key . '}', $fieldvalue, $subject);
      }

      $body = $dear . sw_replace_date_macro($record_template['body'], Date('Y-m-d'));

      //Regards Admin Contacts
      $regards = "Kind regards,<br>" . $from_name;
      $body .= utf8_decode($regards) . "</br>";

      foreach ($ReplaceField as $key => $fieldvalue) {
  			if ($error == "" && $error_view_email && ($record_user['username']=="") && strpos($body, '{username}')){
					$error = $lblFileErrorCompanyUserName;
				}
        $body = str_replace('{' . $key . '}', $fieldvalue, $body);
      }

	  	$settings = sw_setting_company($company_id);
      $body .= $settings['se_standard_email_foot'];

      $record_email['subject'] = $subject;
      $record_email['body'] = $body;
      sw_insert_table('email', $record_email);
      $_SESSION['create_email_template'] = $lblFileViewDraftEmailMsg;
    }
    else { // Update email draft
      if (($posFiles !== false) && (strrpos($record_email['body'], $file) === false)){
        $posFiles += strlen($dear);
        $record_email['body'] = substr($record_email['body'], 0, $posFiles) .
                                "<a href='{$link}' target='_new'>{$file}</a><br/>" .
                                substr($record_email['body'], $posFiles, strlen($record_email['body']));
        $where = "email_id = {$record_email['email_id']}";
        sw_update_table("email", $record_email, $where);
        $_SESSION['create_email_template'] = $lblFileViewDraftEmailBeforeMsg;
      }
    }
  } else { if ($error_view_email) echo $lblFileMsgNotIncludeDraft; }

	return $error;
}


function sw_check_access_company($company_id = 0)
{
  $company_user = explode(',', $_SESSION['company_user']);
  return (array_search($company_id, $company_user) !== False);
}


function sw_check_access_parent($parent_id){
  $record = sw_get_data_table("virtual_file", "(nodo_id = {$parent_id}) AND (superadmin_yn = 0)", "nodo_id");
  return (isset($record['nodo_id']) || $_SESSION['IsSuperadmin']);
}


function sw_upload_accounting($tempFileName, $directory, $file_name, $year_data_no, $month_data_no){
  Global $VirtualFile, $Upload_accounting, $connectionDB;
  $path = $directory . $file_name;

  $sql = 'SELECT upload_accounting_id FROM upload_accounting ORDER BY upload_accounting_id desc ';
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->SQL = $sql;
  $query->open();

  $upload_accounting_id = 1;
  if (!$query->EOF) $upload_accounting_id = $query->Fields['upload_accounting_id'] + 1;

  $dir = $VirtualFile . $Upload_accounting;
  $dir = strtolower($dir . "/" . $year_data_no . "/");
  if (!file_exists($dir)) mkdir($dir, 0777, true);

  $link = "upload accounting {$upload_accounting_id} {$year_data_no} {$month_data_no} " . $_SESSION["short_name"] . "." . getExtention($file_name);
  $link = strtolower($dir . $link);
  if (file_exists($link)) unlink($link);

  if (sw_upload_file_existed($file_name)) $file_name .= " (copy)";
  $sql = 'INSERT INTO upload_accounting(company_id, created_by_user_id, year_data_no, month_data_no, file_name, link, upload_dt) ' .
         'VALUE ('. $_SESSION['company_id'] . ', ' . $_SESSION['user_id'] . ', ' . $year_data_no . ', ' . $month_data_no . ', "' . $file_name . '", "' . $link . '", "' . date('Y-m-d h:i:s'). '")';

  $connectionDB->DbConnection->BeginTrans();

  if ($return = move_uploaded_file($tempFileName, $link)){
    if ($return = $connectionDB->DbConnection->execute($sql)) {
      $link = "http://" . $_SERVER['HTTP_HOST'] . "/" . $link;
      $_SESSION['email_upload_files_client'] .= "<p><a href='{$link}'>{$file_name}</a></p>";
    }
  }

  $connectionDB->DbConnection->CompleteTrans();

  return $return;
}


function sw_upload_employee($tempFileName, $directory, $file_name){
  Global $VirtualFile, $Upload_accounting, $connectionDB;
  $path = $directory . $file_name;

  $sql = 'SELECT upload_employee_id FROM upload_employee ORDER BY upload_employee_id desc ';
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->SQL = $sql;
  $query->open();

  $upload_employee_id = 1;
  if (!$query->EOF) $upload_employee_id = $query->Fields['upload_employee_id'] + 1;

  $dir = $VirtualFile . $Upload_accounting;
  $dir = strtolower($dir . "/" . idate('Y') . "/");
  if (!file_exists($dir)) mkdir($dir, 0777, true);

  $link = "upload employee {$upload_employee_id} " . $_SESSION["short_name"] . "." . getExtention($file_name);
  $link = strtolower($dir . $link);
  if (file_exists($link)) unlink($link);

  if (sw_upload_file_existed($file_name)) $file_name .= " (copy)";
  $sql = 'INSERT INTO upload_employee(company_id, created_by_user_id, file_name, link, upload_dt) ' .
         'VALUE ('. $_SESSION['company_id'] . ', ' . $_SESSION['user_id'] . ', "' . $file_name . '", "' . $link . '", "' . date('Y-m-d h:i:s'). '")';

  $connectionDB->DbConnection->BeginTrans();

  if ($return = move_uploaded_file($tempFileName, $link)){
    if ($return = $connectionDB->DbConnection->execute($sql)) {
      $link = "http://" . $_SERVER['HTTP_HOST'] . "/" . $link;
      $_SESSION['email_upload_files_client'] .= "<p><a href='{$link}'>{$file_name}</a></p>";
    }
  }

  $connectionDB->DbConnection->CompleteTrans();

  return $return;
}


function sw_upload_file_existed($file_name){
  Global $connectionDB, $lbUploadFileExists_error;

  $sql = "SELECT upload_accounting_id FROM upload_accounting WHERE company_id = " . $_SESSION['company_id'] .
         " AND file_name = '{$file_name}'";
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->SQL = $sql;
  $query->open();

  if ($return = !$query->EOF){
      echo $lbUploadFileExists_error . "</B></br>";
  }
  return $return;
}


function deleteFtpFile($file)
{
	if (!is_dir($file)) deleteFile($file);
	else
	{
		$list = @scandir($file);
		if (is_array($list)) {
			foreach($list as $item){
				$location = $file . "/" . $item;
				if (($item != ".") && ($item != "..")){
					if (is_dir($location)){
						deleteFtpFile($location);
					}
					else deleteFile($location);
				}
			}
		}
		rmdir($file);
	}
}


function deleteFile($file)
{
	if ($return = (sw_check_access_file($file) && unlink($file))) {
		$return = sw_delete_register_file($file);
	}
	return $return;
}


function sw_delete_register_file($file){

  Global $connectionDB;

  $sql = 'DELETE FROM virtual_file WHERE link = "' . $file . '"';

  $connectionDB->DbConnection->BeginTrans();
  $return = $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();

  return $return;
}


function sw_get_data_table($Table, $where, $fields = "*", $limitStart = -1, $limitCount = -1)
{
  Global $connectionDB;

  $record = array();
  if (is_array($fields)){
    $fields = implode(',', $fields);
  }

  if ($where) $where = " WHERE " . $where;
  $sql = "SELECT {$fields} FROM " . $Table . $where;
  if (sw_valid_sql($sql)) {
    $query = New Query();
    $query->Database = $connectionDB->DbConnection;
    $query->SQL = $sql;
    $query->LimitStart = -1;
    $query->LimitCount = -1;
    $query->Prepare();
    $query->Open();
    $record = $query->fieldbuffer;
  }

  return $record;
}
/**
 * Same than sw_insert_table but fix null issue
 */
function sw_insert_table_null($table, $fieldValues)
{
  Global $connectionDB;

  $fields = array();
  $values = array();
  $parameters = array();

  $defaulValue = sw_default_value_field($table);
  $fieldValues = array_intersect_key($fieldValues, $defaulValue);

  foreach( $fieldValues as $fieldName => $fieldValue ){
      $fieldValue = sw_replace_quotes($fieldValue);
      if (!mb_check_encoding($fieldValue, 'UTF-8')) {
        $fieldValue = utf8_encode($fieldValue);
      }

      $defaul = $defaulValue[$fieldName];

      if($fieldValue == null){
        $values[] = 'null';
      }
      else{
        $values[] = $fieldValue ? "'{$fieldValue}'" : "'{$defaul}'";
      }

      $fields[] = $fieldName;
  }

  $fields = implode( ',', $fields );
  $values = implode( ',', $values );

  $sql = "INSERT INTO " . $table . " ($fields) VALUES($values)";

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
}

function sw_insert_table($table, $fieldValues)
{
  Global $connectionDB;

  $fields = array();
  $values = array();
  $parameters = array();

  $defaulValue = sw_default_value_field($table);
  $fieldValues = array_intersect_key($fieldValues, $defaulValue);

  foreach( $fieldValues as $fieldName => $fieldValue ){
      $fieldValue = sw_replace_quotes($fieldValue);
      if (!mb_check_encoding($fieldValue, 'UTF-8')) {
        $fieldValue = utf8_encode($fieldValue);
      }

      $defaul = $defaulValue[$fieldName];
      $values[] = $fieldValue ? "'{$fieldValue}'" : "'{$defaul}'";

      $fields[] = $fieldName;
  }

  $fields = implode( ',', $fields );
  $values = implode( ',', $values );

  $sql = "INSERT INTO " . $table . " ($fields) VALUES($values)";

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
}


function sw_update_table($table, $fieldValues, $where, $email_notify = array())
{
  Global $connectionDB;

  $record = sw_get_data_table($table, $where);

  if ($where) $where = " WHERE " . $where;

  $fields = array();
  $values = array();
  $parameters = array();

  $fieldValues = array_intersect_key($fieldValues, $record);
  $fieldValues = array_diff_assoc($fieldValues, $record);
  $defaulValue = array(); //sw_default_value_field($table);

  foreach( $fieldValues as $fieldName => $fieldValue ){
      $fieldValue = sw_replace_quotes($fieldValue);
      if (!mb_check_encoding($fieldValue, 'UTF-8')) {
        $fieldValue = utf8_encode($fieldValue);
      }

      $defaul = $defaulValue[$fieldName];
      $values[] = !is_null($fieldValue) ? "{$fieldName} = '{$fieldValue}'" : "{$fieldName} = '{$defaul}'";
  }

  if ($values = implode( ',', $values )){
    $sql = "UPDATE " . $table . " SET {$values} " . $where;
    $connectionDB->DbConnection->BeginTrans();
    $connectionDB->DbConnection->execute($sql);
    $connectionDB->DbConnection->CompleteTrans();

    //Notify the change of field
    if (count($email_notify) > 0) {
      sw_notify_change_field($table, $fieldValues, $email_notify);
    }
  }
}


function sw_notify_change_field($table, $fieldValues, $email_notify)
{

  Global $email_username, $email_password,
				$email_DKIM_domain, $email_DKIM_private_string, $email_DKIM_selector;

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

  $mail->SetFrom($_SESSION['settings']['se_internal_email']);
	$mail->AddBCC('monicar@incwell.eu');

  try {
    foreach($email_notify as $email){
      $mail->AddAddress($email);
    }

    $replace_field['short_name'] = $_SESSION['short_name'];
    $replace_field['table_name'] = $table;
    foreach( $fieldValues as $fieldName => $fieldValue ){
      if (!mb_check_encoding($fieldValue, 'UTF-8')) {
        $fieldValue = utf8_encode($fieldValue);
      }

      $replace_field['VALUES'] .= "<b>{$fieldName}</b>: {$fieldValue} <br/>";
    }

    sw_set_email_template($mail, 'notify the change of field', $replace_field, $_SESSION['settings']);

    $mail->Send();
  } catch (phpmailerException $e) {
    echo $e->errorMessage();
  } catch (Exception $e) {
    echo $e->getMessage();
  }

	return true;
}


function sw_notify_change_account_manager($fieldValues, $where)
{
  Global $notify_change_account_manager;

  $record = sw_get_data_table("company", $where);

  $assigned_account = array();
  foreach ($notify_change_account_manager as $field)
  {
    if ($fieldValues[$field] && ($_SESSION['username'] != $fieldValues[$field]) &&
       ($fieldValues[$field] != $record[$field])){
      $assigned_account[] = sw_get_data_table("vw_provider_contact", "provider_contact_id = {$fieldValues[$field]}");
    }
  }

  if ($assigned_account){

    Global $email_password, $email_DKIM_private_string;

    $settings = sw_setting_company($record['company_id']);

    ob_start();

    $mail = new PHPMailer(false);
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Username = $settings['se_internal_email'];
    $mail->Password = $email_password;
    $mail->SetFrom($settings['se_internal_email']);

    $mail->CharSet = "UTF-8";

    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Host = "smtp.gmail.com";  // specify main and backup server
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->Username = "clientarea@incwell.eu";  // SMTP username
    $mail->Password = "tempo_2018"; // SMTP password

    $mail->DKIM_domain = "incwell.eu";
    $mail->DKIM_private_string = $email_DKIM_private_string;
    $mail->DKIM_copyHeaderFields = false;
    $mail->DKIM_selector = "google";
    $mail->DKIM_identity = $settings['se_internal_email'];

    try {
      foreach($assigned_account as $email){
        $mail->AddAddress($email['email'], $email['provider_contact_name']);
      }

      $fieldValues['username'] = $_SESSION['username'];
      $fieldValues['short_name'] = $record['short_name'];
      sw_set_email_template($mail, 'notify on change of account manager', $fieldValues, true, $settings);

      $mail->Send();
    } catch (phpmailerException $e) {
      echo $e->errorMessage();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
    $mail->ClearAddresses();
    ob_end_clean();
  }
}


function sw_default_value_field($table)
{
  Global $connectionDB, $DbName;

  if ($connectionDB->DbConnection->DriverName == 'mysql') {
      $sql = "SELECT COLUMN_NAME, COLUMN_DEFAULT FROM information_schema.`COLUMNS`" .
             " WHERE TABLE_NAME = '{$table}' AND TABLE_SCHEMA = '{$DbName}'";
      $Default = sw_records_array($sql, Array('COLUMN_NAME', 'COLUMN_DEFAULT'));
  }
  else $Default = array();

  return $Default;
}

function sw_delete_table($Table, $where)
{
  Global $connectionDB;

  if ($where) $where = " WHERE " . $where;
  $sql = "DELETE FROM " . $Table . $where;

  if (!mb_check_encoding($sql, 'UTF-8')) {
     $sql = utf8_encode($sql);
  }

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
}


function sw_execute_sql($sql)
{
  Global $connectionDB;

  if (!mb_check_encoding($sql, 'UTF-8')) {
     $sql = utf8_encode($sql);
  }

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
}


function sw_records_array($sql, $define)
{
  // $define[0] => The index of the array must be the primary key
  Global $connectionDB;
  $result = array();

  if (sw_valid_sql($sql)){
    $query = New Query();
    $query->Database = $connectionDB->DbConnection;
    $query->SQL = $sql;
    $query->LimitStart = -1;
    $query->LimitCount = -1;
    $query->open();

    While (!$query->EOF){

      if (count($define) == 2){
        if (!array_key_exists($query->Fields[$define[0]], $result))
          $result[$query->Fields[$define[0]]] = $query->Fields[$define[1]];
      }
      else{
        $value = array();
        foreach ($define as $field){
          $value[$field] = $query->Fields[$field];
        }
        $key = $query->Fields[$define[0]];
        $result[$key] = $value;
      }

      $query->next();
    }
  }

  return $result;
}


function sw_get_user_role($user_id)
{
  $sql = "SELECT role.role_id, role.role_name
          FROM user_role INNER JOIN role ON user_role.role_id = role.role_id
          WHERE user_id = {$user_id}";

  $record = sw_records_array($sql, Array('role_id', 'role_name'));
  $user_role['IsSuperadmin']  = (array_search('Superadmin', $record) !=0);
  $user_role['IsProvider']    = (array_search('Provider', $record) !=0);
  $user_role['IsClientAdmin'] = (array_search('Client admin', $record) != 0);
  $user_role['IsClientUser']  = (array_search('Client user', $record) != 0);

  return $user_role;
}


function sw_valid_sql($sql)
{
  Global $connectionDB;

  if (!mb_check_encoding($sql, 'UTF-8')) {
     $sql = utf8_encode($sql);
  }

  $query = New Query();
  $query->Database = $connectionDB->DbConnection;
  $query->SQL = $sql;
  $query->LimitStart = 0;
  $query->LimitCount = 1;

  try
  {
    $query->Active = True;
  }
  catch(Exception $e)
  {
    return False;
  }

  return $query->Active;
}


//Valid exist username or short_name
function sw_valid_username($user_id = 0, $username)
{
   Global $lbUserNameNotAvailable_error, $lbUserNameNotEmpty_error, $lbCompanyShortNameAlreadyExists_error;

   $msg = "";
   $user_id = $user_id ? $user_id : 0;
   if (!$username) $msg = $lbUserNameNotEmpty_error;

   //Valid username
   if((!$msg) && (count(sw_records_array("SELECT * FROM user WHERE username = '{$username}' AND user_id != {$user_id}", array('user_id', 'username')) )>0))
   {
      $msg = $lbUserNameNotAvailable_error;
   }
   else {
      if((!$msg) && (count(sw_records_array("SELECT * FROM company WHERE short_name = '{$username}'", array('company_id', 'short_name')) )>1))
      {
         $msg = $_SESSION['IsSuperadmin']? $lbCompanyShortNameAlreadyExists_error: $lbUserNameNotAvailable_error;
      }
   }

   if ($msg) $msg .= '<br/>';

   return $msg;
}


function sw_valid_short_name($company_id, $short_name)
{
   Global $lbCompanyShortNameAlreadyExists_error;

   $msg = "";

   $short_name = strtolower(trim($short_name));
   $short_name_descom = explode(" ", $short_name);

   $where = "";
   foreach ($short_name_descom as $short_company){
    $where .= "(short_name = '{$short_company}') OR ";
   }
   $where = $where ? "(" . $where . "(short_name like '% {$short_name} %'))" : "(short_name like '% {$short_name}') %";
   $where .= " AND (company_id != {$company_id})";

   if ($record = sw_get_data_table("company", $where))
   {
      $msg = $lbCompanyShortNameAlreadyExists_error;
   }

   if ($msg) $msg .= '</br>';

   return $msg;
}

function sw_valid_legacy_datahouse($datahouse_id, $company_id = 0)
{
   Global $lbCompanyLegacy_datahouse_error;

   $msg = "";
   $where = "company_id != " . $company_id;
   if ($datahouse_id) {
      $where .= " AND legacy_datahouse_id = " . $datahouse_id;

      //Valid legacy_datahouse_id
      if($record = sw_get_data_table("company", $where, "short_name"))
      {
        $short_name = $record['short_name'];
        $msg = $lbCompanyLegacy_datahouse_error;
      }
   }

   return $msg;
}


function sw_insert_contact_list($user_id, $record){
  $record_user = sw_get_data_table('user', "user_id = {$user_id}");
  if (!$record['contact_list_id'] || ($record_user && !$record_user['use_can_same_contact_list_yn'])){

    Global $connectionDB;
    $record = sw_get_data_table('contact_list', '', 'MAX(contact_list_id)+1 as contact_list_id');
    $sql = "INSERT INTO contact_list(contact_list_id) VALUES({$record['contact_list_id']})";
    $connectionDB->DbConnection->execute($sql);
  }

  return $record['contact_list_id'];
}


function sw_download_file($file)
{
  if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    ob_end_flush();
    @readfile($file);
  }
}

function sw_repeat_character($value, $count, $pos, $caracter)
{
    If ($pos == "L")
        $return = str_repeat($caracter, ($count - strlen(trim($value)))) . trim($value);
    else
        $return = trim($value) . str_repeat($caracter, ($count - strlen(trim($value))));

    return $return;
}


function sw_get_companies_for_user($user_id)
{
  Global $connectionDB;

  $sql = "SELECT * FROM company WHERE user_id = {$user_id} ORDER BY is_default_company_yn desc";
  if ($_SESSION['IsProvider']){
    $sql = "SELECT * FROM company WHERE (acct_manager_id = {$user_id}) OR (payroll_provider_id = {$user_id}) OR (accounting_provider_id = {$user_id})";
  }
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $company_id = ($query->EOF) ? 0 : $query->Fields["company_id"];
  $_SESSION['company_user'] = ($query->EOF) ? '0' : implode(',', sw_records_array($sql, Array('company_id', 'company_id')));
  sw_get_company_parameter($company_id);
}


function sw_set_user_session($record)
{
  $record = sw_get_data_table("user", "user_id= {$record['user_id']}");
	$user_role = sw_get_user_role($record['user_id']);


  $_SESSION['IsSuperadmin']  = $user_role['IsSuperadmin'];
  $_SESSION['IsProvider']    = $user_role['IsProvider'];
  $_SESSION['IsClientAdmin'] = $user_role['IsClientAdmin'];
  $_SESSION['IsClientUser']  = $user_role['IsClientUser'];

  $_SESSION['can_see_companies_yn'] = isset($record["can_see_companies_yn"]) ? $record["can_see_companies_yn"] : 0;
  $_SESSION['can_see_employee_general_yn'] = isset($record["can_see_employee_general_yn"]) ? $record["can_see_employee_general_yn"] : 0;
  $_SESSION['can_modify_employee_payroll_yn'] = isset($record["can_modify_employee_payroll_yn"]) ? $record["can_modify_employee_payroll_yn"] : 0;
  $_SESSION['can_see_accounting_yn'] = isset($record["can_see_accounting_yn"]) ? $record["can_see_accounting_yn"] : 0;
  $_SESSION['can_see_tax_forms_yn'] = isset($record["can_see_tax_forms_yn"]) ? $record["can_see_tax_forms_yn"] : 0;
  $_SESSION['can_see_real_estate_yn'] = isset($record["can_see_real_estate_yn"]) ? $record["can_see_real_estate_yn"] : 0;
  $_SESSION['can_see_immigration_yn'] = isset($record["can_see_immigration_yn"]) ? $record["can_see_immigration_yn"] : 0;

  // User Inicialize values
  $_SESSION['language']  = isset($record["language_cd"]) ? $record["language_cd"] : 'en';
  $_SESSION['username']  = isset($record["username"]) ? $record["username"] : $_SESSION['username'];
  $_SESSION['user_id']   = isset($record["user_id"]) ? $record["user_id"] : $_SESSION['user_id'];
  $_SESSION['parent_user_id'] = isset($record['parent_user_id']) ? $record['parent_user_id'] : $_SESSION['parent_user_id'];
  $_SESSION['master_user_id'] = isset($record["user_id"]) ? $record["user_id"] : $_SESSION['user_id'];
  $_SESSION['status_block_dt'] = isset($record["status_block_dt"]) ? $record["status_block_dt"] : $_SESSION['status_block_dt'];
  $_SESSION['use_can_same_contact_list_yn'] = isset($record["use_can_same_contact_list_yn"]) ? $record["use_can_same_contact_list_yn"] : $_SESSION['use_can_same_contact_list_yn'];
  $_SESSION['user_country_id']  = isset($record["country_id"]) ? $record["country_id"] : 724;
}


function sw_get_company_parameter($company_id)
{
  Global $connectionDB;

  $sql = "SELECT * FROM company WHERE company_id = {$company_id}";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $_SESSION['company_id'] = 0;
  $_SESSION['company_name'] = "";
  $_SESSION['short_name'] = "";
  $_SESSION['tax_regime_id'] = 1;
  $_SESSION['acct_manager_id'] = 0;
  $_SESSION['payroll_provider_id'] = 0;
  $_SESSION['accounting_provider_id'] = 0;
  $_SESSION['contact_list_id'] = 0;
  $_SESSION['user_status_cd'] = '';
  $_SESSION['tax_ident_type_cd'] = 0;
  $_SESSION['country_id'] = 724;
  $_SESSION['company_strong'] = sw_company_country_strong($company_id);

  if (!$query->EOF) {
    $_SESSION['company_id'] = $query->Fields["company_id"];
    $_SESSION['company_name'] = $query->Fields["company_name"];
    $_SESSION['short_name'] = $query->Fields["short_name"];
    $_SESSION['tax_regime_id'] = $query->Fields["tax_regime_id"];
    $_SESSION['acct_manager_id'] = $query->Fields["acct_manager_id"];
    $_SESSION['payroll_provider_id'] = $query->Fields["payroll_provider_id"];
    $_SESSION['accounting_provider_id'] = $query->Fields["accounting_provider_id"];
    $_SESSION['contact_list_id'] = $query->Fields["contact_list_id"];
    $_SESSION['tax_ident_type_cd'] = $query->Fields["tax_ident_type_cd"];
    $_SESSION['country_id'] = $query->Fields["country_id"];

    $record = sw_get_data_table('user', 'user_id = ' . $query->Fields["user_id"], 'status_cd');
    $_SESSION['user_status_cd'] = $record['status_cd'];
  }

	sw_settings_tempo();
}

// Get Address Company
function sw_get_address_active_company($company_id = 0)
{
  Global $connectionDB;

  $company_id = !$company_id ? $_SESSION['company_id'] : $company_id;
  $sql = "SELECT company.*, street_type.description
  				FROM company LEFT JOIN street_type ON company.regaddress_street_type_id = street_type.street_type_id
  				WHERE company.company_id = {$company_id}";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $address_company = array();
  if (!$query->EOF) {
  	$address_company['address'] = trim($query->Fields["description"]);
    $address_company['address'] .= trim($query->Fields["regaddress_street"]) != "" ? " " . trim($query->Fields["regaddress_street"]) : "";
    $address_company['address'] .= trim($query->Fields["regaddress_street_no"]) != "" ? " " . trim($query->Fields["regaddress_street_no"]) : "";
    $address_company['address'] .= trim($query->Fields["regaddress_floor"]) != "" ? ", " . trim($query->Fields["regaddress_floor"]) : "";
    $address_company['address'] .= trim($query->Fields["regaddress_door"]) != "" ? " " . trim($query->Fields["regaddress_door"]) : "";
		$address_company['post_code'] = trim($query->Fields["regaddress_post_code"]);
		$address_company['city'] = trim($query->Fields["regaddress_city"]);
		$address_company['province'] = trim($query->Fields["regaddress_province"]);
  }

	return $address_company;
}

// Get Address Company Client
function sw_get_client_data($company_client_id = 0)
{
  Global $connectionDB, $language;

  $company_client_id = $company_client_id == "" ? 0 : $company_client_id;

  $sql = "SELECT company_client.*, street_type.description, country.{$language} AS country_name
  				FROM company_client
          		LEFT JOIN street_type ON company_client.address_street_type_id = street_type.street_type_id
              LEFT JOIN country ON company_client.country_id = country.country_id
  				WHERE company_client.company_client_id = {$company_client_id}";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $client_data = $query->fieldbuffer;
  if (!$query->EOF) {
  	$client_data['address'] = trim($query->Fields["description"]);
    $client_data['address'] .= trim($query->Fields["address_street"]) != "" ? " " . trim($query->Fields["address_street"]) : "";
    $client_data['address'] .= trim($query->Fields["address_street_no"]) != "" ? " " . trim($query->Fields["address_street_no"]) : "";
    $client_data['address'] .= trim($query->Fields["address_floor"]) != "" ? ", " . trim($query->Fields["address_floor"]) : "";
    $client_data['address'] .= trim($query->Fields["address_door"]) != "" ? " " . trim($query->Fields["address_door"]) : "";
    $client_data['address'] .= trim($query->Fields["address_city"]) != "" ? ", " . trim($query->Fields["address_city"]) : "";
    $client_data['address'] .= trim($query->Fields["postal_cd"]) != "" ? ", " . trim($query->Fields["postal_cd"]) : "";
    $client_data['address'] .= trim($query->Fields["address_province"]) != "" ? " " . trim($query->Fields["address_province"]) : "";
    $client_data['address'] .= trim($query->Fields["country_name"]) != "" ? " " . trim($query->Fields["country_name"]) : "";
  }

	return $client_data;
}

function sw_valid_TaxID_client($tax_ident, $company_id, $company_client_id)
{
  Global $lbCompanyTaxIdent_error, $lbCompanyTaxIdentExist;

  $msg = "";
  if (!$tax_ident) {
  	$msg = $lbCompanyTaxIdent_error;
  }
  else {
  	$sql = "(tax_ident = '{$tax_ident}') AND (company_id = {$company_id})";
    $sql .= ($company_client_id) ? " AND (company_client_id != {$company_client_id})" : "";
    if ($record = sw_get_data_table('company_client', $sql)) {
       $msg = "Tax Id: {$tax_ident} - {$record['client_name']}, is already created <br/>";
		}
  }

  return $msg;
}

//checked file valid name
function sw_checked_file_valid_name($filename)
{
  $caracter = array("\\", "¨", "º", "~", "#", "@", "|", "!", "·", "$", "%", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "<", ";", ":", "(", ")", "/");
  $filename = sw_clean_characters_spanish(html_entity_decode($filename, ENT_QUOTES));
  return strtolower(str_replace($caracter, "", $filename));
}


//download file
function sw_download_file_Zip($file, &$zip)
{
  Global $VirtualFile;

  //Check access files
  $record = sw_get_data_table("vw_virtual_file", "(link = '{$file}')", "username, company_id");

  if (!sw_check_access_file($file)) return true;

  if (!is_dir($file)){
	  $localFile = $file;
    $DirFile = str_replace($VirtualFile . "/", "", $file);
    $zip->addFile($file, $DirFile);
  }
  else
  {
    $list = @scandir($file);
	if (is_array($list)) {
		foreach($list as $item){
			if (($item != ".") && ($item != "..")){
				$localFile = $file. "/" . $item;
				$DirFile = $file. "/" . $item;
				$DirFile = str_replace($VirtualFile . "/", "", $DirFile);

				if (is_dir($localFile)){
					$zip->addDir($DirFile);
					sw_download_file_Zip($localFile, $zip);
				}
				else {
					$record = sw_get_data_table("vw_virtual_file", "(link = '{$localFile}')", "username, company_id");

					if (sw_check_access_file($localFile, $record)) {
						$zip->addFile($localFile, $DirFile);
					}
				}
			}
		}
	}
  }
}


function array_sort_multi($array, $key,$key2){
  foreach ($array as $i => $k) {
    if (! empty($array[$i][$key][$key2])){
       $sort_values[$i] = $array[$i][$key][$key2];
    } else{
       $sort_values[$i] = $array[$i];
    }
  }
  asort ($sort_values);
  reset ($sort_values);
  while (list ($arr_keys, $arr_values) = each ($sort_values)) {
    $sorted_arr[] = $array[$arr_keys];
  }
  return $sorted_arr;
}


function directoryPath($string, $server) {
  $stringArray = split("/",$string);
  $level = count($stringArray);

  $down = "";
	$levelCount=0;
	while($levelCount<$level-1) {
	  $down .= "../";
		$levelCount++;
	}

  //Herman
	//$returnString = "<A HREF=\"javascript:submitForm('cd', '" . $down . "')\" style='text-decoration:underline;'>&lt;" . $server . "&gt;</A>";
	foreach($stringArray as $str) {
	  $down = "";
		$level = $level - 1;
		$levelCount=0;
		while($levelCount<$level) {
			$down .= "../";
			$levelCount++;
		}

		if($level>=0) {
		  $returnString .= "<A HREF=\"javascript:submitForm('cd', '" . $down . "')\" style='text-decoration:underline;'>" .  $str . "</A>/";
		}
	}
	return $returnString;
}


function filePart($string) {
  $stringArray = explode("/",$string);
	$level = count($stringArray);
	if ($stringArray[$level-1]=="")
	  	return $stringArray[$level-2];
	else
			return $stringArray[$level-1];
}


function fileDescription($filename){
  $ext = strtolower(getExtention($filename));
	if($ext == 'png' OR $ext == 'gif' OR $ext == 'jpg' OR $ext == 'psp' OR $ext == 'bmp' OR $ext == 'ai' OR $ext == 'tiff'){
	  $res['imgfilename'] = 'pic.gif';
		$res['description'] = strtoupper($ext).' Image/Picture';
	}elseif($ext == 'html' OR $ext == 'htm'){
	  $res['imgfilename'] = 'html.gif';
		$res['description'] = 'HTML Document';
	}elseif($ext == 'css'){
	  $res['imgfilename'] = 'txt.gif';
		$res['description'] = 'Stylesheet';
	}elseif($ext == 'doc'){
	  $res['imgfilename'] = 'doc.gif';
		$res['description'] = 'Word Document';
	}elseif($ext == 'csv' OR $ext == 'xls' OR $ext == 'xlsx'){
	  $res['imgfilename'] = 'xls.gif';
		$res['description'] = 'Spreadsheet Document';
	}elseif($ext == 'pdf'){
	  $res['imgfilename'] = 'pdf.gif';
		$res['description'] = 'PDF Document';
	}elseif($ext == 'php' OR $ext == 'php3'){
	  $res['imgfilename'] = 'php.gif';
		$res['description'] = 'PHP Script';
	}elseif($ext == 'js'){
	  $res['imgfilename'] = 'js.gif';
		$res['description'] = 'Javascript';
	}elseif($ext == 'swf'){
	  $res['imgfilename'] = 'pic.gif';
		$res['description'] = 'Flash file';
	}elseif($ext == 'txt'){
	  $res['imgfilename'] = 'txt.gif';
		$res['description'] = 'Textfile';
	}elseif($ext == 'avi' OR $ext == 'mov' OR $ext == 'mpg' OR $ext == 'rm'){
	  $res['imgfilename'] = 'mov.gif';
		$res['description'] = 'Video file';
	}elseif($ext == 'mp3' OR $ext == 'wav' OR $ext == 'ogg'){
	  $res['imgfilename'] = 'mov.gif';
		$res['description'] = 'Audio file';
	}elseif($ext == 'zip' OR $ext == 'rar' OR $ext == 'cab' OR $ext == 'b2z'){
	  $res['imgfilename'] = 'zip.gif';
		$res['description'] = 'Compressed file';
	}elseif($ext == 'exe' OR $ext == 'com' OR $ext == 'bat'){
	  $res['imgfilename'] = 'exe.gif';
		$res['description'] = 'Application';
	}elseif($ext == 'exe' OR $ext == 'com' OR $ext == 'bat'){
	  $res['imgfilename'] = 'exe.gif';
		$res['description'] = 'Application';
	}else{
	  $res['imgfilename'] = 'file.gif';
		$res['description'] = $ext . ' File';
	}

	return $res;
}


function getExtention($filename){
  if(($dotpos = strrpos($filename, '.')) === false){
	  return false;
	}else{
	  return substr($filename, $dotpos+1);
	}
}

function deleteRecursive($dirname){
  // recursive function to delete
	// all subdirectories and contents:
	if (is_dir($dirname)) $dir_handle = opendir($dirname);

  while ($file=readdir($dir_handle)){
		  if($file!="." && $file!=".."){
		    if (!is_dir($dirname."/".$file)) unlink ($dirname."/".$file);
		    else deleteRecursive($dirname."/".$file);
		  }
	}
	closedir($dir_handle);
	rmdir($dirname);
	return true;
}


function sw_replace_quotes($text)
{
  if(get_magic_quotes_gpc() != 0) {
    $text = stripslashes($text);
  }
  return mysql_real_escape_string($text);
}


/**
 * Reemplaza todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function sw_clean_characters_spanish($string)
{
  $string = utf8_decode(trim($string));
  $search =  array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä',
                   'é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë',
                   'í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î',
                   'ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô',
                   'ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü',
                   'ñ', 'Ñ', 'ç', 'Ç');

  $replace = array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A',
                   'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E',
                   'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I',
                   'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O',
                   'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U',
                   'n', 'N', 'c', 'C');

  return str_replace($search, $replace, $string);
}


function dir_name($dir)
{
   $dir = realpath($dir);
   $pos = strrpos($dir, "\\");//Windows
   if($pos === false)
   {
      $pos = strrpos($dir, "/");//Linux :)
   }
   $dir = substr($dir, $pos + 1, strlen($dir) - $pos);
   return $dir;
}


function sw_convert_comma_point($number)
{
  if ((strpos($number, ',')>0) && (!strpos($number, '.'))){
    $number = str_replace(',', '.', $number);
  }else {
      $number = str_replace(',', '', $number);
  }
  return number_format($number, 2, '.', '');
//  return $number;
}


function sw_generate_password ($length = 8)
{
  // start with a blank password
  $password = "";

  $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
  $maxlength = strlen($possible);
  $length = ($length > $maxlength) ? $maxlength : $length;

  // set up a counter for how many characters are in the password so far
  $i = 0;
  while ($i < $length) {
    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, $maxlength-1), 1);
    $password .= $char;
    $i++;
  }

  // done!
  return $password;
}


function sw_set_email_template(&$mail, $trigger_file_keyword, $ReplaceField, $mail_foot = false, $settings)
{
  Global $connectionDB;

  $sql = "SELECT * FROM email_template WHERE trigger_file_keyword = '{$trigger_file_keyword}'";
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = 0;
  $query->LimitCount = 1;
  $query->SQL = $sql;
  $query->open();

  if (!$query->EOF) {
    $Subject = $query->Fields['subject'];
		$ReplaceField['month'] = date('F');
		$ReplaceField['year'] = date('Y');
		$ReplaceField['-year'] = date('Y')-1;

    foreach ($ReplaceField as $key => $fieldvalue) {
      $Subject = str_replace('{' . $key . '}', $fieldvalue, $Subject);
    }

    $body = $query->Fields['body'];
    foreach ($ReplaceField as $key => $fieldvalue) {
      $body = str_replace('{' . $key . '}', $fieldvalue, $body);
    }

    if ($mail_foot) {
      $body .= $settings['se_standard_email_foot'];
    }

    $mail->Subject = $Subject;
    $mail->MsgHTML($body);
	$mail->AddBCC($settings['se_internal_email']);
  }
}

function sw_clean_caracter_tax_ident($tax_ident)
{
  $caracter = array("\\", "¨", "º", "~", "#", "@", "|", "!", "·", "$", "%", "&", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "<", ";", ":", "(", ")", ".", "/", " ", "-", "_");
  $tax_ident = strtoupper(str_replace($caracter, "", $tax_ident));

  return $tax_ident;
}


function sw_status_user()
{
  $status = '';
  if (($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']) && ($_SESSION['user_status_cd'] !== 'a')){
    Global $GLOBAL_USER_STATUS_CODE;

    $status = SW_CAPTION_STATUS . " " . $GLOBAL_USER_STATUS_CODE[$_SESSION['user_status_cd']];
  }
  return $status;
}


function sw_last_company_invoice(){
	$last_invoice = '';

	$sql = "SELECT company_join_client.company_id, DATE_FORMAT(MAX(invoice_issued.invoice_dt), '%M/%Y') As invoice_dt
				  FROM company
							INNER JOIN company_join_client ON company.company_id = company_join_client.company_id
							INNER JOIN invoice_issued ON company_join_client.company_client_id = invoice_issued.company_client_id
					WHERE company.company_id = {$_SESSION['company_id']}
					GROUP BY company_join_client.company_id";

	$record = sw_records_array($sql, array('company_id', 'invoice_dt'));
	if ($record){
			$last_invoice = SW_CAPTION_LAST_INVOICE . " {$record[$_SESSION['company_id']]}";
	}

	return $last_invoice;
}

//Insert user
function sw_insert_user($record, $roles)
{
  Global $connectionDB;
  $record['created_dt'] = date('Y-m-d h:i:s');
  $record['country_id'] = $_SESSION['user_country_id'];
  $created_by_user_id = $_SESSION['user_id'];
  $username = $record['username'];
  //$sql = "INSERT INTO user (username, parent_user_id, created_by_user_id, country_id,
  //        VALUES('{$record['username']}', {$record['parent_user_id']}, {$created_by_user_id}, {$record['country_id']},
  $sql = "INSERT INTO user (username, parent_user_id, created_by_user_id,
                            password, created_dt,
                            can_see_companies_yn,
                            can_see_employee_general_yn,
                            can_modify_employee_payroll_yn,
                            can_see_accounting_yn,
                            can_see_tax_forms_yn,
                            can_see_real_estate_yn,
                            can_see_immigration_yn)
          VALUES('{$record['username']}', {$record['parent_user_id']}, {$created_by_user_id},
                   PASSWORD('{$record['password']}'), '{$record['created_dt']}',
                   {$record['can_see_companies_yn']},
                   {$record['can_see_employee_general_yn']},
                   {$record['can_modify_employee_payroll_yn']},
                   {$record['can_see_accounting_yn']},
                   {$record['can_see_tax_forms_yn']},
                   {$record['can_see_real_estate_yn']},
                   {$record['can_see_immigration_yn']})";

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();
  $user_id = mysql_insert_id();

  //Update the user roles
  sw_update_user_roles($user_id, $username, $roles);

  return $user_id;
}


function sw_update_user_roles($user_id, $username, $roles)
{
  Global $connectionDB;

  foreach ($roles as $role){
    if ($record = sw_get_data_table("role", "role_name = '{$role}'")) {
      $value .= $value ? ", " : "VALUES ";
      $value .= "({$user_id}, {$record['role_id']})";

      //Created Folder
      if ($role == 'Client admin') {
      	sw_created_directory_client_ftp_server($username);
      }
    }
  }


  if ($value && $user_id) {
    sw_delete_table("user_role", "user_id = {$user_id}");

    $sql = "INSERT INTO user_role(user_id, role_id) " . $value;
    $connectionDB->DbConnection->BeginTrans();
    $connectionDB->DbConnection->execute($sql);
    $connectionDB->DbConnection->CompleteTrans();
  }
}


function sw_created_directory_client_ftp_server($short_name)
{
  Global $VirtualFile, $Directory_client_ftp_server;
  $dir_cliente = "{$VirtualFile}" . TMP_CLIENT_FTP_SERVER . "/" . trim($short_name);
  foreach ($Directory_client_ftp_server as $dir) {
  	$dir = $dir_cliente . "/" . $dir;
    if (!file_exists($dir)){
    	mkdir($dir, 0777, true);
    }
  }
}


function sw_view_filter_grid($grid)
{
  foreach( $grid->Columns as $Columna )
  {
    $Columna->Filter = "";
  }
  $grid->Header->ShowFilterBar = !$grid->Header->ShowFilterBar;
  return false;
}


function sw_get_provider_contact($search)
{
  Global $connectionDB;

  $sql = "SELECT * FROM vw_provider_contact WHERE (provider_contact_id = '{$search}') OR (email = '{$search}')";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  return $query->fieldbuffer;
/*  if (!$query->EOF){
    $_SESSION['provider_contact_name'] = $query->Fields['provider_contact_name'];
    $_SESSION['provider_contact_email'] = $query->Fields['email'];
  }
*/
}


function sw_noCache()
{
  header("Expires: Tue, 01 Jan 2013 06:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
}


function sw_style_selected($form)
{
  if (property_exists($form->name, 'SiteTheme')) {
    Global $StyleTheme, $languages, $language;

    $form->SiteTheme->Theme = $StyleTheme;
    $form->SiteTheme->LanguageFile = strtolower($languages[$language]);
  }
}


function sw_check_in_range($start_date, $end_date, $date) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($date);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}


function sw_check_menu_help(){

  $sql = "SELECT DISTINCT virtual_file.nodo_id, virtual_file.description_{$_SESSION['language']}
          FROM virtual_file
          INNER JOIN help_content ON virtual_file.parent_id = help_content.directory_id
          WHERE (link like '%help.php%') AND help_content.clients_can_see_yn = 1";
  $return = '0';
  $record = sw_records_array($sql, array("nodo_id", "description_{$_SESSION['language']}"));
  foreach ($record as $key => $value){
    $return .= $return ? ", " . $key : $key;
  }

  return $return;
}

function redirect_url( $file )
{
    $host = $_SERVER[ 'HTTP_HOST' ];
    $url_ssl = $_SERVER["HTTPS"] === 'on' ? 'https://' : 'http://';
    $uri = rtrim( dirname( $_SERVER[ 'PHP_SELF' ] ), '/\\' );
    $file = substr($file, 0, 1) !== '/' ? '/' . $file : $file;
    header( 'Location: ' . $url_ssl . $host . $uri . $file );
    die();
}

function sw_future_invoice_date($date)
{
	list($year, $month, $day) = explode("-", $date);
  return date("Y-m-d", mktime(0,0,0,$month+1,6,$year));
}


function sw_translate_caption($object)
{
	foreach ($object as $name => $property)
  {
  	if (is_object($property)){
				sw_translate_caption($property);
    }
    else if (strtoupper($name) == 'CAPTION'){
    	$property = $name;
    }
  }
}


function sw_created_combobox_service($field, $select = 'All')
{
  Global $connectionDB;

  $sql = "SELECT service.service_id, service.description_en, service_category.service_category_name,
  							concat( service.description_en, '  |  ',
                FORMAT(IFNull(service.price_amt, 0), 2), '  |   ', IFNULL(service.notes, '')) AS description
					FROM service
								LEFT JOIN service_category ON service.service_category_id = service_category.service_category_id ";

  if ($select == 'OnlyService') {
  	$sql .= "WHERE (service_category.supplement_yn = 0)";
  } else if ($select == 'Supplement') {
  	$sql .= "WHERE (service_category.supplement_yn = 1)";
  } else if ($select == 'RegularService') {
  	$sql .= "WHERE (service.sort_service_agreement_yn = 0)";
	}


  $sql .= "ORDER BY service_category_name, sort_no, description";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $html = "<select id='{$field}' name='{$field}'>";
  $group =  '';

  While (!$query->EOF) {
  	$fields = $query->Fields;
    if ($group !== $fields['service_category_name']){
    	$html .= strlen($group) != 0 ? "</optgroup>" : "";
      $html .= "<optgroup label='{$fields['service_category_name']}'>";
      $group = $fields['service_category_name'];
    }
		$html .= "<option value={$fields['service_id']}>{$fields['description']}</option>";
    $query->next();
  }
	$html .= "</optgroup></select>";

  return $html;
}


function sw_get_tax_rate_default($tax_type_key_id = 0, $company_id = 0 )
{
	$company_id = !$company_id ? $_SESSION['company_id'] : $company_id;
  $where = "company.company_id = company_accounting.company_id AND company_accounting.company_id = '{$company_id}'";
	$tax_rate_default = sw_get_data_table('company, company_accounting', $where, "company.country_id, company.tax_regime_id, company_accounting.tax_rate_id");

  if (!$tax_type_key_id) $where = "country_id = {$tax_rate_default['country_id']} AND tax_type_cd = 'G'";
  else $where = "tax_type_key_id = {$tax_type_key_id}";
  $record = sw_get_data_table("tax_type_key", $where);

  $where = "tax_rate_id = '{$tax_rate_default['tax_rate_id']}'";
  if ($record["tax_type_cd"] !== "G" || !$tax_rate_default['tax_rate_id']){
  	$where = "tax_regime_id = {$tax_rate_default['tax_regime_id']} AND rate_no = 0";
  }
  $record = sw_get_data_table('vw_tax_rate_country', $where);

  return $record;
}


function sw_replace_date_macro($string, $date)
{
	Global $MonthLetter;
	list($year, $month, $day) = explode("-", $date);

	$month = intval($month);
	$month_prior = $month == 1 ? 12 : $month-1;
	$month_next = $month == 12 ? 1 : $month+1;

  $month = $MonthLetter[$month];
  $month_prior = $MonthLetter[$month_prior];
  $month_next = $MonthLetter[$month_next];
  $string = str_replace("{month}", $month, $string);
  $string = str_replace("{-month}", $month_prior, $string);
  $string = str_replace("{+month}", $month_next, $string);

	$year = intval($year);
  $year_prior = $year-1;
  $year_next = $year+1;
  $string = str_replace("{year}", $year, $string);
  $string = str_replace("{-year}", $year_prior, $string);
  $string = str_replace("{+year}", $year_next, $string);

  return $string;
}


function sw_valid_invoice_issued($invoice)
{
	Global $lbInvoiceIsAlreadyCreate_error, $lbInvoiceDateInvalid, $lbSelectClient_error;

  $company_id = $invoice['company_id'];
  $invoice_issued_id = $invoice['invoice_issued_id'];
  $invoice_number = $invoice['invoice_number'];
  $invoice_dt = $invoice['invoice_dt'];
  $company_client_id = $invoice['company_client_id'];
  $msg = "";

  //Valid Invoice date
  if (!$invoice_dt){
  	$msg = $lbInvoiceDateInvalid;
  }

  //Valid Invoice
  $where = "(company_id = {$company_id}) AND (invoice_issued_id != {$invoice_issued_id}) AND
  					(invoice_number = '{$invoice_number}')"; //  AND (YEAR(invoice_dt) = YEAR('{$invoice_dt}'))";
  if ((!$msg) && $record = sw_get_data_table("invoice_issued", $where)) {
  	$msg = $lbInvoiceIsAlreadyCreate_error;
  }

  //Valid client
  if ((!$msg) && (!$company_client_id)){
  	$msg = $lbSelectClient_error;
  }

  return $msg;
}


function sw_last_invoice_issued($company_id, $abono = False)
{
  Global $connectionDB;

  $sql = "SELECT MAX(CONVERT(invoice_number, UNSIGNED INTEGER)) AS invoice_number FROM invoice_issued
	   WHERE company_id = {$company_id} AND YEAR(invoice_dt) > 2013 AND total_amt ";
  $sql .= $abono ? " < 0 " : " >= 0 ";
  $connectionDB->Connected();
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->SQL = $sql;
  $query->open();

  $last_invoice = !$query->Fields['invoice_number'] ? $last_invoice = 1 : intval($query->Fields['invoice_number']) + 1;
//  $last_invoice = $last_invoice > $invoice_number ? $last_invoice : $invoice_number;

  return $last_invoice;
}


function sw_valid_client_tax_ident($tax_ident)
{
	$tax_ident = sw_clean_caracter_tax_ident($tax_ident);
  $record_client = sw_get_data_table('company_client', "tax_ident = '{$tax_ident}' AND company_id = {$_SESSION['company_id']}", "company_client_id, tax_ident, client_name");

  return $record_client;
}


function sw_UpdateInvoiceIssuedPaid($invoice_issued_id)
{
  Global $connectionDB;
  $connectionDB->DbConnection->BeginTrans();

  //Update Service Agreement
	$sql = "UPDATE invoice_issued
          LEFT JOIN
            (SELECT invoice_issued_id, MAX(paid_dt) AS paid_dt, SUM(paid_amt) AS paid_amt
            FROM invoice_issued_paid
            WHERE invoice_issued_id in ({$invoice_issued_id})
            GROUP BY invoice_issued_id) AS invoice_issued_paid
       		ON invoice_issued.invoice_issued_id = invoice_issued_paid.invoice_issued_id
					SET invoice_issued.paid_dt = CASE IFNULL(invoice_issued_paid.paid_amt, 0) WHEN 0 THEN null ELSE invoice_issued_paid.paid_dt END,
              invoice_issued.paid_yn = CASE WHEN invoice_issued_paid.paid_amt >= invoice_issued.total_amt THEN 1 ELSE 0 END,
              invoice_issued.paid_amt = IfNull(invoice_issued_paid.paid_amt, 0)
          WHERE invoice_issued.invoice_issued_id in ({$invoice_issued_id})";

  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();

  sw_create_PDF_invoice($invoice_issued_id);
}


function sw_create_PDF_invoice($invoice_issued_id, $created_email_draft = false)
{
	Global $VirtualFile, $language, $connectionDB, $format_money_mysql;

	$sql = "SELECT invoice_issued.*, (invoice_issued.total_amt - invoice_issued.paid_amt) AS pay_amt,
  					company.company_name, company.company_id, tax_type_key.tax_law_description,
  					invoice_issued_tax.rate_no, tax_regime.tax_label, payment_method.payment_message
					FROM invoice_issued
       					INNER JOIN company ON invoice_issued.company_id = company.company_id
       					LEFT JOIN tax_type_key ON invoice_issued.tax_type_key_id = tax_type_key.tax_type_key_id
       					LEFT JOIN invoice_issued_tax ON invoice_issued.invoice_issued_id = invoice_issued_tax.invoice_issued_id
       					LEFT JOIN tax_rate ON invoice_issued_tax.tax_rate_id = tax_rate.tax_rate_id
       					LEFT JOIN tax_regime ON tax_rate.tax_regime_id = tax_regime.tax_regime_id
							  LEFT JOIN payment_method
								ON invoice_issued.payment_method_id = payment_method.payment_method_id
					WHERE invoice_issued.invoice_issued_id in ({$invoice_issued_id})";

  $connectionDB->Connected();
  $record = $connectionDB->DbConnection->execute($sql);
  if ($record->fields['invoice_issued_id']) {

  	$fields = $record->fields;

    $record = sw_get_client_data($fields['company_client_id']);
    $fields['address'] = $record['address'];
    $record_strong = sw_company_client_strong($fields['company_client_id']);

	  $settings = sw_setting_company($record_strong ? $record_strong['company_id'] : $_SESSION['company_id']);
    $fields['biller_address'] = $settings['biller_address'];

    list($year, $month, $day) = explode("-", $fields['invoice_dt']);
    $fields['invoice_dt'] = $day . "-" . $month . "-" . $year;
    $fields['invoice_caption'] = floatval($fields['total_amt']) >= 0 ? SW_CAPTION_INVOICE_NUMBER : SW_CAPTION_CREDIT_NOTE;
		$fields['your_bank_receipt_message'] = "";

		$credit_note_yn = strpos($fields['invoice_number'], $_SESSION['settings']['serie_credit_note']) !== false;
    //Payment_method
		if ($fields['pay_amt'] > 0 && !$credit_note_yn){
      	$fields['payment_message'] = str_replace("{month}", $month, $fields['payment_message']);
      	$fields['payment_message'] = str_replace("{year}", $year, $fields['payment_message']);
				$fields['your_bank_receipt_message'] = 'Your bank receipt is your proof of payment of this amount.';
		} else {
			$fields['payment_message'] = "";
		}

		// Credit Note
		if ($credit_note_yn){
		   $fields['payment_message'] = $fields['notes'];
		}

    $template_invoice = file_get_contents('html/template_invoice.html');

		$sql = "SELECT line_item.*, service.supplement_yn
    				FROM line_item
     							LEFT JOIN (SELECT vw_service.service_id, supplement_yn, vw_service.sort_no FROM vw_service) AS service ON line_item.service_id = service.service_id
        		WHERE invoice_issued_id = {$invoice_issued_id} ORDER BY service.sort_no";

  	$query = new query();
  	$query->Database = $connectionDB->DbConnection;
  	$query->LimitStart = -1;
  	$query->LimitCount = -1;
  	$query->SQL = $sql;
  	$query->open();

	$fmt = new NumberFormatter( $format_money_mysql, NumberFormatter::CURRENCY );

	$fields['line_item'] = '';
    $fields['supplement'] = round($fields['other_income_amt']) != '0' ? '<strong>Suplidos:</strong><br />' : '';
    $fields['line_item_supplement'] = '';
  	While (!$query->EOF){
			$line_item = $query->fieldbuffer;
			$line_item['quantity_no'] = sw_convert_comma_point($line_item['quantity_no']);
			$line_item['price_amt'] = $fmt->formatCurrency($line_item['price_amt'], "EUR");
			$line_item['total_amt'] = $fmt->formatCurrency($line_item['total_amt'], "EUR");
      if (!$line_item['supplement_yn']){
  			$line = "<tr>
    								<td style='width:50%; height:auto;'><div style='text-align: left; margin-left: 15px;'>{$line_item['description']}</div></td>
    								<td style='width:10%; height:12px'><div style='text-align: right;'>{$line_item['quantity_no']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right;'>{$line_item['price_amt']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right; margin-right: 15px;'>{$line_item['total_amt']}</div></td>
  									</tr>";
        $fields['line_item'] .= $line;
      } else {
  			$line_supplement = "<tr>
    								<td style='width:50%; height:12px'><div style='text-align: left; margin-left: 15px;'>{$line_item['description']}</div></td>
    								<td style='width:20%; height:12px'><div style='text-align: right; margin-right: 15px;'>{$line_item['total_amt']}</div></td>
  									</tr>";
        $fields['line_item_supplement'] .= $line_supplement;
      }
      $query->next();
    }

  	//Totales
		$fields['subtotal_amt'] = $fmt->formatCurrency($fields['subtotal_amt'], "EUR");
		$fields['tax_amt'] = $fmt->formatCurrency($fields['tax_amt'], "EUR");
		$fields['rate_no'] = sw_convert_comma_point($fields['rate_no']);
		$fields['other_income_amt'] = $fmt->formatCurrency($fields['other_income_amt'], "EUR");
		$fields['total_amt_convert'] = $fmt->formatCurrency(currency_converter("EUR", "USD", $fields['total_amt']), "USD");
		$fields['total_amt'] = $fmt->formatCurrency($fields['total_amt'], "EUR");
		$fields['paid_amt'] = $fmt->formatCurrency($fields['paid_amt'], "EUR");
		$fields['pay_amt'] = $fmt->formatCurrency($fields['pay_amt'], "EUR");

		//

    foreach ($fields as $field => $value)
    {
    	$template_invoice = str_replace("{{$field}}", $value, $template_invoice);
    }

    $directory = $VirtualFile . TMP_INVOICE_STRONG . "/{$year}/{$month}" . substr($year, 2, 2) . "/";
    $filename = "invoice {$year} {$month} {$fields['invoice_number']} " . $record_strong['short_name'] . ".pdf";
    $file_invoice = $directory . $filename;

    if(file_exists($file_invoice))
	  	unlink($file_invoice);

  	//Erase PDF file before
    if (file_exists($fields['link']) && unlink($fields['link'])) sw_delete_register_file($fields['link']);

    require_once("html2pdf/html2pdf.class.php");
    $html2pdf = new HTML2PDF('P','A4','fr');
		$html2pdf->pdf->SetAuthor($_SESSION['company_name']);
		$html2pdf->pdf->SetTitle('Invoice Issued');
		$html2pdf->pdf->SetKeywords('Invoice, Issued');
    $html2pdf->WriteHTML($template_invoice);
    if (!$html2pdf->pdf->Output($file_invoice, 'F')){
      //Create email draft
      if ($created_email_draft) sw_register_file($directory, $filename, date('Y-m-d H:i:s'));
      sw_update_table("invoice_issued", array("link"=>$file_invoice), "invoice_issued_id = {$invoice_issued_id}");
    }
  }
}

function sw_get_client_ip()
{
  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip=$_SERVER['REMOTE_ADDR'];
  }

  return $ip;
}


function sw_settings_tempo()
{
  eval("\$_SESSION['settings'] = sw_setting_company({$_SESSION['company_id']});");
//  eval("\$_SESSION['settings'] = sw_get_data_table('setting','billing_entity_id = 1');");
}

// Get setting of company
function sw_setting_company($company_id)
{
	Global $connectionDB;

	$sql = "SELECT setting.*, billing_entity.company_id
					FROM setting
								INNER JOIN billing_entity ON setting.billing_entity_id = billing_entity.billing_entity_id
								INNER JOIN company ON setting.billing_entity_id = company.billing_entity_id
					WHERE company.company_id = {$company_id}";

	$connectionDB->Connected();
	$record = $connectionDB->DbConnection->execute($sql);
	if ($record->fields['billing_entity_id']) {
		return $record->fields;
	} else return null;
}


function currency_converter($moneda_origen,$moneda_destino,$cantidad) {
	$get = file_get_contents("https://www.google.com/finance/converter?a=$cantidad&from=$moneda_origen&to=$moneda_destino");
	$get = explode("<span class=bld>",$get);
	$get = explode("</span>",$get[1]);
	return preg_replace("/[^0-9\.]/", null, $get[0]);
}


//Totalizo Factura
function TotalInvoice($invoice_issued_id = 0)
{
	Global $connectionDB;

  $sql = "INSERT INTO invoice_issued_tax(invoice_issued_id, tax_rate_id, rate_no, base_amt, tax_amt)
   				SELECT line_item.invoice_issued_id, line_item.tax_rate_id, line_item.rate_no,
    							SUM(line_item.total_amt) AS base_amt,
     							ROUND(SUM(line_item.total_amt * line_item.rate_no)/100, 2) as tax_amt
					FROM line_item
   						INNER JOIN service ON line_item.service_id = service.service_id
   						INNER JOIN service_category ON service.service_category_id = service_category.service_category_id
					WHERE line_item.invoice_issued_id = '{$invoice_issued_id}' AND service_category.supplement_yn = 0
					GROUP BY tax_rate_id";

  $connectionDB->DbConnection->BeginTrans();
  $connectionDB->DbConnection->execute($sql);

  $sql = "UPDATE invoice_issued
  						LEFT JOIN
                  	(SELECT invoice_issued_id, SUM(line_item.total_amt) AS other_income_amt
										 FROM line_item
     									  INNER JOIN service ON line_item.service_id = service.service_id
     									  INNER JOIN service_category ON service.service_category_id = service_category.service_category_id
										 WHERE line_item.invoice_issued_id = '{$invoice_issued_id}' AND service_category.supplement_yn = 1
                     GROUP BY line_item.invoice_issued_id) AS supplement
                  ON invoice_issued.invoice_issued_id = supplement.invoice_issued_id
                  LEFT JOIN
                  	(SELECT SUM(base_amt) AS base_amt, SUM(tax_amt) AS tax_amt, invoice_issued_id
										 FROM invoice_issued_tax
										 WHERE invoice_issued_tax.invoice_issued_id = '{$invoice_issued_id}'
                     GROUP BY invoice_issued_id) AS invoice_issued_tax
                  ON invoice_issued.invoice_issued_id = invoice_issued_tax.invoice_issued_id
                  LEFT JOIN
                  	(SELECT SUM(paid_amt) AS paid_amt, MAX(paid_dt) AS paid_dt, invoice_issued_id
										FROM invoice_issued_paid
										WHERE invoice_issued_paid.invoice_issued_id = '{$invoice_issued_id}'
                    GROUP BY invoice_issued_id) AS invoice_issued_paid
                  ON invoice_issued.invoice_issued_id = invoice_issued_paid.invoice_issued_id
					SET invoice_issued.subtotal_amt = IFNULL(invoice_issued_tax.base_amt, 0),
                  invoice_issued.tax_amt = IFNULL(invoice_issued_tax.tax_amt, 0),
									invoice_issued.other_income_amt = IFNULL(supplement.other_income_amt, 0),
                  invoice_issued.total_amt = IFNULL(invoice_issued_tax.base_amt, 0) +
                  													 IFNULL(invoice_issued_tax.tax_amt, 0) +
                                             IFNULL(supplement.other_income_amt, 0),
						  		invoice_issued.paid_dt = CASE IFNULL(invoice_issued_paid.paid_amt, 0) WHEN 0 THEN null ELSE invoice_issued_paid.paid_dt END,
              		invoice_issued.paid_yn = CASE WHEN invoice_issued_paid.paid_amt >= invoice_issued.total_amt THEN 1 ELSE 0 END,
              		invoice_issued.paid_amt = invoice_issued_paid.paid_amt
              WHERE invoice_issued.invoice_issued_id = '{$invoice_issued_id}'";

  $connectionDB->DbConnection->execute($sql);
  $connectionDB->DbConnection->CompleteTrans();

  if ($invoice_issued_id) sw_create_PDF_invoice($invoice_issued_id, true);
}


function sw_create_email_template_unpaid($directory, $company_id, $file = '', $error_view_email = false)
{
  Global $trigger_file_directory_cd, $email_to_cd_template;

  $link = "http://" . $_SERVER['SERVER_NAME'] . str_replace('..','',$directory) . $file;
	$error = "";

  $directory = explode('/', $directory);
  array_pop($directory);
  foreach ($directory as $value){
    if ($dir = array_search($value, $trigger_file_directory_cd)){
    	$directory_cd = $dir;
    }
  }

  //Locate Email template - trigger_type_cd, trigger_file_directory_cd, to_client_yn = 1
  $email_template_id = 0;
  $where = "(trigger_type_cd = 'UPL') AND
            (trigger_file_directory_cd = '{$directory_cd}')";
  $trigger_file_keyword = sw_records_array("SELECT * FROM email_template WHERE {$where}", array('email_template_id', 'trigger_file_keyword'));

  //Locate the mail template with the file name
  foreach ($trigger_file_keyword AS $key => $value){
  	if (count($trigger_file_keyword) === 1 && $value == "" && $key !== 0 ){
	 	   $email_template_id = $key;
  	}
    else {
    	$keyword = explode(",", $value);
    	foreach ($keyword AS $value){
    		if (strpos($file, trim(strtolower($value))) !== False){
	    	$email_template_id = $key;
      	break;
      	}
    	}
    }
    if ($email_template_id) break;
  }

  //Created email draft with template
  if ($record_template = sw_get_data_table("email_template", "email_template_id = '{$email_template_id}'"))
  {
    $posFiles = strpos($record_template['body'], '{FILES}');

    //search email contact
    $email_cd = $email_to_cd_template[$record_template['email_to_cd']];
    $sql = "SELECT contact.* FROM company INNER JOIN contact ON company.contact_list_id = contact.contact_list_id
            WHERE (company.company_id = {$company_id}) AND (contact.{$email_cd} = true) AND (LENGTH(TRIM(email)) != 0)";
    $record_contact = sw_records_array($sql, array('contact_id', 'email', 'first_name'));
    $error = sw_created_email_draft($company_id, $record_template, $record_contact, $link, $file, $error_view_email);
  }
	return $error;
}


// Asignar notes en company details
function sw_add_note_company($company_id, $message)
{
	Global $connectionDB;

	$note = "<strong>Auto " . date('Y-m-d') . " ({$_SESSION['username']}):</strong> {$message} <br/><br/>";

	$sql = "UPDATE company
					SET notes_me = CONCAT('{$note}', ' ', notes_me)
					WHERE company_id = {$company_id}";

	$connectionDB->Connected();
	$connectionDB->DbConnection->execute($sql);
}

?>
