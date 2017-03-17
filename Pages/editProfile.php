<?php
session_start();
include("../includes/connection.php");
include("../functions/upload_photo.php");

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

                      <?php

                      if($sessionUserID) {
                        echo "
                        <div class='pull-right'>
                            <div class='btn-group'>
                              <button type='button' class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown'>
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
        <form action='' method='post' id='a'  class='aa' enctype='multipart/form-data'>
        <p><img id='userImg' src='../user/user_images/$user_image' width='200' height='200'/></p>
        <label>change profile image</label>
        <br>
        <small>Please upload a square photo.</small>
        <br>
        <input type='file' name='myFile2' required = 'required' /><br>

        <div class='form-group' style ='margin-top:5px;'>
            <button name='upload_user_img' type='submit' class='btn btn-primary'>Update</button>
        </div>

        </form>
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
          <a class='btn btn-default btn-block' href='../Pages/profile.php?userid=<?php echo "$sessionUserID";?>' style = 'float: right; margin-left: 400px; margin-bottom: 10px;'>Cancel</a>
          <button name='editIt' type='submit' class='btn btn-primary btn-block' style = 'float: right; margin-left: 400px; margin-bottom: 30px;'>Confirm changes</button>
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
// if confirm is pressed with no changes
  if ($editFields[0] == "" && $editFields[1] == "" && $editFields[2] == "" && $editFields[3] == "" && $editFields[4] == ""){

    // echo "<script>alert('blank fields')</script>";
    // echo "<script>window.open('editProfile.php?', '_self')</script>";

  } else {

  $verifyPW = password_verify($editFields[3], $curPass);
  // if($editFields[3] != "" && $editFields[4] != "" && $editFields[3] == $curPass) {
  if($editFields[3] != "" && $editFields[4] != "" && $verifyPW) {

    $newPW_count = strlen($editFields[4]);
    if($newPW_count < 8){
      echo "<script>alert('minimum 8 characters please ffs do you want to get hacked?')</script>";
    } else {

    $hash_newPW = password_hash($editFields[4], PASSWORD_DEFAULT);
    $editQuery = "UPDATE user
                  SET ".$editTableFields[3]." = '$hash_newPW'".
                  "WHERE user_id = ".$sessionUserID;
    $run_editQuery = mysqli_query($con, $editQuery);
  }

  } else if($editFields[3] == "" && $editFields[4] == "") {

  } else {
    echo "<script>alert('You have typed in the wrong current password!!!')</script>";
  }

  echo "<script>alert('changes made')</script>";
  // echo "<script>window.open('profile.php?userid=$sessionUserID', '_self')</script>";

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
    echo "<script>alert('privacy changes modified')</script>";
    echo "<script>window.open('profile.php?userid=$sessionUserID', '_self')</script>";
  } else {
    echo "<script>window.open('profile.php?userid=$sessionUserID', '_self')</script>";
  }


};

 ?>




                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
