<?php
include 'connection.php';
session_start();
if (isSet($_SESSION['username'])) {
    $session_username = $_SESSION['username'];
}

$course_id        = $_GET['course_id'];
$semester         = $_GET['semester'];
$instructor_id    = $_GET['instructor_id'];
$_SESSION["course_id"] = $course_id;
$_SESSION["semester"] = $semester;
$_SESSION["instructor_id"] = $instructor_id;

$sql_fetch_course = "select course_id,instructor_id,remaining_seats, available_seats,class_no,class_start_time,
class_end_time,class_days,semester from cr_course_enrollment where course_id='$course_id'
and semester='$semester' and instructor_id='$instructor_id'";
$fetch_cr_result     = mysqli_query($conn, $sql_fetch_course);
if (mysqli_num_rows($fetch_cr_result) > 0) {
    while ($row = mysqli_fetch_assoc($fetch_cr_result)) {
      $course_id = $row["course_id"];
      $instructor_id = $row["instructor_id"];
      $remaining_seats = $row["remaining_seats"];
      $available_seats = $row["available_seats"];
      $_SESSION["available_seats"] = $available_seats;
      $class_no = $row["class_no"];
      $class_start_time = $row["class_start_time"];
      $class_end_time = $row["class_end_time"];
      $class_days = $row["class_days"];
      $semester = $row["semester"];
    }
  }else {
    echo "DB error".mysqli_error($conn);
  }
?>
<html lang="en">
<head>
    <title>Edit Course</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></head>
<body>
  <?php include 'adminMenu.php'; ?>
  <div id="editAdmin_container" class="container">
    <h2>Edit Course</h2>


      <form action="adminEditCourseCode.php" method="post">
        <?php
          $sql_cname  = "SELECT distinct course_name FROM cr_course where course_id=$course_id";
          $result_cname = mysqli_query($conn, $sql_cname);
          if (mysqli_num_rows($result_cname) > 0) {
            while ($row = mysqli_fetch_assoc($result_cname)) {
             $option_cname .= '<option value = "' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
           }
         }
         ?>
         <div class="row">
           <div class="col-lg-4">
             <label> Course </label>
           </div>
             <div class="col-lg-6">
           <div class="form-group">
             <select class="form-control custom-select" name="course_name" disabled>
               <?php echo $option_cname; ?>
             </select>
           </div>
         </div>
         </div>

         <div class="row">
           <div class="col-lg-4">
             <label> Semester </label>
           </div>
          <div class="col-lg-6">
            <div class="form-group">
              <select class="form-control custom-select"  disabled name="semester">
                <option value="Spring18">Spring-18</option>
              </select>
           </div>
         </div>
       </div>

        <div class="row">
          <div class="col-lg-4">
            <label> Instructor Id</label>
          </div>
            <div class="col-lg-6">
           <div class="form-group">
             <select class="form-control custom-select" disabled name="instructor_id">
                  <?php
                  $option_instructors .= '<option value = "' . $instructor_id. '">' .$instructor_id . '</option>';
                  echo $option_instructors;
            ?>
          </select>
        </div>
      </div>
    </div>

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
<div class="row">
  <div class="col-lg-4">
    <label> Classs Room no</label>
  </div>
    <div class="col-lg-6">
      <div class="form-group">
      <select class="form-control custom-select" required name="room_num">
        <?php   $option_rooms1 .= '<option value = "' . $class_no . '">' . $class_no . '</option>';
        echo $option_rooms1;
      echo $option_rooms;
      ?>
   </select>
 </div>
 </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <label>Total Seats</label>
  </div>
    <div class="col-lg-6">
<div class="form-group">
    <input class="form-control" required type="number" max="60" name="totalSeats" placeholder="Total Seats" id="totalSeats" value="<?php echo $remaining_seats ;?>">
  </div>
</div>
 </div>

 <div class="row">
   <div class="col-lg-4">
    <label>Available Seats</label>
   </div>
     <div class="col-lg-6">
 <div class="form-group">

    <input class="form-control" disabled type="number" name="availableSeats" placeholder="Available Seats" id="availableSeats" value="<?php echo $available_seats ;?>">
  </div>
</div>
 </div>


 <div class="row">

     <div class="col-lg-5">
       <div class="form-group">
         <label>Day1</label>
    <select  class="form-control custom-select" required name="day1">
      <option value="" disabled selected>Select Day -1</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
    </select>
  </div>
  </div>
  <div class="col-lg-5">
    <div class="form-group">
      <label>Day 2</label>
      <select  class="form-control custom-select" required name="day2">
        <option value="" disabled selected>Select Day -2</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
      </select>
    </div>
    </div>
    </div>

    <div class="row">

        <div class="col-lg-5">
          <div class="form-group">
      <label>Start Time</label>
    <input class="form-control" required type="time"  name="startTiming" placeholder="Start Time" id="startTiming" value="<?php echo $class_start_time ;?>">
  </div>
  </div>
  <div class="col-lg-5">
    <div class="form-group">
    <label>End Time</label>
    <input class="form-control" required type="time"  name="endTiming" placeholder="End Time" id="endTiming" value="<?php echo $class_end_time ;?>">
  </div>
  </div>
</div>
    <div class="form-group">
      <input class="btn btn-primary" type="submit" id="Edit" >
    </div>
</form>
</div>
</div>
<script>
$(document).ready(function(){
    $("#Edit").click(function(){
      if ($("#totalSeats").val() < $("#availableSeats").val() ) {
        alert('Total seats cannot be less than avaiable seats');
          event.preventDefault();
      }
      if ($("#startTiming").val() > $("#endTiming").val() ) {
        alert('Start time has to be greater than end time');
        event.preventDefault();
      }
    });
});
</script>
</body>
</html>
