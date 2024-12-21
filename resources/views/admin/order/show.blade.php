@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<h1>
  		Order
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Order List</li>
	</ol>
@endsection

@section('admin_main_content')
		<div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
          	<!-- Box Comment -->
          	@foreach($order->orderproduct as $item)
	          	<div class="box box-widget">
		            <div class="box-header with-border">
			            <div class="user-block">
			                <span class="username"><a href="#">{{$item->product_category}}</a></span>
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
		              	<h4>{{$item->product_name}}</h4>
		              	<h5>SKU: {{$item->product_SKU}}</h5>
		              	
		              	<span>Price: {{$item->product_price}}</span>

		              	<h5>Order Date & Time: <span>{{\Carbon\Carbon::parse($order->datetimepicker->date)->format('D')}} {{\Carbon\Carbon::parse($order->datetimepicker->date)->format('d M Y')}}</span>
										<span>{{$order->datetimepicker->time}}</span></h5>
		              	
		            </div>
		        </div>
	        	@endforeach
          	<!-- /.box -->
            {{-- <div class="box-footer box-comments">
                <div class="box-footer">
			    	</div>
            </div> --}}
            <div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12">
				      		<!-- Custom Tabs -->
				      		<div class="nav-tabs-custom">
						        <ul class="nav nav-tabs">
						          	<li class="active"><a href="#tab_1" data-toggle="tab">Billing Information</a></li>
						          	<li><a href="#tab_3" data-toggle="tab">Cost information</a></li>
						        </ul>
						        <div class="tab-content">
							        <div class="tab-pane active" id="tab_1">
							            <h4>Customer Name: {{$order->first_name}} {{$order->last_name}}</h4>
                          <h6>Customer Email: {{$order->email}}</h6>
                          <strong>Customer Phone No: </strong> <span>{{$order->phone}}</span> 
                          <h5>Customer Address:</h5> <span>{{$order->billing_area}}</span>
                          <br>
                          <h5>Working Address </h5>

                          <p>Street Name: {{$order->work_area}}</p>
                          <p>House No: {{$order->addressline}}</p>
                          <p>City: {{$order->city}}</p>
                          <p>Postal Code: {{$order->postal_code}}</p>
							        </div>
						          	<!-- /.tab-pane -->
						          	<div class="tab-pane" id="tab_3">
						          			<h4>Subtotal Price: {{$order->subtotal}}</h4>
	                          <h6>Product Quantity: {{$order->order_quantity}}</h6>
	                          <h3>Total Price: {{$order->total}}</h3>
						          	</div>
						        </div>
						        <!-- /.tab-content -->
					      	</div>
					      <!-- nav-tabs-custom -->
					    </div>

					    <div class="col-lg-12 col-md-12 col-sm-12">
					    	<div class="card">
					    		<div class="card-body">
						    		<p>{{$order->special_note}}</p>
					    		</div>
					    	</div>
					    </div>
						</div>

						<div class="row">
							<div class="box-widget">
								<form class="forms-sample" method="post" action="{{route('feedback', $order->id)}}" enctype="multipart/form-data">
        						{{csrf_field()}}
        						<div class="form-group" style="padding: 0px 30px 0px 30px">
					              <label class="col-form-label">Send any text*</label>
										    <textarea id="editor1" placeholder="Page Content" name="short_answer">
										    </textarea>
										</div>

										<div class="box-footer" style="margin-top: 20px; text-align: center;">	
												<button  type="submit" class="btn btn-success mt-4">Submit</button>
					          </div>
        				</form>
        			</div>
						</div>	

	        <div class="col-lg-12 mt-2" style="display: flex; align-items: center; justify-content: center;">
	            <div class="card">
	                <a class="btn btn-info btn-block" href="{{route('invoice.download',$order->id)}}">Download Invoice</a>
	            </div>
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