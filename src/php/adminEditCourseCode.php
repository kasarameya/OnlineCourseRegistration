<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$session_course_id = $_SESSION['course_id'];
$session_instructor_id = $_SESSION['instructor_id'];
$session_semester = $_SESSION['semester'];
$session_available_seats = $_SESSION['available_seats'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$room_num = $_POST['room_num'];
$totalSeats = $_POST['totalSeats'];
$day1 = $_POST['day1'];
$day2 = $_POST['day2'];
$startTime     = $_POST['startTiming'];
$endTime       = $_POST['endTiming'];
}

$day1              = mb_substr($day1, 0, 2);
$day2              = mb_substr($day2, 0, 2);
$days              = $day1 . "," . $day2;
$seatsDifference = $totalSeats - $session_available_seats;

$sql_get_previous = "select seats from cr_courses_for_semester where course_id='$session_course_id' and semester='$session_semester'";
$prev_seats_result = mysqli_query($conn,$sql_get_previous);
if (mysqli_num_rows($prev_seats_result) > 0) {
  while($row = mysqli_fetch_assoc($prev_seats_result)){
    $previousSeats= $row["seats"];
}
}else {
  echo "Unable to get seats".mysqli_error($conn);
}


$sql_update_course = "update  cr_course_enrollment set available_seats='$totalSeats', class_no='$room_num', class_start_time='$startTime',
class_end_time='$endTime',class_days='$days' where course_id='$session_course_id' and instructor_id = '$session_instructor_id' and semester='$session_semester'";

$update_result = mysqli_query($conn,$sql_update_course);
if ($update_result) {

  $updated_seats = $previousSeats + $seatsDifference;
  $sql_update_seats_for_semester = "update cr_courses_for_semester set seats = '$updated_seats' where course_id='$session_course_id' and semester='$session_semester'";
  $update_seats_result = mysqli_query($conn,$sql_update_seats_for_semester) ;
  if ($update_seats_result) {
    echo "<script>
        alert('Course Updated Successfully!');
          window.location.href='adminViewCourses.php';
          </script>";
  }else {
    echo "DB Error in updating new seats ".mysqli_error($conn);
  }
}else {
  echo "DB error".mysqli_error($conn);
}
?>
