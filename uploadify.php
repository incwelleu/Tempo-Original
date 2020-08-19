<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

$session_name = session_name();

if ((!isset($_POST['DirUploadFTP'])) || (!isset($_POST[$session_name]))) {
    exit;
} else {
    session_id($_POST[$session_name]);
    session_start();
}

require_once("include/functions.php");
require_once("include/acceso.php");
require_once("include/language.php");

$downloadDir = "tmp/";

if ($_POST['ActionUpload'] == 'ftp_upload')
  put_files($_POST['DirUploadFTP'], $error);
else if ($_POST['ActionUpload'] == 'upload_accounting')
  upload_accounting($_POST['DirUploadFTP'], $error);
else if ($_POST['ActionUpload'] == 'upload_employee')
  upload_employee($_POST['DirUploadFTP'], $error);

function put_files($currentDir, &$error){

	Global $error_view_email;

  $fileObject = $_FILES['files'];
  $date = date("Y-m-d H:i:s");
  $email_draft = true;

  $filename = sw_clean_characters_spanish($fileObject['name']);
  $filename = strtolower(filePart(StripSlashes($filename)));
  $tempFileName = $fileObject['tmp_name'];

  if (!file_exists($currentDir)){
  	mkdir($currentDir, 0777, true);
	}

  if (!move_uploaded_file($tempFileName, $currentDir .  $filename)){
     $error = $lblFileErrorMoveFileUploaded;
  }
  else {
    if (!sw_register_file($currentDir, $filename, $date, $email_draft)){
       unlink($currentDir . "/" . $filename);
    }
	}
}


function upload_accounting($currentDir, &$error){

  Global $lblFileCouldNotBeUploaded;

  $fileObject = $_FILES['files'];
  $date = date("Y-m-d H:i:s");

  $fileupload = sw_clean_characters_spanish($fileObject['name']);
  $fileupload = strtolower(filePart(StripSlashes($fileupload)));

  $tempFileName = $fileObject['tmp_name'];
  if (!sw_upload_accounting($tempFileName, $currentDir, $fileupload, $_POST['year_data'], $_POST['month_data'])){
    echo "<B>" . $lblFileCouldNotBeUploaded . "</B></br>";
	}
}


function upload_employee($currentDir, &$error){

  Global $lblFileCouldNotBeUploaded;

  $fileObject = $_FILES['files'];
  $date = date("Y-m-d H:i:s");

  $fileupload = sw_clean_characters_spanish($fileObject['name']);
  $fileupload = strtolower(filePart(StripSlashes($fileupload)));

  $tempFileName = $fileObject['tmp_name'];
  if (!sw_upload_employee($tempFileName, $currentDir, $fileupload)){
    echo "<B>" . $lblFileCouldNotBeUploaded . "</B></br>";
  }


}
?>