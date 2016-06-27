<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//下面是数据库连接信息，修改为你自己的即可
$host = 'localhost';
$user = 'shadowsocks';
$pwd = 'shadow';
$db = 'shadowsocks';

$link = mysql_connect($host, $user, $pwd);
if (!$link) {
    echo "mysql connect error: ", mysql_error();
    exit;
}
#选择要使用的数据库
mysql_select_db($db);


#设定编码
mysql_query("set names utf8");
?>
