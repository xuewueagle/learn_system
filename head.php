<!DOCTYPE html>
    <style>
        .head1 {
           height: 130px;width: 1220px;margin:0 auto 0 auto;background-image:url(picture.jpg);background-repeat: no-repeat;
        }
        .head3 {
            padding-top:40px;float: left;
            font-size:50px;font-weight:bold;color:#6a5acd;
            margin-left:55%;text-shadow: 2px 2px 0 cornflowerblue ;
        }
        .head4 {
            float:right;margin-right:5px;width: 10%;
            color:teal;font-size:14px;font-weight:600;font-family:黑体;
            text-align: right;
        }
    </style>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/layer/layer.js"></script>
    <div class='head1'>
        
        <div class="head3"><span><i>JAVA学习系统</i></span></div>
        <div class='head4'>
            <p style="margin-top: 13px" id="dat">
                <?php 
                date_default_timezone_set('prc');
                echo date("Y年m月d日", time())
                ?>
            </p>
            <p style="margin-top: 23px" id="week">
            <?php switch (date("l",time()))
            {
                    case "Monday":echo '星期一';break;
                    case "Tuesday":echo '星期二';break;
                    case "Wednesday":echo '星期三';break;
                    case "Thursday":echo '星期四';break;
                    case "Friday":echo '星期五';break;
                    case "SaTurday":echo '星期六';break;
                    case "Sunday":echo '星期日';break;
            }
            ?>
            </p>
            <p style="margin-top: 23px" id="time">
            <?php
                 switch (date("A",time()))
                {
                case "AM":echo '上午';echo date("H:i:s",  time());break;
                case "PM":echo '下午';echo date("H:i:s",  time()-43200);break;
                }
            ?>
            </p>
        </div>
    </div>
    
        <script type="text/javascript">
            window.onload=function(){
             showTime();
            };
            function checkTime(i){
                if(i<10){
                    i='0'+i;
               }
                return i;
            }
            function showTime(){
                var myDate=new Date();
                var year=myDate.getFullYear();
                var month=myDate.getMonth()+1;
                var date=myDate.getDate();
                var d=myDate.getDay();
                var h=myDate.getHours();
                var m=myDate.getMinutes();
                var s=myDate.getSeconds();
                m=checkTime(m);
                s=checkTime(s);
                var weekday=new Array(7);
                weekday[0]='星期日';
                weekday[1]='星期一';
                weekday[2]='星期二';
                weekday[3]='星期三';
                weekday[4]='星期四';
                weekday[5]='星期五';
                weekday[6]='星期六';
                var ap=null;
                document.getElementById('dat').innerHTML=year+'年'+month+'月'+date+'日';
                document.getElementById('week').innerHTML=weekday[d];
                if(h < 12){ap="上午";} 
                else {h=h-12;ap="下午";} 
                document.getElementById('time').innerHTML=ap+h+':'+m+':'+s;
                setTimeout(showTime,500);
            }
        </script>