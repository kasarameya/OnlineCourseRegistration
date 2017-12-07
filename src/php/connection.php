<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$myDB="Course_Registration";

  $conn = new mysqli($servername, $username, $password,$myDB);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  ?>
