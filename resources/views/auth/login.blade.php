{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('user.layout')

@section('title_content')
    <title>360pic | Sign</title>
@endsection
@section('external_header_content')
    style="background: #23495D !important;position: relative;"
@endsection
@section('main_content')
    <!-- Login & Registration Area Start -->
    <section class="log_reg_area">
      <div class="container">
          <div class="log_reg_box">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav_login_tab" data-bs-toggle="tab" data-bs-target="#nav_login" type="button" role="tab" aria-controls="nav_login" aria-selected="true">login</button>
                  <button class="nav-link" id="nav_reg_tab" data-bs-toggle="tab" data-bs-target="#nav_reg" type="button" role="tab" aria-controls="nav_reg" aria-selected="false">Register</button>
                </div>
              </nav>
              <div class="tab-content lr_tab_box" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav_login" role="tabpanel" aria-labelledby="nav_login_tab">
                    @if ($errors->any())                 
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <a type="button" class="close" data-dismiss="alert"></a> 
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach                                        
                    @endif
                    <form method="POST" action="{{ route('login') }}"> 
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pass_word">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password..." name="password" required autocomplete="current-password">
                                    <span toggle="#password-field" id="togglePassword" class="fa-eye-slash field-icon toggle-password"></span>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group form_check">
                                    <input class="form_check_input" type="radio" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form_check_label">Remember me</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group form_check for_pass">
                                    {{-- <input class="form_check_input" type="radio" name="exampleRadios" value="option1" checked> --}}
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    {{-- <label class="form_check_label">Forget password</label> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="btn">Sign In</button>
                                </div>
                            </div>
                            </br>
                            </br>
                            {{-- <div class="col-md-12">
                                <div class="account_creat text-center">
                                    <span>New to <strong>Medibo</strong></span><br>
                                    <a href="#nav_reg">Create an account</a>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="signin_with text-center">
                                    <p>Signin with</p>
                                    <ul>
                                        <li><a href="{{route('redirect')}}"><img src="{{asset('userViewport/assets/image/facebook.png')}}" alt="facebook"></a></li>
                                        <li><a href="{{route('google.redirect')}}"><img src="{{asset('userViewport/assets/image/gmail.png')}}" alt="gmail"></a></li>
                                        <li><a href="#"><img src="{{asset('userViewport/assets/image/twitter.png')}}" alt="twitter"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav_reg" role="tabpanel" aria-labelledby="nav_reg_tab">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name..." name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="User Name..." name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input id="pass" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Password..." name="password" required autocomplete="current-password">
                                    <span toggle="#pass-field" id="togglePass" class="fa-eye-slash field-icon toggle-pass"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="form-group pass_word">
                                    <input id="pass2" type="password" class="form-control" placeholder="Confirm Password..." name="password_confirmation" required autocomplete="new-password">
                                    <span toggle="#pass-field1" id="togglePass2" class="fa-eye-slash field-icon toggle-pass2"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <label class="condition" style="padding-left: 15px;">
                                    <input type="checkbox" name="terms" id="terms" required><span> I agree with all the <a href="{{route('page-terms&condition')}}">terms & conditions</a></span>.
                                </label>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="submit_btn text-center">
                                    <button type="submit" class="btn">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
          </div>
      </div>
    </section>
    <!-- Login & Registration Area End -->
@endsection

@section('js_content')
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
        });

        $(".toggle-pass").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
        });

        $(".toggle-pass2").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
        });

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePass = document.querySelector("#togglePass");
        const pass = document.querySelector("#pass");

        togglePass.addEventListener("click", function () {
            // toggle the type attribute
            const type = pass.getAttribute("type") === "password" ? "text" : "password";
            pass.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePass2 = document.querySelector("#togglePass2");
        const pass2 = document.querySelector("#pass2");

        togglePass2.addEventListener("click", function () {
            // toggle the type attribute
            const type = pass2.getAttribute("type") === "password" ? "text" : "password";
            pass2.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>
@endsection