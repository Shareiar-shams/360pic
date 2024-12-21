@extends('user.dashboard.layout')

@section('userDashboard_title_content')
    <title>360pic | Order</title>
@endsection

@section('userDashboard_css_content')
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
  	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('userDashboard_nav_content')
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><span>Order Return Request</span></li>
    </ul>
@endsection

@section('userDashboard_main_content')
	<div class="row">
		<div class="col-lg-6 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                        	@if ($errors->any())                 
								@foreach ($errors->all() as $error)
									<div class="alert alert-danger alert-block">
								        <a type="button" class="close" data-dismiss="alert"></a> 
								        <strong>{{ $error }}</strong>
								    </div>
								@endforeach						                   
							@endif
                            <h4 class="header-title">Return Order</h4>
                            <form role="form" class="forms-sample" method="post" action="{{route('returnorder.request')}}" enctype="multipart/form-data">
                            	{{csrf_field()}}

                            	<input type="hidden" name="order_id" value="{{$order->id}}">
                            	<input type="hidden" name="email" value="{{$order->email}}">
                            	<input type="hidden" name="name" value="{{$order->name}}">
                            	<input type="hidden" name="tk" value="{{$order->total}}">
	                            <div class="form-group">
	                                <label for="example-text-input" class="col-form-label">Text</label>
	                                <textarea class="form-control" name="problem_details" id="example-text-input" placeholder="Write why do you want to return the order"></textarea>
	                            </div>
	                            <div class="input-group control-group increment">
							        <input type="file" name="images[]" class="form-control">
							        <div class="input-group-btn"> 
							            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add Image</button>
							        </div>
						        </div>

						        <div class="clone hide">
							        <div class="control-group input-group" style="margin-top:10px">
							        	<input type="file" name="images[]" class="form-control">
							            <div class="input-group-btn"> 
							              	<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
							            </div>
							        </div>
						        </div>

	                            <div class="form-group">
	                                <label class="col-form-label">Select Payment Method</label>
	                                <select class="custom-select" name="payment_method">
	                                    <option selected disabled>Select the medium through which you want to take money</option>
	                                    <option value="Bkash">Bkash</option>
	                                    <option value="Nagad">Nagad</option>
	                                    <option value="Rocket">Rocket</option>
	                                    <option value="Upay">Upay</option>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label for="example-tel-input" class="col-form-label">Phone</label>
	                                <input class="form-control" type="tel" name="phone_number" placeholder="Write the number you" id="example-tel-input">
	                            </div>

	                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
	                        </form>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
            </div>
        </div>
    </div>
@endsection

@section('userDashboard_js_content')
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf-8" async defer>
		$(document).ready(function () {
			

			$(".btn-success").click(function(){ 
		        var html = $(".clone").html();
		        $(".increment").after(html);
		    });
	      	$("body").on("click",".btn-danger",function(){ 
	          	$(this).parents(".control-group").remove();
		    });
		});

		
	</script>
@endsection