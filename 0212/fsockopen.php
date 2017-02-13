<?php
$fp = fsockopen("udp://cdvps1.woogiworld.cn", 6670, $errno, $errstr);
if (!$fp){
	echo "ERROR: $errno - $errstr<br />\n";
} else{
	fwrite($fp, "\n");
	echo fread($fp, 26);
	fclose($fp);
}
echo '<h3>Program runing is ok!</h3>';
?>