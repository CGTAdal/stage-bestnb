<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
include('include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

// function use to remove XSS
function strip_javascript_input($filter){
  
    // realign javascript href to onclick
    $filter = preg_replace("/href=(['\"]).*?javascript:(.*)?\\1/i", "onclick=' $2 '", $filter);

    //remove javascript from tags
    while( preg_match("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
        $filter = preg_replace("/<(.*)?javascript.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);
            
    // dump expressions from contibuted content
    if(0) $filter = preg_replace("/:expression\(.*?((?>[^(.*?)]+)|(?R)).*?\)\)/i", "", $filter);

    while( preg_match("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", $filter))
        $filter = preg_replace("/<(.*)?:expr.*?\(.*?((?>[^()]+)|(?R)).*?\)?\)(.*)?>/i", "<$1$3$4$5>", $filter);
       
    // remove all on* events   
    while( preg_match("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", $filter) )
       $filter = preg_replace("/<(.*)?\s?on.+?=?\s?.+?(['\"]).*?\\2\s?(.*)?>/i", "<$1$3>", $filter);

    return htmlentities(strip_tags($filter));
} 
// end of function remove XSS

if (!$_SESSION["customerloginid"])
{
	header("location: sign-up.php");
}

$pagetitle = "Buy Name Badges - Custom Name Badge Styles and Tags";
$metadescription = "Best Name Badges offers several styles of high quality badges and tags to fit your needs.  Magnetic and Pin fasteners are included free of charge.";
$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

if ($_POST["tag"] == 1)
{	
	
	$_SESSION["numofbadges"] = 0;
	$_SESSION["numofframes"] = 0;
	$_SESSION["numofabadges"] = 0;
	$_SESSION["numofaframes"] = 0;
	$_SESSION["numofdomes"] = 0;
	$_SESSION["numofadome"] = 0;
	$_SESSION["tag"] = $_POST["tag"];
	
	$data["custid"] = $_SESSION["customerloginid"];
	$data["styleid"] = $_SESSION["styleid"];
	$data["color"] = $_SESSION["color"];
	$data["stylename"] = $_POST["stylename"];
	$data["logo1"] = $_SESSION["logo1"];
	$data["logo2"] = $_SESSION["logo2"];
	$data["proof"] = $_SESSION["bannername"];
	$idir = "proofs/";   // Path To proofs Directory 
	$copy = copy("output/".$_SESSION["bannername"], "$idir" .$_SESSION["bannername"]);
	$_POST = array_map('strip_javascript_input',$_POST);
	$data["notes"] = $_POST["note"];
	$data["whitebox"] = $_POST["whitebox"];
	$data["tweak"] = $_POST["tweak"];
	$data["tag"] = $_POST["tag"];
	$_SESSION["custstyleid"] = add_record("custstyle", $data);
	$data2['timestamp'] = date('Y-m-d H:i:s');
	$data2["custid"] = $_SESSION["customerloginid"];
	$_SESSION["printorderid"] = add_record("printorders", $data2);
	header("location: add-names.php");
}
if ($_POST["tag"] == 2)
{
	$_SESSION["numofbadges"] = 0;
	$_SESSION["numofframes"] = 0;
	$_SESSION["numofabadges"] = 0;
	$_SESSION["numofaframes"] = 0;
	$_SESSION["numofdomes"] = 0;
	$_SESSION["numofadome"] = 0;
    	$_POST = array_map('strip_javascript_input',$_POST);
	$_SESSION["tag"] = $_POST["tag"];
	
	$data["custid"] = $_SESSION["customerloginid"];
	$data["styleid"] = $_SESSION["styleid"];
	$data["color"] = $_SESSION["color"];
	$data["stylename"] = $_POST["stylename"];
	$data["logo1"] = $_SESSION["logo1"];
	$data["logo2"] = $_SESSION["logo2"];
	$data["proof"] = $_SESSION["bannername"];
	$idir = "proofs/";
	$copy = copy("output/".$_SESSION["bannername"], "$idir" . $_SESSION["bannername"]);
	$data["notes"] = $_POST["note"];
	$data["lines"] = $_POST["lines"];
	$data["tag"] = $_POST["tag"];
	$_SESSION["custstyleid"] = add_record("custstyle", $data);
	
	$data2["custid"] = $_SESSION["customerloginid"];
	$data2['timestamp'] = date('Y-m-d H:i:s');
	$_SESSION["printorderid"] = add_record("printorders", $data2);
	header("location: add-names.php");
}
if ($_POST["tag"] == 3)
{
	$_SESSION["numofbadges"] = 0;
	$_SESSION["numofframes"] = 0;
	$_SESSION["numofabadges"] = 0;
	$_SESSION["numofaframes"] = 0;
	$_SESSION["numofdomes"] = 0;
	$_SESSION["numofadome"] = 0;
	$_SESSION["tag"] = $_POST["tag"];
	$_POST = array_map('strip_javascript_input',$_POST);
	$data["custid"] = $_SESSION["customerloginid"];
	$data["styleid"] = $_SESSION["styleid"];
	$data["color"] = $_SESSION["color"];
	$data["stylename"] = $_POST["stylename"];
	$data["logo1"] = $_SESSION["logo1"];
	$data["logo2"] = $_SESSION["logo2"];
	$data["proof"] = $_SESSION["bannername"];
	$idir = "proofs/";
	$copy = copy("output/".$_SESSION["bannername"], "$idir" . $_SESSION["bannername"]);
	$data["notes"] = $_POST["note"];
	$data["tag"] = $_POST["tag"];
	$_SESSION["custstyleid"] = add_record("custstyle", $data);
	
	$data2["custid"] = $_SESSION["customerloginid"];
	$data2['timestamp'] = date('Y-m-d H:i:s');
	$_SESSION["printorderid"] = add_record("printorders", $data2);
	header("location: add-names.php");
}

if(isset($_SESSION['add_name_templates']) && $_SESSION['add_name_templates'] == 1){
		$_POST = array_map('strip_javascript_input',$_POST);
		$_SESSION["numofbadges"] = 0;
		$_SESSION["numofframes"] = 0;
		$_SESSION["numofabadges"] = 0;
		$_SESSION["numofaframes"] = 0;
		$_SESSION["numofdomes"] = 0;
		$_SESSION["numofadome"] = 0;
		$_SESSION["tag"] = 4;
		$data2["custid"] = $_SESSION["customerloginid"];
		$data2['timestamp'] = date('Y-m-d H:i:s');
		$_SESSION["printorderid"] = add_record("printorders", $data2);
		unset($_SESSION['add_name_templates']);
}

if($_POST['tag'] == 4){
	$_POST = array_map('strip_javascript_input',$_POST);
    	$_SESSION["numofbadges"] = 0;
	$_SESSION["numofframes"] = 0;
	$_SESSION["numofabadges"] = 0;
	$_SESSION["numofaframes"] = 0;
	$_SESSION["numofdomes"] = 0;
	$_SESSION["numofadome"] = 0;
	$_SESSION["tag"] = $_POST["tag"];
        $data2["custid"] = $_SESSION["customerloginid"];
	$data2['timestamp'] = date('Y-m-d H:i:s');
	$_SESSION["printorderid"] = add_record("printorders", $data2);
}

?>
<?php 
if ($_SESSION["customerloginid"])
{
	include_once 'inc/header-auth.php';
} else {
	include_once 'inc/header.php' ;
} ?>
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>

<script type="text/javascript" src="<?php echo $base_url;?>/js/jscolor.js"></script>
<script src="<?php echo $base_url;?>/js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url;?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url;?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" /><style> .img_btn {    background: url("images/addNameButton.png") no-repeat scroll 0 0 transparent;    border: medium none;    cursor: pointer;    height: 27px;    text-indent: -200px;    width: 95px;}</style>
<script language="javascript">
function formatCurrency(num) {
	
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '$' + num + '.' + cents);
}
function recalc2()
{
	recalc();
}
function recalc()
{
	num = parseInt(document.getElementById('numofbadges').value) + parseInt(document.getElementById('numofabadges').value);
	framenum = parseInt(document.getElementById('numofframes').value) + parseInt(document.getElementById('numofaframes').value);
	domenum = parseInt(document.getElementById('numofdomes').value) + parseInt(document.getElementById('numofadome').value);
	if(num>= 1001 && num< 5000){
		badgeprice = num * 3.89;
		badge = 3.89;
	}else if (num < 1001 && num > 250)
	{
		badgeprice = num * 4.90;
		badge = 4.90;
	} else if (num < 251 && num > 100) {
		 badgeprice = num * 5.65;
		 badge = 5.65;
	} else if (num < 101 && num > 50) {
		badgeprice = num * 5.95;
		badge = 5.95;
	} else if (num < 51 && num > 25) {
		 badgeprice = num * 6.85;
		 badge = 6.85;
	} else if (num < 26 && num > 10) {
		 badgeprice = num * 8.10;
		 badge = 8.10;
	} else {
		 badgeprice = num * 9.37;
		 badge = 9.37;
	}
	frameprice = framenum * 2;
	dome_total  = domenum*2.75
	if(num =='NaN'){	
		document.getElementById('badgetimes').value = 0 + " x " + formatCurrency(badge) + " = ";
	}else {
		document.getElementById('badgetimes').value = num + " x " + formatCurrency(badge) + " = ";
	}

	/*if(badgeprice ='NaN'){
		document.getElementById('badgetotal').value = 0;
	}else{
		document.getElementById('badgetotal').value = formatCurrency(badgeprice) ;
	}*/
	document.getElementById('badgetotal').value = formatCurrency(badgeprice) ;
	if(framenum == 'NaN')
	{
		document.getElementById('frametimes').value = 0 + " x $2.00 = ";
	}else{
		document.getElementById('frametimes').value = framenum + " x $2.00 = ";
	}
	document.getElementById('frametotal').value = formatCurrency(frameprice);
	if(domenum == 'NaN'){
		document.getElementById('dome_show_calc').value = 0 + " x $2.75 = ";
	}else{
		document.getElementById('dome_show_calc').value = domenum + " x $2.75 = ";
	}
	document.getElementById('dometotal').value = formatCurrency(dome_total) ;
	
	//alert(frameprice);
	
	totalprice = dome_total + badgeprice + frameprice;
	document.getElementById("ordertotal").value =formatCurrency(totalprice);
}

function processimage(frame2) {
	tag = '<?php echo $_SESSION["tag"]; ?>';
    left = '<?php echo $_SESSION["left"]; ?>';
	down = '<?php echo $_SESSION["down"]; ?>';
	left2 = '<?php echo $_SESSION["left2"]; ?>';
	down2 = '<?php echo $_SESSION["down2"]; ?>';
	left3 = 100;
	down3 = 20;
	leftt = '<?php echo $_SESSION["leftt"]; ?>';
	downt = '<?php echo $_SESSION["downt"]; ?>';
	img1w = '<?php echo $_SESSION["img1w"]; ?>';
	img1h = '<?php echo $_SESSION["img1h"]; ?>';
	img2w = '<?php echo $_SESSION["img2w"]; ?>';
	img2h = '<?php echo $_SESSION["img2h"]; ?>';
	leftt2 = '<?php echo $_SESSION["leftt2"]; ?>';
	downt2 = '<?php echo $_SESSION["downt2"]; ?>';
	leftt3 = '<?php echo $_SESSION["leftt3"]; ?>';
	downt3 = '<?php echo $_SESSION["downt3"]; ?>';
	font1 = "<?php echo $_SESSION["font1"]; ?>";
	font2 = "<?php echo $_SESSION["font2"]; ?>";
	font3 = "<?php echo $_SESSION["font3"]; ?>";
	font1size = '<?php echo $_SESSION["font1size"]; ?>';
	font2size = '<?php echo $_SESSION["font2size"]; ?>';
	font3size = '<?php echo $_SESSION["font3size"]; ?>';
	
	
	if (tag == 1)
	{
		url = "ajax/create_image.php?left=" + left + "&down=" + down + "&left2=" + left2 + "&down2=" + down2 + "&left3=" + left3 + "&down3=" + down3 + "&leftt=" + leftt + "&downt=" + downt + "&img1h=" + img1h + "&img1w=" + img1w + "&img2h=" + img2h + "&img2w=" + img2w + "&leftt2=" + leftt2 + "&downt2=" + downt2 + "&font1=" + font1 + "&font2=" + font2 + "&font3=" + font3 + "&font1size=" + font1size + "&font2size=" + font2size + "&font3size=" + font3size + "&frame=" + frame2 + "&font3=" + font3 + "&leftt3=" + leftt3 + "&downt3=" + downt3;
		
	} else {
		url = "ajax/create_image2.php?left=" + left + "&down=" + down + "&left2=" + left2 + "&down2=" + down2 + "&leftt=" + leftt + "&downt=" + downt + "&img1h=" + img1h + "&img1w=" + img1w + "&img2h=" + img2h + "&img2w=" + img2w + "&leftt2=" + leftt2 + "&downt2=" + downt2 + "&font1=" + font1 + "&font2=" + font2 + "&font1size=" + font1size + "&font2size=" + font2size + "&frame=" + frame2 + "&font3=" + font3+ "&font3size=" + font3size + "&leftt3=" + leftt3 + "&downt3=" + downt3;
	}
	
	
  
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
		req_fifo.onreadystatechange = gotprocess;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}

    
	
}
function processimage_new(frame2) {
	tag = '<?php echo $_SESSION["tag"]; ?>';
	left2 = '<?php echo $_SESSION["left2"]; ?>';
	down2 = '<?php echo $_SESSION["down2"]; ?>';
	backgroundimage = '<?php echo $_SESSION['backgroundimage'];?>';
	leftt = '<?php echo $_SESSION['left_img1']; ?>';
	downt = '<?php echo $_SESSION['top_img1']; ?>';
	img1w = '<?php echo $_SESSION['img1_width']; ?>';
	img1h = '<?php echo $_SESSION['img1_height']; ?>';
	img2w = '<?php echo $_SESSION['img2_width']; ?>';
	img2h ='<?php echo $_SESSION['img2_height']; ?>';
	leftt2 = '<?php echo $_SESSION['left_img2']; ?>';
	downt2 = '<?php echo $_SESSION['top_img2']; ?>';
	font1 = "<?php echo $_SESSION["font1"]; ?>";
	font2 = "<?php echo $_SESSION["font2"]; ?>";
	font3 = "<?php echo $_SESSION["font3"]; ?>";
	font1size = '<?php echo $_SESSION["font1size"]; ?>';
	font2size = '<?php echo $_SESSION["font2size"]; ?>';
	font3size = '<?php echo $_SESSION["font3size"]; ?>';
	text1 = '<?php echo $_SESSION['text1'];?>';
	text2 = '<?php echo $_SESSION['text2'];?>';
	text3 = '<?php echo $_SESSION['text3'];?>';
	
	text1_x = '<?php echo $_SESSION['text1_x'] ?>';
	text1_y = '<?php echo $_SESSION['text1_y'] ?>';
	
	text2_x = '<?php echo $_SESSION['text2_x'] ?>';
	text2_y = '<?php echo $_SESSION['text2_y'];?>';
	
	text3_x = '<?php echo $_SESSION['text3_x'] ?>';
	text3_y = '<?php echo $_SESSION['text3_y'];?>';
	frame = frame2;
	
	font1_color = '<?php echo $_SESSION['font1color']?>';
	font2_color = '<?php echo $_SESSION['font2color']?>';
	font3_color = '<?php echo $_SESSION['font3color']?>';
	$.ajax({
				 url : "<?php echo $base_url?>/ajax/create_image5.php",
				 dataType:'POST',
				 data: {
					img1_height:img1h,
					img1_width:img1w,
					img2_height:img2h,
					img2_width:img2w,
					frame:frame,
					logo1: '<?php echo $_SESSION["logo1"];?>',
					logo2: '<?php echo $_SESSION["logo2"];?>',
					text1: text1,
					text2:text2,
					text3:text3,
					font1_select: font1,
					font2_select: font2,
					font3_select: font3,
					backgroundimage: backgroundimage,
					text_fontsize_1: font1size,
					text_fontsize_2: font2size,
					text_fontsize_3:font3size,
					left_img1: leftt,
					top_img1: downt,
					left_img2: leftt2,
					top_img2: downt2,
					text1_x:text1_x  ,
					text1_y:text1_y ,
					text2_x: text2_x,
					text2_y: text2_y,
					text3_x: text3_x,
					text3_y: text3_y,
					font1_color: font1_color,
					font2_color:font2_color,
					font3_color:font3_color
				 },
				 complete: function(value) {	
				 //	console.log(value.responseText);
				 	//alert(value.responseText);	
					$("#bannerimage").attr("src", 'output/'+value.responseText);
				 }
			});	
}	
function gotprocess() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	var info = req_fifo.responseText;
	//alert(info);
	var ary=info.split("??");
	//alert(ary);
	document.getElementById('bannerimage').src = ary[0];
	document.getElementById('badgestyle').innerHTML = '<p style="float: left; font-size: 10px; width: 150px; text-align: left;">Badge Style:<br /><strong>'+ary[1]+'</strong></p>';
	document.getElementById('colorname').innerHTML = '<p style="float: right; font-size: 10px; width: 85px; text-align: left;" >Color:<br /><strong>'+ary[2]+'</strong></p>';
	document.getElementById('framestyle').innerHTML = '<p style="float: right; font-size: 10px; width: 60px; text-align: left;">Frame:<br /><strong>'+ary[3]+'</strong></p>';
	
	if (ary[3] == "none")
	{
		//document.getElementById('numofframes').value = 0;
		document.getElementById('numofframes').value = document.getElementById('numofframes').value;
	} else {
		//document.getElementById('numofframes').value = document.getElementById('numofbadges').value;
	}
	addnamerefresh();
	
	
	// Schedule next call to wait for fifo data
   //setTimeout("GetAsyncData()", 100);
   //return;
}

function removename(id)
{
	
	url = "ajax/add_name.php?removeid="+id;
	var remove  = document.getElementById("dome_remove_"+id).value;
	//alert(renove);
	var dome_total = document.getElementById("dome_total").value;
	if(remove == 1){	
		curdomes  = parseInt(document.getElementById('numofdomes').value);
		if (curdomes > 0)
		{
			curdomes = curdomes - 1;
			document.getElementById('numofdomes').value = curdomes;
		}

		dome_total = parseInt(dome_total) - 1;
		if(dome_total  < 0){
			dome_total = 0;	
		}
		var dome_total = document.getElementById("numofdomes").value;
		document.getElementById("dome_total").value = dome_total;
		document.getElementById("dome_show_calc").value=dome_total + " x " + formatCurrency(2.75) + " = ";
		document.getElementById("dometotal").value = "$" + dome_total*2.75;
	}
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
		req_fifo.onreadystatechange = removedname;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}
}
function addnamerefresh()
{
		
	url = "ajax/add_name.php?refresh=1";
	
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
		req_fifo.onreadystatechange = addednamerefresh;
	    req_fifo.open("POST", url, true);
		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	   	req_fifo.send(null);
	}
}
function addednamerefresh() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	
	var info = req_fifo.responseText;
	document.getElementById('namelist').innerHTML=info;
	if (document.getElementById('text1').value != "")
	{
		addname();
	} else {
		recalc();
	}
		
}
/**
*
*  URL encode / decode
*  http://www.webtoolkit.info/
*
**/
 
