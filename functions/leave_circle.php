<?php
include ("../includes/connection.php");

if(isset($_GET['circle_id'])){

    $circleID = $_GET['circle_id'];
    $user = $_GET['user_id'];

    $leave_circle2 = "DELETE FROM circleBridge WHERE circleBridge.circle_id = $circleID AND circleBridge.member_id = $user";
    $run_leave2 = mysqli_query($con, $leave_circle2);

     if($run_leave2) {

        echo "<script>alert('left')</script>";
          echo "<script type='text/javascript'> document.location = '../Pages/circles.php?userid=$user'; </script>";

        exit;
     }
}

?>
