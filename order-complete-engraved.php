<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
include('image_functions.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 
?>

<?php 
if ($_SESSION["customerloginid"])
{
	if(isset($_POST["designoption"])){
		$_SESSION['redirect'] = strip_javascript_input($_POST["designoption"]);
	}else {
		$_SESSION['redirect'] = 0;
	}
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>
<style>
#design_2,#design_3,#design_4,#design_5,#design_6,#design_7,#design_8,#design_9,#design_10{
	display:none;
}

#colorSelector1 {
		background: url("images/select.png") repeat scroll 0 0 transparent;
		height: 26px;
		position: relative;
		width: 26px;
		float: right;
		margin-right: 37px;
		margin-bottom: 3px;
	}
	#colorSelector1 div {
		background: url("images/select.png") repeat scroll center center transparent;
		height: 20px;
		left: 3px;
		position: absolute;
		top: 3px;
		width: 18px;
	}
	
	#colorSelector2 {
		background: url("images/select.png") repeat scroll 0 0 transparent;
		height: 26px;
		position: relative;
		width: 26px;
		float: right;
		margin-right: 37px;
		margin-bottom: 3px;
	}
	#colorSelector2 div {
		background: url("images/select.png") repeat scroll center center transparent;
		height: 20px;
		left: 3px;
		position: absolute;
		top: 3px;
		width: 18px;
	}
	#colorSelector3 {
		background: url("images/select.png") repeat scroll 0 0 transparent;
		height: 26px;
		position: relative;
		width: 26px;
		float: right;
		margin-right: 37px;
		margin-bottom: 3px;
	}
	#colorSelector3 div {
		background: url("images/select.png") repeat scroll center center transparent;
		height: 20px;
		left: 3px;
		position: absolute;
		top: 3px;
		width: 18px;
	}
	#colorSelector4 {
		background: url("images/select.png") repeat scroll 0 0 transparent;
		height: 26px;
		position: relative;
		width: 26px;
		float: right;
		margin-right: 37px;
		margin-bottom: 3px;
	}
	#colorSelector4 div {
		background: url("images/select.png") repeat scroll center center transparent;
		height: 20px;
		left: 3px;
		position: absolute;
		top: 3px;
		width: 18px;
	}
	#logo_placement_1{
		display: none;
	}
	#logo_placement_2{
		display: none;
	}
	#logo_placement_3{
		display: none;
	}
	#logo_placement_4{
		display: none;
	}
	.img_btn{
		background:url('images/continueButton.png') no-repeat;
		width:95px;
		height:27px;
		border: none;
		text-indent: -200px;
        cursor: pointer;
	}
	#continues{
	    cursor: pointer; 
        padding: 2px 15px;
	}
	#backing_label{
		display: none;
	}
	#backing img{
		max-width: 200px;
		max-height: 125px;
	}
	#addition{		
		display: none;
	}
	#addition_label{
		display: none;
	}
	#need_order{
		display: none;
	}
	
</style>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url;?>/admin/calendar/calendar-win2k-1.css" title="win2k-1" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url;?>/css/ini.css" title="win2k-1" />
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/ini.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo $base_url;?>/css/fileuploader.css" title="win2k-1" />
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/fileuploader.js"></script>

<script>

function change_shipping(value)
{
	if(value=="1"){
		$("#need_order").hide();	
	}else{
		$("#need_order").show();
		}
}

