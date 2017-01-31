<?php

include("includes/connection.php");

  // Using post method in the form so using the post method here
  if(isset($_POST['signUp'])) {

//mysqli_real_escape_string( connection, the input) will stop the input field from accepting weird names such as code etc.

    $name = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['e_mail'];
    $country = $_POST['country'];
    $birthday = $_POST['birthday'];
    //could also use NOW() for the date.
    $date = date("y-m-d");
    $status = "unverified";
    $posts = "No";

    $get_email = "SELECT * FROM users WHERE user_email = '$email'";
    $run_email = mysqli_query($con, $get_email);
    $check = mysqli_num_rows($run_email);

    if($check == 1) {
    echo "<script>alert('This email is already registered!!!')</script>";
    exit();
  } elseif (strlen($pass) < 8) {
      echo "<script>alert('Password should be 8 characters long')</script>";
      exit();
    } else {
      $insert = "INSERT INTO users (user_name, user_email, user_pass, user_country, user_birthday, user_image, user_regDate, last_login, status, posts) VALUES ('$name', '$email', '$pass', '$country', '$birthday', 'default.jpg', '$date', '$date', '$status', '$posts')";
      $run_insert = mysqli_query($con, $insert);

      if($run_insert) {
        $_SESSION['user_email']=$email;
        echo "<script>alert('You have successfully registered!!! Yay!!!')</script>";
        echo "<script>window.open('home.php', '_self')</script>";
        exit();
      }
    }

  }

?>
