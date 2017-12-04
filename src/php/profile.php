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

$query ="select * from cr_student where user_id= '$session_username'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result))
{
$name= $row['name'];
$degree=$row['degree'];
$major=$row['major'];
$mobile=$row['phone'];
$email=$row['email'];
$userId=$row['user_id'];

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<link type="text/css" rel="stylesheet" href="../css/common.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body id="profileB">
  <?php include 'menu.php'; ?>
    <div id="profile_container" class="container border">

      <div class="col-lg-3">
          <ul class="list-group">
              <li class="list-group-item" id="Mypic">
                <img src="../images/1.png" alt="John" style="height:170px">
              </li>
              <li class="list-group-item">
               <?php echo $name ?>
              </li>
              <li class="list-group-item">
               User ID:<?php echo $userId ?>
              </li>
              <li class="list-group-item">
                <?php echo $email ?>
              </li>
              <li class="list-group-item">
              Major: <?php echo $major ?>
              </li>
              <li class="list-group-item">
                Degree: <?php echo $degree ?>
              </li>
              <li class="list-group-item">
                Mobile no: <?php echo $mobile ?>
              </li>
              <li class="list-group-item">
                <a href='editProfile.php'>
                  <span class='glyphicon glyphicon-edit'></span>
                  Edit
                </a>
            </li>

          </ul>


      </div>
      <div class="col-lg-9">
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="jumbotron">
                <h3>Hello, <?php echo $name ?></h3>
                <p>Hi welcome to our aweeesome website
                Hi welcome to our aweeesome website
              Hi welcome to our aweeesome website
            Hi welcome to our aweeesome website
          Hi welcome to our aweeesome website
        Hi welcome to our aweeesome website</p>
              </div>

          </div>

      </div>
    </div>
  </div>
</body>
</html>
