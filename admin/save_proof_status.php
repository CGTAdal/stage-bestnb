<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$status   = $_REQUEST['status'];
$id		= $_REQUEST['id'];
$sql = "UPDATE printorders SET proof_status = '{$status}'  WHERE  id='{$id}' ";
//echo $sql;
mysql_query($sql);
?>
