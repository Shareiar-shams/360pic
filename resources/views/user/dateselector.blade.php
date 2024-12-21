@extends('user.layout')

@section('title_content')
    <title>360pic | Booking Process</title>
@endsection

@section('css_content')
    
@endsection

@php
    date_default_timezone_set("Asia/Dhaka");
@endphp

@section('main_content')
	<!--===  Inner Banner Area Start ===-->
    <section class="inner_banner_area section_padding" data-background="{{asset('user/assets/image/inner_banner.png')}}">
	    <div class="container">
	        <div class="inner_titel text-center">
	            <h2>Date Range Picker</h2>
	        </div>
	    </div>
	</section>
    <!--===  Inner Banner Area End ===-->
    <!-- Booking Process Area Start -->
    <div class="booking_process_area">
        <div class="container">
            <div class="row">
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="profile_detail_cl">
                        {{-- <div class="booking_status" id="status">
                            <a href="#">running....</a>
                        </div> --}}
                        <div class="cr_booking_proceedure_right" id="appoinment">
                            <div class="row">
                                @if(session()->has('success_msg'))
                                    <p class="alert alert-success" role="alert">{{session ('success_msg')}}</p>
                                @endif

                                @if(session()->has('alert_msg'))
                                    <p class="alert alert-success" role="alert">{{session ('alert_msg')}}</p>
                                @endif

                                @if(session()->has('destroy_message'))
                                    <p class="alert alert-danger" role="alert">{{session ('destroy_message')}}</p>
                                @endif

                                @if ($errors->any())
                          
                                    @foreach ($errors->all() as $error)
                                        <p class="alert alert-danger" role="alert">{{$error}}</p>
                                    @endforeach
                                                       
                                @endif
                                @if(\Cart::session(Session::getId())->getTotalQuantity()>0)
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 cl_al_order">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                  <th scope="col">&nbsp;</th>
                                                  <th scope="col">&nbsp;</th>
                                                  <th scope="col">Product name</th>
                                                  <th scope="col">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\Cart::session(Session::getId())->getContent() as $item)
                                                    <tr>
                                                      <th scope="row">
                                                        <form action="{{route('cart.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
                                                          {{csrf_field()}}
                                                          {{method_field('DELETE')}}
                                                        </form>
                                                        <a href="" title="Remove this item" class="remove" onclick="
                                                        if(confirm('Are you want to remove this item!'))
                                                        {
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{$item->id}}').submit();
                                                        }
                                                        else
                                                        {
                                                            event.preventDefault();
                                                        }
                                                        "><b>×</b></a>
                                                      </th>
                                                      <td>
                                                        <img width="180" height="70" src="{{Storage::disk('local')->url($item->attributes->image)}}" alt="">
                                                      </td>
                                                      <td>{{$item->name}}</td>
                                                      <td>&#x24;{{$item->price}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                @endif
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="product_name">
                                        <h4>Total</h4>
                                        <p>Amount :<span>&#x24;{{ \Cart::getSubtotal() }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <div class="date_celender_box">
                                        <div class="selected_date">
                                            <p>{{\Carbon\Carbon::now()->format('d M Y')}}</p>
                                            <span>{{\Carbon\Carbon::now()->format('D')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                    <form method="GET" action="{{route('datepicket')}}">
                                        <div class="row">
                                            {{csrf_field()}}
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                <input type="date" name="date1" id="basic" value="" min="16/05/2019" class="form-control"/>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                                                --
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                <input type="date" name="date2" id="basic" value="" min="16/05/2019" class="form-control"/>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3">
                                                <button type="submit" class="btn btn-primary btn-block" value="apply">Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="appointment_box">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="appointment_day">
                                            <ul>
                                                @foreach ($datearray as $date)  
                                                    <li>
                                                        <p class="day">{{\Carbon\Carbon::parse($date)->format('l')}}</p>
                                                        <p class="date">{{$date}}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="appoinment_date">
                                            <ul>
                                                @foreach ($datearray as $date)
                                                    <li>
                                                        @foreach ($timearray as $time)
                                                            @if($date == $time->date)
                                                                <form id="add-time-{{$time->date.$time->time}}" style="display: none" method="POST" action="{{route('datepicket.add')}}">

                                                                    {{csrf_field()}}

                                                                    <input type="hidden" name="date" value="{{$time->date}}"/>
                                                                    <input type="hidden" name="time" value="{{$time->time}}"/>
                                                                    <input type="hidden" name="datetime_id" value="{{$time->id}}"/>
                                                                </form>

                                                                <a rel="nofollow" onclick="document.getElementById('add-time-{{$time->date.$time->time}}').submit();">{{$time->time}}</a>
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="appoinment_btn">
                                <a href="{{route('cartTocheckout')}}" class="btn default_btn">Proceed to pay</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
            	<div class="cl_al_order" id="order">
	                <div class="table-responsive">
	                    <table class="table">
	                        <thead>
	                            <tr>
	                              <th scope="col">#</th>
	                              <th scope="col">Order Id</th>
	                              <th scope="col">Product name</th>
	                              <th scope="col">Quantity</th>
	                              <th scope="col">Amount</th>
	                              <th scope="col">Payment Gateway</th>
	                              <th scope="col">Status</th>
	                              <th scope="col">Order date</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                              <th scope="row">1</th>
	                              <td>OD1236547890</td>
	                              <td>RMS Masserment</td>
	                              <td>1</td>
	                              <td>$89</td>
	                              <td>Squre</td>
	                              <td>order placed</td>
	                              <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                              <th scope="row">2</th>
	                              <td>OD1236547890</td>
	                              <td>RMS Masserment</td>
	                              <td>1</td>
	                              <td>$89</td>
	                              <td>Squre</td>
	                              <td>order placed</td>
	                              <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                              <th scope="row">3</th>
	                              <td>OD1236547890</td>
	                              <td>RMS Masserment</td>
	                              <td>1</td>
	                              <td>$89</td>
	                              <td>Squre</td>
	                              <td>order placed</td>
	                              <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">4</th>
	                                <td>OD1236547890</td>
	                                <td>RMS Masserment</td>
	                                <td>1</td>
	                                <td>$89</td>
	                                <td>Squre</td>
	                                <td>order placed</td>
	                                <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">5</th>
	                                <td>OD1236547890</td>
	                                <td>RMS Masserment</td>
	                                <td>1</td>
	                                <td>$89</td>
	                                <td>Squre</td>
	                                <td>order placed</td>
	                                <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">6</th>
	                                <td>OD1236547890</td>
	                                <td>RMS Masserment</td>
	                                <td>1</td>
	                                <td>$89</td>
	                                <td>Squre</td>
	                                <td>order placed</td>
	                                <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">7</th>
	                                <td>OD1236547890</td>
	                                <td>RMS Masserment</td>
	                                <td>1</td>
	                                <td>$89</td>
	                                <td>Squre</td>
	                                <td>order placed</td>
	                                <td>11 june 2022</td>
	                            </tr>
	                            <tr>
	                                <th scope="row">8</th>
	                                <td>OD1236547890</td>
	                                <td>RMS Masserment</td>
	                                <td>1</td>
	                                <td>$89</td>
	                                <td>Squre</td>
	                                <td>order placed</td>
	                                <td>11 june 2022</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                  </div> 
	            </div>
            </div> --}}
        </div>
    </div>
    <!-- Booking Process Area End -->
@endsection

@section('js_content')
@endsection