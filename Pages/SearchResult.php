 <?php

session_start();
include("../includes/connection.php");
include("../functions/functions.php");
// if(isset($_GET['thisFriend'])){


// $query = $_GET['query'];

	// echo "<script>alert('$query')</script>";




$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];




?>

<!-- <!DOCTYPE html>
<html>
<head>
	<title>Search Result</title>
</head>
<body>

<h1>search results mate</h1>

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


    <script>
 $(document).ready(function(){
  
  $('.send_product').click(function(e){
   
   e.preventDefault();
   
   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");
   
   bootbox.dialog({
     message: "Are you sure you want to send a Friend Request ?",
     title: "<i class='glyphicon glyphicon-trash'></i> Send Friend Request",
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


<!-- viewing mutual friends -->
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


</head>



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
           <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img src="ajax-loader.gif">
           </div>
                            
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
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
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
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
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
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Circles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Circle 1</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Circle 2</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Circle 3</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
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
                    <h1 class="page-header">Search Results</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            </div>





            <!-- /.row -->
            <!-- friends list CHANGES here -->
            <div class="chat-panel panel panel-default">
                <div class="panel-heading">

<!--                 <?php

                              $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5);

								echo "<i class='fa fa-user fa-fw'></i>Your Friends ($check_myFriends5)"

                              ?> -->

                     <i class="fa fa-user fa-fw"></i>Search Results
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="list-group">

                              <?php

                              // $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id from friendshipBridge
                              //                     JOIN user ON friendshipBridge.user_id = user.user_id
                              //                     WHERE friendshipBridge.friend_id = '$sessionUserID'
                              //                     UNION ALL
                              //                     SELECT user.user_firstName, user.user_lastName, user.user_id FROM friendshipBridge
                              //                     JOIN user ON friendshipBridge.friend_id = user.user_id
                              //                     WHERE friendshipBridge.user_id = '$sessionUserID'";
                              // $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              // $check_myFriends5 = mysqli_num_rows($run_myFriends5); // this is the number of friends

                              // add another query here ??
                              //

                              // get requests that have been SENT
                            	$get_requests = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.receiver_id = user.user_id WHERE friendrequests.sender_id = '$sessionUserID'";

                            	$run_requests = mysqli_query($con, $get_requests);

                            	$request_sent_user_id_array = array();

                            	while ($rowPosts = mysqli_fetch_array($run_requests)){
                            	
                            		 $request_sent_user_id_array[] = $rowPosts['user_id'];
                            	}

                            	/////

                            	// get the requests that have been received

                            	$get_requests_as_receiver = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.sender_id = user.user_id WHERE friendrequests.receiver_id = '$sessionUserID'";

                            	$run_requests_as_receiver = mysqli_query($con, $get_requests_as_receiver);

                            	$request_received_user_id_array = array();

                            	while ($rowPosts = mysqli_fetch_array($run_requests_as_receiver)){
                            	
                            		 $request_received_user_id_array[] = $rowPosts['user_id'];
                            	}


                              /////

                               $get_myFriends5 = "SELECT user.user_id from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_id FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);

                              $friends_user_id_array = array();

                                while($row = mysqli_fetch_array($run_myFriends5)) {

                                      // $friends_user_id_array[] = implode(" ", $row['user_id']);

                                      $friends_user_id_array[] = $row['user_id'];
                                }

                                ////////////////

                              $query = $_GET['query'];

                              $min_length = 3;


                              if(strlen($query) >= $min_length){

                              	 $query = htmlspecialchars($query);
        							// changes characters used in html to their equivalents, for example: < to &gt;

       							 $query = mysqli_real_escape_string($con,$query);

       							 // makes sure nobody uses SQL injection ???

       							 // $results_of_query = "SELECT user_id, user_firstName, user_lastName FROM user WHERE user_firstName OR user_lastName LIKE  '%$query%'"; // use this instead ? '%".$query."%'

       							 $results_of_query = "SELECT * FROM user WHERE CONCAT(user_firstName, ' ', user_lastName) LIKE '%".$query."%'";
       							 // performance may be an issue

       							 $run_result_of_query = mysqli_query($con, $results_of_query);

       							 $check_result_of_query = mysqli_num_rows($run_result_of_query); // gives the number of rows ie searhc results


       							 if ($check_result_of_query > 0){

       							 	while ( $rowPosts = mysqli_fetch_array($run_result_of_query)) {


       							 		$thisFriendID = $rowPosts['user_id'];
                                		$thisFirstName = $rowPosts['user_firstName'];
                                		$thisLastName = $rowPosts['user_lastName'];
                                    $thisPhoto = $rowPosts['user_pic'];


                                		if ($thisFriendID == $sessionUserID){

                                			// if the result is you

                                			echo "
                                			<li class='list-group-item clearfix'>
                                			<a href='../home.php?userid=$thisFriendID'>


                                   			<div class='d-flex w-100 justify-content-between'>
                                   	 		<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        	<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    		</div>
                                    		<p class='mb-1'>Display timestamp here or number of friends?</p>
                                			</a>
                                			";



                                		} else if ((in_array($thisFriendID, $friends_user_id_array))){

                                			// if the results are already in your friends list

                                			echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../home.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                    			<p class='mb-1'>Display timestamp here or number of friends?</p>
                                				</a>
                                			";
                                			echo " 
                                				<a href='../Pages/blog.php?userid=$thisFriendID' title='Go to your friends blog'>

                                        		<span  class='btn btn-primary  btn-xs glyphicon glyphicon-edit pull-right' ></span>

                                				</a>


                                				<a href='#' title='You are friends'>

                                        		<span  class='btn btn-success  btn-xs glyphicon glyphicon-ok pull-right' ></span>

                                				</a>

                                 			";

                                 			echo "

                                  		<button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View "; getMut($sessionUserID, $thisFriendID); echo "</button>

                                		</li>
                                		";


                                 			// *** need to add another else here to check if you have send a friend request to them OR if you have received one from them - 

                                		} 
                                		else if((in_array($thisFriendID, $request_sent_user_id_array))) {

                                			// if you have  pending friend request ( sent )
                                			echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../home.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                    			<p class='mb-1'>Display timestamp here or number of friends?</p>
                                				</a>
                                			";

                                			echo "
                                			<a href='#' title='Pending Friend Request'>

                                        	<span  class='label label-primary pull-right' style='padding:5px'>Pending</span>

                              				</a>


                                 			";
                                 			echo "

                                  		<button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View "; getMut($sessionUserID, $thisFriendID); echo "</button>

                                		</li>
                                		";


                                		} 
                                		else if((in_array($thisFriendID, $request_received_user_id_array))) {

                                			// if you have  pending friend request ( sent )
                                			echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../home.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                    			<p class='mb-1'>Display timestamp here or number of friends?</p>
                                				</a>
                                			";

                                			echo "
                                			<a href='' title='Pending Friend Request'>

                                        	<span  class='label label-primary pull-right' style='padding:5px'>They have sent you a friend request</span>

                              				</a>


                                 			";

                                 			echo "

                                  		<button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View "; getMut($sessionUserID, $thisFriendID); echo "</button>

                                		</li>
                                		";


                                		} 
                                			else {

                                			// they are not your friend

                                			echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../home.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                    			<p class='mb-1'>Display timestamp here or number of friends?</p>
                                				</a>
                                			";
                                				
                                			// <a href=\"../functions/add_friends.php?thisFriend=$thisFriendID\" title='Send Friend Request'>

                                   //      		<span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right' ></span>

                                			// </a>

                                			echo "
                                			<a class='send_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                			<span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right'></span>

                                			</a>

                                 			";

                                 			echo "

                                  			<button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> View "; getMut($sessionUserID, $thisFriendID); echo "</button>

                                			</li>
                                			";


                                		}


       							 	}

       							 } else {

       							 	echo "<script>alert('No matching results')</script>";
       							 }

                              } else {

                              	echo "<script>alert('The minimum search term is $min_length')</script>";

                              }



                                ?>

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
