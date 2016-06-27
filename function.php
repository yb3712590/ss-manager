<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function print_navbar() {
    ?>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">
                        Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
                <a class="navbar-brand" href="login.php">
                    SS_MANAGE
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?PHP
                    $arr_pages = array(
                        array('panel.php', '面板'),
                        array('contact.php', '联系我')
                    );
                    $page = end(explode('/', $_SERVER['PHP_SELF']));
                    foreach ($arr_pages as $p) {
                        if ($p[0] == $page)
                            echo '<li class="active"><a href="#">' . $p[1] . '</a></li>';
                        else
                            echo '<li><a href="' . $p[0] . '">' . $p[1] . '</a></li>';
                    }
                    ?>
                </ul>
                <?PHP
                if (!empty($_SESSION["uname"])) {
                    ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.php">
                                <?php echo $_SESSION['uname']; ?>
                            </a>
                        </li>
                        <li>
                            <a id="logout" href="logout.php">
                                注销
                            </a>
                        </li>
                    </ul><?PHP
                }
                ?>
            </div>
        </div>
    </div>
    <?PHP
}
?>
<?php

function echo_account_info($account) {
    $uname = $account;
    $query = "select port,ss_passwd,email,active,utype,exp,upload,download,transfer_limit from user where uname='$uname'";
    $row = mysql_fetch_array(mysql_query($query));
    $server = 's4vg.com';
    $port = $row['port'];
    $ss_passwd = $row['ss_passwd'];
    $email = $row['email'];
    $active = $row['active'];
    $utype = $row['utype'];
    $exp = $row['exp'];
    $upload = $row['upload'];
    $download = $row['download'];
    $transfer = $row['transfer_limit'];
    $protocol = "RC4-MD5";
    ?>
    <div class="input-group">
        <span class="input-group-addon">
            用户邮箱
        </span>
        <input type="text" value="<?php
        echo $email;
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            服务器IP
        </span>
        <input type="text" value="<?php
        echo $server;
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            端&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;口
        </span>
        <input type="text" value="<?php
        echo $port;
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            S&nbsp;S&nbsp;&nbsp;密码
        </span>
        <input type="text" value="<?php
        echo $ss_passwd;
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-addon">
            加密协议
        </span>
        <input type="text" value="<?php
        echo $protocol;
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <h3 class="page-header">
    </h3>
    <div class="input-group">
        <span class="input-group-addon">
            用户类型
        </span>
        <input type="text" value="<?php
        if ($utype == 0) {
            echo "时长用户";
        } else {
            echo "流量用户";
        }
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <?php if ($utype == 0) { ?>
        <div class="input-group">
            <span class="input-group-addon">
                到期时间
            </span>
            <input type="text" value="<?php
            echo $exp;
            ?>
                   " disabled="disabled" class="form-control">
        </div><?php
    } else {
        ?>    
        <div class="input-group">
            <span class="input-group-addon">
                当前流量
            </span>
            <input type="text" value="<?php
            echo ($upload + $download)/1024/1024/1024;
            echo " GB";
            ?>
                   " disabled="disabled" class="form-control">
        </div>
        <div class="input-group">
            <span class="input-group-addon">
                流量阈值
            </span>
            <input type="text" value="<?php
            echo $transfer/1024/1024/1024;
            echo " GB";
            ?>
                   " disabled="disabled" class="form-control">
        </div>
        <?php
    }
}

function echo_passwd_md5($account) {
    $uname = $account;
    $query = "select upasswd from user where uname='$uname'";
    $row = mysql_fetch_array(mysql_query($query));
    ?>
    <h3 class="page-header">
    </h3>
    <div class="input-group">
        <span class="input-group-addon">
            密码MD5
        </span>
        <input type="text" value="<?php
        echo $row['upasswd'];
        ?>
               " disabled="disabled" class="form-control">
    </div>
    <?php
}

