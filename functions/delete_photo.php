<?php
session_start();
include ("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_POST['deletePhoto'])) {

    $photo_id = $_POST['deletePhoto'];

    $delete_photo = "DELETE  FROM photos WHERE photo_id = '$photo_id'";
    $run_delete_photo = mysqli_query($con, $delete_photo);

    $delete_photo_like = "DELETE  FROM likes WHERE photo_id = '$photo_id'";
    $run_delete_photo_like = mysqli_query($con, $delete_photo_like);

    $delete_photo_comment = "DELETE FROM comments WHERE photo_id = '$photo_id'";
    $run_delete_photo_comment = mysqli_query($con,$delete_photo_comment);

    if($run_delete_photo && $run_delete_photo_like && $run_delete_photo_comment ) {
        echo "<script>alert('Photo deleted!!!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('Photo not deleted!!!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}
?>
