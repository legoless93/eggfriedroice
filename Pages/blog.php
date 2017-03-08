<?php
session_start();
include("../includes/connection.php");
include("../functions/new_post.php");
include("../functions/delete_post.php");
// include("../functions/retrieve_posts.php");

$logged_email = $_SESSION['user_email'];

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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Blog</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">




            </div>
<!-- /.row -->
            <?php

            if($userID == $sessionUserID) {
              echo "
            <div class='row'>

                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <i class='fa fa-edit fa-fw'></i> Add a new post
                        </div>
                        <!-- /.panel-heading -->
                        <div class='panel-body'>
         <form method='post'>
         <div class='form-group' id='post_form'>
             <label> Title</label>
                 <label>Text Input with Placeholder</label>
                 <input method='post' name='post_title' class='form-control' placeholder='Enter Title' style='margin-bottom:10px;'>
                <label>Post body</label>
             <textarea method='post' name='post_body' class='form-control' rows='3'></textarea>
         </div>
         <button name='postIt' type='submit' class='btn btn-default' style = 'float: right'>Post</button>
       </form>
                        </div>

                    </div>
                </div>


            ";
          };

            ?>
    <!-- /.row -->



            <!-- Where POSTS begin -->
            <div class="chat-panel panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-comments fa-fw"></i> Posts
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="chat">

                      <?php

                      $get_myPosts = "SELECT * FROM posts WHERE user_id = '$userID' ORDER BY post_id DESC";
                      $run_myPosts = mysqli_query($con, $get_myPosts);
                      $checkPosts = mysqli_num_rows($run_myPosts);

                      while ($rowPosts = mysqli_fetch_array($run_myPosts)) {

                        $thisPostID = $rowPosts['post_id'];
                        $thisTitle = $rowPosts['post_title'];
                        $thisBody = $rowPosts['post_body'];
                        $thisDay = $rowPosts['post_day'];
                        $thisMonth = $rowPosts['post_month'];
                        $thisYear = $rowPosts['post_year'];
                        $thisFullDate = sprintf("%02d", $thisDay) . "-" . sprintf("%02d", $thisMonth) . "-" . strval($thisYear);

                        echo "<li class=\"left clearfix\">
                            <div class=\"chat-body clearfix\">
                                <div class=\"header\">
                                    <strong class=\"primary-font\"> $thisTitle!!!</strong>
                                    <small class=\"text-muted\">
                                        <i class=\"fa fa-clock-o fa-fw\"></i> Date of post: $thisFullDate
                                    </small>
                                    ";
                                    if($userID == $sessionUserID) {
                                    echo "
                                        <div class=\"pull-right btn-group\">
                                          <button type=\"button\" class=\"btn btn-primary btn-sm dropdown-toggle\" data-toggle=\"dropdown\">
                                              <i class=\"fa fa-gear\"></i> <span class=\"caret\"></span>
                                          </button>
                                            <ul class=\"dropdown-menu pull-right\" role=\"menu\">
                                                <li><a href=\"../functions/delete_post.php?post_id=$thisPostID\"><i class=\"fa fa-edit fa-fw\"></i> Delete post</a>
                                                </li>
                                            </ul>
                                        </div>
                                        ";
                                      };
                                      echo "
                                </div>
                                <p> $thisBody</p>
                            </div>
                        </li>";

                      };
                      ?>

                    </ul>
                </div>
                <!-- /.panel-body -->
                <!-- /.panel-footer -->
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>
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
