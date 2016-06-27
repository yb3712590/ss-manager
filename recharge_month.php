<?php
require 'dbconn.php';
require 'function.php';

$num=$_POST['month'];
$account=$_POST['account'];
$sql="update user set exp = date_add(exp,interval '$num' month) where uname='$account'"; 
mysql_query($sql);
header("Location:manage.php?account=".$account);
?>
