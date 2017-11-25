<?php
include 'connection.php';
session_start();
$session_username = $_SESSION['username'];
$verify_cart_sql = "SELECT verify_my_cart('$session_username')";
$result = mysqli_query($conn,$verify_cart_sql);
if (mysqli_num_rows($result) > 0) {
  while($row =mysqli_fetch_array($result,MYSQLI_NUM)){
    if ($row[0] == 0) {
      echo "Everything is Ok";
      $enroll_class_sql = "CALL enroll_my_class('$session_username')";
      $result_for_enroll_query = mysqli_query($conn,$enroll_class_sql);
      if (mysqli_num_rows($result_for_enroll_query) > 0) {
        while ($enroll_result_row = mysqli_fetch_assoc($result_for_enroll_query)) {
          echo $enroll_result_row["result"];
          header('location:dropCourses.php');
        }
      }else {
        echo "Error: " . mysqli_error($conn);
      }
    }elseif ($row[0] == 1) {
      echo "<script>
          alert('Cart contains more than 3 value');
            window.location.href='myCart.php';
            </script>";
    }elseif ($row[0] == 2) {
      echo "<script>
          alert('Duplicate courses in same semester');
            window.location.href='myCart.php';
            </script>";
    }elseif ($row[0] == 4) {
        echo "<script>
      alert('Cart contains past semester courses');
        window.location.href='myCart.php';
        </script>";
    }elseif ($row[0] == 5) {
  echo "<script>
      alert('One or many courses has been filled');
        window.location.href='myCart.php';
        </script>";
    }else {
      echo $row[0];
    }
  }
}else {
    echo "Error: " . mysqli_error($conn);
}
 ?>
