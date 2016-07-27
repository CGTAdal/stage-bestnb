<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
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
	} else {
		unset($_SESSION["logo2"]);
	}
}
if ($_SESSION["color"])
{
	$qry = "SELECT * FROM colors WHERE id = ".$_SESSION["color"];
	//echo $qry."<BR>";
	$colors = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$color2 = mysql_fetch_assoc($colors);
	$_SESSION["backgroundimage"] = $color2["backgroundimage"];
	//print_r($color);
}
if ($_SESSION["styleid"])
{
	$qry = "SELECT * FROM styles WHERE id = ".$_SESSION["styleid"];
	$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
	$style = mysql_fetch_assoc($styles);
	//print_r($style);
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
<script type="text/javascript" src="/js/jscolor.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="include/enlargeit.js"></script>

<script language="javascript">
function colorchange(which, val)
{
	url = "ajax/change_color.php?colornum="+which+"&value="+val;
	
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
		req_fifo.onreadystatechange = changedcolor;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}
}
function changedcolor() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
	
}

function textchange(which, val)
{
	url = "ajax/change_text.php?textnum="+which+"&value="+val;
	
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
		req_fifo.onreadystatechange = changedtext;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}
}
function changedtext() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
	
}
function changecstyle(val)
{


  if (val != 0)
  {
	var ary=val.split(",");
	url = "ajax/change_style.php?style="+ary[0]+"&color="+ary[1];
	
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
	
	document.getElementById('infobox').innerHTML=info;
	//document.getElementById('colorname').innerHTML=ary[1];
	
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
	
}

function processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame) {

  	url = "ajax/create_image3.php?left=" + left + "&down=" + down + "&left2=" + left2 + "&down2=" + down2 + "&left3=" + left3 + "&down3=" + down3 + "&leftt=" + leftt + "&downt=" + downt + "&img1h=" + img1h + "&img1w=" + img1w + "&img2h=" + img2h + "&img2w=" + img2w + "&leftt2=" + leftt2 + "&downt2=" + downt2 + "&leftt3=" + leftt3 + "&downt3=" + downt3 + "&font1=" + font1 + "&font2=" + font2 + "&font3=" + font3 + "&font1size=" + font1size + "&font2size=" + font2size + "&font3size=" + font3size + "&frame=" + frame;

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
		document.getElementById('imageshow').innerHTML="Please Choose a Badge Type on the Left";
	} else {
		document.getElementById('imageshow').innerHTML=info;
	}

	
	
	// Schedule next call to wait for fifo data
   //setTimeout("GetAsyncData()", 100);
   //return;
}

function moveobject(which, x)
{
	
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	switch(which)
	{
	case 'left':
  		left = left + x;
		document.getElementById("left").value = left;
  		break;
	case 'down':
  		down = down + x;
		document.getElementById("down").value = down;
  		break;
	
	case 'left2':
  		left2 = left2 + x;
		document.getElementById("left2").value = left2;
  		break;
	
	case 'down2':
  		down2 = down2 + x;
		document.getElementById("down2").value = down2;
  		break;
	
	case 'leftt':
  		leftt = leftt + x;
		document.getElementById("leftt").value = leftt;
  		break;
	
	case 'downt':
  		downt = downt + x;
		document.getElementById("downt").value = downt;
  		break;
	
	case 'leftt2':
  		leftt2 = leftt2 + x;
		document.getElementById("leftt2").value = leftt2;
  		break;
	
	case 'downt2':
  		downt2 = downt2 + x;
		document.getElementById("downt2").value = downt2;
  		break;
	
	case 'leftt3':
  		leftt3 = leftt3 + x;
		document.getElementById("leftt3").value = leftt3;
  		break;
	
	case 'downt3':
  		downt3 = downt3 + x;
		document.getElementById("downt3").value = downt3;
  		break;
	}
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
	
}

