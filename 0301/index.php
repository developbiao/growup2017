<?php
header('Content-Type:text/html; charset=utf-8');

// 测试php push 反向ajax
set_time_limit(0); //设置php脚本执行不超时
ob_start();
$pad = str_repeat(' ', 4000);
echo $pad, '<br />';
ob_flush();
flush(); //把生产的内容立即送给浏览器而不要等到脚本结束再一起送

$i = 10;
while($i--)
{
	echo $pad, '<br />';
	echo $i, '<br />';
	ob_flush();
	flush();
	sleep(1);
}

?>