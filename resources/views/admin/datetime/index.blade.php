@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Date & Time</title>
@endsection
@section('admin_css_content')

@endsection
@section('admin_content_header')
    <h1>
		  	Date & Time
		</h1>
		<ol class="breadcrumb">
		    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">Date & Time</li>
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
		<div class="col-lg-12">
				<div class="box">
            <div class="box-header">
              	<h3 class="box-title">Date & Time List</h3>
              		<a class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-success">Add Date Time</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
	            <table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
			                <th>No</th>
			                <th>Time</th>
			                <th>Date</th>
			                <th>StrToDateTime</th>		                
			                <th>Edit</th>
			                <th>Delete</th>
		                </tr>
	                </thead>
	                <tbody>
	                	@foreach($datetimes as $datetime)
			                <tr>
			                  	<td>{{$loop->index + 1}}</td>
			                  	<td>{{$datetime->date}}</td>
			                  	<td>{{$datetime->time}}</td>
			                  	<td>{{$datetime->strdatetime}}</td>	
		                  		<td>
	                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-category col-lg-4 col-md-3 col-sm-3" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $datetime->id }}" data-date="{{ date('Y-m-d',strtotime($datetime->date)) }}" data-time="{{date('H:i', strtotime($datetime->time)) }}">Edit</button>
	                        </td>
	                        <td>
	                            <form action="{{route('datetime-set.destroy',$datetime->id)}}" method="post" id="delete-form-{{$datetime->id}}" style="display: none;">
	                              {{csrf_field()}}
	                              {{method_field('DELETE')}}
	                            </form>
	                            <a href="" style=" font-size: 18px;" onclick="
	                            if(confirm('Are you Want to Uproot this!'))
	                            {
	                                event.preventDefault();
	                                document.getElementById('delete-form-{{$datetime->id}}').submit();
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
		<div class="modal modal-success fade" id="modal-success">
			  <div class="modal-dialog">
	          <div class="modal-content">
			      		<div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLongTitle">Add Date Time</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
			      		</div>
				      	<div class="modal-body">
					      	
					        <form action="{{route('datetime-set.store')}}" method="post" enctype="multipart/form-data">
					          	{{csrf_field()}}
					          	
					          	<div class="form-group">
					            	<label for="message-text" class="col-form-label">Date:</label>
					            	<input type="date" class="form-control" name="date" id="date">
					          	</div>

					          	<div class="form-group">
					            	<label for="message-text" class="col-form-label">Time:</label>
					            	<input type="time" class="form-control" name="time" id="time">
					          	</div>
						        	<div class="modal-footer">
			                	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
			                	<button type="submit" class="btn btn-outline">Save</button>
				              </div>
					        </form>
				      	</div>
	    			</div>
			  </div>
		</div>
		<div class="modal modal-success fade" tabindex="-1" role="dialog" id="editCategoryModal">
    	<div class="modal-dialog" role="document">
        <div class="modal-content">
          	<div class="modal-header">
	            <h5 class="modal-title">Edit Date Time</h5>

	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              	<span aria-hidden="true">&times;</span>
	            </button>
          	</div>

	        <form action="" method="POST">
	            @csrf
	            @method('PUT')

	            <div class="modal-body">
	              	<div class="form-group">
	                		<input type="date" name="date" class="form-control" value="" placeholder="Date" required>
	              	</div>
	              	<div class="form-group">
	                		<input type="time" name="time" class="form-control" value="" placeholder="Time" required>
	              	</div>
	            </div>

            	<div class="modal-footer">
	              	<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
	              	<button type="submit" class="btn btn-primary">Update</button>
            	</div>
          	</form>
      	</div>
    	</div>
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

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>

	  <script type="text/javascript">
	      $('.edit-category').on('click', function() {
	          var id = $(this).data('id');
	          var date = $(this).data('date');
	          var time = $(this).data('time');
	          var url = "{{ url('datetime-set') }}/" + id;

	          $('#editCategoryModal form').attr('action', url);
	          $('#editCategoryModal form input[name="date"]').val(date);
	          $('#editCategoryModal form input[name="time"]').val(time);
	      });
	  </script>

  
@endsection