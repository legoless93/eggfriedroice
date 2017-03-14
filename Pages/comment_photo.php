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
                      $show_photo = mysqli_query($con, $get_photo);
                      $checkPhoto = mysqli_num_rows($show_photo);

                      while ($rowPhoto = mysqli_fetch_array($show_photo)) {

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
