<?php
session_start();
include ("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_REQUEST['post_id'])) {

    $post_id = $_REQUEST['post_id'];

    $delete_post = "DELETE FROM posts WHERE post_id = '$post_id'";
    // $delete_post = "DELETE FROM blogPosts WHERE post_id = '$post_id'";
    $run_delete = mysqli_query($con, $delete_post);

    if($run_delete) {

      echo "<script>window.open('../Pages/blog.php?userid=$sessionUserID', '_self')</script>";
        // echo "<script type='text/javascript'> document.location = '../Pages/blog.php?userid=$sessionUserID'; </script>";
    }

}

?>
