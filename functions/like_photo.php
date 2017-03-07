<?php
include("../includes/connection.php");

  if(isset($_POST['createCollection'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $likeID = $sessionUserID;
    $likePhotoID= $_POST['public'];


    $insertLike = "INSERT INTO likes (photo_id,liker_id)
    VALUES ('$collectionName','$sessionUserID')";

    $run_insertCollection = mysqli_query($con, $insertCollection);

    if($run_insertCollection) {
      echo "<script>alert('Yay!!! New post!!!')</script>";
    } else {
      echo "<script>alert('Ahhh crap...')</script>";
    }
  }
?>
