@extends('admin.layout')

@section('admin_title_content')

    <title>360pic | Page Index</title>

@endsection

@section('admin_css_content')

	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}

  	<!-- Select2 -->
		<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
		
  	<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('admin_content_header')

	<h1>

  		Pages

	</h1>

	<ol class="breadcrumb">

	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>

	    <li class="active">Page List</li>

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

	              	<h3 class="box-title">Page Lists</h3>

	              	<a class="btn btn-info pull-right" href="{{route('page.create')}}">Add Page</a>

	            </div>

	            <!-- /.box-header -->

	            <div class="box-body">

		            <table id="example1" class="table table-bordered table-striped">

		                <thead>

			                <tr>

				                <th>S.No</th>

				                <th>Name</th>

				                <th>Slug</th>

				                <th>Controller Action</th>	 

				                <th>Status</th>              

				                <th>Edit</th>

				                <th>Delete</th>

			                </tr>

		                </thead>

		                <tbody>

		                	@foreach($pages as $page)

				                <tr>

				                  	<td>{{$loop->index + 1}}</td>

				                  	<td>{{$page->title}}</td>

			                        <td>{{$page->slug}}</td>

			                        <td>{{$page->controller_action}}</td>

			                        <td>

			                            @if($page->status == 1)

			                            	<label class="badge badge-success">Publis</label>

			                            @else

			                            	<label class="badge badge-warning">On Hold</label>

			                            @endif

			                        </td>

			                        <td>

			                        	<a href="{{route('page.edit',$page->id)}}" style="font-size: 18px;"><i class="fa fa-edit"></i></a>

			                        </td>

			                        <td>

			                            <form action="{{route('page.destroy',$page->id)}}" method="post" id="delete-form-{{$page->id}}" style="display: none;">

			                              {{csrf_field()}}

			                              {{method_field('DELETE')}}

			                            </form>

			                            <a href="" style=" font-size: 18px;" onclick="

			                            if(confirm('Want to remove this!'))

			                            {

			                                event.preventDefault();

			                                document.getElementById('delete-form-{{$page->id}}').submit();

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

    <!-- Page script -->
	<script>
	  $(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()

	    //Datemask dd/mm/yyyy
	    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	    //Datemask2 mm/dd/yyyy
	    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
	    //Money Euro
	    $('[data-mask]').inputmask()

	    //Date range picker
	    $('#reservation').daterangepicker()
	    //Date range picker with time picker
	    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
	    //Date range as a button
	    $('#daterange-btn').daterangepicker(
	      {
	        ranges   : {
	          'Today'       : [moment(), moment()],
	          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
	          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
	          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        },
	        startDate: moment().subtract(29, 'days'),
	        endDate  : moment()
	      },
	      function (start, end) {
	        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	      }
	    )

	    //Date picker
	    $('#datepicker').datepicker({
	      autoclose: true
	    })

	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass   : 'iradio_minimal-blue'
	    })
	    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass   : 'iradio_minimal-red'
	    })
	    //Flat red color scheme for iCheck
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass   : 'iradio_flat-green'
	    })

	    //Colorpicker
	    $('.my-colorpicker1').colorpicker()
	    //color picker with addon
	    $('.my-colorpicker2').colorpicker()

	    //Timepicker
	    $('.timepicker').timepicker({
	      showInputs: false
	    })
	  })
	</script>
@endsection

