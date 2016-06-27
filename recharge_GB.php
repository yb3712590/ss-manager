<?php
require 'dbconn.php';
require 'function.php';

$GB=$_POST['GB']*1024*1024*1024;
$account=$_POST['account'];
$sql="update user set transfer_limit=transfer_limit+'$GB' where uname='$account'"; 
mysql_query($sql);
header("Location:manage.php?account=".$account);
?>
