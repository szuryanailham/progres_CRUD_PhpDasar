<?php
session_start();
$_SESSION = []; 

setcookie('id','',time()-3600);
setcookie('key','',time()-3600);
session_destroy();
session_destroy();

header("Location: login.php");
exit;
?>