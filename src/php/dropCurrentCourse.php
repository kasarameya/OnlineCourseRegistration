<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$course_id = $_GET['course_id'];
$instructor_id = $_GET['instructor_id'];
$semester = $_GET['semester'];


$dropCourseSql = "delete from cr_course_student_instructor where student_id= '$session_username' and course_id ='$course_id' and instructor_id ='$instructor_id' and semester ='$semester'";
$result   = mysqli_query($conn, $dropCourseSql);
if ($result) {
  header('location:dropCourses.php');
}else {
    echo "DB error:".mysqli_error($conn);
}
?>
