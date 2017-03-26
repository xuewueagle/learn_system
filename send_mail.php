<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$choice = 13;
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
// [user] => 07001 [password] => zhanghua [name] => 张华 [lb] => 教师 [admin] => 0


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

if($role=='学生'){ // 学生
    $query = "SELECT s.tno as to_no,s.tname as to_name FROM db_javalearning.tb_teacher as s left join db_javalearning.tb_class as c on s.tno=c.tno left join db_javalearning.tb_student as t on t.cno=c.cno where t.sno=$user_id";
}else if($role=='教师'){ // 老师
    $query = "SELECT s.sno as to_no,s.sname as to_name FROM db_javalearning.tb_student as s left join db_javalearning.tb_class as c on s.cno=c.cno left join db_javalearning.tb_teacher as t on t.tno=c.tno where t.tno=$user_id";
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

<?php 
    // 新增或修改提交
	if($_POST){
        
		$title      = isset($_POST['title']) ? trim($_POST['title']) : '';
        $from_uid   = $user_id;
		$to_uid   = isset($_POST['plate_id']) ? trim($_POST['plate_id']) : '';
        if($role_id==2){
            $from_role = 2;
            $to_role   = 1;
        }else if($role_id==1){
            $from_role = 1;
            $to_role   = 2;
        }
		
		$content    = isset($_POST['content']) ? trim($_POST['content']) : '';
		$send_time = time();
        $from_name = $name;

        
        // 添加
        $querys = "insert into tb_private_message values(null,'$title','$content',$from_uid,$from_role,'$from_name',$to_uid,$to_role,$send_time)";
        
		$res = $mysqli->query($querys);
		if($res){
			
            echo "<script>window.location.href='view_mail.php';</script>";
		}else{
			exit('操作失败！');
		}

	}
?>

<form method="POST" action="send_mail.php" id="frm">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8">
               
                <span style="color: white;font-size: 18px;font-weight: bold;">发送消息</span>
                
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">标题</td>
            <td class="haotd2">
            	<input type="text" name="title" id="title" value="" style="width:120px;margin-left:8px;"/>
            	<span style="color:red;font-size: 1px">(*必填项)</span>
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">To</td>
            <td class="haotd2">
            	<select name="plate_id" id="plate_id" style="margin-left:8px;">
            		<option value="0">--请选择--</option>
            		<?php
            			foreach ($info as $key => $value) {
            		?>
            		<option value="<?php echo $value['to_no'];?>"><?php echo $value['to_name'];?></option>
            		<?php 
            			}
            		?>
            	</select>
            	<input type="hidden" id="plate_name" name="plate_name" value="">
            	<span style="color:red;font-size: 1px">(*必选项)</span>
            </td>
        </tr>
        <tr class="haotr">
        	<td class="haotd1">内容</td>
            <td class="haotd2" style="text-align:center;">
				<textarea name="content" id="content" style="margin-top:5px;width:280px;height:80px;">
					
				</textarea>
            </td>
        </tr>
        
        
        
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="button" name="add" id="add" value="提交"/>
            </td>
        </tr>
    </table>
</form>
<?php
include 'foot.php';
?>

<script>

	$(function(){
  
		$("#add").click(function(){
			var title = $('#title').val();
			var plate_id    = $('#plate_id').val();
			if(!title){
				layer.alert(
					'消息标题不能为空！', 
					{title:'错误提示',icon: 5}
				);
			}else if(!plate_id || plate_id==0){
				layer.alert(
					'收信人不能为空！', 
					{title:'错误提示',icon: 5}
				);
			}else{
				$('#plate_name').val($('#plate_id').find("option:selected").text());
				
				$('#frm').submit();
			}
		});


	});
	

</script>