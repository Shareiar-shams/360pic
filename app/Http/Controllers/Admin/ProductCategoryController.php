<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\category;
class ProductCategoryController extends Controller
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
        $categories = category::all();
        return view('admin.product.category.index',compact('categories'));
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
        $validatedData = $this->validate($request,[
            'name'      => 'required|min:3|max:255|string|unique:categories',
        ]);
        category::create($validatedData);       
        $notification = array(
                'message' => 'Category Added Successfully!', 
                'alert-type' => 'success',
            );
        return redirect(route('product-category.index'))->with($notification);
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
    public function update(Request $request, category $category,$id)
    {
        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string',
        ]);

        $category->where('id',$id)->update($validatedData);
        $notification = array(
                'message' => 'Category Updated Successfully!', 
                'alert-type' => 'success',
            );
        return redirect(route('product-category.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::find($id);
        

        // foreach ($category->products as $product) {
        //     // $product->update(['category_id' => NULL]);
        //     product::where('category_id',$id)->update(['category_id' => NULL]);
        // }

        $category->delete();

        $notification = array(
            'message' => 'Category Delete Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product-category.index'))->with($notification);
    }
}
