<?php
session_start();
include("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

include("../functions/addNewInterest.php");
include("../functions/deleteInterest.php");

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
          <br>
            <!-- <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                </div>
            </div> -->
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading"> -->
                            <!-- <i class="fa fa-bar-chart-o fa-fw"></i> All About Me -->

                            <?php

                            if($userID == $sessionUserID) {
                              echo "
                              <div class='pull-right'>
                                  <div class='btn-group'>
                                    <button type='button' class='btn btn-primary btn-sm dropdown-toggle' data-toggle='dropdown'>
                                        <i class='fa fa-gear'></i> <span class='caret'></span>
                                    </button>
                                      <ul class='dropdown-menu pull-right' role='menu'>
                                          <li><a href='../Pages/editProfile.php'>Edit profile</a>
                                          </li>

                                      </ul>
                                  </div>
                              </div>
                              <br>
                            ";

                          };

                             ?>

                        <!-- </div> -->


                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:580px">
                          <?php

        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM user WHERE user_id = '$userID'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_id = $row['user_id'];
        $user_firstName = $row['user_firstName'];
        $user_lastName = $row['user_lastName'];
        $user_pass = $row['user_password'];
        $user_email = $row['user_email'];
        $user_image = $row['user_pic'];
        $user_birthday = $row['user_DoB'];
        $formatDoB = strtotime($user_birthday);
        $theBirthday = date("d F Y", $formatDoB);

        echo "
        <center>

        <p align='center'><img id='userImg' src='../user/user_images/$user_image' width='250' height='250'/></p>
        <p style=\"font-size:60px\"><strong>$user_firstName  $user_lastName</strong></p>
        <p style=\"font-size:35px\"><strong>Birthday: </strong>$theBirthday</p>


        <a style=\"font-size:45px\" href = '../Pages/blog.php?userid=$userID'><strong><i class='fa fa-rss fa-fw'></i>Blog</strong></a>
        &emsp;
        <a style='font-size:45px' href='../Pages/photocollection.php?userid=$userID'><strong><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i> Photos</strong></a>

        </center>
        ";
         ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Friends
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">

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

                              $friendCount = 0;

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {

                                if($friendCount <= 3){

                                $thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                $thisPhoto = $rowPosts['user_pic'];

                                echo "<li class='left clearfix'>
                                      <span class='chat-img pull-left'>
                                      <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                      </span>
                                      <div class='chat-body clearfix'>
                                      <div class='header'>
                                      <a href='../Pages/profile.php?userid=$thisFriendID'>
                                      <strong class='primary-font'>$thisFirstName $thisLastName</strong>
                                      </a>
                                      <a href='../Pages/blog.php?userid=$thisFriendID'>
                                      <div class='pull-right'>
                                      <i class='fa fa-rss fa-fw'></i>
                                      </div>
                                      </a>
                                      <a href='../Pages/profile.php?userid=$thisFriendID'>
                                      <div class='pull-right'>
                                      <i class='fa fa-home fa-fw'></i>
                                      </div>
                                      </a>
                                      </div>
                                      </div>
                                      </li>";

                                      $friendCount++;

                                  }
                              };

                                ?>
                                <ul>
                            <!-- /.list-group -->
                            <a href="../Pages/friendsList.php?userid=<?php echo"$sessionUserID";?>" style="display:block;text-align:center;" class="btn btn-primary btn-block">See All Friends</a>

                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4">
                                      <div class="chat-panel panel panel-primary">
                                          <div class="panel-heading">
                                            <h5>Interests</h5>
                                          </div>
                                          <!--  -->
                                          <div class="panel-body">
                                            <!-- paste here -->
                                            <div class="list-group">
                                              <!-- <form method="post"> -->
                                              <form method="post">
                                              <?php

                                              $interestQuery = "SELECT interest FROM interests WHERE user_id = $userID";
                                              $run_interestQuery = mysqli_query($con, $interestQuery);


                                              if($userID == $sessionUserID) {

                                                echo "
                                                <li class='list-unstyled'>
                                                  Add new:
                                                  <input name='newInterest' style='width: 19em;' type='text' placeholder='Please enter another interest'>
                                                </li>
                                                <!-- end of interest box -->

                                                <div style='margin-top: 10px;'>
                                                  <button name='deleteInterests' type='delete' class='btn btn-danger btn-sm pull-left'>Delete</button>

                                                  <button name='addInterests' type='submit' class='btn btn-primary btn-sm pull-right'>Add</button>
                                                </div>
                                                <br>
                                                ";

                                                while ($interestArray = mysqli_fetch_array($run_interestQuery)) {
                                                  $thisInterest = $interestArray['interest'];

                                                echo "
                                                  <li class='list-unstyled'>
                                                  <h3>
                                                  <input type='checkbox' name='interest_group[]' value=$thisInterest>
                                                    $thisInterest
                                                    </h3>
                                                      </span>
                                                    </li>
                                                  ";
                                                };


                                              } else {
                                                while ($interestArray = mysqli_fetch_array($run_interestQuery)) {
                                                  $thisInterest = $interestArray['interest'];

                                                echo "
                                                  <li class='list-unstyled'>
                                                    <h3>$thisInterest</h3>
                                                      </span>
                                                    </li>
                                                  ";
                                                };
                                                echo "</div>";
                                              }
                                              // include("../functions/addNewInterest.php");
                                                ?>
                                </form>
                                </div>

                                </form>
                              </div>
                                    <!-- </div> -->
            </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
