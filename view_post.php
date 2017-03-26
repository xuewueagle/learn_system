<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$choice = 10;
include 'head.php';
$name = $_SESSION['name'];
$admin = $_SESSION['admin'];
$user_id = $_SESSION['user'];
$role   = $_SESSION['lb'];
if($role=='教师'){
    $role_id=2;
    include 'navigation_teacher.php';
}else if($role=='学生'){
    $role_id=1;
    include 'navigation_student.php';
}

?>

<style>
    .table{
        border:solid 1px;width: 400px;margin: 30px auto 20px auto;border-color: #8cb5c8;
    }
    .haotr{
        height: 30px;border:solid 1px;
    }
    .haotd1{
        width: 100px;font-size: 14px;padding-left:10px;height: 30px;border:solid 1px #8cb5c8;
    }
    .haotd2{
        width: 300px;border:solid 1px #8cb5c8;
    }
    .haotd3{
        width: 150px;font-size: 14px;padding-left:10px;height: 30px;border:solid 1px #8cb5c8;text-align: center;
    }
    .haotd4{
        border:solid 1px #8cb5c8;text-align: center;
    }
    input[type="text"]{
        border-color: #8cb5c8;border: inset 1.5px;margin-top: 0px;
    }
    input[type="submit"]{
        background: orange;color: white;width: 70px;height:25px;font-size: 14px;
    }
</style>

<?php
@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
if ($mysqli->connect_errno) {
    echo "不能连接到数据库<br/>";
    return;
}
$mysqli->query("SET NAMES 'utf8'");

$type = isset($_GET['type']) ? $_GET['type'] :0;
if($role=='学生'){ // 学生
    $query = "SELECT o.id,o.title,o.content,o.post_time,o.from_uname,o.from_uid,o.role_id,o.reply_count,o.plate_name from db_javalearning.tb_posts as o left join db_javalearning.tb_plate as p on p.id=o.plate_id left join db_javalearning.tb_student as c on c.cno=p.class_id where c.sno=$user_id";
}else if($role=='教师'){// 老师
    $query = "SELECT o.id,o.title,o.content,o.post_time,o.from_uname,o.from_uid,o.role_id,o.reply_count,o.plate_name from db_javalearning.tb_posts as o left join db_javalearning.tb_plate as p on p.id=o.plate_id left join db_javalearning.tb_class as c on c.cno=p.class_id where c.tno=$user_id";
    
}

$result = $mysqli->query($query);
if (!$result) {
    echo "SQL语句执行失败！";
    return;
}
$info = array();
while($row = $result->fetch_assoc()){
    $info[] = $row;
}

$reply_query = "SELECT * from db_javalearning.tb_reply";
$reply_result = $mysqli->query($reply_query);
$reply_results = array();
while($row = $reply_result->fetch_assoc()){
    $reply_results[] = $row;
}


foreach ($info as $key => $value) {
    foreach ($reply_results as $k => $val) {
        if($value['id'] == $val['post_id']){
            $info[$key]['reply'][] = $val;
        }
    }
}