// function to change the background of the badges when the customer select frame, background,....
function changedbakbadges()
{
	var size 			= $("#size").val();
	var frame 			= $("#frame_value").val();
	
	var badge_color		= $("#badge_color").val();
	
	if(frame == 'none'){
		var src_badge		= size+'-'+badge_color+'.jpg';	
	}else {
		var src_badge		= size+'-'+badge_color+'-'+frame+'.jpg';	
	}
	
	if(size =='CR80'){
		$("#try_frame").hide();
		$("#bg_color").hide();
		var src_badge		='CR80.jpg';					
	}else if(size!='Oval'){
		//$("#try_frame").show();
		$("#bg_color").show();
		}	
	if(size=='Oval'){		
			if(badge_color=='Plastic-White'){
				$("#try_frame").hide();
			}else{
			$("#try_frame").show();	
			}
			//$("#try_frame").hide();			
			//$("#badge_color option[value='Plastic-White']").remove();			
			$("#badge_color option[value='Plastic-Silver']").remove();
			$("#badge_color option[value='Plastic-Gold']").remove();
			if($("#badge_color option[value='Plastic-White']").length > 0){
					
				}else{
					$("#badge_color").prepend('<option value="Plastic-White">White</option>');					
				}
		}else if(size!='CR80'){
					
				//$("#try_frame").show();		
				/*if($("#badge_color option[value='Plastic-White']").length > 0){
					
				}else{
					$("#badge_color").prepend('<option value="Plastic-White">White</option>');					
				}*/
				if($("#badge_color option[value='Plastic-Silver']").length > 0){
					
				}else{
					$("#badge_color").prepend('<option value="Plastic-Silver">Silver</option>');					
				}
				if($("#badge_color option[value='Plastic-Gold']").length > 0){
					
				}else{
					$("#badge_color").prepend('<option value="Plastic-Gold">Gold</option>');					
				}
			}	
	
	$("#badge_configuration").html('<img src="blanks-new/'+src_badge+'">');
	$("#size_value").val(size);
	$("#badge_color_value").val(badge_color);
	$("#frame_value").val(frame);
}
function framechange(value)
{	
	$("#frame_value").val(value);
	
}
function add_dome(value)
{
	$("#dome_value").val(value);
	}
function change_fastener(value)
{
	$("#backing_label").show();	
	$("#backing_fastener_value").val(value);
	if(value=='Magnet'){
		$("#backing_text").html('Magnet');
		src_backing = 'Magnet.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');
	}
	if(value=='Premium-Pin'){
		$("#backing_text").html('Pin');
		src_backing = 'Pin.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');
	}
	if(value=='Pocket'){
		$("#backing_text").html('Pocket');
		src_backing = 'PocketSlide.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');
	}
	if(value=='Swivel'){
		$("#backing_text").html('Swivel');
		src_backing = 'BulldogSwivelClip.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');
	}
	if(value=="Stand-Pin")
	{
		$("#backing_text").html('Stand Pin');
		src_backing = 'standard-pin.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');	
	}
	/*if(value=="Premium-Pin")
	{
		$("#backing_text").html('Premium Pin');
		src_backing = 'velvet-pouch.jpg';
		$("#backing").html('<img src="blanks-new/'+src_backing+'">');	
	}*/
	if(value=='None'){
		$("#backing_label").hide();
		$("#backing").html('');	
		}
}
function change_logoplacement(value,i)
{
	var LogoPlacement_value	= $("#LogoPlacement"+i).val();
	$("#LogoPlacement"+i+"_value").val(LogoPlacement_value);
	}


function checksubmit()
{
	var check = $("#check_submit").val();
	var choose_file  = $("#check_choose_file").val();
	if(choose_file == 1){
		alert('Waiting for uploading logo complete.');
		return false;	
	}  		
	if(check==0){
		return false;
	}else{		
		$("#wizard-next").submit();
	}
	
	}

