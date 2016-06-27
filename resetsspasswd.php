<?php
require 'dbconn.php';
require 'function.php';

$ss_passwd=$_POST['ss_passwd'];
$account=$_POST['account'];
$sql="update user set ss_passwd = '$ss_passwd' where uname='$account'"; 
mysql_query($sql);
header("Location:manage.php?account=".$account);
?>
