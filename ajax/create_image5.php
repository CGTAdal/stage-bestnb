<?php 
session_start();
$_SESSION["bg_banner"] = '';
$_SESSION['dome'] = $_REQUEST['dome'];

// This script is used to demo the functions available to modify images.
// The functions which can be called to modify the image are held in the include file
// The images that we use are loaded into an array, to make destroying them at the end easier.
// Include the image functions
require_once('../include/inc_imageFunc.php');
// process create images 
$_SESSION["wirard"] = 1;
$bg_banner  = $_REQUEST["backgroundimage"];
$_SESSION['backgroundimage'] = $_REQUEST["backgroundimage"];
$imgs=array();

// save position (top and left) of text1
if($_REQUEST['left_text1']){
	$_SESSION['left_text1'] = $_REQUEST['left_text1'];
}else{
	$_SESSION['left_text1'] = '';
}
if($_REQUEST['top_text1']){
	$_SESSION['top_text1'] = $_REQUEST['top_text1'];
}else{
	$_SESSION['top_text1'] = '';
}
$_SESSION['widthimg1'] = $_REQUEST['widthimg1'];
$_SESSION['heightimg1'] = $_REQUEST['heightimg1'];
$_SESSION['widthimg2'] = $_REQUEST['widthimg2'];
$_SESSION['heightimg2'] = $_REQUEST['heightimg2'];
// save postion of left and top text2
if($_REQUEST['left_text2']){
	$_SESSION['left_text2'] = $_REQUEST['left_text2'];
}else{
	$_SESSION['left_text2'] = '';
}
if($_REQUEST['top_text2']){
	$_SESSION['top_text2'] = $_REQUEST['top_text2'];
}else{
	$_SESSION['top_text2'] = '';
}

// save position of left and top text3

if($_REQUEST['left_text3']){
	$_SESSION['left_text3'] = $_REQUEST['left_text3'];
}else{
	$_SESSION['left_text3'] = '';
}
if($_REQUEST['top_text3']){
	$_SESSION['top_text3'] = $_REQUEST['top_text3'];
}else{
	$_SESSION['top_text3'] = '';
}




if($_REQUEST['left_draggable']){
	$_SESSION['left_draggable'] = $_REQUEST['left_draggable'];
}else{
	$_SESSION['left_draggable'] = '';
}

if($_REQUEST['top_draggable']){
	$_SESSION['top_draggable'] = $_REQUEST['top_draggable'];
}else{
	$_SESSION['top_draggable'] = '';
}


if($_REQUEST['left_draggable1']){
	$_SESSION['left_draggable1'] = $_REQUEST['left_draggable1'];
}else{
	$_SESSION['left_draggable1'] = '';
}

if($_REQUEST['top_draggable1']){
	$_SESSION['top_draggable1'] = $_REQUEST['top_draggable1'];
}else{
	$_SESSION['top_draggable1'] = '';
}


if ($_REQUEST["font1_select"])
{
	$font1 = $_REQUEST["font1_select"];
	$_SESSION["font1"] = $_REQUEST["font1_select"];
}
if ($_REQUEST["font2_select"])
{
	$font2 = $_REQUEST["font2_select"];
	$_SESSION["font2"] = $_REQUEST["font2_select"];
}
if ($_REQUEST["font3_select"])
{
	$font3 = $_REQUEST["font3_select"];
	$_SESSION["font3"] = $_REQUEST["font3_select"];
}

if ($_REQUEST["text_fontsize_1"])
{
	$font1size = $_REQUEST["text_fontsize_1"];
}

if ($_REQUEST["text_fontsize_2"])
{
	$font2size = $_REQUEST["text_fontsize_2"];
	
}
if ($_REQUEST["text_fontsize_3"])
{
	$font3size = $_REQUEST["text_fontsize_3"];
}


if ($_REQUEST["frame"])
{
	$frame = $_REQUEST["frame"];
	$_SESSION["frame"] = $_REQUEST["frame"];
}

