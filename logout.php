<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php session_destroy();?>
<?php
//將session清空
unset($_SESSION['username']);
echo 'Logging Out......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>