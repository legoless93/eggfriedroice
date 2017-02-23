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

    // echo "<script>window.open('../Pages/circles.php?userid=$test', '_self')</script>";

     if($run_delete1 && $run_delete2) {

        echo "<script>alert('deleted')</script>";
        echo "<script>window.open('../Pages/circles.php?userid=$user', '_self')</script>";
     }
}

?>
