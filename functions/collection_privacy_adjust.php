<?php
session_start();
include ("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

//public
if(isset($_POST['change2public'])) {//public

    $collection_id = $_POST['change2public'];

    $adjust_collection_privacy = "UPDATE photocollections SET public = '1',friends = '0',friendsOfFriends = '0',private = '0',circle = '0' WHERE user_id = '$sessionUserID' AND collection_id = '$collection_id'";
    $run_adjust_collection_privacy = mysqli_query($con, $adjust_collection_privacy);


    if($run_adjust_collection_privacy) {

        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('private setting can not be changed!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

//private
if(isset($_POST['change2private'])) {

    $collection_id = $_POST['change2private'];

    $adjust_collection_privacy = "UPDATE photocollections SET public = '0',friends = '0',friendsOfFriends = '0',private = '1',circle = '0' WHERE user_id = '$sessionUserID' AND collection_id = '$collection_id'";
    $run_adjust_collection_privacy = mysqli_query($con, $adjust_collection_privacy);


    if($run_adjust_collection_privacy) {

        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('private setting can not be changed!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

//friends
if(isset($_POST['change2friends'])) {

    $collection_id = $_POST['change2friends'];

    $adjust_collection_privacy = "UPDATE photocollections SET public = '0',friends = '1',friendsOfFriends = '0',private = '0',circle = '0' WHERE user_id = '$sessionUserID' AND collection_id = '$collection_id'";
    $run_adjust_collection_privacy = mysqli_query($con, $adjust_collection_privacy);


    if($run_adjust_collection_privacy) {

        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('private setting can not be changed!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

//friendsOfFriends
if(isset($_POST['change2FOF'])) {

    $collection_id = $_POST['change2FOF'];

    $adjust_collection_privacy = "UPDATE photocollections SET public = '0',friends = '0',friendsOfFriends = '1',private = '0',circle = '0' WHERE user_id = '$sessionUserID' AND collection_id = '$collection_id'";
    $run_adjust_collection_privacy = mysqli_query($con, $adjust_collection_privacy);


    if($run_adjust_collection_privacy) {

        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('private setting can not be changed!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

//circle
if(isset($_POST['change2cirlce'])) {

    $collection_id = $_POST['change2cirlce'];

    $adjust_collection_privacy = "UPDATE photocollections SET public = '0',friends = '0',friendsOfFriends = '0',private = '0', photocollections.circle = '1' WHERE user_id = '$sessionUserID' AND collection_id = '$collection_id'";
    $run_adjust_collection_privacy = mysqli_query($con, $adjust_collection_privacy);


    if($run_adjust_collection_privacy) {

        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else {
        echo "<script>alert('private setting can not be changed!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }
}

?>
