<?php
session_start();
include("../includes/connection.php");

include("../functions/upload_photo.php");
include("../functions/new_collection.php");
include("../functions/delete_photo.php");
include("../functions/like_photo.php");
// include("../functions/collection_privacy.php");


$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

include("../functions/checkPrivacy.php");

?>


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

      <!-- gallery style -->
    <link rel="stylesheet" href="../styles/gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="css/blueimp-gallery.css">
    <link rel="stylesheet" href="css/blueimp-gallery-indicator.css">
    <link rel="stylesheet" href="css/demo/demo.css">

    <!-- button style -->
    <link rel="stylesheet" href="../styles/button/buttons.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (primary)</span>
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
                          <?php
                          echo "
                            <a href='../Pages/photocollection.php?userid=$sessionUserID'><i class='fa fa-bar-chart-o fa-fw'></i> Photos</a>
                            ";
                            ?>
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
                        <!-- CHANGES HERE ** -->
                        <?php
                          echo "
                            <a href='../Pages/Members.php?userid=$sessionUserID'><i class='fa fa-edit fa-fw'></i>Members</a>
                            ";
                            ?>
                            <!-- <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a> -->
                        </li>
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

<<<<<<< HEAD
=======
<!-- Page Content -->

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="container-fluid text-left" style="margin-top:30px;">
                <ul id="myTabs" class="nav nav-tabs" role="tablist" style="text-left">
                    <!--collection tab -->
                    <li role="presentation" class="active"><a href="#collection" aria-controls="collection" role="tab" data-toggle="tab">Photo Collection</a></li>
                    <!-- photo tab-->
                    <li role="presentation"><a href="#photo" aria-controls="photo" role="tab" data-toggle="tab">Photo</a></li>
                </ul>

                <div class="row" sytle="margin-top:30px">
                    <div class="tab-content" >

                        <!--  collection tab-->
                        <div role="tabpanel" class="tab-pane fade in active" id="collection">

                          <?php
                          if($userID == $sessionUserID) {
                        echo "
                            <div class='col-lg-12 col-md-12 col-sm-12 col'>
                                <div class='row' style='margin-top:10px;'>
                                    <div class='container-fluid' style='margin-top:10px;'>
                                        <a class=' btn btn-primary'  role='button' data-toggle='collapse' href='#addcollection' aria-expanded='false' aria-controls='collapseExample1'>
                                        Add new collection</a>

                                        <div class='collapse' id='addcollection'>
                                            <div class='panel-body'>
                                                <form  method='post'>
                                                    <div class='form-group' id='post_form'>
                                                        <label>1.collection name:</label>
                                                        <input method='post' name='collection_name' type='string' maxlength='30' class='form-control' placeholder='enter your collection name' required = 'required' data-validation-maxlength-message='Maximum Length is 30 characters'>
                                                    </div>
                                                    <label>2.Who can see my collection:</label>

                                                    <div class = 'form-group'>
                                                      <div class='radio'>
                                                      <label class='radio-inline'>
                                                        <input type='radio' name='collectionPrivacy' id='showToPublic' value='public' checked >Public
                                                      </label>
                                                      </div>
>>>>>>> origin/master-temp

      <!-- Page Content -->

      <div id="page-wrapper">
          <div class="container-fluid">
              <div class="row text-center">
                  <div class="container-fluid text-left" style="margin-top:30px;">
                      <ul id="myTabs" class="nav nav-tabs" role="tablist" style="text-left">
                          <!--collection tab -->
                          <li role="presentation" class="active"><a href="#collection" aria-controls="collection" role="tab" data-toggle="tab">Photo Collection</a></li>
                          <!-- photo tab-->
                          <li role="presentation"><a href="#photo" aria-controls="photo" role="tab" data-toggle="tab">Photo</a></li>
                      </ul>

                      <div class="row" sytle="margin-top:30px">
                          <div class="tab-content" >

                              <!--  collection tab-->
                              <div role="tabpanel" class="tab-pane fade in active" id="collection">

                                <?php
                                if($userID == $sessionUserID) {
                              echo "
                                  <div class='col-lg-12 col-md-12 col-sm-12 col'>
                                      <div class='row' style='margin-top:10px;'>
                                          <div class='container-fluid' style='margin-top:10px;'>
                                              <a class=' btn btn-primary'  role='button' data-toggle='collapse' href='#addcollection' aria-expanded='false' aria-controls='collapseExample1'>
                                              Add new collection</a>

                                              <div class='collapse' id='addcollection'>
                                                  <div class='panel-body'>
                                                      <form  method='post'>
                                                          <div class='form-group' id='post_form'>
                                                              <label>1.collection name:</label>
                                                              <input method='post' name='collection_name' type='string' maxlength='30' class='form-control' placeholder='enter your collection name' required = 'required' data-validation-maxlength-message='Maximum Length is 30 characters'>
                                                          </div>
                                                          <label>2.Who can see my collection:</label>

                                                          <div class = 'form-group'>
                                                            <div class='radio'>
                                                            <label class='radio-inline'>
                                                              <input type='radio' name='collectionPrivacy' id='showToPublic' value='public' checked >Public
                                                            </label>
                                                            </div>

                                                            <div class='radio'>
                                                            <label class='radio-inline'>
                                                              <input type='radio' name='collectionPrivacy' id='showToPrivacy' value='private' checked>Private
                                                            </label>
                                                            </div>

                                                            <div class='radio'>
                                                            <label class='radio-inline'>
                                                              <input type='radio' name='collectionPrivacy' id='showToFriends' value='friends' checked>My Friends
                                                            </label>
                                                            </div>

                                                            <div class='radio'>
                                                            <label class='radio-inline'>
                                                              <input type='radio' name='collectionPrivacy' id='showToCircle' value='circle' checked>My Circle
                                                            </label>
                                                            </div>

                                                            <div class='radio'>
                                                            <label class='radio-inline'>
                                                              <input type='radio' name='collectionPrivacy' id='showToFoF' value='FoF' checked>Friends of my Friends
                                                            </label>
                                                            </div>
                                                          </div>

                                                          <div class='form-group' style ='margin-top:5px;'>
                                                              <button name='createCollection' type='submit' class='btn btn-primary'>Create</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                              <script>
                                                $(function () { $('input,select,textarea').not('[type=submit]').jqBootstrapValidation(); } );
                                              </script>

                                              <hr>
                                        </div>
                                    </div>
                                </div>
                                  ";
                                  };
                              ?>


                                  <!--collection gallery-->
                                  <div class="row form-group"></div>

                                  <?php
                                  $get_collection =  "SELECT * FROM photoCollections WHERE user_id = '$userID' ORDER BY collection_id DESC";
                                  $show_collection = mysqli_query($con, $get_collection);
                                  $checkPosts = mysqli_num_rows($show_collection);

                                  while ($rowCollection = mysqli_fetch_array($show_collection)) {

                                  $this_collection_name = $rowCollection['collection_name'];
                                  $this_collection_id = $rowCollection['collection_id'];

                                  $logged_email = $_SESSION['user_email'];

                                  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
                                  $run_userID = mysqli_query($con, $get_userID);
                                  $row = mysqli_fetch_array($run_userID);

                                  $sessionUserID = $row['user_id'];

                                  if($sessionUserID != $userID) {

                                    $getPriv = "SELECT * FROM photocollections WHERE user_id = '$userID' AND collection_id = '$this_collection_id'";
                                    $run_getPriv = mysqli_query($con, $getPriv);
                                    $allPriv = mysqli_fetch_array($run_getPriv);

                                    if($allPriv['public'] == 1) {
                                      $curSet = "public";
                                    } else if($allPriv['friendsOfFriends'] == 1) {
                                      $curSet = "friendsOfFriends";
                                    } else if($allPriv['friends'] == 1) {
                                      $curSet = 'friends';
                                    } else if($allPriv['private'] == 1) {
                                      $curSet = "private";
                                    } else if($allPriv['circle'] == 1) {
                                      $curSet = "circle";
                                    }

                                   // echo "<script>alert('cur set : $curSet !!!')</script>";
                                    $collection_privacy_score = 1;
                                    if($curSet == "friends") {
                                      $checkStatus = "SELECT * FROM friendshipBridge
                                                      WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                                                      OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
                                      $run_checkStatus = mysqli_query($con, $checkStatus);
                                      $theCount = mysqli_num_rows($run_checkStatus);

                                      if($theCount < 1) {
                                          $collection_privacy_score = 0;
                                      }else{$collection_privacy_score = 1;}

                                    }else if($curSet == "circle"){

                                              $checkStatus = "SELECT circle_id,COUNT(member_id) as count_id FROM circleBridge WHERE (member_id = $sessionUserID OR member_id = $userID) GROUP  BY circle_id ORDER BY count_id ASC";
                                              $run_checkStatus = mysqli_query($con, $checkStatus);
                                            while ($rows = mysqli_fetch_array($run_checkStatus)) {
                                              $thisCOUNT  = $rows['count_id'];
                                            echo "<script>alert('$thisCOUNT ')</script>";

                                              if($thisCOUNT > 1 ){
                                                $collection_privacy_score = 1;
                                              }else{
                                                $collection_privacy_score = 0;
                                              }
                                            }

                                    }else if($curSet == "private") {
                                          $collection_privacy_score = 0;
                                    }else if($curSet == "public"){
                                          $collection_privacy_score = 1;
                                    }else if($curSet == "friendsOfFriends") {

                                      $checkStatus = "SELECT * FROM friendshipBridge
                                                      WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                                                      OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
                                      $run_checkStatus = mysqli_query($con, $checkStatus);
                                      $theCount = mysqli_num_rows($run_checkStatus);

                                      if($theCount < 1) {

                                        $checkFoF = "SELECT * FROM (SELECT user.user_id FROM friendshipBridge
                                                            JOIN user ON friendshipBridge.user_id = user.user_id
                                                            WHERE friendshipBridge.friend_id = '$userID'
                                                            UNION ALL
                                                            SELECT user.user_id FROM friendshipBridge
                                                            JOIN user ON friendshipBridge.friend_id = user.user_id
                                                            WHERE friendshipBridge.user_id = '$userID') clickeeFriends
                                                            JOIN (SELECT user.user_id FROM friendshipBridge
                                                                                JOIN user ON friendshipBridge.user_id = user.user_id
                                                                                WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                                                UNION ALL
                                                                                SELECT user.user_id FROM friendshipBridge
                                                                                JOIN user ON friendshipBridge.friend_id = user.user_id
                                                                                WHERE friendshipBridge.user_id = '$sessionUserID') myFriends
                                                                                ON clickeeFriends.user_id = myFriends.user_id";
                                        $run_checkFoF = mysqli_query($con, $checkFoF);
                                        $FoFCount = mysqli_num_rows($run_checkFoF);

                                        if($FoFCount < 1) {
                                            $collection_privacy_score = 0;
                                        }else{
                                            $collection_privacy_score = 1;
                                        }
                                      }
                                    }
                                  }else if ($sessionUserID == $userID){
                                            $collection_privacy_score = 1;
                                  }


                                  if($collection_privacy_score == 0){
                                    // echo "<script>alert('$collection_privacy_score')</script>";
                                    echo "";
                                  }else if($collection_privacy_score == 1){
                                 echo "
                                <div class='panel-group' id='accordion'>
                                  <div class='panel panel-primary'>
                                          <div class='panel-heading' >
                                            <h4 class='panel-title'>
                                              <a data-toggle='collapse' data-parent='#accordion' href='#$this_collection_id'>
                                                $this_collection_name
                                              </a>
                                            </h4>
                                          </div>
                                      <div id='$this_collection_id' class='panel-collapse collapse in'>
                                        <div class='panel-body'>";

                                            $get_photo =  "SELECT * FROM photos WHERE collection_id='$this_collection_id' AND user_id = '$userID' ORDER BY photo_id DESC";
                                            $show_photo = mysqli_query($con, $get_photo);
                                            $checkPhoto = mysqli_num_rows($show_photo);

                                            while ($rowPhoto = mysqli_fetch_array($show_photo)) {

                                            $thisPhotoDescription = $rowPhoto['photo_description'];
                                            $thisPhotoLink = $rowPhoto['photo_link'];
                                            $thisPhotoID = $rowPhoto['photo_id'];

                                            echo "

                                            <div class='col-lg-3 col-md-4 col-xs-12 thumb'  hero-feature'>
                                              <div class='thumbnail'>
                                                     <div id='$thisPhotoID' class='links'>
                                                        <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                                            <img style='height=200px;' src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image'>
                                                        </a>
                                                      </div>

<<<<<<< HEAD
=======
                                                    <div class='form-group' style ='margin-top:5px;'>
                                                        <button name='createCollection' type='submit' class='btn btn-primary'>Create</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <script>
                                          $(function () { $('input,select,textarea').not('[type=submit]').jqBootstrapValidation(); } );
                                        </script>

                                        <hr>
                                  </div>
                              </div>
                          </div>
                            ";
                            };
                        ?>
>>>>>>> origin/master-temp

                                                    <script>
                                                      document.getElementById('$thisPhotoID ').onclick = function (event) {
                                                          event = event || window.event;
                                                          var target = event.target || event.srcElement,
                                                              link = target.src ? target.parentNode : target,
                                                              options = {index: link, event: event},
                                                              links = this.getElementsByTagName('a');
                                                          blueimp.Gallery(links, options);
                                                      };
                                                    </script>

<<<<<<< HEAD
                                                         <div class='caption'>
                                                            <center>
                                                              <h5>$thisPhotoDescription</h5>

                                                            <p>
                                                            <form method='post' action='../functions/like_photo.php' >
                                                            <button name='likes' value='$thisPhotoID' type='submit' class='button  button-pill button-tiny btn-link '><span class='fa fa-thumbs-up'></span> ";
                                                            // like button starts from echo above


=======
                            <!--collection gallery-->
                            <div class="row form-group"></div>

                            <?php
                            $get_collection =  "SELECT * FROM photoCollections WHERE user_id = '$userID' ORDER BY collection_id DESC";
                            $show_collection = mysqli_query($con, $get_collection);
                            $checkPosts = mysqli_num_rows($show_collection);

                            while ($rowCollection = mysqli_fetch_array($show_collection)) {
>>>>>>> origin/master-temp

                                                                  $get_likes_count = "SELECT COUNT(*) FROM likes WHERE (photo_id = $thisPhotoID AND liker_id = $sessionUserID)";
                                                                  $show_likes = mysqli_query($con, $get_likes_count);
                                                                  $checkLikes = mysqli_num_rows($show_likes);

                            $logged_email = $_SESSION['user_email'];

                            $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
                            $run_userID = mysqli_query($con, $get_userID);
                            $row = mysqli_fetch_array($run_userID);

                            $sessionUserID = $row['user_id'];

                            if($sessionUserID != $userID) {

                              $getPriv = "SELECT * FROM photocollections WHERE user_id = '$userID' AND collection_id = '$this_collection_id'";
                              $run_getPriv = mysqli_query($con, $getPriv);
                              $allPriv = mysqli_fetch_array($run_getPriv);

                              if($allPriv['public'] == 1) {
                                $curSet = "public";
                              } else if($allPriv['friendsOfFriends'] == 1) {
                                $curSet = "friendsOfFriends";
                              } else if($allPriv['friends'] == 1) {
                                $curSet = 'friends';
                              } else if($allPriv['private'] == 1) {
                                $curSet = "private";
                              } else if($allPriv['circle'] == 1) {
                                $curSet = "circle";
                              }

                             // echo "<script>alert('cur set : $curSet !!!')</script>";
                              $collection_privacy_score = 1;
                              if($curSet == "friends") {
                                $checkStatus = "SELECT * FROM friendshipBridge
                                                WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                                                OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
                                $run_checkStatus = mysqli_query($con, $checkStatus);
                                $theCount = mysqli_num_rows($run_checkStatus);

                                if($theCount < 1) {
                                    $collection_privacy_score = 0;
                                }else{$collection_privacy_score = 1;}

                              }else if($curSet == "circle"){

                                        $checkStatus = "SELECT circle_id,COUNT(member_id) as count_id FROM circleBridge WHERE (member_id = $sessionUserID OR member_id = $userID) GROUP  BY circle_id ORDER BY count_id ASC";
                                        $run_checkStatus = mysqli_query($con, $checkStatus);
                                      while ($rows = mysqli_fetch_array($run_checkStatus)) {
                                        $thisCOUNT  = $rows['count_id'];
                                      echo "<script>alert('$thisCOUNT ')</script>";

                                        if($thisCOUNT > 1 ){
                                          $collection_privacy_score = 1;
                                        }else{
                                          $collection_privacy_score = 0;
                                        }
                                      }

<<<<<<< HEAD
                                                                  while ($rowLikes = mysqli_fetch_array($show_likes)) {
=======
                              }else if($curSet == "private") {
                                    $collection_privacy_score = 0;
                              }else if($curSet == "public"){
                                    $collection_privacy_score = 1;
                              }else if($curSet == "friendsOfFriends") {

                                $checkStatus = "SELECT * FROM friendshipBridge
                                                WHERE (user_id = '$userID' AND friend_id = '$sessionUserID')
                                                OR (user_id = '$sessionUserID' AND friend_id = '$userID')";
                                $run_checkStatus = mysqli_query($con, $checkStatus);
                                $theCount = mysqli_num_rows($run_checkStatus);

                                if($theCount < 1) {

                                  $checkFoF = "SELECT * FROM (SELECT user.user_id FROM friendshipBridge
                                                      JOIN user ON friendshipBridge.user_id = user.user_id
                                                      WHERE friendshipBridge.friend_id = '$userID'
                                                      UNION ALL
                                                      SELECT user.user_id FROM friendshipBridge
                                                      JOIN user ON friendshipBridge.friend_id = user.user_id
                                                      WHERE friendshipBridge.user_id = '$userID') clickeeFriends
                                                      JOIN (SELECT user.user_id FROM friendshipBridge
                                                                          JOIN user ON friendshipBridge.user_id = user.user_id
                                                                          WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                                          UNION ALL
                                                                          SELECT user.user_id FROM friendshipBridge
                                                                          JOIN user ON friendshipBridge.friend_id = user.user_id
                                                                          WHERE friendshipBridge.user_id = '$sessionUserID') myFriends
                                                                          ON clickeeFriends.user_id = myFriends.user_id";
                                  $run_checkFoF = mysqli_query($con, $checkFoF);
                                  $FoFCount = mysqli_num_rows($run_checkFoF);

                                  if($FoFCount < 1) {
                                      $collection_privacy_score = 0;
                                  }else{
                                      $collection_privacy_score = 1;
                                  }
                                }
                              }
                            }else if ($sessionUserID == $userID){
                                      $collection_privacy_score = 1;
                            }


                            if($collection_privacy_score == 0){
                              // echo "<script>alert('$collection_privacy_score')</script>";
                              echo "";
                            }else if($collection_privacy_score == 1){
                           echo "
                          <div class='panel-group' id='accordion'>
                            <div class='panel panel-primary'>
                                    <div class='panel-heading' >
                                      <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordion' href='#$this_collection_id'>
                                          $this_collection_name
                                        </a>
                                      </h4>
                                    </div>
                                <div id='$this_collection_id' class='panel-collapse collapse in'>
                                  <div class='panel-body'>";
>>>>>>> origin/master-temp

                                                                            $thisCount = $rowLikes['COUNT(*)'];// count like click

                                                                            if ($thisCount == 1){// like the photo

                                                                                echo "you ";

                                                                            }else if ($thisCount==2){// unlike the photo

<<<<<<< HEAD
                                                                              $delete_photo_like = "DELETE  FROM likes WHERE (photo_id = '$thisPhotoID' AND liker_id = '$sessionUserID') ";
                                                                              $run_delete_photo_like = mysqli_query($con, $delete_photo_like);
=======
                                      <div class='col-lg-3 col-md-4 col-xs-12 thumb'  hero-feature'>
                                        <div class='thumbnail'>
                                               <div id='$thisPhotoID' class='links'>
                                                  <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                                      <img style='height=200px;' src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image'>
                                                  </a>
                                                </div>
>>>>>>> origin/master-temp

                                                                              if($run_delete_photo_like){echo "";}
                                                                            }else if($thisCount == 0){// like refresh record

                                                                              $thisCount = 0;
                                                                              echo "";
                                                                            }
                                                                  };


                                                                  // $get_likes =  "SELECT * FROM likes WHERE photo_id='$thisPhotoID' ORDER BY like_id DESC";
                                                                  $get_likes_count_total = "SELECT COUNT(*) FROM likes WHERE photo_id = $thisPhotoID";
                                                                  $show_likes_total = mysqli_query($con, $get_likes_count_total);
                                                                  $checkLikes_total = mysqli_num_rows($show_likes_total);

                                                                  while ($rowLikesTotal = mysqli_fetch_array($show_likes_total)) {
                                                                  $thisCountTotal = $rowLikesTotal['COUNT(*)'];

                                                                  switch ($thisCount) {
                                                                    case '0': // did not like any photo
                                                                          if ($thisCountTotal >=0){
                                                                          echo"$thisCountTotal"; // total likes greater than 0
                                                                          }else{
                                                                          echo""; // not likes in total
                                                                          }
                                                                      break;
                                                                    case '1':
                                                                          $thisCountTotal -= 1; // sefl minus for other
                                                                          if ($thisCountTotal >= 2){ // other likers number greater than 1
                                                                          echo"and $thisCountTotal others";
                                                                          }else if($thisCountTotal == 1){ // one other liker
                                                                            echo"and $thisCountTotal other";
                                                                          }
                                                                      break;
                                                                    case '2':
                                                                          if ($thisCountTotal >=0){
                                                                          echo"$thisCountTotal"; // total likes greater than 0
                                                                          }else{
                                                                          echo""; // not likes in total
                                                                          }
                                                                      break;

                                                                    default:
                                                                      # code...
                                                                      break;
                                                                  }
                                                                };

                                                            // like button ends at echo below
                                                            echo "
                                                            </button>
                                                            </form>
                                                            <h6></h6>

                                                            <a href='comment_photo.php?photo_id=$thisPhotoID&userid=$sessionUserID' name='photoComment' type='submit' class='button button-rounded button-primary button-tiny btn-block'>
                                                              COMMENT
                                                            </a>

<<<<<<< HEAD

                                                            ";
                                                            if($userID == $sessionUserID) {
                                                            echo "

                                                            <form method='post' action='../functions/delete_photo.php' style='margin-top:10px;' >
                                                              <button  name='deletePhoto' type='submit' value='$thisPhotoID' class='button button-rounded button-caution button-tiny btn-block  '>DELETE</button>
                                                            </form>


                                                            ";};
                                                            echo "
                                                          </p>
                                                          </center>
                                                        </div>
                                                  </div>
                                                </div>

                                          ";};
                                                  echo "
                                          </div>
                                        </div>
=======
                                              <script>
                                                document.getElementById('$thisPhotoID ').onclick = function (event) {
                                                    event = event || window.event;
                                                    var target = event.target || event.srcElement,
                                                        link = target.src ? target.parentNode : target,
                                                        options = {index: link, event: event},
                                                        links = this.getElementsByTagName('a');
                                                    blueimp.Gallery(links, options);
                                                };
                                              </script>

                                                   <div class='caption'>
                                                      <center>
                                                        <h5>$thisPhotoDescription</h5>

                                                      <p>
                                                      <form method='post' action='../functions/like_photo.php' >
                                                      <button name='likes' value='$thisPhotoID' type='submit' class='button  button-pill button-tiny btn-link '><span class='fa fa-thumbs-up'></span> ";
                                                      // like button starts from echo above



                                                            $get_likes_count = "SELECT COUNT(*) FROM likes WHERE (photo_id = $thisPhotoID AND liker_id = $sessionUserID)";
                                                            $show_likes = mysqli_query($con, $get_likes_count);
                                                            $checkLikes = mysqli_num_rows($show_likes);


                                                            while ($rowLikes = mysqli_fetch_array($show_likes)) {

                                                                      $thisCount = $rowLikes['COUNT(*)'];// count like click

                                                                      if ($thisCount == 1){// like the photo

                                                                          echo "you ";

                                                                      }else if ($thisCount==2){// unlike the photo

                                                                        $delete_photo_like = "DELETE  FROM likes WHERE (photo_id = '$thisPhotoID' AND liker_id = '$sessionUserID') ";
                                                                        $run_delete_photo_like = mysqli_query($con, $delete_photo_like);

                                                                        if($run_delete_photo_like){echo "";}
                                                                      }else if($thisCount == 0){// like refresh record

                                                                        $thisCount = 0;
                                                                        echo "";
                                                                      }
                                                            };


                                                            // $get_likes =  "SELECT * FROM likes WHERE photo_id='$thisPhotoID' ORDER BY like_id DESC";
                                                            $get_likes_count_total = "SELECT COUNT(*) FROM likes WHERE photo_id = $thisPhotoID";
                                                            $show_likes_total = mysqli_query($con, $get_likes_count_total);
                                                            $checkLikes_total = mysqli_num_rows($show_likes_total);

                                                            while ($rowLikesTotal = mysqli_fetch_array($show_likes_total)) {
                                                            $thisCountTotal = $rowLikesTotal['COUNT(*)'];

                                                            switch ($thisCount) {
                                                              case '0': // did not like any photo
                                                                    if ($thisCountTotal >=0){
                                                                    echo"$thisCountTotal"; // total likes greater than 0
                                                                    }else{
                                                                    echo""; // not likes in total
                                                                    }
                                                                break;
                                                              case '1':
                                                                    $thisCountTotal -= 1; // sefl minus for other
                                                                    if ($thisCountTotal >= 2){ // other likers number greater than 1
                                                                    echo"and $thisCountTotal others";
                                                                    }else if($thisCountTotal == 1){ // one other liker
                                                                      echo"and $thisCountTotal other";
                                                                    }
                                                                break;
                                                              case '2':
                                                                    if ($thisCountTotal >=0){
                                                                    echo"$thisCountTotal"; // total likes greater than 0
                                                                    }else{
                                                                    echo""; // not likes in total
                                                                    }
                                                                break;

                                                              default:
                                                                # code...
                                                                break;
                                                            }
                                                          };

                                                      // like button ends at echo below
                                                      echo "
                                                      </button>
                                                      </form>
                                                      <h6></h6>

                                                      <a href='comment_photo.php?photo_id=$thisPhotoID&userid=$sessionUserID' name='photoComment' type='submit' class='button button-rounded button-primary button-tiny btn-block'>
                                                        COMMENT
                                                      </a>


                                                      ";
                                                      if($userID == $sessionUserID) {
                                                      echo "

                                                      <form method='post' action='../functions/delete_photo.php' style='margin-top:10px;' >
                                                        <button  name='deletePhoto' type='submit' value='$thisPhotoID' class='button button-rounded button-caution button-tiny btn-block  '>DELETE</button>
                                                      </form>


                                                      ";};
                                                      echo "
                                                    </p>
                                                    </center>
                                                  </div>
                                            </div>
                                          </div>

                                    ";};
                                            echo "
                                    </div>
>>>>>>> origin/master-temp
                                  </div>
                            </div>
                          </div>

<<<<<<< HEAD
                                ";
                              }};
                              ?>
                            </div>
                            <!-- collection tab ends -->

=======
                          ";
                        }};
                        ?>
                      </div>
                      <!-- collection tab ends -->
>>>>>>> origin/master-temp


                              <!--photo tab-->
                              <div role="tabpanel" class="tab-pane fade" id="photo">
                                  <div role="tabpanel" class="tab-pane fade in active" id="photo">

<<<<<<< HEAD
                                    <?php
                                    if($userID == $sessionUserID) {
                                  echo "
                                      <div class='col-lg-12 col-md-12 col-sm-12 col'>
                                          <div class='row' style='margin-top:10px;'>
                                              <div class='container-fluid' style='margin-top:10px;'>
                                                  <a class='btn btn-primary' role='button' data-toggle='collapse' href='#addphoto' aria-expanded='false' aria-controls='collapseExample1'>
                                                  Add photo</a>
=======
                        <!--photo tab-->
                        <div role="tabpanel" class="tab-pane fade" id="photo">
                            <div role="tabpanel" class="tab-pane fade in active" id="photo">

                              <?php
                              if($userID == $sessionUserID) {
                            echo "
                                <div class='col-lg-12 col-md-12 col-sm-12 col'>
                                    <div class='row' style='margin-top:10px;'>
                                        <div class='container-fluid' style='margin-top:10px;'>
                                            <a class='btn btn-primary' role='button' data-toggle='collapse' href='#addphoto' aria-expanded='false' aria-controls='collapseExample1'>
                                            Add photo</a>

                                            <div class='collapse' id='addphoto'>
                                                <div class='panel-body'>
                                                     <form action='' method='post' id='a'  class='aa' enctype='multipart/form-data'>
                                                        <div class='form-group' id='post_form'>
                                                            <label>1.Photo name:</label>
                                                            <input method='post' name='photo_description' type='string' class='form-control' placeholder='enter your photo description' required = 'required'>
                                                        </div>
>>>>>>> origin/master-temp

                                                  <div class='collapse' id='addphoto'>
                                                      <div class='panel-body'>
                                                           <form action='' method='post' id='a'  class='aa' enctype='multipart/form-data'>
                                                              <div class='form-group' id='post_form'>
                                                                  <label>1.Photo name:</label>
                                                                  <input method='post' name='photo_description' type='string' class='form-control' placeholder='enter your photo description' required = 'required'>
                                                              </div>



<<<<<<< HEAD
                                                              <label>2.Select photo:</label>
                                                              <input type='file' name='myFile1' required = 'required' /></br>
=======
                                                        <label>3.Add to collection:</label><br>
                                                        ";
>>>>>>> origin/master-temp

                                                              <label>3.Add to collection:</label><br>
                                                              ";



                                                              $get_collection_id = "SELECT collection_id,collection_name from photocollections WHERE user_id = $sessionUserID";

                                                              $run_collection_id = mysqli_query($con, $get_collection_id);
                                                              $check_collection_id = mysqli_num_rows($run_collection_id);

                                                              while ($rowPosts = mysqli_fetch_array($run_collection_id)) {

                                                                $this_collection_id = $rowPosts['collection_id'];
                                                                $this_collection_name = $rowPosts['collection_name'];


<<<<<<< HEAD
                                                              echo "
=======
                                                          <input type='radio' name='select_collection[]' class='text-primary' value='$this_collection_id' required = 'required'>
                                                            $this_collection_name
                                                              </span>
                                                              <h6></h6>
>>>>>>> origin/master-temp

                                                                <input type='radio' name='select_collection[]' class='text-primary' value='$this_collection_id' required = 'required'>
                                                                  $this_collection_name
                                                                    </span>
                                                                    <h6></h6>

                                                                ";
                                                              };

                                                    if($userID == $sessionUserID) {
                                                echo "
                                                              <div class='form-group' style ='margin-top:35px;'>
                                                                  <button name='uploadsPhoto' type='submit' class='btn btn-primary'>upload</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                                </div>
<<<<<<< HEAD
                                                <hr>
                                            </div>
                                          </div>
                                          ";
                                        };};
                                      ?>

                                      <div class="row form-group"></div>
                                          <!--photo gallery-->
                                      <?php
                                          $get_photo =  "SELECT * FROM photos WHERE user_id = '$userID' ORDER BY photo_id DESC";
                                          $show_photo = mysqli_query($con, $get_photo);
                                          $checkPhoto = mysqli_num_rows($show_photo);

                                          while ($rowPhoto = mysqli_fetch_array($show_photo)) {

                                          $thisPhotoDescription = $rowPhoto['photo_description'];
                                          $thisPhotoLink = $rowPhoto['photo_link'];
                                          $thisPhotoID = $rowPhoto['photo_id'];

                                          echo "
                                            <div class='col-lg-3 col-md-4 col-xs-6 thumb'  hero-feature'>
                                                <div class='thumbnail'>
                                                   <div id='$thisPhotoID' class='links'>
                                                      <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                                          <img style='height=200px;'src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image' >
                                                      </a>
                                                   </div>

                                                  <script>
                                                    document.getElementById('$thisPhotoID ').onclick = function (event) {
                                                        event = event || window.event;
                                                        var target = event.target || event.srcElement,
                                                            link = target.src ? target.parentNode : target,
                                                            options = {index: link, event: event},
                                                            links = this.getElementsByTagName('a');
                                                        blueimp.Gallery(links, options);
                                                    };
                                                    </script>";

                                                    if($userID == $sessionUserID) {
                                                    echo "
                                                    <br>
                                                    <form method='post' action='../functions/delete_photo.php' >
                                                      <button  name='deletePhoto' type='submit' value='$thisPhotoID' class='button button-rounded button-caution button-tiny btn-block btn-block'>DELETE</button>
                                                    </form>
                                                    ";
                                                    }
                                                  echo "
                                                </div>
                                            </div>
                                        ";};
                                       ?>
                                 <!-- photo gallery ends -

                                </div>
                              </div>
                              <!-- photo tab ends -->
                        </div>
                      </div>
                      </div>
                    </div>
=======
                                            </div>
                                          </div>
                                          <hr>
                                      </div>
                                    </div>
                                    ";
                                  };};
                                ?>

                                <div class="row form-group"></div>
                                    <!--photo gallery-->
                                <?php
                                    $get_photo =  "SELECT * FROM photos WHERE user_id = '$userID' ORDER BY photo_id DESC";
                                    $show_photo = mysqli_query($con, $get_photo);
                                    $checkPhoto = mysqli_num_rows($show_photo);

                                    while ($rowPhoto = mysqli_fetch_array($show_photo)) {

                                    $thisPhotoDescription = $rowPhoto['photo_description'];
                                    $thisPhotoLink = $rowPhoto['photo_link'];
                                    $thisPhotoID = $rowPhoto['photo_id'];

                                    echo "
                                      <div class='col-lg-3 col-md-4 col-xs-6 thumb'  hero-feature'>
                                          <div class='thumbnail'>
                                             <div id='$thisPhotoID' class='links'>
                                                <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                                    <img style='height=200px;'src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image' >
                                                </a>
                                             </div>

                                            <script>
                                              document.getElementById('$thisPhotoID ').onclick = function (event) {
                                                  event = event || window.event;
                                                  var target = event.target || event.srcElement,
                                                      link = target.src ? target.parentNode : target,
                                                      options = {index: link, event: event},
                                                      links = this.getElementsByTagName('a');
                                                  blueimp.Gallery(links, options);
                                              };
                                              </script>";

                                              if($userID == $sessionUserID) {
                                              echo "
                                              <br>
                                              <form method='post' action='../functions/delete_photo.php' >
                                                <button  name='deletePhoto' type='submit' value='$thisPhotoID' class='button button-rounded button-caution button-tiny btn-block btn-block'>DELETE</button>
                                              </form>
                                              ";
                                              }
                                            echo "
                                          </div>
                                      </div>
                                  ";};
                                 ?>
                           <!-- photo gallery ends -

                          </div>
                        </div>
                        <!-- photo tab ends -->
>>>>>>> origin/master-temp
                  </div>
                  <!-- /.container-fluid -->
              </div>
              <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->    <script src="../vendor/jquery/jquery.min.js"></script>
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

    <!-- gallery js -->
    <script src='../styles/gallery/js/blueimp-gallery.js'></script>
    <script src="../styles/gallery/js/blueimp-helper.js"></script>
    <script src="../styles/gallery/js/blueimp-gallery.js"></script>
    <script src="../styles/gallery/js/blueimp-gallery-fullscreen.js"></script>
    <script src="../styles/gallery/js/blueimp-gallery-indicator.js"></script>
    <script src="../styles/gallery/js/vendor/jquery.js"></script>
    <script src="../styles/gallery/js/jquery.blueimp-gallery.js"></script>


      <!-- The Gallery as inline carousel, can be positioned anywhere on the page -->
      <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
          <div class="slides"></div>
          <h3 class="title"></h3>
          <a class="prev">‹</a>
          <a class="next">›</a>
          <a class="close">×</a>
          <a class="play-pause"></a>
          <ol class="indicator"></ol>
      </div>

      <!-- validation script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script src="../dist/js/jqBootstrapValidation.js"></script>

</body>
</html>
