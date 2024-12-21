@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')
	<style type="text/css" media="screen">
		.cat-name {
			font-weight: bold; 
			font-size: 18px;
		}
		.child-button{
			float: right;
		}
		@media only screen and (max-width: 600px) {
			.button-group {
				float: right;
				display: flex;
				align-items: center;
			}
			.child-button{
				margin-top: -15px;
			}
		}	
	</style>
@endsection
@section('admin_content_header')
	<h1>
	  Product Categories
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Product Categories</li>
	</ol>
@endsection

@section('admin_main_content')
	@if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Success!</h4>
            <p>{{ Session::get('success') }}</p>

            <button type="button" class="close" data-dismiss="alert aria-label"Close>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())                 
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif

  	<div class="row">
        <div class="col-md-8">
          	<div class="box box-info">
	            <div class="box-header">
	              	<h3>Categories</h3>
	            </div>
	            <div class="box-body">
		            <ul class="list-group">
		                @foreach ($categories as $category)
		                  	<li class="list-group-item" style="width: 100%;">
			                    <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
			                    	<div class="cat-name"> 
					                    {{ $category->name }}
					                </div>
			                      	<div class="button-group d-flex row" style="float: right; margin-top: -25px;">
			                        	<button type="button" class="btn btn-sm btn-primary mr-1 edit-category col-lg-4 col-md-3 col-sm-3" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>

				                        <form class="col-lg-3 col-md-3 col-sm-3" action="{{ route('product-category.destroy', $category->id) }}" method="POST" id="delete-form-{{$category->id}}">
				                          	@csrf
				                          	@method('DELETE')

				                          	<button type="submit" class="btn btn-sm btn-danger" onclick="
				                            if(confirm('Are you Want to Uproot this!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('delete-form-{{$category->id}}').submit();
				                            }
				                            else
				                            {
				                                event.preventDefault();
				                            }
				                            ">Delete</button>
				                        </form>
			                      	</div>
			                    </div>
		                  	</li>
		                @endforeach
		            </ul>
	            </div>
          	</div>
        </div>

        <div class="col-md-4">
          	<div class="box box-warning">
	            <div class="box-header">
	              	<h3>Create Category</h3>
	            </div>

	            <div class="box-body">
	              	<form action="{{ route('product-category.store') }}" method="POST">
	                	@csrf
		                <div class="form-group">
		                  	<input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
		                </div>
		                <div class="form-group">
		                  	<button type="submit" class="btn btn-primary">Create</button>
		                </div>
	              	</form>
	            </div>
          	</div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
	      	<div class="modal-dialog" role="document">
		        <div class="modal-content">
		          	<div class="modal-header">
			            <h5 class="modal-title">Edit Category</h5>

			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			              	<span aria-hidden="true">&times;</span>
			            </button>
		          	</div>

			        <form action="" method="POST">
			            @csrf
			            @method('PUT')

			            <div class="modal-body">
			              	<div class="form-group">
			                	<input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
			              	</div>
			            </div>

		            	<div class="modal-footer">
			              	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			              	<button type="submit" class="btn btn-primary">Update</button>
		            	</div>
		          	</form>
		      	</div>
	      	</div>
		</div>
  	</div>
@endsection

@section('admin_js_content')
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>

    <script type="text/javascript">
        $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = "{{ url('product-category') }}/" + id;

            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
        });
    </script>
@endsection