<?php 
require_once "functions.php";
$a="password";
$salt=generaterandom(20);
$val=$salt.$a.$salt;
$ret=md5($val);
echo "salt=$salt<br>val=$val<br>ret=$ret";




 ?>