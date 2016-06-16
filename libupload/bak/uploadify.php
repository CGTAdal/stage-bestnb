<?php
@session_start();
if (!empty($_FILES)) {
	//$tempFile = $_FILES['Filedata']['tmp_name'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$random_number = rand(1000000000,9999999999);
	$date = getdate();
	$logo = $_REQUEST['logo'];	 
	$targetFile =  str_replace('//','/',$targetPath) .$date[0].$random_number.'_'.$logo.'_'.$_FILES['Filedata']['name'];
	$_SESSION['logo'.$logo] = $targetFile; 	
	@move_uploaded_file($tempFile,$targetFile);
	echo $_REQUEST['folder'].'/'.$date[0].$random_number.'_'.$logo.'_'.$_FILES['Filedata']['name'];		
}
?>