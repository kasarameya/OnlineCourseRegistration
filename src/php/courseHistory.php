<?php
include 'connection.php';
session_start();
if(isSet($_SESSION['username'])){
  $session_username = $_SESSION['username'];
}
else{
  header("location:login.html");
  exit();
}
?>
<html lang="en">
<head>
    <title>Course History</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include 'menu.php'; ?>

<div id="cr_container" class="container">
  <h2>Course History</h2>
    <?php
      $pastCoursesSql="CALL show_my_history('$session_username',0)";
      $result2=mysqli_query($conn, $pastCoursesSql);
      if (mysqli_num_rows($result2) > 0) {
        echo "<table class='table table-hover'>
           <thead class='bg-primary'>
          <tr  class='text-white'>
            <th>Course Id</th>
            <th>Course Name</th>
            <th>Instructor Id</th>
            <th>Instructor Name</th>
            <th>Semester</th>
            <th>Grade</th>
          </tr>
          </thead>";


          while ($row2 = mysqli_fetch_assoc($result2)) {
            echo "<tr>";
            echo "<td> " . $row2['course_id'] . "</td>";
            echo "<td>" . $row2['course_name'] . "</td>";
            echo "<td>" . $row2['instructor_id'] . "</td>";
            echo "<td>" . $row2['name'] . "</td>";
            echo "<td>" . $row2['semester'] . "</td>";
            echo "<td>" . $row2['grade_secured'] . "</td>";
            echo "</tr>";
          }
        echo "</table>";


    }else {
      echo "<h4>You don't have any previous course.</h4>";
    }
  ?>
</div>

</body>
</html>
