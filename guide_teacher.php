<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<!DOCTYPE html>
<?php
    include 'head.php';
    $name=$_SESSION['name'];
    $admin=$_SESSION['admin'];
    $choice=1;
    include 'navigation_teacher.php';
    $tno=$_SESSION['user'];?>
<div style="margin-left: 100px;margin-bottom: 50px;">
<?php
    include 'create_class.php';
    ?>
</div>
<?php
    include 'foot.php';
?>