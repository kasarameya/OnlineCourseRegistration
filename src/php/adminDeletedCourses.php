<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
?>


<html lang="en">
<head>
    <title>Deleted Courses</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
    <?php include 'adminMenu.php'; ?>
    <div id="homepage_container" class="container">
        <h2>Deleted Courses</h2>


<?php
$query = 'select course_id,instructor_id,semester from cr_course_enrollment where deleted = 1';

$del_result = mysqli_query($conn,$query);
if (mysqli_num_rows($del_result) > 0) {
  echo "
  <table class='table'>
   <thead class='bg-primary'>
    <tr class='text-white'>
      <th>Course Id</th>
      <th>Instructor Id</th>
      <th>Semester</th>
      <th>Enable</th>
    </tr>
    </thead>";
  while($row = mysqli_fetch_assoc($del_result)){
    echo "<tr>";
    echo "<td> " . $row['course_id'] . "</td>";
    echo "<td>" . $row['instructor_id'] . "</td>";
    echo "<td>" . $row['semester'] . "</td>";
    echo "<td><a href='adminCancelDelete.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Enable</a></td>";
    echo "</tr>";
  }
}else {
  echo "Error in getting deleted".mysqli_error($conn);
}

?>
