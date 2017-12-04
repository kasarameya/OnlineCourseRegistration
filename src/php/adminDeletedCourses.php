<?php
include 'connection.php';
session_start();

?>


<html lang="en">
<head>
    <title>Deleted Courses</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></head>
<body>
    <?php include 'adminMenu.php'; ?>
    <div id="homepage_container" class="container">
        <h2>Deleted Courses</h2>


<?php
$query = 'select b.course_id,c.instructor_id,b.course_name as course_name, c.name as isntructor_name
,a.semester
 from cr_course_enrollment a
join cr_course b on ( a.course_id=b.course_id)
join cr_instructors c on ( a.instructor_id=c.instructor_id)
where a.deleted=1
group by a.course_id,a.instructor_id,a.semester;';

$del_result = mysqli_query($conn,$query);
if (mysqli_num_rows($del_result) > 0) {
  echo "
  <table class='table'>
   <thead class='bg-primary'>
    <tr class='text-white'>
      <th>Course Name</th>
      <th>Instructor Name</th>
      <th>Semester</th>
      <th>Enable</th>
    </tr>
    </thead>";
  while($row = mysqli_fetch_assoc($del_result)){
    echo "<tr>";
    echo "<td> " . $row['course_name'] . "</td>";
    echo "<td>" . $row['isntructor_name'] . "</td>";
    echo "<td>" . $row['semester'] . "</td>";
    echo "<td><a href='adminCancelDelete.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'><span class='glyphicon glyphicon-ok'></span></a></td>";
    echo "</tr>";
  }
}else {
  echo "No courses deleted yet!";
}

?>
