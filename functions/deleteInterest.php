<?php
include ("../includes/connection.php");


if(isset($_POST['deleteInterests']) && isset($_POST['interest_group'])) {

//mysqli_real_escape_string( connection, the input) will stop the input field from accepting weird names such as code etc.
  $oldInterest = $_POST['interest_group'];

    foreach($oldInterest as $inter) {
        $theOldInterest = mysqli_real_escape_string($con, $inter);

        $del_interests = "DELETE FROM interests WHERE interests.interest = '$theOldInterest' AND interests.user_id = '$sessionUserID'";
        $run_delInterests = mysqli_query($con, $del_interests);
    }
    if($run_delInterests) {
      echo "<script>window.open('profile.php?userid=$sessionUserID', '_self')</script>";
      exit();
    }
  }


?>
