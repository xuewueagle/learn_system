<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type = 'text/css'>
            @import"newcss.css";
        </style>
        <style>
            .title1 {
                float:left;width: 50%;margin-left:230px;font-size: 30px;margin-top: 100px;font-family: 黑体;
            }
            .title2 {
                float:left;width: 50%;margin-left:230px;margin-top: 20px;
            }
            .title3 {
                float:right;margin-top: 80px;margin-right: 300px;margin-bottom: 100px;
            }
        </style>
    </head>
    <body>
        <?php
        include 'head.php';
        ?>
        <div style="float:left;width: 50%">
            <div class="title1">欢迎使用JAVA学习系统</div>
            <div class="title2">请先登录，登录后可使用更多功能。</div>
            <div class="title2">没有账号请点击注册，成为新用户。</div>
            <div class="title2"><a href='password_forgot.php'><span style="color:blue;">忘记密码?</span></a></div>
        </div>
        <div  class="title3">
            <?php
            include 'logon_form.php';
            ?>
        </div>
        <?php
        include 'foot.php';
        ?>
    </body>
</html>
