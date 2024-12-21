<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\page;
use Illuminate\Http\Request;

class PageController extends Controller
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
        $pages = page::all();
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
            'title' => 'required',
            'subtitle' => 'nullable',
            'slug' => 'required|unique:pages',
            'file'=>'nullable',
            'file.*' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg | max:20000',
            'controller_action' => 'nullable',
            'content' => 'required',
            'status' => 'nullable',
        ]);
        if($request->hasFile('file'))
        {
            $imageName = $request->file->getClientOriginalName();
            $imageName = $request->file->store('public');
        }
        else
        {
            $imageName = 'noimage.jpg';
        }

        $page =  new page();
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;
        $page->slug = $request->slug;
        $page->file = $imageName;
        $page->content = $request->content;
        $page->controller_action = $request->controller_action;
        $page->status = $request->status;
        $page->save();
        $notification = array(
            'message' => 'Page Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('page.index'))->with($notification);
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
        $page = page::where('id',$id)->first();
        return view('admin.page.edit',compact('page'));
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
            'title' => 'required',
            'subtitle' => 'nullable',
            'slug' => 'required',
            'file'=>'nullable',
            'file.*' => 'sometimes|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'controller_action' => 'nullable',
            'content' => 'required',
            'status' => 'nullable',
        ]);

        if($request->hasFile('file'))
        {
            $imageName = $request->file->getClientOriginalName();
            $imageName = $request->file->store('public');
        }
        else
        {
            $data = page::where('id',$id)->first();
            $imageName = $data->file;
        }

        $page = page::find($id);
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;
        $page->slug = $request->slug;
        $page->file = $imageName;
        $page->content = $request->content;
        $page->controller_action = $request->controller_action;
        $page->status = $request->status;
        $page->save();
        $notification = array(
            'message' => 'Page Updated Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('page.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        page::where('id',$id)->delete();
        $notification = array(
                'message' => 'Page destroy.', 
                'alert-type' => 'error',
            );
        return redirect()->back()->with($notification);
    }
}
