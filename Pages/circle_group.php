
<?php
session_start();
include("../includes/connection.php");

$logged_email = $_SESSION['user_email'];
$get_circleID = $_GET['circle_id'];
$_SESSION['pass_circleID'] = $get_circleID;

if (!$get_circleID){
  echo "<script>alert('burrr')</script>";
}

//Anywhere else...no...
include("../functions/new_message.php");

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

// include("../functions/getMessages.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php

include("../template/theme/head.php");

?>

<script>
 $(document).ready(function(){

// var d = $('#div1');
// d.scrollTop(d.prop("scrollHeight"));

setInterval(function(){
    $('#hibrian').load("../functions/getMessages.php?circle_id=<?php echo $get_circleID?>&userid=<?php echo $sessionUserID?>");
    console.log('hey');
}, 5000);

});
</script>

<!-- <script>
$('#hibrian').load("../functions/getMessages.php?circle_id=<?php echo $get_circleID?>&userid=<?php echo $sessionUserID?>");

setInterval(function(){
    $('#hibrian').load("../functions/getMessages.php?circle_id=<?php echo $get_circleID?>&userid=<?php echo $sessionUserID?>");
    console.log('hey');
}, 5000);
</script> -->

<body>

    <div id="wrapper">

      <!-- NAVIGATION TEMPLATE HERE -->
      <?php

      include("../template/theme/header.php");
      include("../template/theme/sidebar.php");

      ?>

        <div id="page-wrapper">
            <div class="row">
              <br>
                <!-- <div class="col-lg-12"> -->
                  <?php

                  $get_circleName = "SELECT * FROM circles WHERE circle_id = '$get_circleID'";
                  $run_getName = mysqli_query($con, $get_circleName);
                  $row = mysqli_fetch_array($run_getName);

                  $circleName = $row['circle_name'];
                  $thisCircleID = $row['circle_id'];

                  // echo "<h1 class='page-header'>$circleName</h1>";

                  ?>
                <!-- </div> -->

                <style>
                .fixed-panel {
                  min-height: 100;
                  max-height: 100;
                  overflow-y: scroll;
}
                </style>


                <div class="row">
                    <div class="col-lg-8">
                      <div class="chat-panel panel panel-default">
                          <div class="panel-heading">
                            <form action="" method="post">
                              <div class="input-group">

                                  <textarea method="post" name="circle_message" type="text" class="form-control input-group-sm" placeholder="Type your message here..." style="height:50px"></textarea>

                                  <span class="input-group-btn">

                                      <button name="sendCircleMessage" type="submit" class="btn btn-warning btn-lg">
                                          Send
                                      </button>

                                  </span>

                              </div>
                              </form>
                          </div>

                      <div class="panel-body" id="div1" style="min-height: 600px;">
                          <ul class="chat" id="hibrian">


                            <?php include("../functions/getMessages.php"); ?>

                        <!--  -->

                    </ul>
                </div>

              <!-- /.panel-body -->
              <!-- <div class="panel-footer">

                <form action="" method="post">
                  <div class="input-group">

                      <input method="post" name="circle_message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                      <span class="input-group-btn">

                          <button name="sendCircleMessage" type="submit" class="btn btn-warning btn-sm">
                              Send
                          </button>

                      </span>

                  </div>
                  </form>

              </div> -->
            </div>
          </div>
            <!-- /.panel-footer -->

            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                            </div>

                            <div class="modal-body">
                                <p>As the group creator, you have special rights to delete this group.</p>
                                <p>Do you want to proceed?</p>
                                <p class="debug-url"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <?php
                                echo "
                                <a class='btn btn-danger' href='../functions/delete_circle.php?circle_id=$thisCircleID'>Delete</a>
                                ";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delete modal above -->

                <div class="modal fade" id="confirm-leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Leaving Group</h4>
                                </div>

                                <div class="modal-body">
                                    <p>You're leaving the group? The others won't be happy....</p>
                                    <p>Are you sure?</p>
                                    <p class="debug-url"></p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <?php
                                    echo "
                                    <a class='btn btn-danger' href='../functions/leave_circle.php?circle_id=$thisCircleID&user_id=$sessionUserID'>Leave</a>
                                    ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

        <!-- /#page-wrapper -->
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">

                    <i class="fa fa-users fa-fw"></i> People

                </div>
        <!-- /.panel -->
        <div class="panel-body">
            <ul class="chat">


              <!-- DATABASE QUERY: FIND CIRCLE FRIEND DETAILS FROM USER -->
              <?php

              // this is a check to counter the back button once a circle has been deleted
              $checkCircleID = "SELECT * FROM circles WHERE circles.circle_id = $get_circleID";
              $sql = mysqli_query($con, $checkCircleID);
              $runsql = mysqli_fetch_array($sql);

              $idPresent = $runsql['circle_id'];

              if(!$idPresent){
                echo "<script>window.open('../Pages/circles.php?userid=$sessionUserID', '_self')</script>";
              }

              $get_circleFriends = "SELECT user.user_firstName, user.user_lastName, user.user_pic, circles.creator_id, circleBridge.member_id
                              FROM circleBridge
                              JOIN circles
                              ON circleBridge.circle_id = $get_circleID AND circleBridge.circle_id = circles.circle_id
                              JOIN user
                              WHERE circleBridge.member_id = user.user_id";
              $run_circleFriends = mysqli_query($con, $get_circleFriends);
              // DO NOT CALL v BEFORE OR YOU LOSE FIRST INDEX
              while ($rowPosts = mysqli_fetch_array($run_circleFriends)) {

                $member_first = $rowPosts['user_firstName'];
                $member_last = $rowPosts['user_lastName'];
                $member_pic = $rowPosts['user_pic'];
                $member_id = $rowPosts['member_id'];
                $thisCreatorID = $rowPosts['creator_id'];

                if ($sessionUserID == $member_id){
                  echo "<li class='left clearfix'>
                        <span class='chat-img pull-left'>
                        <img src='../user/user_images/$member_pic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                        </span>
                        <div class='chat-body clearfix'>
                        <div class='header'>
                        <strong class='primary-font'>$member_first $member_last</strong>
                        <p>(You)</p>
                        </div>
                        </div>
                        </li>";
                } else {

                echo "<li class='left clearfix'>
                      <span class='chat-img pull-left'>
                      <img src='../user/user_images/$member_pic' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                      </span>
                      <div class='chat-body clearfix'>
                      <div class='header'>
                      <a href='../Pages/profile.php?userid=$member_id'>
                      <strong class='primary-font'>$member_first $member_last</strong>
                      </a>
                      <a href='../Pages/blog.php?userid=$member_id'>
                      <div class='pull-right'>
                      <i class='fa fa-rss fa-fw'></i>
                      </div>
                      </a>
                      <a href='../Pages/profile.php?userid=$member_id'>
                      <div class='pull-right'>
                      <i class='fa fa-home fa-fw'></i>
                      </div>
                      </a>
                      </div>
                      </div>
                      </li>";
                    }

              }

              if($thisCreatorID == $sessionUserID) {
              echo "
              <div style=\"text-align: center;\">
              <button center-block class=\"btn btn-danger\" data-href=\"../functions/delete_circle.php?circle_id=$thisCircleID\" data-toggle=\"modal\" data-target=\"#confirm-delete\">
              Delete Group
              </button>
              </div>
              ";
            }
            else {
              echo "
              <div style=\"text-align: center;\">
              <button center-block class=\"btn btn-primary\" data-href=\"../functions/leave_circle.php?circle_id=$thisCircleID&user_id=$sessionUserID\" data-toggle=\"modal\" data-target=\"#confirm-leave\">
              Leave Group
              </button>
              </div>
              ";
            }

            ;
              ?>

              <ul>

              </div>
              </div>
    </div>
    <!-- /#wrapper -->

    <!-- TEST -->

    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Flot Charts JavaScript -->
    <!-- <script src="../vendor/flot/excanvas.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.pie.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/flot/jquery.flot.time.js"></script>
    <script src="../vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="../data/flot-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
