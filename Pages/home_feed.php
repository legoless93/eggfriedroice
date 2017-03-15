<?php
session_start();
include("../includes/connection.php");

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];

if(isset($_GET['userid'])) {
  $userID = $_GET['userid'];
}

?>



<!DOCTYPE html>
<html lang="en">

<?php

include("../template/theme/head.php");

?>

<body>

    <div id="wrapper">

      <!-- NAVIGATION TEMPLATE HERE -->
      <?php

      include("../template/theme/header.php");
      include("../template/theme/sidebar.php");

      ?>

      <div id="page-wrapper">
      <!-- Where POSTS begin -->
      <br>
      <br>
      <!-- <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Feed(me)</h1>
          </div>

      </div> -->
      <!-- ROW DIV -->

      <style>

.timeline-centered {
    position: relative;
    margin-bottom: 30px;
}

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 4px;
        background: #f5f5f6;
        /*left: 50%;*/
        top: 20px;
        bottom: 20px;
        margin-left: 30px;
    }

    .timeline-centered .timeline-entry {
        position: relative;
        margin-top: 5px;
        margin-left: 30px;
        margin-bottom: 10px;
        clear: both;
    }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

            .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
                margin-left: 0;
                margin-right: -18px;
            }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
                    left: auto;
                    right: -100px;
                    text-align: left;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
                    float: right;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
                    margin-left: 0;
                    margin-right: 70px;
                }

                    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
                        left: auto;
                        right: 0;
                        margin-left: 0;
                        margin-right: -9px;
                        -moz-transform: rotate(180deg);
                        -o-transform: rotate(180deg);
                        -webkit-transform: rotate(180deg);
                        -ms-transform: rotate(180deg);
                        transform: rotate(180deg);
                    }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -20px;
        }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
                position: absolute;
                left: -100px;
                text-align: right;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
                    display: block;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
                        font-size: 15px;
                        font-weight: bold;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
                        font-size: 12px;
                    }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                background: #fff;
                color: #737881;
                display: block;
                width: 40px;
                height: 40px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
                text-align: center;
                -moz-box-shadow: 0 0 0 5px #f5f5f6;
                -webkit-box-shadow: 0 0 0 5px #f5f5f6;
                box-shadow: 0 0 0 5px #f5f5f6;
                line-height: 40px;
                font-size: 15px;
                float: left;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
                    background-color: #428bca;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
                    background-color: #ee4749;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
                    background-color: #428bca;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
                    background-color: #21a9e1;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-grey {
                    background-color: #f5f5f6;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
                    background-color: #fad839;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
                    background-color: #cc2424;
                    color: #fff;
                }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
                position: relative;
                background: #f5f5f6;
                padding: 1em;
                margin-left: 60px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 9px 9px 9px 0;
                    border-color: transparent #f5f5f6 transparent transparent;
                    left: 0;
                    top: 10px;
                    margin-left: -9px;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
                    color: #737881;
                    font-family: "Noto Sans",sans-serif;
                    font-size: 12px;
                    margin: 0;
                    line-height: 1.428571429;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
                        margin-top: 15px;
                    }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
                        color: #303641;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
                        -webkit-opacity: .6;
                        -moz-opacity: .6;
                        opacity: .6;
                        -ms-filter: alpha(opacity=60);
                        filter: alpha(opacity=60);
                    }


      </style>

      <!-- <div class="container"> -->
	<div class="row">

      <div class="col-xs-8">
        <div class="timeline-centered">

        <!-- TEST WITH QUERY HERE -->

        <?php

        $get_myFriends5 = "SELECT * FROM (SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic, posts.post_title, posts.post_body, posts.post_time, posts.post_id FROM friendshipBridge
                            JOIN user ON friendshipBridge.friend_id = user.user_id
                            JOIN posts ON posts.user_id = user.user_id
                            WHERE friendshipBridge.user_id = '$userID'
                            UNION
                            SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic, posts.post_title, posts.post_body, 		posts.post_time, posts.post_id FROM friendshipBridge
                            JOIN user ON friendshipBridge.friend_id = user.user_id
                            JOIN posts ON posts.user_id = user.user_id
                            WHERE friendshipBridge.user_id = '$userID')friendPost
                            UNION SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic, posts.post_title, posts.post_body, posts.post_time, posts.post_id FROM posts JOIN user ON posts.user_id = user.user_id WHERE posts.user_id = '$userID' ORDER BY post_id DESC";

        $run_myFriends5 = mysqli_query($con, $get_myFriends5);
        $check_myFriends5 = mysqli_num_rows($run_myFriends5);

        $friends = array();

        while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {

          $thisFriendID = $rowPosts['user_id'];
          $thisFirstName = $rowPosts['user_firstName'];
          $thisLastName = $rowPosts['user_lastName'];
          $thisPhoto = $rowPosts['user_pic'];
          $thisPostID = $rowPosts['post_id'];
          $thisPostTitle = $rowPosts['post_title'];
          $thisPostBody = $rowPosts['post_body'];
          $thisPostTime = $rowPosts['post_time'];

          // $friends[] = $thisFriendID;

          if ($thisFriendID == $sessionUserID){

            echo "        <article class=\"timeline-entry\">

                          <div class=\"timeline-entry-inner\">

                              <div class=\"timeline-icon bg-grey\">
                                  <i class=\"entypo-feather\"></i>
                              </div>

                              <div class=\"timeline-label\">
                                  <h2><a href=\"#\">$thisFirstName $thisLastName</a> <span>posted a <a>blog</a> on <a>$thisPostTime</a></span></h2>
                                  <p>$thisPostTitle</p>
                                  <p>$thisPostBody</p>
                              </div>
                          </div>

                      </article>";

          } else {

            $initialF = $thisFirstName[0];
            $initialL = $thisLastName[0];

          echo "        <article class=\"timeline-entry\">

                        <div class=\"timeline-entry-inner\">

                            <div class=\"timeline-icon bg-primary\">
                            <i class=\"entypo-feather\"></i>$initialF$initialL
                            </div>

                            <div class=\"timeline-label\">
                                <h2><a href=\"#\">$thisFirstName $thisLastName</a> <span>posted a <a>blog</a> on <a>$thisPostTime</a></span></h2>
                                <p>$thisPostTitle</p>
                                <p>$thisPostBody</p>
                            </div>
                        </div>

                    </article>";
        }

        };

        ?>

        <article class="timeline-entry begin">

            <div class="timeline-entry-inner">

                <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                    <i class="entypo-flight"></i> +
                </div>

            </div>

        </article>

    </div>

  </div>

  <div class="col-xs-4">
  <div class="chat-panel panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-user-plus fa-fw"></i> Recommended Friends

      </div>

      <div class="panel-body">
          <ul class="chat">
              <?php
              $recommendedFriendsList = array();
              include ("../functions/similarInterestsFiltering.php");
              include ("../functions/recommendedFriends.php");
               ?>
          </ul>
      </div>

  </div>
</div>
<!-- ROW BELOW -->
	</div>
<!-- </div> -->


	</div>
</div>


    </div>

    </div>
    <!-- jQuery -->
    <!-- <script src="../vendor/jquery/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
