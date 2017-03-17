<?php

if($sessionUserID != $userID) {

  $getPriv = "SELECT * FROM privacy WHERE user_id = '$userID'";
  $run_getPriv = mysqli_query($con, $getPriv);
  $allPriv = mysqli_fetch_array($run_getPriv);

  $curSet = '';

  if($allPriv['public'] == 1) {
    $curSet = "public";
  } else if($allPriv['friendsOfFriends'] == 1) {
    $curSet = "friendsOfFriends";
  } else if($allPriv['friends'] == 1) {
    $curSet = 'friends';
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

  } else if($curSet == "private") {
    echo "<script>window.open('../Pages/accessDenied.php', '_self')</script>";
  } else if($curSet == "friendsOfFriends") {

    $checkStatus = "SELECT * FROM friendshipBridge
                    WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                    OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
    $run_checkStatus = mysqli_query($con, $checkStatus);
    $theCount = mysqli_num_rows($run_checkStatus);

    if($theCount < 1) {

      $checkFoF = "SELECT * FROM (SELECT user.user_id FROM friendshipBridge
                          JOIN user ON friendshipBridge.user_id = user.user_id
                          WHERE friendshipBridge.friend_id = '$userID'
                          UNION ALL
                          SELECT user.user_id FROM friendshipBridge
                          JOIN user ON friendshipBridge.friend_id = user.user_id
                          WHERE friendshipBridge.user_id = '$userID') clickeeFriends
                          JOIN (SELECT user.user_id FROM friendshipBridge
                                              JOIN user ON friendshipBridge.user_id = user.user_id
                                              WHERE friendshipBridge.friend_id = '$sessionUserID'
                                              UNION ALL
                                              SELECT user.user_id FROM friendshipBridge
                                              JOIN user ON friendshipBridge.friend_id = user.user_id
                                              WHERE friendshipBridge.user_id = '$sessionUserID') myFriends
                                              ON clickeeFriends.user_id = myFriends.user_id";
      $run_checkFoF = mysqli_query($con, $checkFoF);
      $FoFCount = mysqli_num_rows($run_checkFoF);

      if($FoFCount < 1) {
        echo "<script>window.open('../Pages/accessDenied.php', '_self')</script>";
      }
    }
  }
}
 ?>
