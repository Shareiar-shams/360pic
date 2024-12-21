<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use App\Models\Admin\page;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(){
        $page = page::where('controller_action', 'like', '%PrivacyController%')->first();
        $categories = category::all();
        $all_page = page::where('controller_action','=','default')->orderBy('id','ASC')->take(4)->get();
        $company_page = page::where('controller_action','!=','default')->where('controller_action','!=','ViewportController')->orderBy('id','ASC')->take(4)->get();
        return view('user.privacy_policy',compact('page','categories','all_page','company_page'));
    }
}
