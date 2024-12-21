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
	    <li class="active">Return Order</li>
	</ol>
@endsection

@section('admin_main_content')
	<div class="row">
		<div class="row container">
	        <div class="col-md-12 col-sm-12 col-lg-12">
	          	<!-- Box Comment -->
	          	<div class="box box-widget">
		            <div class="box-header with-border">
			            <div class="user-block">
			                <span class="username">{{$order->name}}</span>
			                <span class="description">{{$order->created_at->diffForHumans()}}</span>
			            </div>
			            <!-- /.user-block -->
			            <div class="box-tools">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			            </div>
		              	<!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              	<h4>Email: {{$order->email}}</h4>
		              	<h5>Phone: {{$order->phone}}</h5>
		              	<span>Total Price: {{$order->total}}</span>
		              	<br>
		              	<span>Order Id: {{$order->order_id}}</span>
		              	<br>
		              	<span>Tracking Id: {{$order->tracking_id}}</span>
		              	<br>
		              	<h3><strong>Address</strong></h3>
		              	<strong>Division:</strong> <span>{{$order->billing_division}}</span>
		              	<br>
		              	<strong>District:</strong> <span>{{$order->billing_district}}</span>
		              	<br>
		              	<strong>Upazile:</strong> <span>{{$order->billing_upazila}}</span>
		              	<br>
		              	<strong>Area:</strong> <span>{{$order->billing_area}}</span>
		              	<br>
		              	<strong>Home Address:</strong> <span>{{$order->address_1}} {{$order->address_2}}</span>
		              	
		            </div>
		        </div>
	          	<!-- /.box -->

	          	<!-- Box Comment -->
	          	<div class="box box-widget">
		            <div class="box-header with-border">
			            <div class="user-block">
			                <span class="username">Order ID: {{$order->order_id}}</span>
			            </div>
			            <!-- /.user-block -->
			            <div class="box-tools">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			            </div>
		              	<!-- /.box-tools -->
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<h3>Pictue of problem</h3>
		            	@foreach (json_decode($order->orderreturn->images) as $image)
		            		<img class="img-responsive pad" src="{{Storage::disk('local')->url($image)}}" alt="Photo">
		            	@endforeach
		              	<strong>Problem: </strong><p>{{$order->orderreturn->problem_details}}</p>
		              	<h5>Return Payment Method: {{$order->orderreturn->payment_method}}</h5>
		              	<span>Mobile Banking Number: {{$order->orderreturn->phone_number}}</span>
		              	<span>Ticket Date: {{$order->orderreturn->created_at->diffForHumans()}}</span>
		              	
		            </div>
		        </div>
	          	<!-- /.box -->
	        </div>
	    </div>
	</div>
@endsection

@section('admin_js_content')
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>

	<script>
	  $(function () {
	    $('#example1').DataTable()
	    $('#example2').DataTable({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>

	<!-- CK Editor -->
    <script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
      })
    </script>
@endsection