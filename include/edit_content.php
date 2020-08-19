<?php
  session_start();

  Global $language;
	$tinyMCE_content_edit = $_SESSION['tinyMCE_content_edit'];
  ?>
<html>
  <head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <script type="text/javascript" src="include/tiny_mce/tiny_mce.js"></script>
    <script type="text/javascript">
      tinyMCE.init({
        // General options
        forced_root_block : false,
        convert_urls : false,
        relative_urls : false,
        remove_script_host : false,
        mode : "textareas",
        language : "<?php echo $language; ?>",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        //content_css : 'css/example.css',

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
      });
    </script>
  </head>
  <body>
        <p>
        <textarea style="width: 100%; height: 80%" name="tinyMCE_content_edit">
          <?php
              echo htmlentities($tinyMCE_content_edit);
            ?>
        </textarea>
        </p>
        <div align="right">
          <input style="font-family: Tahoma; font-size: 11px; color: black; width: 75px; height: 25px" type="submit" name="BtnSaveContent_edit" value="Save" />
          <input style="font-family: Tahoma; font-size: 11px; color: black; margin-right: 10px; width: 75px; height: 25px" type="submit" name="BtnCloseContent_edit" value="Close" />
        </div>
  </body>
</html>
