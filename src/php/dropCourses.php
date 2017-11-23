<html lang="en">
<head>
    <title>Drop Courses</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
</head>
<body>
  <section>
    <?php
    include 'connection.php';
    session_start();
    $session_username = $_SESSION['username'];
    echo "<h2>Courses Enrolled for the Next Semester</h2>";

    $futureCoursesSql="CALL show_my_history('$session_username',1)";
    $result=mysqli_query($conn, $futureCoursesSql);
    if (mysqli_num_rows($result) > 0) {
      echo "<table>
        <tr>
          <th>Course_id</th>
          <th>Instructor_id</th>
          <th>Instructor Name</th>
          <th>Semester</th>
          <th>Drop</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td> " . $row['course_id'] . "</td>";
          echo "<td>" . $row['instructor_id'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['semester'] . "</td>";
          echo "<td><a href='dropCurrentCourse.php?course_id=".$row['course_id']."&instructor_id=".$row['instructor_id']."&semester=".$row['semester']."'>Drop</a></td>";
          echo "</tr>";
        }
      echo "</table>";
    }else {
      echo "Wrong Db :".mysqli_error($conn);
    }

    ?>

    </section
</body>
</html>
