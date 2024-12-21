<?php

namespace App\Http\Controllers;

use App\Models\Admin\product;
use App\Models\User;
use App\Models\User\order;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = order::where('order_status','!=','Default')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate(12);;
        return view('user.dashboard.home',compact('orders'));
    }

    public function ordershow($id)
    {
        $orders = order::where('user_id',Auth::user()->id)->orWhere('id',$id)->first();
        foreach($orders->orderproduct as $product){
            $products[] = product::where('id',$product->product_id)->first();
        }

        return view('user.dashboard.ordershow',compact('orders','products'));
    }

    public function user_profile($username)
    {
        return view('user.dashboard.profile');
    }

    public function infoupdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $User =  User::find($id);
        $User->name = $request->name;
        $User->date_of_birth = $request->date_of_birth;
        $User->address = $request->address;
        $User->gender = $request->gender;
        $User->save(); 
        $notification = array(
            'message' => 'Information Changed!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function passwordupdate(Request $request, $id)
    {
        $this->validate($request,[
            'old_password' => 'required|string',
            'new_password' =>  ['required','string',Password::min( 8 )->mixedCase()->numbers()->symbols()->uncompromised(),'same:c_password','different:old_password'],
        ]);

        $admin =  User::find($id);
        if (Hash::check($request->old_password, $admin->password)) { 
            $admin->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $notification = array(
                'message' => 'Password Changed!', 
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        } 
        else{
            $notification = array(
                'message' => 'Password does not match!', 
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    } 

    public function cancelorder(Request $request)
    {
        $this->validate($request,[
            'status' => 'required|string',
        ]);

        $order =  order::find($request->id);
        $order->order_status = $request->status;
        $order->save();
        $notification = array(
            'message' => 'Order Cancel!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
