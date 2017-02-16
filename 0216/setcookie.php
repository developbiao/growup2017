<?php
header('Content-Type:text/html; charset:utf-8');
// set cookie for broswer
setcookie('username', 'Wangermao', time() + 3600);
echo "<h3>Set cookie is success!</h3>";

?>