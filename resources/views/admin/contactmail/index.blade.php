@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')

	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('admin_content_header')
		<h1>
		  	Mailbox
		</h1>
		<ol class="breadcrumb">
		    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">Mailbox</li>
		</ol>
@endsection

@section('admin_main_content')
	<div class="row">
        <div class="col-md-3">
          	{{-- <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a> --}}

	        <div class="box box-solid">
	            <div class="box-header with-border">
		            <h3 class="box-title">Folders</h3>

		            <div class="box-tools"> 
		            	<button type="button" class="btn btn-box-tool" data-widget="collapse">
		            		<i class="fa fa-minus"></i> 
		            	</button> 
		        	</div> 
		        </div> 
		        <div class="box-body no-padding"> 
		        	<ul class="nav nav-pills nav-stacked"> 
		        		<li class="active"><a href="{{route('user-mail.index')}}">
		        			<i class="fa fa-inbox"></i>Inbox </a>
		        		</li> 
		        		<li><a href="#">
		        			<i class="fa fa-envelope-o"></i> Sent</a>
		        		</li> 
		        		<li><a href="#">
		        			<i class="fa fa-file-text-o"></i> Drafts</a>
		        		</li> 
		        		<li><a href="#">
		        			<i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
		            	</li> 
		            	<li><a href="#">
		            		<i class="fa fa-trash-o"></i>Trash</a>
		            	</li> 
		            </ul> 
		        </div>
	            <!-- /.box-body -->
	        </div>
          	<!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          	<div class="box box-primary">
	            <div class="box-header with-border">
	              	<h3 class="box-title">Inbox</h3>

	              	<div class="box-tools pull-right">
		                <div class="has-feedback">
		                  	<input type="text" class="form-control input-sm" placeholder="Search Mail">
		                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
		                </div>
	              	</div>
	              	<!-- /.box-tools -->
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body no-padding">
	              <div class="mailbox-controls">
	                <!-- Check all button -->
	                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
	                </button>
	                <div class="btn-group">
	                  <button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('myproductsDeleteAll') }}"><i class="fa fa-trash-o"></i></button>
	                </div>
	                <!-- /.btn-group -->
	                <button type="clear" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
	                <div class="pull-right">
	                  	{!! $contacts->appends(['sort' => 'id'])->links() !!}
	                  <!-- /.btn-group -->
	                </div>
	                <!-- /.pull-right -->
	              </div>
	              	<div class="table-responsive mailbox-messages">
		                <table class="table table-hover table-striped">
		                  	<tbody>
		                  			@foreach($contacts as $contact)
					                <tr>
					                    <td><input type="checkbox" class="sub_chk" data-id="{{$contact->id}}"></td>
					                    <td class="mailbox-name"><a href="{{route('user-mail.show',$contact->id)}}">{{$contact->first_name}} {{$contact->last_name}}</a></td>
					                    <td class="mailbox-subject"><b>{!! Str::limit($contact->message, 50) !!}
					                    </td>
					                    <td class="mailbox-date">{{$contact->created_at->diffForHumans()}}</td>
					                    <td>
				                            <form action="{{route('user-mail.destroy',$contact->id)}}" method="post" id="delete-form-{{$contact->id}}" style="display: none;">
				                              {{csrf_field()}}
				                              {{method_field('DELETE')}}
				                            </form>
				                            <a href="" style=" font-size: 18px;" onclick="
				                            if(confirm('Are you Want to Uproot this!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('delete-form-{{$contact->id}}').submit();
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
	                	<!-- /.table -->
	              	</div>
	              	<!-- /.mail-box-messages -->
	            </div>
	            <!-- /.box-body -->
          	</div>
          	<!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('admin_js_content')
	{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script> --}}


	<script>
	  	$(function () {
		    //Enable iCheck plugin for checkboxes
		    //iCheck for checkbox and radio inputs
		    $('.mailbox-messages input[type="checkbox"]').iCheck({
		      checkboxClass: 'icheckbox_flat-blue',
		      radioClass: 'iradio_flat-blue'
		    });

		    //Enable check and uncheck all functionality
		    $(".checkbox-toggle").click(function () {
		      var clicks = $(this).data('clicks');
		      if (clicks) {
		        //Uncheck all checkboxes
		        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
		        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
		      } else {
		        //Check all checkboxes
		        $(".mailbox-messages input[type='checkbox']").iCheck("check");
		        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
		      }
		      $(this).data("clicks", !clicks);
		    });
		});
	</script>


@endsection