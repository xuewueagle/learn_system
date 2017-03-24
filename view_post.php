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