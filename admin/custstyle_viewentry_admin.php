<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"])
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


if ($_REQUEST["styleid"])
{
	//$bid = $_REQUEST['bid'];
	$qry = "SELECT custstyle.*,batches.id as bid, batches.name as bname, batches.subtext as subtext1,batches.subtext2 as subtext2 , batches.font1 as font1, batches.font2 as font2,
	batches.font3 as font3, batches.fontsize1 as fontsize1,
	batches.fontsize2 as fontsize2,batches.fontsize3 as fontsize3,
	customers.id AS custid, customers.companyname AS companyname, customers.firstname AS firstname, customers.lastname AS lastname, colors.id AS colorid, colors.name AS colorname, styles.name AS sstylename, styles.size AS stylesize FROM custstyle 
	LEFT JOIN customers ON custstyle.custid=customers.id 
	LEFT JOIN colors ON custstyle.color=colors.id 
	LEFT JOIN styles ON styles.id=custstyle.styleid 
	LEFT JOIN batches ON custstyle.id = batches.custstyleid
	WHERE custstyle.id = ".$_REQUEST["styleid"]." 
	";
	//AND batches.id = ".$bid."
	//echo $qry;
	
} else {
	$qry = "SELECT custstyle.*, customers.id AS custid, customers.companyname AS companyname, customers.firstname AS firstname, customers.lastname AS lastname, colors.id AS colorid, colors.name AS colorname, styles.name AS sstylename, styles.size AS stylesize FROM custstyle LEFT JOIN customers ON custstyle.custid=customers.id LEFT JOIN colors ON custstyle.color=colors.id LEFT JOIN styles ON styles.id=custstyle.styleid";
}

$styles = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$style = mysql_fetch_assoc($styles);

$_POST = $style;
// echo '<pre>';
// print_r($style);
// echo '</pre>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Style</title>
<link href="<?php echo $base_url?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>


<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="<?php echo $base_url?>/admin/greybox/gb_scripts.js"></script>
<link href="<?php echo $base_url?>/admin/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $base_url?>/admin/scripts/enlargeit.js"></script>

<style>

.resize
{
	width:150px;
	height:auto;
}
</style>
</head>

<body>
<?php //include("header.php"); ?>
<table width="800" frame="box" border="0" align="center">
	<tr>
		<td><a href="style_add_admin.php" title="Add Style">Add Style</a></td>
		<td align="right" valign="bottom"><h3>Customer Style</h3></td>
	</tr>
	<?php if ($msg) { ?>
	<tr>
		<td>&nbsp;</td>
		<td><font size="1"><?php echo $msg; ?></font></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Customer:</strong></td>
		<td><?php echo $style["companyname"]." - ".$style["firstname"]." ".$style["lastname"];?></td>
	</tr>
	<tr>
		<td align="right"><strong>Customer Style Name:</strong></td>
		<td><?php echo $style["stylename"]; ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Subtext?</strong></td>
		<td><?php if ($style["subtext"] == 1) 
					{echo "Yes";} else {echo "No";}?></td>
	</tr>
	<tr>
		<td align="right"><strong>Badge Style Type:</strong></td>
		<td><?php echo $style["sstylename"]; ?> - <?php echo $style["stylesize"]; ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Color:</strong></td>
		<td><?php echo $style["colorname"]; ?></td>
	</tr>
	
	<?php if ($style["logo1"]) { ?>
	<tr>
		<td align="right"><strong>Logo 1:</strong></td>
		<td><a href="../logos/<?php echo $style["logo1"]; ?>"><?php echo $style["logo1"]; ?></a></td>
	</tr>
	<?php } ?>
	<?php if ($style["logo2"]) { ?>
	<tr>
		<td align="right"><strong>Logo 2:</strong></td>
		<td><a href="../logos/<?php echo $style["logo2"]; ?>"><?php echo $style["logo2"]; ?></a></td>
	</tr>
	<?php } ?>
   	<?php if ($style["proof"]) { ?>
	<tr>
		<td align="right"><strong>Proof:</strong></td>
		<td><img src="../proofs/<?php echo $style["proof"]; ?>" id='proof<?php echo $style["id"]; ?>' onclick='enlarge(this);' longdesc='../logos/<?php echo $style["proof"]; ?>' alt='<?php echo $style["proof"]; ?>'/></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="right"><strong>Notes:</strong></td>
		<td><?php echo $style["notes"]; ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Remove White Box?:</strong></td>
		<td><?php if ($style["whitebox"]) { echo "Yes"; } else { echo "No"; } ?></td>
	</tr>
	<tr>		
		<td align="right"><strong>Tweak?:</strong></td>
		<td><?php if ($style["tweak"]) { echo "Yes"; } else { echo "No"; } ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Name: </strong></td>
		<td><?php echo $style['bname']?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font Text1</strong></td>
		<td><?php if($style['bname'] !=''){ echo $style['font1'] ;} ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font size Text1:<strong></td>
		<td><?php if($style['bname'] !=''){ echo $style['fontsize1'] ;}?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font Text2</strong></td>
		<td><?php if($style['subtext1'] !=''){echo $style['font2'];} ?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font size Text2:</strong></td>
		<td><?php if($style['subtext1'] !=''){echo $style['fontsize2'];}?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font Text3</strong></td>
		<td><?php if($style['subtext2'] !='') { echo $style['font3'];}?></td>
	</tr>
	<tr>
		<td align="right"><strong>Font size Text3:</strong></td>
		<td><?php if($style['subtext2'] !='') { echo $style['fontsize3'];}?></td>
	</tr>
</table>
<hr />
</body>
</html>
