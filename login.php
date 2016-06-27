<?php
session_start();
if (!empty($_SESSION["uname"])) {
    header("Location: ./index.php");
}
require 'function.php';
require 'dbconn.php';
$err_msg = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $uname = $_POST['uname'];
    $upasswd = md5($_POST['upasswd']);
    $query = mysql_query("select uname from user where uname = '$uname' and upasswd = '$upasswd'");
    if (mysql_num_rows($query) == 1) {
        session_start();
        $row = mysql_fetch_array($query);
        $_SESSION['uname'] = $row['uname'];
//        if($_SESSION['uname']=='admin'){
//            header("Location: ./control.php");
//        }else{
//        header("Location: ./panel.php");}
        header("Location: ./index.php");
    } else {
        $err_msg = '用户名或密码错误.';
    }
}
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
                    <h2 id="labels" class="page-header">登录</h2>
                    <?php
                    if ($err_msg != '') {
                        echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
                    }
                    ?>
                    <form class="form-horizontal" role="form" method="post" action=#>
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
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="submit" class="btn btn-default">登录</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <!-- 右侧内容 -->
                    <div style="padding-top: 100px; font-size: 18px;">暂不支持找回,忘记密码请联系管理员</div>
                    <div style ="padding-top: 10px;font-size: 18px;">新用户点击此处<a href="register.php">注册</a></div>
                </div>
            </div>
        </div>
    </body>
</html>
