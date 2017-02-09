<?php
header('Content-Type:text/html; charset=utf-8');
header('Location: ./04.php', true, 307);
exit;
echo '<pre>';
print_r($_POST);
echo '</pre>';
?>