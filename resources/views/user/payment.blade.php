@extends('user.layout')

@section('title_content')
    <title>360pic | Payment</title>
@endsection

@section('css_content')
    <!-- CSRF Token -->
   	<meta name="csrf-token" content="{{ csrf_token() }}">
   	
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    
@endsection

@section('main_content')
	<!--===  Inner Banner Area Start ===-->
	<section class="inner_banner_area section_padding" data-background="{{asset('user/assets/image/inner_banner.png')}}">
	    <div class="container">
	        <div class="inner_titel text-center">
	            <h2>booking procedure</h2>
	        </div>
	    </div>
	</section>
	<!--===  Inner Banner Area End ===-->
	<!-- BOOKING PROCESS AREA START -->
	<div class="payment_proceedure_area">
	    <div class="container">
	        <div class="row">
	        	@if(session()->has('success_msg'))
                    <p class="alert alert-success" role="alert">{{session ('success_msg')}}</p>
                @endif
	        	@if ($errors->any())
                          
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger" role="alert">{{$error}}</p>
                    @endforeach
                                       
                @endif
	            <div class="col-xl-8 col-lg-7 col-md-8 col-sm-12 col-12">
	            	
	                <div class="step-1" id="checkout-progress" data-current-step="1">
	                    <div class="progress-bar">
	                        <ul>
	                            <li>
	                                <div class="step step-1 active"><span> 1</span>
	                                    <div class="fa fa-check active"></div>
	                                    <div class="step-label">Customer information</div>
	                                </div>
	                            </li>
	                            <li>                              
	                                <div class="step step-2"><span> 2</span>
	                                    <div class="fa fa-check active"></div>
	                                    <div class="step-label">Payment information</div>
	                                </div>
	                            </li>
	                            <li>
	                                <div class="step step-3"><span> 3</span>
	                                    <div class="fa fa-check active"></div>
	                                    <div class="step-label">Booking information</div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>

					<div id="boking_step_1">
						<div class="process__step_titel">
							<h5>Enter your details</h5>
						</div>
						<form method="post" action="{{ route('order.store') }}" id="first_submit" accept-charset="utf-8">
	            		{{csrf_field()}}
						<div class="process_start">
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>First name<span>*</span></label>
										<input type="text" name="first_name" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Last name<span>*</span></label>
										<input type="text" name="last_name" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Email address <span>*</span></label>
										<input type="email" name="email" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Phone number<span>*</span></label>
										<input type="text" name="phone" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Address<span>*</span></label>
										<input type="text" name="billing_area" placeholder="Example: Street Name(2254 Reserve St), CityName(Denbigh)" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Working Address Line 1<span>*</span></label>
										<input type="text" placeholder="Example: Street Name(2254 Reserve St)" name="work_area" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Working Address Line 2<span>*</span></label>
										<input type="text" name="addressline" placeholder="Example: House No(Suite 600)" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>City<span>*</span></label>
										<input type="text" name="city" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Postal Code<span>*</span></label>
										<input type="text" name="postal_code" class="form-control" required>
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div id="sp_request">
									<h3>Special request</h3>
										<p>Please write your requests in English - we will share it with the property.</p>
										<p>Special requests cannot be guaranteed–but the accommodation will do its best to meet your needs.</p>
										<p>You can always make a special request after your booking is complete!
										</p>
										<textarea class="form-control" name="special_note"></textarea>
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<label class="condition_agree">
										<input type="checkbox" name="terms_privacy" required><span> By proceeding with this booking, I agree to Agoda’s <a href="{{route('page-terms&condition')}}">Terms of Use</a> and <a href="{{route('page-privacy&policy')}}">Privacy Policy</a>.</span>
									</label>
								</div>
							</div>
							<div class="button-container first_btn">
								<button type="submit" class="btn btn-next default_btn"> next</button>
							</div>
						</div>
						</form>
					</div>

				</div>
				<div class="col-xl-4 col-lg-5 col-md-4 col-sm-12 col-12">
					<div class="booking_details_right">
						@if(\Cart::session(Session::getId())->getTotalQuantity()>0)
						<div class="booking_info">
							<div class="titel">
								<h4>Your booking details</h4>
							</div>
							<div class="info_ctn">
								<ul>
									@foreach(\Cart::session(Session::getId())->getContent() as $item)
		                                <li>
		                                    <p>Product name :</p>
		                                    <div class="pro_nam time_info">
		                                        <span>{{$item->name}}</span>
		                                    </div>
		                                </li>
		                                <br>
	                                @endforeach
									<li class="info_be">
										<p>appoinment date & time</p>
										<div class="time_info">
											<span>{{\Carbon\Carbon::parse($datetime->date)->format('D')}} {{\Carbon\Carbon::parse($datetime->date)->format('d M Y')}}</span>
											<span>{{$datetime->time}}</span>
										</div>
									</li>
								</ul>
							</div>
							<div class="booking_cost">
								<ul class="cost_ctn_1">
									<li>
										<span>Price</span>
									</li>
									<li>
										<span>US&#x24;{{ \Cart::getTotal() }}</span>
									</li>
								</ul>
								
								{{-- <p>Your payment schedule</p>
								<ul class="cost_ctn_2">
									<li>
										<span>After 12 January you'll pay</span>
										<span class="text-right">US$400</span>
									</li>
								</ul>
								<div class="cancel">
									<p>How much will it cost to cancel?</p>
									<p>
										<a href="#">FREE cancellation until 23:59 on 11 jan</a>
									</p>
								</div> --}}
							</div>
						</div>
						@endif
					</div>
				</div>
	        </div>
	    </div>
	</div>
	<!-- BOOKING PROCESS AREA END-->
@endsection

@section('js_content')
    <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform">
     </script>
    
    <script>
    	$('#boking_step_2').hide();
    // 	$( window ).on( "load", function() {
		  //   $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: "{{ route('chack_user_order') }}",
    //             type: "GET",
    //             data: "DATA",
    //             cache:false,
				// contentType: false,
				// processData: false,
				// success: (data) => {
				// 	if (data.status === true) {
			 //            $('#boking_step_1').hide();
				// 		$('#boking_step_2').show();
			 //        } else {
			 //            $('#boking_step_1').show();
				// 		$('#boking_step_2').hide();
			 //        }
				// 	console.log(data);
				// },
				// error: function(data){
				// 	$('#boking_step_1').show();
				// 	$('#boking_step_2').hide();
				// 	console.log(data);
				// }
    //         });
	   //  });

    	
  //   	$(document).ready(function (e) {
		// 	$.ajaxSetup({
		// 		headers: {
		// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 		}
		// 	});
		// 	$('#first_submit').submit(function(e) {
		// 		e.preventDefault();
		// 		var formData = new FormData(this);
		// 		$.ajax({
		// 			type:'POST',
		// 			url: "{{ route('order.store') }}",
		// 			data: formData,
		// 			cache:false,
		// 			contentType: false,
		// 			processData: false,
		// 			success: (data) => {
		// 				$('#boking_step_1').hide();
		// 				$('#boking_step_2').show();
		// 				console.log(data);
		// 			},
		// 			error: function(data){
		// 				console.log(data);
		// 			}
		// 		});
		// 	});
		// });

    	
    </script>
@endsection