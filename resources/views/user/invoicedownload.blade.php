<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>360pic - Order Invoice</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Invoice
                <strong>{{ Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</strong>
                <span class="float-right"> <strong>Status:</strong> {{$order->order_status}}</span>
            </div>
            <br>
            <br>
            <div class="card-body">
                <div class="row mb-4">

                	<div class="col-sm-6">
                        
                        <div>
                            <strong>Name: {{$order->first_name}} {{$order->last_name}}</strong>
                        </div>
                        <div>Address: {{$order->billing_area}} </div>
                        <div>Working Address:{{$order->work_area}},{{$order->addressline}},{{$order->city}},{{$order->postal_code}}</div>
                        <div>Email: {{$order->email}}</div>
                        <div>Phone: {{$order->phone}}</div>
                        <div>Track Id : {{$order->tracking_id}}</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>
                                <th class="right">Unit Cost</th>
                                <th class="center">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($order->orderproduct as $product)
                            <tr>
                                <td class="center">{{$loop->index + 1}}</td>
                                <td class="left strong">{{$product->product_name}}</td>
                                <td class="left">${{$product->product_price}}</td>
                                <td class="center">1</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right">${{$order->subtotal}}</td>
                                </tr>
                                {{-- @if($order->discount_amount != null)
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right">${{$order->discount_amount}}</td>
                                </tr>
                                @endif
                                @if($order->shipping_amount != null)
                                <tr>
                                    <td class="left">
                                        <strong>Shipping Rate</strong>
                                    </td>
                                    <td class="right">${{$order->shipping_amount}}</td>
                                </tr>
                                @endif --}}
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong>${{$order->total}}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>