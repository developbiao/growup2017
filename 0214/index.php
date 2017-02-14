<?php
header('Content-Type:text/html; charset=utf-8');
include "./http.class.php";

// php send post request test
$url = 'http://192.168.199.38/growup2017/0214/demo.php';
$str = str_shuffle('abcdefghijklmnopqrst0123456');
$title = substr($str, 0, 5);
$content= substr($str, 6, 8);

$http = new Http($url);
$data = $http->post(array('username'=>'pansiyu', 'age'=>19, 'title'=>$title, 'content'=>$content, 'submit'=>'infomation'));
echo $data;

