<?php
session_start();
include("../includes/connection.php");
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

</head>

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
                    <h1 class="page-header">Members</h1>
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



								<i class='fa fa-user fa-fw'></i>Members

                    <!-- <i class="fa fa-user fa-fw"></i>Your Friends -->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="list-group">

                              <?php

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


                                //this checks the user_id's in the array
                                // echo "<script type='text/javascript'> alert('".json_encode($friends_user_id_array)."') </script>";



                              //////////////////////////////////////////

                              $get_members = "SELECT user.user_firstName, user.user_lastName, user.user_id FROM user";



                              $run_getMembers = mysqli_query($con, $get_members);
                              $check_members = mysqli_num_rows($run_getMembers); // this is the number of friends

                              // add another query here ??
                              // query to see if get status, first name and last name depending on the
                              // OR CREATE AN ARRA OF MEMBERS and compare

                              while ($rowPosts = mysqli_fetch_array($run_getMembers)) {



                                $thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                // $thisRelID = $rowPosts['']

                                // $friend_ids = array($rowPosts['user_id'] );

                                if($thisFriendID != $sessionUserID ) {
 								echo "
                                <li class='list-group-item clearfix'>
                                <a href='../home.php?userid=$thisFriendID'>


                                   	<div class='d-flex w-100 justify-content-between'>
                                   	 <img class='media-object pull-left'  src='http://placehold.it/50x50/000/fff' alt='Responsive image'/>
                                        <h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    </div>
                                    <p class='mb-1'>Display timestamp here or number of friends?</p>
                                </a>
                                ";
                                // ( $thisFirstName == 'Ping' || $thisFirstName == 'ghita')
                                if (!(in_array($thisFriendID, $friends_user_id_array))) {
                                    // if member is not in your friends list
                                	echo "
                                <a href=\"../functions/add_friends.php?thisFriend=$thisFriendID\" title='Send Friend Request'>

                                        <span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right' ></span>

                                </a>
                                </li>
                                 ";} else {

                                 	echo "
                                	<a href=\"../functions/nothing.php?thisFriend=$thisFriendID\" title='You are friends'>

                                        <span  class='btn btn-success  btn-xs glyphicon glyphicon-ok pull-right' ></span>

                                	</a>
                                	</li>
                                 ";
                                 }
                             }
                              };


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
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

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
