<?php

$hostname_DB = "192.168.1.173";
$database_DB = "stagebnb_db1";
//$username_DB = "stagebnb_user1";
//$password_DB = "DB9R5r50lkLNlaS";
$username_DB = "admin";
$password_DB = "admin";

$ravcodb = mysql_pconnect($hostname_DB, $username_DB, $password_DB) or trigger_error(mysql_error(),E_USER_ERROR); 


?>