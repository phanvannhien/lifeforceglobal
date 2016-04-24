 <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>LF</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Lifeforce</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <?php
                $numberUser = Site::getUsersRegistredToday();
                $numberSalesPending = Site::getSalesPendingToday();
              ?>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">{{ $numberUser+$numberSalesPending }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have {{ $numberUser+$numberSalesPending }} notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="{{ route('back.users') }}">
                          <i class="fa fa-users text-aqua"></i> {{ $numberUser }} new members are blocked
                        </a>
                      </li>
                       <li>
                        <a href="{{ route('back.orders') }}">
                          <i class="fa fa-package text-aqua"></i> {{ $numberSalesPending }} new orders pending
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ url( 'AdminLTE/dist/img/user2-160x160.jpg') }}" class="user-image" alt="">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ url( 'AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="">
                    <p>
                     Admin
                    </p>
                  </li>
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
