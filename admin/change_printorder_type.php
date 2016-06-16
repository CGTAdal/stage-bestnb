<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
include('permision.php');
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
window.close();
</script>
<?php }
if(isset($_REQUEST['option']) && $_REQUEST['option']=='change_type') {
	$type 	= intval($_REQUEST['type']);
	$id		= intval($_REQUEST['id']);
	$qry = "
		UPDATE `printorders` SET `type` = '{$type}' WHERE `printorders`.`id` ={$id};
	";
	$result = mysql_query($qry);
} else if(isset($_REQUEST['option']) && $_REQUEST['option']=='change_status') {
	$status	= $_REQUEST['status'];
	$id		= intval($_REQUEST['id']);
	$qry = "
		UPDATE `printorders` SET `prod_status` = '{$status}' WHERE `printorders`.`id` ={$id};
	";
	$result = mysql_query($qry);
}