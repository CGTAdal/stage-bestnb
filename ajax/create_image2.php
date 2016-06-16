<?php
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//print_r($_POST);
// This script is used to demo the functions available to modify images.
// The functions which can be called to modify the image are held in the include file
// The images that we use are loaded into an array, to make destroying them at the end easier.
// Include the image functions
require_once('../include/inc_imageFunc.php');
// Set the filenames we want to use.

// create an empty array to hold images we are going to create
$imgs=array();
// Load main background with no resizeing
if ($_REQUEST["left"])
{
	$left = $_REQUEST["left"];
	$_SESSION["left"] = $_REQUEST["left"];
}
if ($_REQUEST["down"])
{
	$down = $_REQUEST["down"];
	$_SESSION["down"] = $_REQUEST["down"];
}
if ($_REQUEST["left2"])
{
	$left2 = $_REQUEST["left2"];
	$_SESSION["left2"] = $_REQUEST["left2"];
}
if ($_REQUEST["down2"])
{
	$down2 = $_REQUEST["down2"];
	$_SESSION["down2"] = $_REQUEST["down2"];
}

if ($_REQUEST["leftt"])
{
	$leftt = $_REQUEST["leftt"];
	$_SESSION["leftt"] = $_REQUEST["leftt"];
}
if ($_REQUEST["downt"])
{
	$downt = $_REQUEST["downt"];
	$_SESSION["downt"] = $_REQUEST["downt"];
}

if ($_REQUEST["leftt2"])
{
	$leftt2 = $_REQUEST["leftt2"];
	$_SESSION["leftt2"] = $_REQUEST["leftt2"];
}
if ($_REQUEST["downt2"])
{
	$downt2 = $_REQUEST["downt2"];
	$_SESSION["downt2"] = $_REQUEST["downt2"];
}

if ($_REQUEST["leftt3"])
{
	$leftt3 = $_REQUEST["leftt3"];
	$_SESSION["leftt3"] = $_REQUEST["leftt3"];
}
if ($_REQUEST["downt3"])
{
	$downt3 = $_REQUEST["down23"];
	$_SESSION["downt3"] = $_REQUEST["downt3"];
}
if ($_REQUEST["img1w"])
{
	$img1w = $_REQUEST["img1w"];
	$_SESSION["img1w"] = $_REQUEST["img1w"];
}
if ($_REQUEST["img1h"])
{
	$img1h = $_REQUEST["img1h"];
	$_SESSION["img1h"] = $_REQUEST["img1h"];
}
if ($_REQUEST["img2w"])
{
	$img2w = $_REQUEST["img2w"];
	$_SESSION["img2w"] = $_REQUEST["img2w"];
}
if ($_REQUEST["img2h"])
{
	$img2h = $_REQUEST["img2h"];
	$_SESSION["img2h"] = $_REQUEST["img2h"];
}
if ($_REQUEST["font1"])
{
	$font1 = $_REQUEST["font1"];
	$_SESSION["font1"] = $_REQUEST["font1"];
}
if ($_REQUEST["font2"])
{
	$font2 = $_REQUEST["font2"];
	$_SESSION["font2"] = $_REQUEST["font2"];
}
if ($_REQUEST["font3"])
{
	$font3 = $_REQUEST["font3"];
	$_SESSION["font3"] = $_REQUEST["font3"];
}

if ($_REQUEST["font1size"])
{
	$font1size = $_REQUEST["font1size"];
	$_SESSION["font1size"] = $_REQUEST["font1size"];
}

if ($_REQUEST["font2size"])
{
	$font2size = $_REQUEST["font2size"];
	$_SESSION["font2size"] = $_REQUEST["font2size"];
}

if ($_REQUEST["font3size"])
{
	$font3size = $_REQUEST["font3size"];
	$_SESSION["font3size"] = $_REQUEST["font3size"];
}

if ($_SESSION["font1color"])
{
	$font1color = $_SESSION["font1color"];
	$_SESSION["font1color"] = $_REQUEST["font1color"];
}

if ($_SESSION["font2color"])
{
	$font2color = $_SESSION["font2color"];
	$_SESSION["font2color"] = $_REQUEST["font2color"];
}

if ($_SESSION["font3color"])
{
	$font3color = $_SESSION["font3color"];
	$_SESSION["font3color"] = $_REQUEST["font3color"];
}

if ($_REQUEST["frame"])
{
	$frame = $_REQUEST["frame"];
	$_SESSION["frame"] = $_REQUEST["frame"];
}

if ($frame == "gold")
{
	$fr = explode(".", $_SESSION["backgroundimage"]);
	$backgroundfilename = "../blanks/".$fr[0]."_Gframe.jpg";
} else if ($frame == "silver") {
	$fr = explode(".", $_SESSION["backgroundimage"]);
	$backgroundfilename = "../blanks/".$fr[0]."_Sframe.jpg";
} else {
	$backgroundfilename = '../blanks/'.$_SESSION["backgroundimage"];
}
$imgs['background'] = LoadImage($backgroundfilename,0,0);

