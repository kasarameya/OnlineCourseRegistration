<?php
include 'connection.php';
session_start();
/*if(isSet($_SESSION['username'])){
  $session_username = $_SESSION['username'];
}
else{
  header("location:login.html");
  exit();
}*/
  echo "<nav class='navbar navbar-expand-lg navbar-dark bg-primary'>
    <div class='collapse navbar-collapse'>
     <ul class='navbar-nav mr-auto'>
       <li class='nav-item active'>
         <a class='nav-link' href='#''>Home <span class='sr-only'>(current)</span></a>
       </li>
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
     <ul class='navbar-nav'>
              <li class='nav-item active'>
           <a class='nav-link' href='logout.php'> Logout </a>
         </li>
       </ul>
   </div>
  </nav>"

?>
