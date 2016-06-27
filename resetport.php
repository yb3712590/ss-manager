<?php
require 'dbconn.php';
require 'function.php';

$port=$_POST['port'];
$account=$_POST['account'];
$sql="update user set port = '$port' where uname='$account'"; 
mysql_query($sql);
header("Location:manage.php?account=".$account);
?>
