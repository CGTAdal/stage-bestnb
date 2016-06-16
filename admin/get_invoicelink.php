<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
    parent.parent.location.href='admin.php';
    window.close();
</script>
<?php 
} 
  
$invoice_id = $_REQUEST['invoice_id'];
$sql = "SELECT * FROM invoices WHERE id='{$invoice_id}'";
$invoice_detail = mysql_query($sql);
if($invoice_detail){
    $invoice = mysql_fetch_array($invoice_detail); 
}else {
    $invoice = array();
}
 $link =$base_url.'/invoices.php?code='.$invoice['rand_code'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Best Name Badges - Content Management System</title>
<link href="includes/cms.css" rel="stylesheet" type="text/css" />


<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
</head>
    <body>	
        <div align="center" style=" font-size: 12px; padding-top:80px;">
             <?php
                echo "<a href ='".$link."' target='_blank'>".$link."</a>"; 
             ?>
        </div>
    </body>
</html>