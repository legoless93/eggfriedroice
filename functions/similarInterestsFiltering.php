<?php
include ("../includes/connection.php");
include ("../home.php");

$topInterestsFriendsQuery = "SELECT interests.user_id, COUNT(*) rank
FROM interests JOIN (SELECT * FROM interests WHERE user_id = '$sessionUserID') myInterests
ON interests.interest = myInterests.interest
WHERE interests.user_id <> '$sessionUserID'
AND (interests.user_id IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$sessionUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$sessionUserID'))
GROUP BY interests.user_id
ORDER BY rank DESC";

$run_topInterestsFriends = mysqli_query($con, $topInterestsFriendsQuery);

$total = 0;
$counter = 0;
while($topInterestsFriends = mysqli_fetch_array($run_topInterestsFriends)) {
  $interestsValue = $topInterestsFriends['rank'];
  $total = $total + $interestsValue;
  $counter ++;
}

$averageInterests = $total/$counter;

$recIntFriendsQuery = "SELECT user.user_firstName, user.user_lastName, interests.user_id, COUNT(*) rank
FROM user JOIN interests ON user.user_id = interests.user_id
JOIN (SELECT * FROM interests WHERE user_id = '$sessionUserID') myInterests
ON interests.interest = myInterests.interest
WHERE interests.user_id <> '$sessionUserID'
AND (interests.user_id NOT IN (SELECT user.user_id
FROM friendshipBridge
       JOIN user ON friendshipBridge.user_id = user.user_id
       WHERE friendshipBridge.friend_id = '$sessionUserID'
       UNION ALL
 SELECT user.user_id
 FROM friendshipBridge
       JOIN user ON friendshipBridge.friend_id = user.user_id
WHERE friendshipBridge.user_id = '$sessionUserID'))
GROUP BY interests.user_id
ORDER BY rank DESC";

$run_recIntFriends = mysqli_query($con, $recIntFriendsQuery);

while($possibleRecommendation = mysqli_fetch_array($run_recIntFriends)) {
  $intRecName = $possibleRecommendation['user_firstName'] . " " .
   $possibleRecommendation['user_lastName'];
  $intRecCount = $possibleRecommendation['rank'];

  if($intRecCount > $averageInterests) {
    array_push($recommendedFriendsList, $intRecName);
    echo "
    <li class='left clearfix'>
        <span class='chat-img pull-left'>
            <img src='http://placehold.it/50/55C1E7/fff' alt='User Avatar' class='img-circle' />
        </span>
        <div class='chat-body clearfix'>
            <div class='header'>
                <strong class='primary-font'> $intRecName</strong>
            </div>
            <p>
                Hello...Please be my friend. We share $intRecCount interests.
            </p>
        </div>
    </li>
    ";
  }
}

 ?>