if ($frame == "gold")
{
	$fr = explode(".", $_REQUEST["backgroundimage"]);
	$backgroundfilename = "../blanks/".$fr[0]."_Gframe.jpg";
} else if ($frame == "silver") {
	$fr = explode(".", $_REQUEST["backgroundimage"]);
	$backgroundfilename = "../blanks/".$fr[0]."_Sframe.jpg";
} else {
	$backgroundfilename = '../blanks/'.$_REQUEST["backgroundimage"];
}
if($_REQUEST['img1_width']){
	$_SESSION['img1_width'] = $_REQUEST['img1_width'];
}
if($_REQUEST['img1_height']){
	$_SESSION['img1_height'] = $_REQUEST['img1_height'];
}


if($_REQUEST['img2_width']){
	$_SESSION['img2_width'] = $_REQUEST['img2_width'];
}
if($_REQUEST['img2_height']){
	$_SESSION['img2_height'] = $_REQUEST['img2_height'];
}

if($_REQUEST['left_img1']){
	$_SESSION['left_img1'] = $_REQUEST['left_img1'];
}
if($_REQUEST['top_img1']){
	$_SESSION['top_img1'] = $_REQUEST['top_img1'];
}

if($_REQUEST['left_img2']){
	$_SESSION['left_img2'] = $_REQUEST['left_img2'];
}
if($_REQUEST['top_img2']){
	$_SESSION['top_img2'] = $_REQUEST['top_img2'];
}


$imgs['background'] = LoadImage($backgroundfilename,0,0);

if ($_REQUEST["logo1"])
{
	$memberfilename = '../logos/'.$_REQUEST["logo1"];	
	$imgs['member1'] = LoadImage($memberfilename,$_REQUEST['img1_width'],$_REQUEST['img1_height']);
	//$imgs['combine'] = MergeImage ($imgs['background'],$imgs['member1'],(int)$_REQUEST['left_img1'],(int)$_REQUEST['top_img1'],(int)$_REQUEST['img1_width'], (int)$_REQUEST['img1_height'] +(int)$_REQUEST['top_img1']);
	$imgs['combine'] = MergeImage($imgs['background'],$imgs['member1'],(int)$_REQUEST['left_img1'],(int)$_REQUEST['top_img1'],(int)$_REQUEST['img1_width'], (int)$_REQUEST['img1_height']);
}

if ($_REQUEST["logo2"])
{
	$memberfilename = '../logos/'.$_REQUEST["logo2"];
	$imgs['member2'] = LoadImage($memberfilename,(int)($_REQUEST['img2_width']), (int)($_REQUEST['img2_height']));
	if ($imgs["combine"])
	{
		$imgs['combine'] = MergeImage ($imgs['combine'],$imgs['member2'],(int)$_REQUEST['left_img2'],(int)$_REQUEST['top_img2'],(int)$_REQUEST['img2_width'], (int)$_REQUEST['img2_height'] +(int)$_REQUEST['top_img2']);
		//$imgs['combine'] = MergeImage ($imgs['combine'],$imgs['member2'],(int)$_REQUEST['left_img2'],(int)$_REQUEST['top_img2'],(int)$_REQUEST['img2_width'], (int)$_REQUEST['img2_height']);
	} else { 
		$imgs['combine'] = MergeImage ($imgs['background'],$imgs['member2'],(int)$_REQUEST['left_img2'],(int)$_REQUEST['img2_height'] - (int)$_REQUEST['top_img2'],(int)$_REQUEST['img2_width'], (int)$_REQUEST['img2_height']);
	}
}

if ($_REQUEST['text1'] && $_REQUEST['text1'] !=' ')
{
	$_SESSION['text1'] = $_REQUEST['text1'];
	$text1 = $_REQUEST['text1'];
} else {
	$text1 = " ";	
}

if (isset($_REQUEST['text2']) && $_REQUEST['text2'] != '')
{
	$_SESSION['text2'] = $_REQUEST['text2'];
	$text2 = $_REQUEST['text2'];
} else {
	$text2 = " ";	
}


