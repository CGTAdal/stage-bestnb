<?php
require_once('conn/DB.php');
include('conn/tablefuncs.php');
mysql_select_db($database_DB, $ravcodb);
session_start();
$qry = "SELECT batches. * , batches.name as bname, batches.subtext as bsubtext, batches.subtext2 as bsubtext2,  custstyle. * , custstyle.id AS custid, styles. * , styles.name AS sname, colors. * , colors.name AS cname
FROM batches
LEFT JOIN custstyle ON ( custstyle.id = batches.custstyleid ) 
LEFT JOIN styles ON ( styles.id = custstyle.styleid ) 
LEFT JOIN colors ON ( colors.id = custstyle.color ) 
WHERE batches.printorderid = ".$_REQUEST["orderid"];

$badges = mysql_query($qry) or die('Query failed: ' . mysql_error()); 
$badge = mysql_fetch_assoc($badges);

$date = getdate();
srand ((double) microtime( )*1000000);
$random_number = rand(1000000000,9999999999);
	
$domainownersfile = "txtfiles/".$date[0].$random_number."_textfile.txt";
$fp = fopen( $domainownersfile, "w");
$data = "";

do{
	$data .= $badge["bname"]."\t";
	$data .= $badge["bsubtext"]."\t";
	$data .= $badge["bsubtext2"]."\t\r";
} while ($badge = mysql_fetch_assoc($badges));

fwrite($fp, $data); 
fclose($fp); 
?>		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<center><a href="<?php echo $domainownersfile; ?>" target="_blank">Text File is Ready</a><br />(click to see names, or right-click and save-as to save .txt file)</center>
</body>
</html>
