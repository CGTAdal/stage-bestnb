<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }


if ($_FILES)
{		

	$idir = "../proofs/";   // Path To Images Directory 
	$tdir = "../proofs/thumbs/";   // Path To Thumbnails Directory 
	$twidth = "125";   // Maximum Width For Thumbnail Images 
	$theight = "100";   // Maximum Height For Thumbnail Images 
	
	if ($_FILES["proof"]["name"]) 
	{
		echo "HERE";
				
		$url = $_REQUEST["id"]."_".$_FILES["proof"]['name'];   // Set $url To Equal The Filename For Later Use 
 		if ($_FILES["proof"]['type'] == "image/jpg" || $_FILES["proof"]['type'] == "image/jpeg" || $_FILES["proof"]['type'] == "image/pjpeg") 
		{ 
   			$file_ext = strrchr($_FILES['proof']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php 
   			$copy = copy($_FILES["proof"]['tmp_name'], "$idir" . $_REQUEST["id"]."_".$_FILES["proof"]['name']);   // Move Image From Temporary Location To Permanent Location 
	
			if ($copy) {   // If The Script Was Able To Copy The Image To It's Permanent Location 
   			$data["proof"] = $_REQUEST["id"]."_".$_FILES["proof"]['name'];
			$msg.= $_FILES["proof"]["name"].' Image uploaded successfully.<br />';   // Was Able To Successfully Upload Image 
   			$simg = imagecreatefromjpeg("$idir" . $url);   // Make A New Temporary Image To Create The Thumbanil From 
   			$currwidth = imagesx($simg);   // Current Image Width 
   			$currheight = imagesy($simg);   // Current Image Height 
			if ($currheight > $currwidth) {   // If Height Is Greater Than Width 
    			$zoom = $twidth / $currheight;   // Length Ratio For Width 
    			$newheight = $theight;   // Height Is Equal To Max Height 
    			$newwidth = $currwidth * $zoom;   // Creates The New Width 
	   		} else {    // Otherwise, Assume Width Is Greater Than Height (Will Produce Same Result If Width Is Equal To Height) 
    			$zoom = $twidth / $currwidth;   // Length Ratio For Height 
	       		$newwidth = $twidth;   // Width Is Equal To Max Width 
	    		$newheight = $currheight * $zoom;   // Creates The New Height 
	   		} 
      		
			$dimg = imagecreate($newwidth, $newheight);   // Make New Image For Thumbnail 
   			imagetruecolortopalette($simg, false, 256);   // Create New Color Pallete 
	   		$palsize = ImageColorsTotal($simg); 
	   		for ($i = 0; $i < $palsize; $i++) {   // Counting Colors In The Image 
	   			$colors = ImageColorsForIndex($simg, $i);   // Number Of Colors Used 
	   			ImageColorAllocate($dimg, $colors['red'], $colors['green'], $colors['blue']);   // Tell The Server What Colors This Image Will Use 
   			} 
	   		imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);   // Copy Resized Image To The New Image (So We Can Save It) 
   			imagejpeg($dimg, "$tdir" . $url);   // Saving The Image 
	   		imagedestroy($simg);   // Destroying The Temporary Image 
	   		imagedestroy($dimg);   // Destroying The Other Temporary Image 
	   		$msg.= $_FILES["proof"]["name"].' Image thumbnail created successfully.<br>';   // Resize successful 
   		} else { 
	   		$msg.= '<font color="#FF0000">ERROR: Unable to upload image.</font> '.$_FILES["proof"]["name"];   // Error Message If Upload Failed 
	   	} 

	 } else { 
   		$msg.= '<font color="#FF0000">ERROR: Wrong filetype (has to be a .jpg or .jpeg. Yours is ';   // Error Message If Filetype Is Wrong 
		 $msg.= $file_ext;   // Show The Invalid File's Extention 
			$msg.= '.</font>'; 
	 } 

	
	}
	
	if (!$err)
	{
		$where = "id = ".$_REQUEST["id"];
		modify_record("custstyle", $data, $where);
		?>
		<script language="javascript">
			parent.parent.location.href='admin_custstyle_view.php?customerid=<?php echo $_REQUEST["customerid"]; ?>';
			window.close();
		</script>
	<?php
	}
}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="../calendar/calendar-win2k-1.css" title="win2k-1" />


<!-- main calendar program -->
<script type="text/javascript" src="../calendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../calendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../calendar/calendar-setup.js"></script>

<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function reloadIt()
{
	window.location = "admin_view_user.php";
}
</script>

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>

</head>

<body>

<form action="admin_upload_proof.php?id=<?php echo $_REQUEST["id"]; ?>&customerid=<?php echo $_REQUEST["customerid"]; ?>" enctype="multipart/form-data" method="post" name="adduser">
<table border="0" cellpadding="0" cellspacing="0" width="96%">
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><strong>Upload Proof: </strong></td>
	  	<td><input type="file" name="proof" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Upload Proof" /></td>
	</tr>
	
</table>

</form>

</body>
</html>