if (isset($_REQUEST['text3']) && $_REQUEST['text3'] !='')
{
	$_SESSION['text3'] = $_REQUEST['text3'];
	$text3 = $_REQUEST['text3'];	
} else {
	$text3 = " ";
}

$font='../fonts/'.$font1;
if (!$_REQUEST["font1_color"])
{
	$_SESSION["font1color"] = "000000";
}else{
	$_SESSION["font1color"] = $_REQUEST["font1_color"];
}

if (!$_REQUEST["font2_color"])
{
	$_SESSION["font2color"] = "000000";
}else{
	$_SESSION["font2color"] = $_REQUEST["font2_color"];
}

if (!$_REQUEST["font3_color"])
{
	$_SESSION["font3color"] = "000000";
}else{
	$_SESSION["font3color"] = $_REQUEST["font3_color"];
}

if($font1size== 20){
 $_SESSION["font1size"] = 20;
 $size1  = 14.5;		
 $left = -2;
 $top = 17;
}else if($font1size== 22){	
	$_SESSION["font1size"] = 22;
	$size1  = 16;	
	$left = -2;
	$top = 19;
}else if($font1size== 24){
	$_SESSION["font1size"] = 24;
	$size1  = 18;	
	$left = 7;
	$top = 21;
}else if($font1size== 26){
	$_SESSION["font1size"] = 26;
	$size1  = 20;
	$left = 7;
	$top = 22;
}else if($font1size== 28){
	$_SESSION["font1size"] = 28;
	$size1  = 21.5;
	$left = 7;
	$top = 24;
}else if($font1size== 30){
	$_SESSION["font1size"] = 30;
	$size1  = 22.5;
	$left = 7;
	$top = 26;
}else if($font1size== 32){
	$_SESSION["font1size"] = 32;
	$size1  = 24;
	$left = 7;
	$top = 27;
}else if($font1size== 35){
	$_SESSION["font1size"] = 35;
	$size1  = 26;
	$left = 7;
	$top = 29;
}else if($font1size== 40){
	$_SESSION["font1size"] = 40;
	$size1  = 30;
	$left = 9;
	$top = 33;
}else if($font1size== 46){
	$_SESSION["font1size"] = 46;
	$size1  = 34.5;
	$left = 9;
	$top = 39;
}else if($font1size== 52){
	$_SESSION["font1size"] = 52;
	$size1  = 39;
	$left = 9;
	$top = 40;
}else if($font1size== 58){
	$_SESSION["font1size"] = 58;
	$size1  = 43.5;
	$left = 12;
	$top = 51;
}else if($font1size== 70){
	$_SESSION["font1size"] = 70;
	$left =12;
	$top = 60;
	$size1  = 52.5;
}else if($font1size== 82){
	$_SESSION["font1size"] = 82;
	$left =15;
	$top = 75;
	$size1  = 62.5;
}else if($font1size== 98){
	$_SESSION["font1size"] = 98;
	$left =17;
	$top = 82;
	$size1  = 72.5;
}
if ($imgs['combine'])
{
	//$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text1_x']-3,(int)$_REQUEST['text1_y']+6,$text1,$font,$font1size-3, $_SESSION["font1color"], 0, 0);
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text1_x']-$left,(int)($_REQUEST['text1_y']+$top),$text1,$font,$size1, $_SESSION["font1color"], 0, 0);
} else {
	//$imgs['combine'] = WriteTextOnImage($imgs['background'],(int)$_REQUEST['text1_x']-3,(int)$_REQUEST['text1_y']+6,$text1,$font, $font1size-3, $_SESSION["font1color"], 0, 0);
	$imgs['combine'] = WriteTextOnImage($imgs['background'],(int)$_REQUEST['text1_x']-$left,(int)($_REQUEST['text1_y']+$top),$text1,$font, $size1, $_SESSION["font1color"], 0, 0);
}


$font='../fonts/'.$font2;

