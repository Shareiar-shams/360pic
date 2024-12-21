@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Product</title>
@endsection
@section('admin_css_content')

	<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<style type="text/css" media="screen">
		@media only screen and (max-width: 600px) {
			.col-lg-6{
				left: 0%;
				margin-top: 1%;
				width: 100%;
			}

			.connect .col-lg-6{
				width: 280px;
				margin-left: -20px;
			}

			.custom-file .img-responsive{
				width: 260px;
				height: 150px;
			}

			
			.div-group{
				width: 280px;
				margin-left: 10px;
			}
		}

		.col-md-4{
			margin-right: -20px;
		}
		.connect{
			padding: 0px 50px 20px 50px;
		}

		.custom-file input[type=file]{
			margin-left: 50px; 
			margin-top: 10px;
		}
	</style>
	<style type="text/css" media="screen">
			
			.file-upload {
			  background-color: #ffffff;
			  width: 100%;
			  margin: 0 auto;
			  padding: 20px;
			}
			@media only screen and (max-width: 600px) {
				.file-upload {
				  	background-color: #ffffff;
					width: 100%;
					margin: 0 auto;
					padding: 20px;
				}
			}

			@media only screen and (max-width: 450px) {
				.file-upload {
				  	background-color: #ffffff;
					width: 100%;
					margin: 0 auto;
					padding: 20px;
				}
			}

			.file-upload-btn {
			  width: 100%;
			  margin: 0;
			  color: #fff;
			  background: #1FB264;
			  border: none;
			  padding: 10px;
			  border-radius: 4px;
			  border-bottom: 4px solid #15824B;
			  transition: all .2s ease;
			  outline: none;
			  text-transform: uppercase;
			  font-weight: 700;
			}

			.file-upload-btn:hover {
			  background: #1AA059;
			  color: #ffffff;
			  transition: all .2s ease;
			  cursor: pointer;
			}

			.file-upload-btn:active {
			  border: 0;
			  transition: all .2s ease;
			}

			.file-upload-content {
			  display: none;
			  text-align: center;
			}

			.file-upload-content2 {
			  display: none;
			  text-align: center;
			}

			.file-upload-input {
			  position: absolute;
			  margin: 0;
			  padding: 0;
			  width: 100%;
			  height: 100%;
			  outline: none;
			  opacity: 0;
			  cursor: pointer;
			}

			.file-upload-input2 {
			  position: absolute;
			  margin: 0;
			  padding: 0;
			  width: 100%;
			  height: 100%;
			  outline: none;
			  opacity: 0;
			  cursor: pointer;
			}

			.image-upload-wrap {
			  margin-top: 20px;
			  border: 4px dashed #1FB264;
			  position: relative;
			}

			.image-dropping,
			.image-upload-wrap:hover {
			  background-color: #1FB264;
			  border: 4px dashed #ffffff;
			}

			.image-upload-wrap2 {
			  margin-top: 20px;
			  border: 4px dashed #1FB264;
			  position: relative;
			}

			.image-dropping,
			.image-upload-wrap2:hover {
			  background-color: #1FB264;
			  border: 4px dashed #ffffff;
			}

			.image-title-wrap {
			  padding: 0 15px 15px 15px;
			  color: #222;
			}

			.drag-text {
			  text-align: center;
			}

			.drag-text h3 {
			  font-weight: 100;
			  text-transform: uppercase;
			  color: #15824B;
			  padding: 60px 0;
			}

			.file-upload-image {
			  max-height: 200px;
			  max-width: 200px;
			  margin: auto;
			  padding: 20px;
			}

			.file-upload-image2 {
			  max-height: 200px;
			  max-width: 200px;
			  margin: auto;
			  padding: 20px;
			}

			.remove-image {
			  width: 200px;
			  margin: 0;
			  color: #fff;
			  background: #cd4535;
			  border: none;
			  padding: 10px;
			  border-radius: 4px;
			  border-bottom: 4px solid #b02818;
			  transition: all .2s ease;
			  outline: none;
			  text-transform: uppercase;
			  font-weight: 700;
			}

			.remove-image:hover {
			  background: #c13b2a;
			  color: #ffffff;
			  transition: all .2s ease;
			  cursor: pointer;
			}

			.remove-image:active {
			  border: 0;
			  transition: all .2s ease;
			}
	</style>

	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('admin_content_header')
		<h1>
	  		Product
		</h1>
		<ol class="breadcrumb">
		    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">Product</li>
		</ol>
