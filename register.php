<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'function.php';
require 'dbconn.php';
$err_msg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    do {
        //POST
        if (!isset($_POST['email']) || !isset($_POST['upasswd']) || !isset($_POST['upasswd1']) || !isset($_POST['uname'])) {
            $err_msg = '注册信息不完整.';
            break;
        }
        if ($_POST['upasswd'] != $_POST['upasswd1']) {
            $err_msg = '两次输入密码不相同.';
            break;
        }
        $_SESSION['phrase'] = '';
        $email = mysql_real_escape_string($_POST['email']);
        $passwd = mysql_real_escape_string($_POST['upasswd']);
        $name = mysql_real_escape_string($_POST['uname']);
        //长度检查
        if (strlen($email) > 32) {
            $err_msg = '邮箱长度小于32位.';
            break;
        }
        if (strlen($passwd) > 16) {
            $err_msg = '密码长度小于16位.';
            break;
        }
        /* preg_match("/^[0-9a-z._]+@(([0-9a-z]+)[.])+[a-z]{2,}$/", strtolower($_POST['email']), $re);
          if ($re == null) {
          $err_msg = '邮箱格式错误!';
          break;
          } */
        //检查是否已经注册
        $sql = "SELECT uname FROM user WHERE uname = '$name'";
        $result = mysql_query($sql);
        if ($result && mysql_num_rows($result) > 0) {
            $err_msg = '账户已经注册!';
            break;
        }
        $sql = "SELECT port FROM user WHERE email = '$email'";
        $result = mysql_query($sql);
        if ($result && mysql_num_rows($result) > 0) {
            $err_msg = '邮箱已经注册!';
            break;
        }
        //找一个端口
        $sql = "select max(port) as port from user";
        $result = mysql_query($sql);
        $port = 40000;
        if ($row = mysql_fetch_array($result)) {
            $max_port = intval($row['port']);
            if ($max_port != 0) {
                $port = $max_port + 1000;
            }
        }
        $passwd = md5("$passwd");
        $ss_passwd = mt_rand(10000000, 99999999);
        //插入注册用户数据
        $sql = "INSERT INTO user (port,uname,upasswd,email,active,utype,upload,download,transfer_limit,ss_passwd,exp) VALUES ('$port','$name','$passwd', '$email', '1', '0', '0','0','1073741824',$ss_passwd,date_add( curdate() , INTERVAL 3 DAY))";
        $result = mysql_query($sql);
        if (!$result) {
            $err_msg = '发生错误!';
            break;
        }
        $err_msg = '注册成功!首次注册可以试用3天Shadowsocks服务!请联系管理员开通服务！<a href="login.php" class="btn">登录</a>';
        break;
    } while (false);
}
mysql_close($link);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/my.css" rel="stylesheet">
    </head>
    <body>
        <?PHP print_navbar() ?>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- 左侧内容 -->
                    <h2 id="labels" class="page-header">注册一个帐号(账号不要带空格！)</h2>
                    <?php
                    if ($err_msg != '') {
                        echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
                    }
                    ?>
                    <form class="form-horizontal" role="form" method="post" action="#">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control"  placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">帐号:</label>
                            <div class="col-sm-10">
                                <input type="text" name="uname" class="form-control"  placeholder="Account">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">密码:</label>
                            <div class="col-sm-10">
                                <input type="password" name="upasswd" class="form-control"  placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">确认密码:</label>
                            <div class="col-sm-10">
                                <input type="password" name="upasswd1" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">注册</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <!-- 右侧内容 -->
                    <div style="padding-top: 100px; font-size: 18px;">点击这里<a href="login.php">登录</a></div>
                </div>
            </div>
        </div>
    </body>
</html>
