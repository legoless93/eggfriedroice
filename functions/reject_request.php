<?php
session_start();
include ("../includes/connection.php");

//     $thisFriend = $_GET['thisFriend'];
    if(isset($_REQUEST['reject'])) {

    $thisFriend = $_REQUEST['reject'];

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $reject_request =
    "DELETE FROM friendrequests WHERE (sender_id='$thisFriend' AND receiver_id='$sessionUserID')";

   	$run_reject_request = mysqli_query($con,$reject_request );


   	if( $run_reject_request){

        echo "Friend request rejected successfully...";

   	}


}

?>
