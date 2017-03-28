<?php
header('Content-Type:text/html; charset=utf-8');
require_once "../common/rb.php";
R::setup('mysql:host=192.168.199.38:3306; dbname=woogiplay', 'root', '123456');

$table_name = 'markers';

$result = R::getAll("SELECT * FROM {$table_name}");

echo '<pre>';
print_r($result);
echo '</pre>';


echo '<h3>Program runing is ok!</h3>';
?>