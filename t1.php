<?php   
session_start();
$name = 'ok';
echo "<a href='t2.php'>下一页</a>".$name;
$_SESSION['name'] = 'ok';


?>