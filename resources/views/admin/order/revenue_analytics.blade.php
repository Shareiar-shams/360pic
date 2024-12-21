@extends('admin.layout')
@section('admin_title_content')
    <title>Nababmall | Dashboard</title>
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<h1>
  		Order
	</h1>
	<ol class="breadcrumb">
	    <li><a href="{{route('admin.panel')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Revenue Analytic</li>
	</ol>
@endsection

@section('admin_main_content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box box-info">
	            <div class="box-header with-border">
	              	<h3 class="box-title">Analytic</h3>

	              	<div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              	</div>
	            </div>

	            <!-- /.box-header -->
	            <div class="box-body">
	            	<div class="table-responsive">
						<table id="example" class="display table nowrap no-margin" style="width:100%; height: 100%;">
					        <thead>
					            <tr>
					                <th>Date</th>
					                <th>Total Revenue</th>
					                <th>Subtotal Revenue</th>
					                <th>Total Order</th>
					                <th>Pending Order</th>
					                <th>Processing Order</th>
					                <th>Shipped Order</th>
					                <th>Delivered Order</th>
					                <th>Canceled Order</th>
					                <th>Returend Order</th>
					            </tr>
					        </thead>

					        <tbody>
					        	@foreach($orders as $order)
						            <tr>
						                <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
						                <td>{{$order->total_revenue}}</td>
						                <td>{{$order->subtotal_revenue}}</td>
						                <td>{{$order->total_order}}</td>
						                <td>{{$order->pending_order}}</td>
						                <td>{{$order->processing_order}}</td>
						                <td>{{$order->shipped_order}}</td>
						                <td>{{$order->delivered_order}}</td>
						                <td>{{$order->canceled_order}}</td>
						                <td>{{$order->returned_order}}</td>
						            </tr>
					            @endforeach
					        </tbody>
					    </table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('admin_js_content')
	<script type="text/javascript">

		$(document).ready(function() {
		    $('#example').DataTable( {
		        "scrollY": 200,
		        "scrollX": true
		    } );
		} );
	</script>
@endsection
