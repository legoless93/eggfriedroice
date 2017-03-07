<?php
include ("../includes/connection.php");
include ("../home.php");
$topFriendsQuery = "SELECT user_id, COUNT(*) rank
FROM friendshipBridge
WHERE friendshipBridge.user_id <> '$sessionUserID' AND friendshipBridge.friend_id <> '$sessionUserID'
AND (friendshipBridge.user_id IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$sessionUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$sessionUserID'))
AND (friendshipBridge.friend_id IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$sessionUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$sessionUserID'))
GROUP BY friendshipBridge.user_id
ORDER BY rank DESC";
$run_topFriends = mysqli_query($con, $topFriendsQuery);
$topFriend = mysqli_fetch_array($run_topFriends);
$topFriendUserID = $topFriend['user_id'];
if($topFriendUserID) {
  $recFriendsQuery = "SELECT * FROM user WHERE user.user_id IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$topFriendUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$topFriendUserID') AND user.user_id NOT IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$sessionUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$sessionUserID') AND user.user_id <> '$sessionUserID'";
$run_recFriends = mysqli_query($con, $recFriendsQuery);
while ($rowRecFriends = mysqli_fetch_array($run_recFriends)) {
  $thisRecFriendName = $rowRecFriends['user_firstName'] . " " . $rowRecFriends['user_lastName'];
  echo "
  <li class='left clearfix'>
      <span class='chat-img pull-left'>
          <img src='http://placehold.it/50/55C1E7/fff' alt='User Avatar' class='img-circle' />
      </span>
      <div class='chat-body clearfix'>
          <div class='header'>
              <strong class='primary-font'>$thisRecFriendName</strong>
          </div>
          <p>
              Hello...Please be my friend. One of my friends is your friend.
          </p>
      </div>
  </li>
  ";
}
}
 ?>
