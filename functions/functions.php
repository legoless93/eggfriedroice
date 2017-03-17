<?php

function getMut($sesID, $curID){

include("../includes/connection.php");

$checkMutualFriends = "SELECT * FROM (SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic  FROM friendshipBridge
                          JOIN user ON friendshipBridge.user_id = user.user_id
                          WHERE friendshipBridge.friend_id = $curID
                          UNION ALL
                          SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                          JOIN user ON friendshipBridge.friend_id = user.user_id
                          WHERE friendshipBridge.user_id = $curID) clickeeFriends
                          JOIN (SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                              JOIN user ON friendshipBridge.user_id = user.user_id
                                              WHERE friendshipBridge.friend_id = $sesID
                                              UNION ALL
                                              SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                              JOIN user ON friendshipBridge.friend_id = user.user_id
                                              WHERE friendshipBridge.user_id = $sesID) myFriends
                                              ON clickeeFriends.user_id = myFriends.user_id";

                        $run_checkMutualFriends = mysqli_query($con, $checkMutualFriends);
                        $checkMutualFriendsCount = mysqli_num_rows($run_checkMutualFriends);


  // echo "($checkMutualFriendsCount)";
  return $checkMutualFriendsCount;

}

function getTotalFriend($curID){

  include("../includes/connection.php");

  $get_myFriends5 = "SELECT user.user_id from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$curID'
                                                  UNION ALL
                                                  SELECT user.user_id FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$curID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $checkrun_myFriends5Count = mysqli_num_rows($run_myFriends5);


                              return $checkrun_myFriends5Count;


}


?>
