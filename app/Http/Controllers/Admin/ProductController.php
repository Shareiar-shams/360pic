<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use App\Models\Admin\product;
use App\Models\Admin\product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PDF;
class ProductController extends Controller
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
        $items = product::all();
        $categories = category::all();
        return view('admin.product.item.index',compact('items','categories'));
    }

    public function img_dlt(Request $request)
    {
         
        $id = $request->id;
         
        $image = product_image::where('id',$id)->delete();
    }


    public function file_download($id,$content)
    {
        $product_id = product::where('id',$id)->first();
        $content = $product_id->$content;
        // $file = Storage::disk('local')->url($content);
        $file = public_path('storage/'.$content);


        return response()->download($file);
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
            'name' => 'required|min:3|unique:products',
            'slug' => 'required|min:3|max:255|unique:products',
            'SKU' => 'required|min:3|max:255|unique:products',
            'additional_info' => 'nullable',
            'desc' => 'required',
            'images'=>'nullable',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:4096',
            'display_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'additional_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'price' => 'required|integer',
            'special_price' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'category_id'   => 'required|numeric',
            'meta_title' => 'nullable',
            'meta_keyword' => 'nullable',
            'meta_desc' => 'nullable',
            'fst_additional_btn' => 'nullable|max:50',
            'fst_btn_content' => 'nullable|mimes:pdf,zip,doc,ppt,xlsx,docx',
            'snd_additional_btn' => 'nullable|max:50',
            'snd_btn_content' => 'nullable|mimes:pdf,zip,doc,ppt,xlsx,docx',
            'trd_additional_btn' => 'nullable|max:50',
        ]);

        if($request->hasFile('display_image'))
        {
            $imageName = $request->display_image->getClientOriginalName();
            $imageName = $request->display_image->store('public');
        }
        else
        {
            $imageName = 'noimage.jpg';
        }

        if($request->hasFile('additional_image'))
        {
            $additional_image = $request->additional_image->getClientOriginalName();
            $additional_image = $request->additional_image->store('public');
        }
        else
        {
            $additional_image = null;
        }

        if($request->hasFile('fst_btn_content'))
        {
            $filenameWithExt = $request->file('fst_btn_content')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('fst_btn_content')->getClientOriginalExtension();

            $fileNameToStore = $filename.'-'.time().'.'.$extension;

            $path = $request->file('fst_btn_content')->storeAs('public',$fileNameToStore);

            // $first_content = $request->file('fst_btn_content')->getClientOriginalName();
            // $first_content = $request->file('fst_btn_content')->store('public');
        }
        else
        {
            $fileNameToStore = null;
        }

        if($request->hasFile('snd_btn_content'))
        {
            $filenameWithExt2 = $request->file('snd_btn_content')->getClientOriginalName();

            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);

            $extension2 = $request->file('snd_btn_content')->getClientOriginalExtension();

            $second_content = $filename2.'-'.time().'.'.$extension2;

            $path2 = $request->file('snd_btn_content')->storeAs('public',$second_content);

            // $second_content = $request->file('snd_btn_content')->getClientOriginalName();
            // $second_content = $request->file('snd_btn_content')->store('public');
        }
        else
        {
            $second_content = null;
        }


        $item = new product();
        $item->name = $request->name;
        $item->additional_info = $request->additional_info;
        $item->desc = $request->desc;
        $item->slug = $request->slug;
        $item->SKU = $request->SKU;
        $item->display_image = $imageName;
        $item->additional_image = $additional_image;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->status = $request->status;
        $item->category_id = $request->category_id;
        $item->meta_title = $request->meta_title;
        $item->meta_keyword = $request->meta_keyword;
        $item->meta_desc = $request->meta_desc;
        $item->fst_additional_btn = $request->fst_additional_btn;
        $item->fst_btn_content = $fileNameToStore;
        $item->snd_additional_btn = $request->snd_additional_btn;
        $item->snd_btn_content = $second_content;
        $item->trd_additional_btn = $request->trd_additional_btn;
        $item->save(); 
        if($request->file('images'))
        {
            foreach ($request->file('images') as $image) {
                $productImage = new product_image;
                $name = $image->getClientOriginalName();
                $imageName = $image->store('public');
                // $path = 'images/product/'.$item->slug.'/'.$imagename;
                // $image->move($path);
                $productImage->product_id = $item->id;
                $productImage->image_path = $imageName;
                $productImage->save();
            }
        }
        $notification = array(
            'message' => 'Item Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.index'))->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::with('category')->where('id',$id)->first();
        $images = product_image::where('product_id',$product->id)->get();
        $categories = category::where('id',$product->category->id)->first();
        return view('admin.product.item.show',compact('product','images','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = category::all();
        $product = product::where('id',$id)->first();
        $images = product_image::where('product_id',$product->id)->get();
        return view('admin.product.item.edit',compact('product','categories','images'));
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
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            'SKU' => 'required|min:3|max:255',
            'additional_info' => 'nullable',
            'desc' => 'required',
            'images'=>'nullable',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:4096',
            'display_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'additional_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'price' => 'required|integer',
            'special_price' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'category_id'   => 'required|numeric',
            'meta_title' => 'nullable',
            'meta_keyword' => 'nullable',
            'meta_desc' => 'nullable',
            'fst_additional_btn' => 'nullable|max:50',
            'fst_btn_content' => 'nullable|mimes:pdf,zip,doc,ppt,xlsx,docx',
            'snd_additional_btn' => 'nullable|max:50',
            'snd_btn_content' => 'nullable|mimes:pdf,zip,doc,ppt,xlsx,docx',
            'trd_additional_btn' => 'nullable|max:50',
        ]);

        if($request->hasFile('display_image'))
        {
            $imageName = $request->display_image->getClientOriginalName();
            $imageName = $request->display_image->store('public');
        }
        else
        {
            $data = product::where('id',$id)->first();
            $imageName = $data->display_image;
        }

        if($request->hasFile('additional_image'))
        {
            $additional_image = $request->additional_image->getClientOriginalName();
            $additional_image = $request->additional_image->store('public');
        }
        else
        {
            $data = product::where('id',$id)->first();
            $additional_image = $data->additional_image;
        }

        if($request->hasFile('fst_btn_content'))
        {
            $filenameWithExt = $request->file('fst_btn_content')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('fst_btn_content')->getClientOriginalExtension();

            $fileNameToStore = $filename.'-'.time().'.'.$extension;

            $path = $request->file('fst_btn_content')->storeAs('public',$fileNameToStore);

            // $first_content = $request->file('fst_btn_content')->getClientOriginalName();
            // $first_content = $request->file('fst_btn_content')->store('public');
        }
        else
        {
            $data = product::where('id',$id)->first();
            $fileNameToStore = $data->fst_btn_content;
        }

        if($request->hasFile('snd_btn_content'))
        {
            $filenameWithExt2 = $request->file('snd_btn_content')->getClientOriginalName();

            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);

            $extension2 = $request->file('snd_btn_content')->getClientOriginalExtension();

            $second_content = $filename2.'-'.time().'.'.$extension2;

            $path2 = $request->file('snd_btn_content')->storeAs('public',$second_content);

            // $second_content = $request->file('snd_btn_content')->getClientOriginalName();
            // $second_content = $request->file('snd_btn_content')->store('public');
        }
        else
        {
            $data = product::where('id',$id)->first();
            $second_content = $data->snd_btn_content;
        }

        $item = product::find($id);
        $item->name = $request->name;
        $item->additional_info = $request->additional_info;
        $item->desc = $request->desc;
        $item->slug = $request->slug;
        $item->SKU = $request->SKU;
        $item->display_image = $imageName;
        $item->additional_image = $additional_image;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->status = $request->status;
        $item->category_id = $request->category_id;
        $item->meta_title = $request->meta_title;
        $item->meta_keyword = $request->meta_keyword;
        $item->meta_desc = $request->meta_desc;
        $item->fst_additional_btn = $request->fst_additional_btn;
        $item->fst_btn_content = $fileNameToStore;
        $item->snd_additional_btn = $request->snd_additional_btn;
        $item->snd_btn_content = $second_content;
        $item->trd_additional_btn = $request->trd_additional_btn;
        $item->save(); 
        if($request->file('images'))
        {
            foreach ($request->file('images') as $image) {
                $productImage = new product_image;
                $name = $image->getClientOriginalName();
                $imageName = $image->store('public');
                // $path = 'images/product/'.$item->slug.'/'.$imagename;
                // $image->move($path);
                $productImage->product_id = $item->id;
                $productImage->image_path = $imageName;
                $productImage->save();
            }
        }
        $notification = array(
            'message' => 'Product Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::where('id',$id)->delete();
        product_image::where('product_id',$id)->delete();
        $notification = array(
                'message' => 'Product destroy.', 
                'alert-type' => 'error',
            );
        return redirect()->back()->with($notification);
    }
}
