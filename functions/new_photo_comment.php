<?php

include("../includes/connection.php");

if(isset($_POST['addPhotoComment'])){

  $logged_email = $_SESSION['user_email'];
  $pre_photoID = $_SESSION['pre_photoID'];

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  $userID = $row['user_id'];

  $photo_comment_content = $_POST['photo_commnet_cotent'];
  $dateDay = date('d');
  $dateMonth = date('m');
  $dateYear = date('y');
  $dateTime = date('his');


  $insertComment = "INSERT INTO comments (photo_id,commenter_id,comment_body,comment_day,comment_month,comment_year,comment_time)
                    VALUES ('$pre_photoID','$userID','$photo_comment_content','$dateDay','$dateMonth ','$dateYear','$dateTime')";

  $run_insertComment = mysqli_query($con, $insertComment);

  if($run_insertComment) {

  } else {
    echo "<script>alert('fail to comment it')</script>";
  }
}

?>
