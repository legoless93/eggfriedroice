
<?php
session_start();
include("../includes/connection.php");
include("../functions/new_message.php");

$logged_email = $_SESSION['user_email'];
$get_circleID = $_GET['circle_id'];
$_SESSION['pass_circleID'] = $get_circleID;

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
  // echo "<script>alert($userID)</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>mybebofacespacebook</title>

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

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">mybebofacespacebook</a>
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
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="../home.php"><i class="fa fa-dashboard fa-fw"></i> Profile</a>
                        </li>
                        <li>
                            <a href="Pages/blog.php"><i class="fa fa-bar-chart-o fa-fw"></i> Blog</a>
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
                                    <a href="circles.php">My circles</a>
                                </li>
                                <li>
                                    <a href="circle_group.php">Circle chat</a>
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
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                  <?php

                  $get_circleName = "SELECT * FROM circles WHERE circle_id = '$get_circleID'";
                  $run_getName = mysqli_query($con, $get_circleName);
                  $row = mysqli_fetch_array($run_getName);

                  $circleName = $row['circle_name'];
                  // $get_circleName = "SELECT circleBridge.member_id FROM circleBridge
                  // JOIN circles ON circles.circle_id = circleBridge.circle_id
                  // WHERE circles.circle_id = '$get_circleID' ";

                  echo "<h1 class='page-header'>$circleName</h1>";
                    // <h1 class="page-header">*Circle name here*</h1>
                  ?>

                </div>
                <!-- /.col-lg-12 -->
                <div class="row">
                    <div class="col-lg-8">
                      <div class="chat-panel panel panel-default">
                          <div class="panel-heading">
                              <i class="fa fa-comments fa-fw"></i> Chat
                          </div>
                      <!--  -->
                      <div class="panel-body">
                          <ul class="chat">


                            <?php

                            // $get_messages = "SELECT * FROM messages WHERE messages.circle_id = '$get_circleID' ORDER BY message_id DESC";
                            $get_messages = "SELECT user.user_firstName, user.user_lastName, user.user_pic, messages.message_body, messages.sender_id, messages.message_time
                                              FROM messages JOIN user ON messages.sender_id = user.user_id WHERE messages.circle_id = '$get_circleID' ORDER BY message_id DESC";
                            $run_messages = mysqli_query($con, $get_messages);
                            $check_messages = mysqli_num_rows($run_messages);

                            while ($rowPosts = mysqli_fetch_array($run_messages)) {

                              // $thisMessageID = $rowPosts['message_id'];
                              $thisSenderID = $rowPosts['sender_id'];
                              $thisMessageTime = $rowPosts['message_time'];
                              $thisMessageBody = $rowPosts['message_body'];
                              $thisFirst = $rowPosts['user_firstName'];
                              $thisLast = $rowPosts['user_lastName'];
                              $thisPic = $rowPosts['user_pic'];

                              // LOOK INTO SEPARATING USER MESSAGES BY DIRECTION
                              if ($thisSenderID != $userID){
                              echo "<li class='left clearfix'>
                                  <span class='chat-img pull-left'>
                                      <img src='../user/user_images/$thisPic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                  </span>
                                  <div class='chat-body clearfix'>
                                      <div class='header'>
                                          <strong class='primary-font'>$thisFirst $thisLast</strong>
                                          <small class='pull-right text-muted'>
                                              <i class='fa fa-clock-o fa-fw'></i> $thisMessageTime
                                          </small>
                                      </div>
                                      <p>
                                      $thisMessageBody
                                      </p>
                                  </div>
                              </li>";
                            } else {
                              echo "<li class='right clearfix'>
                                      <span class='chat-img pull-right'>
                                      <img src='../user/user_images/$thisPic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                      </span>
                                      <div class='chat-body clearfix'>
                                      <div class='header'>
                                      <small class=' text-muted'>
                                      <i class='fa fa-clock-o fa-fw'></i> $thisMessageTime</small>
                                      <strong class='pull-right primary-font'>$thisFirst $thisLast</strong>
                                      </div>
                                      <p>
                                      $thisMessageBody
                                      </p>
                                      </div>
                                      </li>";
                            }
                            };
                            ?>
                        <!--  -->
                        <!--  -->

                    </ul>
                </div>
              <!-- /.panel-body -->
              <div class="panel-footer">

                <form method="post">
                  <div class="input-group">

                      <input method="post" name="circle_message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                      <span class="input-group-btn">

                          <button name="sendCircleMessage" type="submit" class="btn btn-warning btn-sm">
                              Send
                          </button>

                      </span>

                  </div>
                  </form>

              </div>
            </div>
          </div>
            <!-- /.panel-footer -->
        <!-- /#page-wrapper -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-users fa-fw"></i> Other circle thugs

                </div>
        <!-- /.panel -->
        <div class="panel-body">
            <ul class="chat">


              <!-- DATABASE QUERY: FIND CIRCLE FRIEND DETAILS FROM USER -->
              <?php

              $get_circleFriends = "SELECT user.user_firstName, user.user_lastName, user.user_pic
                              FROM circleBridge
                              JOIN circles
                              ON circleBridge.circle_id = $get_circleID AND circleBridge.circle_id = circles.circle_id
                              JOIN user
                              WHERE circleBridge.member_id = user.user_id AND circleBridge.member_id != $userID";
              $run_circleFriends = mysqli_query($con, $get_circleFriends);
              // DO NOT CALL v BEFORE OR YOU LOSE FIRST INDEX
              while ($rowPosts = mysqli_fetch_array($run_circleFriends)) {

                $member_first = $rowPosts['user_firstName'];
                $member_last = $rowPosts['user_lastName'];
                $member_pic = $rowPosts['user_pic'];

                echo "<li class='left clearfix'>
                      <span class='chat-img pull-left'>
                      <img src='../user/user_images/$member_pic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                      </span>
                      <div class='chat-body clearfix'>
                      <div class='header'>
                      <strong class='primary-font'>$member_first $member_last</strong>
                      <small class='pull-right text-muted'>
                      <i class='fa fa-clock-o fa-fw'></i> 5 mins ago
                      </small>
                      </div>
                      </div>
                      </li>";

              }
              ?>
              <ul>

              </div>
              </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Flot Charts JavaScript -->
    <script src="../vendor/flot/excanvas.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.pie.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/flot/jquery.flot.time.js"></script>
    <script src="../vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="../data/flot-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
