@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<h1>
  		Customers Order List
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Customers Order List</li>
	</ol>
@endsection

@section('admin_main_content')

	<div class="row">
			<div class="col-lg-12">
					<div class="box box-info">
	            <div class="box-header with-border">
	              	<h3 class="box-title">Latest Orders</h3>

	              	<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              	</div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	            	<div class="table-responsive">
	                	<table class="table no-margin">
			            
			                <thead>
				                <tr>
					                <th>Tracking Id</th>
					                <th>Customers Name</th>
					                <th>Email</th>
					                <th>Phone No</th>
					                <th>Product Price</th>         
					                <th>Working Date</th>           
					                <th>Working Time</th>           
					                <th>Status</th>	                
					                <th>Show Order</th>
					                <th>Delete</th>
				                </tr>
			                </thead>
			                <tbody>
			                	@foreach($orders as $order)
					                	<tr>
					                  		<td>{{$order->tracking_id}}</td>
				                        <td>{{$order->first_name}} {{$order->last_name}}</td>
				                        <td>{{$order->email}}</td>
				                        <td>{{$order->phone}}</td>
				                        <td>{{$order->total}}</td>
				                        <td>{{ $order->datetimepicker->date }}</td>
				                        <td>{{ $order->datetimepicker->time }}</td>
				                        <td>
				                        	@if($order->order_status == 'Pending')
				                        		<span class="label label-warning">Pending</span>
				                        	@elseif($order->order_status == 'Processing_Order')
				                        		<span class="label label-info">Processing</span>
				                        	@elseif($order->order_status == 'Delivery_in_progress')
				                        		<span class="label label-primary">Delivery in progress</span>
				                        	@elseif($order->order_status == 'Canceled')
				                        		<span class="label label-danger">Canceled</span>
				                        	@endif
				                        <td>
				                        	<a href="{{route('customers-order.show',$order->id)}}" style="font-size: 18px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
				                        </td>
				                        <td>
				                            <form action="{{route('customers-order.destroy',$order->id)}}" method="post" id="delete-form-{{$order->id}}" style="display: none;">
				                              {{csrf_field()}}
				                              {{method_field('DELETE')}}
				                            </form>
				                            <a href="" style=" font-size: 18px;" onclick="
				                            if(confirm('Want to remove this!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('delete-form-{{$order->id}}').submit();
				                            }
				                            else
				                            {
				                                event.preventDefault();
				                            }
				                            "><i class="fa fa-trash-o"></i></a>
				                        </td>
					                	</tr>
					            	@endforeach
			                </tbody>
			            </table>
			        </div>
	            </div>
	            <!-- /.box-body -->
	            <div class="box-footer">
	            	<nav>
	                    <ul class="page-numbers">
	                        <span class="page-numbers">{!! $orders->appends(['sort' => 'id'])->links() !!}</span>
	                    </ul>
	                </nav>
	            </div>
	      	</div>
	      	<!-- /.box -->
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
