<?php
session_start();
include("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

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
                    <h1 class="page-header">Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">




            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> All About Me
                            <div class="pull-right">
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-gear"></i> <span class="caret"></span>
                                  </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="../Pages/editProfile.php">Edit profile info</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <?php

        $user = $_SESSION['user_email'];
        $get_user = "SELECT * FROM user WHERE user_id = '$sessionUserID'";
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
        <p><img id='userImg' src='../user/user_images/$user_image' width='200' height='200'/></p>
        </center>
        <form action='' method='post'>
        <div class='form-group' id='post_form'>
        <div>
            <label> <u>First Name</u></label>
            </div>

            <div>
            <label style='width: 70px;'> Current:</label> $user_firstName
            </div>

            <div>
            <label style='width: 70px;'> New: </label>
            <input name='edit_firstName' placeholder='Enter new first name' style='margin-bottom:30px;'>
        </div>

            <div>
                <label> <u>Surname</u></label>
                </div>

                <div>
                <label style='width: 70px;'> Current:</label> $user_lastName
                </div>

                <div>
                <label style='width: 70px;'> New: </label>
                <input name='edit_lastName' placeholder='Enter new last name' style='margin-bottom:30px;'>
            </div>

            <div>
              <label> <u>Birthday</u></label>
              </div>

              <div>
              <label style='width: 70px;'> Current:</label> $theBirthday
              </div>

              <div>
              <label style='width: 70px;'> New: </label>
              <input type='date' name='edit_birthday' style='margin-bottom:30px;'/>
            </div>

            <div>
              <label> <u>Password</u></label>
              </div>

              <div>
              <label style='width: 70px;'> Current:</label>
              <input type='password' name='edit_curPass'/>
              </div>

              <div>
              <label style='width: 70px;'> New:</label>
              <input type='password' name='edit_newPass' style='margin-bottom:20px;'/>
            </div>


        </div>

        ";

         ?>

<?php

// $curSet="null";

$getPriv = "SELECT * FROM privacy WHERE user_id = '$sessionUserID'";
$run_getPriv = mysqli_query($con, $getPriv);
$allPriv = mysqli_fetch_array($run_getPriv);

if($allPriv['public'] == 1) {
  $curSet = "public";
} else if($allPriv['friendsOfFriends'] == 1) {
  $curSet = "friendsOfFriends";
} else if($allPriv['friends'] == 1) {
  $curSet = "friends";
} else if($allPriv['private'] == 1) {
  $curSet = "private";
}

 // echo "<script>alert('cur set : $curSet !!!')</script>";

 ?>


         <div class="col-lg-8" align="center">
             <div class="panel panel-default">
                 <div class="panel-heading">
                     Privacy Settings For Profile
                 </div>
                 <!-- /.panel-heading -->
                 <div class="panel-body">
                     <div class="table-responsive">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>Privacy Level</th>
                                     <th>Please select</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr class="success">
                                     <td>Public</td>
                                     <td>
                                       <div class="radio">
                                           <label>
                                               <input type="radio" name="privacy" id="publicPrivacy" value="public" <?php echo ($curSet=='public')?'checked':'' ?>>
                                           </label>
                                       </div>
                                     </td>
                                 </tr>
                                 <tr class="info">
                                     <td>Friends of friends</td>
                                     <td>
                                       <div class="radio">
                                           <label>
                                               <input type="radio" name="privacy" id="fofPrivacy" value="friendsOfFriends" <?php echo ($curSet=='friendsOfFriends')?'checked':'' ?>>
                                           </label>
                                       </div>
                                     </td>
                                 </tr>
                                 <tr class="warning">
                                     <td>Friends</td>
                                     <td>
                                       <div class="radio">
                                           <label>
                                               <input type="radio" name="privacy" id="friendPrivacy" value="friends" <?php echo ($curSet=='friends')?'checked':'' ?>>
                                           </label>
                                       </div>
                                     </td>
                                 </tr>
                                 <tr class="danger">
                                     <td>Private</td>
                                     <td>
                                       <div class="radio">
                                           <label>
                                               <input type="radio" name="privacy" id="privatePrivacy" value="private" <?php echo ($curSet=='private')?'checked':'' ?>>
                                           </label>
                                       </div>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <!-- /.table-responsive -->
                 </div>
                 <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
         </div>

         <div>
         <button name='editIt' type='submit' class='btn btn-default' style = 'float: right; margin-left: 400px; margin-bottom: 30px;'>Confirm changes</button>
         </div>
       </form>

<?php


if(isset($_POST['editIt'])) {
  $editFields = array($_POST['edit_firstName'], $_POST['edit_lastName'], $_POST['edit_birthday'], $_POST['edit_curPass'], $_POST['edit_newPass']);
  $editTableFields = array('user_firstName', 'user_lastName', 'user_DoB', 'user_password');

  $passQuery = "SELECT user_password FROM user WHERE user_id = '$sessionUserID'";
  $runPassQuery = mysqli_query($con, $passQuery);
  $passResults = mysqli_fetch_array($runPassQuery);
  $curPass = $passResults['user_password'];

  for($i=0; $i<3; $i++) {
    if($editFields[$i] != "" && !empty($editFields[$i])) {
      $editQuery = "UPDATE user
                    SET ".$editTableFields[$i]." = '$editFields[$i]'".
                    "WHERE user_id = ".$sessionUserID;
      $run_editQuery = mysqli_query($con, $editQuery);

    }

  }

  if($editFields[3] != "" && $editFields[4] != "" && $editFields[3] == $curPass) {

    $editQuery = "UPDATE user
                  SET ".$editTableFields[3]." = '$editFields[4]'".
                  "WHERE user_id = ".$sessionUserID;
    $run_editQuery = mysqli_query($con, $editQuery);

  } else if($editFields[3] == "" && $editFields[4] == "") {

  } else {
    echo "<script>alert('You have typed in the wrong current password!!!')</script>";
  }

  $privacyAnswer = $_POST['privacy'];
  $privacyOptions = array('public', 'friendsOfFriends', 'friends', 'private');

foreach ($privacyOptions as $theOption) {
  if($privacyAnswer == $theOption) {
    $boolVal = 1;
  } else {
    $boolVal = 0;
  }
  $editQuery = "UPDATE privacy
                SET ".$theOption." = ".$boolVal.
                " WHERE user_id = ".$sessionUserID;

  $run_editQuery = mysqli_query($con, $editQuery);
  $run_editQuery;

}

  if($run_editQuery) {
    echo "<script>alert('You have successfully changed your details!!!')</script>";
    echo "<script>window.open('editProfile.php?', '_self')</script>";
  }

};

 ?>




                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Friends
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">

                              <?php



                              $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5);

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {

                                $thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];

                              echo "
                                <a href='../home.php?userid=$thisFriendID' class='list-group-item'>
                                    <i class='fa fa-user fa-fw'></i> $thisFirstName $thisLastName
                                    </span>
                                </a>
                                ";
                              };

                                ?>

                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">See All Friends</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i> Chat
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 14 mins ago</small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 15 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
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
