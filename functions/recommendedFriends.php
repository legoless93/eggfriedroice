<?php
include ("../includes/connection.php");
include("../functions/functions.php");

// $con = mysqli_connect("localhost","root","","team21","3306") or die("Connection not established");

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
  $thisRecID = $rowRecFriends['user_id'];
  $thisRecPhoto = $rowRecFriends['user_pic'];
  if(in_array($thisRecFriendName, $recommendedFriendsList)) {

  } else {
    array_push($recommendedFriendsList, $thisRecFriendName);
  echo "
  <li class='left clearfix'>
        <span class='chat-img pull-left'>
        <img src='../user/user_images/$thisRecPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
        </span>
        <div class='chat-body clearfix'>
        <div class='header'>
        <strong class='primary-font'>$thisRecFriendName</strong>
        </div>
        <button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-xs btn-default'> mutual friends "; getMut($sessionUserID, $thisRecID); echo "</button>
        <a class='send_product' data-id=\"$thisRecID\" href='javascript:void(0)'>
        <span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right'></span>
        </a>
        </div>
        </li>
  ";

}
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
