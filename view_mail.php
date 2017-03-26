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


<div style="width:600px;border:1px solid #8cb5c8;margin:0 auto;">
    <div style="width:580px;margin:0 auto;">
		<div style="width:580px;margin:0 auto;border:1px solid #dedede;margin-top:12px;"></div>
		

		<div style="margin-top:5px;">
			<label for="">消息:<b></b></label>&nbsp;<label for="" style="color:#4caf50"></label>
		</div>
		<div>
			<p style="text-indent:2em;">
				防守对方的手
			</p>
			<div>
				<label style="margin-left:2px;" for="">来自于：ying</label><label for="" style="margin-left:20px;">发送时间：2015年09月08日</label><a style="margin-left:230px;" href="javascript:void(0);" status="1" onclick="start_replay(1,this)">删除</a>
			</div>
		</div>
		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:10px;"></div>


	</div>
</div>