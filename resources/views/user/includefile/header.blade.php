<!-- Header Area Start -->
<header class="header_area" @section('external_header_content')
        @show>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6">
                <div class="logo_area">
                    <a href="{{URL::to('/')}}"><img src="{{asset('user/assets/image/logo-light.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9">
                <div class="menu" id="menu">
                    <ul>
                        <li><a href="#">Service <i class="far fa-angle-down"></i></a>
                            <ul class="sub_menu">
                                @foreach($categories as $category)
                                    <li><a href="{{route('category_single_product',['category'=>$category->name,'id'=>$category->id])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">company <i class="far fa-angle-down"></i></a>
                            <ul class="sub_menu">
                                @foreach ($company_page as $page)
                                    @php $name = 'page-' . $page->slug; @endphp
                                    
                                    <li><a href="{{route($name)}}">{{$page->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#contact">contact</a></li>
                        <li>
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/home') }}" class="btn default_btn bok_btn">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn default_btn bok_btn">Log in</a>

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
</header>
<!-- Header Area End -->