if($font2size== 20){
 $_SESSION["font2size"] = 20;	
 $size2  = 14.5;		
 $left2 = -2;
 $top2 = 17;
}else if($font2size== 22){
	$_SESSION["font2size"] = 22;	
	$size2  = 16;	
	$left2 = -2;
	$top2 = 19;
}else if($font2size== 24){
	$_SESSION["font2size"] = 24;	
	$size2  = 18;	
	$left2 = 7;
	$top2 = 21;
}else if($font2size== 26){
	$_SESSION["font2size"] = 26;	
	$size2  = 20;
	$left2 = 7;
	$top2 = 22;
}else if($font2size== 28){
	$_SESSION["font2size"] = 28;	
	$size2  = 21.5;
	$left2 = 7;
	$top2 = 24;
}else if($font2size== 30){
	$_SESSION["font2size"] = 30;	
	$size2  = 22.5;
	$left2 = 7;
	$top2 = 26;
}else if($font2size== 32){
	$_SESSION["font2size"] = 32;	
	$size2  = 24;
	$left2 = 7;
	$top2 = 27;
}else if($font2size== 35){
	$_SESSION["font2size"] = 35;	
	$size2  = 26;
	$left2 = 7;
	$top2 = 29;
}else if($font2size== 40){
	$_SESSION["font2size"] = 40;	
	$size2  = 30;
	$left2 = 9;
	$top2 = 33;
}else if($font2size== 46){
	$_SESSION["font2size"] = 46;	
	$size2  = 34.5;
	$left2 = 9;
	$top2 = 39;
}else if($font2size== 52){
	$_SESSION["font2size"] = 52;	
	$size2  = 39;
	$left2 = 9;
	$top2 = 40;
}else if($font2size== 58){
	$_SESSION["font2size"] = 58;	
	$size2  = 43.5;
	$left2 = 12;
	$top2 = 51;
}else if($font2size== 70){
	$_SESSION["font2size"] = 70;	
	$left2 =12;
	$top2 = 60;
	$size2  = 52.5;
}else if($font2size== 82){
	$_SESSION["font2size"] = 82;
	$left2 =15;
	$top2 = 75;
	$size2  = 62.5;
}else if($font2size== 98){
	$_SESSION["font2size"] = 98;
	$left2 =17;
	$top2 = 82;
	$size2  = 72.5;
}
if ($imgs['combine'])
{
	//$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text2_x']-3,(int)$_REQUEST['text2_y']+6,$text2,$font,$font2size-3, $_SESSION["font2color"], 0, 0);
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text2_x']-$left2,(int)$_REQUEST['text2_y']+$top2,$text2,$font,$size2, $_SESSION["font2color"], 0, 0);
} else {
	$imgs['combine'] = WriteTextOnImage($imgs['background'],(int)$_REQUEST['text2_x']-$left2,(int)$_REQUEST['text2_y']+$top2,$text2,$font, $size2, $_SESSION["font2color"], 0, 0);
}

//echo $text1.'-'.$text2.'-'.$text3;
$font='../fonts/'.$font3;

