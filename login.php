<?php
session_start();
include("includes/connection.php");
if(isset($_POST['login'])) {
  $email = $_POST['logEmail'];
  $pass = $_POST['logPass'];

  $get_user = "SELECT * FROM user WHERE user_email = '$email' AND user_password ='$pass'";
  $run_user = mysqli_query($con, $get_user);
  $check = mysqli_num_rows($run_user);

  if($check == 1) {

      $rowUsers = mysqli_fetch_array($run_user);
      $theID = $rowUsers['user_id'];

    $_SESSION['user_email']=$email;
    echo "<script>window.open('home.php?userid=$theID', '_self')</script>";
  } else {
    echo "<script>alert('Email or password is incorrect!!!')</script>";
  }
}
?>
