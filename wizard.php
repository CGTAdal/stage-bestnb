<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

$qry = "SELECT styles.*,colors.name as colorname, colors.id as colorid FROM styles LEFT JOIN colors ON (styles.id = colors.styleid) ORDER BY styles.id";
$newstyles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$newstyle = mysql_fetch_assoc($newstyles);

if ($_REQUEST["remove"])
{
	if ($_REQUEST["remove"] == 1)
	{
		unset($_SESSION["logo1"]);
		unset($_SESSION['widthimg1']);
		unset($_SESSION['heightimg1']);
		unset($_SESSION['img1_height']);
		unset($_SESSION['img1_width']);
		unset($_SESSION['left_img1']);
		unset($_SESSION['top_img1']);
	} else {
		unset($_SESSION["logo2"]);
		unset($_SESSION['widthimg2']);
		unset($_SESSION['heightimg2']);
		unset($_SESSION['img2_height']);
		unset($_SESSION['img2_width']);
		unset($_SESSION['left_img2']);
		unset($_SESSION['top_img2']);
	}
}
if ($_SESSION["color"])
{
	$qry = "SELECT * FROM colors WHERE id = ".$_SESSION["color"];
	$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$color2 = mysql_fetch_assoc($colors);
	$_SESSION["backgroundimage"] = $color2["backgroundimage"];
}
if ($_SESSION["styleid"])
{
	$qry = "SELECT * FROM styles WHERE id = ".$_SESSION["styleid"];
	$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$style = mysql_fetch_assoc($styles);
}
?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>

<style>

.resize {
width: auto;
height : 50px;
}

.resize {
width: 50px;
height : auto;
}
</style>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>

<script src="<?php echo $base_url;?>/js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url;?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>/style.css" />-->
<link rel="stylesheet" href="<?php echo $base_url;?>/css/jquery.ui.all.css" />
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.1.10.3.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.core.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.widget.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.mouse.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.resizable.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.draggable.js"></script>
<script src="<?php echo $base_url;?>/js/ui/jquery.ui.droppable.js"></script>

<script type="text/javascript" src="<?php echo $base_url;?>/js/ajaxupload.3.5.js" ></script>

<?php 
	if(isset($_SESSION['logo1']) || !empty($_SESSION['logo1'])){
		$show  = 'block';
	}else{
		$show  = 'none';
	}

	if(isset($_SESSION['logo2']) || !empty($_SESSION['logo2'])){
		$show1  = 'block';
	}else{
		$show1  = 'none';
	}
?>
<?php 
		if(isset($_SESSION["font1"])){
					$font_split = explode(".ttf",$_SESSION["font1"]);
					$font_f1 = 'font-family: '.$font_split[0].';';
				}else {
					$font_f1 = 'arial';
				}
		if(isset($_SESSION["font2"])){
					$font_split = explode(".ttf",$_SESSION["font2"]);
					$font_f2 = 'font-family: '.$font_split[0].';';
				}else {
					$font_f2 = 'arial';
				}		
		if(isset($_SESSION["font3"])){
					$font_split = explode(".ttf",$_SESSION["font3"]);
					$font_f3 = 'font-family: '.$font_split[0].';';
				}else {
					$font_f3 = 'arial';
				}	

?>

