<?php
require_once("../include/configure.php");
require_once("../include/dbconnection.php");

Global $VirtualFile, $Directory_client_ftp_server, $connectionDB;

$sql = "SELECT DISTINCT company.short_name
        FROM company
             INNER JOIN user ON company.user_id = user.user_id AND user.status_cd = 'a'";
$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}

While ($query = mysql_fetch_array($result)){
  $dir_cliente = "../{$VirtualFile}" . TMP_CLIENT_FTP_SERVER . "/{$query['short_name']}";
  if (file_exists($dir_cliente)) {
    foreach ($Directory_client_ftp_server as $dir) {
      $dir = $dir_cliente . "/" . $dir;

      if (!file_exists($dir)){
         mkdir($dir, 0777, true);
         echo $dir . "\n";
      }
    }
  }
}

echo "Fin!!!";
?>