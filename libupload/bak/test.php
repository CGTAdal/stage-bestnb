<html>
<head>
<link href="uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript" src="jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="flash_detect.1.0.4.js"></script>

</head>
<body>
<?php


//echo phpinfo();?>
<div class="demo-box">     
      </div>
        	<div id="custom-demo" class="demo">
          <script type="text/javascript">
				$(function() {
			
				if (!FlashDetect.versionAtLeast(9)) {
					
				}else{								
					$('#custom_file_upload').uploadify({
						  'uploader'       : 'http://devb.bestnamebadges.com/demo/uploadify.swf',
						  'script'         : 'http://devb.bestnamebadges.com/demo/uploadify.php',
						  'cancelImg'      : 'cancel.png',
						  'folder'         : 'testupload',
						  'multi'          : true,
						  'auto'           : true,
						  'buttonText'	   : 'Browse',
						  'checkScript'	   : 'check.php',
						  'fileExt'        : '*.jpg;*.gif;*.png',
						  'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',
						  'queueID'        : 'custom-queue',
						  'queueSizeLimit' : 20,
						  'simUploadLimit' : 1,
						  'sizeLimit'   : 204800,
						  'removeCompleted': false,
						  'onSelectOnce'   : function(event,data) {
						     // $('#status-message').text(data.filesSelected + ' files have been added to the queue.');
						    },
						  'onAllComplete'  : function(event,data) {							  
							  //alert(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');	   
						      //$('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
						    },
						    onError: function (a, b, c, d) {
							    alert(d.text);
						    	if (d.status == 404)
						    	alert('Could not find upload script. Use a path relative to: '+'<?= getcwd() ?>');
						    	else if (d.type === "HTTP")
						    	alert('error '+d.type+": "+d.status);
						    	else if (d.type ==="File Size")
						    	alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
						    	else
						    	alert('error '+d.type+": "+d.text);
						    	},					    	
						});	
					}			
				});
			</script>
        <style type="text/css">
        #custom-demo .uploadifyQueueItem {
  background-color: #FFFFFF;
  border: none;
  font: 11px Verdana, Geneva, sans-serif;
  height: 20px;
  margin-top: 0;
  padding: 10px;
  width: 220px;
}
#custom-demo .uploadifyError {
  background-color: #FDE5DD !important;
  border: none !important; 
}
#custom-demo .uploadifyQueueItem .cancel {
  float: right;
}
#custom-demo .uploadifyQueue .completed {
  color: #C5C5C5;
}
#custom-demo .uploadifyProgress {
  background-color: #E5E5E5;
  margin-top: 10px;
  width: 100%;
}
#custom-demo .uploadifyProgressBar {
  background-color: #0099FF;
  height: 3px;
  width: 1px;
}
#custom-demo #custom-queue {  
  height: 20px;
margin-bottom: 10px;
  width: 220px;
}				</style>
        <div class="demo-box">
        	<div style="float: left;" id="custom-queue"></div>
			<div style="float: left;padding-left: 25px;margin-top: 5px;"><input value="" id="custom_file_upload" type="file" name="Filedata" /></di>        
		</div>
      </div>
      </div>
</div>
</body>
</html>