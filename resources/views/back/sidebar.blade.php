 <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar ">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ url( 'AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="{{ route('back.admin.dashboard') }}">
              <i class="fa fa-home"></i>
              <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('back.product') }}"><i class="fa fa-circle-o"></i> All Products</a></li>
                <li><a href="{{ route('back.product.create') }}"><i class="fa fa-circle-o"></i> Create Products</a></li>
              </ul>
              
            </li> 

            <li class="treeview">
              <a href="#">
                <i class="fa  fa-folder"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('back.categories') }}"><i class="fa fa-circle-o"></i> All Categories</a></li>
                <li><a href="{{ route('back.categories.create') }}"><i class="fa fa-circle-o"></i> Create Categories</a></li>
              </ul>
              
            </li>   

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('back.users') }}"><i class="fa fa-circle-o"></i> All Users</a></li>
                <li><a href="{{ route('back.users.create') }}"><i class="fa fa-circle-o"></i> Create User</a></li>
              </ul>
              
            </li>   

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cube"></i> <span>Orders</span> 
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('back.orders') }}"><i class="fa fa-fa-cube-o"></i> All Orders</a></li>
              </ul>
            </li>   
            <li class="treeview">
              <a href="#">
              <i class="fa fa-cogs"></i> <span>Report</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ route('back.report') }}"><i class="fa fa-fa-cube-o"></i> WM report</a></li>
              </ul>
            </li>
            <li class="treeview">

              <a href="{{ route('back.configuration') }}">
              <i class="fa fa-cogs"></i> <span>Configuration</span></a>
            </li>

            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->