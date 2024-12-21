<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            @if(Auth::user()->image != 'noimage.jpg')
              <img src="{{Storage::disk('local')->url(Auth::user()->image)}}" class="img-circle" alt="User Image">
            @else
              <img src="{{asset('admin/dist/img/avatar04.png')}}" class="img-circle" alt="User Image">
            @endif
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="" method="GET" class="sidebar-form">
          @csrf
          <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search...">
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
          <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          {{-- <li class="treeview">
            <a href="#">
              <i class="fa fa-book" aria-hidden="true"> </i> <span>  Blog </span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('post.index')}}"><i class="fa fa-book" aria-hidden="true"></i> Post</a></li>
              <li><a href="{{route('post-category.index')}}"><i class="fa fa-th-list" aria-hidden="true"></i>Post Category</a></li>
              <li><a href="{{route('post-tag.index')}}"><i class="fa fa-tag" aria-hidden="true"></i> Post Tag</a></li>
              <li><a href="{{route('post-comment.index')}}"><i class="fa fa-comments"></i> All Comments</a></li>
            </ul>
          </li>
          --}}
          <li class="treeview">
            <a href="#">
              <i class="fa fa-product-hunt" aria-hidden="true"></i> <span> Product</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('product.index')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Item</a></li>
              <li><a href="{{route('product-category.index')}}"><i class="fa fa-list" aria-hidden="true"></i>Product Category</a></li>
              <li> 
              {{-- <li><a href="{{route('product-review.index')}}"><i class="fa fa-comments" aria-hidden="true"></i>Reviews</a></li> --}}
            </ul>
          </li>
  
          <li class="treeview">
            <a href="#">
              <i class="fa fa-store"></i> <span> Order</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('customers-order.index')}}"><i class="fa fa-shopping-basket"></i>All Order List</a></li>
              <li><a href="{{route('pending_order')}}"><i class="fa fa-shopping-basket"></i>Pending Order List</a></li>
              <li><a href="{{route('processing_order')}}"><i class="fa fa-shopping-basket"></i>Processing Order List</a></li>
              <li><a href="{{route('delivery_in_progress')}}"><i class="fa fa-shopping-basket"></i>Progress Order List</a></li>
              <li><a href="{{route('canceled_order')}}"><i class="fa fa-shopping-basket"></i>Canceled Order List</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-pager"></i> <span> Pages</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('page.index')}}"><i class="fa fa-file-alt"></i>Page List</a></li>
            </ul>
          </li>
          {{--
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span> User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('user.index')}}"><i class="fa fa-users"></i> Users</a></li>
              <li><a href="{{route('role.index')}}"><i class="fa fa-user-tag"></i> Role</a></li>
              <li><a href="{{route('permission.index')}}"><i class="fa fa-user-tag"></i> Permission</a></li>
            </ul>
          </li>
          --}}

          <li>
            <a href="{{route('customers.index')}}">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i> <span>Customers</span>
            </a>
          </li> 

          <li>
            <a href="{{route('datetime-set.index')}}">
              <i class="fa fa-clock" aria-hidden="true"></i> <span>Date & Time</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
              </span>
            </a>
          </li>

          <li>
            <a href="{{route('user-mail.index')}}">
              <i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Contacts Mail</span>
              <span class="pull-right-container">
              </span>
            </a>
          </li>

          
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>