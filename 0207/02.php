<?php
header('Content-Type:text/html; charset=utf-8');
// 这个程序使用telent来发送post请求
// $方法 $路径 $版本
/*
分析: 要用POST方法
请求行

主体内容
据上:
POST /growup2017/0207/02.php HTTP/1.0



*/
$str = implode($_POST, "\n");
file_put_contents('./post.txt', $str);
echo "<h3>ok</h3>";
