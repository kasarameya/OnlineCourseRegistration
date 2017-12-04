<?php
include 'connection.php';
session_start();
if (isSet($_SESSION['username'])) {
    $session_username = $_SESSION['username'];
}
?>
<html lang="en">
<head>
    <title>Add Course</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
  <section>
<?php
include 'adminMenu.php';
?>
<h2>Add Course</h2>
<div class="form-group">
  <form action="adminAddCourseCode.php" method="post">
    
     <br>
         <?php
     $sql_cname  = "SELECT distinct course_name FROM cr_course";
     $result_cname = mysqli_query($conn, $sql_cname);
     if (mysqli_num_rows($result_cname) > 0) {
         $option_cname = '';
         while ($row = mysqli_fetch_assoc($result_cname)) {
             $option_cname .= '<option value = "' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
         }
     }
     ?>

       <select required name="course_name">
         <option value="" disabled selected>Select Course Name</option>
         <?php
     echo $option_cname;
     ?>
      </select>
<br>
  <?php
$sql    = "SELECT distinct degree FROM cr_course";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $option = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $option .= '<option value = "' . $row['degree'] . '">' . $row['degree'] . '</option>';
    }
}
?>

  <select required name="degree">
    <option value="" disabled selected>Select Degree</option>
    <?php
echo $option;
?>
 </select>

    <?php
$sql_branch    = "SELECT distinct branch FROM cr_course";
$result_branch = mysqli_query($conn, $sql_branch);
if (mysqli_num_rows($result_branch) > 0) {
    $option_branch = '';
    while ($row = mysqli_fetch_assoc($result_branch)) {
        $option_branch .= '<option value = "' . $row['branch'] . '">' . $row['branch'] . '</option>';
    }
}
?>
   <br/>
    <select required name="branch">
      <option value="" disabled selected>Select Branch</option>
      <?php
echo $option_branch;
?>
   </select>
    <br/>
    <select required name="semester">
      <option value="" disabled selected>Select Semester</option>
      <option value="Spring18">Spring-18</option>
    </select>

    <?php
$sql_instructors    = "SELECT distinct instructor_id FROM cr_instructors";
$result_instructors = mysqli_query($conn, $sql_instructors);
if (mysqli_num_rows($result_instructors) > 0) {
    $option_instructors = '';
    while ($row = mysqli_fetch_assoc($result_instructors)) {
        $option_instructors .= '<option value = "' . $row['instructor_id'] . '">' . $row['instructor_id'] . '</option>';
    }
}
?>
   <br/>
    <select required name="instructor_id">
      <option value="" disabled selected>Select Instructor</option>
      <?php
echo $option_instructors;
?>
</select>
<?php
$sql_rooms    = "SELECT distinct class_no FROM cr_course_enrollment";
$result_rooms = mysqli_query($conn, $sql_rooms);
if (mysqli_num_rows($result_rooms) > 0) {
$option_rooms = '';
while ($row = mysqli_fetch_assoc($result_rooms)) {
    $option_rooms .= '<option value = "' . $row['class_no'] . '">' . $row['class_no'] . '</option>';
}
}
?>
<br/>
<select required name="room_num">
  <option value="" disabled selected>Select Class room</option>
  <?php
echo $option_rooms;
?>
   </select>
    <br/>
    <label>Total Seats</label>
    <input class="form-control" required type="number" max="60" name="totalSeats" placeholder="Total Seats" id="totalSeats">
    <br/>
    <select required name="day1">
      <option value="" disabled selected>Select Day -1</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
    </select>
      <br/><br/>
      <select required name="day2">
        <option value="" disabled selected>Select Day -2</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
      </select>
        <br/><br/>
    <label>Start Time</label>
    <input class="form-control" required type="time"  name="startTiming" placeholder="Start Time" id="startTiming">
      <br/><br/>
    <label>End Time</label>
    <input class="form-control" required type="time"  name="endTiming" placeholder="End Time" id="endTiming">
    <br/>
    <div class="form-group">
      <input class="btn btn-primary" type="submit" id="validate" >
    </div>
</form>
</div>
</section>
</body>
</html>
