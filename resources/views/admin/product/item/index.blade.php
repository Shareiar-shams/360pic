@extends('admin.layout')

@section('admin_title_content')

    <title>360pic | Product</title>

@endsection

@section('admin_css_content')

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Select2 -->

	<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">

	<!-- DataTables -->

	<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">



	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>



	<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>



	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<style type="text/css" media="screen">

			

			.file-upload {

			  background-color: #ffffff;

			  width: 570px;

			  margin: 0 auto;

			  padding: 20px;

			}

			@media only screen and (max-width: 600px) {

				.file-upload {

				  	background-color: #ffffff;

					width: 485px;

					margin: 0 auto;

					padding: 20px;

				}

			}



			@media only screen and (max-width: 450px) {

				.file-upload {

				  	background-color: #ffffff;

					width: 300px;

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

	              	<h3 class="box-title">Item Lists</h3>

	              	<a class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-success">Add Item</a>

	            </div>

	            <!-- /.box-header -->

	            <div class="box-body">

		            <table id="example1" class="table table-bordered table-striped">

		                <thead>

			                <tr>

				                <th>S.No</th>

				                <th>SKU</th>

				                <th>Title</th>

				                <th>Slug</th>

				                <th>Display Image</th>

				                <th>Price</th>		                

				                <th>Quantity</th>	                

				                <th>Show</th>   

				                <th>Edit</th>

				                <th>Delete</th>

			                </tr>

		                </thead>

		                <tbody>

		                	@foreach($items as $item)

				                <tr>

				                	<td>{{$loop->index + 1}}</td>

				                  	<td>{{$item->SKU}}</td>

				                  	<td>{{$item->name}}</td>

				                  	<td>{{$item->slug}}</td>

				                  	<td>

					                  	@if($item->display_image != 'noimage.jpg')

				                  			<img class="profile-user-img img-responsive img-circle" src="{{Storage::disk('local')->url($item->display_image)}}" alt="User profile picture">

				                  		@else

				                  			No image

				                  		@endif

			                  		</td>

				                  	<td>{{$item->price}}</td>

				                  	<td>

			                            @if($item->status == 1)

			                            	<label class="badge badge-success">Publis</label>

			                            @else

			                            	<label class="badge badge-warning">On Hold</label>

			                            @endif

			                        </td>

			                        <td>

			                            <a href="{{route('product.show',$item->id)}}" style="font-size: 18px;"><i class="fa fa-eye" aria-hidden="true"></i></a>

			                        </td>

				                  	<td>

			                            <a href="{{route('product.edit',$item->id)}}" style="font-size: 18px;"><i class="fa fa-edit" aria-hidden="true"></i></a>

			                        </td>

			                        <td>

			                            <form action="{{route('product.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">

			                              {{csrf_field()}}

			                              {{method_field('DELETE')}}

			                            </form>

			                            <a href="" style=" font-size: 18px;" onclick="

			                            if(confirm('Are you Want to Uproot this!'))

			                            {

			                                event.preventDefault();

			                                document.getElementById('delete-form-{{$item->id}}').submit();

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



		<!-- create mode -->

		<div class="modal modal-success fade" id="modal-success">

		  	<div class="modal-dialog">

	            <div class="modal-content">

		      		<div class="modal-header">

				        <h5 class="modal-title" id="exampleModalLongTitle">Add Item</h5>

				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

				          <span aria-hidden="true">&times;</span>

				        </button>

		      		</div>

			      	<div class="modal-body">

				      	

				        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">

				          	{{csrf_field()}}

				          	

				          	<div class="form-group">

				            	<label for="message-text" class="col-form-label">Title: *</label>

				            	<input type="text" class="form-control" name="name" id="recipient-name" placeholder="Type Title" required>

				          	</div>



				          	<div class="form-group">

				            	<label for="message-text" class="col-form-label">Slug: *</label>

				            	<input type="text" class="form-control" name="slug" id="recipient-name" placeholder="Type Slug" required>

				          	</div>



				          	<div class="file-upload">

								<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Display Image*</button>



								<div class="image-upload-wrap">

								    <input class="file-upload-input" name="display_image" type='file' onchange="readURL(this);" accept="image/*" />

								    <div class="drag-text">

								      <h3>Drag and drop a file or select Add Display Image</h3>

								    </div>

								</div>

								<div class="file-upload-content">

								    <img class="file-upload-image" src="#" alt="your image" />

								    <div class="image-title-wrap">

								      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>

								    </div>

								</div>

							</div>

							<br>



							<div class="form-group">

				            	<label for="message-text" class="col-form-label">SKU: *</label>

				            	<input type="text" class="form-control" name="SKU" id="recipient-name" placeholder="Type SKU" required>

				          	</div>



				          	<div class="form-group">

				                <label class="col-form-label">Select Categories: *</label>

				                <select class="form-control" name="category_id" id="category" required>

				                	<option disabled value="">Select category</option>

									@foreach ($categories as $category)

							            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>

									@endforeach

								</select>

							</div>



				          	<div class="row">

				          		<div class="form-group col-lg-6 col-md-6 col-sm-6">

				          			<label for="message-text" class="col-form-label">Price: *</label>

				            		<input type="number" class="form-control" name="price" id="recipient-name" placeholder="Type Price" required>

				          		</div>



				          		<div class="form-group col-lg-6 col-md-6 col-sm-6">

				          			<label for="message-text" class="col-form-label">Special Price:</label>

				            		<input type="number" class="form-control" name="special_price" id="recipient-name" placeholder="Type New Price">

				          		</div>

				          	</div>



				          	<div class="form-group rowrd">

				                <label for="message-text" class="col-form-label">Description: *</label>

							    <textarea id="editor1" placeholder="Product Description" name="desc" rows="10" cols="80" required></textarea>

							</div>



							<div class="form-group">

				            	<label for="message-text" class="col-form-label">Additional Information: </label>

				            	<textarea id="editor2" placeholder="Product Additional Description" name="additional_info" rows="10" cols="80"></textarea>

				          	</div>



				          	<div class="file-upload">

								<button class="file-upload-btn" type="button" onclick="$('.file-upload-input2').trigger( 'click' )">Add Additional Image</button>



								<div class="image-upload-wrap2">

								    <input class="file-upload-input2" name="additional_image" type='file' onchange="readURL2(this);" accept="image/*" />

								    <div class="drag-text">

								      <h3>Drag and drop a file or select Add Additional Image</h3>

								    </div>

								</div>

								<div class="file-upload-content2">

								    <img class="file-upload-image2" src="#" alt="your image" />

								    <div class="image-title-wrap">

								      <button type="button" onclick="removeUpload2()" class="remove-image">Remove <span class="image-title2">Uploaded Image</span></button>

								    </div>

								</div>

							</div>

							<br>



							<div class="form-group">

				            	<label for="message-text" class="col-form-label">Meta Title:</label>

				            	<input type="text" class="form-control" name="meta_title" id="recipient-name" placeholder="Type Meta Title">

			          		</div>



				          	<div class="form-group">

				            	<label for="message-text" class="col-form-label">Meta Keyword:</label>

				            	<input type="text" class="form-control" name="meta_keyword" id="recipient-name" placeholder="Type Meta Keyword">

				          	</div>



				          	<div class="form-group">

				            	<label for="message-text" class="col-form-label">Meta Keyword:</label>

				            	<textarea name="meta_desc" class="form-control" rows="10" cols="10" placeholder="Type Meta Description"></textarea>

				          	</div>



				          	<div class="form-group">

				            	<label for="message-text" class="col-form-label">First Button Name:</label>

				            	<input type="text" class="form-control" name="fst_additional_btn" id="recipient-name" placeholder="Type Button Name">

			          		</div>



			          		<div class="form-group">

				            	<label for="message-text" class="col-form-label">First Button Content:</label>

				            	<input type="file" class="form-control" id="recipient-first-content" name="fst_btn_content"/>

			          		</div>



			          		<div class="form-group">

				            	<label for="message-text" class="col-form-label">Second Button Name:</label>

				            	<input type="text" class="form-control" name="snd_additional_btn" id="recipient-name" placeholder="Type Button Name">

			          		</div>



			          		<div class="form-group">

				            	<label for="message-text" class="col-form-label">Second Button Content:</label>

				            	<input type="file" class="form-control" id="recipient-first-content" name="snd_btn_content"/>

			          		</div>



			          		<div class="form-group">

				            	<label for="message-text" class="col-form-label">Third Button Name:</label>

				            	<input type="text" class="form-control" name="trd_additional_btn" id="recipient-name" placeholder="Type Button Name">

			          		</div>



			          		<div class="form-group" style="display: block; overflow: hidden; height: 100%;">

					            <div id="filediv">

					            	<input name="images[]" class="form-control" type="file" id="file" multiple=""/>

					            </div>

						    </div>

				    		<input type="button" id="add_more" class="btn btn-primary" value="Add More Files"/>

				    		<br>

				    		<br>

				    		

				          	<div class="form-check" style="margin-left: 15px;">

			                    <label class="form-check-label">

			                      	<input value="1" type="checkbox" name="status" class="form-check-input">

			                      	Want Publis It?

			                    </label>

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

		<!-- /create mode -->

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

	        $('#filediv').after($("<div/>",{id: 'filediv'}).fadeIn('slow').append($("<input/>",

	            {

	            	class: 'form-control',

	                name: 'images[]',

	                type: 'file',

	                id: 'file'

	            }),

	            $("<br/><br/>")

	    		));

	    });

	    $('.form-group').on('change', '#file', function (){

	        if (this.files && this.files[0]){

	            abc += 1; //increementing global variable by 1

	            var z = abc - 1;

	            var x = $(this)

	                .parent()

	                .find('#previewimg' + z).remove();

	            $(this).before("<div id='abcd" + abc + "' class='abcd' style='width:200px; height:200px;'><img style='width:150px;height:150px' id='previewimg" + abc + "' src=''/></div>");

	            var reader = new FileReader();

	            reader.onload = imageIsLoaded;

	            reader.readAsDataURL(this.files[0]);

	            $(this)

	                .hide();

	            $("#abcd" + abc).append($("<img/>",{

	            	style : 'width:150px; height:50px;',

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

	</script>

	<!-- Select2 -->

	<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

	<!-- DataTables -->

	<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>

	<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>



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