function change_velvet(value)
{
	if(value=='Yes'){
		$("#addition_label").show();
		$("#addition").show();			
		$("#addition").html('<img src="blanks-new/velvet-pouch.jpg">');		
	}else{
		$("#addition_label").hide();	
		$("#addition").html('');
		$("#addition").hide();	
	}
}
$(document).ready(function(){
	var fastener 				= $("#fastener").val();	
	var size 	 				= $("#size").val();
	var frame 					= $("input:radio[name=frame]:checked").val();
	var badge_color				= $("#badge_color").val();
	var dome 					= $('input:radio[name=dome_choose]:checked').val();
	
	$("#size_value").val(size);
	$("#badge_color_value").val(badge_color);
	$("#frame_value").val(frame);
	$("#backing_fastener_value").val(fastener);
	$("#dome_value").val(dome);	
	$("#continues").click(function(){
		checksubmit();
	});

	// process add a new form design.
	$("#add_design").click(function(){
		var i = $("#num_design").val();
		if(i==10){
				alert('We can only accept 10 files through our online tool. Please submit these 10 files and we\'ll request the remainder through email.');
				return false;
		}		
		$("#num_design").val(parseInt(i)+1);
		
		for(i=2;i<=$("#num_design").val(); i++){
				$("#design_"+i).show();
			}
	});
});
</script>


<!-- main calendar program -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/ini.js"></script>
<!-- language for the calendar -->

