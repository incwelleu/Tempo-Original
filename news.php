<?php
  Global $connectionDB;

  $sql = "SELECT * FROM vw_directory_help WHERE directory_name = 'news'";
  $query = new query();
  $query->Database = $connectionDB->DbConnection;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->Params = "";
  $query->SQL = $sql;
  $query->open();

  $directory_id = 0;
  if (!$query->EOF) $directory_id = $query->Fields['directory_id'];

  $sql = "SELECT help_content.*, directory_name, help_category.category_name,
          creation_user.username As user_create, modified_user.username As user_modified
          FROM help_content
            INNER JOIN vw_directory_help ON help_content.directory_id = vw_directory_help.directory_id
            LEFT JOIN user AS creation_user ON help_content.created_by_user_id = creation_user.user_id
            LEFT JOIN user AS modified_user ON help_content.last_mod_user_id = modified_user.user_id
            LEFT JOIN help_category ON help_content.help_category_id = help_category.help_category_id
          WHERE help_content.directory_id = " . $directory_id . " ORDER BY help_category_id, help_content.sort_no ";
  $query->Close();
  $query->SQL = $sql;
  $query->LimitStart = -1;
  $query->LimitCount = -1;
  $query->Prepare();
  $query->Open();

  $html = "";
  While (!$query->EOF)
  {
    $title = $query->Fields['directory_name'];
    $html .= "<p>" . $query->Fields['answer'] . "</p></br>";
    $query->next();
  }

?>
<html>
  <head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
  </head>
  <body>
      <div class="jtbb jtdivwindowtitlebar jtdivwindowtitlebar_bsSingle">
        <div style="margin: 5px; font-size: 12px; font-weight: bold;" class="jtbb jtfont jtdivwindowcaption"><?php echo $title; ?></div>
        <div style="margin-left: 5px; margin-top: 10px; align=left; font-family: Tahoma; font-size: 11px; color: black;"><?php echo $html; ?></div>
      </div>
  </body>
</html>
