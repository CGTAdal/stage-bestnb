<?php
$dir    = '../output';
$files1 = scandir($dir);

foreach($files1 as $file)
{
	if ($file <> "." && $file <> "..")
	{
		unlink("../output/".$file);
		echo $file." Deleted<BR>";
	}
}

?>