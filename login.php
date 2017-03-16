<?php
session_start();
include("includes/connection.php");
if(isset($_POST['login'])) {
  $email = $_POST['logEmail'];
  $pass = $_POST['logPass'];


  //add password_verify here

  // $get_user = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$pass'";
  $get_user = "SELECT * FROM user WHERE user_email = '$email'";
  $run_user = mysqli_query($con, $get_user);
  $check_email = mysqli_num_rows($run_user);

  $rowUsers = mysqli_fetch_array($run_user);
  $pw_db = $rowUsers['user_password'];


if($check_email == 1){
if (password_verify($pass, $pw_db)) {
  // echo "<script>alert($pass)</script>";
  // echo "<script>alert($test)</script>";
  $theID = $rowUsers['user_id'];

  $_SESSION['user_email']=$email;
  // echo "<script>window.open('home.php?userid=$theID', '_self')</script>";
  // echo "<script type='text/javascript'> document.location = 'home.php?userid=$theID'; </script>";
    echo "<script type='text/javascript'> document.location = 'Pages/home_feed.php?userid=$theID'; </script>";
} else {
  echo "<script>alert('Password is incorrect!!!')</script>";
  echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

} else {
  echo "<script>alert('Cannot find email!!!')</script>";
  echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

}
?>
