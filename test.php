<?php
include("../includes/connection.php");

  if(isset($_REQUEST['id'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

 
  }
?>

<div>
	<h3>hey there</h3>
</div>