if($font3size== 20){
 $_SESSION["font3size"] = 20;	
 $size3  = 14.5;		
 $left3 = -2;
 $top3 = 17;
}else if($font3size== 22){
	$_SESSION["font3size"] = 22;	
	$size3  = 16;	
	$left3 = -2;
	$top3 = 19;
}else if($font3size== 24){
	$_SESSION["font3size"] = 24;	
	$size3  = 18;	
	$left3 = 7;
	$top3 = 21;
}else if($font3size== 26){	
	$_SESSION["font3size"] = 26;	
	$size3  = 20;
	$left3 = 7;
	$top3 = 22;
}else if($font3size== 28){	
	$_SESSION["font3size"] = 28;	
	$size3  = 21.5;
	$left3 = 7;
	$top3 = 24;
}else if($font3size== 30){
	$_SESSION["font3size"] = 30;	
	$size3  = 22.5;
	$left3 = 7;
	$top3 = 26;
}else if($font3size== 32){
	$_SESSION["font3size"] = 32;	
	$size3  = 24;
	$left3 = 7;
	$top3 = 27;
}else if($font3size== 35){
	$_SESSION["font3size"] = 35;	
	$size3  = 26;
	$left3 = 7;
	$top3 = 29;
}else if($font3size== 40){
	$_SESSION["font3size"] = 40;	
	$size3  = 30;
	$left3 = 9;
	$top3 = 33;
}else if($font3size== 46){
	$_SESSION["font3size"] = 46;	
	$size3  = 34.5;
	$left3 = 9;
	$top3 = 39;
}else if($font3size== 52){
	$_SESSION["font3size"] = 52;	
	$size3  = 39;
	$left3 = 9;
	$top3 = 40;
}else if($font3size== 58){
	$_SESSION["font3size"] = 58;	
	$size3  = 43.5;
	$left3 = 12;
	$top3 = 51;
}else if($font3size== 70){
	$_SESSION["font3size"] = 70;	
	$left3 =12;
	$top3 = 60;
	$size3  = 52.5;
}else if($font3size== 82){
	$_SESSION["font3size"] = 82;
	$left3 =15;
	$top3 = 75;
	$size3  = 62.5;
}else if($font3size== 98){
	$_SESSION["font3size"] = 98;
	$left3 =17;
	$top3 = 82;
	$size3  = 72.5;
}
if($_REQUEST['text1_x']){
	$_SESSION['text1_x'] = $_REQUEST['text1_x'];
}
if($_REQUEST['text1_y']){
	$_SESSION['text1_y'] = $_REQUEST['text1_y'];
}
if($_REQUEST['text2_x']){
	$_SESSION['text2_x'] = $_REQUEST['text2_x'];
}
if($_REQUEST['text2_y']){
	$_SESSION['text2_y'] = $_REQUEST['text2_y'];
}
if($_REQUEST['text3_x']){
	$_SESSION['text3_x'] = $_REQUEST['text3_x'];
}
if($_REQUEST['text3_y']){
	$_SESSION['text3_y'] = $_REQUEST['text3_y'];
}
if ($imgs['combine'])
{
	
	//$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text3_x']-3,$_REQUEST['text3_y']+6,$text3,$font,$font3size-3, $_SESSION["font3color"], 0, 0);
	$imgs['combine'] = WriteTextOnImage($imgs['combine'],(int)$_REQUEST['text3_x']-$left3,$_REQUEST['text3_y']+$top3,$text3,$font,$size3, $_SESSION["font3color"], 0, 0);
} else {
	//$imgs['combine'] = WriteTextOnImage($imgs['background'],(int)$_REQUEST['text3_x']-3,$_REQUEST['text3_y']+6,$text3,$font, $font3size-3, $_SESSION["font3color"], 0, 0);
	$imgs['combine'] = WriteTextOnImage($imgs['background'],(int)$_REQUEST['text3_x']-$left3,$_REQUEST['text3_y']+$top3,$text3,$font, $size3, $_SESSION["font3color"], 0, 0);
}
	$date = getdate();
	srand ((double) microtime( )*1000000);
	$random_number = rand(1000000000,9999999999);
	if ($bg_banner)
	{
		if (file_exists("../output/".$bg_banner) )
		{
			//unlink("../output/".$_SESSION["bannername"]);
		}
	}
	$newfilename = "../output/".$date[0].$random_number."_banner.png";
	$bg_banner1 = $date[0].$random_number."_banner.png";
	$_SESSION["bannername"] = $bg_banner1;
	SaveImage($imgs['combine'],$newfilename,'PNG');
	// Now we must destroy all the images created to ensure memory is not held
	// We suppress errors here, in case the image has been destroyed alread, and it 
	// really does not matter that we get an error, since we are just doing some housekeeping
	foreach ($imgs as $x) {
		@imagedestroy($x);
	}
	echo $bg_banner1;
?>

