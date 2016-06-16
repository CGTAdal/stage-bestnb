<?php 
	session_start();
	if($_REQUEST["proof"]){
		$_SESSION["bannername"] = $_REQUEST['proof'];
	}	
?>