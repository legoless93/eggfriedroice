<?php
include("../includes/connection.php");

  if(isset($_POST['postIt'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $userID = $row['user_id'];

    $postTitle = $_POST['post_title'];
    $postBody = $_POST['post_body'];
    $dateDay = date('d');
    $dateMonth = date('m');
    $dateYear = date('y');
    $dateTime = date('his');

    $insertPost = "INSERT INTO posts (user_id, post_day, post_month, post_year, post_time, post_title, post_body) VALUES ('$userID','$dateDay', '$dateMonth', '$dateYear', '$dateTime', '$postTitle', '$postBody')";
    $run_insertPost = mysqli_query($con, $insertPost);

    if($run_insertPost) {
      echo "<script>alert('Yay!!! New post!!!')</script>";
    } else {
      echo "<script>alert('Ahhh crap...')</script>";
    }
  }
?>
