<?php
include "./http.class.php";

$url = 'http://huaban.com/purple';
$http = new Http($url);
$data = $http->get();
echo $data . '<br />';
echo "<h3>Program runing is ok</h3>";
