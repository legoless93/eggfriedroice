<?php
session_start();
include("../includes/connection.php");
include("../functions/functions.php");
// include("../functions/new_post.php");
// include("../functions/delete_post.php");
// include("../functions/retrieve_posts.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

// echo "<script>alert('session user id: $sessionUserID !!!')</script>";

// if(isset($_GET['userid'])) {
//   $userID = $_GET['userid'];
// }

// if(isset($_GET[''])){
// }

?>


<!-- <!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>

<h1>HEY THERE u fuck  </h1>


</body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<?php

include("../template/theme/head.php");

?>

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


<!-- jquery and ajax for cancel friend confirmation  w/ boot box-->

<script>
 $(document).ready(function(){

  $('.cancel_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to cancel?",
     title: "<i class='glyphicon glyphicon-trash'></i>Cancel Request",
     buttons: {
    success: {
      label: "No",
      className: "btn-success",
      callback: function() {
      $('.bootbox').modal('hide');
      }
    },
    danger: {
      label: "Yes",
      className: "btn-danger",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/cancel_request.php',
        data: 'cancel='+pid

       })
       .done(function(response){

        bootbox.alert(response);
        parent.fadeOut('slow');


         // this updates the dropdown for notifications
         $('#getTest').dropdown();
         //updates the dropdown for logout
         $('#logOutD').dropdown();

        // keep this *****************************************
        // but copy this
        // $('#f_sent').html(response);

       })
       .fail(function(){

        bootbox.alert('Something went wrong...');

       })

      }
    }
     }
   });


  });

 });

</script>



<!-- BOOTBOX FOR accepting friend request -->
<script>
 $(document).ready(function(){

  $('.delete_friend_request_row').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to accept?",
     title: "<i class='glyphicon glyphicon-ok'></i> Accept friend request!",
     buttons: {
    success: {
      label: "Cancel",
      className: "btn-success",
      callback: function() {
      $('.bootbox').modal('hide');
      }
    },
    danger: {
      label: "Yes",
      className: "btn-primary",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/accept_requestTEST.php',
        data: 'accept='+pid

       })
       .done(function(response){

        bootbox.alert('You are now friends');
        parent.fadeOut('slow');

        // keep this *****************************************
        // but copy this
        $('#f_list').html(response);


        // this updates the dropdown for notifications
         $('#getTest').dropdown();
         //updates the dropdown for logout
         $('#logOutD').dropdown();

       })
       .fail(function(){

        bootbox.alert('Something Went Wrong2 ....');


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


 $(document).on('click', '#getTest', function(){
  $('.count').html('');

  // uncomment below to read the notification
  load_unseen_notification('yes');

  // uncomment below to not remove the notification
  // load_unseen_notification();


 });


});
</script>


<!-- jquery and ajax for Delete FRIEND REQUEST confirmation  w/ boot box-->

<script>
 $(document).ready(function(){

  $('.delete_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to delete?",
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


        // load_friends();
        // init();
        bootbox.alert(response);
        parent.fadeOut('slow');

        // this updates the dropdown for notifications
         $('#getTest').dropdown();
         //updates the dropdown for logout
         $('#logOutD').dropdown();

        // keep this *****************************************

       })
       .fail(function(){

        bootbox.alert('Something Went Wrong ....');

       })


      }
    }
     }
   });


  });

// init();


 });

</script>



<!-- jquery and ajax for REJECT FRIEND REQUEST ( as receiver ) confirmation  w/ boot box-->

