@extends('user.dashboard.layout')

@section('userDashboard_title_content')
    <title>360pic | User Dashboard</title>
@endsection

@section('userDashboard_css_content')
@endsection

@section('userDashboard_nav_content')
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('home')}}">Home</a></li>
        <li><span>Dashboard</span></li>
    </ul>
@endsection
@section('userDashboard_main_content')
    @if(session()->has('message'))
        <div class="alert alert-success alert-blo">
            <a type="button" class="close" data-dismiss="alert"></a> 
            <strong> {{ session()->get('message') }} </strong>
        </div>
    @endif
    <!-- order list area start -->
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="header-title">Your ordered product List</h4>
            <div class="trad-history mt-4">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="buy_order" role="tabpanel">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tbody>
                                    <tr class="heading-td">
                                        <td align="center">Product Name</td>
                                        <td align="center">Product Code</td>
                                        <td align="center">Product Price</td>
                                        <td align="center">Order Status</td>
                                        <td align="center">Order Date</td>
                                        <td align="center">View Order</td>
                                        <td align="center">Action</td>
                                    </tr>
                                    @foreach($orders as $order)
                                        @foreach($order->orderproduct as $product)
                                            <tr>
                                                <td align="center">{{$product->product_name}}</td>
                                                <td align="center">{{$product->product_SKU}}</td>
                                                <td align="center">{{$product->product_price}}</td>
                                                <td align="center"><span class="pending_dot">{{$order->order_status}}</span></td>
                                                <td align="center">{{ Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                                                <td align="center"><a href="{{route('user.order.show',$order->id)}}">View Order</a></td>
                                                @if($order->order_status == 'Pending')
                                                <td align="center">
                                                    <form action="{{route('cancel.order')}}" method="post" id="enable-form-{{$order->id}}" style="display: none;">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="status" value="Canceled">
                                                        <input type="hidden" name="id" value="{{$order->id}}">
                                                    </form>
                                                    <a href="" style=" font-size: 18px;" onclick="
                                                    if(confirm('Are you Want to Cancel this Order!'))
                                                    {
                                                        event.preventDefault();
                                                        document.getElementById('enable-form-{{$order->id}}').submit();
                                                    }
                                                    else
                                                    {
                                                        event.preventDefault();
                                                    }
                                                    ">
                                                        <label class="badge badge-primary"><small>Cancel Order</small></label>
                                                    </a>
                                                </td>

                                                {{-- @elseif(($order->order_status == 'Delivered' || $order->order_status == 'Shipped') && Carbon\Carbon::parse($order->updated_at)->addHour(48)->toDateTimeString() > Carbon\Carbon::now()->toDateTimeString())
                                                    <td align="center"><a href="{{route('user.order.return',$order->id)}}">Return Product</a></td> --}}
                                                @else
                                                <td align="center">-</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination_area pull-right mt-5">
                <ul>
                    <li>{!! $orders->appends(['sort' => 'id'])->links() !!}</li>
                    {{-- <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li> --}}
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('userDashboard_js_content')
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
