<!-- where user_id = $user id and friend_id = $sessionUserId
or user_id = $sessionUserID and friend_id = $user_ID

// from the delete posts 

 -->
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


    $add_friend = "INSERT INTO friendrequests(sender_id, receiver_id, request_status) VALUES ('$sessionUserID','$thisFriend', '1')";

    $run_add_friend=mysqli_query($con, $add_friend);


    if ($run_add_friend){
    	echo "<script>alert('Friend request sent!!!')</script>";
        echo "<script>window.open('../Pages/friendsList.php', '_self')</script>";
    }

    //   // echo "<script>alert('this friend i want to delete: $thisFriend AND session user is: $sessionUserID !!!')</script>";


    // UN COMMENT this
    // $delete_friend = "DELETE FROM friendshipbridge WHERE (user_id = '$thisFriend' AND friend_id = '$sessionUserID') OR ( user_ID = '$sessionUserID' AND friend_id = '$thisFriend')";

    // $run_delete_friend = mysqli_query($con, $delete_friend);

    // if($run_delete_friend){
    //       echo "<script>alert('Friend deleted!!!')</script>";
    //       echo "<script>window.open('../Pages/friendsList.php', '_self')</script>";
    //  }

    // echo "<script>window.open('../Pages/friendsList.php','_self')</script>";
    // echo "<script>window.open('../Pages/blog.php','_self')</script>";

}

?>
