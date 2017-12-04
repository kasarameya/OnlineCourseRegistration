<?php
include 'connection.php';
session_start();
if(isSet($_SESSION['admin_username'])){
  $session_admin_username = $_SESSION['admin_username'];
}
else{
  header("location:login.html");
  exit();
}

  echo "
  <nav class='navbar navbar-inverse'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <a class='navbar-brand' href='#'>UTD</a>
      </div>
       <ul class='nav navbar-nav'>
           <li class='nav-item active'>
             <a class='nav-link' href='adminViewCourses.php'>Coursebook</a>
           </li>
           <li class='nav-item active'>
             <a class='nav-link' href='adminAddCourse.php'>Add Course</a>
           </li>

           <li class='nav-item active'>
             <a class='nav-link' href='adminDeletedCourses.php'>History</a>
           </li>
          </ul>
       <ul class='nav navbar-nav navbar-right'>
       <li class='nav-item active'>
         <a class='nav-link'> Hi, $session_admin_username</a>
       </li>
            <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span></a></li>
       </ul>
   </div>
  </nav>"

?>
