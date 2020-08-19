<?php

  if (!class_exists('acceso')) {
    include("include/functions.php");
    include("include/acceso.php");
    include("include/language.php");
  }

  $directory_id = $_REQUEST['directory_id'] ? $_REQUEST['directory_id'] : 0;
  $nodo_id      = $_REQUEST['nodo_id'] ? $_REQUEST['nodo_id'] : 0;

  //Update Answer
  if (isset($_POST['BtnSaveContent_edit'])){
    $where = "help_content_id = " . $_POST['ID'];
    $record['answer'] = $_POST['tinyMCE_content_edit'];
    $record['last_mod_user_id'] = $_SESSION['user_id'];
    $record['last_mod_dt'] = date('Y-m-d H:i:s');
    sw_update_table("help_content", $record, $where);
  }

  Global $connectionDB, $language, $lblHelp, $lblNoHelp, $lblSearchFile;

  if ($directory_id){
    $sql = "SELECT help_content.*, directory_name AS title, help_category.category_name,
              creation_user.username As user_create, modified_user.username As user_modified
            FROM help_content
              INNER JOIN vw_directory_help ON help_content.directory_id = vw_directory_help.directory_id
              LEFT JOIN user AS creation_user ON help_content.created_by_user_id = creation_user.user_id
              LEFT JOIN user AS modified_user ON help_content.last_mod_user_id = modified_user.user_id
              LEFT JOIN help_category ON help_content.help_category_id = help_category.help_category_id " .
            ( (!$_POST['search_string']) ? "WHERE help_content.directory_id = '{$directory_id}'" : "");
  }
  else if ($nodo_id){
    $sql = "SELECT help_content.*, application_form AS title, help_category.category_name,
              creation_user.username As user_create, modified_user.username As user_modified
            FROM help_content
              INNER JOIN vw_application_form ON help_content.nodo_id = vw_application_form.nodo_id
              LEFT JOIN user AS creation_user ON help_content.created_by_user_id = creation_user.user_id
              LEFT JOIN user AS modified_user ON help_content.last_mod_user_id = modified_user.user_id
              LEFT JOIN help_category ON help_content.help_category_id = help_category.help_category_id " .
            (!$_POST['imageField'] ? "WHERE help_content.nodo_id = '{$nodo_id}'" : "");
  }

  if ($sql){

    $sql .= $_POST['search_string'] ? " WHERE ((help_content.question LIKE '%{$_POST['search_string']}%') OR (help_content.answer LIKE '%{$_POST['search_string']}%'))" : "";
    $sql .= $directory_id ? " ORDER BY clients_can_see_yn desc, help_category_id, help_content.sort_no" : " ORDER BY help_content.nodo_id, help_content.sort_no";

    $query = New Query();
    $query->Database = $connectionDB->DbConnection;
    $query->SQL = $sql;
    $query->LimitStart = -1;
    $query->LimitCount = -1;
    $query->Prepare();
    $query->Open();

    $htmlQuestion = "";
    $htmlAnswer = "";
    $htmlTop = "<A HREF='#top'><img src='images/toparrow.gif'></A><br/>";
    $help_category_id = 0;
    $clients_can_see_yn = 0;
    $title = $query->EOF ? $lblNoHelp . ($_POST['search_string'] ? ": {$_POST['search_string']}" : "") : "";
    While (!$query->EOF)
    {
      if ($query->Fields['clients_can_see_yn'] || $_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']) {
        $title = $_POST['search_string'] ? "{$lblSearchFile}: {$_POST['search_string']}" : $query->Fields['title'] . ": {$lblHelp}";

        $htmlCreateQuestion = "";
        if ($_SESSION['IsSuperadmin']) {
          $htmlCreateQuestion = "<sup>Created by " . $query->Fields['user_create'] . " on " .
                              $query->Fields['created_dt'] . ", last mod by " .
                              $query->Fields['user_modified'] . " on " .
                              $query->Fields['last_mod_dt'];
          $htmlCreateQuestion .= $_SESSION['IsSuperadmin'] ? " <button title='" . btnEdit ."' type='submit' name='imageField' value='{$query->Fields['help_content_id']}' style='padding: 0px 0px;border: none; cursor: pointer;width: 16px;height: 16px;'><img src='images/button/edit_16x16.png' height='16px' width='16px'/></button>" : "";

          $htmlCreateQuestion .= "<br/></sup>";
        }

        if (($help_category_id != $query->Fields['help_category_id']) && ($query->Fields['clients_can_see_yn'])){
          $help_category_id = $query->Fields['help_category_id'];
          $htmlQuestion .= "<h3>" . $query->Fields['category_name'] . "</h3>";
        }

        if ((!$query->Fields['clients_can_see_yn']) && !$clients_can_see_yn){
          $clients_can_see_yn = 1;

          //Solo muestro la etiqueta si es ayuda de los serviciod
          $htmlQuestion .= $directory_id ? "<h3>Invisible to client</h3>" : "";
        }

        $htmlQuestion .= "<img src='images/rightarrow.gif'><A HREF='#answer" . $query->Fields['help_content_id'] . "'>" . $query->Fields['question'] . "</A><br/>";
        $htmlAnswer .= "<br/><A NAME='" . $query->Fields['help_content_id'] . "'><p Id='answer{$query->Fields['help_content_id']}'><h4><span class='question' style='color: #3366ff;'>" . $query->Fields['question'] . "<br/></span>" . $htmlCreateQuestion . "</h4></p>";
        if (isset($_POST['imageField']) && ($_POST['imageField']===$query->Fields['help_content_id'])){
          $htmlAnswer .= "<textarea Id='{$query->Fields['help_content_id']}' style='width: 100%; height: 100%' name='tinyMCE_content_edit'>" .
                       $query->Fields['answer'] .
                       "</textarea></p>
                       <p align='right'>
                       <input type='hidden' name='ID' value='{$query->Fields['help_content_id']}'>
                       <input style='font-family: Tahoma; font-size: 11px; color: black; width: 75px; height: 25px' type='submit' name='BtnSaveContent_edit' value='" . btnSave . "' />
                       <input style='font-family: Tahoma; font-size: 11px; color: black; margin-right: 10px; width: 75px; height: 25px' type='submit' name='BtnCloseContent_edit' value='" . btnCancel . "' /></p>";
        }
        else{
          $htmlAnswer .= "<div>{$query->Fields['answer']}</div>";
        }
        $htmlAnswer .= "</A>" . $htmlTop;
      }
      $query->next();
    }
  }


  $css_style = $_SESSION['css_strong'];

