@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
    <h1>
      Dashboard
      <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search Results</li>
    </ol>
@endsection

@section('admin_main_content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
	            <div class="box-header">
	              	<h3 class="box-title pull-left">Search List</h3>
	              	<br>
	              	<div class="card"><b>{{ $searchResults->count() }} results found for "{{ request('query') }}"</b></div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>S.No</th>
				                <th>Search Type</th>
				                <th>Name/Title</th>
			                </tr>
		                </thead>
		                <tbody>
		                	@foreach($searchResults->groupByType() as $type => $modelSearchResults)
				                <tr>
				                  	<td>{{$loop->index + 1}}</td>
				                  	<td>{{ ucfirst($type) }}</td>
				                  	<td>
				                  		@foreach($modelSearchResults as $searchResult)
		                                <ul>
		                                    <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></li>
		                                </ul>
		                            	@endforeach
		                        	</td>
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