var Url = {
 
	// public method for url encoding
	encode : function (string) {
		return escape(this._utf8_encode(string));
	},
 
	// public method for url decoding
	decode : function (string) {
		return this._utf8_decode(unescape(string));
	},
 
	// private method for UTF-8 encoding
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}

function addname()
{
   // alert('aa');
        document.getElementById("addnamebutton").disabled = true;
    	text1 = Url.encode(document.getElementById("text1").value);
    	text2 = Url.encode(document.getElementById("text2").value);
    	text3 = Url.encode(document.getElementById("text3").value);
        
    	dome1  = document.getElementById("dome").value;
    	//alert(dome1);
    	curbadge = parseInt(document.getElementById('numofbadges').value);
    	numofframes = parseInt(document.getElementById('numofframes').value);
    	numofdomes = parseInt(document.getElementById('numofdomes').value);
    	
    	curbadge = curbadge + 1;
    	numofbadges = curbadge;
    	if(dome1 == 1){
    		numofdomes = numofdomes + 1;	
    	}
    	
    	for (var i=0; i < document.frameform.frame.length; i++)
      	{
       		if (document.frameform.frame[i].checked)
      		{
    			 var rad_val = document.frameform.frame[i].value;
       		}
      	}
    
    	if (rad_val != "none")
      	{
    		numofframes = numofframes + 1;
    	}
    	
    	
    	numofabadges = document.getElementById("numofabadges").value;
    	numofaframes = document.getElementById("numofaframes").value;
    	numofadome = document.getElementById("numofadome").value;
    	document.getElementById("text1").value = "";
    	document.getElementById("text2").value = "";
    	document.getElementById("text3").value = "";
    	
    	var val = 0;
    
    	for( i = 0; i < document.namefields.fastener.length; i++ )
    	{
    		if( document.namefields.fastener[i].checked == true )
    		fastener2 = document.namefields.fastener[i].value;
    	}
    
    	
    	//url = "ajax/add_name.php?text1="+text1+"&text2="+text2+"&text3="+text3+"&fastener="+fastener2+"&numofbadges="+numofbadges+"&numofframes="+numofframes+"&numofabadges="+numofabadges+"&numofaframes="+numofaframes+"&numofadome="+numofadome+"&dome="+dome1+"&font1size=<?php echo $_SESSION["font1size"]; ?>&font2size=<?php echo $_SESSION["font2size"]; ?>&font3size=<?php echo $_SESSION["font1size"]; ?>&font1=<?php echo $_SESSION['font1']?>&font2=<?php echo $_SESSION['font2']?>&font3=<?php echo $_SESSION['font3']?>";
    	url = "ajax/add_name.php?text1="+text1+"&text2="+text2+"&text3="+text3+"&fastener="+fastener2+"&numofbadges="+numofbadges+"&numofframes="+numofframes+"&numofdomes="+numofdomes+"&numofabadges="+numofabadges+"&numofaframes="+numofaframes+"&numofadome="+numofadome+"&dome="+dome1+"&font1size=<?php echo $_SESSION["font1size"]; ?>&font2size=<?php echo $_SESSION["font2size"]; ?>&font3size=<?php echo $_SESSION["font3size"]; ?>&font1=<?php echo $_SESSION['font1']?>&font2=<?php echo $_SESSION['font2']?>&font3=<?php echo $_SESSION['font3']?>";
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
    		req_fifo.onreadystatechange = addedname;
    	    req_fifo.open("POST", url, true);
    		req_fifo.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    	   	req_fifo.send(null);
    	}
	
}
function addedname() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	var dome_check  = document.getElementById("dome").value;
	var dome_total  = document.getElementById("dome_total").value;
	curdomes  = parseInt(document.getElementById('numofdomes').value);
	if(dome_check == 1){
		curdomes  = curdomes + 1;
		document.getElementById('numofdomes').value = curdomes;
		dome_total = parseInt(dome_total) + 1;
		if(dome_total  < 0){
			dome_total = 0;	
		}
		document.getElementById("dome_total").value = dome_total;
		document.getElementById("dome_show_calc").value=dome_total + " x " + formatCurrency(2.75) + " = ";
		document.getElementById("dometotal").value = "$" + dome_total*2.75;
	}
	var info = req_fifo.responseText;
	document.getElementById('namelist').innerHTML=info;
	curbadge = parseInt(document.getElementById('numofbadges').value);
	curframes = parseInt(document.getElementById('numofframes').value);
	
	curbadge = curbadge + 1;
	document.getElementById('numofbadges').value = curbadge;
	
	for (var i=0; i < document.frameform.frame.length; i++)
  	{
   		if (document.frameform.frame[i].checked)
  		{
			 var rad_val = document.frameform.frame[i].value;
   		}
  	}

	if (rad_val != "none")
  	{	
		curframes = curframes + 1;
		document.getElementById('numofframes').value = curframes;
	}	recalc();
	document.getElementById("addnamebutton").disabled = false;}
