<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use App\Models\Admin\datetime;
use App\Models\Admin\page;
use App\Models\User\datetimepicker;
use App\Models\User\order;
use Auth;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) 
        {
            $datearray = array();
            $timearray = array();
            $addeddatetime = '';
            $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
            $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
            $categories = category::all();
            $datetimerange = datetime::orderBy('created_at','DESC')->get();
            
            foreach ($datetimerange as $key => $date) {
                if (!in_array($date->date,$datearray)){
                    // array_push($datearray,$date->date);
                    $datearray[] = $date->date;
                }
            }

            foreach ($datearray as $key => $datevalue) {
                $timerange = datetime::where('date',$datevalue)->get();
                $addeddatetime = datetimepicker::where('username','!=',null)->get();
                foreach ($timerange as $key => $time) {
                    if (!in_array($time,$timearray)){
                        $timearray[] = $time;
                    }
                }
            }
            return view('user.dateselector',compact('categories','datetimerange','datearray','timearray','all_page','company_page','addeddatetime'));
        }
        return redirect(route('login'));
    }

    public function datepicket(Request $request)
    {
        $datearray = array();
        $timearray = array();
        $categories = category::all();
        $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
        $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
        $date1 = Carbon::parse($request->date1)->format('d-m-Y');
        $date2 = Carbon::parse($request->date2)->format('d-m-Y');
        $diff = strtotime($date2) - strtotime($date1);
        $difference = abs(round($diff / 86400));
        $difference = intval($difference);
        if($difference > 7){
            return redirect()->back()->with('destroy_message', 'Pick the difference within seven days!');
        }
        else{
            $datetimerange = datetime::whereBetween('date', [$date1, $date2])->orderBy('created_at','DESC')->get();
            foreach ($datetimerange as $key => $date) {
                if (!in_array($date->date,$datearray)){
                    // array_push($datearray,$date->date);
                    $datearray[] = $date->date;
                }
            }

            foreach ($datearray as $key => $datevalue) {
                $timerange = datetime::where('date',$datevalue)->get();
                foreach ($timerange as $key => $time) {
                    if (!in_array($time,$timearray)){
                        $timearray[] = $time;
                    }
                }
            }
            return view('user.dateselector',compact('categories','datetimerange','datearray','timearray','all_page','company_page'));
        }
    }


    public function datepicket_add(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'time' => 'required',
            'datetime_id' => 'required',
        ]);

        $checkdate = datetimepicker::where('datetime_id', $request->datetime_id)->where('order_id', '!=', null)->first();
        if(!isset($checkdate))
        {
            $find_date = datetimepicker::where('username', Auth::user()->username)->first();
            if(empty($find_date) or !empty($find_date->order_id)){
                $datetime =  new datetimepicker();
                $datetime->username = Auth::user()->username;
                $datetime->date = $request->date;
                $datetime->time = $request->time;
                $datetime->datetime_id = $request->datetime_id;
                $datetime->save();
            }else{
                $datetime =  datetimepicker::find($find_date->id);
                $datetime->date = $request->date;
                $datetime->time = $request->time;
                $datetime->datetime_id = $request->datetime_id;
                $datetime->save();
            }

            return redirect(route('cartTocheckout'))->with('success_msg', 'Date And Time Select. Please Click on Proceed to pay Button.');
        }
        else{
            return redirect(route('cart.index'))->with('destroy_message', 'This Date And Time already selected! Pick Another One');
        }
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
        if(Auth::guest())
        {
            $cart = session()->get('cart');
            $session_id = Session::getId();
            // $user_id = Auth::user()->id;
            $this->validate($request,[
                'id' => 'required',
                'slug' => 'required',
                'price'=>'required',
                'quantity' => 'required|numeric|min:1',
                'name' => 'required',
                'image' => 'nullable',
                'SKU' => 'required',
                'category'=>'required',
            ]);
            $cart[] = $carts = array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->img,
                    'slug' => $request->slug,
                    'SKU' => $request->SKU,
                    'category'=>$request->category,
                )
            );

            \Cart::session($session_id)->add($carts);
            session()->put('cart', $cart);
        }else{

            $session_id = Session::getId();
    
            // $user_id = Auth::user()->id;
            $this->validate($request,[
                'id' => 'required',
                'slug' => 'required',
                'price'=>'required',
                'quantity' => 'required|numeric|min:1',
                'name' => 'required',
                'image' => 'nullable',
                'SKU' => 'required',
                'category'=>'required',
            ]);
            $cart = array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->img,
                    'slug' => $request->slug,
                    'SKU' => $request->SKU,
                    'category'=>$request->category,
                )
            );

            \Cart::session($session_id)->add($cart);
              
        }
        return redirect()->back()->with("message", "`".$request->name."` has been added to your cart");
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

    public function cartTocheckout()
    {
        if (Auth::check()) 
        {
            $session_id = Session::getId();
            $check_order = order::where('user_id', Auth::id())->where('order_status','Default')->orderBy('id', 'DESC')->first();
            if(isset($check_order)){
                $product = \Cart::session($session_id)->getContent();
                $categories = category::all();
                $datetime = datetimepicker::where('username',Auth::user()->username)->orderBy('created_at','DESC')->first();
                $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
                $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
                return view('user.payment_second',compact('product','categories','datetime','all_page','company_page'));
            }else{
                if(\Cart::session($session_id)->getTotalQuantity() > 0){
                    $product = \Cart::session($session_id)->getContent();
                    $categories = category::all();
                    $datetime = datetimepicker::where('username',Auth::user()->username)->orderBy('created_at','DESC')->first();
                    $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
                    $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
                    return view('user.payment',compact('product','categories','datetime','all_page','company_page'));
                }
                return redirect()->to('/');
            }
        }
        return redirect(route('login'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session_id = Session::getId();   
        \Cart::session($session_id)->remove($id);
        return redirect()->back()->with('destroy_message', 'Item has been removed from your card!');
    }
}
