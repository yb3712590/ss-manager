<?php
require 'dbconn.php';
require 'function.php';

$upasswd=md5($_POST['upasswd']);
$account=$_POST['account'];
$sql="update user set upasswd = '$upasswd' where uname='$account'"; 
mysql_query($sql);
header("Location:manage.php?account=".$account);
?>
