#!/usr/local/bin/php
<?php
error_reporting(0);
/**
* $Id$
*
* S3 class usage
*/

if (!class_exists('S3')) require_once 'S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJDXKDUJQ6HNIYWQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$bucketName = '1_qwe_1443250725'; // Temporary bucket

if(isset($_POST['submit'])){ 
    //retreive post variables
    $fileName = $_FILES['theFile']['name'];
    $fileTempName = $_FILES['theFile']['tmp_name'];
  
    // Instantiate the class
    $s3 = new S3(awsAccessKey, awsSecretKey); 
    // Put our file (also with public read access)
    if ($s3->putObjectFile($fileTempName, $bucketName.'/test1', baseName($fileName), S3::ACL_PUBLIC_READ)) {
      echo "File: File copied to {$bucketName}/".baseName($fileName).PHP_EOL;
    } else {
      echo "File: Failed to copy file\n";
    } 
} 
?>

<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="theFile" id="theFile">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html> 

