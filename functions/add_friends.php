<?php
session_start();
include ("../includes/connection.php");

 if(isset($_REQUEST['send'])) {

    $thisFriend = $_REQUEST['send'];

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];
    $FirstName = $row['user_firstName'];
    $LastName = $row['user_lastName'];


    $add_friend = "INSERT INTO friendrequests(sender_id, receiver_id, request_status) VALUES ('$sessionUserID','$thisFriend', '1')";



    $run_add_friend=mysqli_query($con, $add_friend);

    $add_friend_notification = "INSERT INTO notifications(notification_text, status, receiver_id ) VALUES ('Friend Request from $FirstName $LastName','0', '$thisFriend' )";

     $run_add_friend_notification =mysqli_query($con, $add_friend_notification);


    if ($run_add_friend && $run_add_friend_notification){

         echo "Friend request sent successfully...";

    }


}

?>
