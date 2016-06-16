<?php 
error_reporting(0);
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"]){ ?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
 
//// include the AWS S3
if (!class_exists('S3')) require_once 'amazon_aws/S3.php';
// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJDXKDUJQ6HNIYWQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
// Instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$criteria = $_REQUEST["customerid"];
$qry = "SELECT id,username,customer_bucketname from customers where id=".$criteria;
$users = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$user = mysql_fetch_assoc($users);
$response_msg = "";
if(!empty($_COOKIE["uploadmeg"])){ $response_msg = $_COOKIE["uploadmeg"]; unset($_COOKIE['uploadmeg']); setcookie('uploadmeg', null, -1, '/'); }

if ($user['customer_bucketname']=="") {
	$bucketName = $user['id']."_".time();	
	$bdata = $s3->putBucket($bucketName, S3::ACL_PUBLIC_READ);
	/// Create deleted folder for each client
	$uploadFile = dirname(__FILE__).'/amazon_aws/.keep';
	$folder = "Deleted"; 
	$s3->putObjectFile($uploadFile, $bucketName.'/'.$folder, baseName($uploadFile), S3::ACL_PUBLIC_READ);
	/// Save user Bucketname in DB.
	$updateqry = "Update customers set customer_bucketname = '".$bucketName."' where id=".$user['id']."";
	$users = mysql_query($updateqry) or die('Query failed: ' . mysql_error()); 
}else{
	$bucketName = $user['customer_bucketname'];
} 

/// Delete files from client folders on amazon
if(isset($_REQUEST) && $_REQUEST['delfile']!=''){
	$response = array(); 
	$uploadFile = explode('/', $_REQUEST['delfile']);
	$NewContents = $s3->getBucket($bucketName,$uploadFile[0]); /// Get data from deleted folder
	$Delfolder = "Deleted";  
	foreach($NewContents as $dkey => $dfval){	
		$finalfile = explode('/', $dfval['name']);
		$info = $s3->getObject($bucketName.'/'.$uploadFile[0], baseName($finalfile[1])); // Get files object from deleted folder
		$fileName = $fileTempName = $finalfile[1]; //location of the file. 
		file_put_contents($fileTempName,$info->body); // make dummy image
		$s3->putObjectFile($fileTempName, $bucketName.'/'.$Delfolder.'/'.$uploadFile[0], baseName($fileName), S3::ACL_PUBLIC_READ); // Copy deleted files in Deleted Folder
		$s3->deleteObject($bucketName.'/'.$uploadFile[0], baseName($finalfile[1])); // delete files
		flush(); 
		unlink($fileTempName);
	}
		if ($s3->deleteObject($bucketName.'/'.$uploadFile[0])){ ///delete folder
			$response_msg = "Folder Deleted Successfully.";
		}else{
			$response_msg = "Folder Can't Deleted.";
	    } 
	} 

