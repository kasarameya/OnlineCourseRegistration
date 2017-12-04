<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
?>
<html lang="en">
<head>
    <title>Online Course Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

</head>
<body>
  <?php
include 'adminMenu.php';
?>
 <div id="homepage_container" class="container">
      <h2>Online Course Registration</h2>
        <form action="#" method="GET">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Degree:</label>
              <select class="form-control" name="Degree">
                <option value="Graduate">Graduate</option>
                <option value="UnderGraduate">UnderGraduate</option>
                <option value="Phd">Phd</option>
                <option value="All">All</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Major:</label>
                <select class="form-control" name="Major">
                  <option value="Computer Science"<?= $_REQUEST["Major"] == "Computer Science" ? " selected='selected'" : "" ?>>Computer Science</option>
                  <option value="Mechanical Engineering"<?= $_REQUEST["Major"] == "Mechanical Engineering" ? " selected='selected'" : "" ?>>Mechanical Engineering</option>
                  <option value="itm"<?= $_REQUEST["Major"] == "itm" ? " selected='selected'" : "" ?>>ITM</option>
                  <option value="Electrical Engineering"<?= $_REQUEST["Major"] == "Electrical Engineering" ? " selected='selected'" : "" ?>>Electrical Engineering</option>
                  <option value="All"<?= $_REQUEST["Major"] == "All" ? " selected='selected'" : "" ?>>All</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label >Semester:</label>
              <select class="form-control" name="Semester">
                <option value="Fall17">Fall17</option>
                  <option value="Spring18">Spring18</option>
                <option value="ALl">All</option>
              </select>
            </div>
          </div>
        </div>
        <button id="search" class="btn btn-primary">Search</button>
      </form>

      <?php
$course_id = $instructor_id = $semester = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $major  = $_GET["Major"];
    $degree = $_GET["Degree"];
    $sem    = $_GET["Semester"];

    $sql2    = "CALL old_view_courses('$degree','$major','$sem') ";
    $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result2) > 0) {
        echo "<form action='myCart.php' method='POST'>
              <table class='table'>
               <thead class='bg-primary'>
                <tr class='text-white'>
                  <th>Course Name</th>
                  <th>Course Id</th>
                  <th>Instructor Id</th>
                  <th>Instructor Name</th>
                  <th>Semester</th>
                  <th>Availability</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                </thead>";
        while ($row = mysqli_fetch_assoc($result2)) {

            $course = $row['course_id'] . " " . $inst = $row['instructor_id'] . " " . $row['semester'];

            echo "<tr scope='row'>";
            echo "<td> " . $row['course_name'] . "</td>";
            echo "<td> " . $row['course_id'] . "</td>";
            echo "<td>" . $row['instructor_id'] . "</td>";
            echo "<td> " . $row['name'] . "</td>";
            echo "<td>" . $row['semester'] . "</td>";
            echo "<td>" . $row['remaining_seats'] . "</td>";
            echo "<td><a href='adminDeleteCourse.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Delete</a></td>";
            echo "<td><a href='adminEditCourse.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Edit</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";

    }
}
?>
     </div>
      </body>
</html>
