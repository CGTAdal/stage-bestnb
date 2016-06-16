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

if($_REQUEST['setmail']){    
    $invoice_id = $_REQUEST['invoice_id'];
    $customer_id = $_REQUEST['customer_id'];
    $rand_code   = $_REQUEST['rand_code'];
    $email       = $_REQUEST['email'];
    $url         = $_REQUEST['url'];
    
    
    $to = $email;
    $link =$base_url.'/invoices.php?code='.$rand_code;
    $subject = '[Best Name Badges] New Invoice '.$invoice_id;
    $message = 'You have a new invoice from Best Name Badges in the amount of $'.$_REQUEST['total'].', to view the invoice, pay the invoice online, and print a copy for your records, click the link below:<br></br>
'.$link.'<br></br>
<p></p>    
Best regards,<br></br>
Best Name Badges (sales@bestnamebadges.com)<br>(888) 445-7601</br>';
    $addition_email = $_REQUEST['addition_email'];            
    //define the headers we want passed. Note that they are separated with \r\n    
    //add boundary string and mime type specification   
    $headers = "MIME-Version: 1.0" . "\r\n";					
    $headers .= "Content-type:text/html; charset=utf-8" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "From: sales@bestnamebadges.com \r\n";				    
    $headers.= "Cc: {$addition_email} \r\n"; 
    mail($to, $subject, $message, $headers);
    ?>  
    
 <script language="javascript">		           
        parent.parent.location.href = "<?php echo $url;?>?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $invoice_id;?>";
		window.close();
 </script>
<?php
}
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
        <div align="center">
            <form action="" name="payment" method="post">
                <input type="hidden" value="1" name="setmail"/>
                <input type="hidden" value="<?php echo $_REQUEST['customer_id'];?>" name="customer_id" />
                <input type="hidden" value="<?php echo $invoice_id;?>" name="invoice_id"/>
                <input type="hidden" value="<?php echo $invoice['rand_code'];?>" name="rand_code" />
                
                <input type="hidden" value="<?php echo $_REQUEST['total'];?>" name="total" /> 
                <table>                    
                    <tr>
                        <td><strong>Customer Email</strong></td>
                        <td><input type="text" name="email" value="<?php echo $invoice['email'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Additional email</td>
                        <td><input type="text" name="addition_email" value="" />(use ',' to determine multiple email)</td>
                    </tr>
                   
                    <tr>
                        <td><input type="submit" value="Send" name="payment"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>