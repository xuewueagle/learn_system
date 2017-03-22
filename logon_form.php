<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<!DOCTYPE html>
<?php
    // 定义变量并设置为空值
    $userErr = $passwordErr =$lbErr= "";
    $user = $password  = $lb =$name= $admin="";
    $flag = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        @ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
        if ($mysqli->connect_errno) {
            echo "不能连接到数据库<br/>";
            return;
        }
        $mysqli->query("SET NAMES 'utf8'");
        if(array_key_exists("lb", $_POST)) $lb= $_POST["lb"];
        if(array_key_exists("user", $_POST)) $user = trim($_POST["user"]);
        if (empty($lb)) {
             $lbErr = "这是必选的";
             $flag = false;
        }
        if($lb!=""){
            if($lb=="学生"){
                $query="SELECT sno FROM db_javalearning.tb_student where sno=$user;";
            }
            else if($lb=="教师"){
                $query="SELECT tno FROM db_javalearning.tb_teacher where tno=$user;";
            }
            $result = $mysqli->query($query);
            if (empty($user)) {
                 $userErr = "用户名是必填的";
                 $flag = false;
            }
            else{
                if($result->num_rows==0){$userErr="用户不存在";$flag=FALSE;}
            }
            if($lb=="学生"){
                $query ="select spassword,sname from tb_student where sno=$user;";
            }
            else if($lb=="教师"){
                $query ="select tpassword,tname,admin from tb_teacher where tno=$user;";
            }
            $result = $mysqli->query($query);
            if(array_key_exists("password", $_POST)) $password = trim($_POST["password"]);
            if (empty($password)) {
                $passwordErr = "密码是必填的";
                $flag = false;
            }
            else{
                if($lb=="教师"){
                    while($row = $result->fetch_array()) {
                        if($password!=$row['tpassword']){
                            $passwordErr = "密码是错误的";
                            $flag=FALSE;
                        }
                        $name=$row['tname'];
                        $admin=$row['admin'];
                    }
                }
                if($lb=="学生"){
                    while($row = $result->fetch_array()) {
                        if($password!=$row['spassword']){
                            $passwordErr = "密码是错误的";
                            $flag=FALSE;
                        }
                        $name=$row['sname'];
                    }
                }
            }
            $mysqli->close();
        }
        if($flag ) {
            $_SESSION["user"] = $user;
            $_SESSION["password"] = $password;
            $_SESSION["name"] = $name;
            $_SESSION["lb"] = $lb;
            $_SESSION['admin']=$admin;
            if($lb=="教师"){
            header("Location:guide_teacher.php");
            }
            else{
            header("Location:guide_student.php");
            }
            exit;        
        }        
    }
?>
<style>
    .table{
        width: 320px;margin: 10px auto 20px auto; border: solid 1px;border-color: #8cb5c8;            
    }
    .haotr{
        height: 35px;
    }
    .haotd1{
        width: 100px;font-size: 14px;text-align: center;
    }
    .haotd2{
        width: 220px;
    }
    input[type="text"]{
        border-color: #8cb5c8;border: inset 1px;border-radius: 3px;
    }
    input[type="password"]{
        border-color: #8cb5c8;border: inset 1px;border-radius: 3px;
    }
    input[type="submit"]{
        background: orange;color: white;width: 70px;height:25px;font-size: 14px;border-radius: 5px;
    }
     input[type="button"]{
        background: orange;color: white;width: 70px;height:25px;font-size: 14px;border-radius: 5px;
    }
</style>
<form method="POST" action="">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 22px;font-weight: bold;">请登录</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">用户名</td>
            <td class="haotd2"><input type="text" name="user" style="width:120px" value="<?php echo $user ?>"/><span style="color:red;font-size: 1px"><?php echo $userErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">密码</td>
            <td class="haotd2"><input type="password" name="password" style="width:120px" value="<?php echo $password ?>"/><span style="color:red;font-size: 1px"><?php echo $passwordErr;?></span></td>
        </tr>
        <tr class="haotr">
            <td colspan="2" class="haotd2" style="text-align: center">
                <input type="radio" name="lb" id="lb1" value="学生" <?php if($lb==="学生") echo 'checked="checked"'?>/><label for="lb1"><span style="font-size: 14px">学生</span></label>
                <input type="radio" name="lb" id="lb2" value="教师" <?php if($lb==="教师") echo 'checked="checked"'?>/><label for="lb2"><span style="font-size: 14px">教师</span></label><span style="color:red;font-size: 1px"><?php echo $lbErr;?></span>
            </td>
        </tr>
        <tr style="height:50px">
            <td colspan="2" style="text-align: center;font-weight: bold;">
                <input type="submit" name="log" value="确认"/>
                <input type="button" name="reg" value="注册" onclick="window.location.href='registration_form.php'"/>
            </td>
        </tr>
    </table>
</form>