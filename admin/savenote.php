<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
$id = $_REQUEST['id'];
$note = htmlspecialchars_decode($_REQUEST['note']);
$date = date('m/d/Y');
$hour = date('h:s a');
$user_name = $_REQUEST['user_name'];
$notes  ='<b>'.$date.' - '.$hour.'-'.$user_name.'</b> '. sc_mysql_escape(htmlspecialchars_decode($_REQUEST['note'])).'{note}';
$sql = "UPDATE printorders SET  note=CONCAT(note,'{$notes}')  WHERE id=$id";
//echo $sql;
mysql_query($sql) or die('Error query');
//get note after update 
if(isset($_REQUEST['refresh']) && $_REQUEST['refresh']==1){
	$sql_note = "SELECT note FROM printorders WHERE id=$id";
	$result = mysql_query($sql_note);
	if($result){
		$row = mysql_fetch_assoc($result);
		$arr_note  = explode("{note}",$row['note']);	
		foreach($arr_note as $notes){
			echo sc_mysql_escape(htmlspecialchars_decode($notes)).'<br>';
		}
	}
}
?>
