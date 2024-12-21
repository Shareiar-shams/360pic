<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                @section('userDashboard_nav_content')
                    @show
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                {{-- @if(Auth::user()->image != 'noimage.jpg')
                    <img class="avatar user-thumb" src="{{Storage::disk('local')->url(Auth::user()->image)}}" alt="avatar">
                   
                @else
                    <img class="avatar user-thumb" src="{{asset('userDashboard/assets/images/author/avatar.png')}}" alt="avatar">

                @endif --}}
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<i class="fa fa-angle-down"></i></h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('user.profile', Auth::user()->username)}}">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log Out') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>