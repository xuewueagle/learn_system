<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php
$sname = $gender = $sdept = $semail = $sno = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reg'])) {
        $sname = $_POST['sname'];
        $gender = $_POST['gender'];
        $sdept = $_POST['sdept'];
        $semail = $_POST['semail'];
        @ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
        if ($mysqli->connect_errno) {
            echo "不能连接到数据库<br/>";
            return;
        }
        $mysqli->query("SET NAMES 'utf8'");
        $sno = $_SESSION['user'];
        $query = "SELECT tname,tsex,tdept,temail FROM tb_teacher WHERE tno=$sno";
        $result = $mysqli->query($query);
        while ($row = $result->fetch_array()) {
            if (!$sname)
                $sname = $row['tname'];
            if (!$gender)
                $gender = $row['tsex'];
            if (!$sdept)
                $sdept = $row['tdept'];
            if (!$semail)
                $semail = $row['temail'];
        }

        $query = "UPDATE tb_teacher SET tname='$sname',tsex='$gender',tdept='$sdept',temail='$semail' WHERE tno='$sno'";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "SQL语句执行失败！";
            return;
        }
        $mysqli->close();
        echo "<script>alert('修改成功！');</script>";
        $url = "http://localhost/learn_system/guide_teacher.php";
        echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
        exit;
    }
}
?>
<?php
$choice = 4;
include 'head.php';
$name = $_SESSION['name'];
$admin = $_SESSION['admin'];
include 'navigation_teacher.php';
?>
<style>
    .table{
        border:solid 1px;width: 400px;margin: 30px auto 20px auto;border-color: #8cb5c8;
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
        border-color: #8cb5c8;border: inset 1.5px;margin-top: 0px;
    }
    input[type="submit"]{
        background: orange;color: white;width: 70px;height:25px;font-size: 14px;
    }
</style>
<form method="POST" action="">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">修改个人信息</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">姓名</td>
            <td class="haotd2"><input type="text" name="sname" value="<?php echo $sname ?>" style="width:120px"/><span style="color:red;font-size: 1px"></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">性别</td>
            <td class="haotd2">
                <input type="radio" name="gender" id="gender1" value="男" <?php if ($gender === "男") echo 'checked="checked"' ?>/><label for="gender1"><span style="font-size: 12px">男</span></label>
                <input type="radio" name="gender" id="gender2" value="女" <?php if ($gender === "女") echo 'checked="checked"' ?>/><label for="gender2"><span style="font-size: 12px">女</span></label>
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">学院</td>
            <td class="haotd2"><input type="text" name="sdept" value="<?php echo $sdept ?>" style="width:120px"/><span style="color:red;font-size: 1px"></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">Email地址</td>
            <td class="haotd2"><input type="text" name="semail" style="width:180px" value="<?php echo $semail ?>"/><span style="color:red;font-size: 1px"></span></td>
        </tr>
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="reg" value="确定修改"/>
            </td>
        </tr>
    </table>
</form>
<?php
include 'foot.php';
?>

