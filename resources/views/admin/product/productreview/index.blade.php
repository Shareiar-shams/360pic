@extends('admin.layout')
@section('admin_title_content')
    <title>Nababmall | Dashboard</title>
@endsection
@section('admin_css_content')
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Select2 -->
	
@endsection
@section('admin_content_header')
	<h1>
  		Product Review
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="{{route('product.index')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Product</a></li>
	    <li class="active">Product Review</li>
	</ol>
@endsection

@section('admin_main_content')

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
	            <div class="box-header">
	              	<h3 class="box-title">Review Lists</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>S.No</th>
				                <th>User Name</th>
				                <th>Product Name</th>
				                <th>Review</th>	                
				                <th>Rating</th>
				                <th>Delete</th>
			                </tr>
		                </thead>
		                <tbody>
		                	@foreach($reviews as $review)
				                <tr>
				                  	<td>{{$loop->index + 1}}</td>
				                  	@foreach($users as $user)
				                  		@if($user->id == $review->user_id)
				                  			<td>{{$user->username}}</td>
				                  		@endif
				                  	@endforeach
				                  	@foreach($products as $product)
				                  		@if($product->id == $review->product_id)
				                  			<td>{{$product->name}}</td>
				                  		@endif
				                  	@endforeach
				                  	<td>{{$review->review}}</td>
			                        <td>{{$review->rating}}</td>
			                        <td>
			                            <form action="{{route('product-review.destroy',$review->id)}}" method="post" id="delete-form-{{$review->id}}" style="display: none;">
			                              {{csrf_field()}}
			                              {{method_field('DELETE')}}
			                            </form>
			                            <a href="" style=" font-size: 18px;" onclick="
			                            if(confirm('Want to remove this!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('delete-form-{{$review->id}}').submit();
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
	<!-- Select2 -->
	<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	

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
