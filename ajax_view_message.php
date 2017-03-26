<?php
// 查看消息接口
$to_uid  = isset($_POST['to_uid']) ? $_POST['to_uid'] :0;
$to_role = isset($_POST['to_role']) ? $_POST['to_role'] :0;
$type    = isset($_POST['type']) ? $_POST['type'] :'';


@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
$mysqli->query("SET NAMES 'utf8'");

if($type=='view'){
	$sql = "select id FROM db_javalearning.tb_private_message where to_uid=$to_uid and to_role=$to_role and status=1";

	$result = $mysqli->query($sql);
	$info = array();
	while($row = $result->fetch_assoc()){
	    $info[] = $row;
	} 

	if($info){
		$data['status'] = 1;
	}else{
		$data['status'] = 0;
	}
}else if($type=='update'){
	$sql = "update db_javalearning.tb_private_message set status=2 where to_uid=$to_uid and to_role=$to_role";
	$res = $mysqli->query($sql);
	if($res){
		$data['status'] = 1;
	}else{
		$data['status'] = 0;
	}
}

echo json_encode($data);exit;


?>