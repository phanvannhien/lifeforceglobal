<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CheckoutController extends Controller
{
    //
    public function checkout(){
    	return view('front.checkout');
    }
}
