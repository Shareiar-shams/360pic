@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Admin Profile</title>
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<h1>
	  	Admin Profile
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Admin Profile</li>
	</ol>
@endsection

@section('admin_main_content')
	@if ($errors->any())                 
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif
	<div class="row">
        <div class="col-md-3">

	        <!-- Profile Image -->
	        <div class="box box-primary">
	            <div class="box-body box-profile">
					<form action="{{route('imageupdate',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
		            	<p><input type="file" accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;" required></p>

		            	@if(Auth::user()->image != 'noimage.jpg')
			              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{Storage::disk('local')->url(Auth::user()->image)}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
			            @else
			              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{asset('admin/dist/img/avatar04.png')}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
			            @endif

		              	<h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

		              	<p class="text-muted text-center">{{Auth::user()->position}} -- {{Auth::user()->phone}}</p>

						<input type="submit" class="btn btn-primary btn-block" style="font-weight: bold;" value="Change Profile Picture">
					</form>
	            </div>
	            <!-- /.box-body -->
	        </div>
	        <!-- /.box -->

		    <!-- About Me Box -->
		    {{-- <div class="box box-primary">
		        <div class="box-header with-border">
		          <h3 class="box-title">About Me</h3>
		        </div>
		        <!-- /.box-header -->
		        <div class="box-body">
		          <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

		          <p class="text-muted">
		            B.S. in Computer Science from the University of Tennessee at Knoxville
		          </p>

		          <hr>

		          <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

		          <p class="text-muted">Malibu, California</p>

		          <hr>

		          <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

		          <p>
		            <span class="label label-danger">UI Design</span>
		            <span class="label label-success">Coding</span>
		            <span class="label label-info">Javascript</span>
		            <span class="label label-warning">PHP</span>
		            <span class="label label-primary">Node.js</span>
		          </p>

		          <hr>

		          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

		          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
		        </div>
		        <!-- /.box-body -->
		    </div> --}}
		    <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
	        <div class="nav-tabs-custom">
	            <ul class="nav nav-tabs">
		            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
		            <li><a href="#password" data-toggle="tab">Change Password</a></li>
	            </ul>
	            <div class="tab-content">
	              	<!-- /.tab-pane -->
		            <div class="tab-pane" id="password">
		                <!-- The password -->
		                <form class="form-horizontal" action="{{route('adminpassword.update',Auth::user()->id)}}" method="post">
		                	{{csrf_field()}}
			                <div class="form-group">
			                    <label for="inputName" class="col-sm-2 control-label">Old Password*</label>
			                    <div class="col-sm-10">
			                      <input type="password" name="old_password" class="form-control" id="inputName" placeholder="Enter Old Password">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="inputEmail" class="col-sm-2 control-label">New Password*</label>

			                    <div class="col-sm-10">
			                      <input type="password" name="new_password" class="form-control" id="inputEmail" placeholder="Enter New Password">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="inputName" class="col-sm-2 control-label">Confrim Password*</label>

			                    <div class="col-sm-10">
			                      <input type="password" name="c_password" class="form-control" id="inputName" placeholder="Retype Password">
			                    </div>
			                </div>
		                  
		                  	<div class="form-group">
		                    	<div class="col-sm-offset-2 col-sm-10">
		                      		<button type="submit" class="btn btn-danger">Submit</button>
		                    	</div>
		                  	</div>
		                </form>
		            </div>
	              	<!-- /.tab-pane -->

		            <div class="active tab-pane" id="settings">
		                <form class="form-horizontal" action="{{route('admin-profile.update',Auth::user()->id)}}" method="post">
		                	{{csrf_field()}}
		                	{{method_field('PUT')}}
			                <div class="form-group">
			                    <label for="inputName" class="col-sm-2 control-label">Name</label>

			                    <div class="col-sm-10">
			                      <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{Auth::user()->name}}">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="inputName" class="col-sm-2 control-label">Phone</label>

			                    <div class="col-sm-10">
			                      <input type="number" class="form-control" id="inputName" placeholder="Phone" name="phone" value="{{Auth::user()->phone}}">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label for="inputExperience" class="col-sm-2 control-label">Position</label>

			                    <div class="col-sm-10">
			                      <input type="text" class="form-control" id="inputSkills" placeholder="Position" name="position" value="{{Auth::user()->position}}">
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="col-sm-offset-2 col-sm-10">
			                      <button type="submit" class="btn btn-danger">Submit</button>
			                    </div>
			                </div>
		                </form>
		            </div>
		            <!-- /.tab-pane -->
	            </div>
	            <!-- /.tab-content -->
	        </div>
          	<!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('admin_js_content')
	<script>
		var loadFile = function(event) {
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
@endsection