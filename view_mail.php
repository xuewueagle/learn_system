<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$choice = 12;
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

<?php
@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
if ($mysqli->connect_errno) {
    echo "不能连接到数据库<br/>";
    return;
}
$mysqli->query("SET NAMES 'utf8'");

$query = "select * from db_javalearning.tb_private_message where to_uid=$user_id and to_role=$role_id";
$result = $mysqli->query($query);
if (!$result) {
    echo "SQL语句执行失败！";
    return;
}
$info = array();
while($row = $result->fetch_assoc()){
    $info[] = $row;
} 


$sql = "select * from db_javalearning.tb_private_message where from_uid=$user_id and from_role=$role_id";
$res = $mysqli->query($sql);
if (!$res) {
    echo "SQL语句执行失败！";
    return;
}
$self_send = array();
while($self_row = $res->fetch_assoc()){
    $self_send[] = $self_row;
} 


?>


<div style="width:600px;border:1px solid #8cb5c8;margin:0 auto;">
    <div style="width:580px;margin:0 auto;">
		<div style="width:580px;margin:0 auto;border:1px solid #dedede;margin-top:12px;"></div>
		<div style="width:580px;margin:0 auto;margin-top:12px;border-bottom:1px solid #ff5722;">
			<b>接收消息列表：</b>
		</div>
		<?php
			foreach ($info as $key => $value) {
		?>
		<div style="margin-top:5px;">
			<label for="">消息:</label>&nbsp;<label for="" style="color:#4caf50"><?php echo $value['title']; ?></label>
		</div>
		<div>
			<p style="text-indent:2em;">
				<?php echo $value['content']; ?>
			</p>
			<div>
				<label style="margin-left:2px;" for="">来自于：<?php echo $value['from_name']; ?></label><label for="" style="margin-left:20px;">接收时间：<?php echo date('Y年m月d日',$value['send_time']); ?></label><!-- <a style="margin-left:200px;" href="javascript:void(0);" status="1" onclick="start_replay(1,this)">删除</a> -->
			</div>
		</div>
		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:10px;"></div>
		<?php
			}
		?>

		<div style="width:580px;margin:0 auto;margin-top:12px;border-bottom:1px solid #ff5722;">
			<b>发送消息列表：</b>
		</div>
		<?php
			foreach ($self_send as $ke => $val) {
		?>
		<div style="margin-top:5px;">
			<label for="">消息:</label>&nbsp;<label for="" style="color:#4caf50"><?php echo $val['title']; ?></label>
		</div>
		<div>
			<p style="text-indent:2em;">
				<?php echo $val['content']; ?>
			</p>
			<div>
				<label style="margin-left:2px;" for="">发送者：当前用户</label><label for="" style="margin-left:20px;">发送时间：<?php echo date('Y年m月d日',$val['send_time']); ?></label><a style="margin-left:200px;" href="javascript:void(0);" onclick="start_del(<?php echo $val['id']; ?>,this,'private_message')">删除</a>
			</div>
		</div>
		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:10px;"></div>
		<?php
			}
		?>

	</div>
</div>

<script>
	
	function start_del(id,obj,type){
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
                            window.location.href='view_mail.php';  
                        },
                        end: function(index){
                            window.location.href='view_mail.php';    
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

