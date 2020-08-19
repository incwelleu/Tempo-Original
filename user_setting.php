<?php
require_once("rpcl/rpcl.inc.php");
require_once("include/acceso.php");
require_once("include/functions.php");

//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("components4phpfull/jtbasiclayoutpage.inc.php");
use_unit("components4phpfull/jtsitetheme.inc.php");
use_unit("components4phpfull/jtgroupbox.inc.php");
use_unit("components4phpfull/jtadvancededit.inc.php");
use_unit("components4phpfull/jtcheckboxlist.inc.php");
use_unit("components4phpfull/jtcombobox.inc.php");
use_unit("comctrls.inc.php");

//Class definition
class user_setting extends Page
{
    public $gbReceive_email = null;
    public $receive_standard_billing_emails_yn = null;
    public $receive_standard_accounting_emails_yn = null;
    public $receive_standard_hr_emails_yn = null;
    public $lbPayroll_provider_id = null;
    public $lbAccounting_provider_id = null;
    public $accounting_provider_id = null;
    public $lbAcct_manager = null;
    public $acct_manager_id = null;
    public $lbCompany_name = null;
    public $company_name = null;
    public $lbCompany_name_error = null;
    public $gbCompany = null;
    public $sqlPayroll_manager = null;
    public $dsPayroll_manager = null;
    public $sqlAccount_manager = null;
    public $dsAccount_manager = null;
    public $sqlAccountant_manager = null;
    public $dsAccountant_manager = null;
    public $sqlContact = null;
    public $SiteTheme = null;
    public $lbUsername = null;
    public $username = null;
    public $lbUsername_error = null;
    public $btnClose_setting = null;
    public $gbPermits = null;
    public $can_see_employee_general_yn = null;
    public $can_modify_employee_payroll_yn = null;
    public $can_see_accounting_yn = null;
    public $can_see_companies_yn = null;
    public $can_see_immigration_yn = null;
    public $can_see_real_estate_yn = null;
    public $gbRoles = null;
    public $cbRoles = null;
    public $btnSave_setting = null;
    public $gbContact = null;
    public $lbfirst_name = null;
    public $first_name = null;
    public $lbLast_name = null;
    public $last_name = null;
    public $lbFirstname_error = null;
    public $lbLastname_error = null;
    public $lbEmail = null;
    public $email = null;
    public $lbEmail_error = null;
    public $lbPhone = null;
    public $fixed_phone = null;
    public $lbCell = null;
    public $mobile_phone = null;
    public $payroll_provider_id = null;
    public $can_see_tax_forms_yn = null;
    public $lbRole_error = null;

    function user_settingCreate($sender, $params)
    {
      sw_style_selected($this);
    }


    function user_settingShow($sender, $params)
    {
      if ($_POST['btnSave_settingSubmitEvent']=="")
      {
        Global $user;

        $user_id = $user->user_id->Value ? $user->user_id->Value : 0;
        $this->Details_user($user_id);
      }
    }


    function Details_user($primaryKey)
    {
      $where = "user_id = " . $primaryKey;
      $record = sw_get_data_table("user", $where);

      $this->View_roles($primaryKey);

      $this->View_data_company($primaryKey);

      $this->View_data_user($record);
    }


    function View_roles($user_id)
    {
      Global $connectionDB;

      $IsSuperadmin = ($_SESSION['IsSuperadmin']) && (!$_SESSION['IsClientUser']);

      $this->gbRoles->Visible = $IsSuperadmin;
      $this->gbPermits->Visible = $IsSuperadmin;

      $sql = "SELECT role.role_id, role.role_name, user_role.user_id
              FROM role LEFT JOIN user_role ON role.role_id = user_role.role_id AND user_id = {$user_id}
              ORDER BY role.role_id";

      $query = New Query();
      $query->Database = $connectionDB->DbConnection;
      $query->SQL = $sql;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->open();

      $roles = array();
      $lcontact = false;
      While (!$query->EOF){
        $lchecked = ($query->Fields['user_id'] != null) || (($user_id == 0) && ($query->Fields['role_name'] == 'Client admin'));
        $roles[]  = array($query->Fields['role_name'], $lchecked);

        $lcontact = (!$lcontact) && ($query->Fields['user_id'] != null) && (($query->Fields['role_name'] == 'Superadmin') || ($query->Fields['role_name'] == 'Provider')) ? 1 : $lcontact;
        $query->next();
      }

      $this->cbRoles->items = $roles;

      // Contact data
      $sql = "SELECT contact.*
              FROM contact INNER JOIN company ON contact.contact_list_id = company.contact_list_id
              WHERE company.user_id = {$user_id}";
      if ($lcontact) {
        $sql = "SELECT * FROM provider_contact WHERE provider_contact_id = " . $user_id;
      }
      $this->sqlContact->close();
      $this->sqlContact->sql = $sql;
      $this->sqlContact->LimitStart = 0;
      $this->sqlContact->LimitCount = 1;
      $this->sqlContact->open();

      return $roles;
    }