if ($_SESSION["bannername1"])
{
	$memberfilename = "../../logos/".$_SESSION["bannername1"];
	$imgs['member1'] = LoadImage($memberfilename,$img1h, $img1w);
	$imgs['combine'] = MergeImage ($imgs['background'],$imgs['member1'],$left,$down,$img1w, $img2h);
	//$memberfilename = "../logos/".$_SESSION["bannername1"];
	//$imgs['member1'] = LoadImage($memberfilename, $img1h, $img1w);
	//$imgs['combine'] = watermark($backgroundfilename,$memberfilename,$left,$down,$img1h, $img1w);
	//$date = getdate();
	//srand ((double) microtime( )*1000000);
	//$random_number = rand(1000000000,9999999999);
	//$newfilename = "../output/".$date[0].$random_number."_banner.png";
	//$_SESSION["bannername"] = $date[0].$random_number."_banner.png";
	//SaveImage($imgs['combine'],$newfilename,'PNG');
	
	if ($_SESSION["bannername2"])
	{
		$memberfilename = "../../logos/".$_SESSION["bannername2"];
		$imgs['member2'] = LoadImage($memberfilename,$img2h, $img2w);
		$imgs['combine'] = MergeImage ($imgs['combine'],$imgs['member2'],$left2,$down2,$img2w, $img2h);
		//$backgroundfilename = $newfilename;
		//$memberfilename2 = "../logos/".$_SESSION["bannername2"];
		//$imgs['member2'] = LoadImage($memberfilename2, $img2h, $img2w);
		//$imgs['combine'] = watermark($backgroundfilename,$memberfilename2,$left2,$down2,50, 50);
		//$date = getdate();
		//srand ((double) microtime( )*1000000);
		//$random_number = rand(1000000000,9999999999);
		//$newfilename = "../output/".$date[0].$random_number."_banner.png";
		//$_SESSION["bannername"] = $date[0].$random_number."_banner.png";
		//SaveImage($imgs['combine'],$newfilename,'PNG');
		//echo "<img src='".$newfilename."'>";
	}
}


// Load member picture with a resize down to 100 x 150 or the closest proportionally
//$imgs['member1'] = LoadImage($memberfilename,150, 100);
//$imgs['member2'] = LoadImage($memberfilename2,150, 100);
// Now we need to combine the two images, putting the memeber image at position 10,10 and with
// 100% transparency
//$imgs['combine'] = MergeImage ($imgs['background'],$imgs['member1'],$left,$down,100);
//$imgs['combine'] = MergeImage ($imgs['combine'],$imgs['member2'],$left2,$down2,100);

// Now we want to write some text onto the picture using verdana bold font.
if ($_SESSION["logotext1"])
{
	$text1 = $_SESSION["logotext1"];
} else {
	$text1 = " ";
}

$font='../fonts/'.$font1;

if ($imgs['combine'])
{
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],$leftt,$downt,$text1,$font,$font1size, $font1color, 0, 0);
} else {
	$imgs['combine'] = WriteTextOnImage($imgs['background'],$leftt,$downt,$text1,$font, $font1size, $font1color, 0, 0);
}

if ($_SESSION["logotext2"])
{
	$text2 = $_SESSION["logotext2"];
} else {
	$text2 = " ";
}

$font='../fonts/'.$font2;

if ($imgs['combine'])
{
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],$leftt2,$downt2,$text2,$font,$font2size, $font2color, 0, 0);
} else {
	$imgs['combine'] = WriteTextOnImage($imgs['background'],$leftt2,$downt2,$text2,$font, $font2size, $font2color, 0, 0);
}

if ($_SESSION["logotext3"])
{
	$text3 = $_SESSION["logotext3"];
} else {
	$text3 = " ";
}


$font='../fonts/'.$font3;

if ($imgs['combine'])
{
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],$leftt3,$downt3,$text3,$font,$font3size, $font3color, 0, 0);
} else {
	$imgs['combine'] = WriteTextOnImage($imgs['background'],$leftt3,$downt3,$text3,$font, $font3size, $font3color, 0, 0);
}


// Now we have written all the text, so we now want to write out the file to disk. 
// If you want to just show the image in a browser, then comment out the line below
// Currently it is outputing a PNG file, but you can call the SaveImage file with a type of
// JPEG or GIF or WBMP for those file types instead. Make sure that the filename has the 
// correct extension i.e. x.jpg, x.gif, x.wbmp
	$date = getdate();
	srand ((double) microtime( )*1000000);
	$random_number = rand(1000000000,9999999999);
	if ($_SESSION["bannername"])
	{
		if (file_exists("../output/".$_SESSION["bannername"]) )
		{
			//unlink("../output/".$_SESSION["bannername"]);
		}
	}
	$newfilename = "../output/".$date[0].$random_number."_banner.png";
	$_SESSION["bannername"] = $date[0].$random_number."_banner.png";

SaveImage($imgs['combine'],$newfilename,'PNG');
// Now we must destroy all the images created to ensure memory is not held
// We suppress errors here, in case the image has been destroyed alread, and it 
// really does not matter that we get an error, since we are just doing some housekeeping
foreach ($imgs as $x) {
	@imagedestroy($x);
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


echo "output/".$_SESSION["bannername"]."??".$style["size"]." - ".$style["name"]."??".$color2["name"]."??".$_SESSION["frame"];
?>