function echo_recharge($account) {
    $query = "select utype from user where uname='$account'";
    $row = mysql_fetch_array(mysql_query($query));
    if ($row['utype'] == 0) {
        ?><div class="col-md-12">
        <?php
        if ($err_msg != '') {
            echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
        }
        ?>
            <form class="form-horizontal" role="form" method="post" action=recharge_month.php>
                <div class="form-group">
                    <label class="col-md-pull-1 col-md-3 control-label">充值</label>
                    <div class="col-md-pull-1 col-md-3">
                        <input type="text" name="month" class="form-control"  value="1" >
                        <input type="hidden" name="account" class="form-control"  value=<?PHP echo $account ?> >
                    </div>
                    <label class="col-md-pull-2 col-md-3 control-label">个月</label>
                    <div class="col-md-2 col-md-2">
                        <button type="submit" class="btn btn-default">确认</button>

                    </div>
                </div>
            </form>


        </div>
        </div><?PHP
    } else {
        ?><div class="col-md-12">
        <?php
        if ($err_msg != '') {
            echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
        }
        ?>
            <form class="form-horizontal" role="form" method="post" action=recharge_GB.php>
                <div class="form-group">
                    <label class="col-md-pull-1 col-md-3 control-label">充值</label>
                    <div class="col-md-pull-1 col-md-3">
                        <input type="text" name="GB" class="form-control"  value="1">
                        <input type="hidden" name="account" class="form-control"  value=<?PHP echo $account ?> >
                    </div>
                    <label class="col-md-pull-2 col-md-3 control-label">GB</label>
                    <div class="col-md-2 col-md-2">
                        <button type="submit" class="btn btn-default">确认</button>

                    </div>
                </div>
            </form>


        </div><?PHP
    }
}

function echo_reset_passwd($account) {
    ?><div class="col-md-12">
    <?PHP
    if ($err_msg != '') {
        echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
    }
    ?>
        <form class="form-horizontal" role="form" method="post" action=resetpasswd.php>
            <div class="form-group">
                <label class="col-md-pull-1 col-md-3 control-label">新密码</label>
                <div class="col-md-pull-1 col-md-7">
                    <input type="text" name="upasswd" class="form-control"  placeholder="NEW PASSWORD" >
                    <input type="hidden" name="account" class="form-control"  value=<?PHP echo $account ?> >
                </div>
                <div class="col-md-pull-1 col-md-2">
                    <button type="submit" class="btn btn-default">确认</button>

                </div>
            </div>
        </form>
    </div>
    <?PHP
}

function echo_reset_port($account) {
    ?><div class="col-md-12">
    <?PHP
    if ($err_msg != '') {
        echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
    }
    ?>
        <form class="form-horizontal" role="form" method="post" action=resetport.php>
            <div class="form-group">
                <label class="col-md-pull-1 col-md-3 control-label">新端口</label>
                <div class="col-md-pull-1 col-md-7">
                    <input type="text" name="port" class="form-control"  placeholder="NEW PORT" >
                    <input type="hidden" name="account" class="form-control"  value=<?PHP echo $account ?> >
                </div>
                <div class="col-md-pull-1 col-md-2">
                    <button type="submit" class="btn btn-default">确认</button>

                </div>
            </div>
        </form>
    </div>
    <?PHP
}

function echo_reset_sspasswd($account) {
    ?><div class="col-md-12">
    <?PHP
    if ($err_msg != '') {
        echo "<div class='alert alert-danger' role='alert'>{$err_msg}</div>";
    }
    ?>
        <form class="form-horizontal" role="form" method="post" action=resetsspasswd.php>
            <div class="form-group">
                <label class="col-md-pull-1 col-md-3 control-label">SS密码</label>
                <div class="col-md-pull-1 col-md-7">
                    <input type="text" name="ss_passwd" class="form-control"  placeholder="NEW SS PASSWORD" >
                    <input type="hidden" name="account" class="form-control"  value=<?PHP echo $account ?> >
                </div>
                <div class="col-md-pull-1 col-md-2">
                    <button type="submit" class="btn btn-default">确认</button>

                </div>
            </div>
        </form>
    </div>
    <?PHP
}
?>
