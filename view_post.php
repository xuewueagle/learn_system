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
}else{
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
    $query = "SELECT o.id,o.title,o.content,o.post_time,o.from_uname,o.role_id,o.reply_count,o.plate_name from db_javalearning.tb_posts as o left join db_javalearning.tb_plate as p on p.id=o.plate_id left join db_javalearning.tb_student as c on c.cno=p.class_id where c.sno=$user_id";
}else if($role=='教师'){// 老师
    $query = "SELECT o.id,o.title,o.content,o.post_time,o.from_uname,o.role_id,o.reply_count,o.plate_name from db_javalearning.tb_posts as o left join db_javalearning.tb_plate as p on p.id=o.plate_id left join db_javalearning.tb_class as c on c.cno=p.class_id where c.tno=$user_id";
    
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
                    <label style="margin-left:440px;" for="">回复数：<?php echo $value['reply_count']; ?></label><a style="margin-left:30px;" href="#">删除</a>
                </div>
    			
    		</div>
    		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:5px;"></div>
    		<div style="margin-top:5px;margin-left:20px;">
    			<label for="">回复人:回复人</label>&nbsp;<label for="">标题。。。。</label>
    		</div>
    		<div style="margin-left:20px;">
    			<label for="">回复时间：2015年10月8日</label>&nbsp;<a style="margin-left:322px;" href="#">删除</a>
    		</div>
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
    		console.log(status);
    		$('#rely_to_post_id').val(id);
    		if(status==1){
    			$('#launch_form').css('display','block');
    			$(obj).attr('status',0)
    		}else if(status==0){
    			$('#launch_form').css('display','none');
    			$(obj).attr('status',1)
    		}
            $('#rely_to_post_id').val(id);
    		
    	}

        $('#launch').click(function(){
            $.post(
                "test.php", 
                { "func": "getNameAndTime" },
                function(data){
                    alert(data.name); // John
                    console.log(data.time); //  2pm
                }, 
                "json"
            );
        });
    </script>
        
   