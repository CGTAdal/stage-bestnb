<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
if($_REQUEST['action']){
	$user_id  		= $_REQUEST['user_id'];
	$pre_sale_id	= $_REQUEST['pre_sale_id'];
	$sql = 'UPDATE order_wizard SET sale_id="'.$user_id.'" WHERE id='.$pre_sale_id;	
	mysql_query($sql);
}else{
	$status = $_REQUEST['status'];
	$id = $_REQUEST['id'];
	$sql = 'UPDATE order_wizard SET status="'.$status.'" WHERE id='.$id;
	mysql_query($sql);
}