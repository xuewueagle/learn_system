<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<?php
include 'head.php';
$name = $_SESSION['name'];
$choice = 1;
include 'navigation_student.php';
$sno = $_SESSION['user'];
?>
<?php
include 'join_class.php';
?>
