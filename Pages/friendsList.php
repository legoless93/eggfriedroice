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

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

     <!--  added changes here ( removed the 2 js ones at the bottom of the page )  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

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
     message: "Are you sure you want to Cancel ?",
     title: "<i class='glyphicon glyphicon-trash'></i> Cancel Request",
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
        
        bootbox.alert('Something Went Wrong ....');
                
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
     message: "Are you sure you want to Accept ?",
     title: "<i class='glyphicon glyphicon-trash'></i> Accept !",
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



         // load_friends();




        
        // USE THIS FOR RELOCATION *****
        // window.location='../home.php?userid=<?php echo $sessionUserID;?>';

        
        
       })
       .fail(function(){
        
        bootbox.alert('Something Went Wrong ....');

       

        // window.location ='../home.php?userid=$sessionUserID';
                
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


<!-- <script>
 $(document).ready(function(){   
$("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000);
});
</script> -->


<!-- jquery and ajax for Delete FRIEND REQUEST confirmation  w/ boot box-->

<script>
 $(document).ready(function(){
  
  $('.delete_product').click(function(e){
   
   e.preventDefault();
   
   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");
   
   bootbox.dialog({
     message: "Are you sure you want to Delete ?",
     title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
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
        // but copy this
        // $('#f_sent').html(response);
         // load_friends();  



        
       })
       .fail(function(){
        
        bootbox.alert('Something Went Wrong ....');
                
       })

       // init();
        // load_friends();  


              
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
     message: "Are you sure you want to Reject?",
     title: "<i class='glyphicon glyphicon-trash'></i> Reject Friend Quest",
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
 
 // $(document).on('click', '#getTest', function(){
 //  $('.count').html('');
 //  // uncomment below to read the notification
 //  // load_unseen_notification('yes');

 //  // uncomment below to not remove the notification 
 //  load_unseen_notification();


 // });



 
 setInterval(function(){ 
  load_friends(); 
 }, 5000);


 // $("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000);
 
});
</script>


<!-- <script type="text/javascript">
    function init(id='') {



        alert(id);
    }


    init("testttt");
</script>

 -->

 <!-- jQuery and ajax  for mutual friends -->
<script>
 $(document).ready(function(){

    $(document).on('click', '#getFriendUser', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#allfriends-content').html(''); // leave this div blank
     // $('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: '../functions/FriendsOfFriend.php',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          // $('#dynamic-content').html(''); // blank before load.
          $('#allfriends-content').html(data); // load here
          // $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#allfriends-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          // $('#modal-loader').hide();
     });

    });
});
</script>


</head>

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
           <!-- <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
<!--            <img src="ajax-loader.gif"> -->
           <!-- </div> -->
                            
           <!-- mysql data will be load here -->                          
           <div id="dynamic-content"></div>
        </div> 
                        
        <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        </div> 
                        
    </div> 
  </div>
</div>

<!-- modal for viewing ALL their friends -->
<div id="view-friends-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog"> 
     <div class="modal-content">  
   
        <div class="modal-header"> 
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
           <h4 class="modal-title">
           <i class="glyphicon glyphicon-user"></i> Their Friends (but mutual code atm)
           </h4> 
        </div> 
            
        <div class="modal-body">                     
           <!-- <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
<!--            <img src="ajax-loader.gif"> -->
           <!-- </div> -->
                            
           <!-- mysql data will be load here -->                          
           <div id="allfriends-content"></div>
        </div> 
                        
        <div class="modal-footer"> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        </div> 
                        
    </div> 
  </div>
</div>




<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">MyBeboSpaceBook</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle test" data-toggle="dropdown" href="#" id='getTest'>
                      <!--   <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a> -->
                    <span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="fa fa-bell fa-fw" style="font-size:18px;"></span></a>
                    <ul class="dropdown-menu dropdown-alerts" id='d_list'>
                        

                    </ul>
                    <!-- <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul> -->
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id='logOutD'>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../functions/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <form class="input-group custom-search-form" action ="Pages/SearchResult.php" method="GET">
                                <input type="text" name="query" class="form-control" placeholder="Search For Friends" >
                                <span class="input-group-btn">



                              <!-- <a href='Pages/SearchResult.php' name='searchIT' type='submit' class='btn btn-default' ><span class='glyphicon glyphicon-search'></span></a>
                                 -->
                            <input type="submit" value="Search" class='btn btn-default'/>
                            </span>


                            </form>

                           <!--  <form class="navbar-search pull-left" action="search.php" method="GET">
                                <input class="search-query" placeholder="Search" type="text" />
                            </form> -->

                            <!-- /input-group -->
                        </li>
                        <li>
                          <?php
                          echo "
                            <a href='../home.php?userid=$sessionUserID'><i class='fa fa-dashboard fa-fw'></i> Profile</a>
                            ";
                            ?>
                        </li>
                        <li>
                          <?php
                          echo "
                            <a href='../Pages/blog.php?userid=$sessionUserID'><i class='fa fa-bar-chart-o fa-fw'></i> Blog</a>
                            ";
                            ?>
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Photos</a>
                        </li>
                        <li>
                        <!-- CHANGES HERE ** -->
                        <?php
                          echo "
                            <a href='../Pages/friendsList.php?userid=$sessionUserID'><i class='fa fa-edit fa-fw'></i>Friends</a>
                            ";
                            ?>
                            <!-- <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a> -->
                        </li>
                        <li>
                          <li>
                          <!--  -->
                          <?php
                            echo "
                              <a href='../Pages/circles.php?userid=$sessionUserID'><i class='fa fa-bar-chart-o fa-fw'></i>Circles</a>
                              ";
                              ?>
                              <!-- <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a> -->
                          </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Settings</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Friends List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> Friend Requests Received
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                        <!-- where we might put the div id -->

                        <ul class="list-group" id="f_sent">

                        

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


                                    if ($theRequestStatus == '1'){
                                    echo "
                                    <li class='list-group-item clearfix'>
                                    <a href='../home.php?userid=$thisFriendID'>


                                    <div class='d-flex w-100 justify-content-between'>
                                     <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        <h5 class='mb-1'>$thisFN $thisLN</h5>
                                    </div>
                                    <p class='mb-1'>Display timestamp here or number of friends?</p>
                                </a>
                                ";



                                    


                                //  <a href=\"../functions/reject_request.php?thisFriend=$thisFriendID\" title='Reject Friend Request'>

                                //         <span  class='btn btn-danger  btn-xs glyphicon glyphicon-remove pull-right'></span>

                                // </a>"

                                echo "

                                <a class='reject_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                <span  class='btn btn-danger  btn-xs glyphicon glyphicon-remove pull-right'></span>

                                </a>"

                                ;

                                echo "

                                


                                  <a class='delete_friend_request_row' data-id=\"$thisFriendID\" href='javascript:void(0)' title='Accept Friend Request' >
                                <i class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right'></i>
                                </a>
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

            </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> Friend Requests Sent
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <ul class="list-group">


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



                                    if ($theRequestStatus == '1'){
                                    echo "
                                    <li class='list-group-item clearfix'>
                                    <a href='../home.php?userid=$thisFriendID'>


                                    <div class='d-flex w-100 justify-content-between'>
                                     <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        <h5 class='mb-1'>$thisFN $thisLN</h5>
                                    </div>
                                    <p class='mb-1'>Display timestamp here or number of friends?</p>
                                </a>
                                ";

                                

                                    // <a href=\"../functions/cancel_request.php?thisFriend=$thisFriendID\" title='Cancel Friend Request'>

                                    //     <span  class='label label-danger pull-right' style='padding:5px'>Cancel</span>

                                    // </a>
                                    echo "
                                    <a class='cancel_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                    <span class='label label-danger pull-right' style='padding:5px'>Cancel</span>
                                    </a>


                                <a href='#' title='Pending Friend Request'>

                                        <span  class='label label-primary pull-right' style='padding:5px'>Pending</span>

                                </a>

                                </li>
                                 ";
                            }

                            };





                        ?>


                        </ul>
                        </div>

                    </div>



            <!-- /.row -->
            <!-- friends list CHANGES here -->
            <div class="chat-panel panel panel-default">
                <div class="panel-heading" id="f_no">

               <!-- get friends here  -->
                    <!-- <i class="fa fa-user fa-fw"></i>Your Friends -->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body"  id="div1">
                <!--  *********** -->
                    <ul class="list-group" id='f_list'>

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


                                $friendTotal =  getTotalFriend($thisFriendID);
 								                 echo "
                                <li class='list-group-item clearfix'>
                                <a href='../home.php?userid=$thisFriendID'>


                                   	<div class='d-flex w-100 justify-content-between'>
                                   	 <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        <h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    </div>
                                    <p class='mb-1'>Display timestamp here or number of friends?</p>


                                </a>


                                <a class='delete_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                <i class='btn btn-danger  btn-xs glyphicon glyphicon-trash pull-right'></i>
                                </a>
                                


                                <a href='../Pages/blog.php?userid=$thisFriendID' title='Go to your friends blog'>

                                                <span  class='btn btn-primary  btn-xs glyphicon glyphicon-edit pull-right' ></span>

                                </a>

                                
                                
                                ";

                                echo "

                                  <button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View "; getMut($sessionUserID, $thisFriendID); echo "</button>

                                  <button data-toggle='modal' data-target='#view-friends-modal' data-id=\"$thisFriendID\" id='getFriendUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View Friends ($friendTotal) </button>

                                </li>
                                ";
                              
                              };

                                ?>

                                <!-- STUFF BEFORE delete edit goes after their name  -->
                                <!-- <a href=\"../functions/delete_friends.php?thisFriend=$thisFriendID\" title='Delete'>

                                        <span  class='btn btn-danger  btn-xs glyphicon glyphicon-trash pull-right' ></span>

                                </a> -->

             

                             <!--    echo "
                                <a href='home.php?userid=$thisFriendID' class='list-group-item '>
                                    <i class='fa fa-user fa-fw'></i> $thisFirstName $thisLastName
                                    </span>
                                </a>
                                "; -->
                    </ul>
                </div>
                <!-- /.panel-body -->
                <!-- /.panel-footer -->
            </div>

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
