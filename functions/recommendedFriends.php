<?php
// include ("../includes/connection.php");

$con = mysqli_connect("localhost","root","","team21","3306") or die("Connection not established");

// include ("../home.php");
$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}


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
  if(in_array($thisRecFriendName, $recommendedFriendsList)) {

  } else {
    array_push($recommendedFriendsList, $thisRecFriendName);
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
              We have a mutual friend!
          </p>
      </div>
  </li>
  ";

}
}
}
 ?>
