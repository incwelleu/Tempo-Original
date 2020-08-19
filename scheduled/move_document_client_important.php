<?php
require_once("../include/configure.php");
require_once("../include/dbconnection.php");

Global $VirtualFile, $Directory_client_ftp_server, $connectionDB;

$sql = "SELECT virtual_file.nodo_id, virtual_file.company_id, virtual_file.link,
               replace(virtual_file.link, '/importante/', '/') as new_link, company.short_name
        FROM virtual_file INNER JOIN company ON virtual_file.company_id = company.company_id
        WHERE virtual_file.link LIKE '%" . TMP_CLIENT_FTP_SERVER . "%' AND virtual_file.link LIKE '%importante%'";

$result = mysql_query($sql, $connectionDB);
if (!$result) {
   die('Invalid query in email: ' . mysql_error($connectionDB));
}

While ($query = mysql_fetch_array($result)){
  $link = "../{$query['link']}";
  $link_new = "../{$query['new_link']}";

  $update_sql = "Update virtual_file
                 SET virtual_file.link = '{$query['new_link']}'
                 WHERE nodo_id = {$query['nodo_id']} ";
  if(mysql_query($update_sql, $connectionDB)){
    if (file_exists($link) && !file_exists($link_new)) {
      echo $link . " " . $link_new . "\n";
      rename($link, $link_new);
    }
  }

  $dir = "../{$VirtualFile}" . TMP_CLIENT_FTP_SERVER . "/{$query['short_name']}/importante";
  $list = @scandir($dir);
  if (count($list) < 3){
    rmdir($dir);
    echo "delete {$dir} \n";
  }
}

echo "Fin!!!";
?>