/// upload folders on amazon
if(isset($_POST) && $_POST['isfolder']==1){
	$uploadFile = dirname(__FILE__).'/amazon_aws/.keep';
	$folder = $_POST['folder'];	 
	if($folder!='Deleted'){
		if($s3->putObjectFile($uploadFile, $bucketName.'/'.$folder, baseName($uploadFile), S3::ACL_PUBLIC_READ)){
			$response_msg = "Folder create Successfully";
	    } else {
	     	$response_msg = "Failed to create folder";
	    }
    }else{
    	$response_msg = "You can't create 'Deleted' folder. Please use other folder.";
    }  
}
/// upload files with folders on amazon
if(isset($_POST) && $_POST['isfolder']==0 && $_FILES['file']['name']!=''){
	$response = array();
    $folder = $_POST['folder'];
    /// create folder for new file
    $uploadFile = dirname(__FILE__).'/amazon_aws/.keep';
    $s3->putObjectFile($uploadFile, $bucketName.'/'.$folder, baseName($uploadFile), S3::ACL_PUBLIC_READ); 
	/// upload new files in selected folder	
    foreach($_FILES['file']['name'] as $key => $fval){		 
		$fileName = $_FILES['file']['name'][$key];
	    $fileTempName = $_FILES['file']['tmp_name'][$key]; 
	    if($s3->putObjectFile($fileTempName, $bucketName.'/'.$folder, baseName($fileName), S3::ACL_PUBLIC_READ)){
			$response['msg'] = "File copied Successfully at ".$folder;
	    	$response['error'] = 0;
	    } else {
	     	$response['msg'] = "Failed to copy file {$fileName}";
	     	$response['error'] = 1;
	    } 
	    $response['path'] = $base_url."/admin/customerfolder_admin.php";
	    $response['customerid'] = $criteria;
	    $response['folder'] = "";
	}  
    echo json_encode($response);
    exit;
} 
/// Get user bucket  
$contents = $s3->getBucket($bucketName); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>View Customers</title>
<?php include("init_top.php");?>
<link href="<?php echo $base_url;?>/admin/includes/cms.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "greybox/";
</script>
<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<script type="text/javascript" src="greybox/dropzone.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<link href="greybox/dropzone.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function reloadIt()
{
	window.location = "customerfolder_admin.php";
}
$(document).ready(function(){ 
	$(".addfiless3").click(function() {
	  $(".uploaddiv").toggle();
	  $(".folderdiv").hide();
	}); 
	$(".addfiless4").click(function() {
	  $(".folderdiv").toggle();
	  $(".uploaddiv").hide();
	});
	var sdiv = "<?php echo $response_msg; ?>";
	if(sdiv!=""){ $(".messagediv").show(); }
    setTimeout('$(".messagediv").hide();',5000);
    setTimeout('$(".messagediv").html();',5000);	
});
</script>
<style>
.resize{
	width:150px;
	height:auto;
}
</style>
</head>
<body>
<br>		
<div class="messagediv" style="display: none;"><?php echo $response_msg; ?></div>
<div class="xfluid" style="width: 95%;margin-left: 2.50%;">
	<div class="topcontent">
		<div class="lefttopcontent"><?php echo $user['username']."'s Files" ?></div>
		<div class="righttopcontent">
			<a class="addfiless3 btn btn-small" style="color:#fff" href="javascript:void(0);">Upload</a>
			<a class="addfiless4 btn btn-small" style="color:#fff" href="javascript:void(0);">Create Folder</a>			
		</div>
		<!-- folder div -->
		<div class="folderdiv" style="display: none;">
		<form action="customerfolder_admin.php" method="post"  name="form2">
		  <input name="customerid" type="hidden" value="<?php echo $criteria; ?>" />
		  <input name="folder" id="folder" class="custfolder" placeholder="Folder" type="text" value="" />		   
		  <input name="isfolder" id="isfolder" class="custfolder" placeholder="Folder" type="hidden" value="1" />
		  <input type="submit" value="Submit">
		</form>
		</div>	
		<div class="uploaddiv" style="display: none;">
		<form action="customerfolder_admin.php"  name="form1" class="dropzone">
		  <input name="customerid" type="hidden" value="<?php echo $criteria; ?>" />
		  <input name="folder" id="folder" class="custfolder" placeholder="Folder" type="text" value="" />
		  <input name="isfolder" id="isfolder" class="custfolder" placeholder="Folder" type="hidden" value="0" />
		  <div class="fallback">
		    <input name="file" type="file" multiple />
		  </div>
		</form>
		</div>
	</div>
	<div class="contentdata">
		<table align="center" class="search-box-tabletype">
			<tr>
				<th>#</th>
				<th></th>
				<th style='text-align: left;padding-left:5px;'>Name</th> 
				<th>Last Modified</th>
				<th>Activity</th> 
			</tr>	
		<?php 	
		if(!empty($contents)){
			$k=1;  			 
			foreach($contents as $key => $val){
				$fname = explode("/", $val['name']);				
				if($val['size']==0){
					if(!isset($fname[2])){ 
						echo "<tr>";
						echo "<td>".$k."</td>";
						echo "<td><img src='images/folder.png'></td>";
						echo "<td style='text-align: left; padding-left:5px;'>".$fname[0]."</td>";
						echo "<td>".date('D, d M Y',$val['time'])."</td>";
						echo "<td><a href='customerfiles_admin.php?customerid=".$criteria."&folder=".$fname[0]."' >View files</a>";
						if($fname[0]!="Deleted"){ echo " | <a href='customerfolder_admin.php?customerid=".$criteria."&delfile=".$fname[0]."' onclick=\"javascript:return confirm('Are you sure you want to delete this folder?')\">Delete</a>"; } "</td>";
						echo "</tr>";
						$k++;
					}	
				}			
			}
		}else{
			echo "<tr><td colspan='5'>";
			echo "There have no Folders";
			echo "</td></tr>";
		}
		?>
		</table>
	</div>
</div>
</body>
</html> 