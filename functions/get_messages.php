<?php

// $circleID = $_GET['circle_id'];
// $user = $_GET['userid'];

// function getMessages($circleID, $user){
//
// include("../includes/connection.php");
//
// $get_messages = "SELECT user.user_firstName, user.user_lastName, user.user_pic, messages.message_body, messages.sender_id, messages.message_time
//                   FROM messages JOIN user ON messages.sender_id = user.user_id WHERE messages.circle_id = '$circleID' ORDER BY message_id ASC";
// $run_messages = mysqli_query($con, $get_messages);
// $check_messages = mysqli_num_rows($run_messages);
//
// $output = ''; // output to be returned to circle_group
//
// while ($rowPosts = mysqli_fetch_array($run_messages)) {
//
// // $output = ''; // output to be returned to circle_group
//
//   // $thisMessageID = $rowPosts['message_id'];
//   $thisSenderID = $rowPosts['sender_id'];
//   $thisMessageTime = $rowPosts['message_time'];
//   $thisMessageBody = $rowPosts['message_body'];
//   $thisFirst = $rowPosts['user_firstName'];
//   $thisLast = $rowPosts['user_lastName'];
//   $thisPic = $rowPosts['user_pic'];
//
//   if ($thisSenderID != $user){
//   $output .= '<li class="left clearfix">
//       <span class="chat-img pull-left">
//           <img src="../user/user_images/'.$thisPic.'" alt="User Avatar" class="img-circle" style="width:50px;height:50px;"/>
//       </span>
//       <div class="chat-body clearfix">
//           <div class="header">
//               <strong class="primary-font">'.$thisFirst.' '.$thisLast.'.</strong>
//               <small class="pull-right text-muted">
//                   <i class="fa fa-clock-o fa-fw"></i> '.$thisMessageTime.'
//               </small>
//           </div>
//           <p>
//           '.$thisMessageBody.'
//           </p>
//       </div>
//   </li>';
//
// } else {
//   $output .= '<li class="right clearfix">
//           <span class="chat-img pull-right">
//           <img src="../user/user_images/'.$thisPic.'" alt="User Avatar" class="img-circle" style="width:50px;height:50px;"/>
//           </span>
//           <div class="chat-body clearfix">
//           <div class="header">
//           <small class=" text-muted">
//           <i class="fa fa-clock-o fa-fw"></i> '.$thisMessageTime.'</small>
//           <strong class="pull-right primary-font">'.$thisFirst.' '.$thisLast.'</strong>
//           </div>
//           <p>
//           '.$thisMessageBody.'
//           </p>
//           </div>
//           </li>';
//
// }
//
// };
//
// return $output;
//
// }
echo "<script>alert('hi')</script>";

?>
