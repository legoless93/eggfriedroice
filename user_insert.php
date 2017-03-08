<?php

include("includes/connection.php");

  // Using post method in the form so using the post method here
  if(isset($_POST['signUp'])) {

//mysqli_real_escape_string( connection, the input) will stop the input field from accepting weird names such as code etc.

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $pass = $_POST['password'];
    $email = $_POST['e_mail'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    //could also use NOW() for the date.
    // $date = date("y-m-d");


    $get_email = "SELECT * FROM user WHERE user_email = '$email'";
    $run_email = mysqli_query($con, $get_email);
    $check = mysqli_num_rows($run_email);

    if($check >= 1) {
    echo "<script>alert('This email is already registered!!!')</script>";
    exit();
  } elseif (strlen($pass) < 8) {
      echo "<script>alert('Password should be 8 characters long')</script>";
      exit();
    } else {
      $insert = "INSERT INTO user (user_email, user_password, user_firstName, user_lastName, user_DoB, user_gender, user_pic) VALUES ('$email', '$pass', '$firstName', '$lastName', '$birthday', '$gender', 'default.jpg')";
      $run_insert = mysqli_query($con, $insert);

      $getNewID = "SELECT user_id FROM user WHERE user_email = '$email'";
      $run_getNewID = mysqli_query($con, $getNewID);
      $rowNewID = mysqli_fetch_array($run_getNewID);

      $insertPrivacySettings = "INSERT INTO privacy (user_id) VALUES (".$rowNewID[0].")";
      $runInsertPrivacy = mysqli_query($con, $insertPrivacySettings);

      if($run_insert && $runInsertPrivacy) {
        $_SESSION['user_email']=$email;
        echo "<script>alert('You have successfully registered!!! Yay!!!')</script>";
        echo "<script>window.open('home.php?userid=$rowNewID[0]', '_self')</script>";
        exit();
      } else {
        echo "<script>alert('no')</script>";
      }
    }

  }

?>