@endsection

@section('admin_main_content')

	<div class="col-lg-12">
		<!-- general form elements -->
        <div class="box box-info" >
        	<div class="box-header with-border" style="margin-bottom: 20px;">
          		<h3 class="box-title"><b>Edit Post</b></h3>
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
	        <form role="form" class="forms-sample" method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
	        	{{csrf_field()}}
                {{method_field('PUT')}}	
		        	
	        	<div class="form-group" style="padding: 0px 30px 0px 30px">
		            <label class="col-form-label">Title: *</label>
                    <input type="text" class="form-control p-input" name="name" value="{{$product->name}}">
              	</div>

              	<div class="form-group" style="padding: 0px 30px 0px 30px">
		            <label class="col-form-label">Slug: *</label>
                    <input type="text" class="form-control p-input" name="slug" value="{{$product->slug}}">
              	</div>

              	<div class="form-group" style="padding: 0px 30px 0px 30px">
		            <label class="col-form-label">SKU: *</label>
                    <input type="text" class="form-control p-input" name="SKU" value="{{$product->SKU}}">
              	</div>

              	<div class="file-upload" style="padding: 0px 30px 0px 30px">
					<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Display Image</button>

					<div class="image-upload-wrap">
					    <input class="file-upload-input" name="display_image" type='file' onchange="readURL(this);" accept="image/*" />
					    <div class="drag-text">
					      <h3>Drag and drop a file or select Add Display Image</h3>
					    </div>
					</div>

					<div class="file-upload-content">
						@if($product->display_image != 'noimage.jpg')
					    	<img class="file-upload-image" src="{{Storage::disk('local')->url($product->display_image)}}" alt="your image" />
					   	@else
					   		<img class="file-upload-image" src="#" alt="your image" />
					   	@endif
					    <div class="image-title-wrap">
					      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
					    </div>
					</div>
				</div>
				<br>
              	
				<div class="form-group" style="padding: 0px 30px 0px 30px">
		            <label class="col-form-label">Select Categories: *</label>
	                <select class="form-control" name="category_id" id="category" required>
            			<option selected>Select category</option>
						@foreach ($categories as $category)
				            <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

	          	<div class="row" style="padding: 0px 30px 0px 30px">
              		<div class="col-lg-6 form-group">
				        <label class="col-form-label">Price: *</label>
                    	<input type="number" step="any" class="form-control p-input" name="price" value="{{$product->price}}">
				    </div>

				    <div class="col-lg-6 form-group">
				        <label class="col-form-label">Special Price: </label>
                    	<input type="number" step="any" class="form-control p-input" name="special_price" value="{{$product->special_price}}" placeholder="Enter have any special price!">
				    </div>
              	</div>

	          	<div class="form-group" style="padding: 0px 30px 0px 30px">
	                <label class="col-form-label">Body</label>
					<textarea id="editor1" placeholder="Place write Here Anything" name="desc">
						{{$product->desc}}
					</textarea>
				</div>  

				<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Additional Information: </label>
	            	<textarea id="editor2" placeholder="Product Additional Description" name="additional_info" rows="10" cols="80">
	            		{{$product->additional_info}}
	            	</textarea>
	          	</div>
            	  
            	<div class="file-upload" style="padding: 0px 30px 0px 30px">
					<button class="file-upload-btn" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Add Additional Image</button>

					<div class="image-upload-wrap2">
					    <input class="file-upload-input2" name="additional_image" type='file' onchange="readURL2(this);" accept="image/*" />
					    <div class="drag-text">
					      <h3>Drag and drop a file or select Add Additional Image</h3>
					    </div>
					</div>
					<div class="file-upload-content2">
						@if($product->additional_image != null)
					    	<img class="file-upload-image2" src="{{Storage::disk('local')->url($product->additional_image)}}" alt="your image" />
					   	@else
					   		<img class="file-upload-image2" src="#" alt="your image" />
					   	@endif
					    <div class="image-title-wrap">
					      	<button type="button" onclick="removeUpload2()" class="remove-image">Remove <span class="image-title2">Uploaded Image</span></button>
					    </div>
					</div>
				</div>
				<br>

            	<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Meta Title:</label>
	            	<input type="text" class="form-control" name="meta_title" value="{{$product->meta_title}}" id="recipient-name" placeholder="Type Meta Title">
		        </div>

	          	<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Meta Keyword:</label>
	            	<input type="text" class="form-control" name="meta_keyword" value="{{$product->meta_keyword}}" id="recipient-name" placeholder="Type Meta Keyword">
	          	</div>

	          	<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Meta Keyword:</label>
	            	<textarea name="meta_desc" class="form-control" rows="3" cols="3" placeholder="Type Meta Description">{{$product->meta_desc}}</textarea>
	          	</div>

	          	<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">First Button Name:</label>
	            	<input type="text" class="form-control" name="fst_additional_btn" id="recipient-name" value="{{$product->fst_additional_btn}}">
          		</div>

          		<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">First Button Content:</label>
	            	<input type="file" class="form-control" id="recipient-first-content" name="fst_btn_content"/>
          		</div>

          		<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Second Button Name:</label>
	            	<input type="text" class="form-control" name="snd_additional_btn" id="recipient-name" value="{{$product->snd_additional_btn}}">
          		</div>

          		<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Second Button Content:</label>
	            	<input type="file" class="form-control" id="recipient-first-content" name="snd_btn_content"/>
          		</div>

          		<div class="form-group" style="padding: 0px 30px 0px 30px">
	            	<label for="message-text" class="col-form-label">Third Button Name:</label>
	            	<input type="text" class="form-control" name="trd_additional_btn" id="recipient-name" value="{{$product->trd_additional_btn}}">
          		</div>

          		<div class="form-group" style="padding: 0px 30px 0px 30px">
              		<div class="row">
	              		@foreach($images as $image)
		                  	<div id="filediv" class="card col-md-4 col-sm-4">
	                  			<div id='abcd {{$loop->index + 1}}' class='abcd'>
                  					<img class="card-img-top" style='width:100px;height:100px;' id='previewimg {{$loop->index + 1}}'  src='{{Storage::disk('local')->url($image->image_path)}}'/>
                  					<div class="card-body">
	                  					<img style="width:100px; height:50px;" src="{{asset('admin/dist/img/remove.jpg')}}" onclick="myfunction(this)" data-id="{{$image->id}}" id="img" alt="delete">
	                  				</div>
	                  			</div>
						    </div>
				        @endforeach
			        </div>
	              	<input type="button" id="add_more" class="btn btn-primary" value="Add More Files"/>
              	</div>
              	<br>
			  	<div class="form-check" style="padding: 0px 30px 0px 30px">
                    <label class="form-check-label">
                      	<input value="1" type="checkbox" name="status" class="form-check-input"
                      	@if($product->status == 1)
                      		{{'checked'}} 
                      	@endif
                     	>
                      Want Publis It?
                    </label>
              	</div> 
              	<!-- /.box-body -->
      			<div class="box-footer" style="margin-top: 20px; text-align: center;">	
					<button  type="submit" class="btn btn-success mt-4">Submit</button>
            		<a href="{{route('product.index')}}" class="btn btn-danger mt-4">Go Back</a>
            	</div>
	        </form>
        </div>

	</div>
	
