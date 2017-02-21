<?php
header('Content-Type:text/html; charset=utf-8');
require "./http.class.php";


/*
@Describe 通过http协议模拟采取图片
@Date: 2017/02/21
@Author:GongBiao
*/

$url = 'http://img.hb.aicdn.com/bdca8112fdd52859296223ff52c2507f865a405ba381c-X8Dzdg_fw658';

$http = new Http($url);

// 突破referer防盗链限制
$http->setHeader('Referer: http://huaban.com');

$result = $http->get();

//判断路径或者response的 mime头信息，确定图片的类型
$type_pos = strpos($result, "Content-Type:");
$file_type = substr($result, $type_pos, 30);
$space_pos = strpos($file_type, "\r\n");
$file_type = substr($result, $type_pos, $space_pos);
$file_type = explode('/', $file_type)[1];


/*
$finfo = new finfo(FILEINFO_MIME_TYPE);
$type = $finfo->buffer($result);
echo $type;
*/

//echo mime_content_type('./flower.jpeg');


// 从两个\r\n开始向后截取
$data = substr(strstr($result, "\r\n\r\n"), 4);


// 把采取到的图片二进制存储到文件
file_put_contents('./flower.' . $file_type, $data);

// 此程序有不完善的地方，应该

echo '<h3>Ok!</h3>';



?>