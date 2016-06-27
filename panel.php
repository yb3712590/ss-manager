<?php
session_start();
require 'dbconn.php';
require 'function.php';
if (empty($_SESSION["uname"])) {
    header("Location: ./login.php");
}elseif($_SESSION["uname"]=="admin"){
    header("Location: ./control.php");
}
$uname=$_SESSION['uname'];
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
                <div class="col-md-6">
                    <h3 id="labels" class="page-header">
                        账户信息
                    </h3>
                    <?php
                    echo_account_info($uname);
                    ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div style="padding-top: 100px; font-size: 18px;">如需充值或有其他疑问<br>请<a href="contact.php">联系</a>管理员</div>

                </div>



            </div>
        </div>
    </body>
</html>

