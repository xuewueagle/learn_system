<style type = 'text/css'>
    @import"newcss.css";
</style>
<div class='na'>
    <a class='b0' href='index.php'>退出</a>
    <span class='b2'><?php echo $name; ?><?php echo $admin == 0 ? "老师" : "管理员" ?>，你好！</span>
    <a class='a0' href='guide_teacher.php'<?php echo $choice === 1 ? "style='color:red'" : "" ?>>创建班级</a>
    <a class='a1' href='#'<?php echo $choice === 2 ? "style='color:red'" : "" ?>>编辑题目</a>
    <a class='a1' href='#'<?php echo $choice === 5 ? "style='color:red'" : "" ?>>设计试卷</a>
    <a class='a1' href='#'<?php echo $choice === 6 ? "style='color:red'" : "" ?>>组织考试</a>
    <a class='a1' href='modify_password.php'<?php echo $choice === 3 ? "style='color:red'" : "" ?>>修改密码</a>
    <a class='a1' href='personal_information1.php'<?php echo $choice === 4 ? "style='color:red'" : "" ?>>修改基本信息</a>
    <a class='a1' href='center_teacher.php'<?php echo $choice === 7 ? "style='color:red'" : "" ?>>用户中心</a>
    <a class='a1' href='view_forum.php'<?php echo $choice === 8 ? "style='color:red'" : "" ?>>查看论坛版块</a>
    <a class='a1' href='add_forum.php'<?php echo $choice === 9 ? "style='color:red'" : "" ?>>新增论坛版块</a>
    <?php 
        if($admin==0){

    ?>
    <a class='a1' href='view_post.php?type=2'<?php echo $choice === 10 ? "style='color:red'" : "" ?>>查看论坛帖子</a>
    <a class='a1' href='add_post.php?type=2'<?php echo $choice === 11 ? "style='color:red'" : "" ?>>论坛发帖</a>
    <a class='a1' href='view_mail.php?type=2'<?php echo $choice === 12 ? "style='color:red'" : "" ?>>查看站内信</a>
    <a class='a1' href='send_mail.php?type=2'<?php echo $choice === 13 ? "style='color:red'" : "" ?>>发送站内信</a>
    <?php    }?>
</div>
