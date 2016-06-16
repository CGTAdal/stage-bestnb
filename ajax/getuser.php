<?php 
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$qry = "SELECT * FROM customers WHERE username = '".$_REQUEST["name"]."'";
$names = mysql_query($qry);
$name = mysql_fetch_assoc($names);

if ($name)
{
	echo "<font color='red'>Name Already Exists, Choose Another</font>";
} else {
	echo "<font color='green'>User Name Valid</font>";
}
?>