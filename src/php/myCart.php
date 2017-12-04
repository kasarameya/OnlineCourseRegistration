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
    <title>My Cart</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></head>
<body>
    <?php include 'menu.php'; ?>
    <div id="homepage_container" class="container">
        <h2> My Cart</h2>
          <?php

          if($_SERVER["REQUEST_METHOD"] == "POST"){

            $checked_count = count($_POST['checkbox1']);
            if ($checked_count == 0) {
              echo "<script>
                  alert('No courses selected!');
                    window.location.href='homepage.php';
                    </script>";
            }
            foreach($_POST['checkbox1'] as $selected) {
              $pieces = explode(" ", $selected);
              //echo "<p>".$pieces[0] ."</p>";
              //echo $pieces[1];
              //echo $pieces[2];
              $sql3="INSERT INTO cr_cart(cart_id,course_id,instructor_id,semester) VALUES('$session_username','$pieces[0]','$pieces[1]','$pieces[2]') ";
              $result3 = mysqli_query($conn, $sql3);
              if (result3) {
                # code...
              }else {
                echo "Error in inserting in cart".mysqli_error($conn);
              }
              }
              $sql4="select b.course_id,b.instructor_id,b.semester FROM cr_cart a
              join cr_course_enrollment b on ( a.course_id=b.course_id and a.semester=b.semester and a.instructor_id=b.instructor_id)
              WHERE b.deleted <> 1 and  cart_id= '$session_username'
              group by a.course_id,a.instructor_id,a.semester";

              $result4=mysqli_query($conn, $sql4);

              if (mysqli_num_rows($result4) > 0) {
                echo "<form action='enrollCourses.php' method='GET'>
                <table class='table'>
                <thead class='bg-primary'>
                 <tr class='text-white'>
                    <th>course_id</th>
                    <th>instructor_id</th>
                    <th>Semester</th>
                    <th>Remove</th>
                  </tr>
                  </thead>";

                  while ($row = mysqli_fetch_assoc($result4)) {
                    echo "<tr>";
                    echo "<td> " . $row['course_id'] . "</td>";
                    echo "<td>" . $row['instructor_id'] . "</td>";
                    echo "<td>" . $row['semester'] . "</td>";
                    echo "<td><a href='removeFromCart.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Delete</a></td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                  echo "<input type='submit'  class='btn btn-primary' value='Enroll' id='enroll'></input>";
                  echo "</form>";
              }else {
                echo "<h4>Your cart is empty.</h4>";
              }


        }else {
          $sql4="select b.course_id,b.instructor_id,b.semester FROM cr_cart a
          join cr_course_enrollment b on ( a.course_id=b.course_id and a.semester=b.semester and a.instructor_id=b.instructor_id)
          WHERE b.deleted <> 1 and  cart_id= '$session_username'
          group by a.course_id,a.instructor_id,a.semester";

          $result4=mysqli_query($conn, $sql4);
          if (mysqli_num_rows($result4) > 0) {
            echo "  <table class='table'>
              <thead class='bg-primary'>
               <tr class='text-white'>
                <th>course_id</th>
                <th>instructor_id</th>
                <th>Semester</th>
                <th>Remove</th>
              </tr></thead>";
              while ($row = mysqli_fetch_assoc($result4)) {
                echo "<form action='enrollCourses.php' method='GET'>";
                echo "<tr>";
                echo "<td> " . $row['course_id'] . "</td>";
                echo "<td>" . $row['instructor_id'] . "</td>";
                echo "<td>" . $row['semester'] . "</td>";
                echo "<td><a href='removeFromCart.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'><span class='glyphicon glyphicon-trash'></span></a></td>";
                echo "</tr>";

              }
              echo "</table>";
              echo "<input type='submit'  class='btn btn-primary' value='Enroll' id='enroll'></input>";
              echo "</form>";
          }else {
            echo "<h4>Your cart is empty.</h4>";
          }
        }
          ?>

    </section>
</div>
</body>
</html>
