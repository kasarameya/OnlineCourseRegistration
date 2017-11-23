<?php
include 'connection.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usernameData = test_data($_POST["admin_username"]);
    $paswordData  = test_data($_POST["admin_password"]);

    if (empty($usernameData) || empty($paswordData)) {
        header("location:adminLogin.html");
        exit();
    } else {

        $password = "";
        $sql      = "SELECT password FROM cr_admin WHERE user_id= '$usernameData'";
        $result   = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $password = $row["password"];
            }
            if ($password === $paswordData) {
                echo 1;
            } else {
                echo 0;
            }


        } else {
            echo 2;

        }
    }
}
function test_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
