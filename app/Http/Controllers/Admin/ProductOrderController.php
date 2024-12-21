<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\order;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::where('order_status','!=','Default')->orderBy('id','DESC')->paginate(12);
        return view('admin.order.index',compact('orders'));
    }

    public function pending_order()
    {
        $orders = order::orderBy('id','DESC')->where('order_status', 'Pending')->get();
        return view('admin.order.pending_order',compact('orders'));
    }

    public function processing_order()
    {
        $orders = order::orderBy('id','DESC')->where('order_status', 'Processing_Order')->get();
        return view('admin.order.processing_order',compact('orders'));
        
    }

    public function delivery_in_progress()
    {
        $orders = order::orderBy('id','DESC')->where('order_status', 'Delivery_in_progress')->get();
        return view('admin.order.delivery_in_progress',compact('orders'));
    }

    public function canceled_order()
    {
        $orders = order::orderBy('id','DESC')->where('order_status', 'Canceled')->get();
        return view('admin.order.canceled_order',compact('orders'));
    }

    public function change_status(Request $request){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $order = order::find($request->id);

        $order->order_status = $request->status;
        $order->save(); 
        $notification = array(
            'message' => 'This product are transfer for processing!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function feedback(Request $request){
        $this->validate($request,[
            'short_answer' => 'required',
        ]);
        $order = order::find($request->id);

        $order->short_answer = $request->short_answer;
        $order->save(); 
        $notification = array(
            'message' => 'Send Text Successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = order::where('id',$id)->first();

        return view('admin.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        order::where('id',$id)->delete();
        $notification = array(
            'message' => 'Orders destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
