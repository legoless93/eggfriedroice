
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

?>

<!DOCTYPE html>
<html lang="en">

<?php

include("../template/theme/head.php");

?>

<!-- <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script> -->

<script>
 $(document).ready(function(){
var d = $('#div1');
d.scrollTop(d.prop("scrollHeight"));
});
</script>


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

                  <?php

                  $get_circleName = "SELECT * FROM circles WHERE circle_id = '$get_circleID'";
                  $run_getName = mysqli_query($con, $get_circleName);
                  $row = mysqli_fetch_array($run_getName);

                  $circleName = $row['circle_name'];
                  $thisCircleID = $row['circle_id'];
                  // $get_circleName = "SELECT circleBridge.member_id FROM circleBridge
                  // JOIN circles ON circles.circle_id = circleBridge.circle_id
                  // WHERE circles.circle_id = '$get_circleID' ";

                  echo "<h1 class='page-header'>$circleName</h1>";

                  ?>
                </div>
                <!-- /.col-lg-12 -->

                <!--  -->
                <div class="row">
                    <div class="col-lg-8">
                      <div class="chat-panel panel panel-default">
                          <div class="panel-heading">
                              <i class="fa fa-comments fa-fw"></i> Chat
                          </div>
                      <!--  -->
                      <div class="panel-body" id="div1">
                          <ul class="chat">


                            <?php

                            $get_messages = "SELECT user.user_firstName, user.user_lastName, user.user_pic, messages.message_body, messages.sender_id, messages.message_time
                                              FROM messages JOIN user ON messages.sender_id = user.user_id WHERE messages.circle_id = '$get_circleID' ORDER BY message_id ASC";
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

                    </ul>
                </div>

              <!-- /.panel-body -->
              <div class="panel-footer">

                <form action="#" method="post">
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
                <!-- delete modal above-->

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
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="fa fa-users fa-fw"></i> Circle members:

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
                      <a href='../home.php?userid=$member_id'>
                      <strong class='primary-font'>$member_first $member_last</strong>
                      </a>
                      <a href='../Pages/blog.php?userid=$member_id'>
                      <div class='pull-right'>
                      <i class='fa fa-rss fa-fw'></i>
                      </div>
                      </a>
                      <a href='../home.php?userid=$member_id'>
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
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> --> -->

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
