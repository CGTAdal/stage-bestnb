<?php 
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$check_type = $_REQUEST['checktype'];
if($check_type=='user'){
   // check user exist 
    $qry = "SELECT * FROM customers WHERE username = '".$_REQUEST["username"]."'";
    $names = mysql_query($qry);
    $name = mysql_fetch_assoc($names);

    if ($name)
    {
        echo "yes";
    } else {
        echo "no";
    }
}
if($check_type=='email'){
    // check email exist
    $qry = "SELECT * FROM customers WHERE email = '".$_REQUEST["email"]."'";
    $names = mysql_query($qry);
    $name = mysql_fetch_assoc($names);

    if ($name)
    {
        echo "yes";
    } else {
        echo "no";
    }
}