?>

	
    <div style="width:600px;border:1px solid #8cb5c8;margin:0 auto;">
    	<div style="width:580px;margin:0 auto;">

            <?php 
                foreach ($info as $key => $value) {
                
                
            ?>
    		<div style="width:580px;margin:0 auto;border:1px solid #dedede;margin-top:12px;"></div>
    		<div style="margin-top:5px;">
    			<label for="">发帖人:<b><?php echo $value['from_uname']; ?></b></label>&nbsp;<label for="" style="color:#4caf50"><?php echo $value['title']; ?></label>
    		</div>
    		<div>
    			<p style="text-indent:2em;">
    				<?php echo $value['content']; ?>
    			</p>
    			<div>
    				<label for="">发布时间：<?php echo date('Y年m月d日',$value['post_time']); ?></label><a style="margin-left:5px;" href="javascript:void(0);" status="1" onclick="start_replay(<?php echo $value['id']; ?>,this)">回复</a><label for="" style="margin-left:25px;">所属版块：<b style="color:#ff5722"><?php echo $value['plate_name']; ?></b></label>
    			</div>
                <div>
                    <label style="margin-left:427px;" for="">回复数：<?php echo $value['reply_count']; ?></label>
                    <?php  
                        if($role=='学生'){
                            if($user_id==$value['from_uid']){
                    ?>
                    <a style="margin-left:15px;" href="javascript:void(0)" onclick="del(<?php echo $value['id']; ?>,this,'post')">删除</a>
                    <?php 
                            } 
                        }else{
                    ?>
                    <a style="margin-left:15px;" href="javascript:void(0)" onclick="del(<?php echo $value['id']; ?>,this,'post')">删除</a>
                    <?php  
                        }
                    ?>

                </div>
    			
    		</div>
            <?php 
                if(isset($value['reply'])){
                foreach ($value['reply'] as $val) {
                    
                
            ?>
    		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:5px;"></div>
    		<div style="margin-top:5px;margin-left:20px;">
    			<label for="">回复人:<?php echo $val['uname']; ?></label>&nbsp;<label for=""><?php echo $val['content']; ?></label>
    		</div>
    		<div style="margin-left:20px;">
    			<label for="">回复时间：<?php echo date('Y年m月d日',$val['reply_time']); ?></label>
    		    <?php  
                    if($role=='学生'){
                        if($user_id==$val['uid']){
                ?>
                <a style="margin-left:315px;" href="javascript:void(0)" onclick="del(<?php echo $val['id']; ?>,this,'reply')">删除</a>
                <?php 
                        } 
                    }else{
                ?>
                <a style="margin-left:315px;" href="javascript:void(0)" onclick="del(<?php echo $val['id']; ?>,this,'reply')">删除</a>
                <?php  
                    }
                ?>
            </div>



            <?php }} ?>
            <?php } ?>


    		



			<div style="width:580px;margin:0 auto;border:1px solid #f44336;margin-top:10px;margin-bottom:5px;"></div>
    		<div style="width:580px;margin-top:5px;margin-bottom:25px;display:none;" id="launch_form">
    			<form id="frm" method="post">
    			<textarea name="reply" id="reply" style="width:576px;height:80px;">
    				
    			</textarea>
    			<button type="button" id="launch">发表</button>
    			<input type="hidden" name="rely_to_post_id" id="rely_to_post_id" value="">
    			</form>
    		</div>

    	</div>
    </div>

    <script>
    	function start_replay(id,obj){
    		var status = $(obj).attr('status');
    		$('#rely_to_post_id').val(id);
    		if(status==1){
    			$('#launch_form').css('display','block');
    			$(obj).attr('status',0);
    		}else if(status==0){
    			$('#launch_form').css('display','none');
    			$(obj).attr('status',1);
    		}
            $('#rely_to_post_id').val(id);
    		
    	}

        $('#launch').click(function(){
            var rely_to_post_id = $('#rely_to_post_id').val();
            var content = $('#reply').val();
            var uid     = "<?php echo $user_id; ?>";
            var name    = "<?php echo $name; ?>";
            $.post(
                "reply_post.php", 
                {
                    "rely_to_post_id": rely_to_post_id,
                    "content": content,
                    "uid": uid,
                    "name": name
                },
                function(data){
                    
                    if(data.status==1){
                        window.location.href='view_post.php';
                    }else{
                        layer.alert(
                            '回复发表失败！', 
                            {title:'错误提示',icon: 5}
                        );
                    }
                }, 
                "json"
            );
        });

        function del(id,obj,type){


            $.post(
                "del.php", 
                {
                    "id": id,
                    "type": type
                },
                function(data){
                    
                    if(data.status==1){
                        layer.open({
                            content: '删除成功！',
                            icon: 6,
                            yes: function(index, layero){
                                window.location.href='view_post.php';  
                            },
                            end: function(index){
                                window.location.href='view_post.php';    
                            }
                        });  
                        
                    }else{
                        layer.open({
                            content: '删除失败！',
                            icon: 5,
                            yes: function(index, layero){   
                            },
                            end: function(index){ 
                            }
                        });  
                    }
                }, 
                "json"
            );

        }
    </script>
        
   