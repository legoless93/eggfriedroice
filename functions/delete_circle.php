<?php
include ("../includes/connection.php");

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

     if($run_delete1 && $run_delete2 && $run_delete3) {

        echo "<script>alert('deleted')</script>";
          echo "<script type='text/javascript'> document.location = '../Pages/circles.php?userid=$user'; </script>";
        exit;
     }
}

?>
