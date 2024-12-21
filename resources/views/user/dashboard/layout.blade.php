<!doctype html>
<html class="no-js" lang="en">

	@include('user.dashboard.includefile.head')

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
    	<!-- sidebar menu area start -->
    	@include('user.dashboard.includefile.sidebar')
    	<!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
        	<!-- header area start -->
        	@include('user.dashboard.includefile.header')
        	<!-- header area end -->
            <!-- page title area start -->
            @include('user.dashboard.includefile.title_area')
            <!-- page title area end -->
            <div class="main-content-inner">
            	@section('userDashboard_main_content')
        			@show
            </div>
        </div>

        <!-- main content area end -->
	    <!-- footer area start-->
	    <footer>
	        <div class="footer-area">
	            <p>&copy; Copyright 2020-{{\Carbon\Carbon::now()->format('Y')}}. All right reserved. Template by <a href="{{URL::to('/')}}">360pic</a>.</p>
	        </div>
	    </footer>
	    <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- page js area start -->
    @include('user.dashboard.includefile.js')
    <!-- page js area end -->
</body>
</html>