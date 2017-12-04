<?php
include 'connection.php';
session_start();

?>
<html lang="en">
<head>
    <title>Add Course</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
<body>
  <?php include 'adminMenu.php'; ?>

  <div id="homepage_container" class="container">
    <h2>Add Course</h2>

  <form action="adminAddCourseCode.php" method="post">
<<<<<<< HEAD
=======

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
>>>>>>> 83234c96c0b3c6aa7badd5f6a19f6183dd92b171

    <?php
        $sql_cname    = "SELECT distinct course_name FROM cr_course";
        $result_cname = mysqli_query($conn, $sql_cname);
        if (mysqli_num_rows($result_cname) > 0) {
            $option_cname = '';
            while ($row = mysqli_fetch_assoc($result_cname)) {
                $option_cname .= '<option value = "' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
            }
        }
      ?>
      <div class="row">
      <div class="form-group">
       <select class="form-control custom-select" required name="course_name">
         <option value="" disabled selected>Select Course Name</option>
         <?php echo $option_cname; ?>
     </select>
    </div>
    </div>
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
<div class="row">
<div class="form-group">
  <select class="form-control custom-select" required name="degree">
    <option value="" disabled selected>Select Degree</option>
    <?php
echo $option;
?>
 </select>
</div>
</div>

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
<div class="row">
<div class="form-group">
    <select class="form-control custom-select" required name="branch">
      <option value="" disabled selected>Select Branch</option>
      <?php echo $option_branch; ?>
  </select>
</div>
</div>
<div class="row">
<div class="form-group">
    <select  class="form-control custom-select" required name="semester">
      <option value="" disabled selected>Select Semester</option>
      <option value="Spring18">Spring-18</option>
    </select>
  </div>
  </div>
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
<div class="row">
<div class="form-group">
    <select class="form-control custom-select" required name="instructor_id">
      <option value="" disabled selected>Select Instructor</option>
      <?php
echo $option_instructors;
?>
</select>
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
<div class="form-group">
<select class="form-control custom-select" required name="room_num">
  <option value="" disabled selected>Select Class room</option>
  <?php
echo $option_rooms;
?>
  </select>
</div>
</div>
<div class="row">
<div class="form-group">
    <label>Total Seats</label>
<<<<<<< HEAD
    <input class="form-control" required type="number" max="60" name="totalSeats" placeholder="Total Seats" id="totalSeats">
  </div>
  </div>

  <div class="row">

      <div class="col-lg-4">
        <div class="form-group">
          <label>Day1</label>
    <select class="form-control custom-select" required name="day1">
=======
    <input class="form-control" required type="number" max="100" name="totalSeats" placeholder="Total Seats" id="totalSeats">
    <br/>
    <select required name="day1">
>>>>>>> 83234c96c0b3c6aa7badd5f6a19f6183dd92b171
      <option value="" disabled selected>Select Day -1</option>
      <option value="Monday">Monday</option>
      <option value="Tuesday">Tuesday</option>
      <option value="Wednesday">Wednesday</option>
      <option value="Thursday">Thursday</option>
      <option value="Friday">Friday</option>
    </select>
  </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
      <label>Day 2</label>
      <select class="form-control custom-select" required name="day2">
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

      <div class="col-lg-4">
        <div class="form-group">
    <label>Start Time</label>
    <input class="form-control" required type="time"  name="startTiming" placeholder="Start Time" id="startTiming">
  </div>
  </div>
  <div class="col-lg-4">
    <div class="form-group">
    <label>End Time</label>
    <input class="form-control" required type="time"  name="endTiming" placeholder="End Time" id="endTiming">
  </div>
  </div>
</div>
    <div class="form-group">
      <input class="btn btn-primary" type="submit" id="validate" >
    </div>
</form>

</section>
</body>
</html>
