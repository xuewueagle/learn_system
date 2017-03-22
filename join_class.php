<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['class']) {
        $cno = $_POST['class'];
        @ $mysqli = new mysqli("localhost", "root", "123456", "db_javalearning", 3306);

        if ($mysqli->connect_errno) {
            echo "不能连接到数据库<br/>";
            return;
        }
        $mysqli->query("SET NAMES 'utf8'");
        $query = "UPDATE tb_student SET remark=0,cno='$cno' WHERE sno='$sno'";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "SQL语句执行失败！";
            return;
        }
        $query = "SELECT classname FROM db_javalearning.tb_class where cno=$cno";
        $result = $mysqli->query($query);
        $row = $result->fetch_array();
        $classname = $row['classname'];
        $mysqli->close();
        echo "<script>alert('成功加入" . $classname . "!');</script>";
        $url = "http://localhost/learn_system/guide_student.php";
        echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
        exit;
    } else {
        return;
    }
}
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
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">加入班级</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">班级名称<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2">
                <select name="class">
                    <?php
                    @ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
                    if ($mysqli->connect_errno) {
                        echo "不能连接到数据库<br/>";
                        return;
                    }
                    $mysqli->query("SET NAMES 'utf8'");
                    $query = "SELECT cno,classname FROM db_javalearning.tb_class;";
                    $result = $mysqli->query($query);
                    if (!$result) {
                        echo "无班级！";
                        return;
                    }
                    while ($row = $result->fetch_array()) {
                        ?>
                        <option value="<?php echo $row['cno']; ?>"><?php echo $row['classname']; ?></option>
                        <?php
                    }
                    ?>
                    <option value="asd" selected>无</option>
                </select>
            </td>
        </tr>
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="reg" value="立即加入"/>
            </td>
        </tr>
    </table>
</form>
<?php
include 'foot.php';
?>
<?php
$mysqli->close();
exit;
?>
