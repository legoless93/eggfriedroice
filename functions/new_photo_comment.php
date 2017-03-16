<?php
include("../includes/connection.php");

if(isset($_POST['addPhotoComment'])){

  $logged_email = $_SESSION['user_email'];
  $pre_photoID = $_SESSION['pre_photoID'];
  //get wanted photo id via user's click on the corresponding "comment" button

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  // get user ID via query(SELECT) the user table
  // the logging email that recorded in the session block is used to find the
  // user id as foreign key in the WHERE statement.

  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  $userID = $row['user_id'];

  $photo_comment_content = $_POST['photo_commnet_cotent'];
  // comment content get from user's input
  $dateDay = date('d');
  $dateMonth = date('m');
  $dateYear = date('y');
  $dateTime = date('his');

  $insertComment = "INSERT INTO comments (photo_id,commenter_id,comment_body,comment_day,comment_month,comment_year,comment_time)
                    VALUES ('$pre_photoID','$userID','$photo_comment_content','$dateDay','$dateMonth ','$dateYear','$dateTime')";
                    // insert the required data in the DB
                    // comment id is the primary key, photo id the foreign key to find the specific row.

  $run_insertComment = mysqli_query($con, $insertComment);

  if($run_insertComment) {
    echo "<script>alert('new message')</script>";
  } else {
    echo "<script>alert('crap')</script>";
  }
}
?>
