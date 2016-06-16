<?php
session_start();

if ($_REQUEST["frame"])
{
	$frame = $_REQUEST["frame"];
	$_SESSION["frame"] = $_REQUEST["frame"];
} else if ($_SESSION["frame"]) {
	$frame = $_SESSION["frame"];
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

?>
<?php echo "blanks/".$backgroundfilename; ?>