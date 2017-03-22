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
<form method="POST" action="">
    <table class="table" cellspacing="0">
        <tr style="height:40px;">
            <td colspan="2" style="text-align: center;background-color: #8cb5c8"><span style="color: white;font-size: 18px;font-weight: bold;">论坛版块列表</span></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1"></td>
            <td class="haotd2"></td>
        </tr>
        <tr class="haotr">
            <td class="haotd1">版块名</td>
            <td class="haotd2">
            	<input type="text" name="sname" value="" style="width:120px"/>
            	<span style="color:red;font-size: 1px"></span>
            </td>
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
