
<?php
session_start();
include("includes/connection.php");
?>

<!DOCTYPE html>

<html>
<head>
  <title>Welcome User!</title>
  <link rel="stylesheet" href="styles/home_style.css" media="all"/>
</head>

<body>
  <!-- Container starts here -->
  <div class="container">
    <div id="head_wrap">
      <div id="header">
        <ul id="menu">
          <li><a href="home.php">Home</a></li>
          <li><a href="members.php">Members</a></li>
          <strong>Topics:</strong>
          <!-- <?php

          $get_topics = "SELECT * FROM topics";
          $run_topics = mysqli_query($con, $get_topics);

          while($row=mysqli_fetch_array($run_topics)) {
            $topic_id=$row['topic_id'];
            $topic_title=$row['topic_title'];

            echo "<li><a href='home.php?topic=$topic_id'>$topic_title</a></li>";
          }

           ?> -->

        </ul>
        <form method="get" action="results.php" id="form1">
          <input type="text" name = "user_query" placeholder="Search a topic"/>
          <input type="submit" name="search" value="Search"/>
        </form>
      </div>
    </div>

<!-- Content starts here -->
    <div class="content">
      <div id="user_timeline">
        <div id="user_details">
          <?php

          $user = $_SESSION['user_email'];
          $get_user = "SELECT * FROM user WHERE user_email = '$user'";
          $run_user = mysqli_query($con, $get_user);
          $row = mysqli_fetch_array($run_user);

          $user_id = $row['user_id'];
          $user_firstName = $row['user_firstName'];
          $user_lastName = $row['user_lastName'];
          $user_pass = $row['user_password'];
          $user_email = $row['user_email'];
          $user_image = $row['user_pic'];
          $user_birthday = $row['user_DoB'];
          echo "
          <center>
          <p><img id='userImg' src='user/user_images/$user_image' width='200' height='200'/></p>
          <p><strong>Name: </strong>$user_firstName  $user_lastName</p>
          <p><strong>Birthday: </strong>$user_birthday</p>
          <p><a href='my_messages.php'>Messages</a></p>
          </center>
          ";
           ?>
        </div>

      </div>

      <div id="friends_box">
        <h3><u>You have (num) friend requests</u></h3>
      </div>

      <div id="circles_box">
        <h3><u>My circles</u></h3>
      </div>

    </div>
<!-- Content ends here -->

  </div>
  <!-- Container ends here -->

</body>
</html>
