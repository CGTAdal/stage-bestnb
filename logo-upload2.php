<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();


if ($_FILES["image"])
{
	echo "";
	$idir = "logos/";   // Path To Images Directory 
	$tdir = "logos/thumbs/";   // Path To Thumbnails Directory 
	$twidth = "125";   // Maximum Width For Thumbnail Images 
	$theight = "100";   // Maximum Height For Thumbnail Images 
	if ($_FILES["image"]["name"]) 
	{
		srand ((double) microtime( )*1000000);
		$random_number = rand(1000000000,9999999999);
		$date = getdate();
		$url = $date[0].$random_number."_".$_FILES["image"]['name'];
		
		$file_ext = strrchr($_FILES['image']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php 
		$file_ext = strtolower($file_ext);
		if ($file_ext == ".jpg" || $file_ext == ".jpeg" || $file_ext == ".pjpeg" || $file_ext == ".gif" || $file_ext == ".png" || $file_ext == ".bmp" || $file_ext == ".ai" || $file_ext == ".psd" || $file_ext == ".pdf" || $file_ext == ".eps")
		{ 
			
			$copy = copy($_FILES["image"]['tmp_name'], "$idir" . $date[0].$random_number."_".$_FILES["image"]['name']);   // Move Image From Temporary Location To Permanent Location 
		
			if ($copy) 
			{   // If The Script Was Able To Copy The Image To It's Permanent Location 
				$_SESSION["logo".$_REQUEST["logo"]] = $date[0].$random_number."_".$_FILES["image"]['name'];
				$msg.= $_FILES["image"]["name"].' Image uploaded successfully.<br />';   // Was Able To Successfully Upload Image 
   				?>
				<script language="javascript";>
				parent.parent.location.href = "<?php echo $_REQUEST["wizard"].".php"; ?>";
				window.close();
				</script>
				<?php
   			} else { 
	      		$msg.= '<font color="#FF0000">ERROR: Unable to upload image.</font> '.$_FILES["image"]["name"];   // Error Message If Upload Failed 
	    	} 

		 } else { 
   			$msg.= '<font color="#FF0000">ERROR: Wrong filetype (has to be a .jpg, .jpeg, .gif, .png, .bmp, .ai, .psd or .pdf. Yours is ';   // Error Message If Filetype Is Wrong 
			 $msg.= $file_ext;   // Show The Invalid File's Extention 
			$msg.= '.</font>'; 
	 	 } 

	
	}	
}


?>

<?php if ($msg) { echo $msg."<BR>"; } ?>
<form method="post" action="logo-upload2.php?logo=<?php echo $_REQUEST["logo"]; ?>&wizard=<?php echo $_REQUEST["wizard"]; ?>" id="moveform" name="moveform" enctype="multipart/form-data">
<strong>Logo File: </strong>
<input type="file" name="image"/><br /><br />

<input type="submit" value="Upload Image" class="wizardButton" /><br />

</form>
