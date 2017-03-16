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

<?php

include("../template/theme/head.php");
?>


      <!-- added changes here ( removed the 2 js ones at the bottom of the page ) -->
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

      <!-- NAVIGATION TEMPLATE HERE -->
      <?php

      include("../template/theme/header.php");
      include("../template/theme/sidebar.php");

      ?>

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
                                			<a href='../profile.php?userid=$thisFriendID'>


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
                                				<a href='../profile.php?userid=$thisFriendID'>


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
                                				<a href='../profile.php?userid=$thisFriendID'>


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
                                				<a href='../profile.php?userid=$thisFriendID'>


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
                                				<a href='../profile.php?userid=$thisFriendID'>


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
    <!-- <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
