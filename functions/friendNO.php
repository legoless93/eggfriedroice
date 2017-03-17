<?php
session_start();
include("../includes/connection.php");

 $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

if(isset($_POST["id"]))
{


$output ='';

                       $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5);

                 $output .= "<i class='fa fa-users fa-fw'></i>Friends ($check_myFriends5)";


                       echo json_encode($output);

 }

?>
