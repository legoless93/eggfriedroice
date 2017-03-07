<?php
include("../includes/connection.php");

if(isset($_POST['searchIT'])) {


	$logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $userID = $row['user_id'];
  	$query = $_POST['query'];


	echo "<script>alert('$query')</script>";
  }
  
?> 