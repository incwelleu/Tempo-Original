<?php
  session_start();

  require_once("include/language.php");

  if (!$_SESSION['DirUploadFile'] || !$_SESSION['FunctionUploadFile']) die;

  Global $lblFileSuccessUpload, $MonthLetter;

  $DirUpload = $_SESSION['DirUploadFile'];
  $FunctionUploadFile = $_SESSION['FunctionUploadFile'];
  
  $username = $_SESSION['username'];

  $month_data = '<select name="month_data" id="month_data" onchange="this.form.submit()">';
  $month_select = isset($_POST['month_data']) ? $_POST['month_data'] : (idate('m')-1);

  for ($i=1;$i<=count($MonthLetter);$i++)
  {
    $month_data .= '<option ';
    if ($i == $month_select) $month_data .= 'selected ';
    $month_data .= 'value="'. $i .'">'. $MonthLetter[$i] .'</option>';
  }
  $month_data .= '</select>';

  $year_data = '<select name="year_data" id="year_data" onchange="this.form.submit()">';
  $year_select = isset($_POST['year_data']) ? $_POST['year_data'] : idate('Y');
  for ($i=(idate('Y')-1); $i<=idate('Y');$i++)
  {
    $year_data .= '<option ';
    if ($i == $year_select) $year_data .= 'selected ';
    $year_data .= 'value="'. $i .'">'. $i .'</option>';
  }
  $year_data .= '</select>';

  $formData = "'formData' : { 'month_data' : get_month(), 'year_data' : get_year(), 'ActionUpload' : '{$FunctionUploadFile}', 'DirUploadFTP' : '{$DirUpload}', '" . session_name() . "' : '" . session_id() . "'},";
  if ($_SESSION['FunctionUploadFile'] == 'upload_employee'){
	$formData = "'formData' : { 'ActionUpload' : '{$FunctionUploadFile}', 'DirUploadFTP' : '{$DirUpload}', '" . session_name() . "' : '" . session_id() . "'},";
  }
?>
  <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/uploadifive.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="include/jquery.uploadifive.js" type="text/javascript"></script>
        <?php echo '
        <script type="text/javascript">
$(function() {
            $("#file_upload").uploadifive({
                "multi"    : true,
                "auto"     : true,
                "removeTimeout" : 100,
                "RemoveCompleted": false,
                "requeueErrors" : true,
                "fileSizeLimit" : "0",
                "queueID"  : "some_file_queue",
                "uploadScript": "uploadify.php",
                "fileObjName" : "files",
		        ' . $formData . '
                "onUploadComplete" : function(file, data, response) {
                    document.getElementById("lbQueueComplete").innerHTML = "";
                    if (data.length != 0){
                      var cError = document.getElementById("lbError").innerHTML;
                      if (cError.length == 0) cError = data;
                      cError += file.name + "</br>";
                      document.getElementById("lbError").innerHTML = cError;
                    }
                },
                "onClearQueue" : function(queueItemCount) {
                  document.getElementById("lbError").innerHTML = "";
                  document.getElementById("lbQueueComplete").innerHTML = "";
                },
		            "onQueueComplete" : function(queueData) {
                  document.getElementById("lbQueueComplete").innerHTML = "<B>' . $lblFileSuccessUpload . '</B>";
        	      }
          });
});

function get_month(){
  var x = document.getElementById("month_data").selectedIndex;
  return document.getElementById("month_data").options[x].value;
}

function get_year(){
  var x = document.getElementById("year_data").selectedIndex;
  return document.getElementById("year_data").options[x].value;
}

</script>'; ?>

</head>
<body>
<div style="height: 380px; width: 600px">
  <div style="margin-left: 15px; align=left; font-family: Tahoma; font-size: 11px; color: black; display: <?php echo $_SESSION['FunctionUploadFile'] == 'upload_employee' ? 'none' : 'block'; ?>">
    <p>Month and year of data <?php echo $month_data; ?><?php echo $year_data;  ?></p>
  </div>
  <div style="margin: 15px; height: 45%; width: 95%;" id="some_file_queue">&nbsp;</DIV>
  <TABLE class=table-upload>
  <TR>
   <TD class=td-upload><input id="file_upload" name="file_upload" type="file"/></TD>
   <TD class=td-upload><input style="width: 120px; height: 30px" class=button-upload type="submit" name="BtnClose" value="CLOSE"/></TD>
   <TD class=td-upload><div style="margin: 15px; font-family: Tahoma; font-size: 11px; color: black; " class=listfile id="lbQueueComplete"></div>
  </TR>
  </TABLE>
  <div style="margin: 15px; width: 95%; font-family: Tahoma; font-size: 11px; color: red; " class=listfile id="lbError"></div>
</div>
</body>
</html>