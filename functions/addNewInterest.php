<?php
include ("../includes/connection.php");


if(isset($_POST['addInterests'])) {

  $newInterest = $_POST['newInterest'];
  $interest = mysqli_real_escape_string($con,$newInterest);

  $get_interests = "SELECT * FROM interests WHERE (user_id = $sessionUserID AND interest = '$newInterest')";
  $run_interests = mysqli_query($con, $get_interests);
  $checkExists = mysqli_num_rows($run_interests);

  if($checkExists >= 1) {
  echo "<script>alert('This interest is already in your likes!!!')</script>";
  } else {

    if ($interest != "") {

    $insertInterest = "INSERT INTO interests (user_id, interest) VALUES ('$sessionUserID', '$interest')";
    $run_insertInterest = mysqli_query($con, $insertInterest);

    if($run_insertInterest) {

      echo "<script>window.open('profile.php?userid=$sessionUserID', '_self')</script>";

      exit();
    }
  }

  }

}


?>
