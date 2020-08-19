<?php
  session_start();

  require_once("include/language.php");

  if (!$_SESSION['DirUploadFile']) die;

  Global $lblFileSuccessUpload, $lblFileCouldNotBeUploaded;

  $DirUpload = $_SESSION['DirUploadFile'];
  $username = $_SESSION['username'];

?>
<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" type="text/css" href="css/uploadifive.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="include/jquery.uploadifive.js" type="text/javascript"></script>
        <script type='text/javascript'>
          //begin js
          $(function() {
              $('#file_upload').uploadifive({
                'multi'    : true,
                'auto'     : true,
                'removeTimeout' : 100,
                'RemoveCompleted': false,
                'requeueErrors' : true,
                'fileSizeLimit' : '3MB',
                'queueID'  : 'some_file_queue',
                'uploadScript': 'uploadify.php',
                'fileObjName' : 'files',
		            'formData' : { 'ActionUpload' : 'ftp_upload', 'DirUploadFTP' : '<?php echo $DirUpload; ?>', '<?php echo session_name(); ?>' : '<?php echo session_id() ?>'},
                'onUploadComplete' : function(file, data, response) {
                    document.getElementById('lbQueueComplete').innerHTML = " ";
                    if (data.length != 0){
                      var lbError = document.getElementById('lbError').innerHTML;
                      var cErrorFile = document.getElementById('lbErrorFile').innerHTML;

                      //Label error
                      if (lbError.length == 0) document.getElementById('lbError').innerHTML = '<?php echo $lblFileCouldNotBeUploaded; ?>';

                      cErrorFile += file.name + '   (' + data + ')</br>';
                      document.getElementById('lbErrorFile').innerHTML = cErrorFile;
                    }
                },
                'onClearQueue' : function(queueItemCount) {
                  document.getElementById('lbError').innerHTML = ' ';
                  document.getElementById('lbErrorFile').innerHTML = ' ';
                  document.getElementById('lbQueueComplete').innerHTML = ' ';
                },
		            'onQueueComplete' : function(queueData) {
                  document.getElementById('lbQueueComplete').innerHTML = '<?php echo $lblFileSuccessUpload; ?>';
        	      }
              });
          });

        </script>


</head>
<body>
 <div style="height: 350px; width: 600px">
  <div style="margin: 7px; width: 95%;" id="some_file_queue">&nbsp;</DIV>
  <TABLE class=table-upload>
  <TR>
   <TD class=td-upload><input id="file_upload" name="file_upload" type="file"/></TD>
   <TD class=td-upload><input style="width: 120px; height: 30px" class=button-upload type="submit" name="btnClose" value="CLOSE"/></TD>
  </TR>
  </TABLE>
  <div style="margin: 10px; font-family: Tahoma; font-size: 11px; color: blue; font-weight: bold;" class=listfile id="lbQueueComplete"></div>
  <div style="margin-top: 10px; margin-left: 10px; width: 98%; font-family: Tahoma; font-size: 11px; color: black; font-weight: bold;" class=listfile id="lbError"></div>
  <div style="margin: 10px; height: 50%; width: 98%; font-family: Tahoma; font-size: 11px; color: red; " class=listfile id="lbErrorFile"></div>
 </div>
</body>
</html>