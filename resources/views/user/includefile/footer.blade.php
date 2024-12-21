<!--Start Footer Area-->
<section class="footer_area">
    <div class="footer_top">
        <img src="{{asset('user/assets/image/wave2.png')}}" alt="" class="img-fluid">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single_footer_widget" data-aos="fade-right">
                <a class="logo" href="{{URL::to('/')}}"><img src="{{asset('user/assets/image/logo-light.png')}}" alt="logo"></a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <ul class="social_link">
                    <li class="facebook"><a href="#" class="d-block" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href="#" class="d-block" target="_blank"><i class="fab fa-twitter"></i></a></li>
                    <li class="instragram"><a href="#" class="d-block" target="_blank"><i class="fab fa-instagram"></i></a></li>
                    <li class="linkedin"><a href="#" class="d-block" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single_footer_widget" data-aos="fade-up-right">
                <h3>service</h3>
                <ul class="footer_links_list">
                    @foreach($categories as $category)
                        <li><a href="{{route('category_single_product',['category'=>$category->name,'id'=>$category->id])}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single_footer_widget" data-aos="fade-up-left">
                    <h3>Company</h3>
                    <ul class="footer_links_list">
                        @foreach ($company_page as $page)
                            @php $name = 'page-' . $page->slug; @endphp
                            
                            <li><a href="{{route($name)}}">{{$page->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single_footer_widget" data-aos="fade-left">
                <h3>Useful Link</h3>
                <ul class="footer_links_list">
                    @foreach ($all_page as $page)
                        @php $name = 'page-' . $page->slug; @endphp
                        
                        <li><a href="{{route($name, $page->slug)}}">{{$page->title}}</a></li>
                    @endforeach
                    <li>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>

                            {{-- @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif --}}
                        @endauth
                    @endif
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Footer Area-->