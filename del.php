<?php
// 删除接口

$id   = isset($_POST['id']) ? $_POST['id'] :0;
$type = isset($_POST['type']) ? $_POST['type'] :'';

@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
$mysqli->query("SET NAMES 'utf8'");

if($type=='post'){
	$sql = "delete FROM db_javalearning.tb_posts where id=$id";
	$del_reply = "delete FROM db_javalearning.tb_reply where post_id=$id";
	$mysqli->query($del_reply);
}else if($type=='reply'){
	$sql = "delete FROM db_javalearning.tb_reply where id=$id";
}else if($type=='private_message'){
	$sql = "delete FROM db_javalearning.tb_private_message where id=$id";
}

$result = $mysqli->query($sql);
if($result){
	$data['status'] = 1;
}else{
	$data['status'] = 0;
}

echo json_encode($data);exit;


?>