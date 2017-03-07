<?php
session_start();
include("../includes/connection.php");

if(isset($_REQUEST['accept'])) {

    $thisFriend = $_REQUEST['accept'];
    

    $logged_email = $_SESSION['user_email'];

    $get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
    $run_userID = mysqli_query($con, $get_userID);
    $row = mysqli_fetch_array($run_userID);

    $sessionUserID = $row['user_id'];


    $update_accept_friend = "DELETE FROM friendrequests WHERE (sender_id='$thisFriend' AND receiver_id='$sessionUserID') "; 
    $accept_friend = "INSERT INTO friendshipbridge (user_id, friend_id) VALUES ('$sessionUserID','$thisFriend')";
    $run_accept_friend = mysqli_query($con, $accept_friend);
    $run_update_accept_friend = mysqli_query($con, $update_accept_friend);



 	if ($run_accept_friend && $run_update_accept_friend ){
    	// echo "<script>alert('Friend request accepted!!!')</script>";
     //    echo "<script>window.open('../Pages/friendsList.php', '_self')</script>";



 		/// friend list query 

 		$get_myFriends5 = "SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic from friendshipBridge
                                                  JOIN user ON friendshipBridge.user_id = user.user_id
                                                  WHERE friendshipBridge.friend_id = '$sessionUserID'
                                                  UNION ALL
                                                  SELECT user.user_firstName, user.user_lastName, user.user_id, user.user_pic FROM friendshipBridge
                                                  JOIN user ON friendshipBridge.friend_id = user.user_id
                                                  WHERE friendshipBridge.user_id = '$sessionUserID'";
                              $run_myFriends5 = mysqli_query($con, $get_myFriends5);
                              $check_myFriends5 = mysqli_num_rows($run_myFriends5); 


                              $output='';

                              while ($rowPosts = mysqli_fetch_array($run_myFriends5)) {


                              	$thisFriendID = $rowPosts['user_id'];
                                $thisFirstName = $rowPosts['user_firstName'];
                                $thisLastName = $rowPosts['user_lastName'];
                                $thisPhoto = $rowPosts['user_pic'];



 								$output .= 
 								"<li class='list-group-item clearfix'>
                                <a href='../home.php?userid=$thisFriendID'>


                                   	<div class='d-flex w-100 justify-content-between'>
                                   	 <img src='../user/user_images/$thisPhoto' alt='User Avatar' class='img-circle' style='width:50px;height:50px;'/>
                                        <h5 class='mb-1'>$thisFirstName $thisLastName</h5>
                                    </div>
                                    <p class='mb-1'>Display timestamp here or number of friends?</p>


                                </a>


                                <a class='delete_product' data-id=\"$thisFriendID\" href='javascript:void(0)'>
                                <i class='btn btn-danger  btn-xs glyphicon glyphicon-trash pull-right'></i>
                                </a>
                                


                                <a href='../Pages/blog.php?userid=$thisFriendID' title='Go to your friends blog'>

                                                <span  class='btn btn-primary  btn-xs glyphicon glyphicon-edit pull-right' ></span>

                                </a>

                                 <button data-toggle='modal' data-target='#view-modal' data-id=\"$thisFriendID\" id='getUser' class='btn btn-sm btn-info'><i class='glyphicon glyphicon-eye-open'></i> Mutual Friends</button>

                                </li>";

                                // echo $output;



    }

    echo $output;

  }
}
?>

<!-- // <div>
// 	<h3>hey you wanna accept <?php echo "$id"?></h3>
// </div> -->


<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!--  added changes here ( removed the 2 js ones at the bottom of the page )  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
 $(document).ready(function(){
  
  $('.delete_product').click(function(e){
   
   e.preventDefault();
   
   var pid = $(this).attr('data-id');
   var parent = $(this).parent("li");
   
   bootbox.dialog({
     message: "Are you sure you want to Delete ?",
     title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
     buttons: {
    success: {
      label: "No",
      className: "btn-success",
      callback: function() {
      $('.bootbox').modal('hide');
      }
    },
    danger: {
      label: "Delete!",
      className: "btn-danger",
      callback: function() {
       
       
       $.ajax({
        
        type: 'POST',
        url: '../functions/deleteFriendTest.php',
        data: 'delete='+pid
        
       })
       .done(function(response){
        
        bootbox.alert(response);
        parent.fadeOut('slow');

        // keep this ***************************************** 
        // but copy this
        // $('#f_sent').html(response);  
        
       })
       .fail(function(){
        
        bootbox.alert('Something Went Wrong ....');
                
       })
              
      }
    }
     }
   });
   
   
  });
  
 });

</script>
</head>


<body>

</body>
</html>