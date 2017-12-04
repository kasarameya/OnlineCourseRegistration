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
    <title>Drop Courses</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></head>
<body>
  <?php include 'menu.php'; ?>
    <div id="homepage_container" class="container">
<?php
    echo "<h2>Courses Enrolled for the Next Semester</h2>";

    $futureCoursesSql="CALL show_my_history('$session_username',1)";
    $result=mysqli_query($conn, $futureCoursesSql);
    if (mysqli_num_rows($result) > 0) {
      echo "  <table class='table'>
         <thead class='bg-primary'>
          <tr class='text-white'>
          <th>Course Id</th>
          <th>Instructor Id</th>
          <th>Instructor Name</th>
          <th>Semester</th>
          <th>Drop</th>
        </tr></thead>";

        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td> " . $row['course_id'] . "</td>";
          echo "<td>" . $row['instructor_id'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['semester'] . "</td>";
          echo "<td><a href='dropCurrentCourse.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'><span class='glyphicon glyphicon-trash'></span></a></td>";
          echo "</tr>";
        }
      echo "</table>";
    }else {
      echo "<h4>You have not enroll in any class.</h4>";
    }

    ?>

  </div>
</body>
</html>
