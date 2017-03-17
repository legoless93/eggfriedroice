<?php

include("../includes/connection.php");

if(isset($_POST['addPhotoComment'])){

  $logged_email = $_SESSION['user_email'];
  $pre_photoID = $_SESSION['pre_photoID'];

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  // this gets the owner of the photo
  $userID = $row['user_id'];
  $FirstName = $row['user_firstName'];
  $LastName = $row['user_lastName'];

  $photo_comment_content = $_POST['photo_commnet_cotent'];
  $dateDay = date('d');
  $dateMonth = date('m');
  $dateYear = date('y');
  $dateTime = date('his');

  //this gets the photo id owner
  $get_photo_owner = "SELECT user_id FROM photos WHERE photo_id =  $pre_photoID";
  $run_get_pohoto_owner = mysqli_query($con, $get_photo_owner);
  $row1 = mysqli_fetch_array($run_get_pohoto_owner);

    $this_photo_owner_id = $row1['user_id'];


  $insertComment = "INSERT INTO comments (photo_id,commenter_id,comment_body,comment_day,comment_month,comment_year,comment_time)
                    VALUES ('$pre_photoID','$userID','$photo_comment_content','$dateDay','$dateMonth ','$dateYear','$dateTime')";

  $run_insertComment = mysqli_query($con, $insertComment);



  if($this_photo_owner_id == $userID){
  // this inserts a notification into the nortification table of who has liked your photo
    $comment_notification = "INSERT INTO notifications(notification_text, status, receiver_id ) VALUES ('You commented on your own photo!','0', '$this_photo_owner_id' )";
    $run_comment_notification =mysqli_query($con, $comment_notification);
  } else {

    $comment_notification = "INSERT INTO notifications(notification_text, status, receiver_id ) VALUES ('$FirstName $LastName commented on your photo!','0', '$this_photo_owner_id' )";
    $run_comment_notification =mysqli_query($con, $comment_notification);
  }


  if($run_insertComment && $run_comment_notification) {

  } else {
    echo "<script>alert('fail to comment it')</script>";
  }
}

?>
