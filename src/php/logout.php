<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
echo $session_username;

?>
