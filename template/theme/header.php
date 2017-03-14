<?php
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

<script>
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../functions/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json"

    })

   .done(function(data){


    // <?php
    // echo "<script>alert('in success!!!')</script>";
    // ?>


    // if(data.unseen_notification > 0)
    // {
    //  $('.count').html(data.unseen_notification);
    // }
    $('#d_list').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }

   })

   .fail(function(){
          $('#d_list').html('get NOTIFICATIONS failed WHYYYYYYy');
          // $('#modal-loader').hide();
     });
   }

  load_unseen_notification();

 // $('#comment_form').on('submit', function(event){
 //  event.preventDefault();
 //  if($('#subject').val() != '' && $('#comment').val() != '')
 //  {
 //   var form_data = $(this).serialize();
 //   $.ajax({
 //    url:"insert.php",
 //    method:"POST",
 //    data:form_data,
 //    success:function(data)
 //    {
 //     $('#comment_form')[0].reset();
 //     load_unseen_notification();
 //    }
 //   });
 //  }
 //  else
 //  {
 //   alert("Both Fields are Required");
 //  }
 // });

 $(document).on('click', '#getTest', function(){
  $('.count').html('');

  // uncomment below to read the notification
  load_unseen_notification('yes');

  // uncomment below to not remove the notification
  // load_unseen_notification();


 });




 // setInterval(function(){
 //  load_unseen_notification();;
 // }, 5000);


 // $("#div1").animate({ scrollTop: $('#div1').prop("scrollHeight")}, 1000);

});
</script>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-brand" href="../Pages/home_feed.php?userid=<?php echo "$sessionUserID"; ?>" style="color:white;">mybebofacespacebook</a>
    </div>
    <!-- /.navbar-header -->
    <!-- STARTS HERE -->
    <ul class="nav navbar-top-links navbar-right">
      <li>
        <a href="../Pages/home_feed.php?userid=<?php echo "$sessionUserID"; ?>"><i class ="fa fa-home fa-fw" style="border-radius:10px; font-size:17px; color:white;"></i></a>
      </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle test" data-toggle="dropdown" href="#" id='getTest'>
              <!--   <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a> -->
            <span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="fa fa-bell fa-fw" style="font-size:13px; color:white;"></span></a>
            <ul class="dropdown-menu dropdown-alerts" id='d_list'>


            </ul>

        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id='logOutD'>
                <i class="fa fa-user fa-fw" style="color:white;"></i> <i class="fa fa-caret-down" style="color:white;"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">

                <li><a href="../functions/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>

    <!-- ENDS HERE -->

<!-- </nav> -->
