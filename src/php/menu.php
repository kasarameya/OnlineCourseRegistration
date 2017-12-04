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
  echo "
  <nav class='navbar navbar-inverse '>
    <div class='container-fluid'>
      <div class='navbar-header'>
        <a class='navbar-brand' href='#'>UTD</a>
      </div>
      <ul class='nav navbar-nav'>
      <li class='nav-item active'>
        <a class='nav-link' href='profile.php'>Home <span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='coursebook.php'>CourseBook</a>
      </li>
        <li class='nav-item active'>
        <a class='nav-link' href='homepage.php'>Enroll</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='courseHistory.php'>Course History</a>
      </li>
      <li class='nav-item active'>
        <a class='nav-link' href='dropCourses.php'>Drop Course</a>
      </li>

      <li class='nav-item active'>
        <a class='nav-link' href='myCart.php'>My Cart</a>
      </li>
      </ul>
      <ul class='nav navbar-nav navbar-right'>

      <li class='nav-item active'>
        <a class='nav-link'> Hi, $session_username</a>
      </li>
        <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span></a></li>

      </ul>
    </div>
  </nav>"

?>
