
<?php
session_start();
include("../includes/connection.php");
include("../functions/new_circle.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];
$_SESSION['test'] = $sessionUserID;

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

// include("../functions/delete_circle.php");

?>

<!DOCTYPE html>
<html lang="en">

<?php

include("../template/theme/head.php");

?>

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
                    <h1 class="page-header">My Circles</h1>
                </div>

                    <div class="col-lg-12">
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
                            $get_myCircles = "SELECT circles.circle_name, circles.circle_id, circles.creator_id FROM circleBridge JOIN circles ON circleBridge.circle_id = circles.circle_id WHERE circleBridge.member_id = '$userID'";
                            // $get_myCircles = "SELECT * FROM circles WHERE creator_id = '$userID' ORDER BY circle_id DESC";
                            $run_myCircles = mysqli_query($con, $get_myCircles);
                            $checkCircles = mysqli_num_rows($run_myCircles);

                            while ($rowCircles = mysqli_fetch_array($run_myCircles)) {

                              // to delete circle later on
                              $thisCircleID = $rowCircles['circle_id'];
                              $thisTitle = $rowCircles['circle_name'];
                              $thisCreatorID = $rowCircles['creator_id'];

                              echo "<li>
                                <a href='circle_group.php?circle_id=$thisCircleID&userid=$sessionUserID'>
                                  <img src='../circle_assets/circle_logo.png' alt='error' class='img-circle' style='width:100px;height:100px;' align='middle'/>
                                  <p align='center'><strong class='primary-font'>$thisTitle</strong></p>
                                </a>
                              ";
                            }
                            ?>
                            <!-- insert from database ENDS -->
                            <!--  -->

                          </ul>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--  -->
                    <br>
                    <style>
                    ul#friends li {
                      display: inline-flex;
                      padding: 10px;
                    }
                    </style>
                    <div class="col-lg-12">
                      <div class="chat-panel panel panel-default">
                          <div class="panel-heading">
                            <h5>New Circle</h5>
                          </div>
                          <!--  -->
                          <div class="panel-body">
                            <div>
                            <form method="post">
                            <input method="post" name="circle_name" type="text" class="form-control input-sm" placeholder="Type your circle name here..." />
                            <br>
                            <button name="createCircle" type="submit" class="btn btn-primary" style = 'float: right'><h4>Create circle</h4></button>

                          </div>
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
                                <li class='list-unstyled'>
                                <input type='checkbox' name='chk_group[]' value=$thisFriendID>
                                  <img src='../user/user_images/$thisPhoto' alt='error' style='width:50px;height:50px;'/>
                                  $thisFirstName $thisLastName
                                    </span>
                                  </li>
                                ";
                              };

                                ?>

                          <!-- end of friend box -->
                  </div>
                  <!-- <div class ="pull-right"> -->
                    <!-- <button name="createCircle" type="submit" class="btn btn-primary" style = 'float: right'><h4>Create circle</h4></button> -->
                  <!-- </div> -->
                </div>
                </form>
              </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- mute above -->
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="../vendor/raphael/raphael.min.js"></script> -->
    <!-- <script src="../vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
