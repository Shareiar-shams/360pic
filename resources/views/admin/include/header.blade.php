<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.panel')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>360</b>pic</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>360</b>pic</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::user()->image != 'noimage.jpg')
                        <img src="{{Storage::disk('local')->url(Auth::user()->image)}}" class="user-image" alt="User Image">
                      @else
                        <img src="{{asset('admin/dist/img/avatar04.png')}}" class="user-image" alt="User Image">
                      @endif
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                  </a>
                  <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        @if(Auth::user()->image != 'noimage.jpg')
                            <img src="{{Storage::disk('local')->url(Auth::user()->image)}}" class="img-circle" alt="User Image">
                        @else
                            <img src="{{asset('admin/dist/img/avatar04.png')}}" class="img-circle" alt="User Image">
                        @endif
                        <p>
                          {{ Auth::user()->name }} - {{Auth::user()->position}}
                        </p>
                      </li>
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="{{route('admin-profile.index')}}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-default btn-flat" href="{{ route('adminlogout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Log Out
                            </a>
                            
                            <form id="logout-form" action="{{ 'App\Models\Admin\admin' == Auth::getProvider()->getModel() ? route('adminlogout') : route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                      </li>
                  </ul>
              </li>
            </ul>
        </div>
    </nav>
</header>