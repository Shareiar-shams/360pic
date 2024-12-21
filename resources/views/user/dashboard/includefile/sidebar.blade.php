<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{route('home')}}"><img src="{{asset('userViewport/assets/image/logo-light.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>dashboard</span></a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <span>Log Out</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>QNA</span></a>
                        <ul class="collapse">
                            <li><a href="{{route('users.blog.index', ['user' => Auth::user()->username])}}">Article</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
        </div>
    </div>
</div>