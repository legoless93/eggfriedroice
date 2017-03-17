<?php
session_start();
include ("../includes/connection.php");



if(isset($_REQUEST['cancel'])) {

    $thisFriend = $_REQUEST['cancel'];


    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];


    $cancel_request = "DELETE FROM friendrequests WHERE (sender_id='$sessionUserID' AND receiver_id='$thisFriend') ";

   	$run_cancel_request = mysqli_query($con,$cancel_request );


   	if( $run_cancel_request){

        echo "Friend request cancelled successfully...";
   	}



}

?>
