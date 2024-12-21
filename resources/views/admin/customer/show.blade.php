@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Customer</title>
@endsection
@section('admin_css_content')

@endsection
@section('admin_content_header')
		<h1>
		  	Customers
		</h1>
		<ol class="breadcrumb">
		    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">Customers</li>
		</ol>
@endsection

@section('admin_main_content')
	@if ($errors->any())
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
	            <div class="box-header">
	              	<h3 class="box-title pull-left">Customer List</h3>
	              	{{-- <a class="btn btn-info pull-right" data-toggle="modal" data-target="#exampleModal">Add Tag</a> --}}
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>S.No</th>
				                <th>Customer Name</th>
				                <th>Username</th>
				                <th>Email</th>
				                <th>Status</th>
				                <th>Change Status</th>
				                <th>Delete</th>
			                </tr>
		                </thead>
		                <tbody>
		                	@foreach($customers as $customer)
				                <tr>
				                  	<td>{{$loop->index + 1}}</td>
				                  	<td>{{$customer->name}}</td>
				                  	<td>{{$customer->username}}</td>
				                  	<td>{{$customer->email}}</td>
				                  	<td>
		                            @if($customer->status == 1)
		                            	<label class="badge badge-success">Active</label>
		                            @else
		                            	<label class="badge badge-warning">Inactive</label>
		                            @endif
		                        </td>
		                        <td>
		                        		@if($customer->status == 1)
		                            		<form action="{{route('customer.disable')}}" method="post" id="disable-form-{{$customer->id}}" style="display: none;">
				                              {{csrf_field()}}
				                              <input type="hidden" name="status" value="0">
				                              <input type="hidden" name="id" value="{{$customer->id}}">
				                            </form>
				                            <a href="" class="btn btn-danger" style="font-size: 18px;" onclick="
				                            if(confirm('Are you Want to Disable this Account!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('disable-form-{{$customer->id}}').submit();
				                            }
				                            else
				                            {
				                                event.preventDefault();
				                            }
				                            ">Disable</a>
		                            @else
			                            	<form action="{{route('customer.enable')}}" method="post" id="enable-form-{{$customer->id}}" style="display: none;">
				                              {{csrf_field()}}
				                              <input type="hidden" name="status" value="1">
				                              <input type="hidden" name="id" value="{{$customer->id}}">
				                            </form>
				                            <a href="" class="btn btn-info" style=" font-size: 18px;" onclick="
				                            if(confirm('Are you Want to Enable this Account!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('enable-form-{{$customer->id}}').submit();
				                            }
				                            else
				                            {
				                                event.preventDefault();
				                            }
				                            ">Enable</a>
		                            @endif
		                        </td>
		                        <td>
		                            <form action="{{route('customers.destroy',$customer->id)}}" method="post" id="delete-form-{{$customer->id}}" style="display: none;">
		                              {{csrf_field()}}
		                              {{method_field('DELETE')}}
		                            </form>
		                            <a href="" style=" font-size: 18px;" onclick="
		                            if(confirm('Are you Want to Uproot this!'))
		                            {
		                                event.preventDefault();
		                                document.getElementById('delete-form-{{$customer->id}}').submit();
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