<style>
	#ptext1 {color:Black; <?php echo $font_f1;?> z-index:9; float:left; overflow: visible; white-space: nowrap;position: absolute; left: 500px; top: 700px;} 
	#ptext1:hover {cursor:move;border: 1px dashed #000000;}
	#ptext2 {color:Black; <?php echo $font_f2;?> z-index:3; float:left; overflow: visible; white-space: nowrap;position: absolute; left: 500px; top: 720px;}
	#ptext2:hover {cursor:move;border: 1px dashed #000000;}
	#ptext3 {color:Black; <?php echo $font_f3;?> z-index:3; float:left; overflow: visible; white-space: nowrap;position: absolute; left: 500px; top: 740px;}
	#ptext3:hover {cursor:move;border: 1px dashed #000000;}
	#draggable { border: 0px; max-width: 580px; max-height: 310px; padding: 0px; z-index: 2; position:absolute; cursor:move; left:352px; top:651px; display: <?php echo $show;?>}	
	#draggable img{width: 100%; max-width: 580px;max-height: 310px;}	
	#droppable { width: 580px; height: 310px; padding: 0px; position:inherit; left:500px; top:100px; z-index: 1;}
	#draggable:hover {border: 1px dashed #000000;}
	#draggable1 { border: 0px; max-width: 580px; max-height: 310px; padding: 0px; z-index: 2; position:absolute; cursor:move; left:352px; top:651px;display:<?php echo $show1?>;}	
	#draggable1:hover {border: 1px dashed #000000;}
    #draggable1 img{width: 100%; max-width: 580px;max-height: 310px;}	
	#droppable1 { width: 580px; height: 310px; padding: 0px; position:inherit; left:500px; top:100px; z-index: 1;}
	#lg1 img{max-width: 90%;max-height: 100%;}
	#lg2 img{max-width: 90%;max-height: 100%;}
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
	.ui-resizable-helper { border: 1px dotted red; }
	
	@font-face {
		font-family: 'timesbolditalic';
		src: url('fonts/Fonts/timesbolditalic.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/timesbolditalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/timesbolditalic.ttf')  format('truetype'); /* Safari, Android, iOS */
	}

	@font-face {
		font-family: 'GOTHIC';
		src: url('fonts/Fonts/GOTHIC.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/GOTHIC.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/GOTHIC.ttf')  format('truetype'); /* Safari, Android, iOS */
	}
	@font-face {
		font-family: 'GOTHICB';
		src: url('fonts/Fonts/GOTHICB.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/GOTHICB.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/GOTHICB.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-weigth: bold;	 
	}
	
	@font-face {
		font-family: 'GOTHICBI';
		src: url('fonts/Fonts/GOTHICBI.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/GOTHICBI.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/GOTHICBI.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-weigth: bold;
		font-style: italic;
	}
	
	@font-face {
		font-family: 'GOTHICI';
		src: url('fonts/Fonts/GOTHICI.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/GOTHICI.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/GOTHICI.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-style: italic;	 
	}
	@font-face {
		font-family: 'TrajanProBold';
		src: url('fonts/Fonts/TrajanProBold.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/TrajanProBold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/Fonts/TrajanProBold.woff') format('woff'), /* Modern Browsers */
			 url('fonts/TrajanProBold.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-weigth: bold;	 
	}
	@font-face {
		font-family: 'TrajanProRegular';
		src: url('fonts/Fonts/TrajanProRegular.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/TrajanProRegular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/Fonts/TrajanProRegular.woff') format('woff'), /* Modern Browsers */
			 url('fonts/TrajanProRegular.ttf')  format('truetype'); /* Safari, Android, iOS */
	}
	
	@font-face {
		font-family: 'arial';
		src: url('fonts/Fonts/arial.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/arial.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/arial.ttf')  format('truetype'); /* Safari, Android, iOS */
	}
	
	@font-face {
		font-family: 'arialblack';
		src: url('fonts/Fonts/arialblack.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/arialblack.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/arialblack.ttf')  format('truetype'); /* Safari, Android, iOS */
	}
	@font-face {
		font-family: 'arialbold';
		src: url('fonts/Fonts/arialbold.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/arialbold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/arialbold.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-weigth: bold;	 
			 
	}
	
	@font-face {
		font-family: 'arialitalic';
		src: url('fonts/Fonts/arialitalic.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/arialitalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/arialitalic.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-style: italic;			 
	}
	
	@font-face {
		font-family: 'arialbolditalic';
		src: url('fonts/Fonts/arialbolditalic.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/arialbolditalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/arialbolditalic.ttf')  format('truetype'); /* Safari, Android, iOS */
		font-weigth: bold;
		font-style: italic;		 
	}
	
	@font-face {
		font-family: 'times';
		src: url('fonts/Fonts/times.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/times.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/times.ttf')  format('truetype'); /* Safari, Android, iOS */	 
	}
	
	@font-face {
		font-family: 'timesbold';
		src: url('fonts/Fonts/timesbold.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/timesbold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/timesbold.ttf')  format('truetype'); /* Safari, Android, iOS */	 
		font-weigth: bold;	 
	}
	@font-face {
		font-family: 'timesbolditalic';
		src: url('fonts/Fonts/timesbolditalic.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/timesbolditalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/timesbolditalic.ttf')  format('truetype'); /* Safari, Android, iOS */	 
		font-weigth: bold;
		font-style: italic;	 
	}
	
	@font-face {
		font-family: 'timesitalic';
		src: url('fonts/Fonts/timesitalic.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/timesitalic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/timesitalic.ttf')  format('truetype'); /* Safari, Android, iOS */	 
		font-style: italic;	 
	}
	@font-face {
		font-family: 'FREESCPT';
		src: url('fonts/Fonts/FREESCPT.eot'); /* IE9 Compat Modes */
		src: url('fonts/Fonts/FREESCPT.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
			 url('fonts/FREESCPT.ttf')  format('truetype'); /* Safari, Android, iOS */	 
	}
</style>


<?php 
if(isset($_SESSION['logo1']) || !empty($_SESSION['logo1'])){
	$logo1 = $_SESSION['logo1'];
}else{
	$logo1 = '';
}
if(isset($_SESSION['logo2']) || !empty($_SESSION['logo2'])){
	$logo2 = $_SESSION['logo2'];
}else{
	$logo2 = '';
}
?>

<script language="javascript">

function colorchange(which, val)
{
	document.getElementById('ptext'+which).style.color =  '#'+val;	
}

function changecstyle(val)
{
  if (val != 0)
  {
	$("#text").empty();
	var ary=val.split(",");
	url = "ajax/change_style_wizard1.php?style="+ary[0]+"&color="+ary[1];
	
	req_fifo = false;

	try
	{
	req_fifo = new XMLHttpRequest();
	}
	
	catch (e)
	{
	
		try	{
			req_fifo = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				req_fifo = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("You browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
				return false;
			}
		}
	}
	
	if (req_fifo)
	{
		req_fifo.abort();
		req_fifo.onreadystatechange = changedstyle;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}
  }
}

function changedstyle() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }
	var info = req_fifo.responseText;
	document.getElementById('styleinfo').innerHTML=info;
	//document.getElementById('colorname').innerHTML=ary[1];
	var url=document.getElementById('bgr').value;
	document.getElementById('droppable').style.background=url;
	var bgr_img  = document.getElementById('bgr_img').value;
	$("#backgroundimage").val(bgr_img);
	$("#store_bgr_frame").val(bgr_img);
	$("#bg_img").attr("src", 'blanks/'+bgr_img);
	for( i = 0; i < document.frameform.frame.length; i++ )
	{
		if( document.frameform.frame[i].checked == true ){
			frame = document.frameform.frame[i].value;
			img  = bgr_img.split('.');
			if(frame == 'none'){
				new_value =bgr_img;
			}else if(frame == 'gold'){
				new_value = img[0]+'_Gframe.'+img[1];
			}else if(frame == 'silver'){
				new_value = img[0]+'_Sframe.'+img[1];
			}
			
			
			$("#droppable").css('background-image', 'url('+'blanks/'+new_value+') ')
		}
	}
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	document.getElementById('framestyle').innerHTML = '<p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br /><strong>' + frame2 + '</strong></p>';
	
}

function processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame) {

  	url = "<?php echo $base_url?>/ajax/create_image3.php?left=" + left + "&down=" + down + "&left2=" + left2 + "&down2=" + down2 + "&left3=" + left3 + "&down3=" + down3 + "&leftt=" + leftt + "&downt=" + downt + "&img1h=" + img1h + "&img1w=" + img1w + "&img2h=" + img2h + "&img2w=" + img2w + "&leftt2=" + leftt2 + "&downt2=" + downt2 + "&leftt3=" + leftt3 + "&downt3=" + downt3 + "&font1=" + font1 + "&font2=" + font2 + "&font3=" + font3 + "&font1size=" + font1size + "&font2size=" + font2size + "&font3size=" + font3size + "&frame=" + frame;

   //alert(url);
    // branch for native XMLHttpRequest object
	req_fifo = false;

	try
	{
	req_fifo = new XMLHttpRequest();
	}
	
	catch (e)
	{
	
		try	{
			req_fifo = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				req_fifo = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("You browser pro\'lly don\'t support AJAX, get the newest version of Firefox");
				return false;
			}
		}
	}
	
	if (req_fifo)
	{
		req_fifo.abort();
		req_fifo.onreadystatechange = gotname;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}

    
	
}

function gotname() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	//var info = jQuery.trim(req_fifo.responseText);
	var info = req_fifo.responseText;
	//alert(info);
	if (info == "<p>Invalid image file passed to LoadImage</p>")
	{	
		document.getElementById('imageshow').innerHTML="Please Choose a Badge Type";
	} else {
		document.getElementById('imageshow').innerHTML=info;
	}
}

function fontchange(which, size)
{
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("text_fontsize_1").value;
	font2size = document.getElementById("text_fontsize_2").value;
	font3size = document.getElementById("text_fontsize_3").value;
	frame2 = document.getElementById("frame2").value;
	
	if (which == "font1size")
	{
		$("#ptext1").css('font-size',font1size+'px');
	} else if (which == "font2size") {
		$("#ptext2").css('font-size',font2size+'px');
	} else if (which == "font3size") {
		$("#ptext3").css('font-size',font3size+'px');
	} else if (which == "font1") {
		var font_value = $('#font1_select').val();
		if(font_value == 'arial.ttf'){
			$("#ptext1").css('font-family','arial');
		}else if(font_value == 'arialblack.ttf'){
			$("#ptext1").css('font-family','arialblack');
		}else if(font_value == 'arialbold.ttf'){
			$("#ptext1").css('font-family','arialbold');
		}else if(font_value=='arialitalic.ttf'){
			$("#ptext1").css('font-family','arialitalic');
		}else if(font_value == 'arialbolditalic.ttf'){
			$("#ptext1").css('font-family','arialbolditalic');
		}else if(font_value == 'times.ttf'){
			$("#ptext1").css('font-family','times');
		}else if(font_value == 'timesbold.ttf'){
			$("#ptext1").css('font-family','timesbold');
		}else if(font_value=='timesbolditalic.ttf'){
			$("#ptext1").css('font-family','timesbolditalic');
		}else if(font_value=='timesitalic.ttf'){
			$("#ptext1").css('font-family','timesitalic');
		}else if(font_value== 'FREESCPT.ttf'){
			$("#ptext1").css('font-family','FREESCPT');
		}else if(font_value== 'GOTHIC.ttf'){
			$("#ptext1").css('font-family','GOTHIC');
		}else if(font_value== 'GOTHICB.ttf'){
			$("#ptext1").css('font-family','GOTHICB');
		}else if(font_value== 'GOTHICBI.ttf'){
			$("#ptext1").css('font-family','GOTHICBI');
		}else if (font_value== 'GOTHICI.ttf'){
			$("#ptext1").css('font-family','GOTHICI');
		}
	} else if (which == "font2") {
		var font_value = $('#font2_select').val();
		if(font_value == 'arial.ttf'){
			$("#ptext2").css('font-family','arial');
		}else if(font_value == 'arialblack.ttf'){
			$("#ptext2").css('font-family','arialblack');
		}else if(font_value == 'arialbold.ttf'){
			$("#ptext2").css('font-family','arialbold');
		}else if(font_value=='arialitalic.ttf'){
			$("#ptext2").css('font-family','arialitalic');
		}else if(font_value == 'arialbolditalic.ttf'){
			$("#ptext2").css('font-family','arialbolditalic');
		}else if(font_value == 'times.ttf'){
			$("#ptext2").css('font-family','times');
		}else if(font_value == 'timesbold.ttf'){
			$("#ptext2").css('font-family','timesbold');
		}else if(font_value=='timesbolditalic.ttf'){
			$("#ptext2").css('font-family','timesbolditalic');
		}else if(font_value=='timesitalic.ttf'){
			$("#ptext2").css('font-family','timesitalic');
		}else if(font_value== 'FREESCPT.ttf'){
			$("#ptext2").css('font-family','FREESCPT');
		}else if(font_value== 'GOTHIC.ttf'){
			$("#ptext2").css('font-family','GOTHIC');
		}else if(font_value== 'GOTHICB.ttf'){
			$("#ptext2").css('font-family','GOTHICB');
		}else if(font_value== 'GOTHICBI.ttf'){
			$("#ptext2").css('font-family','GOTHICBI');
		}else if (font_value== 'GOTHICI.ttf'){
			$("#ptext2").css('font-family','GOTHICI');
		}
	} else if (which == "font3") {
		var font_value = $('#font3_select').val();
		if(font_value == 'arial.ttf'){
			$("#ptext3").css('font-family','arial');
		}else if(font_value == 'arialblack.ttf'){
			$("#ptext3").css('font-family','arialblack');
		}else if(font_value == 'arialbold.ttf'){
			$("#ptext3").css('font-family','arialbold');
		}else if(font_value=='arialitalic.ttf'){
			$("#ptext3").css('font-family','arialitalic');
		}else if(font_value == 'arialbolditalic.ttf'){
			$("#ptext3").css('font-family','arialbolditalic');
		}else if(font_value == 'times.ttf'){
			$("#ptext3").css('font-family','times');
		}else if(font_value == 'timesbold.ttf'){
			$("#ptext3").css('font-family','timesbold');
		}else if(font_value=='timesbolditalic.ttf'){
			$("#ptext3").css('font-family','timesbolditalic');
		}else if(font_value=='timesitalic.ttf'){
			$("#ptext3").css('font-family','timesitalic');
		}else if(font_value== 'FREESCPT.ttf'){
			$("#ptext3").css('font-family','FREESCPT');
		}else if(font_value== 'GOTHIC.ttf'){
			$("#ptext3").css('font-family','GOTHIC');
		}else if(font_value== 'GOTHICB.ttf'){
			$("#ptext3").css('font-family','GOTHICB');
		}else if(font_value== 'GOTHICBI.ttf'){
			$("#ptext3").css('font-family','GOTHICBI');
		}else if (font_value== 'GOTHICI.ttf'){
			$("#ptext3").css('font-family','GOTHICI');
		
		}
	}	
	//processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
}

function framechange(value)
{
	if($("#changestyle").val() == 0){
		$("#text").text('Please Choose a Badge Type');
	}
	for( i = 0; i < document.frameform.frame.length; i++ )
	{
		if( document.frameform.frame[i].checked == true ){
			frame = document.frameform.frame[i].value;
			img  = value.split('.');
			if(frame == 'none'){
				new_value =value;
			}else if(frame == 'gold'){
				new_value = img[0]+'_Gframe.'+img[1];
			}else if(frame == 'silver'){
				new_value = img[0]+'_Sframe.'+img[1];
			}
            //document.getElementById("droppable").style.backgroundImage.src = " ";
            //$("#droppable").css('background', ''); 		
			//$("#droppable").css('background', 'url("blanks/'+new_value+'") ')
            
            document.getElementById("droppable").style.backgroundImage = 'url(blanks/'+new_value+')';
		}
	}
	document.getElementById('framestyle').innerHTML = '<p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br /><strong>' + frame + '</strong></p>';
	document.getElementById("frame2").value = frame;
}

$(document).ready(function(){
	font1 = document.getElementById("font1_select").value;
	font2 = document.getElementById("font2_select").value;
	font3 = document.getElementById("font3_select").value;
	font1size =document.getElementById("text_fontsize_1").value;
	font2size = document.getElementById("text_fontsize_2").value;
	font3size = document.getElementById("text_fontsize_3").value;
	frame2 = document.getElementById("frame2").value;
	
	$("#ptext1").css('font-size',font1size+'px');
	$("#ptext2").css('font-size',font2size+'px');
	$("#ptext3").css('font-size',font3size+'px');
		
	var font_value = $('#font1_select').val();
	if(font_value == 'arial.ttf'){
		$("#ptext1").css('font-family','arial');
	}else if(font_value == 'arialblack.ttf'){
		$("#ptext1").css('font-family','arialblack');
	}else if(font_value == 'arialbold.ttf'){
		$("#ptext1").css('font-family','arialbold');
	}else if(font_value=='arialitalic.ttf'){
		$("#ptext1").css('font-family','arialitalic');
	}else if(font_value == 'arialbolditalic.ttf'){
		$("#ptext1").css('font-family','arialbolditalic');
	}else if(font_value == 'times.ttf'){
		$("#ptext1").css('font-family','times');
	}else if(font_value == 'timesbold.ttf'){
		$("#ptext1").css('font-family','timesbold');
	}else if(font_value=='timesbolditalic.ttf'){
		$("#ptext1").css('font-family','timesbolditalic');
	}else if(font_value=='timesitalic.ttf'){
		$("#ptext1").css('font-family','timesitalic');
	}else if(font_value== 'FREESCPT.ttf'){
			$("#ptext1").css('font-family','FREESCPT');
	}else if(font_value== 'GOTHIC.ttf'){
		$("#ptext1").css('font-family','GOTHIC');
	}else if(font_value== 'GOTHICB.ttf'){
		$("#ptext1").css('font-family','GOTHICB');
	}else if(font_value== 'GOTHICBI.ttf'){
		$("#ptext1").css('font-family','GOTHICBI');
	}else if (font_value== 'GOTHICI.ttf'){
		$("#ptext1").css('font-family','GOTHICI');
	}
		
	var font_value = $('#font2_select').val();
	if(font_value == 'arial.ttf'){
		$("#ptext2").css('font-family','arial');
	}else if(font_value == 'arialblack.ttf'){
		$("#ptext2").css('font-family','arialblack');
	}else if(font_value == 'arialbold.ttf'){
		$("#ptext2").css('font-family','arialbold');
	}else if(font_value=='arialitalic.ttf'){
		$("#ptext2").css('font-family','arialitalic');
	}else if(font_value == 'arialbolditalic.ttf'){
		$("#ptext2").css('font-family','arialbolditalic');
	}else if(font_value == 'times.ttf'){
		$("#ptext2").css('font-family','times');
	}else if(font_value == 'timesbold.ttf'){
		$("#ptext2").css('font-family','timesbold');
	}else if(font_value=='timesbolditalic.ttf'){
		$("#ptext2").css('font-family','timesbolditalic');
	}else if(font_value=='timesitalic.ttf'){
		$("#ptext2").css('font-family','timesitalic');
	}else if(font_value== 'FREESCPT.ttf'){
		$("#ptext2").css('font-family','FREESCPT');
	}else if(font_value== 'GOTHIC.ttf'){
		$("#ptext2").css('font-family','GOTHIC');
	}else if(font_value== 'GOTHICB.ttf'){
		$("#ptext2").css('font-family','GOTHICB');
	}else if(font_value== 'GOTHICBI.ttf'){
		$("#ptext2").css('font-family','GOTHICBI');
	}else if (font_value== 'GOTHICI.ttf'){
		$("#ptext2").css('font-family','GOTHICI');
	}
	var font_value = $('#font3_select').val();
	if(font_value == 'arial.ttf'){
		$("#ptext3").css('font-family','arial');
	}else if(font_value == 'arialblack.ttf'){
		$("#ptext3").css('font-family','arialblack');
	}else if(font_value == 'arialbold.ttf'){
		$("#ptext3").css('font-family','arialbold');
	}else if(font_value=='arialitalic.ttf'){
		$("#ptext3").css('font-family','arialitalic');
	}else if(font_value == 'arialbolditalic.ttf'){
		$("#ptext3").css('font-family','arialbolditalic');
	}else if(font_value == 'times.ttf'){
		$("#ptext3").css('font-family','times');
	}else if(font_value == 'timesbold.ttf'){
		$("#ptext3").css('font-family','timesbold');
	}else if(font_value=='timesbolditalic.ttf'){
		$("#ptext3").css('font-family','timesbolditalic');
	}else if(font_value=='timesitalic.ttf'){
		$("#ptext3").css('font-family','timesitalic');
	}else if(font_value== 'FREESCPT.ttf'){
		$("#ptext3").css('font-family','FREESCPT');
	}else if(font_value== 'GOTHIC.ttf'){
		$("#ptext3").css('font-family','GOTHIC');
	}else if(font_value== 'GOTHICB.ttf'){
		$("#ptext3").css('font-family','GOTHICB');
	}else if(font_value== 'GOTHICBI.ttf'){
		$("#ptext3").css('font-family','GOTHICBI');
	}else if (font_value== 'GOTHICI.ttf'){
		$("#ptext3").css('font-family','GOTHICI');
	}
	var logo1 = '<?php echo $_SESSION['logo1'];?>';
	var logo2 = '<?php echo $_SESSION['logo2'];?>';
	if(logo1 !=''){
		$("#text").empty();
	}
	if(logo2 !=''){
		$("#text").empty();
	}
	if($("#changestyle").val()!=0){
		$("#text").empty();
	}else{
		$("#text").text('Please Choose a Badge Type');
	}
	$("#continues").click(function(){	  
		var img1_height = $("#draggable").height();
		var img1_width	= $("#draggable").width();
		var img2_height = $("#draggable1").height();
		var img2_width	= $("#draggable1").width();	
		for( i = 0; i < document.frameform.frame.length; i++ )
		{
			if( document.frameform.frame[i].checked == true )
			frame = document.frameform.frame[i].value;
		}
		var font1_select = $("#font1_select").val();
		var font2_select = $("#font2_select").val();
		var font3_select = $("#font3_select").val();
		var backgroundimage = $("#backgroundimage").val();

		var text_line1 = $("#txtText1").val();
		var text_line2 = $("#txtText2").val();
		var text_line3 = $("#txtText3").val();
		var text_fontsize_1 =  $("#text_fontsize_1").val();
		var text_fontsize_2 =  $("#text_fontsize_2").val();
		var text_fontsize_3 =  $("#text_fontsize_3").val();

		// calc postioin of logo1.
		var e1 = document.getElementById('draggable');
		var position1 = {x:0,y:0};
		while (e1)
		{
			position1.x += e1.offsetLeft;
			position1.y += e1.offsetTop;
			e1 = e1.offsetParent;
		}
		// calc postioin of logo2.
		var e2 = document.getElementById('draggable1');
		var position2 = {x:0,y:0};
		while (e2)
		{
			position2.x += e2.offsetLeft;
			position2.y += e2.offsetTop;
			e2 = e2.offsetParent;
		}
		// calc width and heigth of background menu.
		var bg_img_width  = $("#bg_img").width();
		var bg_img_height = $("#bg_img").height();
		// calc width and heigth of div droppable
		var droppable_width    = $("#droppable").width();
		var droppable_heigth    = $("#droppable").height();
		// calc position of logo1 with background image.
		// we will use position of logo1 sub with div drop and sub (sub of drop-height of background)/2 = distance beetwin logo1 and background image.
		//alert($("#droppable").position().left);
		var left_img1 = position1.x - $("#droppable").position().left - (droppable_width - bg_img_width)/2;
		if(left_img1 < 0){
			left_img1 = 5;
		}else{
			left_img1 = left_img1;
		}
		var top_img1 =  position1.y - $("#droppable").position().top - (droppable_heigth - bg_img_height)/2;
		
		if(top_img1 < 0){
			top_img1 = 5;
		}else{
			top_img1 = top_img1;
		}
		// calc position of logo2 with background image
		var left_img2 = position2.x - $("#droppable").position().left - (droppable_width - bg_img_width)/2;
		
		if(left_img2 < 0){
			left_img2 = 50;
		}else{
			left_img2 = left_img2;
		}
		var top_img2 =  position2.y - $("#droppable").position().top - (droppable_heigth - bg_img_height)/2;
		if(top_img2 < 0){
			top_img2 = 5;
		}else{
			top_img2 = top_img2;
		}
		//calc position of text1 with backgroud image.
		var e3 = document.getElementById('ptext1');
		var position3 = {x:0,y:0};
		while (e3)
		{
			position3.x += e3.offsetLeft;
			position3.y += e3.offsetTop;
			e3 = e3.offsetParent;
		}
		var text1_left = position3.x - $("#droppable").position().left - (droppable_width - bg_img_width)/2;
		var text1_top  = position3.y - $("#droppable").position().top + (droppable_heigth - bg_img_height)/2;
		//return false;

		//calc position of text2 with background image.
		var e4 = document.getElementById('ptext2');
		var position4 = {x:0,y:0};
		while (e4)
		{
			position4.x += e4.offsetLeft;
			position4.y += e4.offsetTop;
			e4 = e4.offsetParent;
		}
		var text2_left = position4.x - $("#droppable").position().left - (droppable_width - bg_img_width)/2;
		var text2_top  = position4.y - $("#droppable").position().top + (droppable_heigth - bg_img_height)/2;

		//calc position of text3 with background image.
		var e5 = document.getElementById('ptext3');
		var position5 = {x:0,y:0};
		while (e5)
		{
			position5.x += e5.offsetLeft;
			position5.y += e5.offsetTop;
			e5 = e5.offsetParent;
		}
		var text3_left = position5.x - $("#droppable").position().left - (droppable_width - bg_img_width)/2;
		var text3_top  = position5.y - $("#droppable").position().top + (droppable_heigth - bg_img_height)/2;
	
		// calc color for text
		
		var font1_color = $("#badgetext1color_1").val();
		var font2_color = $("#badgetext2color_2").val();
		var font3_color = $("#badgetext3color_3").val();

		
		//calc position (top and left) of div draggable and save to a session
		
		var left_draggable = $("#draggable").css('left');
		var top_draggable  = $("#draggable").css('top');	
		
		//calc position (top and left) of div draggable1 and save to a session
		
		var left_draggable1 = $("#draggable1").css('left');
		var top_draggable1  = $("#draggable1").css('top');	
		
		// calc postion (top and left of text1) and store in a session
		
		var left_text1 		= $("#ptext1").css('left');
		var top_text1 		= $("#ptext1").css('top');
		
		// calc postion (top and left of text2) and store in a session
		var left_text2 		= $("#ptext2").css('left');
		var top_text2 		= $("#ptext2").css('top');
		// calc postion (top and left of text3) and store in a session
		var left_text3 		= $("#ptext3").css('left');
		var top_text3 		= $("#ptext3").css('top');
		
	
		 
		 <?php 
		 if(!isset($_SESSION['widthimg1'])){
		 ?>
			var drag_img1_width  = $("#widthimg1").val();
			var drag_img1_height = $("#heightimg1").val();		
		<?php }else{?>
			var drag_img1_width  = parseInt('<?php echo $_SESSION['widthimg1'];?>');
			var drag_img1_height = parseInt('<?php echo $_SESSION['heightimg1'];?>');		
		<?php
		}?>
		<?php 
		 if(!isset($_SESSION['widthimg2'])){
		 ?>
			var drag_img2_width  = $("#widthimg2").val();
			var drag_img2_height = $("#heightimg2").val();		
		<?php }else{?>
			var drag_img2_width  = parseInt('<?php echo $_SESSION['widthimg2'];?>');
			var drag_img2_height = parseInt('<?php echo $_SESSION['heightimg2'];?>');		
		<?php
		}?>
        
        msg = "You have the following errors:\n";
		if (document.getElementById('stylename').value == "")
		{
			msg = msg + "Please Enter a Style Name\n";
		}
		
		if (document.getElementById('changestyle').value == "0")
		{
			msg = msg + "Please Choose a Badge Style\n";
		}
		//alert('aaa');		
		if (msg != "You have the following errors:\n")
		{
			alert(msg);
			return false;
		 } 
        
		$.ajax({
				 url : "<?php echo $base_url?>/ajax/create_image5.php",
				 data: {
					img1_height:$("#draggable").height(),
					img1_width:$("#draggable").width(),
					img2_height:$("#draggable1").height(),
					img2_width:$("#draggable1").width(),
					frame:frame,
					logo1: '<?php echo $_SESSION['logo1'];?>',
					logo2: '<?php echo $logo2;?>',
					text1: text_line1,
					text2:text_line2,
					text3:text_line3,
					font1_select: font1_select,
					font2_select: font2_select,
					font3_select: font3_select,
					backgroundimage: backgroundimage,
					text_fontsize_1: text_fontsize_1,
					text_fontsize_2: text_fontsize_2,
					text_fontsize_3:text_fontsize_3,
					left_img1: left_img1,
					top_img1: top_img1,
					left_img2: left_img2,
					top_img2: top_img2,
					text1_x:text1_left  ,
					text1_y:text1_top ,
					text2_x: text2_left,
					text2_y: text2_top,
					text3_x: text3_left,
					text3_y: text3_top,
					font1_color: font1_color,
					font2_color:font2_color,
					font3_color:font3_color,
					left_draggable: left_draggable,
					top_draggable: top_draggable,
					left_draggable1: left_draggable1,
					top_draggable1: top_draggable1,
					left_text1: left_text1,
					top_text1:top_text1,
					left_text2: left_text2,
					top_text2: top_text2,
					left_text3: left_text3,
					top_text3: top_text3,
					dome: $("#dome").val(),
					widthimg1: drag_img1_width,
					heightimg1: drag_img1_height,
					widthimg2: drag_img2_width,
					heightimg2: drag_img2_height
				 },
				 success: function(data) {				    
                    document.forms["addname"].submit();
				 }
			});	
	});
	
	$("#ptext1").css('font-family','<?php echo $font_f1; ?>');
	$("#ptext2").css('font-family','<?php echo  $font_f2; ?>');
	$("#ptext3").css('font-family','<?php echo $font_f3; ?>');
	
});
function add_dome(value)
{
	$("#dome").val(value);
}
function add_style(element,value)
{
	document.getElementById(element).style.display = "block";	
	document.getElementById(element).style.height = value+'px';	
	document.getElementById(element).style.lineHeight = value+'px';	
}
function addText(id_text,id_assign) {  
	var str = document.getElementById(id_text).value;
	//alert(str);
	if (str != "")
	{
		document.getElementById(id_assign).innerHTML = str;
		document.getElementById(id_assign).style.display = "block";					
	}
	else {           
		document.getElementById(id_assign).style.display = "none";
		//alert("No Text to Add");
	}
}
var timerHandle = null;
function updatetext(captionID)
{
	if(timerHandle != null) clearTimeout(timerHandle);
	timerHandle = setTimeout(function(){ updateTextCaption(captionID);}, 500);
}

function updateTextCaption(captionID)
{
	//alert(text);
	var currentCaption = $("#txtText"+captionID).val();
	if(currentCaption != null)
	{
		var text = $("#txtText"+captionID).val();
		//var fontEl = document.getElementById("main__badgeform__font"+(captionID+1));
		var font   = $("#font"+captionID+"_select").val();
		//var sizeEl = document.getElementById("main__badgeform__fontsize"+(captionID+1));
		var size   = $("#text_fontsize_"+captionID).val();
		//var colorEl = document.getElementById("main__badgeform__color");
		var color = $("#badgetext1color_"+captionID).val();
		
		var width  = $("#ptext"+captionID).width();
		//alert(width);
		var height  = $("#ptext"+captionID).height();
		var url ='<?php echo $base_url;?>/image.php';
		url = url+'?fontColor='+color;		
		url = url+'&fontSize='+size;
		url = url+'&fontFile='+font;
		url = url+'&fontText='+text;
		
		
		document.getElementById('ptext'+captionID).innerHTML = '<img src="'+url+'" border="1">';
	}
}

</script>
<style>
.layer1_class { 
      z-index:999;
      position:fixed;
      top: 0;
      left: 0;
      background-color:#000;
      border:none;
      filter:alpha(opacity=80);
      -moz-opacity: 80;
      opacity: 0.8;
      height:100%;
      width:100%;
      text-align: center;
}
.layer1_class img {
    top: 40%;
    
    position: relative;
}
* html .layer1_class { /* ie6 hack */
     position: absolute;
     height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');
}
.layer2_class { position: absolute; z-index: 2; top: 10px; left: 10px; visibility: hidden }
</style>
<div id="layer1" class="layer1_class">
      <img src="images/loading1.gif" />
    </div>
    <div id="content" class="wizard-newcontent">
    <div id="mainContentFull">
	  <h2 style="margin-bottom: 20px">CREATE YOUR BADGE TEMPLATE</h2>    
	  <hr noshade size="1" width="100%" align="center" style="margin-bottom: 15px;background: #CCCCCC;" />
	  <div style="margin-bottom: 15px;font-family: Arial;" class="add-names-step-outer">	
		 <div class="add-names-justsimple-text"><h3 style="font-family:Arial black;font-size: 15px;float: right; padding-right: 15px;text-shadow: 1px 0px #000;">Just 3 Simple Steps:</h3></div> <div class="step stepactive"><h1>Step 1:</h1> Create A Badge Template</div><div style="margin-left: -22px;" class="step"><h1>Step 2:</h1> <div style="weight: 1px;"></div> Add Names And Review Pricing</div><div style="margin-left: -22px;"  class="step"><h1>Step 3:</h1> Submit Your Order</div>
	  </div>
      <div id="logoBox" style="width: 100%">
		<div class="boxHeader"><span style="float: left;">Create Your Design</span></div>
		<div class="boxSub" style="border-bottom: none;">
			<div class="boxSub2" style="display: none;"></div>
		</div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="wizardnew-topleft">
			   <div class="signUpField wizardnew-topleft-label1">
                <div class="signUpFieldLeft wizardnew-left-label"   >
                 Select Your Badge:
                </div>
                <div class="signUpFieldRight wizardnew-responsive-logoouter"  style="width:324px;padding-right:10px;">
                  
							<select name="changestyle" id="changestyle" onchange="changecstyle(this.value);" style="width: 100%; height: 22px;" class="signupFieldInput">
								<option value="0">Choose One...</option>
								<?php do { ?>
								<option value="<?php echo $newstyle["id"].",".$newstyle["colorid"]; ?>" <?php if ($newstyle["id"] == $_SESSION["styleid"] && $newstyle["colorid"] == $_SESSION["color"]) {?>selected<?php } ?>><?php echo $newstyle["name"]." - ".$newstyle["size"]." - ".$newstyle["colorname"];?></option>
								<?php } while ($newstyle = mysql_fetch_assoc($newstyles)); ?>
							</select>
						
                </div>
               </div>
               <div class="signUpField wizardnew-topleft-label2">
				<div class="signUpFieldLeft wizardnew-left-label"   >
						
						Add Your Logo(s):
				</div>
				<div class="signUpFieldRight wizardnew-responsive-logoouter"  style="width:324px;padding-right:10px;">
						
						
						<div  class="wizardnew-logoouter">
							Logo 1:  <?php if ($_SESSION["logo1"]) { ?> <a href="wizard.php?remove=1" style="font-size: 11px;">remove image</a><?php } else { ?>(<a href="logo-upload.php?logo=1&wizard=wizard" style="font-size: 11px;" title="Upload Logo 1" rel="gb_page_center[400, 200]">click to upload</a>)<?php } ?>
						</div>
						<div class="wizardnew-logoouter-right">
							Logo 2: <?php if ($_SESSION["logo2"]) { ?><a href="wizard.php?remove=2" style="font-size: 11px;">remove image</a><?php } else { ?>(<a href="logo-upload.php?logo=2&wizard=wizard" style="font-size: 11px;" title="Upload Logo 2" rel="gb_page_center[400, 200]">click to upload</a>)<?php } ?>				  
						<div style="clear: both; margin-top: 10px;" class="wizardButtons"></div>
						</div>
						
				</div>
               </div> 
		      </div> 		
                <div class="signUpFieldRight" style="float:left;padding-left: 10px;"> 		
					<div  class="wizardnewbades-style">
						<div id="styleinfo">  
							 <div id="badgestyle">
								<p style="float: left; font-size: 10px; width: 200px; text-align: left;">Badge Style:<br />
								 <strong><?php echo $style["size"]." - ".$style["name"]; ?></strong>
								 </p>
							 </div>
							 <div id="framestyle"><p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
							  <strong><?php if(isset($_SESSION['frame'])){echo $_SESSION['frame'];}else { echo 'none';}?></strong>
							  </p>
							 </div>
							 <div id="colorname">
								  <p style="float: right; font-size: 10px; width: 75px; text-align: left;">Color:<br />
								  <strong><?php echo $color2["name"]; ?></strong>
								  </p>
							 </div>
						</div> 
					</div>
				</div>
          </div>
          <div class="signUpField wizardnew-addtext1" >
            <div class="signUpFieldLeft" style="height: 30px;">Add Text 1:</div>
	    
			<span id="lblMessage" style="color:Blue;"></span>
				<div  class="wizardnew-addtextbox"><input id="txtText1" type="text" value="<?php if(isset( $_SESSION['text1'])){ echo $_SESSION['text1'];}else{ echo " ";}?>" style="width: 170px;margin-left:13px;" /></div>

				<div  class="wizardnew-addbutton"><input id="btnText1" type="button" value="Add/Update Text" onclick="addText('txtText1','ptext1');" /></div>
				<div  class="wizardnew-selectdiv"> 
					<select id="font1_select" name="font1post" onchange="javascript:fontchange('font1',this.value);" style="height: 21px; width: 140px;" class="signupFieldInput">
						<option value="arial.ttf">Arial Normal</option>
						<option value="arialblack.ttf" <?php if ($_SESSION["font1"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
						<option value="arialbold.ttf" <?php if ($_SESSION["font1"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
						<option value="arialitalic.ttf" <?php if ($_SESSION["font1"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
						<option value="arialbolditalic.ttf" <?php if ($_SESSION["font1"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
						<option value="times.ttf" <?php if ($_SESSION["font1"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
						<option value="timesbold.ttf" <?php if ($_SESSION["font1"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
						<option value="timesbolditalic.ttf" <?php if ($_SESSION["font1"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
						<option value="timesitalic.ttf" <?php if ($_SESSION["font1"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
						
						<option value="FREESCPT.ttf" <?php if ($_SESSION["font1"] == "FREESCPT.ttf") { ?> selected="selected"<?php } ?>>Free Script</option>
						<option value="GOTHIC.ttf" <?php if ($_SESSION["font1"] == "GOTHIC.ttf") { ?> selected="selected"<?php } ?>>Century Gothic</option>
						<option value="GOTHICB.ttf" <?php if ($_SESSION["font1"] == "GOTHICB.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold</option>
						<option value="GOTHICBI.ttf" <?php if ($_SESSION["font1"] == "GOTHICBI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold Italic</option>
						<option value="GOTHICI.ttf" <?php if ($_SESSION["font1"] == "GOTHICI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Italic</option>					
						
					</select>&nbsp;&nbsp;
				</div>
				<div  class="wizardnew-numberselect">
					<select id="text_fontsize_1" name="font1sizec" onchange="javascript:fontchange('font1size', this.value);add_style('ptext1',this.value);" style="height: 21px;" class="signupFieldInput">
						<option value="20" <?php if ($_SESSION["font1size"] == 20) {?>selected <?php } ?>>10</option>
						<option value="22" <?php if ($_SESSION["font1size"] == 22) {?>selected <?php } ?>>12</option>
						<option value="24" <?php if ($_SESSION["font1size"] == 24) {?> selected <?php } ?>>14</option>
						<option value="26" <?php if ($_SESSION["font1size"] == 26) {?> selected <?php } ?>>16</option>
						<option value="28" <?php if ($_SESSION["font1size"] == 28) {?> selected <?php } ?>>18</option>
						<option value="30" <?php if ($_SESSION["font1size"] == 30) {?> selected <?php } ?>>20</option>
						<option value="32" <?php if ($_SESSION["font1size"] == 32) {?> selected <?php } ?>>22</option>
						<option value="35" <?php if ($_SESSION["font1size"] == 35) {?> selected <?php } ?>>25</option>
						<option value="40" <?php if ($_SESSION["font1size"] == 40) {?> selected <?php } ?>>30</option>
						<option value="46" <?php if ($_SESSION["font1size"] == 46) {?> selected <?php } ?>>36</option>
						<option value="52" <?php if ($_SESSION["font1size"] == 52) {?> selected <?php } ?>>42</option>
						<option value="58" <?php if ($_SESSION["font1size"] == 58) {?> selected <?php } ?>>48</option>
						<option value="70" <?php if ($_SESSION["font1size"] == 70) {?> selected <?php } ?>>60</option>
						<option value="82" <?php if ($_SESSION["font1size"] == 82) {?> selected<?php } ?>>72</option>
						<option value="98" <?php if ($_SESSION["font1size"] == 98) {?> selected<?php } ?>>88</option>
					</select>&nbsp;&nbsp;
				</div>
				<div  class="wizardnew-colordiv">
					<div style="width: 1px;float: left;padding-top: 2px;">Color:</div><div id="colorSelector1"><div style="background-color:  <?php if ($_SESSION["font1color"]) { ?>#<?php echo $_SESSION["font1color"]; ?><?php } else { ?> black <?php } ?>"></div></div>
				</div>
				 <input   type="hidden" name="badgetext1color" id="badgetext1color_1" <?php if (isset($_SESSION["font1color"])) { ?>value="<?php echo $_SESSION["font1color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" />
				<div style="clear:both;"></div>
          </div>
		  <div style="clear:both;"></div>
          <div class="signUpField wizardnew-addtext1" >
            <div class="signUpFieldLeft" style="height: 30px;">Add Text 2:</div>
			<span id="lblMessage" style="color:Blue;"></span>
				<div class="wizardnew-addtextbox"><input id="txtText2" value="<?php if(isset( $_SESSION['text2'])){ echo $_SESSION['text2'];}else{ echo " ";}?>" type="text" style="width: 170px;margin-left:13px" />
				</div>
				<div class="wizardnew-addbutton">
				<input id="btnText2" type="button" value="Add/Update Text" onclick="addText('txtText2','ptext2');" />
				</div>
				<div class="wizardnew-selectdiv"> 
				<select id="font2_select" name="font2post" onchange="javascript:fontchange('font2',this.value);" style="height: 21px; width: 140px;" class="signupFieldInput">
					<option value="arial.ttf">Arial Normal</option>
					<option value="arialblack.ttf" <?php if ($_SESSION["font2"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
					<option value="arialbold.ttf" <?php if ($_SESSION["font2"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
					<option value="arialitalic.ttf" <?php if ($_SESSION["font2"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
					<option value="arialbolditalic.ttf" <?php if ($_SESSION["font2"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
					<option value="times.ttf" <?php if ($_SESSION["font2"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
					<option value="timesbold.ttf" <?php if ($_SESSION["font2"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
					<option value="timesbolditalic.ttf" <?php if ($_SESSION["font2"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
					<option value="timesitalic.ttf" <?php if ($_SESSION["font2"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
					
					<option value="FREESCPT.ttf" <?php if ($_SESSION["font2"] == "FREESCPT.ttf") { ?> selected="selected"<?php } ?>>Free Script</option>
					<option value="GOTHIC.ttf" <?php if ($_SESSION["font2"] == "GOTHIC.ttf") { ?> selected="selected"<?php } ?>>Century Gothic</option>
					<option value="GOTHICB.ttf" <?php if ($_SESSION["font2"] == "GOTHICB.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold</option>
					<option value="GOTHICBI.ttf" <?php if ($_SESSION["font2"] == "GOTHICBI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold Italic</option>
					<option value="GOTHICI.ttf" <?php if ($_SESSION["font2"] == "GOTHICI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Italic</option>	
					
				</select>&nbsp;&nbsp;
				</div>
				<div class="wizardnew-numberselect">
				<select id="text_fontsize_2" name="font2sizec" onchange="javascript:fontchange('font2size', this.value);add_style('ptext2',this.value);" style="height: 21px;" class="signupFieldInput">
					<option value="20" <?php if ($_SESSION["font2size"] == 20) {?>selected<?php } ?>>10</option>
					<option value="22" <?php if ($_SESSION["font2size"] == 22) {?>selected<?php } ?>>12</option>
					<option value="24" <?php if ($_SESSION["font2size"] == 24) {?> selected<?php } ?>>14</option>
					<option value="26" <?php if ($_SESSION["font2size"] == 26) {?> selected<?php } ?>>16</option>
					<option value="28" <?php if ($_SESSION["font2size"] == 28) {?> selected<?php } ?>>18</option>
					<option value="30" <?php if ($_SESSION["font2size"] == 30) {?> selected<?php } ?>>20</option>
					<option value="32" <?php if ($_SESSION["font2size"] == 32) {?> selected<?php } ?>>22</option>
					<option value="35" <?php if ($_SESSION["font2size"] == 35) {?> selected<?php } ?>>25</option>
					<option value="40" <?php if ($_SESSION["font2size"] == 40) {?> selected<?php } ?>>30</option>
					<option value="46" <?php if ($_SESSION["font2size"] == 46) {?> selected<?php } ?>>36</option>
					<option value="52" <?php if ($_SESSION["font2size"] == 52) {?> selected<?php } ?>>42</option>
					<option value="58" <?php if ($_SESSION["font2size"] == 58) {?> selected<?php } ?>>48</option>
					<option value="70" <?php if ($_SESSION["font2size"] == 70) {?> selected<?php } ?>>60</option>
					<option value="82" <?php if ($_SESSION["font2size"] == 82) {?> selected<?php } ?>>72</option>
					<option value="98" <?php if ($_SESSION["font2size"] == 98) {?> selected<?php } ?>>88</option>
				</select>&nbsp;&nbsp;
				</div>
				<div class="wizardnew-colordiv">
				<div style="width: 1px;float: left;padding-top: 2px;">Color:</div><div id="colorSelector2"><div style="background-color: <?php if ($_SESSION["font2color"]) { ?>#<?php echo $_SESSION["font2color"]; ?><?php } else { ?> black <?php } ?>"></div></div>
				</div>
				<div style="clear:both;"></div>
          </div>
		  <div style="clear:both;"></div>
		  <div style="position: absolute; top: -2000px; left:2000px;"><input   type="hidden" name="badgetext2color" id="badgetext2color_2" <?php if (isset($_SESSION["font2color"])) { ?>value="<?php echo $_SESSION["font2color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" onchange="javascript:colorchange('2', this.value);" /></div> 
          <div class="signUpField wizardnew-addtext1" >
            <div class="signUpFieldLeft" style="height: 30px;">Add Text 3:</div>
			<span id="lblMessage" style="color:Blue;"></span>
				<div class="wizardnew-addtextbox"><input id="txtText3" value="<?php if(isset( $_SESSION['text3'])){ echo $_SESSION['text3'];}else { echo " ";}?>" type="text" style="width: 170px;margin-left:13px" />
				</div>
				<div class="wizardnew-addbutton"><input id="btnText2" type="button" value="Add/Update Text" onclick="addText('txtText3','ptext3');" />
				</div>
				<div class="wizardnew-selectdiv"> 
				 <select name="font3post" id="font3_select" onchange="javascript:fontchange('font3',this.value);" style="height: 21px; width: 140px;" class="signupFieldInput">
					<option value="arial.ttf">Arial Normal</option>
					<option value="arialblack.ttf" <?php if ($_SESSION["font3"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
					<option value="arialbold.ttf" <?php if ($_SESSION["font3"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
					<option value="arialitalic.ttf" <?php if ($_SESSION["font3"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
					<option value="arialbolditalic.ttf" <?php if ($_SESSION["font3"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
					<option value="times.ttf" <?php if ($_SESSION["font3"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
					<option value="timesbold.ttf" <?php if ($_SESSION["font3"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
					<option value="timesbolditalic.ttf" <?php if ($_SESSION["font3"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
					<option value="timesitalic.ttf" <?php if ($_SESSION["font3"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
					
					<option value="FREESCPT.ttf" <?php if ($_SESSION["font3"] == "FREESCPT.ttf") { ?> selected="selected"<?php } ?>>Free Script</option>
					<option value="GOTHIC.ttf" <?php if ($_SESSION["font3"] == "GOTHIC.ttf") { ?> selected="selected"<?php } ?>>Century Gothic</option>
					<option value="GOTHICB.ttf" <?php if ($_SESSION["font3"] == "GOTHICB.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold</option>
					<option value="GOTHICBI.ttf" <?php if ($_SESSION["font3"] == "GOTHICBI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Bold Italic</option>
					<option value="GOTHICI.ttf" <?php if ($_SESSION["font3"] == "GOTHICI.ttf") { ?> selected="selected"<?php } ?>>Century Gothic Italic</option>					
				</select>&nbsp;&nbsp;
				</div>
				
				<div class="wizardnew-numberselect">
				<select id="text_fontsize_3" name="font3sizec" onchange="javascript:fontchange('font3size', this.value); add_style('ptext3',this.value);" style="height: 21px;" class="signupFieldInput">
					<option value="20" <?php if ($_SESSION["font3size"] == 20) {?>selected<?php } ?>>10</option>
					<option value="22" <?php if ($_SESSION["font3size"] == 22) {?>selected<?php } ?>>12</option>
					<option value="24" <?php if ($_SESSION["font3size"] == 24) {?> selected<?php } ?>>14</option>
					<option value="26" <?php if ($_SESSION["font3size"] == 26) {?> selected<?php } ?>>16</option>
					<option value="28" <?php if ($_SESSION["font3size"] == 28) {?> selected<?php } ?>>18</option>
					<option value="30" <?php if ($_SESSION["font3size"] == 30) {?> selected<?php } ?>>20</option>
					<option value="32" <?php if ($_SESSION["font3size"] == 32) {?> selected<?php } ?>>22</option>
					<option value="35" <?php if ($_SESSION["font3size"] == 35) {?> selected<?php } ?>>25</option>
					<option value="40" <?php if ($_SESSION["font3size"] == 40) {?> selected<?php } ?>>30</option>
					<option value="46" <?php if ($_SESSION["font3size"] == 46) {?> selected<?php } ?>>36</option>
					<option value="52" <?php if ($_SESSION["font3size"] == 52) {?> selected<?php } ?>>42</option>
					<option value="58" <?php if ($_SESSION["font3size"] == 58) {?> selected<?php } ?>>48</option>
					<option value="70" <?php if ($_SESSION["font3size"] == 70) {?> selected<?php } ?>>60</option>
					<option value="82" <?php if ($_SESSION["font3size"] == 82) {?> selected<?php } ?>>72</option>
					<option value="98" <?php if ($_SESSION["font3size"] == 98) {?> selected<?php } ?>>88</option>
				</select>&nbsp;&nbsp;
				</div>
				<div class="wizardnew-colordiv">
				<div style="width: 1px;float: left;padding-top: 2px;">Color:</div><div id="colorSelector3"><div style="background-color:  <?php if ($_SESSION["font3color"]) { ?>#<?php echo $_SESSION["font3color"]; ?><?php } else { ?> black <?php } ?>"></div></div>
				</div>		
          </div>
		  <div style="clear:both;"></div>
		  <div style="position: absolute; top: -2000px; left:2000px;"><input   type="hidden" name="badgetext3color" id="badgetext3color_3" <?php if (isset($_SESSION["font3color"])) { ?>value="<?php echo $_SESSION["font3color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" onchange="javascript:colorchange('3', this.value);" /></div>
          <div class="signUpField" style="border-bottom: 1px solid #CCCCCC;">
		  <form name="frameform" id="frameform">
            <div class="signUpFieldLeft">Try A Frame:</div>
            <div class="signUpFieldRight" style="float:left;width: 240px;">
            <input type="hidden" name="tag" value="1" />
			<input type="hidden" name="store_bgr_frame" value="<?php echo $_SESSION["backgroundimage"];?>" id="store_bgr_frame">
				<input type="radio" name="frame" value="none" checked onclick="javascript:framechange(document.getElementById('store_bgr_frame').value);"/> None&nbsp;&nbsp;<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:framechange(document.getElementById('store_bgr_frame').value); "/> Gold&nbsp;&nbsp;<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:framechange(document.getElementById('store_bgr_frame').value); " /> Silver
            </div>
			</form>
			<div class="signUpFieldLeft winzardnew-adddome" style="float:left;width: 160px;border-left: 1px solid #CCCCCC;">Add A Dome: <span class="hotspot" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" onmouseover="tooltip.show('<strong>Polyurethane Domed Lens</strong><br>Give your badges added protection and a professional glassy appearance with our hand applied domed lenses.  A permanent polyurethane coating is added to the top of the badge and cured.  The result is a stunning domed lens with some serious added protection.');" onmouseout="tooltip.hide();">(What's This?)</span></div>
				<div class="signUpFieldRight winzardnew-yesnoradioourer" style="float:left;width: 210px;">
					<input type="radio" onclick="add_dome(this.value); " name="dome_choose" <?php if($_SESSION['dome']==1){ echo 'checked';}?> value="1" /> Yes&nbsp;&nbsp;<input onclick="add_dome(this.value);" <?php if($_SESSION['dome']==0){ echo 'checked';}?> type="radio" name="dome_choose" value="0" /> No&nbsp;&nbsp;
				</div>
        </div>
      </div><!-- end logoBox -->
	  <img style="display:none" id="bg_img" src="blanks/<?php echo $_SESSION["backgroundimage"];?>" />
       <form  method="post" action="add-names.php" name="add_name" id="addname" >
	   <input type="hidden" name="result" value = "0" id="result_img"/>
	   <input type="hidden" name="tag" value="1">
	   <input type="hidden" value="0" name="dome" id="dome" />
	   
	    <?php 
		if(isset($_SESSION['widthimg1'])){
			$widthimg1 = $_SESSION['widthimg1'];
		}else{
			$widthimg1 = 0;
		}
		?>
		<input id="widthimg1" name="widthimg1" type="hidden" value="<?php echo $widthimg1;?>" />
		<?php 
		if(isset($_SESSION['heightimg1'])){
			$heightimg1 = $_SESSION['heightimg1'];
		}else{
			$heightimg1 = 0;
		}
		?>
		<input id="heightimg1" name="heightimg1" type="hidden" value="<?php echo $heightimg1; ?>" />
		
			<?php 
		if(isset($_SESSION['widthimg2'])){
			$widthimg2 = $_SESSION['widthimg2'];
		}else{
			$widthimg2 = 0;
		}
		?>
		<input id="widthimg2" name="widthimg2" type="hidden" value="<?php echo $widthimg2;?>" />
	   <?php 
		if(isset($_SESSION['heightimg2'])){
			$heightimg2 = $_SESSION['heightimg2'];
		}else{
			$heightimg2 = 0;
		}
		?>
		<input id="heightimg2" name="heightimg2" type="hidden" value="<?php echo $heightimg2; ?>" />
      <div id="wizardRight" style="margin-top: 20px; width: 100%;font-family: arial; text-align:center;">
      <div class="boxHeader1"><span><b>To resize a logo on your name badge</b>: Simply hover over the right bottom corner util your cursor changes to an arrow. Then click and drag </span></div>
      <div class="boxSub1">
	  	 <div id="infobox">
			<div class="boxSub2" style="text-align: center; float: left;width: 100%;padding: 0px !important;">
					
					<?php 
						$img_arr = explode('.',$_SESSION["backgroundimage"]);
						if($_SESSION['frame'] == 'gold')
						{
							$ext = '_Gframe';
							$img = $img_arr[0].$ext.'.'.$img_arr[1];
						}elseif($_SESSION['frame'] == 'silver'){
							$ext = '_Sframe';
							$img = $img_arr[0].$ext.'.'.$img_arr[1];
						}else{
							$img = $_SESSION["backgroundimage"];
						}
						if(isset($_SESSION["backgroundimage"]) || !empty($_SESSION["backgroundimage"])){
							$bg = 'url(\'blanks/'.$img.'\') no-repeat scroll 50% 50%';
						}else {
							$bg ='white';
						}
					?>
					<input type="hidden" id="backgroundimage" value="<?php echo $_SESSION["backgroundimage"];?>" name="backgroundimage"/>   
					<div  class="wizard-droppableouter">
                        
                        
						<div id="droppable" class="ui-widget-header" style="background: <?php echo $bg;?>; border: 0px;">
							<p id="text"></p>
							<?php
								if(isset($_SESSION['left_draggable']) && $_SESSION['left_draggable'] !='' && $_SESSION['left_draggable']>0){
									$left_1 = $_SESSION['left_draggable'];
								}else{
									$left_1 = '352px';
								} 
								
								if(isset($_SESSION['top_draggable']) && $_SESSION['top_draggable'] !='' && $_SESSION['top_draggable'] >0){
									$top_1 = $_SESSION['top_draggable'];
								}else {
									$top_1 = '651px';
								} 
								
								if(isset($_SESSION['img1_width']) && $_SESSION['img1_width'] !=''){
									$width_img1 = $_SESSION['img1_width'].'px';
								}else{
									$width_img1 = 'auto';
								}
								
								if(isset($_SESSION['img1_height']) && $_SESSION['img1_height'] !='' && $_SESSION['img1_height'] >0){
									$height_img1 = $_SESSION['img1_height'].'px';
								}else{
									$height_img1 = 'auto';
								}
								
								if(isset($_SESSION['img2_width']) && $_SESSION['img2_width'] !=''){
									
									$width_img2 = $_SESSION['img2_width'].'px';
								}else{
									$width_img2 = 'auto';
								}
								
								if(isset($_SESSION['img2_height']) && $_SESSION['img2_height'] !='' && $_SESSION['img2_height'] >0){
									$height_img2 = $_SESSION['img2_height'].'px';
								}else{
									$height_img2 = 'auto';
								}
								
								
								if(isset($_SESSION['left_draggable1']) && $_SESSION['left_draggable1'] !='' && $_SESSION['left_draggable1'] > 0){
									$left_2 = $_SESSION['left_draggable1'];
								} else {
									$left_2 = '352px';
								}
								
								if(isset($_SESSION['top_draggable1']) && $_SESSION['top_draggable1'] !='' && $_SESSION['top_draggable1']>0 ){
									$top_2 = $_SESSION['top_draggable1'];
								} else{
									$top_2 = '651x';
								}
							?>
							<div id="draggable" class="ui-widget-content" style="left:<?php echo $left_1; ?>; top: <?php echo $top_1;?>; width: <?php echo $width_img1;?>; height: <?php echo $height_img1;?>">
								<?php if(isset($_SESSION['logo1']) || !empty($_SESSION['logo1'])){?><img src="logos/<?php echo $_SESSION["logo1"]; ?>" id="img_1"/><?php }?>
							</div>
							<div id="draggable1" class="ui-widget-content" style="left:<?php echo $left_2; ?>; top: <?php echo $top_2;?>; width: <?php echo $width_img2;?>; height: <?php echo $height_img2;?>">		
								<?php if(isset($_SESSION['logo2']) || !empty($_SESSION['logo2'])){?><img src="logos/<?php echo $_SESSION["logo2"]; ?>" id="img_2"/><?php }?>
							</div>
							
							<?php 
								
							if(isset($_SESSION['left_text1']) && !empty($_SESSION['left_text1'])){
							?>
							<div id="ptext1" style="display: block;height:<?php echo $_SESSION["font1size"];?>px;line-height:<?php echo $_SESSION["font1size"];?>px;font-size:<?php echo $_SESSION["font1size"];?>px; color: <?php echo '#'.$_SESSION["font1color"];?>;  position: absolute; left: <?php echo $_SESSION['left_text1'];?>; top: <?php echo $_SESSION['top_text1']?>;"><?php echo $_SESSION['text1']?></div>
							<?php	
							}else{
							?>
							<div id="ptext1" style="display:none; font-size:13"></div>
							<?php }?>
							
							<?php 
							if(isset($_SESSION["font2"])){
								$font_split = explode(".ttf",$_SESSION["font2"]);
								$font_f2 = 'font-family: '.$font_split[0].';';
							}else {
								$font_f2 = '';
							}					
							if(isset($_SESSION['left_text2']) && !empty($_SESSION['left_text2'])){
							?>
							<div id="ptext2" style="display:block; height:<?php echo $_SESSION["font2size"];?>px;line-height:<?php echo $_SESSION["font2size"];?>px; <?php echo $font_f2;?> font-size:<?php echo $_SESSION["font2size"];?>; color: <?php echo '#'.$_SESSION["font2color"];?>;  position: absolute; left: <?php echo $_SESSION['left_text2'];?>; top: <?php echo $_SESSION['top_text2']?>;"><?php echo $_SESSION['text2']?></div>
							<?php	
							}else{
							?>
							<div id="ptext2" style="display:none; font-size:13"></div>
							<?php }?>
							
							
							<?php 
							if(isset($_SESSION["font3"])){
								$font_split = explode(".ttf",$_SESSION["font3"]);
								$font_f3 = 'font-family: '.$font_split[0].';';
							}else {
								$font_f3 = '';
							}	
							
							if(isset($_SESSION['left_text3']) && !empty($_SESSION['left_text3'])){
							
							?>
							<div id="ptext3" style="display:block; height:<?php echo $_SESSION["font3size"];?>px;line-height:<?php echo $_SESSION["font3size"];?>px; <?php echo $font_f3;?> font-size:<?php echo $_SESSION["font3size"];?>; color: <?php echo '#'.$_SESSION["font3color"];?>;  position: absolute; left: <?php echo $_SESSION['left_text3'];?>; top: <?php echo $_SESSION['top_text3']?>;"><?php echo $_SESSION['text3']?></div>
							<?php	
							}else{
							?>
							<div id="ptext3" style="display:none; font-size:13"></div>
							<?php }?>
                            
						</div>
                        
					</div>
			</div>
			<div class="signUpField" style="border: none;">
				<!-- <div style="height: 30px; margin-left: 20px; line-height: 30px;"><input type="checkbox" name="whitebox" value="1" checked />     Have a designer remove the white box around my logo</div> -->
				<div style="height: 30px; text-align:center; line-height: 30px;"><input type="checkbox" name="tweak" value="1" checked />
				   It's ok if a designer tweaks my design. The <strong style="color:#F00;">white</strong> including the white box in your logo will be removed.</div>
				</div>
			</div>
		</div>	
	</div>	
	</div><!-- end wizardRight -->
    <div style="clear: both; float: left;"></div>
    
    <div id="slider3"  class="wizard-butoomform">
		<dl class="slider3" id="slider3">
			<dt></dt>
			<dd>
				<span>
			 
			  <div id="logoBox" style="width: 100%;">
					<div class="signUpField" style="border-top-width: 1px; border-top-style: solid; border-top-color: #CCC;">
				<div class="signUpFieldLeft wizardnew-namethis-label" >Name This Layout: <a href="javascript:void()" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" onmouseout="tooltip.hide();" onmouseover="tooltip.show('Use this as your own generic name for your template.  This is useful when you are reordering this badge style in the future.');" class="hotspot">(What's This?)</a></div>
				<div class="signUpFieldRight wizardnew-namethis-input"><input type="text" name="stylename" id="stylename" style="width: 200px;" class="signupFieldInput"/></div>
				</div>
				<div class="signUpField">
				<div class="signUpFieldLeft wizardnew-namethis-label" style="height: 150px;">Notes:<br />
				  <p style="margin:0; padding: 0; line-height: 12px; font-weight: normal;">Any specific instructions?</p> </div>
				<div class="signUpFieldRight wizardnew-namethis-input" style="height: 150px; "><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 250px; height: 130px;"></textarea></div>
				</div>   
				</div>			  
			   <div class="signUpField" style="width: 100%;">
				<div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px; width: 100%;">
					<input class="img_btn"  type="button" id="continues" value="" name="continues" />
				</div>
			  
				</div>
		  
				</span>
			</dd>
		</dl>
	</div>

<script type="text/javascript">
//var slider2=new accordion.slider("slider2");
//slider2.init("slider2",15,"open");
</script>
    
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>
<div style="position: absolute; top: -2000px; left:2000px;">
<?php if ($_SESSION["frame2"]) { 
$frame = $_SESSION["frame2"]; ?>
	<input type="hidden" id="frame2" name="frame2" value="<?php echo $_SESSION["frame2"]; ?>" />
<?php } else { 
$frame = "none";?>
	<input type="hidden" id="frame2" name="frame2" value="none" />
<?php } ?>
<?php if ($_SESSION["font1"]) { 
$font1 = $_SESSION["font1"]; ?>
	<input type="hidden" id="font1" name="font1" value="<?php echo $_SESSION["font1"]; ?>" />
<?php } else { 
$font1 = "arial.ttf";?>
	<input type="hidden" id="font1" name="font1" value="arial.ttf" />
<?php } ?>
<?php if ($_SESSION["font2"]) { 
$font2 = $_SESSION["font2"]; ?>
	<input type="hidden" id="font2" name="font2" value="<?php echo $_SESSION["font2"]; ?>" />
<?php } else { 
$font2 = "arial.ttf";?>
	<input type="hidden" id="font2" name="font2" value="arial.ttf" />
<?php } ?>

<?php if ($_SESSION["font3"]) { 
$font3 = $_SESSION["font3"]; ?>
	<input type="hidden" id="font3" name="font3" value="<?php echo $_SESSION["font3"]; ?>" />
<?php } else { 
$font3 = "arial.ttf";?>
	<input type="hidden" id="font3" name="font3" value="arial.ttf" />
<?php } ?>


<?php if ($_SESSION["font1size"]) { 
$font1size = $_SESSION["font1size"]; ?>
	<input type="hidden" id="font1size" name="font1size" value="<?php echo $_SESSION["font1size"]; ?>" />
<?php } else { 
$font1size = 12;?>
	<input type="hidden" id="font1size" name="font1size" value="12" />
<?php } ?>

<?php if ($_SESSION["font2size"]) { 
$font2size = $_SESSION["font2size"]; ?>
	<input type="hidden" id="font2size" name="font2size" value="<?php echo $_SESSION["font2size"]; ?>" />
<?php } else { 
$font2size = 12;?>
	<input type="hidden" id="font2size" name="font2size" value="12" />
<?php } ?>

<?php if ($_SESSION["font3size"]) { 
$font2size = $_SESSION["font3size"]; ?>
	<input type="hidden" id="font3size" name="font3size" value="<?php echo $_SESSION["font3size"]; ?>" />
<?php } else { 
$font3size = 12;?>
	<input type="hidden" id="font3size" name="font3size" value="12" />
<?php } ?>

<?php if ($_SESSION["frame2"]) { 
$frame = $_SESSION["frame2"]; ?>
	<input type="hidden" id="frame2" name="frame2" value="<?php echo $_SESSION["frame2"]; ?>" />
<?php } else { 
$frame = "none";?>
	<input type="hidden" id="frame2" name="frame2" value="none" />
<?php } ?>
<?php if ($_SESSION["font1color"]) { 
$font1color = $_SESSION["font1color"]; ?>
	<input type="hidden" id="font1color" name="font1color" value="<?php echo $_SESSION["font1color"]; ?>" />
<?php } else { 
$font1color = "#000000";?>
	<input type="hidden" id="font1color" name="font1color" value="#000000" />
<?php } ?>
<?php if ($_SESSION["font2color"]) { 
$font2color = $_SESSION["font2color"]; ?>
	<input type="hidden" id="font2color" name="font2color" value="<?php echo $_SESSION["font2color"]; ?>" />
<?php } else { 
$font2color = "#000000";?>
	<input type="hidden" id="font2color" name="font2color" value="#000000" />
<?php } ?>
<?php if ($_SESSION["font3color"]) { 
$font3color = $_SESSION["font3color"]; ?>
	<input type="hidden" id="font3color" name="font3color" value="<?php echo $_SESSION["font3color"]; ?>" />
<?php } else { 
$font3color = "#000000";?>
	<input type="hidden" id="font3color" name="font3color" value="#000000" />
<?php } ?>
</div>
</form>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $base_url; ?>/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo $base_url; ?>/js/colorpicker.js"></script>
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
			document.getElementById('ptext1').style.color =  '#'+hex;	
			$("#badgetext1color_1").val(hex);           
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
			document.getElementById('ptext2').style.color =  '#'+hex;	
			$("#badgetext2color_2").val(hex);            
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
			document.getElementById('ptext3').style.color =  '#'+hex;	
			$("#badgetext3color_3").val(hex);            
		}		
	});

</script>
<script>
 	
 $(function() {
    $("#ptext1").draggable({ revert: "invalid" });
	$("#ptext2").draggable({ revert: "invalid" });
	$("#ptext3").draggable({ revert: "invalid" });	
	if($("#img_1").width() > 580){
		$("#img_1").css('width',580);
	}
	if($("#img_1").height() > 310){
		$("#img_1").css('height',310);
	}
	
	if($("#img_2").width() > 580){
		$("#img_2").css('width',580);
	}
	if($("#img_2").height() > 310){
		$("#img_2").css('height',310);
	}
	//alert(img1_width / img1_height);

	<?php 
	if(isset($_SESSION["wl1"])){
	?>	
	var rate1   = 	<?php echo $_SESSION["wl1"]/$_SESSION["hl1"];?>	
	<?php
	}else {?>
	var rate1 = 1;
	<?php } ?>
	
	<?php 
	if(isset($_SESSION["wl2"])){
	?>	
	var rate2   = 	<?php echo $_SESSION["wl2"]/$_SESSION["hl2"];?>	
	<?php
	}else {?>
	var rate2 = 1;
	<?php } ?>
	<?php if(!isset($_SESSION['widthimg1']) || $_SESSION['widthimg1'] == 0){?>
	$("#img_1").load(function(){
			var height_logo1 = parseInt($("#img_1").height());
			var width_logo1	= parseInt($("#img_1").width());
            if(height_logo1 <310){    
                 x1 = parseInt(310/height_logo1);
                 max_height1 = x1*height_logo1;
            }else {
                x1=1;
                max_height1 = height_logo1;
            }
            if(width_logo1< 580){
               max_width1 =  x1*width_logo1;
            }else {
                max_width1 = width_logo1;
            }

            $("#heightimg1").val(max_height1);
			$("#widthimg1").val(max_width1);
			
			$("#draggable").resizable({ 
					aspectRatio:rate1 ,
					maxHeight: max_height1,
					maxWidth: max_width1,
					handles: "all"
			 });
			$("#draggable").draggable({ revert: "invalid" });
			$("#droppable").droppable({
				activeClass: "ui-state-hover",
				hoverClass: "ui-state-active",
				drop: function(event, ui) {				    
					$(this)
						.addClass("ui-state-highlight")
						.find("p")
							.html("");
				}
			});
			
	});	
    
    var img1_heighta = parseInt($("#draggable img").height());
	var img1_widtha	= parseInt($("#draggable img").width());
    if(img1_heighta <310){ 
         x2 = parseInt(310/img1_heighta);
         max_height12 = x2*img1_heighta;
    }else {
        x2 = 1;
        max_height12 = img1_heighta;
    }
    if(img1_widtha< 580){
       max_width12 =  x2*img1_widtha;
    }else {
        max_width12 = img1_widtha;
    }

	$("#draggable").resizable({ 
		aspectRatio:rate1,
		maxHeight: max_height12,
		maxWidth: max_width12,
		handles: "all"
		});	
	$("#draggable").draggable({ revert: "invalid" });
	$("#droppable").droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function(event, ui) {              
			$(this)
				.addClass("ui-state-highlight")
				.find("p")
					.html("");
		}
	}); 	
		
	<?php }else {?>
	$("#img_1").load(function(){
			$("#heightimg1").val(<?php  echo $_SESSION['heightimg1'];?>);
			$("#widthimg1").val(<?php echo $_SESSION['widthimg1'];?>);
			$("#draggable").resizable({ 
					aspectRatio:rate1,
					maxHeight: <?php  echo $_SESSION['heightimg1'];?>,
					maxWidth: <?php echo $_SESSION['widthimg1'];?>,
					handles: "all"
					});

			$("#draggable").draggable({ revert: "invalid" });
			$("#droppable").droppable({
				activeClass: "ui-state-hover",
				hoverClass: "ui-state-active",
				drop: function(event, ui) {                    
					$(this)
						.addClass("ui-state-highlight")
						.find("p")
							.html("");
				}
			});
		
	});	
	$("#draggable").resizable({ 
			aspectRatio:rate1,
			maxHeight: <?php echo $_SESSION['heightimg1'];?>,
			maxWidth: <?php echo $_SESSION['widthimg1'];?>,
			handles: "all"
			});	
	$("#draggable").draggable({ revert: "invalid" });
	$("#droppable").droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function(event, ui) {              
			$(this)
				.addClass("ui-state-highlight")
				.find("p")
					.html("");
		}
	});		
	<?php } ?>
	
	// img 2
	<?php if(!isset($_SESSION['widthimg2']) || $_SESSION['widthimg2'] == 0){?>
	$("#img_2").load(function(){
	       
           var img2_height = parseInt($("#img_2").height());
	       var img2_width	= parseInt($("#img_2").width());
           if(img2_height <310){
                 x3 = parseInt(310/img2_height);
                 max_height2 = x3*img2_height;
            }else {
                max_height2 = img2_height;
            }
            if(img2_width< 580){
               max_width2 =  x3*img2_width;
            }else {
                max_width2 = img2_width;
            }

			
			$("#heightimg2").val(max_height2);
			$("#widthimg2").val(max_width2);

				$("#draggable1").resizable({ 
						aspectRatio:rate2,
						maxHeight: max_height2,
						maxWidth: max_width2,
						handles: "all"
						});
		
			$("#draggable1").draggable({ revert: "invalid" });
			$("#droppable").droppable({
				activeClass: "ui-state-hover",
				hoverClass: "ui-state-active",
				drop: function(event, ui) {				         
					$(this)
						.addClass("ui-state-highlight")
						.find("p")
							.html("");
				}
			});
		
	});	
	var img2_height = parseInt($("#draggable1 img").height());
	var img2_width	= parseInt($("#draggable1 img").width());
    
    if(img2_height <310){ 
         x4 = parseInt(310/img2_height);
         max_height21 = x4*img2_height;
    }else {
        max_height21 = img2_height;
    }
    if(img2_width< 580){
       max_width21 =  x4*img2_width;
    }else {
        max_width21 = img2_width;
    }
	$("#draggable1").resizable({ 
			aspectRatio:rate2,
			maxHeight: max_height21,
			maxWidth: max_width21,
			handles: "all"
			});	
	$("#draggable1").draggable({ revert: "invalid" });
	$("#droppable").droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function(event, ui) {            
			$(this)
				.addClass("ui-state-highlight")
				.find("p")
					.html("");
		}
	});		
	<?php }else {?>
	$("#img_2").load(function(){
			$("#heightimg2").val(<?php  echo $_SESSION['heightimg2'];?>);
			$("#widthimg2").val(<?php echo $_SESSION['widthimg2'];?>);
			$("#draggable1").resizable({ 
					aspectRatio:<?php echo $_SESSION['widthimg2'];?>/<?php  echo $_SESSION['heightimg2'];?>,
					maxHeight: <?php  echo $_SESSION['heightimg2'];?>,
					maxWidth: <?php echo $_SESSION['widthimg2'];?>,
					handles: "all"					
					});
			$("#draggable1").draggable({ revert: "invalid" });
			$("#droppable").droppable({
				activeClass: "ui-state-hover",
				hoverClass: "ui-state-active",
				drop: function(event, ui) {				     
					$(this)
						.addClass("ui-state-highlight")
						.find("p")
							.html("");
				}
			});		
	});	
	$("#draggable1").resizable({ 
			aspectRatio:<?php echo $_SESSION['widthimg2'];?>/<?php  echo $_SESSION['heightimg2'];?>,
			maxHeight: <?php echo $_SESSION['heightimg2'];?>,
			maxWidth: <?php echo $_SESSION['widthimg2'];?>,
			handles: "all"
			});	
	$("#draggable1").draggable({ revert: "invalid" });
	$("#droppable").droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function(event, ui) {		      
			$(this)
				.addClass("ui-state-highlight")
				.find("p")
					.html("");
		}
	});		
	<?php } ?>
});
</script>
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/toolscript.js"></script>
<script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/b9bf6e6e-d437-4617-a530-bb11e10c4951/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("conversion", {cp:"5050",dedup:"1"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/b9bf6e6e-d437-4617-a530-bb11e10c4951/conversion.html?cp=5050&dedup=1" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe> </noscript>
<!-- Google Code for Purchase Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1021904526;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "sExsCKiS0gEQjo2k5wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1021904526/?label=sExsCKiS0gEQjo2k5wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php include_once 'inc/footer.php' ; ?>