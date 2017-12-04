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
$netid=$session_username;
$name= $row['name'];
$degree=$row['degree'];
$major=$row['major'];
$mobile=$row['phone'];
$email=$row['email'];
$userId=$row['user_id'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>EditProfile</title>
    <link type="text/css" rel="stylesheet" href="../css/common.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body id="profileB">
    <?php include 'menu.php'; ?>
      <div id="edit_profile_container" class="container">
        <h3 class="text-primary">Edit profile</h3>

        <form action="editProfile1.php" method="post">
          <div class="col">
            <div class="form-group">
              <label class="text font-weight-bold">NetId</label>
              <input class="form-control" type="text" readonly name="username" id="netId" value="<?php echo $netid ?>">
            </div>
            <div class="form-group">
              <label class="required text font-weight-bold">Name</label>
              <input class="form-control" type="text" name="name" id="name" value="<?php echo $name ?>">
            </div>
          <div class="form-group">
            <label class="required text font-weight-bold">New Password</label>
            <input class="password-input form-control" type="password" name="new_password" placeholder="New Password" >
          </div>
          <div class="form-group">
			      <label class="required text font-weight-bold">Confirm New Password</label>
            <input class=" password-input form-control"type="password" name="confirm_new_password" placeholder="Confirm Password" id="confirm_password">
          </div>

            <div class="form-group">
            <label class="required text font-weight-bold">Email</label>
            <input class="form-control" readonly type="text" name="email" value="<?php echo $email ?>" id="email">
          </div>
          <div class="form-group">
			      <label class="required text font-weight-bold">Phone</label>
            <input class="form-control" type="text" name="phone"  value="<?php echo $mobile ?>" id="phone"></br>
          </div>

          <div class="form-group">
            <input class="btn btn-primary" type="submit" id="Mybtn"  data-toggle="modal" data-target="#myModal" >
          </div>

        </div>
        </form>

      </div>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="../js/password_strength.js"></script>
	<script src="../js/jquery-strength.js"></script>
	<script>
		jQuery(function($) {
			$(".password-input").strength();
			$(".password-input-image").strength({
				templates: {
    			toggle: '<span class="input-group-addon"><img class="{toggleClass}" title="Show/Hide Password" src="images/checkbox.png" /></span>'
    		}
			});
		});
	</script>

</body>
</html>
