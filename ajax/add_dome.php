<?php 
	session_start();
	if($_REQUEST["dome"]){
		$_SESSION['dome'] = $_REQUEST['dome'];
	}else {
		$_SESSION['dome'] = 0;
	}	
?>