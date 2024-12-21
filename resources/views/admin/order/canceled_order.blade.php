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
	    <li class="active">Order List</li>
	</ol>
@endsection

@section('admin_main_content')

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
	            <div class="box-header">
	              	<h3 class="box-title">Canceled Order Lists</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>S.No</th>
				                <th>Client Name</th>
				                <th>Client Email</th>
				                <th>Client Phone No</th>
				                <th>Item Quantity</th>
				                <th>Subtotal price</th>
				                <th>Total Price</th>	                
				                <th>Order Status</th>	                
				                <th>Order Id</th>	                
				                <th>Show Order</th>
				                <th>Delete</th>
			                </tr>
		                </thead>
		                <tbody>
		                	@foreach($orders as $order)
				                <tr>
				                  	<td>{{$loop->index + 1}}</td>
				                  	<td>{{$order->name}}</td>
			                        <td>{{$order->email}}</td>
			                        <td>{{$order->phone}}</td>
			                        <td>{{$order->order_quantity}}</td>
			                        <td>{{$order->subtotal}}</td>
			                        <td>{{$order->total}}</td>
			                        <td><label class="badge badge-success">{{$order->order_status}}</label></td>
			                        <td>{{$order->order_id}}</td>
			                        <td>
			                        	<a href="{{route('order-item.show',$order->id)}}" style="font-size: 18px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
			                        </td>
			                        <td>
			                            <form action="{{route('order-item.destroy',$order->id)}}" method="post" id="delete-form-{{$order->id}}" style="display: none;">
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
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>

    <script type="text/javascript">
        $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var slug = $(this).data('slug');
            var url = "{{ url('post-category') }}/" + id;

            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
            $('#editCategoryModal form input[name="slug"]').val(slug);
        });
    </script>

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
