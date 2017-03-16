<?php
session_start();
include("../includes/connection.php");
include("../functions/upload_photo.php");
include("../functions/new_collection.php");
include("../functions/new_photo_comment.php");


$logged_email = $_SESSION['user_email'];
$get_photo_id = $_GET['photo_id'];
$_SESSION['pre_photoID'] = $get_photo_id;

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
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row text-left">
            <div class="row text-left">
                        <!-- page-title -->
                          <div class="row">
                              <div class="col-lg-12">
                                  <h1 class="page-header">photo comments
                                  </h1>
                              </div>
                          </div>
                        <!-- page-title-ends -->

                        <!-- main-comment  show photo-->
                        <?php
                            $get_photo =  "SELECT * FROM photos WHERE photo_id =$get_photo_id  ";
                            // get photo information from the database
                            $show_photo = mysqli_query($con, $get_photo);
                            $checkPhoto = mysqli_num_rows($show_photo);

                            while ($rowPhoto = mysqli_fetch_array($show_photo)) {
                            // get the photo information one by one accroding to the photo_id in the while loop
                            $thisPhotoDescription = $rowPhoto['photo_description'];
                            $thisPhotoLink = $rowPhoto['photo_link'];
                            $thisPhotoID = $rowPhoto['photo_id'];

                            echo "

                            <div class='col-lg-12 col-md-12 col-xs-12 thumb'  hero-feature'>
                                    <div class='thumbnail'>
                                     <div id='$thisPhotoID' class='links'>
                                        <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                            <img src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image' >
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
                                      </script>
                                  </div>
=======
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row text-left">
      <div class="row text-left">
                  <!-- page-title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">photo comments
                            </h1>
                        </div>
                    </div>
                  <!-- page-title-ends -->

                  <!-- main-comment  show photo-->
                  <?php
                      $get_photo =  "SELECT * FROM photos WHERE photo_id =$get_photo_id  ";
                      // get photo information from the database
                      $show_photo = mysqli_query($con, $get_photo);
                      $checkPhoto = mysqli_num_rows($show_photo);

                      while ($rowPhoto = mysqli_fetch_array($show_photo)) {
                      // get the photo information one by one accroding to the photo_id in the while loop
                      $thisPhotoDescription = $rowPhoto['photo_description'];
                      $thisPhotoLink = $rowPhoto['photo_link'];
                      $thisPhotoID = $rowPhoto['photo_id'];

                      echo "

                      <div class='col-lg-12 col-md-12 col-xs-12 thumb'  hero-feature'>
                              <div class='thumbnail'>
                               <div id='$thisPhotoID' class='links'>
                                  <a href='../uploads/$thisPhotoLink' title='$thisPhotoDescription' data-gallery>
                                      <img src='../uploads/$thisPhotoLink' class='img-responsive center-block alt='Responsive image' >
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
                                </script>
>>>>>>> origin/master-temp
                            </div>
                          ";};
                         ?>
                         </div>
                      <!-- show photo ends    -->

                      <!-- comment area -->
                        <div class="row text-left col-lg-12 col-md-12 col-xs-12 thumb" >
                         <div class="panel panel-primary">
                           <!-- panel heading -->
                             <div class="panel-heading">Comment</div>
                          <!-- panel heading ends -->

                                          <!-- panel body   -->
                                          <div class="panel-body">
                                              <ul class="photo_comment_content">

                                                <?php
                                                $get_comment = "SELECT user.user_firstName,user.user_lastName,user.user_pic,comments.photo_id,comments.comment_body,comments.comment_day,comments.comment_month,comments.comment_year,comments.comment_time
                                                                FROM comments INNER JOIN user ON comments.commenter_id = user.user_id WHERE comments.photo_id = '$get_photo_id'";
                                                $run_comment = mysqli_query($con, $get_comment);
                                                $checkCommnent = mysqli_num_rows($run_comment);

                                                while ($rowComment = mysqli_fetch_array($run_comment)) {

                                                  $thisCommentBody = $rowComment['comment_body'];
                                                  $thisCommentDay = $rowComment['comment_day'];
                                                  $thisCommentMonth = $rowComment['comment_month'];
                                                  $thisCommentYear = $rowComment['comment_year'];
                                                  $thisCommentTime = $rowComment['comment_time'];
                                                  $thisFirst = $rowComment['user_firstName'];
                                                  $thisLast = $rowComment['user_lastName'];
                                                  $thisUserPic = $rowComment['user_pic'];
                                                  $thisFullDate = sprintf("%02d",$thisCommentDay)."-".sprintf("%02d", $thisCommentMonth)."-".strval($thisCommentYear);


                                                  echo "<li class='left clearfix list-unstyled'>
                                                      <span class='chat-img pull-left'>
                                                          <img src='../user/user_images/$thisUserPic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                                      </span>
                                                      <div class='chat-body clearfix'>
                                                          <div class='header'>
                                                              <strong class='primary-font'>$thisFirst $thisLast</strong>
                                                              <small class='pull-right text-muted'>
                                                              <i class='fa fa-clock-o fa-fw'></i>Comment time:$thisFullDate
                                                              </small>
                                                          </div>
                                                          <p><h5>$thisCommentBody<h5></p>
                                                      </div>
                                                  </li>
                                                  ";
                                                };
                                                ?>
                                              </ul>
                                       </div>
                                          <!-- panel body 1 ends -->

                          <!-- panel footer -->
                             <div class="panel-footer">
                               <form method="post">
                                 <div class="input-group">
                                     <input method="post" name="photo_commnet_cotent" type="text" class="form-control input-sm" placeholder="Enter your comment" />
                                     <span class="input-group-btn">
                                         <button name="addPhotoComment" type="submit" class="btn btn-primary btn-sm">
                                         Send</button>
                                     </span>
                                 </div>
                              </form>
                             </div>

                          <!-- panel footer ends -->
                           </div>
                        </div>
                    <!-- comment area ends -->
          </div>
        </div>
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
</body>
</html>
