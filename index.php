<?php
// session_start();
include("includes/connection.php");
include("login.php");
include("user_insert.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>mybebofacespacebook</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="color:white;">mybebofacespacebook</a>

            </div>
            <!-- /.navbar-header -->
          <ul class="nav navbar-top-links navbar-right" style="transform: translateY(50%); padding-right: 5px;">
            <form method="post" action="" id="form1">

              <input type="email" name="logEmail" placeholder="Email" required="required" width="100px"/>
              <!-- <br> -->

              <input type="password" name="logPass" placeholder="Password" required="required"/>
              <!-- <br> -->
              <button class="btn btn-default btn-sm" name="login">Log in</button>
              <?php
              // include("login.php");
              ?>
            </form>
          </ul>

        </nav>

        <div id="content">
          <!-- <div>
            <img src="images/image.jpg" id="imageImg"/>
          </div> -->

          <div class="container">

            <div class="title" style="padding-top: 25px; padding-bottom:25px">
            <style>
div.title h1 {
  display: block;
  /*font-size: 6em;*/
  font-size: 6vw;
  /*padding-left: 10%;*/
  margin-top: 0.67em;
  margin-bottom: 0.67em;
  margin-left: 0;
  margin-right: 0;
  font-weight: bold;
}
</style>
            <h1 class="test">Welcome to mybebofacespacebook.</h1>
          </div>
          <div class="row">

            <script>
            .center {
    margin: auto;
    width: 100%
    padding: 100px;
}
            </script>
          <div class="col-xs-6" class="center">

          <!-- <div class="container"> -->
            <!-- <h1>Sign Up</h1> -->
            <div class="panel panel-default" style="text-align: center;">
              <!-- <div class="panel-heading" style="background-color:#428bca">
                <h2 style="color:white">Sign Up</h2>
              </div> -->

              <style>

              div.test input {
                  width: 100%;
                  height: 50px;
                  font-size: 21px;
                  color: grey;
              }
              span {
                  display: block;
                  overflow: hidden;
                  /*padding-right:10px;*/
              }
              div.test button {
                  /*float: right;*/
                  width: 100%;
                  height: 50px;
                  font-size: 21px;
              }
              select {
                width: 100%;
                height: 50px;
                font-size: 21px;
                color: grey;
              }
}
              </style>

              <!-- <div class="panel-body"> -->
                <!-- <h1 style="font-weight:bold">Sign Up</h1> -->

                <div id="form2" class="test">
                  <form action="" method="post">
                          <input type="text" name="firstName" placeholder="First name" required="required"/>
                          <br>
                          <input type="text" name="lastName" placeholder="Last name" required="required"/>
                          <br>
                          <input type="email" name="e_mail" placeholder="Email address" required="required"/>
                          <br>
                          <input type="password" name="password" placeholder="Password" required="required"/>
                          <br>
                          <select name="gender">
                            <option>Select a gender</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                          <br>
                          <input type="date" name="birthday"/>
                          <br>
                          <button class="btn btn-primary" name="signUp">Sign Up</button>

                  </form>

                </div>
              <!-- </div> -->
            </div>
          <!-- </div> -->
        </div>

        <!-- <div class="col-xs-2">

        </div> -->

        <!-- <div class="col-xs-4">
          <h2>Login</h2>
          <div class="panel panel-default">
            <div class="panel-body" style="text-align: center; padding:50px">
              <form method="post" action="" id="form1">

                <input type="email" name="logEmail" placeholder="Email" required="required" width="100px"/>
                <br>

                <input type="password" name="logPass" placeholder="Password" required="required"/>
                <br>
                <button name="login">Log in</button>
                <?php
                // include("login.php");
                ?>
              </form>
            </div>
          </div>

        </div> -->

        </div>
        </div>


        </div>

                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