@endsection
@section('admin_js_content')
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf-8" async defer>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var abc = 0;
	    $('#add_more').click(function (){
	        $('#filediv').after($("<div/>",{id: 'filediv', class: 'card col-md-4 col-sm-4'}).fadeIn('slow').append($("<input/>",
	            {
	            	class: 'form-control',
	                name: 'images[]',
	                type: 'file',
	                id: 'file'
	            }),
	            $("<br/>")
	    		));
	    });
	    $('.form-group').on('change', '#file', function (){
	        if (this.files && this.files[0]){
	            abc += 1; //increementing global variable by 1
	            var z = abc - 1;
	            var x = $(this)
	                .parent()
	                .find('#previewimg' + z).remove();
	            $(this).before("<div id='abcd" + abc + "' class='abcd'><img class = 'card-img-top' style='width:100px;height:100px;' id='previewimg" + abc + "' src=''/></div>");
	            var reader = new FileReader();
	            reader.onload = imageIsLoaded;
	            reader.readAsDataURL(this.files[0]);
	            $(this)
	                .hide();
	            $("#abcd" + abc).append($("<div/>",{class: 'card-body'})).append($("<img/>",{
	            		style : 'width:100px; height:50px;',
	                id: 'img',
	                src: '{{asset('admin/dist/img/remove.jpg')}}',
	                alt: 'delete'
	            }) .click(function ()
	            {
	                $(this)
	                    .parent()
	                    .parent()
	                    .remove();
	            }));
	        }
	    });
	    //image preview
	    function imageIsLoaded(e)
	    {
	        $('#previewimg' + abc)
	            .attr('src', e.target.result);
	    };

	    function readURL(input) {
		  if (input.files && input.files[0]) {

		    var reader = new FileReader();

		    reader.onload = function(e) {
		      $('.image-upload-wrap').hide();

		      $('.file-upload-image').attr('src', e.target.result);
		      $('.file-upload-content').show();

		      $('.image-title').html(input.files[0].name);
		    };

		    reader.readAsDataURL(input.files[0]);

		  } else {
		    removeUpload();
		  }
		}

		function removeUpload() {
		  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
		  $('.file-upload-content').hide();
		  $('.image-upload-wrap').show();
		}
		$('.image-upload-wrap').bind('dragover', function () {
		    $('.image-upload-wrap').addClass('image-dropping');
		});
		$('.image-upload-wrap').bind('dragleave', function () {
		    $('.image-upload-wrap').removeClass('image-dropping');
		});

		function readURL2(input) {
		  if (input.files && input.files[0]) {

		    var reader = new FileReader();

		    reader.onload = function(e) {
		      $('.image-upload-wrap2').hide();

		      $('.file-upload-image2').attr('src', e.target.result);
		      $('.file-upload-content2').show();

		      $('.image-title2').html(input.files[0].name);
		    };

		    reader.readAsDataURL(input.files[0]);

		  } else {
		    removeUpload2();
		  }
		}

		function removeUpload2() {
		  $('.file-upload-input2').replaceWith($('.file-upload-input2').clone());
		  $('.file-upload-content2').hide();
		  $('.image-upload-wrap2').show();
		}
		$('.image-upload-wrap2').bind('dragover', function () {
		    $('.image-upload-wrap2').addClass('image-dropping');
		});
		$('.image-upload-wrap2').bind('dragleave', function () {
		    $('.image-upload-wrap2').removeClass('image-dropping');
		});

	    function myfunction(e){
    		var id = $(e).data('id');
    		$.ajax({
				url:"{{ route('img_dlt') }}",
				type:"POST",
				data: {
					id: id
				},
				success:function (data) {
					$(e).parent().remove();
				}
			})	 
	    }
		
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

    <script>
      $(function () {
        CKEDITOR.replace('editor2')
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