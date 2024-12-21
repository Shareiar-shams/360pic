<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\datetime;
use Illuminate\Http\Request;

class DateTimeController extends Controller
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
        $datetimes = datetime::all();
        return view('admin.datetime.index',compact('datetimes'));
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
        $this->validate($request,[
            'date' => 'required',
            'time' => 'required',
        ]);
        $date = str_replace('/', '-', $request->date);  
        $newDate = date("d-m-Y", strtotime($date)); 
        $time = date('h:i a', strtotime($request->time));
        $strdatetime = strtotime(date("d-m-Y h:i:s", strtotime($newDate.$time)));
        $datetime =  new datetime();
        $datetime->date = $newDate;
        $datetime->time = $time;
        $datetime->strdatetime = $strdatetime;
        $datetime->save();
        $notification = array(
            'message' => 'Date And Time Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('datetime-set.index'))->with($notification);
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
        $this->validate($request,[
            'date' => 'required',
            'time' => 'required',
        ]);
        $date = str_replace('/', '-', $request->date);  
        $newDate = date("d-m-Y", strtotime($date)); 
        $strdatetime = strtotime(date("d-m-Y H:i:s", strtotime($newDate.$request->time)));
        $time = date('h:i a', strtotime($request->time));
        $datetime =  datetime::find($id);
        $datetime->date = $newDate;
        $datetime->time = $time;
        $datetime->strdatetime = $strdatetime;
        $datetime->save();
        $notification = array(
            'message' => 'Date And Time Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('datetime-set.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        datetime::where('id',$id)->delete();
        $notification = array(
                'message' => 'Date And Time destroy.', 
                'alert-type' => 'error',
            );
        return redirect()->back()->with($notification);
    }
}
