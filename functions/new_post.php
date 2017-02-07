<?php
include("../includes/connection.php");

  if(isset($_POST['postIt'])) {

    $postTitle = $_POST['post_title'];
    $postBody = $_POST['post_body'];
    $date = date("y-m-d");
  }
?>
