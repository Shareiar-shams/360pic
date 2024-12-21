@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Page Create</title>
@endsection
@section('admin_css_content')

@endsection
@section('admin_content_header')
		<h1>
		  Pages
		</h1>
		<ol class="breadcrumb">
		    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">Pages</li>
		</ol>
@endsection

@section('admin_main_content')

	<!-- general form elements -->
    <div class="box box-info" >
    		<div class="box-header with-border" style="margin-bottom: 20px;">
      		<h3 class="box-title"><b>Create Page</b></h3>
    		</div>
	    	@if ($errors->any())                 
						@foreach ($errors->all() as $error)
							<div class="alert alert-danger alert-block">
					        <a type="button" class="close" data-dismiss="alert"></a> 
					        <strong>{{ $error }}</strong>
					    </div>
						@endforeach						                   
				@endif
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" class="forms-sample" method="post" action="{{route('page.store')}}" enctype="multipart/form-data">
        	{{csrf_field()}}	
	        	
        		<div class="form-group" style="padding: 0px 30px 0px 30px">
              	<label for="author" class=" col-form-label">Title*</label>
                <input type="text" class="form-control p-input" name="title" value="" placeholder="Page Title" required>
          	</div>

          	<div class="form-group" style="padding: 0px 30px 0px 30px">
              	<label for="author" class=" col-form-label">SubTitle</label>
              	<textarea class="form-control p-input" name="subtitle" placeholder="Page SubTitle"></textarea>
          	</div>

          	<div class="form-group" style="padding: 0px 30px 0px 30px">
              	<label for="publisher" class="col-form-label">Slug*</label>
            		<input type="text" class="form-control p-input" name="slug" value="" placeholder="Page Slug" required>
          	</div>

          	<div class="form-group" style="padding: 0px 30px 0px 30px">
              	<label for="exampleInputFile">Header Background File</label>
              	<input type="file" id="exampleInputFile" name="file">
              	<p class="help-block">Choose Header Background File</p>
            </div>

            <div class="form-group" style="padding: 0px 30px 0px 30px">
                <label class="col-form-label">Select Controller*</label>
                <select class="form-control" name="controller_action" required>
                	<option value="default" selected>Default</option>
                	<option value="ViewportController" selected>ViewportController</option>
                	<option value="PrivacyController">PrivacyController</option>
                	<option value="AboutController">AboutController</option>
                	<option value="OurApproachController">OurApproachController</option>
                	<option value="TearmAndConditonController">TearmAndConditonController</option>
								</select>
						</div>

          	<div class="form-group" style="padding: 0px 30px 0px 30px">
                <label class="col-form-label">Page Content*</label>
						    <textarea id="editor1" placeholder="Page Content" name="content">
						    </textarea>
						</div>
        	  
		  			<div class="form-check" style="padding: 0px 30px 0px 30px">
                <label class="form-check-label">
                  	<input value="1" type="checkbox" name="status" class="form-check-input">
                  	Want Publis It?
                </label>
          	</div>  
          	<!-- /.box-body -->
	      		<div class="box-footer" style="margin-top: 20px; text-align: center;">	
								<button  type="submit" class="btn btn-success mt-4">Submit</button>
								<button  type="clear" class="btn btn-danger mt-4">Clear</button>
	          </div>
        </form>
    </div>


	
@endsection
@section('admin_js_content')

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

