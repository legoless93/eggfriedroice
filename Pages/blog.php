<?php
session_start();
include("../includes/connection.php");
include("../functions/new_post.php");

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

<script>
 $(document).ready(function(){

  $('.delete_product').click(function(e){

   e.preventDefault();

   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");

   bootbox.dialog({
     message: "Are you sure you want to delete your post?",
     title: "<i class='glyphicon glyphicon-trash'></i> Deleting post!",
     buttons: {

    danger: {
      label: "Delete",
      className: "btn-danger",
      callback: function() {


       $.ajax({

        type: 'POST',
        url: '../functions/delete_post.php',
        data: 'post_id='+pid

       })
       .done(function(response){

        bootbox.alert(response);
        parent.fadeOut('fast');
        fade('hi');

       })
       .fail(function(){

        bootbox.alert('Something Went Wrong ....');

       })

      }
    }
     }
   });

  });

 });

</script>
<script>
function fade(id=""){
  $('id').fadeOut('fast');
}
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
                    <h1 class="page-header">
                      <?php
                      $currentBlog = $_GET['userid'];

                      $queryName = "SELECT user_firstName, user_lastName FROM user WHERE user_id = $currentBlog";
                      $runQueryName = mysqli_query($con, $queryName);
                      $rowQueryName = mysqli_fetch_array($runQueryName);
                      echo "$rowQueryName[0] $rowQueryName[1]'s ";
                      ?>
                      Blog</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
                      // $get_myPosts = "SELECT * FROM blogPosts WHERE user_id = '$userID' ORDER BY post_id DESC";

                      $run_myPosts = mysqli_query($con, $get_myPosts);
                      $checkPosts = mysqli_num_rows($run_myPosts);

                      while ($rowPosts = mysqli_fetch_array($run_myPosts)) {

                        $thisPostID = $rowPosts['post_id'];
                        $thisTitle = $rowPosts['post_title'];
                        $thisBody = $rowPosts['post_body'];

                        $thisTime = $rowPosts['post_time'];

                        echo "<li id='hi' class=\"left clearfix\">
                                <div class=\"header\">
                                    <strong class=\"primary-font\"> $thisTitle</strong>
                                    <small class=\"text-muted\">

                                        <i class=\"fa fa-clock-o fa-fw\"></i> Posted: $thisTime
                                    </small>
                                    ";
                                    if($userID == $sessionUserID) {
                                    echo "

                                                <a class='delete_product pull-right' data-id=\"$thisPostID\" href='javascript:void(0)'><i class='glyphicon glyphicon-trash' style='color:#000'></i></a>



                                        ";
                                      };
                                      echo "
                                </div>
                                <p> $thisBody</p>
                        </li>";

                      };
                      ?>

                    </ul>
                </div>
                <!-- /.panel-body -->
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
                                    <a class='btn btn-danger' href='../functions/delete_post.php?post_id=$thisPostID'>Delete</a>
                                    ";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.panel-footer -->
            </div>
            <!-- chat panel above -->

            <!-- /.row -->
                        <?php

                        if($userID == $sessionUserID) {
                          echo "


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
                     <button name='postIt' type='submit' class='btn btn-primary' style = 'float: right'>Post</button>
                   </form>
                                    </div>

                                </div>



                        ";
                      };

                        ?>
                <!-- /.row -->

            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</div>
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
