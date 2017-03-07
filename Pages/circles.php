
<?php
session_start();
include("../includes/connection.php");
include("../functions/new_circle.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<style>
ul#friends li {
  display: inline-flex;
  padding: 10px;
}
</style>


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
                    <h1 class="page-header">Create new circle</h1>
                </div>
                <!-- /.col-lg-12 -->

                  <div class="row">


                    <div class="col-lg-6">
                      <div class="chat-panel panel panel-default">
                        <!-- HEADING -->

                          <div class="panel-heading">
                            <h5>My Circles</h5>
                          </div>
                          <!--  -->
                          <div class="panel-body">

                            <div class="list-group">
                              <ul id="friends">
                            <!-- insert from database -->
                            <?php
                            $get_myCircles = "SELECT circles.circle_name, circles.circle_id FROM circleBridge JOIN circles ON circleBridge.circle_id = circles.circle_id WHERE circleBridge.member_id = '$userID'";
                            // $get_myCircles = "SELECT * FROM circles WHERE creator_id = '$userID' ORDER BY circle_id DESC";
                            $run_myCircles = mysqli_query($con, $get_myCircles);
                            $checkCircles = mysqli_num_rows($run_myCircles);

                            while ($rowCircles = mysqli_fetch_array($run_myCircles)) {

                              // to delete circle later on
                              $thisCircleID = $rowCircles['circle_id'];
                              $thisTitle = $rowCircles['circle_name'];

                              echo "<li>
                                <a href='circle_group.php?circle_id=$thisCircleID&userid=$sessionUserID'>
                                  <img src='../circle_assets/circle_default.png' alt='error' class='img-circle' style='width:150px;height:150px;' align='middle'/>
                                  <p align='center'><strong class='primary-font'>$thisTitle</strong></p>
                                </a>
                              </li>";

                            }
                            ?>
                            <!-- insert from database ENDS -->
                          </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                  <h5>Create new circle:</h5>
                  <form method="post">
                  <input method="post" name="circle_name" type="text" class="form-control input-sm" placeholder="Type your circle name here..." />

                    </div>
                    <!--  -->
                    <div class="col-lg-6">
                      <div class="chat-panel panel panel-default">
                          <div class="panel-heading">


                          </div>
                          <!--  -->
                          <div class="panel-body">
                            <!-- paste here -->
                            <div class="list-group">
                              <!-- <form method="post"> -->
                              <?php

                              $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$userID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$userID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5);

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {

                                $thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                $thisPhoto = $rowPosts['user_pic'];

                              echo "
                                <input type='checkbox' name='chk_group[]' value=$thisFriendID>
                                  <img src='../user/user_images/$thisPhoto' alt='error' style='width:50px;height:50px;'/>
                                  $thisFirstName $thisLastName
                                    </span>
                                ";
                              };

                                ?>
                            <!-- </form> -->
                            </div>
                              <div class ="pull-right">
                                <button name="createCircle" type="submit"><h4>Create circle</h4></button>
                              </div>
                            </form>

                          <!-- end of friend box -->


                  </div>
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
