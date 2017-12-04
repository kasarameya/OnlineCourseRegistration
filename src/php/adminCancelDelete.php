<?php
include 'connection.php';
session_start();
$course_id = $_GET['course_id'];
$instructor_id = $_GET['instructor_id'];
$semester = $_GET['semester'];

$sql_cancel_delete = "update cr_course_enrollment set deleted = 0 where course_id='$course_id' and instructor_id ='$instructor_id' and semester = '$semester' ";
$cancel_del_result = mysqli_query($conn,$sql_cancel_delete);
if ($cancel_del_result) {
  echo "<script>
      alert('Course enabled Successfully!');
        window.location.href='adminDeletedCourses.php';
        </script>";
}else {
  echo "DB error".mysqli_error($conn);
}
?>
