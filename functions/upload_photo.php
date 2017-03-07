<?php
include("../includes/connection.php");


  if(isset($_POST['uploadsPhoto'])) {



        require_once '../functions/upload.class.php';
        $upload=new upload('myFile1','../uploads');
        $dest=$upload->uploadFile();

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];
    $photoDescription = $_POST['photo_description'];
    $photoColleciton = $_POST['collection_id'];
    $photoDay = date('d');
    $photoMonth = date('m');
    $photoYear = date('y');
    $addPhoto_collectionName = $_POST['photo_collection_name'];
    // $photoLink = $_POST['photo_link'];
    if (isset($_POST['select_collection'])) {
        $collectionArray = $_POST['select_collection'];
    }


    $insertPost = "INSERT INTO photos (user_id,collection_id,photo_description,photo_day, photo_month, photo_year, photo_link)
    VALUES ('$sessionUserID','$collectionArray[0]','$photoDescription','$photoDay', '$photoMonth', '$photoYear', '$dest')";
    $run_insertPost = mysqli_query($con, $insertPost);




    if($run_insertPost) {
    	echo "<script>alert('Yay!!! New post!!!')</script>";
    } else {
    	echo "<script>alert('Ahhh crap...')</script>";
    }
}

if (isset($_POST['select_collection'])) {
    $collectionArray = $_POST['select_collection'];
    // $collection_id_Array =

    // N: may have to add timeAdded to the database for extra query as if
    // the creator creates anotoher circle with the same name it'll be kinda peak.
    // $get_collection_id = "SELECT * FROM circles WHERE circle_name = '$circleName'
    //                 AND creator_id = '$userID'";
    // $run_CircleID = mysqli_query($con, $get_CircleID);
    // $row2 = mysqli_fetch_array($run_CircleID);
    //
    // $circleID = $row2['circle_id'];

    // for ($i=0; $i<count($collectionArray); $i++) {
    //   echo "<script>alert('$this_collection_id')</script>";}
    //
    //   $addFriend2Circle = "INSERT INTO circleBridge (member_id, circle_id) VALUES ($optionArray[$i],$circleID)";
    //   $run_insertAddFriend = mysqli_query($con, $addFriend2Circle);
      // $addFriend2Circle = "INSERT INTO cisrcleBridge (member_id, circle_id) VALUES ($optionArray[$i],99)";
      // echo "<script>alert($optionArray[$i])</script>";
    // }

    // foreach ($collectionArray as $key => $val){

      echo "<script>alert('$collectionArray[0]')</script>";

    // }
}


?>
