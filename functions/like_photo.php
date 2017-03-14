<?php
session_start();
include("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

  if(isset($_POST['likes'])) {

    $likePhotoID = $_POST['likes'];
    // get the corresponding photo id via user's click the like icon

    $insertLike = "INSERT INTO likes (photo_id,liker_id)
    VALUES ('$likePhotoID','$sessionUserID')";
    // isnert the like information into the table
    // like id will auto increase, as the primary key

    $run_insertLike = mysqli_query($con, $insertLike);

    if($run_insertLike) {
      echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    } else {
      echo "<script>alert('can not like this photo')</script>";
    }
  }
?>
