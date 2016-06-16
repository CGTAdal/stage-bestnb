<?php 
error_reporting(0); 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2){ ?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
 
//// include the AWS S3
if (!class_exists('S3')) require_once 'amazon_aws/S3.php';

// Instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$criteria = $_REQUEST["customerid"]; /// client Id
$folderName = $_REQUEST["folder"];  /// client folder name
$TitleName = explode('/', $_REQUEST["folder"]);
$qry = "SELECT id,username,customer_bucketname from customers where id=".$criteria;
$users = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$user = mysql_fetch_assoc($users);
$response_msg = "";
if(!empty($_COOKIE["uploadmeg"])){ $response_msg = $_COOKIE["uploadmeg"]; unset($_COOKIE['uploadmeg'] ); setcookie('uploadmeg', null, -1, '/'); }

/// Get user bucket list
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

/// Download files from client folders on amazon
if(isset($_REQUEST) && $_REQUEST['download']!=''){
	$uploadFile = explode('/', $_REQUEST['download']);
	$info = $s3->getObject($bucketName.'/'.$uploadFile[0].'/'.$uploadFile[1], baseName($uploadFile[2]));
	//Add below to download the text file created 
	$filename = $uploadFile[2]; //location of the file. I have put $file since your file is create on the same folder where this script is
	file_put_contents($filename,$info->body);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filename));
	flush();
	readfile($filename);
	unlink($filename);
	exit; 
}

/// Get user bucket  
$contents = $s3->getBucket($bucketName,$folderName); 
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
	window.location = "customerfiles_admin.php";
}
$(document).ready(function(){ 
	$(".addfiless3").click(function() {
	  $(".uploaddiv").toggle();
	});  	
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
		<div class="lefttopcontent"><?php echo "<a href='customerfolder_admin.php?customerid=".$criteria."'>".$user['username']."</a> > <a href='customerfiles_admin.php?customerid=".$criteria."&folder=".$TitleName[0]."'>Deleted</a> >".$TitleName[1]."'s  Files" ?></div>
		<div class="righttopcontent">
			<a class="btn btn-small" style="color:#fff" href='customerfiles_admin.php?customerid=<?php echo $criteria; ?>&folder=<?php echo $TitleName[0];?>'> << Back</a>			
		</div> 
	</div>
	<div class="contentdata">
		<table align="center" class="search-box-tabletype">
			<tr>
				<th>#</th>
				<th></th>
				<th style='text-align: left; padding-left:5px;'>Name</th>
				<th>Size</th>
				<th>Last Modified</th>
				<th>Activity</th> 
			</tr>	
		<?php 	
		if(!empty($contents)){
			$k=1;
			$folder = $contents[0]['name'];	 
			foreach($contents as $key => $val){
				$fname = explode("/", $val['name']);				 
				if($val['size']>0){ 
						echo "<tr>";
						echo "<td>".$k."</td>";
						echo "<td><img src='images/file.png'></td>";
						echo "<td style='text-align: left; padding-left:5px;'>".$fname[2]."</td>";
						echo "<td>".round(($val['size']/1024),2)." KB</td>";
						echo "<td>".date('D, d M Y',$val['time'])."</td>";
						echo "<td>";
						echo "<a href='customerdelete_filesadmin.php?customerid=".$criteria."&folder=".$folderName."&download=".$val['name']."' onclick=\"javascript:return confirm('Are you sure you want to Download this file?')\">Download</a>";
						echo "</tr>";
						$k++;						 
				}
			}
			if($k==1){
				echo "<tr><td colspan='6'>";
				echo "There have no Files";
				echo "</td></tr>";
			}
		}else{
			echo "<tr><td colspan='6'>";
			echo "There have no Files";
			echo "</td></tr>";
		}
		?>
		</table>
	</div>
</div>
</body>
</html> 