<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="<?php echo $base_url;?>/admin/calendar/calendar-setup.js"></script>

    <div id="content">	
    <?php //echo $_SESSION['logo1'];?>
     <div id="mainContentFull">
	 <form method="post" id="wizard-next" name="wizard-next" action="wizard-next.php" enctype="multipart/form-data" >
	  <h2>Digitally Printed Name Badge Ordering</h2>
  		<h4>Please select the configuration for your name badges below.</h4>
        
               
  		<div id="signUpLeft">
        <h3>Select From The Options Below:</h3>
        <br />
		  
  		  <div class="boxHeader"><span>Badge Options</span></div>
  		 
  		 
		  <input type="hidden" value="<?php echo $_SESSION['redirect'];?>" name="checkredirect" />
		  <input type="hidden" name="attempt2" value="1" />
          <div class="signUpField">
            <div class="signUpFieldLeft">Size:</div>
            <div class="signUpFieldRight">
            <select onchange="changedbakbadges();" name="size" id="size" class="signupFieldInput" style="height: 20px;">
            	<option value="0">Please Select A Size</option>
	            <option value="1x3">1" x 3"</option>
	            <option value="15x3">1.5" x 3"</option>
	            <option value="2x3">2" x 3"</option>
	            <option value="CR80">2 1/8" x 3 3/8" (ID CARD)</option>
	            <option value="Oval">Oval</option>
	            <option value="CustomSize">Custom (Specify In Notes)</option>
            </select>
            </div>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
          
          <div id="bg_color" class="signUpField">
            <div class="signUpFieldLeft">Badge Color:</div>
            <span class="signUpFieldRight">
              <select onchange="changedbakbadges();" id="badge_color" name="color" class="signupFieldInput" style="height: 20px;">
              	<option value="Plastic-White">White</option>
                <option value="Plastic-Silver">Silver</option>
                <option value="Plastic-Gold">Gold</option>
                <option value="Brushed-Aluminum-Silver">Brushed Aluminum Silver</option>
                <option value="Brushed-Aluminum-Gold">Brushed Aluminum Gold</option>
                <option value="CustomColor">Custom Color (Specify In Notes)</option>
              </select>
            </span>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
		  
          <div id="try_frame" class="signUpField">
            <div class="signUpFieldLeft">Frame: <span style="font-size: 10px; font-weight:normal;">(Add 2.00)</span></div>
            <div class="signUpFieldRight">            		
            		<input type="radio" name="frame" value="none" checked onclick="javascript:framechange(this.value);changedbakbadges();"/> None&nbsp;&nbsp;
            		<input type="radio" name="frame" value="GF" onclick="javascript:framechange(this.value);changedbakbadges();"/> Gold&nbsp;&nbsp;
            		<input type="radio" name="frame" value="SF" onclick="javascript:framechange(this.value);changedbakbadges();" /> Silver 
            		<input type="radio" name="frame" value="BF" onclick="javascript:framechange(this.value);changedbakbadges();" /> Black</div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Dome: <span style="font-size: 10px; font-weight:normal;">(Add 2.75)</span> </div>
            <div class="signUpFieldRight"><input type="radio" onclick="add_dome(this.value); " name="dome_choose" <?php if($_SESSION['dome']==1){ echo 'checked';}?> value="1" /> Yes&nbsp;&nbsp;<input onclick="add_dome(this.value);" <?php if($_SESSION['dome']==0){ echo 'checked';}?> type="radio" name="dome_choose" value="0" /> No&nbsp;&nbsp;&nbsp;<span class="hotspot" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" onmouseover="tooltip.show('<strong>Polyurethane Domed Lens</strong><br>Give your badges added protection and a professional glassy appearance with our hand applied domed lenses.  A permanent polyurethane coating is added to the top of the badge and cured.  The result is a stunning domed lens with some serious added protection.');" onmouseout="tooltip.hide();">(What's This?)</span></div>
		  <div id="passworddiv" style="padding-left:150px;"></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Backing Fastener:</div>
            <div class="signUpFieldRight">
		          <!--  <select id="fastener" onchange="change_fastener(this.value);" name="Fastener" class="signupFieldInput" style="height: 20px;">
			            	<option value="">Please choose a backing fastener</option>
				            <option value="Magnet">Magnetic (Most Popular)</option>
				            <option value="Pin">Name Badge Pin</option>
				            <option value="Pocket">Pocket Slide</option>
				            <option value="Swivel">Swivel Bulldog Clip</option>
				            <option value="Stand-Pin">Standard Pin (Add 1.50)</option>	           
				            <option value="None">No Fastener</option>
		            	</select>
            	 	-->
            		<select id="fastener" onchange="change_fastener(this.value);" name="Fastener" class="signupFieldInput" style="height: 20px;">
		            	<option value="">Please choose a backing fastener</option>
			            <option value="Magnet">Magnetic (Most Popular) (Add 1.50)</option>
			            <option value="Stand-Pin">Standard Pin (Included)</option>
		                <option value="Premium-Pin">Premium Pin (Add .75)</option>
			            <option value="Pocket">Pocket Slide (Add 1.00)</option>
			            <option value="Swivel">Swivel Bulldog Clip (Add .50)</option>
			            <option value="None">No Fastener</option>
		            </select>
            </div>
			<div id="emaildiv" style="padding-left:150px;"></div>
          </div>
           <div class="boxHeader"><span style="float: left;">UPLOAD YOUR FILES</span></div>
         
          <div class="signUpField">
            <div class="signUpFieldLeft">Design File 1:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-1">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div>   	
					<script>
						function createUploader(){            
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-1'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                multiple: false,
				                maxConnections: 1,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
				                	$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design1").html('<input type="hidden" name="design1" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								}    
				            }); 
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-2'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design2").html('<input type="hidden" name="design2" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            });  
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-3'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design3").html('<input type="hidden" name="design3" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            }); 
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-4'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design4").html('<input type="hidden" name="design4" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            });   
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-5'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design5").html('<input type="hidden" name="design5" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            });
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-6'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design6").html('<input type="hidden" name="design6" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            });   
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-7'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design7").html('<input type="hidden" name="design7" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            });   

				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-8'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design8").html('<input type="hidden" name="design8" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            }); 

				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-9'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design9").html('<input type="hidden" name="design9" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            }); 

				            var uploader = new qq.FileUploader({
				                element: document.getElementById('file-10'),
				                action: "<?php echo $base_url;?>/libupload/server/php.php",
				                maxConnections: 1,
				                multiple: false,
				                allowedExtensions: ['jpg','gif','png','doc','docx','bmp','ai','pdf','eps','psd'],    
				                sizeLimit: 5*1024*1024, // max size   
				                debug: true,
				                onProgress: function(id, fileName, loaded, total){
			                		$("#check_submit").val('0')	 
					            },
					            onComplete: function(id, fileName, responseJSON){
							        $("#design10").html('<input type="hidden" name="design10" value="/logosnew/'+responseJSON.filename+'" />');
				                	$("#check_submit").val('1')	 
								} 
				            }); 
				                
				        }
				        
				        // in your app create uploader as soon as the DOM is ready
				        // don't wait for the window to load  
				        window.onload = createUploader;     
		  	  </script>    
					<div style="clear:both;"></div>			
            </div>
          </div>
	      <div id="design_2" class="signUpField">
            <div class="signUpFieldLeft">Design File 2:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-2">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 
			      <div style="clear:both;"></div>			
            </div>
          </div>  
          <div id="design_3" class="signUpField">
            <div class="signUpFieldLeft">Design File 3:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-3">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 	
				<div style="clear:both;"></div>			
            </div>
          </div> 
          <div id="design_4" class="signUpField">
            <div class="signUpFieldLeft">Design File 4:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-4">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 	
				<div style="clear:both;"></div>			
            </div>
         </div>
         
         <div id="design_5" class="signUpField">
            <div class="signUpFieldLeft">Design File 5:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-5">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 
					<div style="clear:both;"></div>			
            </div>
        </div>    
		<div id="design_6" class="signUpField">
            <div class="signUpFieldLeft">Design File 6:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-6">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div>  	
				<div style="clear:both;"></div>			
            </div>
        </div>   
        <div id="design_7" class="signUpField">
            <div class="signUpFieldLeft">Design File 7:</div>
            <div class="signUpFieldRight">            	
				<div>
						<div id="file-7">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div>  	
				<div style="clear:both;"></div>			
            </div>
        </div>
        <div id="design_8" class="signUpField">
            <div class="signUpFieldLeft">Design File 8:</div>
            <div class="signUpFieldRight">            	
				<div>
						<div id="file-8">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 	
				<div style="clear:both;"></div>			
            </div>
        </div> 
        <div id="design_9" class="signUpField">
            <div class="signUpFieldLeft">Design File 9:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-9">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 
					<div style="clear:both;"></div>			
            </div>
        </div>  
        
        <div id="design_10" class="signUpField">
            <div class="signUpFieldLeft">Design File 10:</div>
            <div class="signUpFieldRight">            	
					<div>
						<div id="file-10">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 	 	
					<div style="clear:both;"></div>			
            </div>
        </div>
        <div class="signUpField">
        	<div class="signUpFieldLeft"></div>
            <div class="signUpFieldRight">            	
				<a id="add_design" href="javascript:void(0);">Add An Additional File</a>							
            </div>
        </div>     
         
         	 <input type="hidden" value="0" name="check_submit" id="check_submit">
         	 <input type="hidden" value="0" name="num_design" id="num_design" />
        	 <input type="hidden" name="size_value" id="size_value" value="0" />
	         <input type="hidden" name="badge_color_value" id="badge_color_value" value="0" />
	         <input type="hidden" name="frame_value" id="frame_value" value="0" />     
	         <input type="hidden" name="dome_value" id="dome_value" value="0" />
	         <input type="hidden" name="backing_fastener_value" id="backing_fastener_value" value="0" />
	         <input type="hidden" name="type" value="Engraved Name Tags">	           
         	 <input type="hidden" name="completed" value="1" />
         	 
         	 <div id="design1"></div>
	         <div id="design2"></div>		   
	         <div id="design3"></div>      
	         <div id="design4"></div>
	         <div id="design5"></div>
	         <div id="design6"></div>
	         <div id="design7"></div>
         	 <div id="design8"></div>
         	 <div id="design9"></div>
         	 <div id="design10"></div>         	 
         	
          <div class="signUpField">
				<div class="signUpFieldLeft" style="height: 150px;"><p style="line-height:normal;">Notes For The Designer:</p>
				  </div>
				<div class="signUpFieldRight" style="height: 150px;"><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 275px; height: 130px;"></textarea></div>
				<div style="clear:both;"></div>
				</div>
		
		 <div class="boxHeader"><span style="float: left;">Additional Options</span></div>
		  <div class="signUpField">
            <div class="signUpFieldLeft">Velvet Carry Pouch:</div>
            <div class="signUpFieldRight">
            	<input onclick="change_velvet(this.value);" type="radio" name="VelvetPouch" checked value="No"  /> No&nbsp;&nbsp;
            	<input onclick="change_velvet(this.value);" type="radio" name="VelvetPouch" value="Yes" /> 
            	Yes (Add .97)&nbsp;&nbsp;
                
                <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Keep Your Name Badges Safe</strong><br/><br/>Add our black velvet carrying pouch for each of your name badges.  Keep them safe when not in use.<br/><br/>Click &quot;Yes&quot; to see a picture on the right.');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(What's this?)</a>
            	
            	
            </div>
          </div> 
          <div class="boxHeader"><span style="float: left;">ORDER DETAILS</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft">How Many Badges:</div>
            <div class="signUpFieldRight"><input type="text" name="quantity" value="" style="width: 50px;" class="signupFieldInput" /> total order quantity</div>
          </div>
          
          <div class="signUpField">
            <div class="signUpFieldLeft" style="height: 55px;">Shipping:</div>
            <div class="signUpFieldRight" style="height: 55px;">
            	<input type="radio" name="Delivery" onclick="change_shipping(this.value);"  value="1" checked /> Standard &nbsp;&nbsp;<input onclick="change_shipping(this.value);" type="radio" name="Delivery" value="0" /> Expedited &nbsp;&nbsp;  <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Your Timeline Is Important To Us</strong><br/><br/>We deliver on-time, everytime.<br/><br/>We can oftentimes ship out the same or next day, with delivery options as fast as overnight. We accomodate every rush order request with NO rush fees.<br/><br/>You have 2 ways to do this, first, please try calling us at 888-445-7601.  If it is after hours, please submit your order, then email support@bestnamebadges.com with your request and we will reach out to you right away.<br/><br/>');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(Need It Fast?)</a>
            	<br />
                 <span style="font-size: 10px; color: #999;"> Orders under $25 will have a small $3.95 shipping charge</span>
            </div>
          </div>
          
          <div class="signUpField" id="need_order">
            <div class="signUpFieldLeft">I Need My Order By:</div>
            <div class="signUpFieldRight">
            	<input type="text" name="DeliverBy" id="DeliverBy" value="" style="width: 100px;" class="signupFieldInput" />  <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Your Timeline Is Important To Us</strong><br/><br/>We deliver on-time, everytime.<br/><br/>We can oftentimes ship out the same or next day, with delivery options as fast as overnight. We accomodate every rush order request with NO rush fees.<br/><br/>You have 2 ways to do this, first, please try calling us at 888-445-7601.  If it is after hours, please submit your order, then email support@bestnamebadges.com with your request and we will reach out to you right away.<br/><br/>');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(Need It Fast?)</a>
            	<script type="text/javascript">
                                          Calendar.setup(
                                            {
                                              inputField  : "DeliverBy",         // ID of the input field
                                              ifFormat    : "%m/%d/%Y",    // the date format
                                            }
                                          );
                                        </script>
            </div>
          </div>
          <div class="signUpField">
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;">
            	<!--  <input type="image" value="submit" src="images/continueButton.png" />  -->
            	<input type="button" name="continues" value="" id="continues" class="img_btn">
            </div>
          </div>
          
        </div> 
        
        
        
       	</form>         
  		<div id="signUpRight">
        	<h3>Your Badge Configuration:</h3>
        	<br />
			<div><strong>Badge Plate:</strong> </div>
  		 	<div id="badge_configuration">
  		 		
  		 	</div>
  		 	<div id="backing_label"><strong>Backing/Attachment:</strong> <span id="backing_text"></span> </div>
  		 	<div id="backing">
  		 		
  		 	</div>
  		 	<div id="addition_label"><strong>Velvet Carry Pouch</strong></div>
  		 	<div id="addition">
  		 		 
  		 	</div>
        </div>
         
        </div>
<br />
</div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->

<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/toolscript.js"></script>
<?php include_once 'inc/footer.php' ; ?>

