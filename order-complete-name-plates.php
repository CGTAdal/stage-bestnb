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
	#holder_color_second{
		display: none;
	}
	
	#attactment{
		display:none;
	}
	#design_2,#design_3,#design_4,#design_5,#design_6,#design_7,#design_8,#design_9,#design_10{
		display:none;
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
	var badge_color		= $("#badge_color").val();
	
	
	if(badge_color != 'CustomColor'){
			var src_badge = size+'-'+badge_color+'.jpg';
			$("#badge_configuration").html('<img src="nameplates/'+src_badge+'">');
	}else {
		var src_badge = '';
		$("#badge_configuration").html('');			
	}	
	
	$("#size_value").val(size);
	$("#badge_color_value").val(badge_color);	
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
	
	var size 	 				= $("#size").val();	
	var badge_color				= $("#badge_color").val();

	var size 			= $("#size").val();	
	var badge_color		= $("#badge_color").val();
	
	
	if(badge_color != 'CustomColor'){
		var src_badge = size+'-'+badge_color+'.jpg';
		$("#badge_configuration").html('<img src="nameplates/'+src_badge+'">');
	}else {
		var src_badge = '';
		$("#badge_configuration").html('');			
	}	
	var type					= $('input:radio[name=HolderType]:checked').val();
	change_type(type);	
	
	$("#size_value").val(size);
	$("#badge_color_value").val(badge_color);

	$("#continues").click(function(){		
		var numlogo = $("input:radio[name=Logos]:checked").val();		
		if(numlogo >0){
			checksubmit();			
		}else {
			$("#wizard-next").submit();	
		}
	});

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

//function for change type
function change_type(type)
{
		if(type==1){
			$("#type").html('');
			$("#holder_color_first").show();
			$("#material").show();
			$("#holder_color_second").hide();	
			$("#attactment").hide();
			var material = $('input:radio[name=DeskHolderMaterial]:checked').val();
			if(material==1){
				var color = $("#hodler_color_first_value").val();
				$("#type").html('<img src="nameplates/desk-'+color+'-holder.jpg">');						
			}
			if(material==0){
				$("#holder_color_first").hide();
				$("#type").html('<img src="nameplates/stained-wood.jpg">');	
			}
		}
		if(type==0){			
			$("#type").html('');
			$("#holder_color_first").hide();
			$("#material").hide();
			$("#holder_color_second").show();
			$("#attactment").show();
			var color = $("#hodler_color_second_value").val();
			$("#type").html('<img src="nameplates/wall-'+color+'-holder.jpg">');	
		}
		if(type=='none'){			
			$("#type_label").hide();
			$("#type").html('');
			$("#holder_color_first").hide();
			$("#material").hide();
			$("#holder_color_second").hide();
			$("#attactment").show();
		}
}
// end of function change type

