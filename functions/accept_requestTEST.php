<?php
session_start();
include("../includes/connection.php");
include("../functions/functions.php");

if(isset($_REQUEST['accept'])) {

    $thisFriend = $_REQUEST['accept'];


    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];
    $FirstName = $row['user_firstName'];
    $LastName = $row['user_lastName'];


    $update_accept_friend = "DELETE FROM friendrequests WHERE (sender_id='$thisFriend' AND receiver_id='$sessionUserID') ";
    $accept_friend = "INSERT INTO friendshipbridge (user_id, friend_id) VALUES ('$sessionUserID','$thisFriend')";

    $accepted_friend_notification = "INSERT INTO notifications(notification_text, status, receiver_id ) VALUES ('Friend Request accepted from $FirstName $LastName','0', '$thisFriend' )";



    $run_accept_friend = mysqli_query($con, $accept_friend);
    $run_update_accept_friend = mysqli_query($con, $update_accept_friend);
    $run_accepted_friend_notification =mysqli_query($con, $accepted_friend_notification);



 	if ($run_accept_friend && $run_update_accept_friend && $run_accepted_friend_notification ){
    	// echo "<script>alert('Friend request accepted!!!')</script>";
     //    echo "<script>window.open('../Pages/friendsList.php', '_self')</script>";



 		/// friend list query

 		$get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5);


                              $output='';

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {


                              	$thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                $thisPhoto = $rowPosts['user_pic'];

                                $mutuals = getMut($sessionUserID, $thisFriendID);
                                $friendTotal =  getTotalFriend($thisFriendID);

 								$output .= "
                <li class='list-group-item clearfix'>

                      <span class='chat-img pull-left'>
                      <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                      &nbsp;
                      </span>
                      <a href='../Pages/profile.php?userid=$thisFriendID'>
                      <strong class='primary-font'>$thisFirstName $thisLastName</strong>
                      </a>
                      <br>
                      <a class='delete_product' data-id='$thisFriendID' href='javascript:void(0)'>
                      <div class='pull-right'>
                      <i class='fa fa-trash fa-fw' style='color:#d9534f'></i>
                      </div>
                      </a>
                      <a href='../Pages/blog.php?userid=$thisFriendID'>
                      <div class='pull-right'>
                      <i class='fa fa-rss fa-fw'></i>
                      </div>
                      </a>

                      <div class='pull-left'>
                      <a data-toggle='modal' data-target='#view-modal' data-id='$thisFriendID' id='getUser'>$mutuals mutual friends </a>
                      </div>
                      <br>
                      <a data-toggle='modal' data-target='#view-friends-modal' data-id=\"$thisFriendID\" id='getFriendUser'>$friendTotal friend(s)</a>

                      <br>


                      </li>
                                ";


    }

    echo $output;

  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!--  added changes here ( removed the 2 js ones at the bottom of the page )  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script>
 $(document).ready(function(){

  $('.delete_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure?",
     title: "<i class='glyphicon glyphicon-trash'></i> Deleting friend!",
     buttons: {
    success: {
      label: "No",
      className: "btn-success",
      callback: function() {
      $('.bootbox').modal('hide');
      }
    },
    danger: {
      label: "Delete!",
      className: "btn-danger",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/deleteFriendTest.php',
        data: 'delete='+pid

       })
       .done(function(response){

        bootbox.alert(response);
        parent.fadeOut('slow');

        // keep this *****************************************
        // but copy this
        // $('#f_sent').html(response);

        // this updates the dropdown for notifications
        $('#getTest').dropdown();
        //updates the dropdown for logout
        $('#logOutD').dropdown();

          $('.dropdown-toggle').dropdown();

       })
       .fail(function(){

        bootbox.alert('Something Went Wrong ....');

       })

      }
    }
     }
   });


  });

 });

</script>


<!-- script for fetching the notifications -->
<script>
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../functions/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json"

    })

   .done(function(data){


    // <?php
    // echo "<script>alert('in success!!!')</script>";
    // ?>


    // if(data.unseen_notification > 0)
    // {
    //  $('.count').html(data.unseen_notification);
    // }
    $('#d_list').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }

   })

   .fail(function(){
          $('#d_list').html('get NOTIFICATIONS failed WHYYYYYYy');
          // $('#modal-loader').hide();
     });
   }

  load_unseen_notification();

 // $('#comment_form').on('submit', function(event){
 //  event.preventDefault();
 //  if($('#subject').val() != '' && $('#comment').val() != '')
 //  {
 //   var form_data = $(this).serialize();
 //   $.ajax({
 //    url:"insert.php",
 //    method:"POST",
 //    data:form_data,
 //    success:function(data)
 //    {
 //     $('#comment_form')[0].reset();
 //     load_unseen_notification();
 //    }
 //   });
 //  }
 //  else
 //  {
 //   alert("Both Fields are Required");
 //  }
 // });

 $(document).on('click', '#getTest', function(){
  $('.count').html('');
  // uncomment below to read the notification
  // load_unseen_notification('yes');

  // uncomment below to not remove the notification
  load_unseen_notification();


 });




 // setInterval(function(){
 //  load_unseen_notification();;
 // }, 5000);


 // $("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000);

});
</script>
</head>


<body>


</body>
</html>
