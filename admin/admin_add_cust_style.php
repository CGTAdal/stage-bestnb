<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

if ($_POST["badge"])
{

	$idir = "../logos/";   // Path To Images Directory 
	$tdir = "../logos/thumbs/";   // Path To Thumbnails Directory 
	$twidth = "125";   // Maximum Width For Thumbnail Images 
	$theight = "100";   // Maximum Height For Thumbnail Images 
	for ($t=1; $t<4; $t++)
	{
		if ($_FILES["logo".$t]["name"]) 
		{
				
			$url = $_SESSION["customerloginid"]."_".$_FILES["logo".$t]['name'];   // Set $url To Equal The Filename For Later Use 
			if ($_FILES["logo".$t]['type'] == "image/jpg" || $_FILES["logo".$t]['type'] == "image/jpeg" || $_FILES["logo".$t]['type'] == "image/pjpeg" || $_FILES["logo".$t]['type'] == "image/gif" || $_FILES["logo".$t]['type'] == "image/png") 
			{ 
				$file_ext = strrchr($_FILES['imagefile']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php 
				$copy = copy($_FILES["logo".$t]['tmp_name'], "$idir" . $_SESSION["customerloginid"]."_".$_FILES["logo".$t]['name']);   // Move Image From Temporary Location To Permanent Location 
			
				if ($copy) {   // If The Script Was Able To Copy The Image To It's Permanent Location 
  				$data2["logo".$t] = $_SESSION["customerloginid"]."_".$_FILES["logo".$t]['name'];
				$msg.= $_FILES["logo"]["name"].' Image uploaded successfully.<br />';   // Was Able To Successfully Upload Image 
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
	      		$msg.= $_FILES["logo"]["name"].' Image thumbnail created successfully.<br>';   // Resize successful 
   			} else { 
	      		$msg.= '<font color="#FF0000">ERROR: Unable to upload image.</font> '.$_FILES["logo"]["name"];   // Error Message If Upload Failed 
	    	} 

		 } else { 
   			$msg.= '<font color="#FF0000">ERROR: Wrong filetype (has to be a .jpg or .jpeg. Yours is ';   // Error Message If Filetype Is Wrong 
			 $msg.= $file_ext;   // Show The Invalid File's Extention 
			$msg.= '.</font>'; 
		 } 

	
		}
	}
	$badge = split(",", $_POST["badge"]);
	$data2["styleid"] = $badge[0];
	$data2["color"] = $badge[1];
	$data2["custid"] = $_POST["custid"];
	$data2["subtext"] = $_POST["subtext"];
	$data2["stylename"] = $_POST["stylename"];
	$data2["notes"] = $_POST["notes"];
	$data2["paid"] = 1;
	$id = add_record("custstyle", $data2);
	
	?>
	<script language="javascript">
	parent.parent.location.href="admin_custstyle_view.php?customerid=<?php echo $_POST["custid"]; ?>";
	window.close();
	</script>
	<?php
}
	
	
$qry = "SELECT * FROM styles ORDER BY id";
$styles = mysql_query($qry);
$style = mysql_fetch_assoc($styles);

?>
<?php include("init_top.php");?>
<br>
<div class="xfluid" style="width: 99%;margin-left: 2.50;">
<div style="min-height: 300px;" class="portlet x12">
	<div class="portlet-header"><h4>Add Customer Style</h4></div>			
		<div class="portlet-content" >
		
<form method="post" enctype="multipart/form-data" action="admin_add_cust_style.php">
<input type="hidden" name="custid" value="<?php echo $_REQUEST["id"]; ?>" />
<table width="100%">
<tr>
    <td colspan="2">
    <h3>Choose a name for this style:</h3></td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" name="stylename" id="stylename" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2"><h3><br />
      <br />
      Will this badge have a sub-title? </h3>
      This is the text under the name of a person, usually their title or position.
      </td>
  </tr>
  <tr>
    <td colspan="2"><input type="radio" name="subtext" value="0" checked/>
      &nbsp;No&nbsp;&nbsp;
      <input type="radio" name="subtext" value="1"/>
      &nbsp;Yes</td>
  </tr>
  <tr>
    <td colspan="2"><h3><br />
      <br />
      Please choose a badge style:</h3>
      If you aren't exactly sure which color/size you want, that's ok.  Select any size/color and specify in the notes below, and we'll be happy to create multiple versions for you at your request for no additional charges.</td>
  </tr>
  <tr>
    <td colspan="2"><table width="850" border="0">
      <tr>
        <?php 
				$x = 1;
				if ($style) { 
					do { ?>
        <td valign="bottom" align="center"><img src="../badgeimages/<?php echo $style["imglink"]; ?>" /><br />
          <?php echo $style["name"]; ?><br />
          <?php echo $style["size"]; ?></td>
        <?php 
						$qry = "SELECT * FROM colors WHERE styleid =".$style["id"]." ORDER BY colors.id";
						$colors = mysql_query($qry);
						$color = mysql_fetch_assoc($colors);
						?>
        <td valign="bottom"><?php do { ?>
          <img src="../colorimages/<?php echo $color["imglink"]; ?>" class="colorresize" />&nbsp;&nbsp;
          <input type="radio" name="badge" value="<?php echo $style["id"]; ?>, <?php echo $color["id"]; ?>" />
          &nbsp;<?php echo $color["name"]; ?>&nbsp;&nbsp;<br />
          <?php } while($color = mysql_fetch_assoc($colors));?>
          <?php 
						$x++;
						if ($x > 2) 
						{
							echo "</tr><tr><td><br /><br /></td></tr><tr>";
							$x = 1;
						}
					} while($style = mysql_fetch_assoc($styles)); 
				} else { ?></td>
        <td><h3>No Styles Left</h3></td>
        <?php }?>
        <?php  
			if ($x < 3 ) { echo "</tr>"; }?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><h3><br />
      <br />
      Upload Your Logo:</h3>
      Up to 3 logos per badge style. Please use hi-res JPG or PNG images not exceeding 2MB in size.<br />
      If you have a different format, submit the style without a logo then email your logo to us directly.</td>
  </tr>
  <tr>
    <td colspan="2"><input type="file" name="logo1" />
      <br />
      <input type="file" name="logo2" />
      <br /><input type="file" name="logo3" /></td>
  </tr>
  <tr>
    <td colspan="2"><h3>
      
      <br />
      <br />
      Design Notes:
    </h3>
      Any specific instructions? Where you would like your logo(s) placed? Color preferences?</td>
  </tr>
  <tr>
    <td colspan="2"><textarea cols="80" rows="4" name="notes"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><input class="btn btn-small" type="submit" value="Add Style" /></td>
  </tr>
</table>
</form>
</div></div></div>