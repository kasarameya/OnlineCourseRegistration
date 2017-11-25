<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
session_destroy();
header("location:login.html");
exit();
?>
