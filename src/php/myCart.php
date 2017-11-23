<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
?>
<html lang="en">
<head>
    <title>My Cart</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <section>
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
              $sql4="SELECT course_id,instructor_id,semester FROM cr_cart WHERE cart_id= '$session_username'";
              $result4=mysqli_query($conn, $sql4);

              if (mysqli_num_rows($result4) > 0) {
                echo "<form action='enrollCourses.php' method='GET'>
                <table>
                  <tr>
                    <th>course_id</th>
                    <th>instructor_id</th>
                    <th>Semester</th>
                    <th>Remove</th>
                  </tr>";

                  while ($row = mysqli_fetch_assoc($result4)) {
                    echo "<tr>";
                    echo "<td> " . $row['course_id'] . "</td>";
                    echo "<td>" . $row['instructor_id'] . "</td>";
                    echo "<td>" . $row['semester'] . "</td>";
                    echo "<td><a href='removeFromCart.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Delete</a></td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                  echo "<input type='submit' value='Enroll' id='enroll'></input>";
                  echo "</form>";
              }else {
                echo "<h4>Your cart is empty.</h4>";
              }


        }else {
          $sql4="SELECT course_id,instructor_id,semester FROM cr_cart WHERE cart_id= '$session_username'";
          $result4=mysqli_query($conn, $sql4);
          if (mysqli_num_rows($result4) > 0) {
              while ($row = mysqli_fetch_assoc($result4)) {
                echo "<form action='allCourses.php' method='GET'>
                <table>
                  <tr>
                    <th>course_id</th>
                    <th>instructor_id</th>
                    <th>Semester</th>
                    <th>Remove</th>
                  </tr>";
                echo "<tr>";
                echo "<td> " . $row['course_id'] . "</td>";
                echo "<td>" . $row['instructor_id'] . "</td>";
                echo "<td>" . $row['semester'] . "</td>";
                echo "<td><a href='removeFromCart.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Delete</a></td>";
                echo "</tr>";
                echo "</table>";
                echo "<input type='submit' value='Enroll' id='enroll'></input>";
                echo "</form>";
              }
          }else {
            echo "<h4>Your cart is empty.</h4>";
          }
        }
          ?>

    </section>

</body>
</html>
