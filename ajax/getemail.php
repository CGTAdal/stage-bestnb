<?php 
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$qry = "SELECT * FROM customers WHERE email = '".$_REQUEST["name"]."'";
$names = mysql_query($qry);
$name = mysql_fetch_assoc($names);

if ($name)
{
	echo "<font color='red'>Email Already Exists, Choose Another</font>";
} else {
	echo "<font color='green'>Email Is Valid</font>";
}
?>