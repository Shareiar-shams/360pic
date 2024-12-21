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
	                                <div class="step step-1"><span> 1</span>
	                                    <div class="fa fa-check active"></div>
	                                    <div class="step-label">Customer information</div>
	                                </div>
	                            </li>
	                            <li>                              
	                                <div class="step step-2 active"><span> 2</span>
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


					<div id="boking_step_1 boking_step_2">
						<div class="payment_confirmation">
							<div class="ann">
								<p><i class="fas fa-lock"></i> All card information is fully encrypted, secure and protected.</p>
							</div>
							<div class="payment">
								<div id="form-container" class="sq-payment-form">
									<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<div class="card_header">
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<div class="titel">
															<p>CREDIT/DEBIT CARD</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
											<div class="form-group">
												<label>Card holder name<span>*</span></label>
												<input type="text" name="card_holder" class="form-control" required>
											</div>
											
											<div class="sq-field">
							                    <label class="sq-label">Card Number<span>*</span></label>
							                    <div id="sq-card-number"></div>
							                </div>
							                <div class="sq-field-wrapper">
							                    <div class="sq-field sq-field--in-wrapper">
							                        <label class="sq-label">CVV<span>*</span></label>
							                        <div id="sq-cvv"></div>
							                    </div>
							                    <div class="sq-field sq-field--in-wrapper">
							                        <label class="sq-label">Expiration<span>*</span></label>
							                        <div id="sq-expiration-date"></div>
							                    </div>
							                    <div class="sq-field sq-field--in-wrapper">
							                        <label class="sq-label">Postal Code<span>*</span></label>
							                        <div id="sq-postal-code"></div>
							                    </div>
							                </div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
											<div class="card_vie">
												<img src="{{asset('userViewport/assets/image/visa-classic-350.png')}}" alt="card">
											</div>
										</div>
										<br>
										<br>
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<label class="condition_agree con_agre">
												<input type="checkbox" name="payment_terms_policy" required><span> By proceeding with this booking, I agree to Agoda’s <a href="{{route('page-terms&condition')}}">Terms of Use</a> and <a href="{{route('page-privacy&policy')}}">Privacy Policy</a>.</span>
											</label>
										</div>
									</div>
									<br>
									<p class="con_mail">We'll send confirmation of your booking to example12@yahoo.com</p>
									<div class="button-container">
										{{-- <div class="btn btn-prev default_btn disabled go_back_3"> Back</div> --}}
										<button type="submit" id="sq-creditcard" class="btn btn-next default_btn" onclick="onGetCardNonce(event)"> submit</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					
					<div id="boking_step_4">
						<div class="modalbox success center animate">
							<div class="icon">
							  <img src="{{asset('userViewport/assets/image/checkmark-for-verification.png')}}" alt="icon image">
							</div>
							<!--/.icon-->
							<h5>Booking Confirm successfuly!!</h5>
							<p>We've sent a confirmation to your e-mail.</p>
							<a href="{{URL::to('/')}}" class="btn default_btn">ok</a>
						  </div>
					</div>

					<div id="boking_step_5">
						<div class="modalbox success center animate">
							<div class="icon">
							  <img src="{{asset('userViewport/assets/image/wrong.png')}}" alt="icon image">
							</div>
							<!--/.icon-->
							<h5>Booking Confirm unsuccessfull!!</h5>
							<p>Please Try again.</p>
							<a href="{{route('cartTocheckout')}}" class="btn default_btn">Go Back Checkout</a>
						  </div>
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
    	// $('#boking_step_2').hide();
    
		
    	$('#boking_step_4').hide();
    	$('#boking_step_5').hide();
     	const paymentForm = new SqPaymentForm({
             // Initialize the payment form elements

             //TODO: Replace with your sandbox application ID
             applicationId: "sandbox-sq0idb-KVaxUSzFcUK3rL8a9zz5sA",
             inputClass: 'form-control',
             autoBuild: false,
             // Customize the CSS for SqPaymentForm iframe elements
             inputStyles: [{
                 fontSize: '16px',
                 lineHeight: '24px',
                 padding: '16px',
                 placeholderColor: '#a0a0a0',
                 backgroundColor: 'transparent',
             }],
             // Initialize the credit card placeholders

             cardNumber: {
                 elementId: 'sq-card-number',
                 placeholder: 'Card Number'
             },
             cvv: {
                 elementId: 'sq-cvv',
                 placeholder: 'CVV'
             },
             expirationDate: {
                 elementId: 'sq-expiration-date',
                 placeholder: 'MM/YY'
             },
             postalCode: {
                 elementId: 'sq-postal-code',
                 placeholder: 'Postal'
             },
            // SqPaymentForm callback functions
            callbacks: {
                 /*
                 * callback function: cardNonceResponseReceived
                 * Triggered when: SqPaymentForm completes a card nonce request
                 */
                cardNonceResponseReceived: function (errors, nonce, cardData) {
	                if (errors) {
	                 	// Log errors from nonce generation to the browser developer console.
	                 	console.error('Encountered errors:');
	                 	errors.forEach(function (error) {
	                     	console.error('  ' + error.message);
	                 	});
	                 	alert('Encountered errors, check browser developer console for more details');
	                 return;
                 	}
                 	//TODO: Replace alert with code in step 2.1
                	//  alert('here is your card token ' + nonce);
                 	$.ajax({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         url: "{{ route('add-card') }}",
                         type: "POST",
                         data: {nonce},
                         success: function(data){
                            $('#boking_step_4').show();
                            $('#boking_step_2').hide();
                            console.log('data', data);
                         },
                         error: function (xhr, status, error) {
                         	$('#boking_step_5').show();
                         	$('#boking_step_2').hide();
                            console.log('error', error)
                         }
                    });
                }
            }
        });
        paymentForm.build();

        // onGetCardNonce is triggered when the "Pay $1.00" button is clicked
        function onGetCardNonce(event) {
             // Don't submit the form until SqPaymentForm returns with a nonce
             event.preventDefault();
             // Request a nonce from the SqPaymentForm object
             paymentForm.requestCardNonce();
        }
    </script>
@endsection