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
		<div class="col-lg-12">
			<div class="box">
	            <div class="box-header">
	              	<h3 class="box-title">Processing Order Lists</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>Customers Name</th>
				                <th>Email</th>
				                <th>Phone No</th>
				                <th>Product Price</th>         
				                <th>Order Date</th>           
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
			                        <td>{{ Carbon\Carbon::parse($order->updated_at)->format('d M Y') }}</td>
			                        <td>
			                        	<form action="{{route('change_status')}}" method="post" id="disable-form-{{$order->id}}" style="display: none;">
				                            {{csrf_field()}}

				                            <input type="hidden" name="status" value="Delivery_in_progress">

				                            <input type="hidden" name="id" value="{{$order->id}}">
				                        </form>
			                            <a href="" style=" font-size: 18px;" onclick="
			                            if(confirm('This product are ready for Delivery!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('disable-form-{{$order->id}}').submit();
			                            }
			                            else
			                            {
			                                event.preventDefault();
			                            }
			                            ">Delivery in progress</a>
			                        </td>
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
	            <!-- /.box-body -->
	      	</div>
	      	<!-- /.box -->
		</div>
	</div>

@endsection

@section('admin_js_content')
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
