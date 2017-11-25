<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
?>
<html lang="en">
<head>
    <title>Course History</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <section>
    <?php
      $pastCoursesSql="CALL show_my_history('$session_username',0)";
      $result2=mysqli_query($conn, $pastCoursesSql);
      if (mysqli_num_rows($result2) > 0) {
        echo "<table>
          <tr>
            <th>Course_id</th>
            <th>Instructor_id</th>
            <th>Instructor Name</th>
            <th>Semester</th>
          </tr>";

          while ($row2 = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td> " . $row2['course_id'] . "</td>";
            echo "<td>" . $row2['instructor_id'] . "</td>";
            echo "<td>" . $row2['name'] . "</td>";
            echo "<td>" . $row2['semester'] . "</td>";
            echo "</tr>";
          }
        echo "</table>";


    }else {
      echo "<h4>Your cart is empty.</h4>";
    }
  ?>
  </section>
</body>
</html>