<script>
 $(document).ready(function(){

  $('.reject_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to reject?",
     title: "<i class='glyphicon glyphicon-trash'></i> Rejecting friend request",
     buttons: {
    success: {
      label: "No",
      className: "btn-success",
      callback: function() {
      $('.bootbox').modal('hide');
      }
    },
    danger: {
      label: "Yes",
      className: "btn-danger",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/reject_request.php',
        data: 'reject='+pid

       })
       .done(function(response){

        bootbox.alert(response);
        parent.fadeOut('slow');


         // this updates the dropdown for notifications
         $('#getTest').dropdown();
         //updates the dropdown for logout
         $('#logOutD').dropdown();

        // keep this *****************************************
        // but copy this
        // $('#f_sent').html(response);

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


<!-- script for fetching friend number  -->
<script type="text/javascript">
$(document).ready(function(){

 function load_friends(id = '')
 {
  $.ajax({
   url:"../functions/friendNO.php",
   method:"POST",
   data:{id:id},
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
    $('#f_no').html(data);
    // if(data.unseen_notification > 0)
    // {
    //  $('.count').html(data.unseen_notification);
    // }

   })

   .fail(function(){
          $('#f_no').html('failed friends no');
          // $('#modal-loader').hide();
     });
   }

  load_friends();



 setInterval(function(){
  load_friends();
 }, 5000);


 // $("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000);

});
</script>


<!-- modal for viewing mutual friends  -->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
     <div class="modal-content">

        <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h4 class="modal-title">
           <i class="glyphicon glyphicon-user"></i> Mutual Friends
           </h4>
        </div>

        <div class="modal-body">

           <!-- mysql data will be load here -->
           <div id="dynamic-content"></div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

    </div>
  </div>
</div>



<body>

    <div id="wrapper">


      <!-- NAVIGATION TEMPLATE HERE -->
      <?php


      include("../template/theme/header.php");
      include("../template/theme/sidebar.php");

      ?>

        <div id="page-wrapper">
            <!-- <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Friends List</h1>
                </div>

            </div> -->
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
              <br>
              <div class="col-lg-6">
              <!-- friends list CHANGES here -->
              <div class="chat-panel panel panel-primary">
                  <div class="panel-heading" id="f_no">

                 <!-- get friends here  -->
                      <!-- <i class="fa fa-user fa-fw"></i>Your Friends -->
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body" style="height:550px">
                  <!--  *********** -->
                  <ul class="chat" id='f_list'>

                                <?php

                                $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                    JOIN user ON friendshipBridge.user_id = user.user_id
                                                    WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                    UNION ALL
                                                    SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                    JOIN user ON friendshipBridge.friend_id = user.user_id
                                                    WHERE friendshipBridge.user_id = '$sessionUserID'";
                                $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                                $check_myFriends5 = mysqli_num_rows($run_myFriends5); // this is the number of friends

                                // add another query here ??
                                //

                                while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {

                                  $thisFriendID = $rowPosts['user_id'];
                                  $thisFirstName = $rowPosts['user_firstName'];
                                  $thisLastName = $rowPosts['user_lastName'];
                                  $thisPhoto = $rowPosts['user_pic'];
                                  // $thisRelID = $rowPosts['']
                                  $mutuals = getMut($sessionUserID, $thisFriendID);
   								echo "

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
                        <a data-toggle='modal' data-target='#view-modal' data-id='$thisFriendID' id='getUser'> mutual friends ($mutuals) </a>
                        </div>

                        <br>


                        </li>

                                  ";

                                };

                                  ?>

                      </ul>
                  </div>
                  <!-- /.panel-body -->
                  <!-- /.panel-footer -->
              </div>
            </div>
              <!-- HERE 1 -->
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          Requests Received
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:250px">
                        <!-- where we might put the div id -->

                        <ul class="chat" id="f_sent">



                        <?php

                            // get requests that have been received
                            $get_requests_as_receiver = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.sender_id = user.user_id WHERE friendrequests.receiver_id = '$sessionUserID'";

                            $run_requests_as_receiver = mysqli_query($con, $get_requests_as_receiver);

                            while ($rowPosts = mysqli_fetch_array($run_requests_as_receiver)){



                                    $thisFN = $rowPosts['user_firstName'];
                                    $thisLN = $rowPosts['user_lastName'];
                                    $thisFriendID = $rowPosts['user_id'];
                                    $thisPhoto = $rowPosts['user_pic'];

                                    $get_request_status = "SELECT friendrequests.request_status FROM friendrequests WHERE (friendrequests.sender_id = '$thisFriendID' AND friendrequests.receiver_id = '$sessionUserID'  )";

                                    $run_request_status = mysqli_query($con, $get_request_status);

                                    $check = mysqli_num_rows($run_request_status);

                                    if($check == 1) {

                                    $rowUsers = mysqli_fetch_array($run_request_status);
                                    $theRequestStatus = $rowUsers['request_status'];

                                    // echo "<script>alert('the request status is: $theRequestStatus')</script>";
                                    };

                                    $mutuals = getMut($sessionUserID, $thisFriendID);

                                    if ($theRequestStatus == '1'){
                                    echo "

                                    <li class='list-group-item clearfix'>

                                          <span class='chat-img pull-left'>
                                          <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                          &nbsp;
                                          </span>
                                          <a href='../Pages/profile.php?userid=$thisFriendID'>
                                          <strong class='primary-font'>$thisFN $thisLN</strong>
                                          </a>
                                          <br>
                                          <a class='reject_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                          <span  class='btn btn-danger  btn-xs glyphicon glyphicon-remove pull-right'></span>
                                          </a>
                                          <a class='delete_friend_request_row' data-id=\"$thisFriendID\" href='javascript:void(0)' title='Accept Friend Request'>
                                          <i class='btn btn-primary  btn-xs glyphicon glyphicon-check pull-right'></i>
                                          </a>

                                          <div class='pull-left'>
                                          <a data-toggle='modal' data-target='#view-modal' data-id='$thisFriendID' id='getUser'> mutual friends ($mutuals) </a>
                                          </div>
                                          <br>

                                          </li>
                                          ";




                                 }

                            };



                        ?>

                        </ul>

                                  <!-- <button data-toggle='modal' data-target='#accept-modal' data-id=\"$thisFriendID\" id='getSenderUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-plus'></i> Accept</button>

                                </li> -->


                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Requests Sent
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" style="height:250px">

                    <ul class="chat">


<!--
                        // // get requests that have been received
                        // $get_requests = "SELECT user.user_firstName, user.user_lastName, user.user_id FROM friendrequests JOIN user ON friendrequests.receiver_id = user.user_id WHERE friendrequests.sender_id = '$sessionUserID";
-->

                    <?php

                        // get requests that have been SENT
                        $get_requests = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.receiver_id = user.user_id WHERE friendrequests.sender_id = '$sessionUserID'";

                        $run_requests = mysqli_query($con, $get_requests);

                        while ($rowPosts = mysqli_fetch_array($run_requests)){

                                $thisFN = $rowPosts['user_firstName'];
                                $thisLN = $rowPosts['user_lastName'];
                                $thisFriendID = $rowPosts['user_id'];
                                $thisPhoto = $rowPosts['user_pic'];


                                $get_request_status = "SELECT friendrequests.request_status FROM friendrequests WHERE (friendrequests.sender_id = '$sessionUserID' AND friendrequests.receiver_id = '$thisFriendID'  )";

                                $run_request_status = mysqli_query($con, $get_request_status);

                                $check = mysqli_num_rows($run_request_status);

                                if($check == 1) {

                                $rowUsers = mysqli_fetch_array($run_request_status);
                                $theRequestStatus = $rowUsers['request_status'];

                                // echo "<script>alert('the request status is: $theRequestStatus')</script>";
                                };


                                $mutuals = getMut($sessionUserID, $thisFriendID);

                                if ($theRequestStatus == '1'){
                                echo "

                                <li class='list-group-item clearfix'>

                                      <span class='chat-img pull-left'>
                                      <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                      &nbsp;
                                      </span>
                                      <a href='../Pages/profile.php?userid=$thisFriendID'>
                                      <strong class='primary-font'>$thisFN $thisLN</strong>
                                      </a>
                                      <br>
                                      <a class='cancel_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                      <span class='label label-danger pull-right' style='padding:5px'>Cancel</span>
                                      </a>
                                      <a href='#' title='Pending Friend Request'>
                                      <span  class='label label-primary pull-right' style='padding:5px'>Pending</span>
                                      </a>

                                      <a data-toggle='modal' data-target='#view-modal' data-id='$thisFriendID' id='getUser'> mutual friends ($mutuals) </a>
                                      <br>

                                      </li>


                             ";
                        }

                        };





                    ?>


                    </ul>
                    </div>

                </div>
              </div>

            </div>
            <!-- END OF ROW ABOVE -->


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
