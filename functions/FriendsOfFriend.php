<?php
session_start();
include("../includes/connection.php");

  if(isset($_REQUEST['id'])) {


  	$id = intval($_REQUEST['id']);

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];


  }
?>


<ul class="chat">


                    <?php

                    	 // get requests that have been SENT
                            	$get_requests = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.receiver_id = user.user_id WHERE friendrequests.sender_id = '$sessionUserID'";

                            	$run_requests = mysqli_query($con, $get_requests);

                            	$request_sent_user_id_array = array();

                            	while ($rowPosts = mysqli_fetch_array($run_requests)){

                            		 $request_sent_user_id_array[] = $rowPosts['user_id'];
                            	}

                            	/////

                            	// get the requests that have been received

                            	$get_requests_as_receiver = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendrequests JOIN user ON friendrequests.sender_id = user.user_id WHERE friendrequests.receiver_id = '$sessionUserID'";

                            	$run_requests_as_receiver = mysqli_query($con, $get_requests_as_receiver);

                            	$request_received_user_id_array = array();

                            	while ($rowPosts = mysqli_fetch_array($run_requests_as_receiver)){

                            		 $request_received_user_id_array[] = $rowPosts['user_id'];
                            	}


                              /////

                              $get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$id'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$id'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5); // this is the number of friends



                              $get_myFriends6 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends6 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends6 = mysqli_num_rows($run_myFriends5); // this is the number of friends

                              $friends_user_id_array = array();

                                while($row = mysqli_fetch_array($run_myFriends6)) {

                                      $friends_user_id_array[] = $row['user_id'];
                                }

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {



                                $thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                $thisPhoto = $rowPosts['user_pic'];






                                			 if ($thisFriendID == $sessionUserID){

                                			// if the result is you

                                      echo "
                                			<li class='list-group-item clearfix'>
                                			<a href='../Pages/profile.php?userid=$thisFriendID'>
                                      <span class='chat-img pull-left'>
                                      <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                      &nbsp;
                                      </span>
                                      <div class='chat-body clearfix'>
                                      <div class='header'>
                                      <a href='../Pages/profle.php?userid=$thisFriendID'><strong class='primary-font'>$thisFirstName $thisLastName</strong></a>
                                      </div>
                                			</a>
                                			";



                                		} else if ((in_array($thisFriendID, $friends_user_id_array))){

                                			// if the results are already in your friends list

                                      echo "
                                      <li class='list-group-item clearfix'>
                                            <span class='chat-img pull-left'>
                                            <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                            &nbsp;
                                            </span>
                                            <div class='chat-body clearfix'>
                                            <div class='header'>
                                            <a href='../Pages/profle.php?userid=$thisFriendID'><strong class='primary-font'>$thisFirstName $thisLastName</strong></a>
                                            </div>
                                    				<a title='You are friends'>
                                            		<span class='btn btn-success  btn-xs pull-right'><i class='fa fa-check'></i></span>
                                    				</a>
                                            <a href='../Pages/blog.php?userid=$thisFriendID' title='Go to your friends blog'>
                                            		<span  class='btn btn-primary btn-xs pull-right'><i class='fa fa-rss fa-fw'></i></span>
                                    				</a>
                                            </div>
                                            </li>


                                 			";


                                 			// *** need to add another else here to check if you have send a friend request to them OR if you have received one from them -

                                		}
                                		else if((in_array($thisFriendID, $request_sent_user_id_array))) {

                                			// if you have  pending friend request ( sent )
                                      echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../Pages/profile.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                				</a>
                                			";

                                			echo "
                                			<a href='' title='Pending Friend Request'>

                                        	<span  class='label label-primary pull-right' style='padding:5px'>Pending</span>

                              				</a>

                                			</li>
                                 			";


                                		}
                                		else if((in_array($thisFriendID, $request_received_user_id_array))) {

                                			// if you have  pending friend request ( sent )
                                      echo "
                                			<li class='list-group-item clearfix'>
                                				<a href='../Pages/profile.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                				</a>
                                			";

                                			echo "
                                			<a href='' title='Pending Friend Request'>

                                        	<span  class='label label-primary pull-right' style='padding:5px'>They have sent you a friend request</span>

                              				</a>

                                			</li>
                                 			";

                                		}
                                			else {

                                			// they are not your friend

                                      echo "

                                			<li class='list-group-item clearfix'>
                                				<a href='../Pages/profile.php?userid=$thisFriendID'>


                                   				<div class='d-flex w-100 justify-content-between'>
                                   	 			<img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        		<h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    			</div>
                                				</a>
                                			";
                                				echo "
                                			<a href=\"../functions/add_friends.php?thisFriend=$thisFriendID\" title='Send Friend Request'>

                                        		<span  class='btn btn-primary  btn-xs glyphicon glyphicon-plus pull-right' ></span>

                                			</a>
                                			</li>
                                 			";


                                		}
                                	}





                    ?>



                    </ul>