function removedname() {
// only if req_fifo shows "loaded"
	if (req_fifo.readyState != 4 || req_fifo.status != 200) {
    	return;
    }

	
	var info = req_fifo.responseText;
	document.getElementById('namelist').innerHTML=info;
	curbadge = parseInt(document.getElementById('numofbadges').value);
	curframes = parseInt(document.getElementById('numofframes').value);
	//curdomes  = parseInt(document.getElementById('numofdome').value);
	if (curbadge > 0)
	{
		curbadge = curbadge - 1;
		document.getElementById('numofbadges').value = curbadge;
	}
	
	if (curframes > 0)
	{
		curframes = curframes - 1;
		document.getElementById('numofframes').value = curframes;
	}
	recalc();
	
}
function add_dome(value){
	document.getElementById("dome").value= value;
}
$(document).ready(function(){
   // alert('aaa');
   	recalc();
});
</script>
    <div id="content">
    <div id="mainContentFull">
	  <h2>Review Your Badge Selection And Pricing</h2>

	  <br /><br />
	<div style="margin-bottom: 15px;font-family: Arial;">	
		 <div style="float: left; width: 200px;padding-top: 15px;"><h3 style="font-family:Arial black;font-size: 15px;float: right; padding-right: 15px;text-shadow: 1px 0px #000;">Just 3 Simple Steps:</h3></div> <div class="step"><a href="<?php echo $base_url?>/wizard.php"><h1>Step 1:</h1> Create A Badge Template</a></div><div style="margin-left: -22px;" class="step stepactive"><h1>Step 2:</h1> <div style="weight: 1px;"></div> Add Names And Review Pricing</div><div style="margin-left: -22px;"  class="step"><h1>Step 3:</h1> Submit Your Order</div>
	</div>
    <div style="clear: both;"></div>
    <div style="padding-bottom: 5px;">
        <div style="margin-top: 10px; text-align: center;"><strong>Now that you have created your template...</strong></div>
        <p style="text-align: center;">
            On this page, you will add the names/information for each name badge. If you would like a badge with no name,
            then leave <br /> 
            the text fields blank and click "Add Name" - this will create a blank badge with just your logo(s).  
        </p>
    </div>
    <div style="text-align: center;padding-bottom: 20px;">
        <strong style="color:#7D9834 ;">Larger Quantity? </strong>
             <a onclick="return GB_showCenter('', this.href,800,1000)"   style="color: #435F86;" href="instruction.php">Click Here</a> For Instructions 
    </div>
    
    <div  style="width: 960px;margin: 0 auto;">
        <div style="float: left;width: 350px;padding-left: 100px;">
            <div style="float: left;width: 150px; text-align:center;margin-top: 25px;" >
                <a onclick="return GB_showCenter('', this.href,310,580)" style="color: #435F86;" href="<?php echo $base_url?>/output/<?php echo $_SESSION["bannername"] ?>">Click Here </a> <font color="#7D9834">To<br /> Enlarge Badge Preview: </font> 
               <!--  <a rel="gb_image[]" style="color: #435F86;" href="<?php echo $base_url?>/output/<?php echo $_SESSION["bannername"] ?>">Click Here </a> <font color="#7D9834">To<br /> Enlarge Badge Preview: </font> -->
            </div>
            <div style="float: right;width: 200px;" >
                <?php 
    			  $rate  = 580/200;;
    			  ?>
                  <div id="imageshow" name="imageshow" style="height:<?php echo 310/$rate?>px; width: 200px; float: left;">
    			  <?php
    			  if(isset($_REQUEST['template'])){
    				echo '<img src="output/'.$_SESSION["bannername"].'" id="bannerimage" name="bannerimage"/>'; 
    			  }else{
    			  ?>	
    			  <?php if(isset($_SESSION["wirard"]) && ($_SESSION["wirard"] == 1)){ ?>
    			   <img src="output/<?php echo $_SESSION["bannername"]; ?>" id="bannerimage" name="bannerimage"/> 
    			   <?php } else {?>
    				<img src="output/<?php echo $_SESSION["bannername"]; ?>" id="bannerimage" name="bannerimage"/> 
    			   <?php }
    			   }
    			   ?>
                </div>    
            </div>
        </div>
        <div style="float: right;width: 480px;">
            <div style="float: left;width: 150px; text-align:center;margin-top: 25px;" ><a onclick="return GB_showCenter('', this.href,400,900)" style="color: #435F86;" href="price.php">Click Here </a> <font color="#7D9834">To View<br /> Quantity Pricing Table: </font></div>
            <div style="float: right;width: 320px;" >
                <img src="images/price.png" /> 
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div style="float: right;">
    </div>
    
      </div>
      
    </div>

      
      
	  <div id="addNamesLeft">	  
      <div id="logoBox" style="width: 450px;">
      	<div class="boxHeader"><span style="float: left;">Add A Name</span></div>
      	<div class="boxSub" style="border-bottom: none;">
        	  <div class="boxSub2" style="display: none;"></div>
        </div>
        <form method="post" name="namefields">     
      	<div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft" style="height: 95px;">Text:</div>
            <?php if(($_SESSION["wirard"] == 1) && isset($_SESSION["wirard"])){?>
             <div class="signUpFieldRight" style="height: 95px; width: 303px;">
           		Name: <input type="text" name="text1" id="text1" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["text1"]; ?>"/><br />
           		Line 2: 
                <input type="text" name="text2" id="text2" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["text2"]; ?>"/><br />
                Line 3: 
                 <input type="text" name="text3" id="text3" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["text3"]; ?>"/>	
            </div>
            <?php }else{ ?>
            <div class="signUpFieldRight" style="height: 95px; width: 303px;">
           		Name: <input type="text" name="text1" id="text1" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["logotext1"]; ?>"/><br />
           		Line 2: 
                <input type="text" name="text2" id="text2" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["logotext2"]; ?>"/><br />
                Line 3: 
                 <input type="text" name="text3" id="text3" style="width: 200px;" class="signupFieldInput" value="<?php echo $_SESSION["logotext3"]; ?>"/>	
            </div>
            <?php } ?>
            </div>
          
          <div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
            <div class="signUpFieldLeft">Fastener:</div>
            <div class="signUpFieldRight" style="width: 303px;">
            <input type="hidden" name="tag" value="1" />
