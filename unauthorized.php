<?php 
require_once('admin/conn/DB.php');
include('admin/conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();

function formatMoney($number, $cents = 2) { // cents: 0=never, 1=if needed, 2=always
  if (is_numeric($number)) { // a number
    if (!$number) { // zero
      $money = ($cents == 2 ? '0.00' : '0'); // output zero
    } else { // value
      if (floor($number) == $number) { // whole number
        $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
      } else { // cents
        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
      } // integer or decimal
    } // value
    return '$'.$money;
  } // numeric
} // formatMoney



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Best Name Badges - Receipt</title>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000;
}
-->
</style>
</head>

<body>
<table width="698" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="267" height="89" valign="top"><img src="images/best-name-badges-logo.png" width="228" height="67" /><br />
      <br /></td>
    <td width="433" align="right" valign="top"><strong style="font-size: 24px;">PURCHASE ORDER RECEIPT</strong><br />
      <br />
      support@bestnamebadges.com<br />
Phone: 888.445-7601</td>
  </tr>
 
  <tr>
    <td height="32" colspan="2">
	<table width="700" border="0" cellspacing="2" cellpadding="5">
      <tr style="background-color: #CCC;">
        <td width="253" align="center" valign="middle">You are not authorized to view this receipt!</td>
      </tr>
	 
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>