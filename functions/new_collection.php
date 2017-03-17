<?php
include("../includes/connection.php");

  if(isset($_POST['createCollection'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $collectionName = $_POST['collection_name'];

    $collectionPrivacy = $_POST['collectionPrivacy'];

    $collectionPublic = '0';
    $collectionPrivate = '0';
    $collectionFriends = '0';
    $collectionFOF = '0';
    $collectionCircle = '0';

    if($collectionPrivacy == 'public') {
        $collectionPublic = '1';
    }else if ($collectionPrivacy == 'private'){
        $collectionPrivate = '1';
    }else if($collectionPrivacy == 'friends'){
        $collectionFriends = '1';
    }else if($collectionPrivacy == 'FoF'){
        $collectionFOF = '1';
    }else if($collectionPrivacy == 'circle'){
        $collectionCircle = '1';
    }

    // echo "<script>alert('$collectionName,$collectionPublic,$collectionFriends,$collectionCircle,$collectionFOF,$collectionPrivate,$sessionUserID')</script>";

    $insertCollection = "INSERT INTO photocollections (collection_name,public,friends,friendsOfFriends,private,photocollections.circle, user_id)
    VALUES ('$collectionName','$collectionPublic','$collectionFriends','$collectionFOF','$collectionPrivate','$collectionCircle', '$sessionUserID')";

    $run_insertCollection = mysqli_query($con, $insertCollection);

    if($run_insertCollection) {
      echo "<script>alert('collection created')</script>";
    } else {
      echo "<script>alert('fail to create')</script>";
    }

  }
?>
