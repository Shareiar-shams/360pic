<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use App\Models\Admin\page;
use App\Models\Admin\product;
use App\Models\User\contact;
use App\Models\User\order;
use Illuminate\Http\Request;
use PDF;
class ViewportController extends Controller
{
    public function index()
    {
        $page = page::where('slug','/')->first();
        $subtitle = explode('\n',$page->subtitle);
        $fstsub = $subtitle[0];
        $snssub = $subtitle[1];
        $categories = category::all();
        $total_item = product::where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
        $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
        return view('user.index', compact('page','fstsub','snssub','total_item','categories','all_page','company_page'));
    }

    public function single_product($slug){
        $items = product::where('slug',$slug)->with('category','images')->first();
        $categories = category::all();
        $additional_item = product::where('id', '!=', $items->id)->where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
        $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
        return view('user.single-product',compact('items','additional_item','categories','all_page','company_page'));
    }

    public function category_single_product($category,$id){
        $items = product::where('category_id',$id)->with('category','images')->first();
        $categories = category::all();
        $additional_item = product::where('id', '!=', $items->id)->where('status',1)->orderBy('created_at','DESC')->take(6)->get();
        $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
        $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
        return view('user.single-product',compact('items','additional_item','categories','all_page','company_page'));
    }

    public function file_download($id,$content)
    {
        $product_id = product::where('id',$id)->first();
        $content = $product_id->$content;
        $file = public_path('storage/'.$content);

        return response()->download($file);
    }

    public function invoice_download($id){
        $order = order::where('id',$id)->first();

        view()->share('order',$order);
        $pdf = PDF::loadView('user.invoicedownload',compact('order'));
        return $pdf->download('invoice.pdf');
    }

    public function contact_email(Request $request){

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required'
        ]);

        $contact = new contact();

        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $contact->save();
        \Mail::send('user.contact_mail',
            array(
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'user_message' => $request->get('message'),
            ), function($message) use ($request)
            {
                $message->from($request->email)->subject($request->subject);
                $message->to('nababmall@nababmall.com');
            }
        );
        return back()->with('message', 'Thank you for contact us!');
    }

}
