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
    <a class='a1' href='view_post.php'<?php echo $choice === 10 ? "style='color:red'" : "" ?>>查看论坛帖子</a>
    <a class='a1' href='add_post.php'<?php echo $choice === 11 ? "style='color:red'" : "" ?>>论坛发帖</a>
    <a class='a1' id="view_p_message" href='view_mail.php'<?php echo $choice === 12 ? "style='color:red'" : "" ?>>查看站内信<b id="message"></b></a>
    <a class='a1' href='send_mail.php'<?php echo $choice === 13 ? "style='color:red'" : "" ?>>发送站内信</a>
    <?php    }?>
</div>

<script>
    var userId = "<?php echo $_SESSION['user']?>";
    var roleId = "<?php echo $_SESSION['lb'];?>";
    if(roleId == '教师'){
        roleId = 2;
    }else if(roleId == '学生'){
        roleId = 1;
    }

    setInterval(function(){
        // 当前时间与发送时间 比较 5分钟之内存在新增数据 站内提示 
        // 用户点击查看站内信 隐藏提示
        //alert('sdfsdf');

        $.post(
            "ajax_view_message.php", 
            {
                "to_uid": userId,
                "to_role": roleId,
                "type":'view'
            },
            function(data){
                console.log(data);
                if(data.status==1){
                    $('#message').empty();
                    $('#message').append('<marquee id="message" style="color:red;" loop=5>您有新消息，请注意查收！</marquee>');
                }
            }, 
            "json"
        );
    },5000);

    $('#view_p_message').click(function(){
        $.post(
            "ajax_view_message.php", 
            {
                "to_uid": userId,
                "to_role": roleId,
                "type":'update'
            },
            function(data){
                if(data.status==1){
                    $('#message').empty();
                }
            }, 
            "json"
        );
    });

</script>