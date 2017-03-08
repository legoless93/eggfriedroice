<?php
// session_start();
include("includes/connection.php");
include("login.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
                <a class="navbar-brand" href="index.php">mybebofacespacebook</a>

            </div>
            <!-- /.navbar-header -->

        </nav>

        <div id="content">
          <!-- <div>
            <img src="images/image.jpg" id="imageImg"/>
          </div> -->

          <div class="container">
          <div class="row">
          <div class="col-xs-4">
          <!-- <div class="container"> -->
            <h2>Sign Up</h2>
            <div class="panel panel-default" style="text-align: center;">
              <div class="panel-body">
                <div id="form2">
                  <form action="" method="post" style="padding:50px">

                          <input type="text" name="firstName" placeholder="First name" required="required"/>

                          <input type="text" name="lastName" placeholder="Last name" required="required"/>

                          <input type="email" name="e_mail" placeholder="Email address" required="required"/>

                          <input type="password" name="password" placeholder="Password" required="required"/>

                          <select name="gender">
                            <option>Select a gender</option>
                            <option>Male</option>
                            <option>Female</option>
                          </select>

                          <input type="date" name="birthday"/>
                          <br>
                          <button name="signUp">Sign Up</button>

                  </form>

                </div>
              </div>
            </div>
          <!-- </div> -->
        </div>

        <div class="col-xs-2">

      </div>

        <div class="col-xs-4">
        <!-- <div class="container"> -->
          <h2>Login</h2>
          <div class="panel panel-default">
            <div class="panel-body" style="text-align: center; padding:50px">
              <form method="post" action="" id="form1">
                <!-- <strong>Email:</strong> -->
                <input type="email" name="logEmail" placeholder="Email" required="required" width="100px"/>
                <br>
                <!-- <strong>Password:</strong> -->
                <input type="password" name="logPass" placeholder="Password" required="required"/>
                <br>
                <button name="login">Log in</button>
                <?php
                // include("login.php");
                ?>
              </form>
            </div>
          </div>
        <!-- </div> -->
      </div>

      </div>
      </div>



          <div id="form2">
            <form action="" method="post">
              <h1 style="color: black; padding-bottom: 20px;"> Sign Up </h1>
              <table>

                <tr>
                  <td align="right" style="color: black;">First name:</td>
                  <td>
                    <input type="text" name="firstName" placeholder="Please enter your first name" required="required"/>
                  </td>
                </tr>

                <tr>
                  <td align="right" style="color: black;">Surname:</td>
                  <td>
                    <input type="text" name="lastName" placeholder="Please enter your first surname" required="required"/>
                  </td>
                </tr>

                <tr>
                  <td align="right" style="color: black;">Email:</td>
                  <td>
                    <input type="email" name="e_mail" placeholder="Please enter your email address" required="required"/>
                  </td>
                </tr>

                <tr>
                  <td align="right" style="color: black;">Password</td>
                  <td>
                    <input type="password" name="password" placeholder="Please enter a password" required="required"/>
                  </td>
                </tr>

                <tr>
                  <td align="right" style="color: black;">Gender:</td>
                  <td>
                    <select name="gender">
                      <option>Select a gender</option>
                      <option>Male</option>
                      <option>Female</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td align="right" style="color: black;">Birthday:</td>
                  <td>
                    <input type="date" name="birthday"/>
                  </td>
                </tr>

                <tr>
                  <td colspan="6">
                    <button name="signUp">Sign Up</button>
                  </td>
                </tr>

              </table>
            </form>

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
