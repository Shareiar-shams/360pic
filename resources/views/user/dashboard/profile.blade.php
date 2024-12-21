@extends('user.dashboard.layout')

@section('userDashboard_title_content')
    <title>360pic | User Profile</title>
@endsection

@section('userDashboard_css_content')
@endsection

@section('userDashboard_nav_content')
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><span>Profile</span></li>
    </ul>
@endsection

@section('userDashboard_main_content')
	<div class="row">
	    
	    <!-- left align tab start -->
	    <div class="col-lg-12 mt-10">
	        <div class="card">
	            <div class="card-body">
	                <div class="d-md-flex">
	                    <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	                        
	                        <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
	                        
	                        {{-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> --}}

	                        <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Password</a>
	                    </div>
	                    <div class="tab-content" id="v-pills-tabContent">
	                        
	                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
	                            <div class="col-lg-12">
			                        <div class="card">
			                            <div class="card-body">
			                                <div class="media col-lg-12">
			                                	{{-- @if(Auth::user()->image != 'noimage.jpg')
			                                    	<img class="img-fluid mr-4" src="{{Storage::disk('local')->url(Auth::user()->image)}}" alt="image" style="height: 150px; width:150px ">
			                                    @else
			                                    	<img class="img-fluid mr-4" src="{{asset('userDashboard/assets/images/author/avatar.png')}}" alt="image">
			                                    @endif --}}

			                                    <div class="media-body">
						                            <div class="pricing-list">
						                                <div class="prc-head">
						                                    <h4>{{Auth::user()->name}}</h4>
						                                </div>
						                                <div class="prc-list">
						                                    <ul>
						                                        {{-- <li><strong>Phone: </strong>{{Auth::user()->phone}}</li>
						                                        <li><strong>Date of birth: </strong>{{Auth::user()->date_of_birth}}</li>
						                                        <li><strong>Gender: </strong>{{Auth::user()->gender}}</li>
						                                        <li><strong>Address: </strong>{{Auth::user()->address}}</li> --}}
						                                    </ul>
						                                </div>
						                            </div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
	                        </div>
	                        
	                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
	                            <div class="col-12 mt-5">
	                                <div class="card">
	                                    <div class="card-body row">
	                                    	<!-- Profile Image -->
									        <div class="box box-primary mb-5 col-6">
									            <div class="box-body box-profile">
													<form action="{{route('user.imageupdate',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
														{{csrf_field()}}
										            	<p>
										            		<input type="file" accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;" required>
										            	</p>

										            	@if(Auth::user()->image != 'noimage.jpg')
											              	<label for="file" class="ml-3 mb-3" style="cursor: pointer; display: inline;">
											              		<img src="{{Storage::disk('local')->url(Auth::user()->image)}}" alt="User profile picture" id="output" style="border-radius: 50%; height:150px; width: 150px;">
											              	</label>
											            @else
											              	<label for="file" class="ml-3 mb-3" style="cursor: pointer; display: inline;">
											              		<img src="{{asset('admin/dist/img/avatar04.png')}}" alt="User profile picture" id="output" style="border-radius: 50%; height:150px; width: 150px; ">
											              	</label>
											            @endif

														<input type="submit" class="btn btn-primary btn-block" style="font-weight: bold;" value="Change Profile Picture">
													</form>
									            </div>
									            <!-- /.box-body -->
									        </div>
									        <!-- /.box -->
									        <div class="box box-primary mb-5 col-6">
		                                        <h4 class="header-title">User Information</h4>
		                                        <form action="{{route('user.infoupdate',Auth::user()->id)}}" method="post">
		                                        	{{csrf_field()}}
			                                        <div class="form-group">
			                                            <label for="example-text-input" class="col-form-label">Name</label>
			                                            <input class="form-control" type="text" value="{{Auth::user()->name}}" name="name" id="example-text-input">
			                                        </div>
			                                        <div class="form-group">
			                                            <label for="example-datetime-local-input" class="col-form-label">Date and time</label>
			                                            <input class="form-control" type="date" name="date_of_birth" value="{{Auth::user()->date_of_birth}}" id="example-datetime-local-input">
			                                        </div>
			                                        <div class="form-group">
			                                            <label for="example-datetime-local-input" class="col-form-label">Address</label>
			                                            <textarea class="form-control" name="address">{{Auth::user()->address}}</textarea>
			                                        </div>
			                                        <div class="form-group">
			                                            <label class="col-form-label">Select</label>
			                                            <select class="form-control" name="gender">
			                                                <option selected disabled value="">Select your gender</option>
			                                                <option value="male">Male</option>
			                                                <option value="female">Female</option>
			                                                <option value="other">Other</option>
			                                            </select>
			                                        </div>
			                                        <input type="submit" class="btn btn-info btn-block" style="font-weight: bold;" value="Save">
			                                    </form>
			                                </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>

	                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
	                        	<!-- login area start -->
							    <div class="login-area">
							        <div class="container">
							            <div class="login-box ptb--100">
							                <form action="{{route('userpassword.update',Auth::user()->id)}}" method="post">
							                	{{csrf_field()}}
							                    <div class="login-form-head">
							                        <h4>Change Password</h4>
							                        <p>Hey! Change Your Password and comeback again</p>
							                    </div>
							                    <div class="login-form-body">
							                        <div class="form-gp">
							                            <label for="exampleInputPassword1">Old Password</label>
							                            <input type="password" name="old_password" id="exampleInputPassword1">
							                            <i class="ti-lock"></i>
							                        </div>
							                        <div class="form-gp">
							                            <label for="exampleInputPassword2">New Password</label>
							                            <input type="password" name="new_password" id="exampleInputPassword2">
							                            <i class="ti-lock"></i>
							                        </div>
							                        <div class="form-gp">
							                            <label for="exampleInputPassword2">Confirm Password</label>
							                            <input type="password" name="c_password" id="exampleInputPassword2">
							                            <i class="ti-lock"></i>
							                        </div>
							                        <div class="submit-btn-area mt-5">
							                            <button id="form_submit" type="submit">Change <i class="ti-arrow-right"></i></button>
							                        </div>
							                    </div>
							                </form>
							            </div>
							        </div>
							    </div>
							    <!-- login area end -->
	                        </div>
	                    </div>
	                </div>
                </div>
            </div>
        </div>
        <!-- left align tab end -->
    </div>
@endsection

@section('userDashboard_js_content')
	<script>
		var loadFile = function(event) {
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
@endsection