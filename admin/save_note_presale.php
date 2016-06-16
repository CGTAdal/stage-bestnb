<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
$id = $_REQUEST['id_presale'];
$date = date('m/d/Y');
$hour = date('h:s a');
if(isset($_REQUEST['user_name'])){
	$user_name = $_REQUEST['user_name'];
	$notes  ='<br> <b>'.$date.' - '.$hour.'-'.$user_name.'</b> '. sc_mysql_escape(urldecode(trim($_REQUEST['note']))).'{note}';
	$sql = "UPDATE order_wizard SET notes = concat(notes,'{$notes}')  WHERE id='{$id}' ";
}
mysql_query($sql);

//get note after update 
if(isset($_REQUEST['refresh']) && $_REQUEST['refresh']==1){
	$sql_note = "SELECT notes FROM order_wizard WHERE id=$id";
	$result = mysql_query($sql_note);
	if($result){
		$row = mysql_fetch_assoc($result);
		$arr_note  = explode("{note}",$row['notes']);	
		foreach($arr_note as $notes){
			echo sc_mysql_escape(htmlspecialchars_decode($notes));
		}
	}
}
?>
