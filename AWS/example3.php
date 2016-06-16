#!/usr/local/bin/php
<?php
/**
* $Id$
*
* S3 class usage
*/

if (!class_exists('S3')) require_once 'S3.php';

// AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJDXKDUJQ6HNIYWQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
$s3 = new S3(awsAccessKey, awsSecretKey); 
$bucketName = 'first-store'; // Temporary bucket
$uploadFile = '11040628_1035720893125570_7755588745008649793_n.jpg';
echo "<pre>";
    // Get the contents of our bucket
    $contents = $s3->getBucket($bucketName);
    echo "Get Bucket: Files in bucket {$bucketName}: ".print_r($contents, 1);


    // Get object info
    $info = $s3->getObjectInfo($bucketName, baseName($uploadFile));
    echo "GetObjectInfo: Info for {$bucketName}/".baseName($uploadFile).': '.print_r($info, 1);

?>
 

