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
#block_logo1{
	display: none;
}
#block_logo2{
	display: none;
}
#block_logo3{
	display: none;
}
#block_logo4{
	display: none;
}
#text_line1{
	display: none;
}
#text_line2{
	display: none;
}
#text_line3{
	display: none;
}
#text_line4{
	display: none;
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
	#lanyard_color{
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
function show_upload(value)
{
	$("#line_block").show();
	if(value==0){
		$("#block_logo1").hide();
		$("#block_logo2").hide();
		$("#block_logo3").hide();
		$("#block_logo4").hide();
		$("#logo_placement_1").hide();
		$("#logo_placement_2").hide();
		$("#logo_placement_3").hide();
		$("#logo_placement_4").hide();
	}
	if(value==1){
		$("#block_logo1").show();
		$("#block_logo2").hide();
		$("#block_logo3").hide();
		$("#block_logo4").hide();
		$("#logo_placement_1").show();
		$("#logo_placement_2").hide();
		$("#logo_placement_3").hide();
		$("#logo_placement_4").hide();
	}
	if(value==2){
		$("#block_logo1").show();
		$("#block_logo2").show();
		$("#block_logo3").hide();
		$("#block_logo4").hide();
		$("#logo_placement_1").show();
		$("#logo_placement_2").show();
		$("#logo_placement_3").hide();
		$("#logo_placement_4").hide();
	}
	if(value==3){
		$("#block_logo1").show();
		$("#block_logo2").show();
		$("#block_logo3").show();
		$("#block_logo4").hide();
		$("#logo_placement_1").show();
		$("#logo_placement_2").show();
		$("#logo_placement_3").show();
		$("#logo_placement_4").hide();
	}
	if(value==4){
		$("#block_logo1").show();
		$("#block_logo2").show();
		$("#block_logo3").show();
		$("#block_logo4").show();
		$("#logo_placement_1").show();
		$("#logo_placement_2").show();
		$("#logo_placement_3").show();
		$("#logo_placement_4").show();
	}	
}
function show_text(value)
{
	//$("#line_block").show();
	if(value==0){
		$("#text_line1").hide();
		$("#text_line2").hide();
		$("#text_line3").hide();
		$("#text_line4").hide();
	}
	if(value==1){
		$("#text_line1").show();
		$("#text_line2").hide();
		$("#text_line3").hide();
		$("#text_line4").hide();
	}
	if(value==2){
		$("#text_line1").show();
		$("#text_line2").show();
		$("#text_line3").hide();
		$("#text_line4").hide();
	}
	if(value==3){
		$("#text_line1").show();
		$("#text_line2").show();
		$("#text_line3").show();
		$("#text_line4").hide();
	}
	if(value==4){
		$("#text_line1").show();
		$("#text_line2").show();
		$("#text_line3").show();
		$("#text_line4").show();
	}	
}

// function to change the background of the badges when the customer select frame, background,....
function changedbakbadges()
{
	var size 			= $("#size").val();
	var frame 			= $("#frame_value").val();	
	var badge_color		= $("#badge_color").val();	
	$("#size_value").val(size);
	if(size!='CustomSize'){
		orient = $("input:radio[name=Orientation]:checked").val();
		if(orient==1){
			$("#badge_configuration").html('<img src="blanks-new/id-horizontal.jpg">');	
			}
		if(orient==0){
			$("#badge_configuration").html('<img src="blanks-new/id-vertical.jpg">');
			}
		}else {
			$("#badge_configuration").html('');
			}
	$("#badge_color_value").val(badge_color);
	$("#frame_value").val(frame);
}


