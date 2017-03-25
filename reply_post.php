<?php
// 接口
	$post = $_POST;
	$post_id = isset($_POST['rely_to_post_id']) ? $_POST['rely_to_post_id'] : 0;
	$content = isset($_POST['content']) ? trim($_POST['content']) : '';
	$uid     = isset($_POST['uid']) ? $_POST['uid'] : 0;
	$uname   = isset($_POST['name']) ? trim($_POST['name']) : '';
	$time = time();

	@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
	$mysqli->query("SET NAMES 'utf8'");

	$querys = "insert into db_javalearning.tb_reply values (null,'$content',$post_id,$uid,'$uname',$time)";
	
	$res = $mysqli->query($querys);
	if($res){
		
		$que = "select reply_count from db_javalearning.tb_posts where id=$post_id";
		$rs  = $mysqli->query($que);
		$row = $rs->fetch_assoc();	
		$count = $row['reply_count']+1;
		$update = "update db_javalearning.tb_posts set reply_count=$count where id=$post_id";
		$mysqli->query($update);
		$data['status'] = 1;
        
	}else{
		$data['status'] = 0;
	}
	echo json_encode($data);exit;

?>