<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
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
        return view('admin.profile');
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
     * ImageUpdate the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageupdate(Request $request, $id)
    {
        $this->validate($request,[
            'image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }
        else
        {
            $data = admin::where('id',$id)->first();
            $imageName = $data->image;
        }

        $admin =  admin::find($id);
        $admin->image = $imageName;
        $admin->save(); 
        $notification = array(
            'message' => 'Picture Changed!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin-profile.index'))->with($notification);
    }

    /**
     * Admin Password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminpassword(Request $request, $id)
    {
        $this->validate($request,[
            'old_password' => 'required|string',
            'new_password' =>  ['required','string',Password::min( 8 )->mixedCase()->numbers()->symbols()->uncompromised(),'same:c_password','different:old_password'],
        ]);

        $admin =  admin::find($id);
        if (Hash::check($request->old_password, $admin->password)) { 
            $admin->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            $notification = array(
                'message' => 'Password Changed!', 
                'alert-type' => 'success',
            );
            return redirect(route('admin-profile.index'))->with($notification);
        } 
        else{
            $notification = array(
                'message' => 'Password does not match!', 
                'alert-type' => 'error',
            );
            return redirect(route('admin-profile.index'))->with($notification);
        }
        
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
            'name' => 'required|string|max:255',
            'position' => 'nullable',
            'phone' => 'required|min:11|max:14',
        ]);

        $admin =  admin::find($id);
        $admin->name = $request->name;
        $admin->position = $request->position;
        $admin->phone = $request->phone;
        $admin->save(); 
        $notification = array(
            'message' => 'Profile Updated Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin-profile.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
