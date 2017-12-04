<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$course_id        = $_GET['course_id'];
$semester         = $_GET['semester'];
$instructor_id    = $_GET['instructor_id'];

$sql_delete_course = "select remaining_seats, available_seats from cr_course_enrollment where course_id='$course_id'
and semester='$semester' and instructor_id='$instructor_id'";
$delete_result     = mysqli_query($conn, $sql_delete_course);
if (mysqli_num_rows($delete_result) > 0) {
    while ($row = mysqli_fetch_assoc($delete_result)) {
        $rSeats = $row["remaining_seats"];
        $aSeats = $row["available_seats"];
    }
    if ($rSeats == $aSeats) {
        $sql_soft_del       = "update cr_course_enrollment set deleted=1 where course_id='$course_id'
    and semester='$semester' and instructor_id='$instructor_id'";
        $soft_delete_result = mysqli_query($conn, $sql_soft_del);
        if ($soft_delete_result) {
          echo "<script>
          alert('Course deleted Successfully!');
            window.location.href='adminDeletedCourses.php';
            </script>";
        } else {
            echo "Error in updating deleted flag " . mysqli_error($conn);
        }

    } else {
        echo "<script>
        alert('Cannot delete the course as students have already enrolled for it');
          window.location.href='adminViewCourses.php';
          </script>";
    }
} else {
    echo "Error in delete fetch: " . mysqli_error($conn);
}


?>
