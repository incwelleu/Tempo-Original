<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/functions.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");

session_start();

//Class definition
class email_edit extends Page
{
    public $from_email = null;
   public $lbSubject = null;
   public $subject = null;
   public $lbTemplate = null;
   public $lbCc = null;
   public $cc_email = null;
   public $body = null;
   public $to_email = null;
   public $lbTo_email = null;
   public $SiteTheme = null;
   public $lbFrom_email = null;
   public $sqlEmail_template = null;
   public $dsEmail_template = null;
    public $email_template_id = null;
    public $sqlEmail = null;
    public $dsEmail = null;
    public $btnCloseEmailEdit = null;
    public $btnSaveEmailEdit = null;


    function email_editCreate($sender, $params)
    {
      sw_style_selected($this);
    }


    function email_editShow($sender, $params)
    {
      $this->ParameterEmailEdit();

    }


    function ParameterEmailEdit()
    {
      Global $email_from_template, $email_draft;

      $records = sw_records_array($this->sqlEmail_template->SQL, array('email_template_id','subject'));
      $records[0] = '';
      $this->email_template_id->Items = $records;

      $email_id = $email_draft->email_id->value;
      $record_email = sw_get_data_table("email", "email_id = {$email_id}");
	  $settings = sw_setting_company($record_email['to_company_id']);

      $this->email_template_id->ItemIndex = $record_email['email_template_id'];
      $this->from_email->Text = $email_from_template[$record_email['from_email']] . " (" . $settings[$record_email['from_email']] . ")";
      $this->to_email->Text = $record_email['to_email'];
      $this->cc_email->Text = $record_email['cc_email'];
      $this->subject->Text = $record_email['subject'];
      $this->body->Text = $record_email['body'];
      $this->email_template_id->Enabled = ($this->email_template_id->ItemIndex == 0);
    }

    function email_editShowHeader($sender, $params)
   {
      Global $language;
      echo "<script type='text/javascript' src='include/strongweber.js'></script>
            <link href='include/tinybox.css' rel='stylesheet' type='text/css' />
            <script type='text/javascript' src='include/tinybox.js'></script>";

      echo "<script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
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
                theme_advanced_buttons1 : 'newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect',
                theme_advanced_buttons2 : 'search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
                theme_advanced_buttons3 : 'tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen',
                theme_advanced_buttons4 : 'insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage',

                theme_advanced_toolbar_location : 'top',
                theme_advanced_toolbar_align : 'left',
                theme_advanced_statusbar_location : 'none',
                theme_advanced_resizing : false,

                // Skin options
                skin : 'o2k7',
                skin_variant : 'silver',

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

            </script> ";
   }

   //Save email
    function btnSaveEmailEditClick($sender, $params)
    {
      Global $email_draft;
      $where = "email_id = " . $email_draft->email_id->value;
      sw_update_table("email", $_POST, $where);

        ?>
           <script type="text/javascript">
            gridEmail.Refresh();
           </script>
        <?php
    }

    function btnCloseEmailEditClick($sender, $params)
    {
         //Close window
    }

    function email_template_idChange($sender, $params)
    {
      $where = "email_template_id = " . $this->email_template_id->ItemIndex;
      if ($record = sw_get_data_table('email_template', $where, "subject, body")){
        $this->body->Text = $record['body'];
        $this->subject->Text = $record['subject'];
      }
    }

    function email_template_idJSChange($sender, $params)
    {
      Global $lbChangeEmailTemplateMsg;
        ?>
        //begin js
        return confirm("<?php echo $lbChangeEmailTemplateMsg ?>");
        //end
        <?php
    }

}

global $application;

global $email_edit;

//Creates the form
$email_edit = new email_edit($application);

//Read from resource file
$email_edit->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
$email_edit->show();

?>