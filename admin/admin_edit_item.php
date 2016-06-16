<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
include('../include/config.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
//if (!$_SESSION["loginid"] || $_SESSION["userlevel"] < 2)
if (!$_SESSION["loginid"])
{?>
<script language="javascript">
parent.parent.location.href='admin.php';
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
<?php 

$item_id = $_REQUEST['item_id'];
$customer_id = $_REQUEST['customer_id'];
$invoice_id = $_REQUEST['invoice_id'];
//echo $item_id.'-'.$customer_id.'-'.$invoice_id;
$sql_detail_item = "SELECT *FROM `item_invoice` WHERE id = '{$item_id}'";
//echo $sql_detail_item;
$result_detail_item = mysql_query($sql_detail_item);
if($result_detail_item){
    $detail_iteam = mysql_fetch_array($result_detail_item);
}else{
    $detail_iteam = array();
}
if($_REQUEST['edit']==1){
   // die('aaaa');
    $item_id = $_REQUEST['item_id'];
    $customer_id = $_REQUEST['customer_id'];
    $invoice_id = $_REQUEST['invoice_id'];
    $item = $_REQUEST['item'];
    $description = $_REQUEST['description'];
    $unit_cost = $_REQUEST['unit_cost'];
    $qty        = $_REQUEST['qty'];    
    $total      = $_REQUEST['total'];
   
    
    $sql_update_item = "UPDATE `item_invoice` SET item='{$item}', description = '{$description}', unit_cost = '{$unit_cost}', qty = '{$qty}', total = '{$total}'
                        WHERE id='{$item_id}'";
    //echo $sql_update_item;                    
    mysql_query($sql_update_item);
    
   
?>
    <script language="javascript">
		parent.parent.location.href = "admin_edit_invoice.php?customer_id=<?php echo $customer_id;?>&invoice_id=<?php echo $invoice_id;?>";
		window.close();
		</script>
<?php
}
?>
<script>
   function round_up (val, precision) {
        power = Math.pow (10, precision);
        poweredVal = Math.ceil (val * power);
        result = poweredVal / power;

        return result;
    }
  
    function number_format (number, decimals, dec_point, thousands_sep) {
        // Formats a number with grouped thousands  
        // 
        // version: 1109.2015
        // discuss at: http://phpjs.org/functions/number_format    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +     bugfix by: Michael White (http://getsprink.com)
        // +     bugfix by: Benjamin Lupton
        // +     bugfix by: Allan Jensen (http://www.winternet.no)    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +     bugfix by: Howard Yeend
        // +    revised by: Luke Smith (http://lucassmith.name)
        // +     bugfix by: Diogo Resende
        // +     bugfix by: Rival    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
        // +   improved by: davook
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +      input by: Jay Klehr
        // +   improved by: Brett Zamir (http://brett-zamir.me)    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
        // +     bugfix by: Brett Zamir (http://brett-zamir.me)
        // +   improved by: Theriault
        // +      input by: Amirouche
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // *     example 1: number_format(1234.56);
        // *     returns 1: '1,235'
        // *     example 2: number_format(1234.56, 2, ',', ' ');
        // *     returns 2: '1 234,56'
        // *     example 3: number_format(1234.5678, 2, '.', '');    // *     returns 3: '1234.57'
        // *     example 4: number_format(67, 2, ',', '.');
        // *     returns 4: '67,00'
        // *     example 5: number_format(1000);
        // *     returns 5: '1,000'    // *     example 6: number_format(67.311, 2);
        // *     returns 6: '67.31'
        // *     example 7: number_format(1000.55, 1);
        // *     returns 7: '1,000.6'
        // *     example 8: number_format(67000, 5, ',', '.');    // *     returns 8: '67.000,00000'
        // *     example 9: number_format(0.9, 0);
        // *     returns 9: '1'
        // *    example 10: number_format('1.20', 2);
        // *    returns 10: '1.20'    // *    example 11: number_format('1.20', 4);
        // *    returns 11: '1.2000'
        // *    example 12: number_format('1.2000', 3);
        // *    returns 12: '1.200'
        // *    example 13: number_format('1 000,50', 2, '.', ' ');    // *    returns 13: '100 050.00'
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');    }
        return s.join(dec);
    }
     function cal_total()
    {   
        var value = $("#qty").val();
        var unit_cost = $("#unit_cost").val();
        var tax = $("#tax").val();
        if(tax=='FL'){
            var total = value*unit_cost + value*unit_cost*6/100;
        }else {
            var total = value*unit_cost;
        }   
       
        $("#total").val(number_format(round_up(total,2),2,'.',','));
    }   
    

</script>
</head>
    <body>	
        <div align="center">
            <form action="" method="POST" name="edit_item">    
                <input type="hidden" value="1" name="edit" />
                <input type="hidden" value="<?php echo $item_id?>" name="item_id"/>
                <input type="hidden" value="<?php echo $invoice_id;?>" name="invoice_id" />
                <input type="hidden" value="<?php echo $customer_id;?>" name="customer_id" />
              <table>
                <tr>
                    <td><strong>Item</strong></td>
                    <td>
                        <input type="text" name="item" id="item" value="<?php echo $detail_iteam['item'];?>" />
                    </td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td><input type="text" name="description" id="description" value="<?php echo $detail_iteam['description']; ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Unit Cost</strong></td>
                    <td><input type="text" onchange="cal_total();" name="unit_cost" id="unit_cost" value="<?php echo $detail_iteam['unit_cost']; ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Qty</strong></td>
                    <td><input type="text" onchange="cal_total();" name="qty" id="qty" value="<?php echo $detail_iteam['qty']; ?>" /></td>
                </tr>               
                <tr>
                    <td><strong>Line Total</strong></td>
                    <td>
                            <input type="text" name="total" id="total" value="<?php echo $detail_iteam['total']; ?>" />                            
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Update" name="Update" /></td>
                    <td></td>
                </tr>
            </table> 
        </div>
    </body>
</html>    
