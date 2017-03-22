<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php
$choice = 9;
include 'head.php';
$name    = $_SESSION['name'];
$admin   = $_SESSION['admin'];
$user_id = $_SESSION['user'];
include 'navigation_teacher.php';
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
$query = "SELECT cno,classname FROM db_javalearning.tb_class where tno=$user_id;";
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
	if($_POST){
		$plate_name = isset($_POST['plate_name']) ? trim($_POST['plate_name']) : '';
		$class_id = isset($_POST['class']) ? trim($_POST['class']) : '';
		$class_name = isset($_POST['class_name']) ? trim($_POST['class_name']) : '';
		$time = time();
		$querys = "insert into tb_plate values(null,".$user_id.",'".$plate_name."',".$class_id.",'".$class_name."',".$time.",0)";
		
		$res = $mysqli->query($querys);
		if($res){
			header("Location: view_forum.php"); 
		}else{
			exit('添加失败！');
		}

	}
?>

<form method="POST" action="add_forum.php" id="frm">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">添加版块</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">版块名</td>
            <td class="haotd2">
            	<input type="text" name="plate_name" id="plate_name" value="" style="width:120px"/>
            	<span style="color:red;font-size: 1px">(*必填项)</span>
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">选择班级</td>
            <td class="haotd2">
            	<select name="class" id="classid">
            		<option value="0">--请选择--</option>
            		<?php 
            			foreach ($info as $key => $val) {
            		?>
					<option value="<?php echo $val['cno'] ?>">
						<?php echo $val['classname'] ?>
					</option>
            		<?php
            			}
            		?>
            	</select>
            	<input type="hidden" id="class_name" name="class_name" value="">
            	<span style="color:red;font-size: 1px">(*必选项)</span>
            </td>
        </tr>
        
        
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="button" name="add" id="add" value="添加"/>
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
			var plate_name = $('#plate_name').val();
			var classid    = $('#classid').val();
			if(!plate_name){
				layer.alert(
					'版块名不能为空！', 
					{title:'错误提示',icon: 5}
				);
			}else if(!classid || classid==0){
				layer.alert(
					'班级不能为空！', 
					{title:'错误提示',icon: 5}
				);
			}else{
				$('#class_name').val($('#classid').find("option:selected").text());
				
				$('#frm').submit();
			}
		});


	});
	

</script>