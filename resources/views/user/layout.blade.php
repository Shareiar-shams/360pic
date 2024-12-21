<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">
	@include('user.includefile.head')

	<body>
		@include('user.includefile.header')
		@section('main_content')
        	@show
        @include('user.includefile.contact')
		@include('user.includefile.footer')
		@include('user.includefile.copyright')
		<!-- Scroll to Top button selector -->
    	<a class="to-top"><i class="far fa-arrow-alt-circle-up"></i></a>
    	@include('user.includefile.js')
	</body>
</html>