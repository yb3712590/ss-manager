<?php
session_start();
require 'dbconn.php';
require 'function.php';
if (empty($_SESSION["uname"])) {
    header("Location: ./login.php");
}elseif($_SESSION["uname"]=="admin"){
    header("Location: ./control.php");
}else{
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
    </body>
</html>
