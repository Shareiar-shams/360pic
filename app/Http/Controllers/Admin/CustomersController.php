<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
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
        $customers = User::all();
        return view('admin.customer.show',compact('customers'));
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

    public function enable(Request $request){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $user = User::find($request->id);

        $user->status = $request->status;
        $user->save(); 
        $notification = array(
            'message' => 'Account Enable Successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function disable(Request $request){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $user = User::find($request->id);
        
        $user->status = $request->status;
        $user->save(); 
        $notification = array(
            'message' => 'Account Disable Successfully!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        User::where('id',$id)->delete();
        $notification = array(
            'message' => 'Customers destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
