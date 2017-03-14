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


//user image
if(isset($_POST['upload_user_img'])) {

      require_once '../functions/upload.class.php';
      $upload=new upload('myFile2','../user/user_images/');
      $dest2=$upload->uploadFile();

  $logged_email = $_SESSION['user_email'];

  $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
  $run_userID = mysqli_query($con, $get_userID);
  $row = mysqli_fetch_array($run_userID);

  $sessionUserID = $row['user_id'];

  $update_user_img = "UPDATE user SET user_pic = '$dest2' WHERE user_id = '$sessionUserID'";

  $run_update_user_img = mysqli_query($con, $update_user_img);

  if($run_update_user_img) {
    echo "<script>alert('Yay!!! New profile img!!!')</script>";
    echo "<script>alert('$new_image,$src')</script>";
  } else {
    echo "<script>alert('$dest2,$sessionUserID')</script>";
    echo "<script>alert('profile img not uploaded...')</script>";
  }
}

?>
