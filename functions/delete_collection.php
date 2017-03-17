<?php
include ("../includes/connection.php");

// session_start();

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];
$collection_id = $_GET['collection_id'];

if(isset($_POST['delete_collection'])) {

    $collection_id = $_GET['collection_id'];


    $delete_collection = "DELETE FROM photoCollections WHERE collection_id = '$collection_id'";

    $run_delete = mysqli_query($con, $delete_collection);

    if($run_delete) {
        echo "<script>alert('collection deleted!!!')</script>";
        echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }else{
      echo "<script>alert('fail to delete!')</script>";
      echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
    }

}else{
  echo "<script>alert('not get collection id!')</script>";
  echo "<script>window.open('../Pages/photocollection.php?userid=$sessionUserID', '_self')</script>";
}

?>
