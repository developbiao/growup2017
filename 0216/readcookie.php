<?php
header('Content-Type:text/html; charset:utf-8');
// read client cookie information
echo "<h3>I know you cookie is {$_COOKIE['username']}</h3>";
/*

// simulation
GET /growup2017/0216/readcookie.php HTTP/1.1
Host: localhost
Cookie: username=Wangermao; _cnzz_CV1256903590=is-logon%7Clogged-out%7C1486998453496; CNZZDATA1256903590=1038067576-1486987649-%7C1486998449

*/

?>