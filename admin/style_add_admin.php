<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }

if ($_POST["addstyleinfo"]) 
{

	if ($_FILES["imglink"]["name"]) 
	{
		$idir = "../badgeimages/";   // Path To Images Directory 
		$tdir = "../badgeimages/thumbs/";   // Path To Thumbnails Directory 
		$twidth = "50";   // Maximum Width For Thumbnail Images 
		$theight = "50";   // Maximum Height For Thumbnail Images 
					
		$url = $_SESSION["customerloginid"]."_".$_FILES["imglink"]['name'];   // Set $url To Equal The Filename For Later Use 
 	 	if ($_FILES["imglink"]['type'] == "image/jpg" || $_FILES["imglink"]['type'] == "image/jpeg" || $_FILES["imglink"]['type'] == "image/pjpeg") 
		{ 
    		$file_ext = strrchr($_FILES['imagefile']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php 
    		$copy = copy($_FILES["imglink"]['tmp_name'], "$idir" . $_SESSION["customerloginid"]."_".$_FILES["imglink"]['name']);   // Move Image From Temporary Location To Permanent Location 
			
			if ($copy) 
			{   // If The Script Was Able To Copy The Image To It's Permanent Location 
    			$_POST["imglink"] = $_SESSION["customerloginid"]."_".$_FILES["imglink"]['name'];
				$msg.= $_FILES["imglink"]["name"].' Image uploaded successfully.<br />';   // Was Able To Successfully Upload Image 
      			$simg = imagecreatefromjpeg("$idir" . $url);   // Make A New Temporary Image To Create The Thumbanil From 
      			$currwidth = imagesx($simg);   // Current Image Width 
      			$currheight = imagesy($simg);   // Current Image Height 
				if ($currheight > $currwidth) 
				{   // If Height Is Greater Than Width 
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
			      	$msg.= $_FILES["imglink"]["name"].' Image thumbnail created successfully.<br>';   // Resize successful 
    			} else { 
			    	$msg.= '<font color="#FF0000">ERROR: Unable to upload image.</font> '.$_FILES["imglink"]["name"];   // Error Message If Upload Failed 
			   	} 

			 } else { 
    			$msg.= '<font color="#FF0000">ERROR: Wrong filetype (has to be a .jpg or .jpeg. Yours is ';   // Error Message If Filetype Is Wrong 
		   		 $msg.= $file_ext;   // Show The Invalid File's Extention 
					$msg.= '.</font>'; 
		 	 } 

	
		}
		unset($_POST["addstyleinfo"]);
		add_record("styles", $_POST);
		$msg = "<font color='green'>New Style Added</font><br>";
		unset($_POST);
		?>
		<script language="javascript">
		parent.parent.location.href="style_view_admin.php";
		window.close();
		</script>
		<?php 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Style</title>
<?php include("init_top.php");?>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>

</head>

<body>
<?php include("header.php"); ?>
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Add Style</h4></div>			
		<div class="portlet-content" >
		
<form action="style_add_admin.php" enctype="multipart/form-data" method="post" name="addstyle">
<input type="hidden" name="addstyleinfo" value="1">
<table width="800" frame="box" border="0" align="center">
<?php /*
	<tr>
		<td>&nbsp;</td>
		<td align="right" valign="bottom"><h3>Add Style</h3></td>
	</tr>
*/?>
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Style Name:</strong></td>
		<td><input type="text" name="name" value="<?php echo $_POST["name"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Style Size:</strong></td>
		<td><input type="text" name="size" value="<?php echo $_POST["size"]; ?>"/></td>
	</tr>
	<tr>
		<td align="right"><strong>Image Link:</strong></td>
		<td><input type="file" name="imglink" /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input style="font-size:13px;" class="btn btn-small" type="submit" value="Submit New Style" /></td>
	</tr>
</table>
</form>
</div>
</div>
</div>
<hr />
</body>
</html>
