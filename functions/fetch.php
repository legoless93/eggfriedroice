<?php
//fetch.php;
session_start();
include("../includes/connection.php");

//echo "<script>alert('Friend request accepted!!!')</script>";

 $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];


    // echo "<script>alert(sessionUserID)</script>";



if(isset($_POST["view"]))
{


// THIS WORKS


//  $output='';
//   $output .= '
//    <li>
//                             <a href="#">
//                                 <div>
//                                     <i class="fa fa-comment fa-fw"></i> New Comment
//                                     <span class="pull-right text-muted small">48 minutes ago</span>
//                                 </div>
//                             </a>
//                         </li>
//                         <li class="divider"></li>
//    ';


//   //echo $output;

//   echo json_encode($output);
// }

  // END OF THIS WORKS

// EDIT


  // if($_POST["view"] != '')
 // {

 //  // status = 0  ( unread notification)
 //  // status = 1  ( read notification)
 //  $update_query = "UPDATE notifications SET status=1 WHERE status=0";
 //  mysqli_query($con, $update_query);

 // }

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
   $output .= '<li>
                              <a href="../Pages/friendsList.php?userid='.$sessionUserID.'">
                                 <div>
                                    <i class="fa fa-exclamation fa-fw"></i> '.$rowPosts["notification_text"].'
                                </div>
                            </a>
                        </li>
                         ';
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
                     // <span class="pull-right text-muted small">69 69 69 minutes ago</span>

                      // echo json_encode($output);

  $get_notifications_no = "SELECT * FROM notifications WHERE status= '0' AND receiver_id = '$sessionUserID' ";
 $run_get_notifications_no = mysqli_query($con, $get_notifications_no);
 $count_run_get_notifications_no = mysqli_num_rows($run_get_notifications_no);

 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count_run_get_notifications_no );


                       echo json_encode($data);

 }




// END of EDIT

 // if($_POST["view"] != '')
 // {

 //  // status = 0  ( unread notification)
 //  // status = 1  ( read notification)
 //  $update_query = "UPDATE notifications SET status=1 WHERE status=0";
 //  mysqli_query($con, $update_query);

 // }

 // $query = "SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 5";
 // $result = mysqli_query($con, $query);
 // $output = '';

 // if(mysqli_num_rows($result) > 0)
 // {

 //  while($row = mysqli_fetch_array($result))
 //  {

 //      $text = $row['text'];
 //   $output .= '
 // <li>
 //                             <a href="#">
 //                                <div>
 //                                    <i class="fa fa-comment fa-fw"></i> $text
 //                                    <span class="pull-right text-muted small">48 minutes ago</span>
 //                                </div>
 //                            </a>
 //                        </li>
 //                       <li class="divider"></li>  ';
 //  }
 // }
 // else
 // {
 //  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 // }

 // $query_1 = "SELECT * FROM notifications WHERE status=0";
 // $result_1 = mysqli_query($con, $query_1);
 // $count = mysqli_num_rows($result_1);
 // $data = array(
 //  'notification'   => $output,
 //  'unseen_notification' => $count
 // );
 // echo json_encode($data);

 // }

 // $output='';
 //  $output .= '
 //   <li>
 //                            <a href="#">
 //                                <div>
 //                                    <i class="fa fa-comment fa-fw"></i> New Comment
 //                                    <span class="pull-right text-muted small">4 minutes ago</span>
 //                                </div>
 //                            </a>
 //                        </li>
 //                        <li class="divider"></li>
 //   ';


 //  echo $output;
?>
