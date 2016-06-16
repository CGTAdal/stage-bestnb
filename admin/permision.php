<?php 
@session_start();
function check($action,$value)
{
	if($_SESSION["userlevel"] == $value){
		return true;
	}else {
		return false;
	}
}
?>