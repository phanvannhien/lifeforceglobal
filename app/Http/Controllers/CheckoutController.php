<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use DB;

class CheckoutController extends Controller
{
    //

	public function __construct(){
		$exitsCart = Cart::count(); 

		if($exitsCart < 0){
			return redirect('/');
		}
	}

    public function checkout(){
    	return view('front.checkout');
    }

    public function checkoutFinal(Request $request){

    	if($request->input('add') == 'new_address'){
    		// Saving new address
    		$addedAddress = DB::table('customers_address')->insertGetId(
    			array(
    				'user_id' => Auth::user()->id,
    				'address' => $request->input('address'),
    				'created_at' => date('Y-m-d H:s:i')
    			)
    		);

    		//Saving order
    		$ordered = DB::table('orders')->insert(
    			array(
    				'user_id' => Auth::user()->id,
    				'total' => Cart::total(),
    				'status' => 'pending',
    				'updated_by' =>  Auth::user()->id,
    				'address_id' => $addedAddress,
    				'created_at' =>  date('Y-m-d H:s:i')
    			)
    		);

    		if( $ordered ){
    			Cart::destroy();
    			return view('front.checkout_success');
    		}
    	}

    }//end function


}//end class
