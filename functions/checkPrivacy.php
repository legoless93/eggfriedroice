<?php

if($sessionUserID != $userID) {

  $getPriv = "SELECT * FROM privacy WHERE user_id = '$userID'";
  $run_getPriv = mysqli_query($con, $getPriv);
  $allPriv = mysqli_fetch_array($run_getPriv);

  if($allPriv['public'] == 1) {
    $curSet = "public";
  } else if($allPriv['friendsOfFriends'] == 1) {
    $curSet = "friendsOfFriends";
  } else if($allPriv['friends'] == 1) {
    $curSet = "friends";
  } else if($allPriv['private'] == 1) {
    $curSet = "private";
  }


  if($curSet == "friends") {
    $checkStatus = "SELECT * FROM friendshipBridge
                    WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                    OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
    $run_checkStatus = mysqli_query($con, $checkStatus);
    $theCount = mysqli_num_rows($run_checkStatus);

    if($theCount < 1) {
      echo "<script>window.open('../Pages/accessDenied.php', '_self')</script>";
    }

  }

}

 ?>
