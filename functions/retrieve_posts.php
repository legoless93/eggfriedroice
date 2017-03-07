<?php
include("../includes/connection.php");
include("new_post.php");

$get_myPosts = "SELECT * FROM posts WHERE user_id = '$userID'";
$run_myPosts = mysqli_query($con, $get_myPosts);
$rowPosts = mysqli_fetch_array($run_myPosts);



?>
