@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Product</title>
@endsection
@section('admin_css_content')
	<style type="text/css" media="screen">
		.carousel-inner .item img{
			float: left;
			width:  520px;
			height: 305px;
			object-fit: cover;
		}
		.default_btn {
		  z-index: 1;
		  position: relative;
		  font-size: 18px;
		  font-weight: 600;
		  color: white;
		  padding: 0.5em 1em;
		  outline: none;
		  border: none;
		  background-color: #154158;
		  text-transform: capitalize;
		  border-radius: 0;
		  -webkit-border-radius: 0;
		  -moz-border-radius: 0;
		  transition: color 0.4s ease-in-out;
		  -webkit-transition: color 0.4s ease-in-out;
		  -moz-transition: color 0.4s ease-in-out;
		  -webkit-transform: skewX(-22deg) skewY(0deg);
		          transform: skewX(-22deg) skewY(0deg);
		}

		.default_btn::before {
		  content: '';
		  z-index: -1;
		  position: absolute;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  right: 0;
		  background-color: #14df79;
		  -webkit-transform-origin: center right;
		          transform-origin: center right;
		  -webkit-transform: scaleX(0);
		          transform: scaleX(0);
		  -webkit-transition: -webkit-transform 0.25s ease-in-out;
		  transition: -webkit-transform 0.25s ease-in-out;
		  transition: transform 0.25s ease-in-out;
		  transition: transform 0.25s ease-in-out, -webkit-transform 0.25s ease-in-out;
		}

		.default_btn:hover {
		  cursor: pointer;
		  color: #ffffff;
		}

		.default_btn:hover::before {
		  -webkit-transform-origin: center left;
		          transform-origin: center left;
		  -webkit-transform: scaleX(1);
		          transform: scaleX(1);
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
	<div class="row">
		<div class="container">
			<div class="col-lg-12" style="padding-right: 40px;">
				<div class="box box-widget">
					<div class="box-body">
						<img style="width: 100%; height: 250px; object-fit: cover;" src="{{Storage::disk('local')->url($product->display_image)}}" alt="Display Image">
					</div>
				</div>
			</div>
		</div>
		<div class="container">
	        
	        <div class="col-lg-12 col-md-12 col-sm-12" style="padding-right: 40px;">
	        	<div class="box box-widget">
	          		<div class="box-header">
			                <span class="username">{{$categories->name}}/{{$product->category->name}}</span>

			                <span class="description" style="float: right; padding-right: 30px;">{{$product->created_at->diffForHumans()}}</span>
			            <!-- /.user-block -->
			            <div class="box-tools">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			            </div>
		              	<!-- /.box-tools -->
		            </div>
		            <div class="box-body">
		            	<h3 style="font-family: Arial, Helvetica, sans-serif; color: darkslategray;">{{$product->name}}</h3>

		            	<hr style="border:none; border-top:0.5px dashed #f00; height:0.5px;">
		            	<div class="row">
		            		<div class="col-lg-6">
		            			<p style="color: dimgray;">{!!htmlspecialchars_decode($product->additional_info)!!}</p>
		            		</div>
		            		<div class="col-lg-6">
		            			<img style="float: left; width:  520px; height: 305px;object-fit: cover;" src="{{Storage::disk('local')->url($product->additional_image)}}" alt="Additional Image">
		            			<br>
		            			<br>
		            			<hr style="border:none; border-top:0.5px dashed #f00; height:0.5px;">

								<h4 style="font-family: Arial, Helvetica, sans-serif; color: darkslategray;">Additional Button</h4>

		            			<div class="row">
									<div class="col-lg-6">
										@if(isset($product->fst_additional_btn))
										    <a href="{{route('additional.file.download',['id'=>$product->id,'content'=>'fst_btn_content'])}}" class="btn default_btn"><span><i class="fas fa-external-link-alt"></i></span> <span>{{$product->fst_additional_btn}}</span></a>	
										@endif
									</div>
									<div class="col-lg-6">
										@if(isset($product->snd_additional_btn))
										    <a href="{{route('additional.file.download',['id'=>$product->id,'content'=>'snd_btn_content'])}}" class="btn default_btn"><span><i class="fas fa-external-link-alt"></i></span> <span>{{$product->snd_additional_btn}}</span></a>	
										@endif
									</div>
								</div>
								<br><br>
								<div class="row" style="">
									@if(isset($product->trd_additional_btn))

										<button type="button" class="btn default_btn" data-toggle="modal" data-target="#modal-default"><span><i class="fas fa-external-link-alt"></i></span><span>{{$product->trd_additional_btn}}</span>
										</button>

										{{-- <a href="#pop_up_gallery" class="btn default_btn" target="blank"><span><i class="fas fa-external-link-alt"></i></span> <span>{{$product->trd_additional_btn}}</span></a> --}}
									@endif
								</div>
		            		</div>
		            	</div>
		            	<h5 style="color: dimgray;"><b>SKU:</b> {{$product->SKU}}</h5>

		            	
		            	<h1 class="price"><span class="electro-price">
			            	@if(empty($product->special_price))
			            		<ins><span class="amount">&#x24;{{$product->price}}</span></ins>
			            	@else
			            		<ins><span class="amount">&#x24;   
                                    {{$product->special_price}}
                                </span></ins>
			            		<del><span class="amount">&#x24;{{$product->price}}</span></del>
			            	@endif
			            </span></h1>			            
	                    
		            </div>
	          	</div>
	        </div>
	    </div>
	    <div class="container">
		    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-right: 40px;">
	      		<!-- Custom Tabs -->
	      		<div class="nav-tabs-custom">
			        <ul class="nav nav-tabs">
			          	<li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
			          	<li><a href="#tab_2" data-toggle="tab">Reviews</a></li>
			        </ul>
			        <div class="tab-content">
				        <div class="tab-pane active" id="tab_1">

				            <div class="box box-widget">
				    			<div class="box-header">
						            <div class="box-tools">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						                </button>
						            </div>
					              	<!-- /.box-tools -->
					            </div>
				    			<div class="box-body">
				    				{!!htmlspecialchars_decode($product->desc)!!}
				    			</div>
				    		</div>
				        </div>
			          	<!-- /.tab-pane -->
			          	<div class="tab-pane" id="tab_2">
			          		{{-- @foreach($product->reviews as $review)
				                <!-- Post -->
				                <div class="post">
				                  	<div class="user-block">
				                  		@if($review->user->image != 'noimage.jpg')
				                    	<img class="img-circle img-bordered-sm" src="{{Storage::disk('local')->url($review->user->image)}}" alt="user image">
				                    	@endif
				                        <span class="username">
				                          <a href="#">{{$review->user->name}}</a>
				                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
				                        </span>
				                    	<span class="description">{{ Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
				                  	</div>
				                  	<!-- /.user-block -->
				                  	<p>
					                    {{$review->review}}
				                  	</p>
					                <ul class="list-inline">
					                	<li><a href="#" class="link-black text-sm"><span class="glyphicon glyphicon-star margin-r-5"></span>Rating
					                        ({{$review->rating}})</a></li>
					                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
					                </ul>
				                </div>
				                <!-- /.post -->
				            @endforeach --}}
			          	</div>
			        </div>
			        <!-- /.tab-content -->
		      	</div>
		      <!-- nav-tabs-custom -->
		    </div>
		</div>

		<div class="modal fade" id="modal-default">
		 	<div class="modal-dialog">
			    <div class="modal-content">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Additional Image</h4>
				    </div>
				    <div class="modal-body">
				    	@if(isset($product->trd_additional_btn))
					        <!-- Box Comment -->
				          	<div class="box box-widget" id="pop_up_gallery">
					        	<div class="box-header">
						            <!-- /.user-block -->
						            <div class="box-tools">
						                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						                </button>
						            </div>
					              	<!-- /.box-tools -->
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">
					              	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						                <ol class="carousel-indicators">
						        			@foreach($images as $index => $image)
									            <li data-target="#carousel-example-generic" @if($loop->first)data-slide-to="{{$loop->first}}" class='active' @else data-slide-to="{{$loop->index + 1}}" class='' @endif ></li>
							            	@endforeach
						                </ol>
						                <div class="carousel-inner">
							            	@foreach($images as $index => $image)
								                <div @if($loop->first) class="item active" @else class="item" @endif>
							                    	<img src="{{Storage::disk('local')->url($image->image_path)}}">
												</div>
						                	@endforeach
						                </div>
						                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						                  <span class="fa fa-angle-left"></span>
						                </a>
						                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						                  <span class="fa fa-angle-right"></span>
						                </a>
						            </div>
					            </div>
					            
				          	</div>
				          	<!-- /.box -->
				        @endif
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			    <!-- /.modal-content -->
		  	</div>
		  	<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	</div>
@endsection

@section('admin_js_content')
@endsection