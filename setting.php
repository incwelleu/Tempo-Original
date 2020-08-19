<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/fmstrong.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("db.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtlabel.inc.php");
use_unit("components4phpfull/jtpagecontrol.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("components4phpfull/jtlookupcombobox.inc.php");
use_unit("components4phpfull/jtpanel.inc.php");

//Class definition
class fmSetting extends fmstrong
{
    public $serie_credit_note = null;
    public $sqlPayment_method = null;
    public $dsPayment_method = null;
    public $cbBilling_entity = null;
    public $lbBilling_entity = null;
    public $se_personal_tax_email = null;
    public $lbse_personal_tax_email_error = null;
    public $lbVirtualOffice_email = null;
    public $se_virtual_office_email = null;
    public $lbse_virtual_office_email_error = null;
    public $lbBilling_email = null;
    public $se_billing_email = null;
    public $lbse_billing_email_error = null;
    public $sa_accept_message_service_agreement = null;
    public $lbAccounting_email = null;
    public $lbse_accounting_email_error = null;
    public $se_accounting_email = null;
    public $lbAccept_message_service_agreement = null;
    public $lbHR_email = null;
    public $gbEmail_from_notify = null;
    public $dsSetting = null;
    public $sqlSetting = null;
    public $sa_LOPD = null;
    public $lbBank_details = null;
    public $pcSetting = null;
    public $sa_bank_details = null;
    public $SiteTheme = null;
    public $lbLOPD = null;
    public $se_hr_email = null;
    public $lbse_hr_email_error = null;
    public $lbStandardEmail_foot = null;
    public $se_standard_email_foot = null;
    public $sqlBilling_entity = null;
    public $dsBilling_entity = null;
    public $pnBilling_entity = null;
    public $JTLabel1 = null;
    public $sqlCompany = null;
    public $dsCompany = null;
    public $company_id = null;
    public $btnSaveSetting = null;
    public $lbDirProposal = null;
    public $JTAdvancedEdit1 = null;
    public $lbPayment_method = null;
    public $payment_method_id = null;
    public $lbSerie = null;

    function fmSettingCreate($sender, $params)
    {
      sw_style_selected($this);

      $this->lbTitle->Caption = Title_Setting;
      $this->lbTitle->Visible = True;

			$sql = "Select * from billing_entity ";
			$this->cbBilling_entity->Items = sw_records_array($sql, array('billing_entity_id', 'billing_entity_name'));

			$this->pcSetting->ActiveLayer = 'TabStandardEmail';
			$this->cbBilling_entityChange($sender, $params);
    }



    function fmSettingShowHeader($sender, $params)
    {
      Global $language;
      echo "<meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
            <script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
            <script type='text/javascript'>
              tinyMCE.init({
                // General options
                forced_root_block : false,
                convert_urls : false,
                relative_urls : false,
                remove_script_host : false,
                mode : 'textareas',
                language : '{$language}',
                theme : 'advanced',
                plugins : 'autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,searchreplace,print,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template',

                // Theme options
                theme_advanced_buttons1 : 'newdocument,save,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect',
                theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor',
                theme_advanced_toolbar_location : 'top',
                theme_advanced_toolbar_align : 'left',
                theme_advanced_statusbar_location : 'bottom',
                theme_advanced_resizing : true,

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
            </script>";

      //Button Save of Notes
      echo "<script type='text/javascript'>
							function ButtonSaveMemo(){
                btnSaveSettingClickWrapper(event, findObj('btnSaveSettingSubmitEvent'), 'btnSaveSetting_btnSaveSettingClick');
							}
            </script>
			     ";

    }

    function btnSaveSettingClick($sender, $params)
    {
			$this->sqlSetting->fieldbuffer['billing_entity_id'] =  $this->sqlBilling_entity->Fields['billing_entity_id'];
			if ($this->sqlSetting->EOF) {
				sw_insert_table("setting", $this->sqlSetting->fieldbuffer);
			} else {
      	sw_update_table("setting", $this->sqlSetting->fieldbuffer, "billing_entity_id = {$this->sqlBilling_entity->Fields['billing_entity_id']}");
			}
    }


    function validate_emailJSChange($sender, $params)
    {
      Global $lbEmailErrorMsg;
        ?>
        //begin js
        var field_name = event.currentTarget.name;
        var label = "lb" + field_name + "_error";
        var lreturn = (<?php echo SW_MASK_EMAIL;?>.test(document.getElementById(field_name).value));

        document.getElementById(label).innerHTML = "";
        if (!lreturn){
          document.getElementById(label).innerHTML = "<?php echo $lbEmailErrorMsg; ?>";
        }

        return lreturn;
        //end
        <?php
    }


    function cbBilling_entityChange($sender, $params)
    {
			Global $SW_COMPANY_STRONG, $language;

			$sql = "SELECT * FROM company Order by short_name";
			$this->sqlCompany->close();
			$this->sqlCompany->SQL = $sql;
			$this->sqlCompany->open();

			$this->sqlBilling_entity->close();
			$this->sqlBilling_entity->Params = array($this->cbBilling_entity->ItemIndex);
			$this->sqlBilling_entity->open();
			$this->company_id->SelectedValue = $this->sqlBilling_entity->Fields['company_id'];

			$this->sqlSetting->close();
			$this->sqlSetting->Params = array($this->cbBilling_entity->ItemIndex);
			$this->sqlSetting->open();

      //Query with Payment method language
			$sql = "SELECT payment_method_id, {$language} as payment_method_name
							FROM payment_method
							WHERE billing_entity_id = {$this->cbBilling_entity->ItemIndex}
							ORDER BY {$language}";
      $this->sqlPayment_method->Active = False;
      $this->sqlPayment_method->SQL = $sql;
      $this->sqlPayment_method->Active = True;
			$this->payment_method_id->SelectedValue = $this->sqlSetting->Fields['payment_method_id'];
    }

}

global $application;

global $fmSetting;

//Creates the form
$fmSetting=new fmSetting($application);

//Read from resource file
$fmSetting->loadResource(__FILE__);

//Shows the form
$fmSetting->show();

?>