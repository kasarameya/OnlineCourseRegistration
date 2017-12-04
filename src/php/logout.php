<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$session_admin_username = $_SESSION['admin_username'];
if($session_username){
  session_destroy();
  header("location:login.html");
  exit();
}
else{
  session_destroy();
  header("location:adminLogin.html");
  exit();
}

?>
