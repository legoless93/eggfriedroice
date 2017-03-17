<?php

include("../includes/connection.php");

if(isset($_POST['createCircle'])){

  $logged_email = $_SESSION['user_email'];

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  $userID = $row['user_id'];
  $firstName = $row['user_firstName'];
  $lastName = $row['user_lastName'];

  $circleName = $_POST['circle_name'];
  // test without the rest

  if(!isset($circleName) || trim($circleName) == '' || !isset($_POST['chk_group'])){
      echo "<script>alert('Please fill BOTH a circle name AND friend invites')</script>";
  } else {

  $insertCircle = "INSERT INTO circles (creator_id, circle_name) VALUES ('$userID', '$circleName')";
  $run_insertCircle = mysqli_query($con, $insertCircle);

  if($run_insertCircle) {
    if (isset($_POST['chk_group'])) {
        $optionArray = $_POST['chk_group'];

        // NOTE: may have to add timeAdded to the database for extra query as if
        // the creator creates anotoher circle with the same name it'll be kinda peak.
        $get_CircleID = "SELECT * FROM circles WHERE circle_name = '$circleName'
                        AND creator_id = '$userID'";
        $run_CircleID = mysqli_query($con, $get_CircleID);
        $row2 = mysqli_fetch_array($run_CircleID);

        $circleID = $row2['circle_id'];

        for ($i=0; $i<count($optionArray); $i++) {

          $addFriend2Circle = "INSERT INTO circleBridge (member_id, circle_id) VALUES ($optionArray[$i],$circleID)";
          $run_insertAddFriend = mysqli_query($con, $addFriend2Circle);
          // $addFriend2Circle = "INSERT INTO circleBridge (member_id, circle_id) VALUES ($optionArray[$i],99)";
          // echo "<script>alert($optionArray[$i])</script>";

          $circle_notification = "INSERT INTO notifications(notification_text, status, receiver_id ) VALUES ('$firstName $lastName added you to a circle','0', '$optionArray[$i]' )";
          $notification = mysqli_query($con, $circle_notification);
        }

        // insert yourself into friendship bridge
        $addCreator2Circle = "INSERT INTO circleBridge (member_id, circle_id) VALUES ($userID,$circleID)";
        $run_insertAddCreator = mysqli_query($con, $addCreator2Circle);


    }
    echo "<script>alert('created new circle')</script>";
    // header("refresh:0.1; url=../Pages/circles.php?userid=$userID");
    echo "<script type='text/javascript'> document.location = '../Pages/circles.php?userid=$userID'; </script>";
    exit;
  } else {
    echo "<script>alert('unsuccessfull')</script>";
  }
}
}

?>
