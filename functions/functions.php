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



  // echo "<script>alert($checkMutualFriendsCount)</script>";

  echo "($checkMutualFriendsCount)";

}


?>
