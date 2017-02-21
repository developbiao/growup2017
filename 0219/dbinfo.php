<?php
header('Content-Type:text/html; charset=utf-8');
require '../common/rb.php';
$username = 'root';
$password = '123456';
$database = 'woogi0_1';


R::setup('mysql:host=192.168.199.38; dbname=woogiplay', 'root', '123456');

$records = R::findAll("markers");

echo '<pre>';
print_r($records);
echo '</pre>';



echo '<h3>Program runing is ok!</h3>';
?>
