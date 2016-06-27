<?php
session_start();
require 'dbconn.php';
require 'function.php';
$account = $_GET['account'];
$err_msg = $_GET['err_msg'];
if ($_SESSION['uname'] != 'admin') {
    header("Location: ./panel.php");
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
                <div class="col-md-6">
                    <h3 id="labels" class="page-header">
                        <?PHP echo $account ?>&nbsp;的详细信息
                    </h3>
                    <?php
                    echo_account_info($account);
                    echo_passwd_md5($account);
                    ?>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <h3 id="labels" class="page-header">
                        账户管理
                    </h3>
                    <div class="row-md-12">
                        <?PHP echo_recharge($account);
                        echo_reset_passwd($account);
                        echo_reset_port($account);
                        echo_reset_sspasswd($account);
                        ?></div>
                </div>



            </div>
        </div>
    </body>
</html>