<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<?php
@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
if ($mysqli->connect_errno) {
    echo "不能连接到数据库<br/>";
    return;
}
$mysqli->query("SET NAMES 'utf8'");
$tno = $_SESSION['user'];
$query = "SELECT * FROM db_javalearning.tb_teacher where tno=$tno;";
$result = $mysqli->query($query);
if (!$result) {
    echo "SQL语句执行失败！";
    return;
}
$row = $result->fetch_array();
?>
<?php
$choice = 7;
include 'head.php';
$name = $_SESSION['name'];
$admin = $_SESSION['admin'];
include 'navigation_teacher.php';
?>
<style>
    .table{
        width: 400px;margin: 30px auto 20px auto; border: solid 1px;border-color: #8cb5c8;            
    }
    .haotr{
        height: 30px;
    }
    .haotd1{
        width: 100px;font-size: 14px;padding-left:10px;height: 30px;
    }
    .haotd2{
        width: 300px;
    }
    input[type="text"]{
        border-color: #8cb5c8;border: inset 1px;border-radius: 3px;
    }
    input[type="submit"]{
        background: orange;color: white;width: 90px;height:30px;font-size: 14px;border-radius: 5px;
    }
</style>
<form method="POST" action="">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">个人信息</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">用户名<span style="color:red;font-size: 1px"></span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $row['tno']; ?>" style="width:120px" disabled/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">姓名<span style="color:red;font-size: 1px"></span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $row['tname']; ?>" style="width:120px" disabled/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">性别<span style="color:red;font-size: 1px"></span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $row['tsex']; ?>" style="width:120px" disabled/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">学院<span style="color:red;font-size: 1px"></span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $row['tdept']; ?>" style="width:120px" disabled/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">email<span style="color:red;font-size: 1px"></span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $row['temail']; ?>" style="width:120px" disabled/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
    </table>
</form>
<?php
include 'foot.php';
?>