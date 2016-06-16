<?php 
require_once('../admin/conn/DB.php');
include('../admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

$_SESSION["logotext".$_REQUEST["textnum"]] = $_REQUEST["value"];

?>