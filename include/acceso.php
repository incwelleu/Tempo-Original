<?php
require_once("configure.php");
require_once("connectionDB.php");

require_once('rpcl/rpcl.inc.php');
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");
use_unit("components4phpfull/jtuserlogin.inc.php");

session_start();

require_once("language.php");
require_once("constant.php");

define('ADMIN_ACCESS', 1);
define('USERS_ACCESS', 2);
define('EMPLOYEE_ACCESS', 3);
define('TAX_ACCESS', 10);
define('ACCOUNTING_ACCESS', 11);
define('STRONG_ABOGADOS_ACCESS', 12);
define('COMPANY_ACCESS', 59);
define('REAL_STATE_ACCESS', 60);
define('IMMIGRATION_ACCESS', 65);

//Class definition
class acceso extends DataModule
{
    public $sqlUser = null;
    public $Login_user = null;
    public $message = null;

    function Login_userCustomHash($sender, $params)
    {
       return $params[0];// sha1($params[0]);
    }

    function Login_session($username, $password, &$message)
    {
      $return = $this->Login_user->LoginUser($username, $password);
      $message = $this->message;

      return $return;
    }

    function Login_userLogin($sender, $params)
    {
        Global $connectionDB;

        $username = $params[0];
        $password = $params[1];
        $connectionDB->Connected();

        $sql = 'SELECT * FROM user WHERE username = "' . $username . '" AND password = PASSWORD("' . $password . '")';
        $this->sqlUser->close();
        $this->sqlUser->SQL = $sql;
        $this->sqlUser->open();

        if ($return = !$this->sqlUser->EOF) {
          // Inicialize roles
          if ($this->sqlUser->Fields["status_cd"] !== "a") {
            if ($user_role['IsClientUser'] || (date('Y-m-d') >= $this->sqlUser->Fields["status_block_dt"])){
              $this->message = "Your account is no longer active.";//$lbUserInactive_error;
              return false;
            }
          }

					sw_set_user_session($this->sqlUser->Fields);

          //Provider contact values
          if (($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']) &&
               ($record = sw_get_provider_contact($this->sqlUser->Fields["user_id"]))){
            $_SESSION['provider_contact_name'] = $record['provider_contact_name'];
            $_SESSION['provider_contact_email'] = $record['email'];
          }

          //Provider contact values
//          if ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']) sw_get_provider_contact($this->sqlUser->Fields["user_id"]);

          //get company
          $user_id = $this->sqlUser->Fields["parent_user_id"] != 0 ? $this->sqlUser->Fields["parent_user_id"] : $this->sqlUser->Fields["user_id"];
          sw_get_companies_for_user($user_id);

        }
        else { $this->message = "The username and password entered do not match those on file."; }

        return $return;
    }


    function Access_active()
    {
      $sql = "Select * from vw_tree_access Where parent_id = 0";
      $access = sw_records_array($sql, Array('nodo_id', 'superadmin_yn'));

      $access[ADMIN_ACCESS] = ($_SESSION['IsSuperadmin'] || $_SESSION['IsProvider']);
      $access[USERS_ACCESS] = ($_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'] || $_SESSION['IsProvider']);
      $access[COMPANY_ACCESS] = $this->check_access_superadmin('can_see_companies_yn');
      $access[EMPLOYEE_ACCESS] = $this->check_access_superadmin('can_see_employee_general_yn') ;
      $access[ACCOUNTING_ACCESS] = $this->check_access_superadmin('can_see_accounting_yn');
      $access[TAX_ACCESS] = $this->check_access_superadmin('can_see_tax_forms_yn');
      $access[STRONG_ABOGADOS_ACCESS] = true; //($_SESSION['IsSuperadmin'] || $_SESSION['IsClientAdmin'] || $_SESSION['IsProvider']);
      $access[REAL_STATE_ACCESS] = $this->check_access_superadmin('can_see_real_estate_yn');
      $access[IMMIGRATION_ACCESS] = $this->check_access_superadmin('can_see_immigration_yn');

      $nodo_access = array();
      foreach ($access as $key => $value) {
        if ($value){
          $nodo_access[] = $key;
          $this->find_parent_menu($key, $nodo_access);
        }
      }

      $x = implode(",", $nodo_access);
      $_SESSION['GLOBAL_ACCESS'] = $x;
    }


    function check_access_superadmin($access_menu)
    {
      $access_company = sw_check_access_company($_SESSION['company_id']);

      $acceso_yn = ($_SESSION['IsSuperadmin']);
      if ($_SESSION['IsSuperadmin'] && $_SESSION['IsClientUser'] && $_SESSION['parent_user_id'] &&
          sw_check_access_company($_SESSION['company_id'])){
        $acceso_yn = $_SESSION[$access_menu];
      }

      return ($acceso_yn) || ($_SESSION[$access_menu] && $access_company);;
    }

    function find_parent_menu($parent_id, &$nodo_access)
    {
      Global $connectionDB;

      $connectionDB->Connected();

      $access_cd = !$_SESSION['IsSuperadmin'] ? "0" : "";
      $access_cd = $_SESSION['IsProvider'] ? "0,2" : $access_cd;

      $sql = 'SELECT * FROM vw_tree_access WHERE parent_id = ' . $parent_id;
      $sql .= $access_cd != "" ? " AND superadmin_yn in ({$access_cd}) " : "";
      $query = new query();
      $query->Database = $connectionDB->DbConnection;
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();

      $laccess = false;
      While (!$query->EOF) {
        if ($query->Fields['link'] || ($laccess = $this->find_parent_menu($query->Fields['nodo_id'], $nodo_access)))
        {
           if (!in_array($query->Fields['nodo_id'], $nodo_access)) $nodo_access[] = $query->Fields['nodo_id'];
           if (!in_array($parent_id, $nodo_access)) $nodo_access[] = $parent_id;
           $laccess = true;
        }
        $query->next();
      }

      //Compruebo que existan documentos de empresa con este padre
      $query->close();
      $sql = 'SELECT * FROM virtual_file WHERE (parent_id = ' . $parent_id . ') AND (company_id = (' . $_SESSION['company_id'] . '))';
      $sql .= $access_cd != "" ? " AND superadmin_yn in ({$access_cd}) " : "";
      $query->LimitStart = -1;
      $query->LimitCount = -1;
      $query->Params = "";
      $query->SQL = $sql;
      $query->open();
      if ($laccess = !$query->EOF) {
        if (!in_array($parent_id, $nodo_access)) $nodo_access[] = $parent_id;
        While (!$query->EOF) {
          if (!in_array($query->Fields['nodo_id'], $nodo_access)) $nodo_access[] = $query->Fields['nodo_id'];
          $query->next();
        }
      }

      $connectionDB->DisConnected();

      return $laccess;
    }


    function Login_userLoggedOut($sender, $params)
    {
      $url = $_SERVER["HTTPS"] === 'on' ? 'https://' : 'http://';
      $url .= $_SERVER['HTTP_HOST'] . "/clientarea/login.php";
      session_unset();
      $_SESSION = array();
      session_destroy();

      ?>
      <script type="text/javascript">
        //begin js
        window.open('<?php echo $url; ?>','_parent');
        //end js
      </script>
      <?php

      exit();
    }


    // login check
    function sw_login_check()
    {
      Global $connectionDB;

      if (!isset($_COOKIE['StrongWeber']) || !isset($_SESSION['username'])) {
        $connectionDB->Connected();
        $this->Login_user->LogoutUser();
        return false;
      }
      else return true;
    }


    function __construct( $aowner = null )
    {
      parent::__construct( $aowner );

      Global $connectionDB;

      $connectionDB->Connected();

      //Session con la configuracion de TEMPO
      //sw_settings_tempo();

    }


}

global $application;

global $acceso;

//Creates the form
$acceso=new acceso($application);

//Read from resource file
$acceso->loadResource(__FILE__);

?>