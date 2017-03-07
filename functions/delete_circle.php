<?php
include ("../includes/connection.php");

// $test1 = $_SESSION['test'];
// echo "<script>alert('$test1')</script>";

if(isset($_GET['circle_id'])){

    $circleID = $_GET['circle_id'];

    $get_userID = "SELECT * FROM circles WHERE circles.circle_id = $circleID";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $user = $row['creator_id'];

    $delete_circle1 = "DELETE FROM circles WHERE circles.circle_id = $circleID";
    $run_delete1 = mysqli_query($con, $delete_circle1);
    $delete_circle2 = "DELETE FROM circleBridge WHERE circleBridge.circle_id = $circleID";
    $run_delete2 = mysqli_query($con, $delete_circle2);
    $delete_messages = "DELETE FROM messages WHERE messages.circle_id = $circleID";
    $run_delete3 = mysqli_query($con, $delete_messages);

    // echo "<script>window.open('../Pages/circles.php?userid=$test', '_self')</script>";

     if($run_delete1 && $run_delete2 && $run_delete3) {

        echo "<script>alert('deleted')</script>";
          echo "<script type='text/javascript'> document.location = '../Pages/circles.php?userid=$user'; </script>";
        // echo "<script>window.open('../Pages/circles.php?userid=$user', '_self')</script>";
        // header("Location:../Pages/circles.php?userid=$user");
        // header("refresh:0.01; url=../Pages/circles.php?userid=$user");
        exit;
     }
}

?>
