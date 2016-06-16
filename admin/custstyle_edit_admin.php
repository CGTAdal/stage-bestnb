<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
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
	if (!$err)
	{
		unset($_POST["addstyleinfo"]);
		$where = "id = ".$_POST["styleid"];
		unset($_POST["styleid"]);
		modify_record("styles", $_POST, $where);
		$msg = "<font color='green'>Customer Style Updated</font><br>";
		unset($_POST);?>
		<script language="javascript">
		parent.parent.location.href = "style_view_admin.php";
		window.close();
		</script>
	<?php }
}

if ($_REQUEST["styleid"])
{
	$styleid = $_REQUEST["styleid"];
}
if ($_POST["styleid"])
{
	$styleid = $POST["styleid"];
}


$qry = "SELECT custstyles.*, customers.id AS custid, customers.companyname, customers.firstname, customers.lastname FROM custstyles WHERE id = ".$_REQUEST["styleid"]." ORDER BY name";
$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$style = mysql_fetch_assoc($styles);

$_POST = $style;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Style</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/enlargeit.js"></script>

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>
</head>

<body>

<form action="style_edit_admin.php" enctype="multipart/form-data" method="post" name="addstyle">
<input type="hidden" name="addstyleinfo" value="1">
<input type="hidden" name="styleid" value="<?php echo $styleid; ?>">
<table width="100%" frame="box" border="0">
	<tr>
		<td ><img src="images/generic_logo.gif" /></td>
	  	<td width="458" align="right" valign="bottom"><h3>Edit Style</h3></td>
	</tr>
	<tr>
		<td colspan="2"><hr /></td>
	</tr>
</table>
<table width="100%" frame="box" border="0">
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Customer Style Name:</strong></td>
		<td><?php echo $styles["stylename"]; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><strong>Subtext?</strong></td>
		<td><?php if ($styles["subtext"] = 1) 
					{echo "Yes";} else {echo "No";}?></td>
	</tr>
	<tr>
		<td align="right"><strong>Customer:</strong></td>
		<td><?php echo $styles["companyname"]." - ".$styles["firstname"]." ".$styles["lastname"];?></td>
	</tr>
	<tr>
		<td align="right"><strong>Current Image:</strong></td>
		<td><img src='../badgeimages/thumbs/<?php echo $_POST["imglink"]; ?>' id='photo<?php echo $_POST["id"]; ?>' onclick='enlarge(this);' longdesc='../badgeimages/<?php echo $_POST["imglink"]; ?>' alt='<?php echo $_POST["imglink"]; ?>'></td>
	</tr>
	<tr>
		<td align="right"><strong>Image Link:</strong></td>
		<td><input type="file" name="imglink" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Modify Style" /></td>
	</tr>
</table>
</form>
<hr />
</body>
</html>
