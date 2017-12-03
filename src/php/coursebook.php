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


$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}
$record_per_page=8;
$start_from = ($page-1)*$record_per_page;

$query =("select a.*,c.instructor_id,c.name,b.remaining_seats,
b.available_seats,b.class_no,b.class_start_time,
b.class_end_time,b.class_days,b.semester
from cr_course a
join cr_course_enrollment b on ( a.course_id=b.course_id)
join cr_instructors c on ( b.instructor_id=c.instructor_id)
group by b.course_id,b.instructor_id,b.semester
limit $start_from , $record_per_page ");

 //"CALL view_all_courses('all','all','all','$start_from','$record_per_page') ";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
 <head>
   <title>Online Course Registration</title>
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
  <div id="homepage_container" class="container">
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <table class="table table-bordered">
         <thead class='bg-primary'>
          <tr class='text-white'>
            <th>Course Name</th>
            <th>Course Id</th>
            <th>Instructor Id</th>
            <th>Instructor Name</th>
            <th>Semester</th>
            <th>Availability</th>
          </tr>
          </thead>

     <?php
     while($row = mysqli_fetch_array($result))
     {
     ?>
       <tbody id="myTable">
     <tr>
      <td><?php echo $row['course_name']; ?></td>
      <td><?php echo $row['course_id']; ?></td>
      <td><?php echo $row['instructor_id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['semester']; ?></td>
      <td><?php echo $row['remaining_seats']; ?></td>
     </tr>
     <?php
     }
     ?>
   </tbody>
    </table>


    <?php

    $limitRow = 8;
    $q="select count(*) as Tcount from cr_course_enrollment";
    $result2 = mysqli_query($conn, $q);
    while($row = mysqli_fetch_array($result2))
    {
      $records=$row['Tcount'];


    }
    $total_pages=ceil($records/$limitRow);
    echo $total_pages;
    $start_loop = $page;
    $difference = $total_pages - $page;


    $end_loop = $total_pages;
    if($page > 1)
    {
     echo "<a href='coursebook.php?page=1'>First</a>";
     echo "<a href='coursebook.php?page=".($page - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {
     echo "<a href='coursebook.php?page=".$i."'>".$i."</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='coursebook.php?page=".($page + 1)."'>>></a>";
     echo "<a href='coursebook.php?page=".$total_pages."'>Last</a>";
    }

    ?>
    <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
  </div>
 </body>
</html>