    function View_data_company($user_id)
    {
      $this->first_name->text = '';
      $this->last_name->text = '';
      $this->email->text = '';
      $this->fixed_phone->text = '';
      $this->mobile_phone->text = '';
      $this->receive_standard_billing_emails_yn->checked = 1;
      $this->receive_standard_accounting_emails_yn->checked = 1;
      $this->receive_standard_hr_emails_yn->checked = 1;
      if ($user_id && !$this->sqlContact->EOF) {
        $this->first_name->text = $this->sqlContact->Fields['first_name'];
        $this->last_name->text = $this->sqlContact->Fields['last_name'];
        $this->email->text = $this->sqlContact->Fields['email'] ? $this->sqlContact->Fields['email'] : $this->sqlContact->Fields['sw_email'];
        $this->fixed_phone->text = $this->sqlContact->Fields['fixed_phone'];
        $this->mobile_phone->text = $this->sqlContact->Fields['mobile_phone'];
        $this->receive_standard_billing_emails_yn->checked = $this->sqlContact->Fields['receive_standard_billing_emails_yn'];
        $this->receive_standard_accounting_emails_yn->checked = $this->sqlContact->Fields['receive_standard_accounting_emails_yn'];
        $this->receive_standard_hr_emails_yn->checked = $this->sqlContact->Fields['receive_standard_hr_emails_yn'];
      }

      //Company data
      $this->lbCompany_name_error->Caption = "";
      $fields = array('company_name', 'acct_manager_id', 'payroll_provider_id', 'accounting_provider_id');
      $this->company_name->text = "";
      if ($user_id) {
        $record = sw_get_data_table("company", "user_id = " . $user_id, $fields);
        $this->company_name->Text = $record['company_name'] ? $record['company_name'] : '';
      }
      $this->company_name->Enabled = ($_SESSION['IsSuperadmin'] && !trim($this->company_name->text));

      $this->acct_manager_id->SelectedValue = $record['acct_manager_id'] ? $record['acct_manager_id'] : $_SESSION['user_id'];
      $this->payroll_provider_id->SelectedValue = $record['payroll_provider_id'];
      $this->accounting_provider_id->SelectedValue = $record['accounting_provider_id'];
    }


    function View_data_user($record)
    {
      $this->lbUsername_error->Caption = "";
      $this->lbFirstname_error->Caption = "";
      $this->lbLastname_error->Caption = "";
      $this->lbEmail_error->Caption = "";
      $this->lbRole_error->Caption = "";

      $this->username->text = $record['username'];
      $this->can_see_companies_yn->Checked = isset($record['can_see_companies_yn']) ? $record['can_see_companies_yn'] : 1;
      $this->can_see_employee_general_yn->Checked = isset($record['can_see_employee_general_yn']) ? $record['can_see_employee_general_yn'] : 1;;
      $this->can_modify_employee_payroll_yn->Checked = isset($record['can_modify_employee_payroll_yn']) ? $record['can_modify_employee_payroll_yn'] : 1;
      $this->can_see_accounting_yn->Checked = isset($record['can_see_accounting_yn']) ? $record['can_see_accounting_yn'] : 1;
      $this->can_see_tax_forms_yn->Checked = isset($record['can_see_tax_forms_yn']) ? $record['can_see_tax_forms_yn'] : 1;
      $this->can_see_real_estate_yn->Checked = isset($record['can_see_real_estate_yn']) ? $record['can_see_real_estate_yn'] : 1;
      $this->can_see_immigration_yn->Checked = isset($record['can_see_immigration_yn']) ? $record['can_see_immigration_yn'] : 1;
    }


