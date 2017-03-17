<?php
session_start();
include("../includes/connection.php");

 $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];


if(isset($_POST["view"]))
{


if($_POST["view"] != '')
 {

  // status = 0  ( unread notification)
  // status = 1  ( read notification)
  $update_query = "UPDATE notifications SET status=1 WHERE status= '0' AND receiver_id = '$sessionUserID'";
  mysqli_query($con, $update_query);

 }

$get_notifications = "SELECT * FROM notifications WHERE receiver_id = '$sessionUserID' ORDER BY notification_id DESC LIMIT 5";
$run_get_notifications = mysqli_query($con, $get_notifications);

$checknotifications = mysqli_num_rows($run_get_notifications);



$output ='';

// error here
if(($checknotifications) > 0 ){



 while ($rowPosts = mysqli_fetch_array($run_get_notifications)) {

  // $thisText = $rowPosts['text'];
  $text=$rowPosts["notification_text"];

  if (strpos($text, 'Friend Request') !== false){

   $output .= '<li>
                <a href="../Pages/friendsList.php?userid='.$sessionUserID.'">
                                 <div>
                                    <i class="fa fa-exclamation fa-fw"></i> '.$rowPosts["notification_text"].'
                                </div>
                            </a>
                        </li>
                         ';


                         }else if (strpos($text, 'liked') !== false) {

                          $output .= '<li>
                        <a href="../Pages/photocollection.php?userid='.$sessionUserID.'">
                                 <div>
                                    <i class="fa fa-exclamation fa-fw"></i> '.$rowPosts["notification_text"].'
                                </div>
                            </a>
                          </li>
                         ';

                         } else if (strpos($text, 'to a circle') !== false){


                          $output .= '<li>
                        <a href="../Pages/circles.php?userid='.$sessionUserID.'">
                                 <div>
                                    <i class="fa fa-exclamation fa-fw"></i> '.$rowPosts["notification_text"].'
                                </div>
                            </a>
                          </li>
                         ';


                         }
                      }



                    }
                    else {

                      $output .= '
                    <li>
                              <a href="#">
                                 <div>
                                    No Notifications
                                </div>
                            </a>
                        </li>
                        ';

                    }

  $get_notifications_no = "SELECT * FROM notifications WHERE status= '0' AND receiver_id = '$sessionUserID' ";
 $run_get_notifications_no = mysqli_query($con, $get_notifications_no);
 $count_run_get_notifications_no = mysqli_num_rows($run_get_notifications_no);

 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count_run_get_notifications_no );


                       echo json_encode($data);

 }


?>
