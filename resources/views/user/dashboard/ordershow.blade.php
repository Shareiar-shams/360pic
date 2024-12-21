@extends('user.dashboard.layout')

@section('userDashboard_title_content')
    <title>360pic | User Dashboard</title>
@endsection

@section('userDashboard_css_content')
@endsection

@section('userDashboard_nav_content')
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><span>Order</span></li>
    </ul>
@endsection
@section('userDashboard_main_content')
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @foreach($orders->orderproduct as $order)
                        @foreach($products as $pro)
                            @if($pro->id == $order->product_id)
                                <div class="media mb-5">
                                    <img class="img-fluid mr-4" src="{{Storage::disk('local')->url($pro->display_image)}}" height="200" width="250" alt="image">
                                    <div class="media-body">
                                        <small>category: {{$order->product_category}}</small>
                                        <h4 class="mb-3"> {{$order->product_name}}</h4>
                                        <h6>SKU: {{$order->product_SKU}}</h6>
                                        
                                        <p>{!!htmlspecialchars_decode($pro->desc)!!}</p>
                                        <p><strong>Price:</strong><span> {{$order->product_price}}</span></p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Billing Information</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Cost information</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <strong>Buyer Name:</strong> <span>{{$orders->first_name}} {{$orders->last_name}}</span><br><br>
                            <strong>Buyer Email:</strong> <span>{{$orders->email}}</span><br><br>
                            <strong>Phone No: </strong> <span>{{$orders->phone}}</span> 
                            <br><br>
 
                            <h5>Billing Address:</h5> <span>{{$orders->billing_area}}</span>
                            <br>
                            <br>
                            <h5>Working Address </h5>

                            <p>Street Name: {{$orders->work_area}}</p>
                            <p>House No: {{$orders->addressline}}</p>
                            <p>City: {{$orders->city}}</p>
                            <p>Postal Code: {{$orders->postal_code}}</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <h4>Subtotal Price: {{$orders->subtotal}}</h4>
                            <h6>Product Quantity: {{$orders->order_quantity}}</h6>
                            
                            <h3>Total Price: {{$orders->total}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-header">
                    <h5>Additional Content From Admin</h5>
                </div>
                <div class="card-body">
                    <p>{!!htmlspecialchars_decode($orders->short_answer)!!}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
            <div class="card">
                <a class="btn btn-info btn-block" href="{{route('invoice.download',$orders->id)}}">Download Invoice</a>
            </div>
        </div>
    </div>
    
@endsection

@section('userDashboard_js_content')
@endsection