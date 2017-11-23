<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
?>
<html lang="en">
<head>
    <title>Online Course Registration</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
  <article>
    <?php
    $name=$degree=$major=$email=$phone=$gender="";
    $sql="SELECT name,degree,major,email,phone,gender FROM cr_student WHERE user_id= '$session_username'" ;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        $degree = $row['degree'];
        $major = $row['major'];
        $email = $row['email'];
        $phone = $row['phone'];
        $gender = $row['gender'];
      }
    }else {
      echo "User data not found";
    }
    echo "<h3>Name : $name <br/> Degree : $degree
    <br/> Major : $major <br/> Email : $email<br/> Phone : $phone
    <br/> Gender : $gender</h3>";
    ?>
  </article>
    <section>
          <h2>Online Course Registration login</h2>
      <form action="#" method="GET">
      <label>Degree:</label>
      <select name="Degree">
        <option value="Graduate">Graduate</option>
        <option value="UnderGraduate">UnderGraduate</option>
        <option value="Phd">Phd</option>
          <option value="ALl">All</option>
      </select>

      <label>Major:</label>
      <select name="Major">

        <option value="Computer Science"<?= $_REQUEST["Major"] == "Computer Science" ? " selected='selected'" : "" ?>>Computer Science</option>
        <option value="Mechanical Engineering"<?= $_REQUEST["Major"] == "Mechanical Engineering" ? " selected='selected'" : "" ?>>Mechanical Engineering</option>
        <option value="itm"<?= $_REQUEST["Major"] == "itm" ? " selected='selected'" : "" ?>>ITM</option>
        <option value="Electrical Engineering"<?= $_REQUEST["Major"] == "Electrical Engineering" ? " selected='selected'" : "" ?>>Electrical Engineering</option>
        <option value="All"<?= $_REQUEST["Major"] == "All" ? " selected='selected'" : "" ?>>All</option>
      </select>

      <label>Semester:</label>
      <select name="Semester">
        <option value="Fall17">Fall17</option>
          <option value="Spring18">Spring18</option>
        <option value="ALl">All</option>
      </select>
        <button id="search">Search</button>

      </form>

<?php
$course_id = $instructor_id = $semester = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $major  = $_GET["Major"];
    $degree = $_GET["Degree"];
    $sem    = $_GET["Semester"];

    $sql2    = "CALL view_all_courses('$degree','$major','$sem') ";
    $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result2) > 0) {
        echo "<form action='myCart.php' method='POST'>
        <table>
          <tr>
            <th>course_id</th>
            <th>instructor_id</th>
            <th>Semester</th>
            <th>Check</th>
          </tr>";
        while ($row = mysqli_fetch_assoc($result2)) {

            $course = $row['course_id'] . " " . $inst = $row['instructor_id'] . " " . $row['semester'];

            echo "<tr>";
            echo "<td> " . $row['course_id'] . "</td>";
            echo "<td>" . $row['instructor_id'] . "</td>";
            echo "<td>" . $row['semester'] . "</td>";
            echo "<td> <input type='checkbox' value='$course' name='checkbox1[]'> </td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<button id='AddCart'>Add to Cart</button>";
        echo "</form>";

    }
}
?>
</section>
</body>
</html>
