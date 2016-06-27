<?php
session_start();
require 'dbconn.php';
require 'function.php';
$uanme="";
$err_msg="";
if ($_SESSION['uname'] != 'admin') {
    header("Location: ./panel.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $account=$_POST['uname'];
    $sql="select * from user where uname='$account'";
    if(mysql_num_rows(mysql_query($sql))==0){
        $err_msg="没有该用户!";
    }else{
        header("Location: ./manage.php?account=".$account);
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
                <div class="col-md-8">
                    <?php echo_users(); ?>
                </div>
                <!--<div class="col-md-1"></div>-->
                <div class="col-md-4">
                    <h3 id="labels" class="h3" style="text-align: center">按用户名管理</h3>
                    <h3 id="labels" class="h3"><br></h3>
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
                            <div class="col-sm-offset-2 col-sm-2">
                                <button type="submit" class="btn btn-default">管理</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
</html>
<?php

function echo_users() {
    $sql = "select port,uname,email,active,utype from user;";
    $ResultSet = mysql_query($sql);
    $active = "";
    ?>
    <table class='table'>
        <caption class="h3">用户情况表</caption>
        <thead>
            <tr>
                <th class="col-sm-2">端口</th>
                <th class="col-sm-3">用户名</th>
                <th class="col-sm-5">邮箱</th>
                <th class="col-sm-1">类型</th>
                <th class="col-sm-1">状态</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysql_fetch_array($ResultSet)) {
                switch ($row['active']) {
                    case 0:$active = "danger";
                        break;
                    case 1:$active = "success";
                        break;
                    default :$active = "danger";
                }
                if ($row['utype'] == '0') {
                    $row['utype'] = "时长";
                } else {
                    $row['utype'] = "流量";
                }
                if ($row['active'] == '0') {
                    $row['active'] = "欠费";
                } else {
                    $row['active'] = "正常";
                }
                ?>   
                <tr class=<?php echo $active ?>>
                    <td><?php echo $row['port']; ?></td>
                    <td><?php echo $row['uname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['utype']; ?></td>
                    <td><?php echo $row['active']; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>