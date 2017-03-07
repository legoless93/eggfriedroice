<?php
include("../includes/connection.php");

  if(isset($_POST['createCollection'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $collectionName = $_POST['collection_name'];
    $collectionPublic = $_POST['public'];
    $collectionFriends = $_POST['friends'];
    $collectionFOF = $_POST['friendsOfFriends'];
    $collectionPrivate = $_POST['private'];
    $collectionCircle = $_POST['circle'];


    $insertCollection = "INSERT INTO photoCollections (collection_name,public,friends,friendsOfFriends,private,circle)
    VALUES ('$collectionName','$collectionPublic','$collectionFriends','$collectionFOF','$collectionPrivate','$collectionCircle')";

    $run_insertCollection = mysqli_query($con, $insertCollection);

    if($run_insertCollection) {
      echo "<script>alert('Yay!!! New post!!!')</script>";
    } else {
      echo "<script>alert('Ahhh crap...')</script>";
    }

  }
?>
