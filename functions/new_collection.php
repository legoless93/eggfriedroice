<?php
include("../includes/connection.php");

  if(isset($_POST['createCollection'])) {

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];

    $collectionName = $_POST['collection_name'];
    // get user collection name via user's input

    $collectionPrivacy = $_POST['collectionPrivacy'];
    // get collection privacy via user's selection in form table

    if($collectionPrivacy == 'public') {
        $collectionPublic = '1';
    }else if ($collectionPrivacy == 'private'){
        $collectionPrivate = '1';
    }else if($collectionPrivacy == 'friends'){
        $collectionFriends = '1';
    }else if($collectionPrivacy == 'FoF'){
        $collectionFOF = '1';
    }else{
        $collectionCircle = '1';
    }

    $insertCollection = "INSERT INTO photoCollections (collection_name,public,friends,friendsOfFriends,private,circle, user_id)
    VALUES ('$collectionName','$collectionPublic','$collectionFriends','$collectionFOF','$collectionPrivate','$collectionCircle', $sessionUserID)";
    // insert query for adding the collection information to the table
    $run_insertCollection = mysqli_query($con, $insertCollection);

    if($run_insertCollection) {
      echo "<script>alert('collection created')</script>";
    } else {
      echo "<script>alert('fail to create')</script>";
    }

  }
?>