function imagesize(which, x)
{
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	if (which == "image1")
	{
		img1w = img1w + x;
		document.getElementById("img1w").value = img1w;
		img1h = img1h + x;
		document.getElementById("img1h").value = img1h;
	} else {
		img2w = img2w + x;
		document.getElementById("img2w").value = img2w;
		img2h = img2h + x;
		document.getElementById("img2h").value = img2h;
	}
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
}


function fontchange(which, size)
{
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	frame2 = document.getElementById("frame2").value;
	
	if (which == "font1size")
	{
		document.getElementById("font1size").value = size;
		font1size = size
	} else if (which == "font2size") {
		document.getElementById("font2size").value = size;
		font2size=size;
	} else if (which == "font3size") {
		document.getElementById("font3size").value = size;
		font3size=size;
	} else if (which == "font1") {
		document.getElementById("font1").value = size;
		font1 = size
	} else if (which == "font2") {
		document.getElementById("font2").value = size;
		font2 = size
	} else if (which == "font3") {
		document.getElementById("font3").value = size;
		font3 = size
	}
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame2);
}


function framechange()
{
	left = parseInt(document.getElementById("left").value);
	down = parseInt(document.getElementById("down").value);
	left2 = parseInt(document.getElementById("left2").value);
	down2 = parseInt(document.getElementById("down2").value);
	left3 = parseInt(document.getElementById("left3").value);
	down3 = parseInt(document.getElementById("down3").value);
	leftt = parseInt(document.getElementById("leftt").value);
	downt = parseInt(document.getElementById("downt").value);
	leftt2 = parseInt(document.getElementById("leftt2").value);
	downt2 = parseInt(document.getElementById("downt2").value);
	leftt3 = parseInt(document.getElementById("leftt3").value);
	downt3 = parseInt(document.getElementById("downt3").value);
	img1w = parseInt(document.getElementById("img1w").value);
	img1h = parseInt(document.getElementById("img1h").value);
	img2w = parseInt(document.getElementById("img2w").value);
	img2h = parseInt(document.getElementById("img2h").value);
	font1 = document.getElementById("font1").value;
	font2 = document.getElementById("font2").value;
	font3 = document.getElementById("font3").value;
	font1size =document.getElementById("font1size").value;
	font2size = document.getElementById("font2size").value;
	font3size = document.getElementById("font3size").value;
	for( i = 0; i < document.frameform.frame.length; i++ )
	{
		if( document.frameform.frame[i].checked == true )
		frame = document.frameform.frame[i].value;
	}
	document.getElementById('framestyle').innerHTML = '<p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br /><strong>' + frame + '</strong></p>';
	document.getElementById("frame2").value = frame;
	
	processimage(left, down, left2, down2, left3, down3, leftt, downt, img1w, img1h, img2w, img2h, leftt2, downt2, leftt3, downt3, font1, font2, font3, font1size, font2size, font3size, frame);
}

