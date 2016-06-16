<?php
require_once('payment.php');

$billing =  new stdClass();
$array = array('address'=>'test1','address2'=>'test2','city'=>'city1','state'=>'state1','zip'=>'5641321');
foreach ($array as $key => $value)
{
    $billing->$key = $value;
}


$payment = new Payment();
$payment->cc_name = 'Test Tester';
$payment->cc_number = '4012000033330026';
$payment->cc_cvv = '123';
$payment->cc_month = 10;
$payment->amount = '2';
$payment->cc_year = 15;
$payment->email = 'test@test.com';
$result = $payment->charge($billing);

var_dump($result);

?>