    function btnSave_settingClick($sender, $params)
    {
      Global $user, $password_admin, $password_user,
             $lbSpecifyValueMsg, $lbUserRolesNotEmpty_error,
             $lbEmailErrorMsg;

      $user_id = $user->user_id->value;
      $username = sw_checked_file_valid_name(strtolower(trim($this->username->text)));
      $where    = "(user_id = {$user_id})";
      $record_user = sw_get_data_table("user", $where, "username");

      //Valid roles
      $roles = array();
      foreach ($this->cbRoles->Items as $role){
        if ($role[1]) {
          $roles[$role[0]] = $role[1];
        }
      }
      $this->lbRole_error->Caption = (count($roles) === 0) ? $lbUserRolesNotEmpty_error : "";

      //Valid username
      $this->lbUsername_error->Caption = sw_valid_username($user_id, $username);

      //Valid Company_name & Legacy_datahouse_id
      $this->lbCompany_name_error->Caption = "";
      if ($roles['Client admin']) {
        $this->lbCompany_name_error->Caption = (!trim($this->company_name->text)) ? $lbSpecifyValueMsg : "";
      }

      $record_contact['first_name']   = $this->first_name->text;
      $record_contact['last_name']    = $this->last_name->text;
      $record_contact['email']        = $this->email->text;
      $record_contact['fixed_phone']  = $this->fixed_phone->text;
      $record_contact['mobile_phone'] = $this->mobile_phone->text;
      $this->lbFirstname_error->Caption = (!$record_contact['first_name']) ? $lbSpecifyValueMsg : "";
      $this->lbLastname_error->Caption = (!$record_contact['last_name']) ? $lbSpecifyValueMsg : "";
      $this->lbEmail_error->Caption = ($record_contact['email']) && (!preg_match(SW_MASK_EMAIL, $record_contact['email'])) ? $lbEmailErrorMsg : "";
      $this->lbEmail_error->Caption = (!$record_contact['email']) ? $lbSpecifyValueMsg : $this->lbEmail_error->Caption;

      if ((!$this->lbRole_error->Caption) && (!$this->lbUsername_error->Caption) &&
          (!$this->lbFirstname_error->Caption) && (!$this->lbLastname_error->Caption) &&
          (!$this->lbEmail_error->Caption) && (!$this->lbCompany_name_error->Caption))
      {
        //Get user roles
        $roles_user = array();
        foreach ($this->cbRoles->Items as $role){
          if ($role[1] && (sw_get_data_table("role", "role_name = '{$role[0]}'"))) {
            $roles_user[] = $role[0];
          }
        }
        $record['parent_user_id'] = $roles['Client user'] ? $_SESSION['parent_user_id'] : 0;

        //Insert user
        if (!$user_id) {
          $record['can_see_companies_yn'] = 1;
          $record['can_see_employee_general_yn'] = 1;
          $record['can_modify_employee_payroll_yn'] = 1;
          $record['can_see_accounting_yn'] = 1;
          $record['can_see_tax_forms_yn'] = 1;
          $record['can_see_real_estate_yn'] = 1;
          $record['can_see_immigration_yn'] = 1;

          $record['username'] = $username;
          $record['password'] = $roles['Client admin'] ? $password_user : $password_admin;

          $user_id = sw_insert_user($record, $roles_user);
          $user->user_id->value = $user_id;
        }
        else {
          sw_update_user_roles($user_id, $username, $roles_user);

          //Update User
          if ($this->gbPermits->visible){
            $record['can_see_companies_yn'] = $this->can_see_companies_yn->Checked;
            $record['can_see_employee_general_yn'] = $this->can_see_employee_general_yn->Checked;
            $record['can_modify_employee_payroll_yn'] = $this->can_modify_employee_payroll_yn->Checked;
            $record['can_see_accounting_yn'] = $this->can_see_accounting_yn->Checked;
            $record['can_see_tax_forms_yn'] = $this->can_see_tax_forms_yn->Checked;
            $record['can_see_real_estate_yn'] = $this->can_see_real_estate_yn->Checked;
            $record['can_see_immigration_yn'] = $this->can_see_immigration_yn->Checked;
          }

          if (($record_user) && ($username != $record_user['username'])) {
            $record['username'] = $username;
          }

          sw_update_table('user', $record, $where);
        }

        //Update Company
        if ($roles['Client admin']) {
          $record_contact['contact_list_id'] = $this->Company_update($user_id, $username);
        }

        //Update data contact company
        if (($roles['Client admin']))
        {
          $record_contact['receive_standard_billing_emails_yn']    = $this->receive_standard_billing_emails_yn->checked;
          $record_contact['receive_standard_accounting_emails_yn'] = $this->receive_standard_accounting_emails_yn->checked;
          $record_contact['receive_standard_hr_emails_yn']         = $this->receive_standard_hr_emails_yn->checked;

          //Create contacto
          if (!$this->sqlContact->Fields['contact_id']){
            sw_insert_table("contact", $record_contact);
            $this->sqlContact->refresh();
          }
          else {
            $record_contact['contact_id'] = $this->sqlContact->Fields['contact_id'];
            $where = "contact_id = {$record_contact['contact_id']}";
            sw_update_table("contact", $record_contact, $where);
          }
        }

        //Update Provider contact
        if ($roles['Superadmin'] || $roles['Provider']) {
          unset($record_contact['contact_list_id']);
          unset($record_contact['email']);
          unset($record_contact['receive_standard_billing_emails_yn']);
          unset($record_contact['receive_standard_accounting_emails_yn']);
          unset($record_contact['receive_standard_hr_emails_yn']);

          $record_contact['provider_contact_id']  = $user_id;
          $record_contact['sw_email']     = $this->email->text;
          if (!sw_get_data_table( "provider_contact", "provider_contact_id = {$user_id}")) {
            sw_insert_table("provider_contact", $record_contact);
          }
          else sw_update_table("provider_contact", $record_contact, "provider_contact_id = {$user_id}");
        }

        ?>
           <script type="text/javascript">
            gridUsers.Refresh();
           </script>
        <?php

        $user->winUser_setting->Hide();
      }
    }


