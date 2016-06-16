<?php

$hostname_DB = "localhost";
$database_DB = "stagebnb_db1";
$username_DB = "stagebnb_user1";
$password_DB = "DB9R5r50lkLNlaS";

$ravcodb = mysql_pconnect($hostname_DB, $username_DB, $password_DB) or trigger_error(mysql_error(),E_USER_ERROR); 


?>