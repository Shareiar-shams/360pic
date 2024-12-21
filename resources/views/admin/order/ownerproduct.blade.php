@extends('admin.layout')
@section('admin_title_content')
    <title>Nababmall | Dashboard</title>
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<h1>
  		Order
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="{{route('order-item.index')}}"><i class="fa fa-shopping-basket"></i> Order</a></li>
	    <li class="active">Owner Product</li>
	</ol>
@endsection

@section('admin_main_content')
	<div class="row">
		@foreach($orders as $order)
	        <div class="col-md-4">
	          <div class="box box-solid">
	            <div class="box-header with-border">
	            	@foreach($products as $product)
	            		@if($product->id == $order->product_id)
	              		<img height="200" width="325" src="{{Storage::disk('local')->url($product->display_image)}}" alt="" style="margin-bottom: 10px;">
	              		@endif
	              	@endforeach
	              	<h3 class="box-title">{{$order->product_name}}</h3>

	              	<span class="pull-right">Price: {{$order->product_price}}</span>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              	@foreach($details as $detail)
	              		@if($detail->id == $order->order_id)
	              			<p>Order Status:
	              				@if($detail->order_status == 'Pending')
	                        		<span class="label label-warning">Pending</span>
	                        	@elseif($detail->order_status == 'Processing_Order')
	                        		<span class="label label-info">Processing</span>
	                        	@elseif($detail->order_status == 'Shipped')
	                        		<span class="label label-success">Shipped</span>
	                        	@elseif($detail->order_status == 'Delivered')
	                        		<span class="label label-danger">Delivered</span>
	                        	@elseif($detail->order_status == 'Canceled')
	                        		<span class="label label-danger">Canceled</span>
	                        	@else
	                        		<span class="label label-danger">Returned</span>
	                        	@endif
	              			</p> 

	              			<p><strong>Client Name:</strong> {{$detail->name}}</p>
	              			<p><strong>Client Mail:</strong> {{$detail->email}}</p>
	              			<p><strong>Client Phone:</strong> {{$detail->phone}}</p>
	              			<p><strong>Client Phone:</strong> {{$detail->phone}}</p>
	              			<p><strong>Order Date:</strong> {{ Carbon\Carbon::parse($detail->created_at)->format('d M Y') }}</p>
	              			<p><strong>Order Id:</strong> {{$detail->order_id}}</p>
	              			<p><strong>Tracking Id:</strong> {{$detail->tracking_id}}</p>
	              		@endif
	              	@endforeach
	            </div>
	            <!-- /.box-body -->
	            <div class="box-footer">
	            	<a href="{{route('order-item.show',$order->order_id)}}" class="btn btn-info">Show Order</a>
	            </div>
	          </div>
	          <!-- /.box -->
	        </div>
        @endforeach
    </div>
@endsection

@section('admin_js_content')
@endsection