function change_orient(value)
{
	size =  $("#size").val();	
	if(value==1 && size!='CustomSize'){
		$("#badge_configuration").html('<img src="blanks-new/id-horizontal.jpg">');	
		}
	if(value==0 && size!='CustomSize'){
		$("#badge_configuration").html('<img src="blanks-new/id-vertical.jpg">');
		}
	
	if(size == 'CustomSize'){		
		$("#badge_configuration").html('');
		}
}
function lanyard_choose(value)
{	
	if(value==1){			
			$("#lanyard_color").show();
			$("#backing_option").hide();
		}
	if(value==0){
		$("#lanyard_color").hide();
		$("#backing_option").show();
		}
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
	if(value=='strap-clip'){
		$("#backing_text").html('Strap Clips');
		src_backing = 'strap-clip.jpg';
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
	if(check==0){
		alert('Waiting for uploading logo complete.');
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
	var LogoPlacement1_value	= $("#LogoPlacement1").val();
	var LogoPlacement2_value	= $("#LogoPlacement2").val();
	var LogoPlacement3_value	= $("#LogoPlacement3").val();
	var LogoPlacement4_value	= $("#LogoPlacement4").val();

	// orient
	var orient 					= $("input:radio[name=Orientation]:checked").val();
	if (size!='CustomSize'){
		if(orient == 1){
			$("#badge_configuration").html('<img src="blanks-new/id-horizontal.jpg">');	
			}	
		if(orient == 0){
			$("#badge_configuration").html('<img src="blanks-new/id-vertical.jpg">');
		}
	}
	// end of orient 
	
	//check Lanyard option
	lanyard_check 				= $("input:radio[name=Lanyard]:checked").val();
	if(lanyard_check==1){			
		$("#lanyard_color").show();
		$("#backing_option").hide();
	}
	if(lanyard_check==0){
		$("#lanyard_color").hide();
		$("#backing_option").show();
	}
	
	//end check lanyard option
	
	$("#size_value").val(size);
	$("#badge_color_value").val(badge_color);
	$("#frame_value").val(frame);
	$("#backing_fastener_value").val(fastener);
	$("#dome_value").val(dome);	
	$("#LogoPlacement1_value").val(LogoPlacement1_value);
	$("#LogoPlacement2_value").val(LogoPlacement2_value);
	$("#LogoPlacement3_value").val(LogoPlacement3_value);
	$("#LogoPlacement4_value").val(LogoPlacement4_value);
	$("#continues").click(function(){		
		var numlogo = $("input:radio[name=Logos]:checked").val();		
		if(numlogo >0){
			checksubmit();			
		}else {
			$("#wizard-next").submit();	
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
	  <h2>Photo ID Badge  Ordering</h2>
  		<h4>Please select the configuration for your Photo ID badges below.</h4>
        
               
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
            	<option value="CR80">2 1/8" x 3 3/8" (ID CARD)</option>
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
                <option value="CustomColor">Custom Color (Specify In Notes)</option>
              </select>
            </span>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Orientation:</div>
            <div class="signUpFieldRight">
            	<input type="radio" name="Orientation"  value="1" onclick="change_orient(this.value);" checked /> Horizontal &nbsp;&nbsp;<input type="radio" name="Orientation" value="0" onclick="change_orient(this.value);" /> Vertical &nbsp;&nbsp;  
            	
            </div>
          </div>
          <div  class="signUpField">
            <div class="signUpFieldLeft">Lanyard: <span style="font-size: 10px; font-weight:normal;">(Add 1.00)</span></div>
            <div class="signUpFieldRight">
            	<input type="radio" name="Lanyard" onclick="lanyard_choose(this.value);"  value="1" checked /> Yes &nbsp;&nbsp;<input onclick="lanyard_choose(this.value);" type="radio" name="Lanyard" value="0" /> No &nbsp;&nbsp;  
            	
            </div>
          </div>
          
          <div id="lanyard_color" class="signUpField">
            <div class="signUpFieldLeft">Lanyard Color:</div>
            <div class="signUpFieldRight">
            <select name="LanyardColor" id="size" class="signupFieldInput" style="height: 20px;">
            	<option value="Black">Black</option>
	            <option value="White">White</option>
                <option value="Green">Green</option>
                <option value="Red">Red</option>
                <option value="Orange">Orange</option>
                <option value="Purple">Purple</option>
                <option value="Yellow">Yellow</option>
                <option value="Blue">Blue</option>
                <option value="NavyBlue">Navy Blue</option>
                <option value="Pink">Pink</option>
	            <option value="CustomSize">Custom / Logo (Specify In Notes)</option>
            </select>
            </div>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
          
          <div id="backing_option" class="signUpField">
            <div class="signUpFieldLeft">Backing Fastener:</div>
            <div class="signUpFieldRight">
    
            <select id="fastener" onchange="change_fastener(this.value);" name="Fastener" class="signupFieldInput" style="height: 20px;">
            	<option value="">Please choose a backing fastener</option>
                <option value="strap-clip">Strap Clip (Included)</option>
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
           <div class="boxHeader"><span style="float: left;">Layout And Design Options</span></div>
           <div class="signUpField">
            <div class="signUpFieldLeft">How Many Logos:</div>
            <div class="signUpFieldRight">
            	<input type="radio" name="Logos" checked value="none" onclick="show_upload(0);" /> None&nbsp;&nbsp;
            	<input type="radio" name="Logos" value="1" onclick="show_upload(1);" /> 1&nbsp;&nbsp;
            	<input type="radio" name="Logos" value="2" onclick="show_upload(2);" /> 2&nbsp;&nbsp;
            	<input type="radio" name="Logos" value="3" onclick="show_upload(3);" /> 3&nbsp;&nbsp;
            	<input type="radio" name="Logos" value="4" onclick="show_upload(4);" /> 4&nbsp;&nbsp;
            </div>
          </div>
          <div id="block_logo1" class="signUpField">
            <div class="signUpFieldLeft">Upload Logo 1:</div>
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
						        $("#logo1").html('<input type="hidden" name="logo1" value="/logosnew/'+responseJSON.filename+'" />');
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
						        $("#logo2").html('<input type="hidden" name="logo2" value="/logosnew/'+responseJSON.filename+'" />');
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
						        $("#logo3").html('<input type="hidden" name="logo3" value="/logosnew/'+responseJSON.filename+'" />');
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
						        $("#logo4").html('<input type="hidden" name="logo4" value="/logosnew/'+responseJSON.filename+'" />');
			                	$("#check_submit").val('1')	 
							} 
			            });   
			            var uploader = new qq.FileUploader({
			                element: document.getElementById('your_photo'),
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
						        $("#your_photo_id_input").val('/logosnew/'+responseJSON.filename);
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
            <div style="clear:both;"></div>	
          </div>
          <div id="logo_placement_1" class="signUpField">
            <div class="signUpFieldLeft">Logo Placement 1:</div>
            <div class="signUpFieldRight">
	            <select onchange="change_logoplacement(this.value,1)" id="LogoPlacement1" name="LogoPlacement1" class="signupFieldInput" style="height: 20px;">
		            <option value="TopCenter">Top Center</option>
		            <option value="TopLeft">Top Left</option>
		            <option value="TopRight">Top Right</option>
		            <option value="Left">Left</option>
		            <option value="Right">Right</option>
		            <option value="BottomCenter">Bottom Center</option>
		            <option value="BottomLeft">Bottom Left</option>
		            <option value="BottomRight">Bottom Right</option>
		            <option value="Middle Center">Middle Center</option>
	            </select>
            </div>
          </div>
          <div id="block_logo2" class="signUpField">
            <div class="signUpFieldLeft">Upload Logo 2:</div>
            <div class="signUpFieldRight">
            	<div>
					<div id="file-2">		
						<noscript>			
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>         
					</div>
				</div>	
            </div>
          </div>
          <div id="logo_placement_2" class="signUpField">
            <div class="signUpFieldLeft">Logo Placement 2:</div>
            <div class="signUpFieldRight">
	            <select onchange="change_logoplacement(this.value,2)" id="LogoPlacement2" name="LogoPlacement2" class="signupFieldInput" style="height: 20px;">
		            <option value="TopCenter">Top Center</option>
		            <option value="TopLeft">Top Left</option>
		            <option value="TopRight">Top Right</option>
		            <option value="Left">Left</option>
		            <option value="Right">Right</option>
		            <option value="BottomCenter">Bottom Center</option>
		            <option value="BottomLeft">Bottom Left</option>
		            <option value="BottomRight">Bottom Right</option>
		            <option value="Middle Center">Middle Center</option>
	            </select>
            </div>
          </div>
          <div id="block_logo3" class="signUpField">
            <div class="signUpFieldLeft">Upload Logo 3:</div>
            <div class="signUpFieldRight">
            	<div>
					<div id="file-3">		
						<noscript>			
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>         
					</div>
				</div>	
            </div>
          </div>   
          <div id="logo_placement_3" class="signUpField">
            <div class="signUpFieldLeft">Logo Placement 3:</div>
            <div class="signUpFieldRight">
	            <select onchange="change_logoplacement(this.value,3)" id="LogoPlacement3" name="LogoPlacement3" class="signupFieldInput" style="height: 20px;">
		            <option value="TopCenter">Top Center</option>
		            <option value="TopLeft">Top Left</option>
		            <option value="TopRight">Top Right</option>
		            <option value="Left">Left</option>
		            <option value="Right">Right</option>
		            <option value="BottomCenter">Bottom Center</option>
		            <option value="BottomLeft">Bottom Left</option>
		            <option value="BottomRight">Bottom Right</option>
		            <option value="Middle Center">Middle Center</option>
	            </select>
            </div>
          </div> 
          <div id="block_logo4" class="signUpField">
            <div class="signUpFieldLeft">Upload Logo 4:</div>
            <div class="signUpFieldRight">
            	<div>
					<div id="file-4">		
						<noscript>			
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>         
					</div>
				</div>		
            </div>
          </div>  
          <div id="logo_placement_4" class="signUpField">
            <div class="signUpFieldLeft">Logo Placement 4:</div>
            <div class="signUpFieldRight">
	            <select onchange="change_logoplacement(this.value,4)" id="LogoPlacement4" name="LogoPlacement4" class="signupFieldInput" style="height: 20px;">
		            <option value="TopCenter">Top Center</option>
		            <option value="TopLeft">Top Left</option>
		            <option value="TopRight">Top Right</option>
		            <option value="Left">Left</option>
		            <option value="Right">Right</option>
		            <option value="BottomCenter">Bottom Center</option>
		            <option value="BottomLeft">Bottom Left</option>
		            <option value="BottomRight">Bottom Right</option>
		            <option value="Middle Center">Middle Center</option>
	            </select>
            </div>
          </div>
         
         	 <input type="hidden" value="0" name="check_submit" id="check_submit">
        	 <input type="hidden" name="size_value" id="size_value" value="0" />
	         <input type="hidden" name="badge_color_value" id="badge_color_value" value="0" />
	         <input type="hidden" name="frame_value" id="frame_value" value="0" />     
	         <input type="hidden" name="dome_value" id="dome_value" value="0" />
	         <input type="hidden" name="backing_fastener_value" id="backing_fastener_value" value="0" />
	         <input type="hidden" name="type" value="Photo ID Badges">
	         <input type="hidden" name="LogoPlacement1_value" value="0" id="LogoPlacement1_value" />
	         <input type="hidden" name="LogoPlacement2_value" value="0" id="LogoPlacement2_value" />
	         <input type="hidden" name="LogoPlacement3_value" value="0" id="LogoPlacement3_value" />
	         <input type="hidden" name="LogoPlacement4_value" value="0" id="LogoPlacement4_value" />
	         <div id="logo1">
	         </div>
	         <div id="logo2">
	         </div>		   
	         <div id="logo3">
	         </div>      
	         <div id="logo4">
	         </div>
	         <div id="your_photo_value">
	         	<input type="hidden" name="your_photo_id_badge" id="your_photo_id_input" value="0" />
	         </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">How Many Text Lines:</div>
            <div class="signUpFieldRight">
            	<input type="radio" name="LinesText" checked value="none" onclick="show_text(0);" /> None&nbsp;&nbsp;
            	<input type="radio" name="LinesText" value="1" onclick="show_text(1);" /> 1&nbsp;&nbsp;
            	<input type="radio" name="LinesText" value="2" onclick="show_text(2);" /> 2&nbsp;&nbsp;
            	<input type="radio" name="LinesText" value="3" onclick="show_text(3);" /> 3&nbsp;&nbsp;
            	<input type="radio" name="LinesText" value="4" onclick="show_text(4);" /> 4&nbsp;&nbsp;</div>
          </div>
          <div id="text_line1" class="signUpField">
            <div class="signUpFieldLeft">Text Line 1:</div>
            <div class="signUpFieldRight">Type: <select name="TextType1" class="signupFieldInput" style="height: 20px;">
            <option value="Name">Name</option>
            <option value="Position">Position</option>
            <option value="Company">Company</option>
            <option value="Location">Location</option>
            <option value="Other">Other</option>
            </select>
            &nbsp;&nbsp;
            <select name="Font1" class="signupFieldInput" style="height: 20px;width: 100px;">
            <option value="Arial">Arial</option>
            <option value="Times">Times New Roman</option>
            <option value="FreeScript">Free Script</option>
            <option value="CenturyGothic">Century Gothic</option>
            <option value="Other">Other</option>
            </select>
            Color: <div id="colorSelector1">
            			<div style="background-color: black"></div>
            			<input type="hidden" id="color1" name="color1" value="000000" />
            	   </div>
            </div>
          </div>
          <div id="text_line2" class="signUpField">
            <div class="signUpFieldLeft">Text Line 2:</div>
            <div class="signUpFieldRight">Type: <select name="TextType2" class="signupFieldInput" style="height: 20px;">
            <option value="Name">Name</option>
            <option value="Position">Position</option>
            <option value="Company">Company</option>
            <option value="Location">Location</option>
            <option value="Other">Other</option>
            </select>
            &nbsp;&nbsp;
            <select name="Font2" class="signupFieldInput" style="height: 20px;width: 100px;">
            <option value="Arial">Arial</option>
            <option value="Times">Times New Roman</option>
            <option value="FreeScript">Free Script</option>
            <option value="CenturyGothic">Century Gothic</option>
            <option value="Other">Other</option>
            </select>
            Color: <div id="colorSelector2">
            			<div style="background-color:  black"></div>
            			<input type="hidden" id="color2" name="color2" value="000000" />
            	   </div>
            </div>
          </div>
          <div id="text_line3" class="signUpField">
            <div class="signUpFieldLeft">Text Line 3:</div>
            <div class="signUpFieldRight">Type: <select name="TextType3" class="signupFieldInput" style="height: 20px;">
            <option value="Name">Name</option>
            <option value="Position">Position</option>
            <option value="Company">Company</option>
            <option value="Location">Location</option>
            <option value="Other">Other</option>
            </select>
            &nbsp;&nbsp;
            <select name="Font3" class="signupFieldInput" style="height: 20px;width: 100px;">
            <option value="Arial">Arial</option>
            <option value="Times">Times New Roman</option>
            <option value="FreeScript">Free Script</option>
            <option value="CenturyGothic">Century Gothic</option>
            <option value="Other">Other</option>
            </select>
            Color: <div id="colorSelector3">
            			<div style="background-color:  black"></div>
            			<input type="hidden" id="color3" name="color3" value="000000" />
            	   </div>
            </div>
          </div>
          <div id="text_line4" class="signUpField">
            <div class="signUpFieldLeft">Text Line 4:</div>
            <div class="signUpFieldRight">Type: <select name="TextType4" class="signupFieldInput" style="height: 20px;">
            <option value="Name">Name</option>
            <option value="Position">Position</option>
            <option value="Company">Company</option>
            <option value="Location">Location</option>
            <option value="Other">Other</option>
            </select>
            &nbsp;&nbsp;
            <select name="Font4" class="signupFieldInput" style="height: 20px;width: 100px;">
            <option value="Arial">Arial</option>
            <option value="Times">Times New Roman</option>
            <option value="FreeScript">Free Script</option>
            <option value="CenturyGothic">Century Gothic</option>
            <option value="Other">Other</option>
            </select>
            Color: <div id="colorSelector4">
            			<div style="background-color:  black "></div>
            			<input type="hidden" id="color4" name="color4" value="000000" />
            	   </div>
            </div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Upload Your Photo:</div>
            <div class="signUpFieldRight">            	
            	<!-- <input type="file" name="upload" value="upload"/> -->
            	<div>
					<div id="your_photo">		
						<noscript>			
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>         
					</div>
					
				</div>	
            </div>
          </div>
          <div class="signUpField">
				<div class="signUpFieldLeft" style="height: 150px;"><p style="line-height:normal;">Notes For The Designer:</p>
				  </div>
				<div class="signUpFieldRight" style="height: 150px;"><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 275px; height: 130px;"></textarea></div>
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
                 
            </div>
          </div>
          <div id="need_order" class="signUpField">
            <div class="signUpFieldLeft">I Need My Order By:</div>
            <div class="signUpFieldRight">
            	<input type="text" name="DeliverBy" id="DeliverBy" value="" style="width:100px;" class="signupFieldInput" />  <span style="font-size: 10px;">(Additional Carrier Charges May Apply)</span>
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
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $base_url;?>/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo $base_url;?>/js/colorpicker.js"></script>
<script language="javascript">
	$('#colorSelector1').ColorPicker({
		color: '000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector1 div').css('backgroundColor', '#' + hex);
			//document.getElementById('ptext1').style.color =  '#'+hex;	
			$("#color1").val(hex);           
		}		
	});
	$('#colorSelector2').ColorPicker({
		color: '000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector2 div').css('backgroundColor', '#' + hex);
			//document.getElementById('ptext2').style.color =  '#'+hex;	
			//$("#badgetext2color_2").val(hex);          
			$("#color2").val(hex);  
		}		
	});
	
	$('#colorSelector3').ColorPicker({
		color: '000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector3 div').css('backgroundColor', '#' + hex);
			$("#color3").val(hex);
			//document.getElementById('ptext3').style.color =  '#'+hex;	
			//$("#badgetext3color_3").val(hex);            
		}		
	});
	$('#colorSelector4').ColorPicker({
		color: '000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#colorSelector4 div').css('backgroundColor', '#' + hex);
			$("#color4").val(hex);
			//document.getElementById('ptext3').style.color =  '#'+hex;	
			//$("#badgetext3color_4").val(hex);            
		}		
	});

</script>
<!-- Google Code for Sign Up Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1021904526;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "UJKTCPi38wIQjo2k5wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1021904526/?value=0&amp;label=UJKTCPi38wIQjo2k5wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/b9bf6e6e-d437-4617-a530-bb11e10c4951/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("conversion", {cp:"5050",dedup:"1"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/b9bf6e6e-d437-4617-a530-bb11e10c4951/conversion.html?cp=5050&dedup=1" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe> </noscript>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6007631683142';
fb_param.value = '0.00';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6007631683142&amp;value=0" /></noscript>

<script type="application/javascript" src="https://s.yimg.com/wi/ytc.js"></script><script type="application/javascript">YAHOO.ywa.I13N.fireBeacon([{"projectId" : "10001522547770","coloId" : "SP","properties" : {/*"documentName" : "",*/"pixelId" : "33009","qstrings" : {}}}]);</script>

<?php include_once 'inc/footer.php' ; ?>