?>
<html>
  <head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link href="rpcl/components4phpfull/themes/common/merged.css" rel="stylesheet" type="text/css" />
    <link href="rpcl/components4phpfull/themes/lightgrey/merged.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" type="text/javascript" src="rpcl/components4phpfull/themes/common/scripts.js"></script>
    <script language="JavaScript" type="text/javascript" src="rpcl/components4phpfull/themes/common/JTDivWindow.js"></script>
<?php
    if (isset($_POST['imageField'.$query->Fields['help_content_id']]) && $_POST['imageField'.$query->Fields['help_content_id']]){
      echo "<script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
            <script type='text/javascript'>
            tinyMCE.init({
            // General options
            forced_root_block : false,
            convert_urls : false,
            relative_urls : false,
            remove_script_host : false,
            resize: 'both',
						statusbar: true,
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
            theme_advanced_statusbar_location : 'bottom',
            theme_advanced_resizing : true,

            // Skin options
            skin : 'o2k7',
            skin_variant : 'silver',

            // Example content CSS (should be your site CSS)
            //content_css : 'css/content.css',

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
          </script>";
    }
?>
  </head>
  <body>
      <form name="help" method="post">
        <div style="margin: 5px; font-size: 15px; font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif; color: #0c6478" class="jtbb jtfont jtdivwindowcaption">
          <table>
          <tr>
            <td style="width: 60%"><?php echo $title; ?></td>
            <?php
              if ($_SESSION['IsSuperadmin']){
                echo "<td>{$lblSearchFile}: <input type='text' name='search_string' value='{$_POST['search_string']}'>
                      <input style='font-family: Tahoma; font-size: 11px; color: black; width: 75px; height: 22px' type='submit' value='{$lblSearchFile}' />
                      </td>";
              }
            ?>
          </tr>
          </table>
        </div>
        <div style="margin-left: 5px; margin-top: 10px; align=left; font-family: Tahoma; font-size: 11px; color: black;">
            <?php echo $htmlQuestion; ?>
            <?php echo $htmlAnswer; ?>
        </div>
      </form>
  </body>
</html>
