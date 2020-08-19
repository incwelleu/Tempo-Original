<?php
Global $DbHost, $DbUser, $DbPass, $DbName;

if (!$connectionDB = mysql_connect($DbHost, $DbUser, $DbPass)){
    die('Not connected : ' . mysql_error());
}

if (!$DbSelected = mysql_select_db($DbName, $connectionDB)){
    die ("Can\'t use {$DbName} : " . mysql_error($connectionDB));
}
?>