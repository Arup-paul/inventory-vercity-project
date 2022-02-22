@php
   $prefix = Request::route()->getPrefix();
   $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <style>
     .activate{
         background: #000;
     }

        </style>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="{{(!empty(Auth::user()->image)) ?  URL::to('upload/user_images/'.Auth::user()->image) : URL::to('upload/default.jpg')}}" class="img-circle" >
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
        <a href="{{route('home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>

        </li>
         @if(Auth::User()->role==1)



    <li class="treeview   {{($prefix == '/users') ? 'active  menu-open' : '' }}">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($route == 'users.view') ? 'active activate' : '' }} "><a  href="{{route('users.view')}}"><i class="fa fa-circle-o"></i> View User</a></li>
          </ul>
        </li>

        {{-- <li class="treeview {{($prefix == '/tender') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Buyer Tender</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'tender.index') ? 'active activate' : '' }}"><a href="{{route('tender.index')}}"><i class="fa fa-circle-o"></i>Create Tender </a></li>
                  <li class="{{($route == 'buyer.order') ? 'active activate' : '' }}"><a href="{{route('buyer.order')}}"><i class="fa fa-circle-o"></i>supplier Request Tender Details </a></li>
                </ul>
              </li> --}}
         @endif

           {{-- @if(Auth::User()->role==3   )
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span> Tender Details</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                <li><a href="{{route('tender.details')}}"><i class="fa fa-circle-o"></i> Tender Details</a></li>
                </ul>
              </li>
           @endif --}}

        <li class="treeview {{($prefix == '/profiles') ? 'active  menu-open' : '' }}">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Manage Profile</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              <span class="pull-right-container">
                <span class="label label-primary pull-right"></span>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{($route == 'profiles.view') ? 'active activate' : '' }}"><a href="{{route('profiles.view')}}"><i class="fa fa-circle-o"></i> Your Profile</a></li>
              <li class="{{($route == 'password.view') ? 'active activate' : '' }}"><a href="{{route('password.view')}}"><i class="fa fa-circle-o"></i> Change Password</a></li>
            </ul>
          </li>
        <li>

            <li class="treeview {{($prefix == '/suppliers') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Suppliers</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'suppliers.view') ? 'active activate' : '' }}"><a href="{{route('suppliers.view')}}"><i class="fa fa-circle-o"></i>View Supplier</a></li>
                </ul>
              </li>

               <li class="treeview {{($prefix == '/customers') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Customers</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'customers.view') ? 'active activate' : '' }}"><a href="{{route('customers.view')}}"><i class="fa fa-circle-o"></i>View Customers</a></li>
                </ul>
              </li>

              <li class="treeview {{($prefix == '/units') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Units</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'units.view') ? 'active activate' : '' }}"><a href="{{route('units.view')}}"><i class="fa fa-circle-o"></i>View Units</a></li>
                </ul>
              </li>

              <li class="treeview {{($prefix == '/categories') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Category</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'categories.view') ? 'active activate' : '' }}"><a href="{{route('categories.view')}}"><i class="fa fa-circle-o"></i>View Category</a></li>
                </ul>
              </li>

            <li class="treeview {{($prefix == '/products') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Product</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'products.view') ? 'active activate' : '' }}"><a href="{{route('products.view')}}"><i class="fa fa-circle-o"></i>View Products</a></li>
                </ul>
              </li>


            <li class="treeview {{($prefix == '/purchase') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Purchase</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'purchase.view') ? 'active activate' : '' }}"><a href="{{route('purchase.view')}}"><i class="fa fa-circle-o"></i>View Purchases</a></li>
                  <li class="{{($route == 'purchase.pending') ? 'active activate' : '' }}"><a href="{{route('purchase.pending')}}"><i class="fa fa-circle-o"></i>Approval Purchases</a></li>
                </ul>
              </li>


              <li class="treeview {{($prefix == '/invoice') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Invoice</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'invoice.view') ? 'active activate' : '' }}"><a href="{{route('invoice.view')}}"><i class="fa fa-circle-o"></i>View Invoice</a></li>
                  <li class="{{($route == 'invoice.pending') ? 'active activate' : '' }}"><a href="{{route('invoice.pending')}}"><i class="fa fa-circle-o"></i>Approval Invoice</a></li>
                   <li class="{{($route == 'invoice.print.list') ? 'active activate' : '' }}"><a href="{{route('invoice.print.list')}}"><i class="fa fa-circle-o"></i>Print Invoice</a></li>

                    <li class="{{($route == 'invoice.daily.report') ? 'active activate' : '' }}"><a href="{{route('invoice.daily.report')}}"><i class="fa fa-circle-o"></i>Daily Invoice Report</a></li>
                </ul>
              </li>

               <li class="treeview {{($prefix == '/stock') ? 'active  menu-open' : '' }}">
                <a href="#">
                  <i class="fa fa-th"></i>
                  <span>Manage Stock</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{($route == 'stock.report') ? 'active activate' : '' }}"><a href="{{route('stock.report')}}"><i class="fa fa-circle-o"></i>Stock Report</a></li>
                </ul>
              </li>


























            </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
