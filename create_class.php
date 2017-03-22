<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<?php
// 定义变量并设置为空值
$cnoErr = $classnameErr = $cdateErr = $coursenameErr = "";
$cno = $classname = $cdate = $coursename = "";
$flag = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (array_key_exists("cno", $_POST))
        $cno = trim($_POST["cno"]);
    @ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
    if ($mysqli->connect_errno) {
        echo "不能连接到数据库<br/>";
        return;
    }
    $mysqli->query("SET NAMES 'utf8'");
    $query = "SELECT cno FROM db_javalearning.tb_class;";
    $result = $mysqli->query($query);
    if (!$result) {
        echo "SQL语句执行失败！";
        return;
    }
    if (empty($cno)) {
        $cnoErr = "班级代码是必填的";
        $flag = false;
    } else {
        while ($row = $result->fetch_array()) {
            if ($cno == $row['cno']) {
                $cnoErr = '班级代码已存在';
                $flag = false;
            }
        }
    }
    if (array_key_exists("classname", $_POST))
        $classname = trim($_POST["classname"]);
    if (empty($classname)) {
        $classnameErr = "班级名称是必填的";
        $flag = false;
    } else {
        while ($row = $result->fetch_array()) {
            if ($classname == $row['classname']) {
                $classnameErrErr = '班级名称已存在';
                $flag = false;
            }
        }
    }

    if (array_key_exists("coursename", $_POST))
        $coursename = trim($_POST["coursename"]);
    if (empty($coursename)) {
        $coursenameErr = "课程名称是必填的";
        $flag = false;
    }
    if (array_key_exists("cdate", $_POST))
        $cdate = trim($_POST["cdate"]);
    if (!empty($cdate)) {
        if (!preg_match('/^\d{4}[-](0?[1-9]|1[012])[-](0?[1-9]|[12][0-9]|3[01])$/', $cdate)) {
            $cdateErr = "日期格式错误";
            $flag = false;
        }
    }
    if ($flag) {
        $_SESSION["cno"] = $cno;
        $_SESSION["classname"] = $classname;
        $_SESSION["cdate"] = $cdate;
        $_SESSION["tno"] = $tno;
        $_SESSION["coursename"] = $coursename;
        $query = "INSERT INTO db_javalearning.tb_class(cno,classname,cdate,coursename,tno) VALUES ('$cno', '$classname', '$cdate', '$coursename','$tno');";
        $result = $mysqli->query($query);
        if (!$result) {
            echo "SQL语句执行失败！";
            return;
        }
        $mysqli->close();
        echo "<script>alert('创建成功" . $classname . "！');</script>";
        $url = "http://localhost/learn_system/guide_teacher.php";
        echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
        exit;
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
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">创建班级</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">班级代码<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="cno" value="<?php echo $cno ?>" style="width:120px"/><span style="color:red;font-size: 1px"><?php echo $cnoErr; ?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">班级名称<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="classname" style="width:120px" value="<?php echo $classname ?>"/><span style="color:red;font-size: 1px"><?php echo $classnameErr; ?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">教师号<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="tno" value="<?php echo $tno ?>" style="width:120px" disabled></td>
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">创建日期</td>
            <td class="haotd2"><input type="text" name="cdate" style="width:100px" value="<?php echo $cdate ?>"/><span style="color:red;font-size: 1px"><?php echo $cdateErr; ?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">课程名称<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="coursename" style="width:70px" value="<?php echo $coursename ?>"/><span style="color:red;font-size: 1px"><?php echo $coursenameErr; ?></span></td>
        </tr>
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="reg" value="立即创建"/>
            </td>
        </tr>
    </table>
</form>