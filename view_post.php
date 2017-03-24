<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
$choice = 10;
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
/*@ $mysqli = new mysqli("127.0.0.1", "root", "123456", "db_javalearning", 3306);
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
}*/

?>

	
    <div style="width:600px;border:1px solid #8cb5c8;margin:0 auto;">
    	<div style="width:580px;margin:0 auto;">


    		<div style="width:580px;margin:0 auto;border:1px solid #dedede;margin-top:12px;"></div>
    		<div style="margin-top:5px;">
    			<label for="">发帖人:发帖人</label>&nbsp;<label for="">标题。。。。</label>
    		</div>
    		<div>
    			<p style="text-indent:2em;">
    				正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容
    			</p>
    			<div>
    				<label for="">发布时间：2015年10月8日</label><a style="margin-left:5px;" href="javascript:void(0);" status="1" onclick="start_replay(1,this)">回复</a><label style="margin-left:212px;" for="">回复数：23</label><a style="margin-left:30px;" href="#">删除</a>
    			</div>
    			
    		</div>
    		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:5px;"></div>
    		<div style="margin-top:5px;margin-left:20px;">
    			<label for="">回复人:回复人</label>&nbsp;<label for="">标题。。。。</label>
    		</div>
    		<div style="margin-left:20px;">
    			<label for="">回复时间：2015年10月8日</label>&nbsp;<a style="margin-left:322px;" href="#">删除</a>
    		</div>



    		<div style="width:580px;margin:0 auto;border:1px solid #dedede;margin-top:12px;"></div>
    		<div style="margin-top:5px;">
    			<label for="">发帖人:发帖人</label>&nbsp;<label for="">标题。。。。</label>
    		</div>
    		<div>
    			<p style="text-indent:2em;">
    				正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容正文内容
    			</p>
    			<div>
    				<label for="">发布时间：2015年10月8日</label><a style="margin-left:5px;" href="javascript:void(0);" status="1" onclick="start_replay(2,this)">回复</a><label style="margin-left:212px;" for="">回复数：23</label><a style="margin-left:30px;" href="#">删除</a>
    			</div>
    			
    		</div>
    		<div style="width:580px;margin:0 auto;border:1px dashed #dedede;margin-bottom:5px;"></div>
    		<div style="margin-top:5px;margin-left:20px;">
    			<label for="">回复人:回复人</label>&nbsp;<label for="">标题。。。。</label>
    		</div>
    		<div style="margin-left:20px;">
    			<label for="">回复时间：2015年10月8日</label>&nbsp;<a style="margin-left:322px;" href="#">删除</a>
    		</div>



			<div style="width:580px;margin:0 auto;border:1px solid #f44336;margin-top:10px;margin-bottom:5px;"></div>
    		<div style="width:580px;margin-top:5px;margin-bottom:25px;display:none;" id="launch_form">
    			<form id="frm" method="post">
    			<textarea name="reply" id="reply" cols="90" rows="4">
    				
    			</textarea>
    			<button type="button" id="launch">发表</button>
    			<input type="hidden" name="rely_to_post_id" id="rely_to_post_id" value="">
    			</form>
    		</div>

    	</div>
    </div>

    <script>
    	function start_replay(id,obj){
    		var status = $(obj).attr('status');
    		console.log(status);
    		$('#rely_to_post_id').val(id);
    		if(status==1){
    			$('#launch_form').css('display','block');
    			$(obj).attr('status',0)
    		}else if(status==0){
    			$('#launch_form').css('display','none');
    			$(obj).attr('status',1)
    		}
    		
    	}
    </script>
        
   