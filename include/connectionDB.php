<?php
require_once("rpcl/rpcl.inc.php");
//Includes
use_unit("forms.inc.php");
use_unit("extctrls.inc.php");
use_unit("stdctrls.inc.php");
use_unit("dbtables.inc.php");

//Class definition
class connectionDB extends DataModule
{
    public $DbConnection = null;

    function DbConnectionCustomConnect($sender, $params)
    {
       Global $DbHost, $DbUser, $DbPass, $DbName;

       $this->DbConnection->Host = $DbHost;
       $this->DbConnection->UserName = $DbUser;
       $this->DbConnection->UserPassword = $DbPass;
       $this->DbConnection->DatabaseName = $DbName;
    }

    function Connected()
    {
       try {
          if (!$this->DbConnection->Connected)
              return $this->DbConnection->Connected = True;
       } catch (Exception $e) {

          echo 'Excepción capturada: Error en la DB ' . $this->DbConnection->DatabaseName, "\n";
          ?><script>CloseSession();</script><?php
          die;
       }
    }

    function DisConnected()
    {
       if ($this->DbConnection->Connected)
          return $this->DbConnection->Connected = false;

       return false;
    }
}

global $application;

global $connectionDB;

//Creates the form
$connectionDB=new connectionDB($application);

//Read from resource file
$connectionDB->loadResource(__FILE__);

?>