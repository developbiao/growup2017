<?php
header('Content-Type:text/html; charset-utf-8');

//header('Location: http://www.google.com'); //默认302重定向

//指定用301重定向，true参加意用301信息替换原来的头信息
header('Location: http://www.google.com', true, 301);
?>