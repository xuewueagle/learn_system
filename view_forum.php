<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$choice = 8;
include 'head.php';
$name = $_SESSION['name'];
$admin = $_SESSION['admin'];
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
$query = "SELECT * FROM db_javalearning.tb_plate where uid=$user_id";
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

    <table class="table" cellspacing="0" style="width:600px;">
        <tr style="height:40px;">
            <td colspan="6" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">论坛版块列表</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd3">版块ID</td>
            <td class="haotd3">版块名</td>
            <td class="haotd3">所属班级</td>
            <td class="haotd3">帖子数</td>
            <td class="haotd3">操作时间</td>
            <td class="haotd3">操作</td>
        </tr>
        <?php
            foreach ($info as $key => $value) {
                $time = date('Y-m-d H:i:s',$value['time']);
        ?>
        <tr class="haotr">
            <td class="haotd4"><?php echo $value['id']; ?></td>
            <td class="haotd4"><?php echo $value['plate_name']; ?></td>
            <td class="haotd4"><?php echo $value['class_name']; ?></td>
            <td class="haotd4"><?php echo $value['posts_count']; ?></td>
            <td class="haotd4"><?php echo $time; ?></td>
            <td class="haotd4"><a href="add_forum.php?id=<?php echo $value['id']; ?>">修改</a>|<a href="view_forum.php?del_id=<?php echo $value['id']; ?>" >删除</a></td>
        </tr>
        <?php
            }
        ?>
    </table>

<?php 
    
    $del_id = isset($_GET['del_id']) ? $_GET['del_id'] :0;
    if($del_id){
        $query  = "delete  FROM db_javalearning.tb_plate where id=$del_id";
        $result = $mysqli->query($query);
        
        if($result){
            echo "<script>
            layer.open({
                content: '删除成功！',
                yes: function(index, layero){
                    window.location.href='view_forum.php';  
                },
                end: function(index){
                    window.location.href='view_forum.php';    
                }
            });  
            </script>";
        }else{
            echo "<script>
            layer.open({
                content: '删除失败！',
                yes: function(index, layero){
                    window.location.href='view_forum.php';  
                },
                end: function(index){
                    window.location.href='view_forum.php';    
                }
            });  
            </script>";
        }
    }
        
?>

<?php
include 'foot.php';
?>

