<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_name        = test_data($_POST["course_name"]);
    $degree        = test_data($_POST["degree"]);
    $branch        = test_data($_POST["branch"]);
    $sem           = test_data($_POST["semester"]);
    $instructor_id = test_data($_POST["instructor_id"]);
    $totalSeats    = test_data($_POST["totalSeats"]);
    $day1          = test_data($_POST["day1"]);
    $day2          = test_data($_POST["day2"]);
    $startTime     = test_data($_POST["startTiming"]);
    $endTime       = test_data($_POST["endTiming"]);
    $roomNum       = test_data($_POST["room_num"]);
}

$sql_fetch_cId = "select course_id from cr_course where course_name='$c_name'";
$cId_result    = mysqli_query($conn, $sql_fetch_cId);
if (mysqli_num_rows($cId_result) > 0) {
    while ($row = mysqli_fetch_assoc($cId_result)) {
        $c_id = $row["course_id"];
    }
} else {
    echo "Error in getting course Id" . mysqli_error($conn);
}
$day1              = mb_substr($day1, 0, 2);
$day2              = mb_substr($day2, 0, 2);
$days              = $day1 . "," . $day2;

$sql_insert_course = "insert into cr_course_enrollment values ('$c_id',
'$instructor_id','$totalSeats','$totalSeats','$roomNum','$startTime','$endTime','$days','$sem',1,0)";

$insert_result     = mysqli_query($conn, $sql_insert_course);

if ($insert_result) {
  $sql_insert_new_course    = "insert ignore into cr_course values ('$c_id','$c_name','$degree','$branch')";
  $insert_new_course_result = mysqli_query($conn, $sql_insert_new_course);
    $sql_check_existing_course = "select seats from cr_courses_for_semester where course_id='$c_id' and semester = '$sem'";
    $check_result              = mysqli_query($conn, $sql_check_existing_course);
    if (mysqli_num_rows($check_result) > 0) {
        while ($row = mysqli_fetch_assoc($check_result)) {
            $existingSeats = $row["seats"];
        }
        $newSeats         = $existingSeats + $totalSeats;
        $sql_update_seats = "update cr_courses_for_semester set seats='$newSeats' where course_id='$c_id' and semester = '$sem'";
        $updateSeats      = mysqli_query($conn, $sql_update_seats);
        if ($updateSeats) {
            echo "Seats Updated";
            header("location:adminViewCourses.php");
              exit();
        } else {
            echo "seats problem: " . mysqli_error($conn);
        }
    } else {
        $insertNewCourse   = "insert into cr_courses_for_semester values('$c_id','$sem','$totalSeats')";
        $insert_new_result = mysqli_query($conn, $insertNewCourse);
        if ($insert_new_result) {
            echo "New Course inserted";
            header("location:adminViewCourses.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "<script>
        alert('Cannot add class as Professor is Already teaching this Course in this Semester!');
          window.location.href='adminAddCourse.php';
          </script>";
}

function test_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
