<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<!DOCTYPE html>
<?php
    // 定义变量并设置为空值
    $snoErr = $nameErr = $passwordErr = $password1Err = $birthdayErr = $emailErr ="";
    $sno = $name = $password = $password1 = $gender = $birthday = $email = $sdept ="";
    $flag = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(array_key_exists("sno", $_POST)) $sno = trim($_POST["sno"]);
        @ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
        if ($mysqli->connect_errno) {
                echo "不能连接到数据库<br/>";
                return;
        }
        $mysqli->query("SET NAMES 'utf8'");
        $query="SELECT sno FROM db_javalearning.tb_student;";
        $result = $mysqli->query($query);
        if(!$result) {
            echo "SQL语句执行失败！";
            return;
        }
        if (empty($sno)) {
             $snoErr = "用户名是必填的";
             $flag = false;
        } 
        else{
            while($row = $result->fetch_array()) {
                if($sno==$row['sno']){
                    $snoErr='用户名已存在';
                    $flag = false;
                }
            }
        }
        if(array_key_exists("password", $_POST)) $password = trim($_POST["password"]);
        if (empty($password)) {
            $passwordErr = "密码是必填的";
            $flag = false;
        } 
        if(array_key_exists("password1", $_POST)) $password1 = trim($_POST["password1"]);
        if (empty($password1)) {
            $password1Err = "确认密码是必填的";
            $flag = false;			
        } else {
            if($password1!==$password) {
                $password1Err = "确认密码是错误的";
                $flag = false;				
            }			
        }
        if(array_key_exists("name", $_POST)) $name = trim($_POST["name"]);
        if (empty($name)) {
            $nameErr = "姓名是必填的";
            $flag = false;
        }		
        if(array_key_exists("gender", $_POST)) $gender= $_POST["gender"];	
        if(array_key_exists("sdept", $_POST)) $sdept= $_POST["sdept"];
        if(array_key_exists("birthday", $_POST)) $birthday = trim($_POST["birthday"]);
        if (!empty($birthday)) {
            if(!preg_match('/^\d{4}[-](0?[1-9]|1[012])[-](0?[1-9]|[12][0-9]|3[01])$/', $birthday)) {
                $birthdayErr = "日期格式错误";
                $flag = false;
            }
        }
        if(array_key_exists("email", $_POST)) $email = trim($_POST["email"]);	
        if (empty($email)) {
            $emailErr = "email地址不能为空";
            $flag = false;
        } else {	        
            if(!preg_match('/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+(\.[a-zA-Z0-9\-]+)+$/', $email)) {
                $emailErr = "email地址格式错误";
                $flag = false;
            }
        }
        if($flag ) {
            $_SESSION["sno"] = $sno;
            $_SESSION["password"] = $password;
            $_SESSION["name"] = $name;        
            $_SESSION["sex"] = $gender;	
            $_SESSION["birthday"] = $birthday;
            $_SESSION["email"] = $email;
            $_SESSION["sdept"] = $sdept;	
            $query = "INSERT INTO db_javalearning.tb_student(sno, spassword, sname,ssex, sbirth, semail,sdept) VALUES ('$sno', '$password', '$name', '$gender', '$birthday', '$email','$sdept');";
            $result = $mysqli->query($query);
            if(!$result) {
                echo "SQL语句执行失败！";
                return;
            }
            $mysqli->close();
            header("Location:index.php");
            exit;        
        }        
    }
?>
<?php
include 'head.php';
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
    input[type="password"]{
        border-color: #8cb5c8;border: inset 1px;border-radius: 3px;
    }
    input[type="submit"]{
        background: orange;color: white;width: 90px;height:30px;font-size: 14px;border-radius: 5px;
    }
</style>
<form method="POST" action="">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">请注册</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">用户名<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="sno" value="<?php echo $sno ?>" style="width:120px"/><span style="color:red;font-size: 1px"><?php echo $snoErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">密码<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="password" name="password" style="width:120px" value="<?php echo $password ?>"/><span style="color:red;font-size: 1px"><?php echo $passwordErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">确认密码<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="password" name="password1" style="width:120px" value="<?php echo $password1 ?>"/><span style="color:red;font-size: 1px"><?php echo $password1Err;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">姓名<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="name" style="width:70px" value="<?php echo $name ?>"/><span style="color:red;font-size: 1px"><?php echo $nameErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">性别</td>
            <td class="haotd2">
                <input type="radio" name="gender" id="gender1" value="男" <?php if($gender==="男") echo 'checked="checked"' ?>/><label for="gender1"><span style="font-size: 12px">男</span></label>
                <input type="radio" name="gender" id="gender2" value="女" <?php if($gender==="女") echo 'checked="checked"' ?>/><label for="gender2"><span style="font-size: 12px">女</span></label>
            </td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">学院</td>
            <td class="haotd2"><input type="text" name="sdept" style="width:120px" value="<?php echo $sdept ?>"/></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">出生日期</td>
            <td class="haotd2"><input type="text" name="birthday" style="width:120px" value="<?php echo $birthday ?>"/><span style="color:red;font-size: 1px"><?php echo $birthdayErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">Email地址<span style="color:red;font-size: 1px">*</span></td>
            <td class="haotd2"><input type="text" name="email" style="width:180px" value="<?php echo $email ?>"/><span style="color:red;font-size: 1px"><?php echo $emailErr ?></span></td>
        </tr>
        <tr style="height:80px">
            <td colspan="2" style="text-align: center">
                <input type="submit" name="reg" value="立即注册"/>
            </td>
        </tr>
    </table>
</form>
<?php
include 'foot.php';
?>