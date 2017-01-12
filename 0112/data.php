<?php
header('Content-Type:text/html; charset=utf-8');
$data = array(
    ["name"=>"gongbiao"], ["name"=>"lijun"], ["name"=>"test"]
);

echo json_encode($data);