function color_first_change(value)
{	
	var material = $('input:radio[name=DeskHolderMaterial]:checked').val();
	if(material=='1'){
		var color = $("#hodler_color_first_value").val();
		$("#type").html('<img src="nameplates/desk-'+color+'-holder.jpg">');						
	}
	if(material=='0'){
		$("#type").html('<img src="nameplates/stained-wood.jpg">');	
	}		
}
function color_second_change(value)
{	
	var color = $("#hodler_color_second_value").val();
	$("#type").html('<img src="nameplates/wall-'+color+'-holder.jpg">');	
}
function change_material(value)
{	
	if(value==1){
		var color = $("#hodler_color_first_value").val();
		$("#type").html('<img src="nameplates/desk-'+color+'-holder.jpg">');						
	}
	if(value==0){
		$("#holder_color_first").hide();
		$("#type").html('<img src="nameplates/stained-wood.jpg">');	
	}	
}
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
	  <h2>Name Plates Ordering</h2>
  		<h4>Please select the configuration for your Name Plates below.</h4>
        
               
  		<div id="signUpLeft">
        <h3>Select From The Options Below:</h3>
        <br />
		  
  		  <div class="boxHeader"><span>Plate Options</span></div>
  		 
  		 
		  <input type="hidden" value="<?php echo $_SESSION['redirect'];?>" name="checkredirect" />
		  <input type="hidden" name="attempt2" value="1" />
          <div class="signUpField">
            <div class="signUpFieldLeft">Size:</div>
            <div class="signUpFieldRight">
            <select name="size" id="size" onchange="changedbakbadges()" class="signupFieldInput" style="height: 20px;">
            	<option value="2x8">2" x 8" (Standard)</option>
	            <option value="CustomSize">Custom (Specify In Notes)</option>
            </select>
            </div>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
          <div id="bg_color" class="signUpField">
            <div class="signUpFieldLeft">Plate Color:</div>
            <span class="signUpFieldRight">
              <select onchange="changedbakbadges();" id="badge_color" name="plate_color" class="signupFieldInput" style="height: 20px;">
              	<option value="White">White</option>
                <option value="Silver">Brushed Aluminum Silver</option>
                <option value="Gold">Brushed Aluminum Gold</option>
                <option value="CustomColor">Custom Color (Specify In Notes)</option>
              </select>
            </span>
			<div id="usernamediv" style="padding-left:150px;"></div>
          </div>
          
    <div class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-height">Imprint Method: </div>
            <div class="signUpFieldRight">
            	<input type="radio" name="ImprintMethod"  value="1" checked /> Printed <span style="font-size: 10px; font-weight:normal;">(Full Color)</span> &nbsp;&nbsp;<input type="radio" name="ImprintMethod" value="0" /> Engraved <span style="font-size: 10px; font-weight:normal;">(Black or White Only)</span> &nbsp;&nbsp;  
            	
  </div>
          </div>
          <div class="boxHeader"><span style="float: left;">Holder Selection</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-height">Type:</div>
            <div class="signUpFieldRight">
            	<input onclick="change_type(this.value);" type="radio" name="HolderType"  value="1" checked /> Desk Plate Holder &nbsp;&nbsp;<input onclick="change_type(this.value);" type="radio" name="HolderType" value="0" /> Wall Plate Holder &nbsp;&nbsp;  
                <input type="radio" name="HolderType" onclick="change_type(this.value);" value="none" /> None 
            	
            </div>
          </div>
          
          <div id="material" class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-height">Material:</div>
            <div class="signUpFieldRight">
            	<input onclick="change_material(this.value);" type="radio" name="DeskHolderMaterial"  value="1" checked /> Aluminum <span style="font-size: 10px; font-weight:normal;">(Add 4.80)</span> &nbsp;&nbsp;<input type="radio" onclick="change_material(this.value);" name="DeskHolderMaterial" value="0" /> Stained Wood <span style="font-size: 10px; font-weight:normal;">(Add 9.92)</span> 
            	
            </div>
          </div>
          
          <div id="holder_color_first" class="signUpField">
            <div class="signUpFieldLeft ">Holder Color:</div>
            <div class="signUpFieldRight ">
            	<select id="hodler_color_first_value" onchange="color_first_change(this.value);" name="DeskHolderColor" class="signupFieldInput" style="height: 20px;">
              	<option value="silver">Silver</option>
                <option value="gold">Gold</option>
                <option value="rose-gold">Rose Gold (Copper)</option>
              </select> 
            	
            </div>
          </div>
          
          <div id="holder_color_second" class="signUpField">
            <div class="signUpFieldLeft">Holder Color:</div>
            <div class="signUpFieldRight">
            	<select id="hodler_color_second_value" onchange="color_second_change(this.value);" name="WallHolderColor" class="signupFieldInput" style="height: 20px;">
              	<option value="silver">Silver</option>
                <option value="gold">Gold</option>
                <option value="black">Black</option>
              </select> 
            	 &nbsp;&nbsp;<span style="font-size: 10px; font-weight:normal;">(Add 3.75)</span>
            </div>
          </div>
          
          <div id="attactment" class="signUpField">
            <div class="signUpFieldLeft">Attachment:</div>
            <div class="signUpFieldRight">
            	<select name="WallHolderAttachment" class="signupFieldInput" style="height: 20px;">
              	<option value="None">None (SCREWS NOT SUPPLIED)</option>
                <option value="Adhesive">Adhesive (Included)</option>
                <option value="Cubicle">Cubicle Hanger (Add 1.85)</option>
              </select> 
            
            </div>
          </div>
          
          
          <!--  <div class="boxHeader"><span style="float: left;">Layout And Design Options</span></div> -->
          <div class="boxHeader"><span style="float: left;">UPLOAD YOUR FILES</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft">Design File 1:</div>
            <div class="signUpFieldRight order-complete-engraved-browse-outer">         
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
				            var uploader = new qq.FileUploader({
				                element: document.getElementById('your_file'),
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
							        $("#your_file_name_plate").val("/logosnew/"+responseJSON.filename);
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
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
        <div class="signUpField">
            <div class="signUpFieldLeft">Upload Your Files</div>
            <div class="signUpFieldRight order-complete-engraved-browse-outer">            	
					<div>
						<div id="your_file">		
							<noscript>			
								<p>Please enable JavaScript to use file uploader.</p>
								<!-- or put a simple form for upload here -->
							</noscript>         
						</div>
					</div> 
					<div style="clear:both;"></div>			
            </div>
        </div>
         	<input type="hidden" value="1" name="num_design" id="num_design" />
         	 <input type="hidden" value="0" name="check_submit" id="check_submit">
        	 <input type="hidden" name="size_value" id="size_value" value="0" />
	         <input type="hidden" name="badge_color_value" id="badge_color_value" value="0" />
	         <input type="hidden" name="completed" value="1" />
	         <input type="hidden" name="type" value="Desk Name Plates and Wall Plates">
	         <input type="hidden" name="your_file_name_plate" value="">
	         <div id="design1">
	         </div>
	         <div id="design2">
	         </div>		   
	         <div id="design3">
	         </div>      
	         <div id="design4">
	         </div>
	         <div id="design5">
	         </div>
	         <div id="design6">
	         </div>
	         <div id="design7">
	         </div>
	         <div id="design8">
	         </div>
	         <div id="design9">
	         </div>
	         <div id="design10">
	         </div>
         	
          <div class="signUpField">
				<div class="signUpFieldLeft" style="height: 150px;"><p style="line-height:normal;">Notes For The Designer:</p>
				  </div>
				<div class="signUpFieldRight" style="height: 150px;"><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 275px; height: 130px;"></textarea></div>
				</div>
          <div class="boxHeader"><span style="float: left;">ORDER DETAILS</span></div>
          <div class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-height">How Many Plates:</div>
            <div class="signUpFieldRight"><input type="text" name="num_plates" value="" style="width: 50px;" class="signupFieldInput" /> quantity</div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-height">How Many Holders:</div>
            <div class="signUpFieldRight"><input type="text" name="num_holders" value="" style="width: 50px;" class="signupFieldInput" /> quantity</div>
          </div>
          <div class="signUpField">
            <div class="signUpFieldLeft order-engraved-label-shipping" style="height: 55px;">Shipping:</div>
            <div class="signUpFieldRight" style="height: 55px;">
            	<input type="radio" name="Delivery" onclick="change_shipping(this.value);"  value="1" checked /> Standard &nbsp;&nbsp;<input onclick="change_shipping(this.value);" type="radio" name="Delivery" value="0" /> Expedited &nbsp;&nbsp; 
                <span class="res-what-this-text">
                 <a class="hotspot" onmouseover="tooltip.show('<br/><strong>Your Timeline Is Important To Us</strong><br/><br/>We deliver on-time, everytime.<br/><br/>We can oftentimes ship out the same or next day, with delivery options as fast as overnight. We accomodate every rush order request with NO rush fees.<br/><br/>You have 2 ways to do this, first, please try calling us at 888-445-7601.  If it is after hours, please submit your order, then email support@bestnamebadges.com with your request and we will reach out to you right away.<br/><br/>');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: normal;" href="javascript:void()">(Need It Fast?)</a>
                 </span>
            	<br />
                 <span style="font-size: 10px; color: #999;" class="order-engraved-orders-text"> Orders under $25 will have a small $3.95 shipping charge</span>
            </div>
          </div>
          <div class="signUpField" id="need_order">
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
        	<h3>Your Plate Configuration:</h3>
        	<br />
			<div><strong>Name Plate:</strong> </div>
  		 	<div id="badge_configuration">
  		 		
  		 	</div>
  		 	<div id="type_label"><strong>Type:</strong> <span id="backing_text"></span> </div>
  		 	<div id="type">
  		 		
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
<?php include_once 'inc/footer.php' ; ?>

