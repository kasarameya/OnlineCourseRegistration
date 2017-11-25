<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$course_id = $_GET['course_id'];
$instructor_id = $_GET['instructor_id'];
$semester = $_GET['semester'];


$deleteFromCartSql = "delete from cr_cart where cart_id= '$session_username' and course_id ='$course_id' and instructor_id ='$instructor_id' and semester ='$semester'";
$result   = mysqli_query($conn, $deleteFromCartSql);
if ($result) {
  header('location:myCart.php');
}else {
    echo "DB error:".mysqli_error($conn);
}
?>
