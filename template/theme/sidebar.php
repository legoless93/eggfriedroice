<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li class="sidebar-search">
              <form class="input-group custom-search-form" action ="../Pages/SearchResult.php" method="GET">
                  <input type="text" name="query" class="form-control" placeholder="Search users" >
                  <span class="input-group-btn">
                    <input type="submit" value="Search" class='btn btn-default'/>
                  </span>
              </form>
          </li>
            <li>
              <?php
              echo "
                <a href='../Pages/profile.php?userid=$sessionUserID'><i class='fa fa-user fa-fw'></i> Profile</a>
                ";
                ?>
            </li>
            <li>
              <?php
              echo "
                <a href='../Pages/blog.php?userid=$sessionUserID'><i class='fa fa-rss fa-fw'></i> Blog</a>
                ";
                ?>
            </li>
            <li>
              <?php
              echo "
                <a href='../Pages/photocollection.php?userid=$sessionUserID'><i class='fa fa-camera fa-fw'></i> Photos</a>
                ";
                ?>
            </li>
            <li>
            <!-- CHANGES HERE ** -->
            <?php
              echo "
                <a href='../Pages/friendsList.php?userid=$sessionUserID'><i class='fa fa-users fa-fw'></i> Friends</a>
                ";
                ?>
                <!-- <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a> -->
            </li>
              <li>
              <!--  -->
              <?php
                echo "
                  <a href='../Pages/circles.php?userid=$sessionUserID'><i class='fa fa-comments fa-fw'></i> Circles</a>
                  ";
                  ?>
                  <!-- <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Friends</a> -->
              </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
