<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");
require_once("include/ziparchive.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("imglist.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtdivwindow.inc.php");
use_unit("components4phpfull/jttoolbar.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("platinumgrid/jtplatinumgrid.inc.php");

session_start();

define('COL_NAME', 1);
define('COL_SIZE', 2);
define('COL_TYPE', 3);
define('COL_DATE', 4);
define('COL_USER', 5);
define('COL_DIR', 6);

//Class definition
class ftp extends fmstrong
{
    public $lbCreateExercise = null;
    public $create_exercise = null;
    public $btnCreateExercise = null;
    public $btnCloseExercise = null;
    public $btnClose = null;
    public $btnCreate = null;
    public $DirCreate = null;
    public $winProcess = null;
    public $gridFolder = null;
    public $lbDirectory = null;
    public $directory_ftp = null;
    public $SiteTheme = null;
    public $ImageList = null;
    public $btnFTP = null;
    public $lbCreateDirectory = null;
    public $lbSearch = null;
    public $lbSearchString = null;
    public $lbReplaceString = null;
    public $search_string = null;
    public $replace_string = null;
    public $btnReplace = null;
    public $btnCloseReplace = null;

    function ftpCreate($sender, $params)
    {
      sw_style_selected($this);

      //Configure Menu
      $this->ConfigureMenu();

      //Configure Menu
      $this->ConfigureFolder();

      $this->ListFiles($_GET['dir']);
    }


    function ConfigureMenu()
    {
       Global $lblUploadFile, $lblUp, $lblCreateDirectory,
              $lblDeleteFile, $lblDownload, $lblReplaceFileName,
              $lblCreateExercise, $lblSearchFile, $lblCleanClientShortName;

      //Create Button
      $items['btnUpload'] = array($lblUploadFile, 1, "1");
      $items['btnPrevious'] = array($lblUp, 1, "2");
      $items['btnCreate'] = array($lblCreateDirectory, 1, "3");
      $items['btnDelete'] = array($lblDeleteFile, 1, "4");
      $items['btnDownload'] = array($lblDownload, 1, "5");
      $items['btnReplaceFileName'] = array($lblReplaceFileName, 1);
      $items['btnCreateExercise'] = array($lblCreateExercise, 1);

      if ($_SESSION['username'] == 'hcamargo') {
        $items['btnRename'] = array('Rename & Regenerates files', 1);
        $items['btnDropFile'] = array('Drop files', 1);
				$items['btnCleanClientShortName'] = array($lblCleanClientShortName, 1);
        $items['btnEmail'] = array('Create Email template', 1);
      }

      $this->btnFTP->Items = $items;
      $this->lbSearch->Caption = $lblSearchFile;
    }


    function ConfigureFolder()
    {
       Global $lblName, $lblSize, $lblFileType, $lblDate, $lblUploadedBy;

       $this->gridFolder->Columns[COL_NAME]->Caption = $lblName;
       $this->gridFolder->Columns[COL_SIZE]->Caption = $lblSize;
       $this->gridFolder->Columns[COL_TYPE]->Caption = $lblFileType;
       $this->gridFolder->Columns[COL_DATE]->Caption = $lblDate;
       $this->gridFolder->Columns[COL_USER]->Caption = $lblUploadedBy;
    }


    function ListFiles($dir = "")
    {
			Global $VirtualFile;

			$file = array();
			$files = array();

			if ($dir == '..') {
				$dir = "";
				$adir = explode("/", $this->directory_ftp->Value . "/");
				if (count($adir)>2) {
					array_splice($adir, count($adir)-2, 2);
					$dir = implode("/", $adir);
				}
			}
			else if ($dir == 'uploadFile') {
				$dir = TMP_CLIENT_FTP_SERVER . "/" . $_SESSION['short_name'];
				$this->GenerateLinkDir($dir);
				$this->directory_ftp->Value = $dir;
			}
			else {
				if (!$dir) $dir = $this->directory_ftp->Value;
				$dir = $dir == "root" ? "" : $dir;
			}

			$list = @scandir($VirtualFile . $dir . "/");
			if (is_array($list)) {
				$counter=0;

				$this->GenerateLinkDir($dir);

				$this->directory_ftp->Value = $dir;

				foreach($list as $item){
					$location = $VirtualFile . $dir . "/" . $item;
					$is_dir = false;
					$lacceso = (($item != ".") && ($item != ".."));

					if ($lacceso){
						if (is_dir($location)){
							$fileSize="";
							$is_dir = true;
							$fileType['description'] = 'File Folder';
							$fileType['imgfilename'] = ($item == "..") ? 'prior18x18.png' : 'folder18x18.png';
							$lacceso = strpos($VirtualFile . $dir, "upload") || strpos($location, "upload") ? false : sw_check_access_file($location, $record, $lacceso);
						}
						else if (is_link($location)){
							$fileName = $item;
							$fileSize="";
							$fileType['description'] = 'Symbolic Link';
							$fileType['imgfilename'] = 'link.gif';
						} else {
							$lacceso = strpos($VirtualFile . $dir, "/docs/") ? true : false;
							$groupFile[] = "{$location}";
						}

						if ($lacceso){
							$file['icon'] = "images/ftp/" . $fileType['imgfilename'];
							$file['name'] = utf8_decode($item);
							$file['size'] = $fileSize;
							$file['type'] = $fileType['description'];
							$file['date'] = date("Y-m-d H:i:s", filemtime($location));
							$file['username'] = "";
							$file['dir']  = $is_dir;
							$file['link'] = $is_dir ?  $_SERVER['SCRIPT_NAME'] . "?dir=" . $dir . "/" . $item : $location;
							$file['item_name'] = $item;
							array_push($files, $file);
							$counter++;
						}
					}
				}

				// Records of Virtual file
				if (count($groupFile) > 0) {
					$company_user = explode(',', $_SESSION['company_user']);
					$groupFile = str_replace("'", "\'", $groupFile);
					$links = implode("','", $groupFile);

					$sql = "SELECT DISTINCT virtual_file.nodo_id, virtual_file.description_en, virtual_file.link, virtual_file.created_dt, user.username FROM virtual_file LEFT JOIN user ON (virtual_file.created_by_user_id = user.user_id) ";
					$where = " WHERE (virtual_file.link in ('{$links}'))";
					if (!$_SESSION['IsSuperadmin']){
						$where .= " AND (virtual_file.company_id in ({$_SESSION['company_user']}))";
					}
					$sql .= $where . " ORDER BY description_en";
					$define = Array('nodo_id', 'description_en', 'link', 'created_dt', 'username');
					$recordVirtual = sw_records_array($sql, $define);

					foreach($recordVirtual as $record){
						$archivo = $record["link"];
						$name = $record["description_en"];

						$fileType = fileDescription($archivo);
						$fileSize = filesize($archivo);
						if ($fileSize <1024){
							$fileSize = number_format($fileSize, 0, ',', '.') . " bytes";
						}
						else {
							if ($fileSize<1073741824){
								$fileSize = number_format($fileSize/1024, 0, ',', '.') . " KB";
							} else {
								$fileSize = number_format($fileSize/1048576, 0, ',', '.') . " MB";
							}
						}

						$file['icon'] = "images/ftp/" . $fileType['imgfilename'];
						$file['name'] = $name;
						$file['size'] = $fileSize;
						$file['type'] = $fileType['description'];
						$file['date'] = date("Y-m-d H:i:s", filemtime($archivo));
						$file['username'] = $record['username'];
						$file['dir']  = false;
						$file['link'] = is_dir($archivo) ?  $_SERVER['SCRIPT_NAME'] . "?dir=" . $dir . "/" . $name : $archivo;
						$file['item_name'] = $name;

						array_push($files, $file);
						$counter++;
					}
				}
			}
			$this->gridFolder->CellData = $files;

			return true;
    }


    function GenerateLinkDir($dir)
    {
      Global $lblCurrentDirectory;

      $caption = $lblCurrentDirectory . ": ";
      $dir = explode("/", $dir);

      $caption .= "<A href='{$_SERVER['SCRIPT_NAME']}?dir=root'><STRONG>..</STRONG></A>";
      $directory = "";
      foreach ($dir as $value) {
        if ($value){
          $directory .= "/" . $value;
          $link = "<A href='{$_SERVER['SCRIPT_NAME']}?dir={$directory}'><STRONG>/{$value}</STRONG></A>";
          $caption .= $link;
        }
      }
      $this->lbDirectory->Caption = $caption . "<span style='padding-left: 10px;'><a href='help_program.php?nodo_id=56' target='blank'><img src='images/help.png'></a><span>";;
    }

    function gridFolderJSSelect($sender, $params)
    {
        ?>
        //begin js
          var a = getEventTarget(event);
          var cellDir = gridFolder.getCellText(row, <?php echo COL_DIR; ?>);

          if ((cellDir == "") && (a.tagName == "A") && (a.href != "")) {
            a.target = "_blank";
          }
        //end
        <?php
    }


    function btnFTPJSClick($sender, $params)
    {
      Global $lblDeleteFileMsg;
        ?>
        //begin js
          var info = getEventTarget( event ).id.split( "_" );
          var toolButton = info[ 0 ];
          var toolButtonName = info[ 1 ];
          var row = gridFolder.getSelectedPrimaryKey();

          if (toolButton == 'btnFTP'){
            if ((toolButtonName == 'btnDelete') && (row != "")) { return confirm("<?php echo $lblDeleteFileMsg ?>");}
            else if (toolButtonName == 'btnRename'){
                return confirm("Desea regenerar la tabla de archivos ftp");}
            else if ((toolButtonName == "btnDropFile") && (row != "")){
                return confirm("Desea eliminar fisicamente los archivos seleccionados");}
            else if (((toolButtonName == 'btnDelete') || (toolButtonName == 'btnDownload') ||
                      (toolButtonName == "btnDropFile") || (toolButtonName == 'btnReplaceFileName'))
                      && (row == "")) {
              return false;
            }
          }
        //end
        <?php
    }


    function btnFTPClick($sender, $params)
    {
      Global $VirtualFile, $TempDir, $lblUploadFile, $lblCreateExercise,
             $lblCreateDirectory, $lblReplaceFileName, $connectionDB;

      list( $toolButton, $toolButtonName ) = explode( '_', $params[ 0 ] );

      if ($toolButtonName == "btnUpload")
      {
        $_SESSION['DirUploadFile'] = $VirtualFile . $this->directory_ftp->Value . "/";
        $this->winProcess->ActiveLayer = 0;
        $this->winProcess->Caption = $lblUploadFile;
        $this->winProcess->Width = 600;
        $this->winProcess->height = 400;
        $this->winProcess->Include = 'ftp_upload.php';
        $this->winProcess->ShowModal();
      }
      else if ($toolButtonName == "btnPrevious")
      {
        $this->ListFiles('..');
      }
      else if ($toolButtonName == "btnCreate")
      {
        $this->winProcess->ActiveLayer = 0;
        $this->lbCreateDirectory->Caption = $lblCreateDirectory;
        $this->winProcess->Caption = $lblCreateDirectory;
        $this->winProcess->Width = 500;
        $this->winProcess->height = 120;
        $this->winProcess->Include = '';
        $this->winProcess->ShowModal();
      }
      else if ($toolButtonName == "btnDelete")
      {
        foreach ($this->gridFolder->SelectedPrimaryKeys as $file) {
          $file = html_entity_decode($VirtualFile . $this->directory_ftp->Value . "/" . $file);
          deleteFtpFile($file);
        }
        $this->ListFiles();
        $this->gridFolder->writeSelectedCells(array());
      }
      else if ($toolButtonName == "btnDownload")
      {
        $filezip = $TempDir . "/download_" . date("Ymd_His") . ".zip";
        $zip = new zipArchiveLib();

        foreach ($this->gridFolder->SelectedPrimaryKeys as $file) {
          $file =  html_entity_decode($VirtualFile . $this->directory_ftp->Value . "/" . $file);
          //set_time_limit(0);
          //sleep(60); //ts 2/11/21016 - testing for 5 minutes timeouts

				  //Get entire directory and store to temporary directory
				  sw_download_file_Zip($file, $zip);
        }

        $zip->saveZip($filezip);
        $zip->downloadZip($filezip);
        unlink($filezip);
      }
      else if ($toolButtonName == "btnReplaceFileName"){
        $this->winProcess->ActiveLayer = 1;
        $this->winProcess->Caption = $lblReplaceFileName;
        $this->search_string->Text = '';
        $this->replace_string->Text = '';
        $this->winProcess->Width = 500;
        $this->winProcess->height = 120;
        $this->winProcess->Include = '';
        $this->winProcess->ShowModal();
      }
      else if ($toolButtonName == "btnCreateExercise"){
        $this->winProcess->ActiveLayer = 2;
        $this->lbCreateExercise->Caption = $lblCreateExercise;
        $this->winProcess->Caption = $lblCreateExercise;
        $this->create_exercise->text = date('Y');
        $this->winProcess->Width = 270;
        $this->winProcess->height = 120;
        $this->winProcess->Include = '';
        $this->winProcess->ShowModal();
      }
      else if ($toolButtonName == "btnRename"){
        sw_getrfiles($VirtualFile . $this->directory_ftp->Value . "/");
      }
      else if ($toolButtonName == "btnDropFile"){
        $this->DropFile();
      }
			else if ($toolButtonName == "btnCleanClientShortName"){
			  $this->CleanClientShortName();
			}
      else if ($toolButtonName == "btnEmail"){

//					$sql = "SELECT DISTINCT virtual_file.nodo_id, virtual_file.description_en, virtual_file.link, virtual_file.created_dt FROM virtual_file " .
//					 " WHERE (description_en like '%.p12' OR description_en like '%.pfx') AND (parent_id != 89)";
//					$define = Array('nodo_id', 'description_en', 'link', 'created_dt', 'username');
//					$recordVirtual = sw_records_array($sql, $define);
//
//      $dir = dirname(__FILE__) . "/tmp";
//
//      $file_account_code = tempnam($dir, "TMP");
//      $file_not_found = tempnam($dir, "TMP");
//      $fp = fopen($file_account_code, "a+");
//      $fp_not_found = fopen($file_not_found, "a+");
//
//        foreach ($recordVirtual as $file) {
//					$file_new = $VirtualFile . "/modelos/certificados/" . $file['description_en'];
//					if (file_exists($file['link']) && !file_exists($file_new)) {
//
//            $sql = "UPDATE virtual_file
//                    SET link = '{$file_new}, parent_id = 89'
//                    WHERE nodo_id = {$file['nodo_id']}";
//
//            $connectionDB->DbConnection->BeginTrans();
//            if ($connectionDB->DbConnection->execute($sql)) {
//
//              rename($file['link'], $file_new);
//							fwrite($fp, $file['link'] . "\r\n");
//            } else {
//						  fwrite($fp_not_found, $file['link'] . " - Not Update \r\n");
//						}
//            $connectionDB->DbConnection->CompleteTrans();
//
//				  }
//					if (!file_exists($file['link'])){
//							fwrite($fp_not_found, $file['link'] . "\r\n");
//					}
//        }
//
//      fclose($fp);
//			fclose($fp_not_found);

//        Create email template
//        foreach ($this->gridFolder->SelectedPrimaryKeys as $file) {
//          $directory = $VirtualFile . $this->directory_ftp->Value . "/";
//
//          $company = sw_search_company($directory, $file);
//          sw_create_email_template("UPL", $directory, $company['company_id'], $file);
//        }
      }
    }


    function DropFile()
    {
      Global $connectionDB;

      $sql = "SELECT link
              FROM virtual_file
                INNER JOIN company on virtual_file.company_id = company.company_id
                LEFT JOIN user ON company.user_id = user.user_id
              WHERE user.user_id is null";
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      While (!$query->EOF)
      {
        $this->deleteFile($query->Fields['link']);
        $query->next();
      }
    }


    function CleanClientShortName()
    {
      Global $VirtualFile, $connectionDB;

      $sql = "SELECT * FROM virtual_file
											INNER JOIN company ON virtual_file.company_id = company.company_id
						  WHERE virtual_file.link LIKE '%{$VirtualFile}" . TMP_CLIENT_FTP_SERVER . "/%' AND NOT virtual_file.link LIKE CONCAT('%" . TMP_CLIENT_FTP_SERVER . "/',company.short_name,'/%')
							ORDER BY company.company_id";

      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      While (!$query->EOF)
      {
				$filenameOld = $query->Fields['link'];
				$filenameNew = $VirtualFile . TMP_CLIENT_FTP_SERVER . "/" . $query->Fields['short_name'] . "/" . $query->Fields['description_en'];

      	if (rename($filenameOld, $filenameNew)){
        	Global $connectionDB;

      		$sql = "UPDATE virtual_file
      					SET link = REPLACE(link, '{$filenameOld}', '{$filenameNew}')
		          	WHERE link = '{$filenameOld}'";

        	$connectionDB->DbConnection->BeginTrans();
        	$connectionDB->DbConnection->execute($sql);
        	$connectionDB->DbConnection->CompleteTrans();
      	}
        $query->next();
      }

      $dir = dirname(__FILE__) . "/tmp";

      $dir_empty = tempnam($dir, "TMP");
      $dir_not_empty = tempnam($dir, "TMP");
      $fp_empty = fopen($dir_empty, "a+");
      $fp_not_empty = fopen($dir_not_empty, "a+");

			$dir = $VirtualFile . TMP_CLIENT_FTP_SERVER;
			$list = @scandir($VirtualFile . TMP_CLIENT_FTP_SERVER);

			if (is_array($list)) {
				foreach($list as $item){
					$location = $dir . "/" . $item;
					if (($item != ".") && ($item != "..")){
						$record = sw_get_data_table("company", "company.short_name = '{$item}'");
						$recordFtp = sw_get_data_table("company, virtual_file", "company.company_id = virtual_file.company_id AND company.short_name = '{$item}'");
						if (!$record && !$recordFtp && $this->deleteEmptyFolder($location)){
							fwrite($fp_empty, $location . "\r\n");
							deleteRecursive($location);
            } else {
						  fwrite($fp_not_empty, $location . " - Do not delete \r\n");
						}
					}
				}
			}

      fclose($fp_empty);
			fclose($fp_not_empty);

    }


    function btnCreateClick($sender, $params)
    {
      Global $VirtualFile, $lblFileErrorDirExists;

      $dir = trim($VirtualFile . $this->directory_ftp->Value . "/" . $this->DirCreate->Text);
      if (!file_exists($dir)){
        mkdir($dir, 0777, true);
        $this->winProcess->Hide();
        $this->ListFiles();
        $this->DirCreate->Text = '';
      }
      else {
        $this->msgError->Value = $lblFileErrorDirExists;
      }
    }


	  function deleteEmptyFolder($dir)
    {
			$list = @scandir($dir);
			$empty = true;
			if (is_array($list)) {
      	foreach($list as $item){
        	$location = $dir . "/" . $item;
          if (($item != ".") && ($item != "..")){
          	if (is_dir($location)){
				    	$empty = $this->deleteEmptyFolder($location);
            } else {
							$empty = false;
							break;
						}
			  	}
		    }
      }
			return $empty;
	  }


    function gridFolderUpdate($sender, $params)
    {
      Global $VirtualFile;

      $fields = &$params[ 1 ];

      $item_name = htmlspecialchars_decode($params[ 0 ]);
      $fields['name'] = trim(htmlspecialchars_decode($fields['name']));
      $file_old = $VirtualFile . $this->directory_ftp->Value . "/" . $item_name;
      $file_new = $VirtualFile . $this->directory_ftp->Value . "/" . $fields['name'];

      if (!is_dir($file_old)){
        $sql = "UPDATE virtual_file
                SET link = REPLACE(link, '{$file_old}', '{$file_new}'),
                    description_en = REPLACE(description_en, '{$item_name}', '{$fields['name']}')
                WHERE link = '{$file_old}'";
      }else {
        $sql = "UPDATE virtual_file
                SET link = REPLACE(link, '{$file_old}', '{$file_new}')
		            WHERE link like '{$file_old}%'";
      }

      if (rename($file_old, $file_new)){
        Global $connectionDB;

        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();

        $this->ListFiles();
      }
    }


    function ftpShow($sender, $params)
    {
      if (isset($_POST['btnClose']) ||
          isset($_POST['btnCloseUpload']) ||
          isset($_POST['btnCloseReplace']) ||
          isset($_POST['btnCloseExercise'])){
        $this->DirCreate->Text = '';
        $this->winProcess->Hide();
        if (isset($_POST['btnCloseUpload'])) redirect_url('email_draft.php?email_type=draft');
      }
    }

    function ftpJSLoad($sender, $params)
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

    function btnReplaceClick($sender, $params)
    {
      $search = $this->search_string->text;
      $replace = $this->replace_string->Text;
      if ($search && $replace){
        foreach ($this->gridFolder->SelectedPrimaryKeys as $filename) {
				  $filename = html_entity_decode($filename);
          if (strpos($filename, $search) !== False){
            Global $VirtualFile, $connectionDB;

            $file = $VirtualFile . $this->directory_ftp->Value . "/" . $filename;
						$filename_new = str_replace($search, $replace, $filename);
            $file_new = $VirtualFile . $this->directory_ftp->Value . "/" . $filename_new;

            $sql = "UPDATE virtual_file
            				SET link = '{$file_new}',
                    		description_en = '{$filename_new}'
                    WHERE description_en = '{$filename}' AND link = '{$file}' ";
						if (rename($file, $file_new)){
            	$connectionDB->DbConnection->BeginTrans();
							$connectionDB->DbConnection->execute($sql);
            	$connectionDB->DbConnection->CompleteTrans();
						}
          }
        }

        $this->gridFolder->writeSelectedCells(array());
        $this->ListFiles();
        $this->winProcess->Hide();
      }
    }

    function btnCreateExerciseClick($sender, $params)
    {
      Global $connectionDB, $VirtualFile;

      $year = trim($this->create_exercise->Text);
      $sql = "SELECT parent.nodo_id, parent.directory, min(sort) as sort
              FROM virtual_file
                    INNER JOIN (SELECT nodo_id, folder as directory FROM virtual_file WHERE (company_id = 0 AND exercise = 1)) as parent
                    ON virtual_file.parent_id = parent.nodo_id
							WHERE link IS NULL
              GROUP BY parent.nodo_id, parent.directory";

      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      While (!$query->EOF)
      {
        if ( strpos($query->Fields['directory'],'$month') !== False){
          for ($i = 1; $i <= 12; $i++) {
            $directory = $VirtualFile . "/" . $query->Fields['directory'];
            $month = sprintf("%02d", $i) . substr($year, 2, 2);
            eval("\$directory = \"$directory\";");
            if (!file_exists($directory)) mkdir($directory, 0777, true);
          }
        }else {
            $directory = $VirtualFile . "/" . $query->Fields['directory'];
            eval("\$directory = \"$directory\";");
            if (!file_exists("{$directory}")) mkdir("{$directory}", 0777, true);
        }

        $directory = $query->Fields['directory'];
        $search = array('/$month','$year');
        $replace = array('',$year);
        $directory = str_replace($search, $replace, $directory);
        if (!$record = sw_get_data_table("virtual_file","(description_en = '{$year}') AND (folder = '{$directory}') AND (parent_id = {$query->Fields['nodo_id']})")) {
          $record['parent_id'] = $query->Fields['nodo_id'];
          $record['description_en'] = $year;
          $record['folder']    = $directory;
          $record['sort']      = $query->Fields['sort']-1;
          sw_insert_table("virtual_file", $record);
        }

        $query->next();
      }
      $this->winProcess->Hide();
    }

}

global $application;

global $ftp;

//Creates the form
$ftp=new ftp($application);

//Read from resource file
$ftp->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $ftp->show();

?>