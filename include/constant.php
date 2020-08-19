<?php
/*
   Constantes utilizadas en TEMPO

   Se definen todas las constantes utilizadas en TEMPO

*/

Global $language;

define(SW_HEADER_HTML,
           "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
            <script type='text/javascript' src='include/strongweber.js?id=2'></script>
    				<link rel='icon' type='image/icon' href='favicon.ico'/>
            <link href='include/tinybox.css' rel='stylesheet' type='text/css' />
            <link href='css/sa_style.css' rel='stylesheet' type='text/css' />
            <script type='text/javascript' src='include/tinybox.js'></script>");

define(SW_HEADER_MEMO_HTML,
           "<script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
            <script type='text/javascript'>
            tinyMCE.init({
                // General options
                forced_root_block : false,
                convert_urls : false,
                relative_urls : false,
                remove_script_host : false,
                mode : 'textareas',
                language : '" . $language . "',
                theme : 'advanced',
                plugins : 'autolink,style,layer,table,save,advhr,inlinepopups,searchreplace,print,paste,noneditable,nonbreaking,xhtmlxtras,template',

                // Theme options
                theme_advanced_buttons1 : 'save,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,search,replace,|,bullist,numlist,|,outdent,indent,|forecolor,backcolor,link,unlink,print',
                theme_advanced_toolbar_location : 'top',
                theme_advanced_toolbar_align : 'left',
                theme_advanced_statusbar_location : 'none',
                theme_advanced_resizing : false,

                // Skin options
                skin : 'o2k7',
                skin_variant : 'silver',

                save_enablewhendirty: true,
    						save_onsavecallback: function() { ButtonSaveMemo(); },

                // Example content CSS (should be your site CSS)
                //content_css : 'css/example.css',

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

            </script>");

define('SW_HEADER_MEMO_HTML_READONLY',
           "<meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
            <script type='text/javascript' src='include/tinymce/tiny_mce.js'></script>
            <script type='text/javascript'>
            tinyMCE.init({
                // General options
                readonly : 1,
                mode : 'textareas',
                language : '{$language}',

                // Replace values for the template plugin
                template_replace_values : {
                  username : 'Some User',
                  staffid : '991234'
                }
            });
            </script>");

?>