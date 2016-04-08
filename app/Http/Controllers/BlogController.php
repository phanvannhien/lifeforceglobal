<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    //
    public function aboutUs(){
    	return view('front.about_us');
    }

    public function contactUs(){
    	return view('front.contact_us');
    }
}
