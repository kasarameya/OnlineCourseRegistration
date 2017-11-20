<?php
include 'connection.php';
session_start();
$session_username="";
$session_username= $_SESSION['username'];

    $sql="SELECT name FROM cr_student WHERE user_id= '$session_username'" ;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo "<h1>Welcome,". $row["name"]. "</h1>";
      }
    }

?>
<html lang="en">
<head>
    <title>Online Course Registration</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
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

        <option value="Computer Science"<?= $_REQUEST["Major"]=="Computer Science"?" selected='selected'":"" ?>>Computer Science</option>
        <option value="Mechanical Engineering"<?= $_REQUEST["Major"]=="Mechanical Engineering"?" selected='selected'":"" ?>>Mechanical Engineering</option>
        <option value="itm"<?= $_REQUEST["Major"]=="itm"?" selected='selected'":"" ?>>ITM</option>
        <option value="Electrical Engineering"<?= $_REQUEST["Major"]=="Electrical Engineering"?" selected='selected'":"" ?>>Electrical Engineering</option>
        <option value="All"<?= $_REQUEST["Major"]=="All"?" selected='selected'":"" ?>>All</option>
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
$course_id=$instructor_id=$semester="";
if($_SERVER["REQUEST_METHOD"] == "GET"){

  $major=$_GET["Major"];
  $degree=$_GET["Degree"];
  $sem=$_GET["Semester"];

}

$sql2="CALL view_all_courses('$degree','$major','$sem') ";
$result2 = mysqli_query($conn, $sql2);

echo "<form action='homepageValidation.php' method='POST'>
      <table>
        <tr>
          <th>course_id</th>
          <th>instructor_id</th>
          <th>Semester</th>
          <th>Check</th>
        </tr>";
if (mysqli_num_rows($result2) > 0) {
      while($row = mysqli_fetch_assoc($result2)) {

        $checkbox=$row['course_id'].$row['instructor_id'] ;
        $x=$row['course_id'];
        $_SESSION['key'] =  $row['course_id'];
        echo "<tr>";
        echo "<td>" . $row['course_id'] . "</td>";
        echo "<td>" .$row['instructor_id'] . "</td>";
        echo "<td>" .$row['semester']. "</td>";
        echo "<td> <input type='submit'> </td>";
        echo "</tr>";
      }

      echo "</table>";
      echo "</form>";

}
?>
</section>
</body>
</html>
