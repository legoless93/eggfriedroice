<?php
include ("../includes/connection.php");
include("../functions/functions.php");


$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

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

$recIntFriendsQuery = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic, interests.user_id, interests.interest, COUNT(*) rank
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

  $thisRecID = $possibleRecommendation['user_id'];
  $thisRecPhoto = $possibleRecommendation['user_pic'];

  if($intRecCount > $averageInterests) {
    array_push($recommendedFriendsList, $intRecName);
    echo "

    <li class='left clearfix'>
          <h5 style='text-align: center'>You share $intRecCount interests!</h5><br>
          <span class='chat-img pull-left'>
          <img src='../user/user_images/$thisRecPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
          </span>
          <div class='chat-body clearfix'>
          <div class='header'>
          <strong class='primary-font'>$intRecName</strong>
          </div>
          <button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-xs btn-default'> mutual friends "; getMut($sessionUserID, $thisRecID); echo "</button>
          <a class='send_product' data-id=\"$thisRecID\" href='javascript:void(0)'>
          <span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right'></span>
          </a>
          </div>
          <div>
          </div>
          </li>
    ";
  }
}

 ?>

 <!-- modal for viewing mutual friends  -->
 <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">
            <i class="glyphicon glyphicon-user"></i> Mutual Friends
            </h4>
         </div>

         <div class="modal-body">
            <div id="dynamic-content"></div>
         </div>

         <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>

     </div>
   </div>
 </div>

 <!-- jQuery and ajax  for mutual friends -->
 <script>
  $(document).ready(function(){

     $(document).on('click', '#getUser', function(e){

      e.preventDefault();

      var uid = $(this).data('id'); // get id of clicked row

      $('#dynamic-content').html(''); // leave this div blank
      // $('#modal-loader').show();      // load ajax loader on button click

      $.ajax({
           url: '../functions/Mutual_Friends.php',
           type: 'POST',
           data: 'id='+uid,
           dataType: 'html'
      })
      .done(function(data){
           console.log(data);
           // $('#dynamic-content').html(''); // blank before load.
           $('#dynamic-content').html(data); // load here
           // $('#modal-loader').hide(); // hide loader
      })
      .fail(function(){
           $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
           // $('#modal-loader').hide();
      });

     });
 });
 </script>

 <script>
 $(document).ready(function(){

  $('.send_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to send a Friend Request ?",
     title: "<i class='fa fa-user fa-fw'></i> Send Friend Request",
     buttons: {
    danger: {
      label: "Yes",
      className: "btn-primary",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/add_friends.php',
        data: 'send='+pid

       })
       .done(function(response){

        // parent.fadeOut('slow');
        window.location='../Pages/friendsList.php?userid=<?php echo $sessionUserID;?>';
        bootbox.alert(response);


        // window.location='../Pages/friendsList.php?userid=<?php echo $sessionUserID;?>';
        // ../Pages/friendsList.php'

         // <a href='Pages/friendsList.php?userid=$sessionUserID'><i class='fa fa-edit fa-fw'></i>Friends</a>
       })
       .fail(function(){

        bootbox.alert('Something Went Wrong ....');

       })

        // window.location='../Pages/friendsList.php?userid=<?php echo $sessionUserID;?>';


      }
    }
     }
   });


  });

 });

 </script>
