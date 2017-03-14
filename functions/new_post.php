<?php
include("../includes/connection.php");

  if(isset($_POST['postIt'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $postTitle = $_POST['post_title'];
    $title = htmlspecialchars($postTitle, ENT_QUOTES);
    $postBody = $_POST['post_body'];
    $body = htmlspecialchars($postBody, ENT_QUOTES);

    $insertPost = "INSERT INTO posts (user_id, post_time, post_title, post_body)
    VALUES ('$sessionUserID', now(), '$title', '$body')";

    // $insertPost = "INSERT INTO blogPosts (user_id, post_time, post_title, post_body)
    // VALUES ('$sessionUserID', now(), '$postTitle', '$postBody')";
    $run_insertPost = mysqli_query($con, $insertPost);

    if($run_insertPost) {
      echo "<script>alert('Yay!!! New post!!!')</script>";
      echo "<script type='text/javascript'> document.location = '../Pages/blog.php?userid=$sessionUserID'; </script>";
    } else {
      echo "<script>alert('Ahhh crap...')</script>";
    }
  }
?>