    function Company_update($user_id, $username)
    {
      Global $user;

      $record_company = sw_get_data_table( "company", "short_name = '{$username}'");
      $record_company['company_name']        = $this->company_name->text;
      $record_company['acct_manager_id']     = $this->acct_manager_id->SelectedValue;
      $record_company['payroll_provider_id'] = $this->payroll_provider_id->SelectedValue;
      $record_company['accounting_provider_id'] = $this->accounting_provider_id->SelectedValue;

      //Create company record
      if (!$record_company['company_id'])
      {
        $record_company['contact_list_id'] = sw_insert_contact_list($user_id, $record_company);
        $record_company['created_by_user_id'] = $_SESSION['user_id'];
        $record_company['user_id'] = $user_id;
        $record_company['short_name'] = $username;
        $record_company['created_dt'] = date("Y-m-d H:i:s");

        sw_insert_table("company", $record_company);
      }
      else
      {
        //Change short_name company
        if ($record_company['company_id'] && ($record_company['short_name'] != $username)) {
          $user->Change_shortname_company($username, $record_company);
          $record_company['short_name'] = $username;
        }

        $record_company['user_id'] = !$record_company['user_id'] ? $user_id : $record_company['user_id'];
        sw_update_table("company", $record_company, "short_name = '{$username}'");
      }

      return $record_company['contact_list_id'];
    }

    function Create_role_user($user_id)
    {
      sw_delete_table("user_role", "user_id = {$user_id}");

      $value = "";
      foreach ($this->cbRoles->Items as $role){
        if ($role[1] && ($record = sw_get_data_table("role", "role_name = '{$role[0]}'"))) {
            $value .= $value ? ", " : "VALUES ";
            $value .= "({$user_id}, {$record['role_id']})";
        }
      }

      if ($value) {
        Global $connectionDB;
        $sql = "INSERT INTO user_role(user_id, role_id) " . $value;

        $connectionDB->DbConnection->BeginTrans();
        $connectionDB->DbConnection->execute($sql);
        $connectionDB->DbConnection->CompleteTrans();
      }
    }

    function btnClose_settingClick($sender, $params)
    {
      Global $user;
      $user->winUser_setting->Hide();
    }



    function emailJSChange($sender, $params)
    {
      Global $lbEmailErrorMsg;
        ?>
        //begin js
        var lreturn = (<?php echo SW_MASK_EMAIL;?>.test(document.getElementById("email").value));

        document.getElementById("lbEmail_error").innerHTML = "";
        if (!lreturn){
          document.getElementById("lbEmail_error").innerHTML = "<?php echo $lbEmailErrorMsg; ?>";
        }

        return lreturn;
        //end
        <?php
    }

}

global $application;

global $user_setting;

//Creates the form
$user_setting=new user_setting($application);

//Read from resource file
$user_setting->loadResource(__FILE__);

header( "Content-type: text/html; charset=utf-8" );

//Shows the form
if (isset($_SESSION['username'])) $user_setting->show();

?>