<?php
	require_once("configure.php");
	require_once("dbconnection.php");

	$session_name = session_name();
	if (!isset($_POST['session'])) {
  	exit;
	} else {
    session_id($_POST['session']);
    session_start();
	}

	$table				=	$_POST['table'];
	$field				=	$_POST['fieldId'];
	$fieldValue		=	$_POST['fieldIdValue'];
	$fieldView		=	$_POST['fieldView'];
	$defaultValue	=	$_POST['defaultValue'];

	$defaulValue[0] = $defaultValue;

	$result = mysql_query("Select * from {$table} Where {$field} = {$fieldValue} Order by {$field}", $connectionDB);

	$options = "<option value=0>0.00</option>";

	While ($record = mysql_fetch_array($result)){
		$options .="<option value={$record[$fieldView]}>" . utf8_encode($record[$fieldView]) . "</option>";
	}

	echo $options;

?>