<input type="radio" name="fastener" id="fastener" value="None"/> None&nbsp;&nbsp;<input type="radio" name="fastener" id="fastener" checked value="Magnet" /> Magnet&nbsp;&nbsp;<input type="radio" name="fastener" id="fastener" value="Pin"  /> Pin
            </div>
		 </form>	
            <div class="signUpFieldLeft">Frame:</div>
            <div class="signUpFieldRight" style="width: 303px;">
			<?php //echo $_POST['tag']?>
			<form name="frameform">
		<?php if ($_SESSION["wirard"] == 1 && !isset($_REQUEST['template'])){?>
            
			<input type="radio" name="frame" value="none" checked onclick="javascript:processimage_new(this.value);"/> None&nbsp;&nbsp;
			<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:processimage_new(this.value);"/> Gold&nbsp;&nbsp;
			<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:processimage_new(this.value);" /> Silver
		<?php
		}else if(isset($_REQUEST['template']) && $_REQUEST['template'] == 1){
		?>
			<input type="radio" name="frame" value="none" checked /> None&nbsp;&nbsp;
			<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> /> Gold&nbsp;&nbsp;
			<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> /> Silver
		<?php
		}else{	
		?>
			<input type="hidden" name="tag" value="1" />
			<input type="radio" name="frame" value="none" checked onclick="javascript:processimage(this.value);"/> None&nbsp;&nbsp;<input type="radio" name="frame" value="gold" <?php if ($_SESSION["frame"] == "gold") { ?>checked<?php } ?> onclick="javascript:processimage(this.value);"/> Gold&nbsp;&nbsp;
			<input type="radio" name="frame" value="silver" <?php if ($_SESSION["frame"] == "silver") { ?>checked<?php } ?> onclick="javascript:processimage(this.value);" /> Silver
		<?php
		}?>
			</form>
            </div>
			<div class="signUpFieldLeft">Add A Dome: <span class="hotspot" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" onmouseover="tooltip.show('<strong>Polyurethane Domed Lens</strong><br>Give your badges added protection and a professional glassy appearance with our hand applied domed lenses.  A permanent polyurethane coating is added to the top of the badge and cured.  The result is a stunning domed lens with some serious added protection.');" onmouseout="tooltip.hide();">(What's This?)</span></div>
			<div class="signUpFieldRight" style="width: 303px;">
				<input type="radio" onclick="add_dome(this.value)" name="dome_choose" <?php if($_SESSION['dome']==1){ echo 'checked';}?> value="1" /> Yes&nbsp;&nbsp;<input onclick="add_dome(this.value)" <?php if($_SESSION['dome']==0){ echo 'checked';}?> type="radio" name="dome_choose" value="0" /> No&nbsp;&nbsp;
			</div>
			<input type="hidden" name="dome" id="dome" value="<?php echo $_SESSION['dome'];?>"   />
          </div>
         
          <div class="signUpField" >
            <div style="height: 30px; text-align: center; line-height: 30px; margin-top:15px; margin-bottom: 15px;">				<!-- <img src="images/addNameButton.png" id="addnamebutton"name="addnamebutton" onclick="addname();"/> -->				<input  type="button" value="ADD NAME" class="img_btn" id="addnamebutton" name="addnamebutton" onclick="addname();" />			</div>
          
      </div>
     </div><!-- end logoBox -->
     
	 <form method="post" action="checkout.php" name="checkoutpost">
     <div id="logoBox" style="width: 450px; float: left; margin-top: 25px;border-right: 1px solid #CCC;border-left: 1px solid #CCC;border-bottom: 1px dashed #CCCCCC;">
        <div class="boxorder"><span style="float: left;">Your Order</span></div>
        <div style="border-bottom: none;" class="boxSub">
        	  <div style="display: none;" class="boxSub2"></div>
        </div>
     	<div style="float: left; width: 170px;border-bottom: 1px dashed #CCCCCC;height:30px;">
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  >                
               <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Badges:</div> 
            </div>
            <div style="float: right;margin-top: 5px;">
		<?php 
			 if(isset($_SESSION["numofbadges"]) &&  $_SESSION["numofbadges"] >0)
			{
				$numofbadges = 	 $_SESSION["numofbadges"];			
			}else {
				$numofbadges = 0;	
			}
		?>
                <input type="text" name="numofbadges" id="numofbadges" maxlength="10" style="width: 30px; border:none;" class="quantityNumber" value="<?php echo $numofbadges; ?>"/>
            </div>
        </div>
       
       <div style="float: right; width: 280px;border-bottom: 1px dashed #CCCCCC;height:30px;">
        	<div style="padding-left: 5px;width: 150px;float: left;border-left: 1px solid #CCC;height: 100%;background-color: #F5F6E7;border-right: 1px solid #CCC;"  >
                <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Prepay For Extra Badges:</div> 
            </div>
            <div  style="float: left;padding-left: 5px;">    
                <input type="text" name="numofabadges" id="numofabadges"  maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();" value="<?php echo $_SESSION["numofabadges"]; ?>"/>     <a class="hotspot" onmouseover="tooltip.show('<strong>Take advantage of quantity ordering</strong> by prepaying for additional badges for later.  Add additional badges to your order and you can get great higher quantity rates.  You can simply log into your account at a later date and use these badges at your convenience, with no additional billing or shipping charges!');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" href="javascript:void()">(What's This?)</a>
            </div>
        </div>
       
        <div style="float: left; width: 170px;border-bottom: 1px dashed #CCCCCC;height:30px;">
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  >  
                <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Frames:</div>
             </div>
             <div style="float: right;margin-top: 5px;">    
                <input type="text" name="numofframes" id="numofframes" maxlength="10" style="width: 30px; border:none;" class="quantityNumber" value="<?php echo $_SESSION["numofframes"]; ?>"/>
              </div>  
        </div>
       	
        
        <div style="float: right; width: 280px;border-bottom: 1px dashed #CCCCCC;height:30px;">
        	<div style="padding-left: 5px;width: 150px;float: left;border-left: 1px solid #CCC;height: 100%;background-color: #F5F6E7;border-right: 1px solid #CCC;"  >
                <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Prepay For Extra Frames:</div>
            </div>
            <div style="float: left;padding-left: 5px;">   
             <input type="text" name="numofaframes" id="numofaframes" maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();" value="<?php echo $_SESSION["numofaframes"]; ?>"/>  <a class="hotspot" onmouseover="tooltip.show('<strong>Take advantage of quantity ordering</strong> by prepaying for additional frames for later.  Add additional frames to your order and you can get great higher quantity rates.  You can simply log into your account at a later date and use these frames at your convenience, with no additional billing or shipping charges!');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" href="javascript:void()">(What's This?)</a>
            </div> 
        </div>
		<div style="float: left; width: 170px;border-bottom: 1px dashed #CCCCCC;height:30px;">
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  > 
                <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Domes:</div>
            </div>
            <div style="float: right;margin-top: 5px;">     
                <input type="text" name="numofdomes" id="numofdomes" maxlength="10" style="width: 30px; border:none;" class="quantityNumber" value="<?php echo $_SESSION["numofdomes"]; ?>"/>
            </div>
        </div>
        
         <div style="float: right; width: 280px;border-bottom: 1px dashed #CCCCCC;height:30px;">
            <div style="padding-left: 5px;width: 150px;float: left;border-left: 1px solid #CCC;height: 100%;background-color: #F5F6E7;border-right: 1px solid #CCC;"  >    
        	<div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Prepay For Extra Domes: </div>
            </div>
            <div style="float: left;padding-left: 5px;">
        	  <input type="text" name="numofadome" id="numofadome"  maxlength="10" style="width: 30px;" class="signupFieldInput" onchange="javascript:recalc2();" value="<?php echo $_SESSION["numofadome"]; ?>"/>  <a class="hotspot" onmouseover="tooltip.show('<strong>Take advantage of quantity ordering</strong> by prepaying for additional domes for later.  Add additional domes to your order and you can get great higher quantity rates.  You can simply log into your account at a later date and use these domes at your convenience, with no additional billing or shipping charges!');" onmouseout="tooltip.hide();" style="font-family: Arial, Helvetica, sans-serif; font-size: 8px; font-weight: normal;" href="javascript:void()">(What's This?)</a>
			</div>
        </div>
        <div style="clear: both;"> </div>
	    <div style="width: 450px;border-bottom: 1px dashed #CCCCCC;height: 30px;">
            <div style="padding-top: 5px;" align="center"><a style="text-align: right;text-align: center;cursor: pointer;">Update Totals</a></div>
        </div>  
		 <div style="clear: both;"></div>
        <div style="float: left; width: 450px;border-bottom: 1px dashed #CCC;height: 30px">
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  >
                 <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">Badge Total:</div>
            </div>
            <div style="float: right;width: 340px;">
                 <div style="margin-top: 5px; padding-left: 20px;">
                  <input type="text" name="badgetimes" id="badgetimes" maxlength="15" style="width: 70px; border:none;" value="0" class="popBoxSmall" readonly/> <input type="text" name="badgetotal" id="badgetotal" maxlength="15" style="width: 65px; border:none; font-size:14px;" value="" class="quantityNumber" readonly/>
                </div>  
            </div> 
        </div>
        <div style="float: left; width: 450px;border-bottom: 1px dashed #CCC;height: 30px">            
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  >
                 <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">
                    Frame Total:
                 </div>
            </div>
            <div style="float: right;width: 340px;">
                <div style="margin-top: 5px; padding-left: 20px;">
                    <input type="text" name="frametimes" id="frametimes" maxlength="15" style="width: 70px; border:none;" value="0" class="popBoxSmall" readonly /> <input type="text" name="frametotal" id="frametotal" maxlength="15" style="width: 65px; border:none; font-size:14px;" value="" class="quantityNumber" readonly/>
                </div>    
            </div>             
        </div>
		 <div style="float: left; width: 450px;border-bottom: 1px dashed #CCC;height: 30px">            
        	<div style="padding-left: 5px;width: 100px;float: left;border-right: 1px solid #CCC;height: 100%;background-color: #F5F6E7;"  >
                 <div style="margin-top: 5px;font-size: 11px; font-weight: bold; line-height: 30px;color: #333333;">
                    Dome Total:
                 </div>
            </div>
            <div style="float: right;width: 340px;">     
                <div style="margin-top: 5px; padding-left: 20px;">   
        			<input type="hidden" name="dome_total" id="dome_total" maxlength="15" value="0" />
        			<input type="text" name="dome_show_calc"   id="dome_show_calc" style="width: 70px; border:none;" value="0" class="popBoxSmall" readonly /> 
        			<input type="text" name="dometotal" id="dometotal" maxlength="15" style="width: 65px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/></p>
                 </div>   
           </div> 
        </div>
        <div style="clear: both;"></div>
        <div style="width: 450px; text-align: center;border-bottom: 1px dashed #CCC;">
        	<div style="margin-top: 15px;padding-bottom: 10px;" align="center">Order Total: <input type="text" name="ordertotal" id="ordertotal" maxlength="15" style="width: 75px; border:none; font-size:14px;" value="0" class="quantityNumber" readonly/></div>
            <div align="center" style="padding-bottom:  15px;margin-left:-35px"><img src="images/checkoutButton.png" onclick="checkoutpost.submit();"/></div>
        </div>
     </div>
     </form>
      </div>
      
      <div id="addNamesRight"><a name="names"></a>
      	<div class="boxHeader"><span style="float: left;">Your Badge Order (Names List)</span></div>
       
	   <div id="namelist" name="namelist">
       <?php 
       if(isset($_SESSION["printorderid"])){
	    $qry = "SELECT * FROM batches WHERE printorderid = ".$_SESSION["printorderid"]." ORDER BY id";
		$names = mysql_query($qry);
		$name = mysql_fetch_assoc($names);
		$_SESSION["badgecount"] = mysql_num_rows($names);

		if ($name) { 
			$x = 1;
			do{ ?>
			<!-- name -->
				<div class="signUpField" style="border-top-width: 1px; border-top-style: dashed; border-top-color: #CCC;">
					<div class="signUpFieldLeft" style="width: 75px; height: 60px;">Name <?php echo $x; ?>:</div>
					<div class="signUpFieldRight" style="width: 363px; font-size: 11px; height: 60px; line-height: 14px;">
						<div style="float: left; width: 250px;">
						<table cellpadding="0" cellspacing="0" height="48"><tr style="font-size: 11px;"><td valign="middle">
							<strong>Name:</strong>  <?php echo $name["name"]; ?> <br />
							<strong>Line 2:</strong>  <?php echo $name["subtext"]; ?> <br />
							<strong>Line 3:</strong>  <?php echo $name["subtext2"]; ?> <br />
						 </td></tr></table>
						</div>
						<div style="float: right; width: 100px; text-align: center; font-size: 11px;">
						<table cellpadding="0" cellspacing="0" height="48"><tr style="font-size: 11px;">
						  <td valign="middle">
						Frame: <?php echo $name['frame']?></br>  
						Dome: <?php if($name['dome'] == 1){
							echo 'Yes';}else { echo 'No';} ?> <br/>
						Fastener: <?php echo $name["fastener"]; ?><br />
						<a href="#names" onclick="javascript:removename(<?php echo $name["id"]; ?>);">Remove Name</a>
						</td></tr></table>
						</div>
					</div>
					<input type="hidden" value="<?php echo $name['dome']; ?>" id="dome_remove_<?php echo $name["id"]; ?>" name="dome" />
				</div>
			   <!-- end name -->
			  <?php 
			  $x++;
			  } while($name = mysql_fetch_assoc($names)); 
			  }
             } ?>
       </div>
      
        
      </div>
      

    </div><!-- end mainContentFull -->
  
  </div><!-- end content -->
</div><!-- end wrapper -->
<div style="display: none;"><img src="/images/wizard/continueMinus.png" /></div>

<?php include_once 'inc/footer.php' ; ?>
<script language="javascript">
<?php if ($_SESSION["frame"] != "none") { ?>
	//processimage("<?php echo $_SESSION["frame"]; ?>");
	recalc2();
<?php } else { ?>
////	processimage("none");
	recalc2();
<?php } ?>
</script>
<script type="text/javascript" language="javascript" src="<?php echo $base_url;?>/js/toolscript.js"></script>
