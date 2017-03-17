<?php
session_start();
include ("../includes/connection.php");




// this should get the session user id

// gets the userID of the person you want to delete from the URL
if(isset($_GET['thisFriend'])) {

    $thisFriend = $_GET['thisFriend'];


    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $delete_friend = "DELETE FROM friendshipbridge WHERE (user_id = '$thisFriend' AND friend_id = '$sessionUserID')
                      OR ( user_ID = '$sessionUserID' AND friend_id = '$thisFriend')";

    $run_delete_friend = mysqli_query($con, $delete_friend);

    if($run_delete_friend){
          echo "<script>alert('Friend deleted!!!')</script>";
          echo "<script>window.open('../Pages/friendsList.php', '_self')</script>";
     }

}

?>
