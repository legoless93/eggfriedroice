<?php
session_start();
include ("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_POST['delete_collection'])){

    $this_collection_id = $_POST['delete_collection'];
    $get_photo_id = "SELECT * FROM photos WHERE collection_id = $this_collection_id";
    $show_photo_id = mysqli_query($con, $get_photo_id);

    while ($rowPhotoID = mysqli_fetch_array($show_photo_id)) {

    $this_photo_id = $rowPhotoID['photo_id'];

    $delete_photo = "DELETE  FROM photos WHERE photo_id = '$this_photo_id' ";
    $run_delete_photo = mysqli_query($con, $delete_photo);

    $delete_photo_like = "DELETE  FROM likes WHERE photo_id = '$this_photo_id' ";
    $run_delete_photo_like = mysqli_query($con, $delete_photo_like);

    $delete_photo_comment = "DELETE FROM comments WHERE photo_id = '$this_photo_id' ";
    $run_delete_photo_comment = mysqli_query($con,$delete_photo_comment);

    }

    $delete_collection = "DELETE FROM photocollections WHERE collection_id = '$this_collection_id' AND user_id = $sessionUserID";
    $run_delete_collection = mysqli_query($con, $delete_collection);

    if($run_delete_collection) {
        echo "<script>alert('collection deleted!!!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else{
      echo "<script>alert('fail to delete!')</script>";
      echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

?>
