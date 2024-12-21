@extends('admin.layout')
@section('admin_title_content')
    <title>360pic | Dashboard</title>
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
		<h1>
		  	Read Mail
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
		        		<li class="active"><a href="{{route('contact-mail.index')}}">
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
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
              	<h5>Name: {{$contact->first_name}} {{$contact->last_name}}</h5>
              	@if($contact->phone != null)
              	<h5>Phone: {{$contact->phone}}</h5>
              	@endif
                <h3>Subject: {{$contact->subject}}</h3>
                <h5>From: {{$contact->email}}
                  <span class="mailbox-read-time pull-right">{{ Carbon\Carbon::parse($contact->created_at)->format('d M Y h:m:s a') }}</span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-read-message">
                <p>{{$contact->message}}</p>

                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('admin_js_content')


@endsection