<?php
include 'connection.php';
session_start();
if(isSet($_SESSION['username'])){
  $netId = $_SESSION['username'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone= $_POST["phone"];
  $name=$_POST["name"];
  $new_pwd=$_POST["new_password"];
  $cn_pwd=$_POST["confirm_new_password"];
  if($new_pwd ==$cn_pwd){
    $pwd= password_hash($new_pwd, PASSWORD_DEFAULT);
  }
  else{
      //they do not match
  }

  $query= " update cr_student set phone='$phone',name='$name',password='$pwd' where user_id= '$netId' ";
  if($query){
    mysqli_query($conn, $query);
   header('Location:profile.php');
    exit();
  }
}
?>
