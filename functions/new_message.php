<?php

include("../includes/connection.php");

if(isset($_POST['sendCircleMessage'])){

  $logged_email = $_SESSION['user_email'];
  $passed_circleID = $_SESSION['pass_circleID'];

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  $userID = $row['user_id'];

  $circle_message = $_POST['circle_message'];
  // $id = $get_circleID;
  // test without the rest

  $insertMessage = "INSERT INTO messages (circle_id, sender_id, message_time, message_body) VALUES ($passed_circleID, $userID, now(), '$circle_message')";
  $run_insertCircle = mysqli_query($con, $insertMessage);

  if($run_insertCircle) {
    echo "<script>alert('new message')</script>";
  } else {
    echo "<script>alert('unsuccessfull')</script>";
  }
  // echo "<script>alert('$passed_circleID')</script>";
}

?>