function checkstyle()
{

	msg = "You have the following errors:\n";
	if (document.getElementById('stylename').value == "")
	{
		msg = msg + "Please Enter a Style Name\n";
	}
	
	if (document.getElementById('changestyle').value == "0")
	{
		msg = msg + "Please Choose a Badge Style\n";
	}
	
	if (msg != "You have the following errors:\n")
	{
		alert(msg);
		return false;
	 } else {
		return true;
	}
}
</script>
    <div id="content">
     
    <div id="mainContentFull">
	  <h2>Create Your Custom Name Badge</h2>

	  <br /><br />
	  
      <div id="logoBox" class="wizard-leftbox">
      	<div class="boxHeader"><span style="float: left;">Create Your Design</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div><div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Select Your Card Size:</div>
            <div class="signUpFieldRight">
             	<select name="cardsize" id="cardsize" style="width: 325px; height: 22px;" class="signupFieldInput">
					<option value="0">Choose One...</option>
					<option value="CR-80">CR-80</option>
					<option value="1 1/2x3">1 1/2 x 3</option>
					<option value="1x3">1x3</option>
				</select>
			</div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft wizardresponsive-logoheight" style="height: 160px;">Add Your Logo(s):<br />(optional)
            </div>
            <div class="signUpFieldRight" style="height: auto;">
            	<div class="wizard-leftphotodiv">
                Photo: 
                 <div class="wizard-tableouter"><table ><tr>
                   <td valign="middle" align="center"><?php if ($_SESSION["logo1"]) { ?>
				   <img src="logos/<?php echo $_SESSION["logo1"]; ?>" class="resize" onClick="enlarge(this);" longdesc="logos/<?php echo $_SESSION["logo1"]; ?>" id="photo1"/>&nbsp;<a href="wizard.php?remove=1" style="font-size: 11px;">remove image</a><?php } else { ?>(<a href="logo-upload.php?logo=1&wizard=wizard" style="font-size: 11px;" title="Upload Logo 1" rel="gb_page_center[400, 200]">click to upload</a>)<?php } ?></td></tr></table></div>
				  
                <div style="clear: both; margin-top: 10px;" class="wizardButtons">
               	 <img src="images/wizard/arrow1.png" width="25" height="28" onclick="javascript:moveobject('left',-4);" /><img src="images/wizard/arrow2.png" width="21" height="28" onclick="javascript:moveobject('down',-4);" /><img src="images/wizard/arrow3.png" width="22" height="28" onclick="javascript:moveobject('down',4);" /><img src="images/wizard/arrow4.png" width="26" height="28" onclick="javascript:moveobject('left',4);" /><img src="images/wizard/arrow5.png" width="27" height="28" onclick="javascript:imagesize('image1',10);" /><img src="images/wizard/arrow6.png" width="27" height="28" onclick="javascript:imagesize('image1',-10);" /></div>
                </div>
              	<div  class="wizard-rightlogodiv">
                Logo: 
                 <div  class="wizard-tableouter"><table ><tr>
                   <td valign="middle"><?php if ($_SESSION["logo2"]) { ?><img src="logos/<?php echo $_SESSION["logo2"]; ?>" class="resize" longdesc="logos/<?php echo $_SESSION["logo2"]; ?>" id="photo2" />&nbsp;<a href="wizard.php?remove=2" style="font-size: 11px;">remove image</a><?php } else { ?>(<a href="logo-upload.php?logo=2&wizard=wizard" style="font-size: 11px;" title="Upload Logo 2" rel="gb_page_center[400, 200]">click to upload</a>)<?php } ?></td></tr></table></div>
				  
                <div style="clear: both; margin-top: 10px;" class="wizardButtons">
               	 <img src="images/wizard/arrow1.png" width="25" height="28" onclick="javascript:moveobject('left2',-4);" /><img src="images/wizard/arrow2.png" width="21" height="28" onclick="javascript:moveobject('down2',-4);" /><img src="images/wizard/arrow3.png" width="22" height="28" onclick="javascript:moveobject('down2',4);" /><img src="images/wizard/arrow4.png" width="26" height="28" onclick="javascript:moveobject('left2',4);" /><img src="images/wizard/arrow5.png" width="27" height="28" onclick="javascript:imagesize('image2',10);" /><img src="images/wizard/arrow6.png" width="27" height="28" onclick="javascript:imagesize('image2',-10);" /></div>
                </div>
            </div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft wizardresponsive-addtext1" style="height: 65px;">Add Text 1:</div>
            <div class="signUpFieldRight" style="height: 65px;">
              <div class="wizardText"><div style="float: left; width: 100%; margin-top: 3px;"><div class="wizard-textboxouter">
              	<input type="text" name="badgetext1" value="<?php echo $_SESSION["logotext1"]; ?>" class="signupFieldInput" style="width: 200px;" onchange="textchange('1', this.value);"/></div><div  class="wizard-smalliconouter"><img src="images/wizard/textArrow1.png" width="22" height="28" onclick="javascript:moveobject('leftt',-4);")/><img src="images/wizard/textArrow2.png" width="21" height="28" onclick="javascript:moveobject('downt',-4);"/><img src="images/wizard/textArrow3.png" width="22" height="28" onclick="javascript:moveobject('downt',4);"/><img src="images/wizard/textArrow4.png" width="22" height="28" onclick="javascript:moveobject('leftt',4);"/></div></div>
                <div style="float: left; width: 100%;">
                <select name="font1post" onchange="javascript:fontchange('font1',this.value);" style="height: 21px; width: 158px;" class="signupFieldInput">
	<option value="arial.ttf">Arial Normal</option>
	<option value="arialblack.ttf" <?php if ($_SESSION["font1"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
	<option value="arialbold.ttf" <?php if ($_SESSION["font1"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
	<option value="arialitalic.ttf" <?php if ($_SESSION["font1"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
	<option value="arialbolditalic.ttf" <?php if ($_SESSION["font1"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
	<option value="times.ttf" <?php if ($_SESSION["font1"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
	<option value="timesbold.ttf" <?php if ($_SESSION["font1"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
	<option value="timesbolditalic.ttf" <?php if ($_SESSION["font1"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
	<option value="timesitalic.ttf" <?php if ($_SESSION["font1"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
</select>&nbsp;&nbsp;
<select name="font1sizec" onchange="javascript:fontchange('font1size', this.value);" style="height: 21px;" class="signupFieldInput">
	<option value="10" <?php if ($_SESSION["font1size"] == 10) {?>selected<?php } ?>>10px</option>
	<option value="12" <?php if (!$_SESSION["font1size"] || $_SESSION["font1size"] == 12) {?>selected<?php } ?>>12px</option>
	<option value="14" <?php if ($_SESSION["font1size"] == 14) {?>selected<?php } ?>>14px</option>
	<option value="16" <?php if ($_SESSION["font1size"] == 15) {?>selected<?php } ?>>16px</option>
	<option value="18" <?php if ($_SESSION["font1size"] == 16) {?>selected<?php } ?>>18px</option>
</select>&nbsp;&nbsp;
<input type="text" name="badgetext1color" id="badgetext1color" <?php if ($_SESSION["font1color"]) { ?>value="<?php echo $_SESSION["font1color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" onchange="javascript:colorchange('1', this.value);" />

</div>
              </div>
            	
            
            </div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft wizardresponsive-addtext1" style="height: 65px;">Add Text 2:</div>
            <div class="signUpFieldRight" style="height: 65px;">
              <div class="wizardText"><div style="float: left; width: 100%; margin-top: 3px;"><div class="wizard-textboxouter">
              	<input type="text" name="badgetext2" value="<?php echo $_SESSION["logotext2"]; ?>" class="signupFieldInput" style="width: 200px;" onchange="textchange('2', this.value);"/></div><div class="wizard-smalliconouter"><img src="images/wizard/textArrow1.png" width="22" height="28" onclick="javascript:moveobject('leftt2',-4);")/><img src="images/wizard/textArrow2.png" width="21" height="28" onclick="javascript:moveobject('downt2',-4);"/><img src="images/wizard/textArrow3.png" width="22" height="28" onclick="javascript:moveobject('downt2',4);"/><img src="images/wizard/textArrow4.png" width="22" height="28" onclick="javascript:moveobject('leftt2',4);"/></div></div>
                <div style="float: left; width: 100%;">
                <select name="font2post" onchange="javascript:fontchange('font2',this.value);" style="height: 21px; width: 158px;" class="signupFieldInput">
	<option value="arial.ttf">Arial Normal</option>
	<option value="arialblack.ttf" <?php if ($_SESSION["font2"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
	<option value="arialbold.ttf" <?php if ($_SESSION["font2"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
	<option value="arialitalic.ttf" <?php if ($_SESSION["font2"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
	<option value="arialbolditalic.ttf" <?php if ($_SESSION["font2"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
	<option value="times.ttf" <?php if ($_SESSION["font2"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
	<option value="timesbold.ttf" <?php if ($_SESSION["font2"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
	<option value="timesbolditalic.ttf" <?php if ($_SESSION["font2"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
	<option value="timesitalic.ttf" <?php if ($_SESSION["font2"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
</select>&nbsp;&nbsp;
<select name="font2sizec" onchange="javascript:fontchange('font2size', this.value);" style="height: 21px;" class="signupFieldInput">
	<option value="10" <?php if ($_SESSION["font2size"] == 10) {?>selected<?php } ?>>10px</option>
	<option value="12" <?php if (!$_SESSION["font2size"] || $_SESSION["font2size"] == 12) {?>selected<?php } ?>>12px</option>
	<option value="14" <?php if ($_SESSION["font2size"] == 14) {?>selected<?php } ?>>14px</option>
	<option value="16" <?php if ($_SESSION["font2size"] == 15) {?>selected<?php } ?>>16px</option>
	<option value="18" <?php if ($_SESSION["font2size"] == 16) {?>selected<?php } ?>>18px</option>
</select>&nbsp;&nbsp;
<input type="text" name="badgetext2color" id="badgetext2color" <?php if ($_SESSION["font2color"]) { ?>value="<?php echo $_SESSION["font2color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" onchange="javascript:colorchange('2', this.value);" />

</div>
              </div>
            	
            
            </div>
          </div>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft wizardresponsive-addtext1" style="height: 65px;">Add Text 3:</div>
            <div class="signUpFieldRight" style="height: 65px;">
              <div class="wizardText"><div style="float: left; width: 100%; margin-top: 3px;"><div class="wizard-textboxouter">
              	<input type="text" name="badgetext3" value="<?php echo $_SESSION["logotext3"]; ?>" class="signupFieldInput" style="width: 200px;"  onchange="textchange('3', this.value);" /></div><div class="wizard-smalliconouter"><img src="images/wizard/textArrow1.png" width="22" height="28" onclick="javascript:moveobject('leftt3',-4);")/><img src="images/wizard/textArrow2.png" width="21" height="28" onclick="javascript:moveobject('downt3',-4);"/><img src="images/wizard/textArrow3.png" width="22" height="28" onclick="javascript:moveobject('downt3',4);"/><img src="images/wizard/textArrow4.png" width="22" height="28" onclick="javascript:moveobject('leftt3',4);"/></div></div>
                <div style="float: left; width: 100%;">
                <select name="font3post" onchange="javascript:fontchange('font3',this.value);" style="height: 21px; width: 158px;" class="signupFieldInput">
	<option value="arial.ttf">Arial Normal</option>
	<option value="arialblack.ttf" <?php if ($_SESSION["font3"] == "arialblack.ttf") { ?> selected="selected"<?php } ?>>Arial Black</option>
	<option value="arialbold.ttf" <?php if ($_SESSION["font3"] == "arialbold.ttf") { ?> selected="selected"<?php } ?>>Arial Bold</option>
	<option value="arialitalic.ttf" <?php if ($_SESSION["font3"] == "arialitalic.ttf") { ?> selected="selected"<?php } ?>>Arial Italic</option>
	<option value="arialbolditalic.ttf" <?php if ($_SESSION["font3"] == "arialbolditalic.ttf") { ?> selected="selected"<?php } ?>>Arial Bold Italic</option>
	<option value="times.ttf" <?php if ($_SESSION["font3"] == "times.ttf") { ?> selected="selected"<?php } ?>>Times</option>
	<option value="timesbold.ttf" <?php if ($_SESSION["font3"] == "timesbold.ttf") { ?> selected="selected"<?php } ?>>Times Bold</option>
	<option value="timesbolditalic.ttf" <?php if ($_SESSION["font3"] == "timesbolditalic.ttf") { ?> selected="selected"<?php } ?>>Times Bold Italic</option>
	<option value="timesitalic.ttf" <?php if ($_SESSION["font3"] == "timesitalic.ttf") { ?> selected="selected"<?php } ?>>Times Italic</option>
</select>&nbsp;&nbsp;
<select name="font3sizec" onchange="javascript:fontchange('font3size', this.value);" style="height: 21px;" class="signupFieldInput">
	<option value="10" <?php if ($_SESSION["font3size"] == 10) {?>selected<?php } ?>>10px</option>
	<option value="12" <?php if (!$_SESSION["font3size"] || $_SESSION["font3size"] == 12) {?>selected<?php } ?>>12px</option>
	<option value="14" <?php if ($_SESSION["font3size"] == 14) {?>selected<?php } ?>>14px</option>
	<option value="16" <?php if ($_SESSION["font3size"] == 15) {?>selected<?php } ?>>16px</option>
	<option value="18" <?php if ($_SESSION["font3size"] == 16) {?>selected<?php } ?>>18px</option>
</select>&nbsp;&nbsp;
<input type="text" name="badgetext3color" id="badgetext3color" <?php if ($_SESSION["font3color"]) { ?>value="<?php echo $_SESSION["font3color"]; ?>"<?php } else { ?>value="000000"<?php } ?> class="signupFieldInput color" style="width: 75px; border: none;" onchange="javascript:colorchange('3', this.value);" />

</div>
              </div>
            	
            
            </div>
          </div>
		  <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
			<div class="signUpFieldLeft">Dimension:</div>
			<div class="signUpFieldRight">
				<input type='radio' name="dimension" value="Horizontal" /> Horizontal&nbsp;&nbsp;<input type="radio" name="dimension" value="Vertical" /> Vertical
			</div>
		  </div>
		  <?php if ($_SESSION["card"] == "CR80") { ?>
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
		  <form name="frameform" id="frameform">
            <div class="signUpFieldLeft">Try A Frame:</div>
            <div class="signUpFieldRight">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="frame" value="none" checked onclick="javascript:framechange();"/> None&nbsp;&nbsp;<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:framechange();"/> Gold&nbsp;&nbsp;<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:framechange();" /> Silver
            </div>
			</form>
          
	
        </div>
		<?php } ?>
      </div><!-- end logoBox -->
       <form method="post" action="add-names.php" onsubmit="return checkstyle();">
	   <input type="hidden" name="tag" value="1">
      <div id="wizardRight">
      <div class="boxHeader"><span style="float: left;">Preview Your Badge</span></div>
      <div class="boxSub" style="float: left;">
	  	 <div id="infobox" >
         <div class="boxSub2" style="text-align: center; float: left;">
              <div id="imageshow" name="imageshow" style="height:133px; width: 330px; float: left; margin-top: 15px;">
  				<img src="/images/loading.gif" width="75" height="75" />
  			  </div>
			  <div id="badgestyle">
           <p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br />
             <strong><?php echo $style["size"]." - ".$style["name"]; ?></strong>
             </p></div>
             <div id="framestyle"><p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br />
              <strong>None</strong>
              </p></div>
              <div id="colorname">
			  <p style="float: right; font-size: 10px; width: 85px; text-align: left;">Color:<br />
              <strong><?php echo $color2["name"]; ?></strong>
              </p>
			  </div>
         </div>
		 </div>
         <div class="signUpField" style="border: none;">
            <div class="wizard-inputouter" ><input type="checkbox" name="whitebox" value="1" checked />     Have a designer remove the white box around my logo</div>
            <div class="wizard-inputouter" ><input type="checkbox" name="tweak" value="1" checked />
              It's ok if a designer tweaks my design</div>
          </div>
      </div>
    </div><!-- end wizardRight -->
    
    <div style="clear: both; float: left;"></div>
    
    <div id="slider3" style="margin-top: 25px; clear: both; float: left;">
	<dl class="slider3" id="slider2">
		<dt></dt>
		<dd>
			<span>
		 
          <div id="logoBox" >
      			<div class="signUpField" style="border-top-width: 1px; border-top-style: solid; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Name This Style:</div>
            <div class="signUpFieldRight"><input type="text" name="stylename" id="stylename" style="width: 200px;" class="signupFieldInput"/></div>
         	</div>
            <div class="signUpField">
            <div class="signUpFieldLeft" style="height: 150px; ">Notes:<br />
              <p style="margin:0; padding: 0; line-height: 12px; font-weight: normal;">Any specific instructions?</p> </div>
            <div class="signUpFieldRight" style="height: 150px; "><textarea name="note" cols="40" rows="5" style="margin-top: 5px; width: 325px; height: 130px;"></textarea></div>
         	</div>   
            </div>			  
           <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px; width: 100%;"><input type="image" value="submit" src="images/continueButton.png" /></div>
          
      </div>
	  
            </span>
		</dd>
	</dl>
</div>

<script type="text/javascript">

var slider2=new accordion.slider("slider2");
slider2.init("slider2",15,"open");

</script>
    
    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php if ($_SESSION["left"]) { 
$left = $_SESSION["left"];?>
	<input type="hidden" id="left" name="left" value="<?php echo $_SESSION["left"]; ?>" />
<?php } else { 
$left = 2;
?>
	<input type="hidden" id="left" name="left" value="2" />
<?php } ?>
<?php if ($_SESSION["down"]) {
$down = $_SESSION["down"]; ?>
	<input type="hidden" id="down" name="down" value="<?php echo $_SESSION["down"]; ?>" />
<?php } else { 
$down = 2;?>
	<input type="hidden" id="down" name="down" value="2" />
<?php } ?>
<?php if ($_SESSION["left2"]) { 
$left2 = $_SESSION["left2"];?>
	<input type="hidden" id="left2" name="left2" value="<?php echo $_SESSION["left2"]; ?>" />
<?php } else {
$left2 = 100 ?>
<input type="hidden" id="left2" name="left2" value="100" />
<?php } ?>
<?php if ($_SESSION["down2"]) { 
$down2 = $_SESSION["down2"]; ?>
	<input type="hidden" id="down2" name="down2" value="<?php echo $_SESSION["down2"]; ?>" />
<?php } else { 
$down2 = 20;?>
	<input type="hidden" id="down2" name="down2" value="20" />
<?php } ?>


<?php if ($_SESSION["left3"]) { 
$left3 = $_SESSION["left3"];?>
	<input type="hidden" id="left3" name="left3" value="<?php echo $_SESSION["left3"]; ?>" />
<?php } else {
$left3 = 100 ?>
<input type="hidden" id="left3" name="left3" value="100" />
<?php } ?>
<?php if ($_SESSION["down3"]) { 
$down3 = $_SESSION["down3"]; ?>
	<input type="hidden" id="down3" name="down3" value="<?php echo $_SESSION["down3"]; ?>" />
<?php } else { 
$down3 = 20;?>
	<input type="hidden" id="down3" name="down3" value="20" />
<?php } ?>


<?php if ($_SESSION["leftt"]) { 
$leftt = $_SESSION["leftt"];?>
	<input type="hidden" id="leftt" name="leftt" value="<?php echo $_SESSION["leftt"]; ?>" />
<?php } else {
$leftt = 30 ?>
<input type="hidden" id="leftt" name="leftt" value="30" />
<?php } ?>
<?php if ($_SESSION["downt"]) { 
$downt = $_SESSION["downt"]; ?>
	<input type="hidden" id="downt" name="downt" value="<?php echo $_SESSION["downt"]; ?>" />
<?php } else { 
$downt = 100;?>
	<input type="hidden" id="downt" name="downt" value="100" />
<?php } ?>

<?php if ($_SESSION["leftt2"]) { 
$leftt2 = $_SESSION["leftt2"];?>
	<input type="hidden" id="leftt2" name="leftt2" value="<?php echo $_SESSION["leftt2"]; ?>" />
<?php } else {
$leftt2 = 30 ?>
<input type="hidden" id="leftt2" name="leftt2" value="30" />
<?php } ?>
<?php if ($_SESSION["downt2"]) { 
$downt2 = $_SESSION["downt2"]; ?>
	<input type="hidden" id="downt2" name="downt2" value="<?php echo $_SESSION["downt2"]; ?>" />
<?php } else { 
$downt2 = 120;?>
	<input type="hidden" id="downt2" name="downt2" value="120" />
<?php } ?>


<?php if ($_SESSION["leftt3"]) { 
$leftt3 = $_SESSION["leftt3"];?>
	<input type="hidden" id="leftt3" name="leftt3" value="<?php echo $_SESSION["leftt3"]; ?>" />
<?php } else {
$leftt3 = 80 ?>
<input type="hidden" id="leftt3" name="leftt3" value="80" />
<?php } ?>
<?php if ($_SESSION["downt3"]) { 
$downt3 = $_SESSION["downt3"]; ?>
	<input type="hidden" id="downt3" name="downt3" value="<?php echo $_SESSION["downt3"]; ?>" />
<?php } else { 
$downt3 = 120;?>
	<input type="hidden" id="downt3" name="downt3" value="120" />
<?php } ?>


<?php if ($_SESSION["img1w"]) { 
$img1w = $_SESSION["img1w"]; ?>
	<input type="hidden" id="img1w" name="img1w" value="<?php echo $_SESSION["img1w"]; ?>" />
<?php } else { 
$img1w = 100;?>
	<input type="hidden" id="img1w" name="img1w" value="100" />
<?php } ?>
<?php if ($_SESSION["img1h"]) { 
$img1h = $_SESSION["img1h"]; ?>
	<input type="hidden" id="img1h" name="img1h" value="<?php echo $_SESSION["img1h"]; ?>" />
<?php } else { 
$img1h = 100;?>
	<input type="hidden" id="img1h" name="img1h" value="100" />
<?php } ?>

<?php if ($_SESSION["img2w"]) { 
$img2w = $_SESSION["img2w"]; ?>
	<input type="hidden" id="img2w" name="img2w" value="<?php echo $_SESSION["img2w"]; ?>" />
<?php } else { 
$img2w = 100;?>
	<input type="hidden" id="img2w" name="img2w" value="100" />
<?php } ?>
<?php if ($_SESSION["img2h"]) { 
$img2h = $_SESSION["img2h"]; ?>
	<input type="hidden" id="img2h" name="img2h" value="<?php echo $_SESSION["img2h"]; ?>" />
<?php } else { 
$img2h = 100;?>
	<input type="hidden" id="img2h" name="img2h" value="100" />
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
</form>
<script language="javascript">

processimage(<?php echo $left; ?>,<?php echo $down; ?>,<?php echo $left2; ?>,<?php echo $down2; ?>,<?php echo $left3; ?>,<?php echo $down3; ?>,<?php echo $leftt; ?>,<?php echo $downt; ?>, <?php echo $img1w; ?>, <?php echo $img1h; ?>, <?php echo $img2w; ?>, <?php echo $img2h; ?>,<?php echo $leftt2; ?>,<?php echo $downt2; ?>,<?php echo $leftt3; ?>,<?php echo $downt3; ?>,"<?php echo $font1; ?>","<?php echo $font2; ?>","<?php echo $font3; ?>", <?php echo $font1size; ?>, <?php echo $font2size; ?>, <?php echo $font3size; ?>, "<?php echo $frame; ?>");
framechange("<?php echo $frame; ?>");
</script>

<?php include_once 'inc/footer.php' ; ?>