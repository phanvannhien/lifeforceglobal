<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use DB;
use Auth;
use App\Models\CustomersAddress;
use App\Models\Orders;
use Mail;

class CheckoutController extends Controller
{
    //

	public function __construct(){
		
	}

    public function checkout(){
    	return view('front.checkout');
    }

    public function checkoutFinal(Request $request){
    	$exitsCart = Cart::count(); 

    	if($exitsCart <= 0){
    		return redirect('/');
    	}

    	$cart = Cart::content();
    	$created_at = date('Y-m-d H:s:i');

    	if($request->input('add') == 'new_address'){
    		// Saving new address
    		$newAddress = new CustomersAddress;
    		$newAddress->user_id =  Auth::user()->id;
    		$newAddress->address =  $request->input('address');
    		$newAddress->created_at = $created_at;
    		$newAddress->save();

    		$addedAddress = $newAddress->address;
    	}else{
    		$addedAddress = $request->input('SelectAddress');
    	}

    	//Saving order
		$orderedID = DB::table('orders')->insertGetId(
			array(
				'user_id' => Auth::user()->id,
				'total' => Cart::total(),
				'status' => 'pending',
				'updated_by' =>  Auth::user()->id,
				'address' => $addedAddress,
				'created_at' =>  $created_at
			)
		);

		// saving detail
		if($orderedID){
			

			foreach ($cart as $item) {
				# code...
				DB::table('orders_detail')->insert(
					array(
						'order_id' => $orderedID ,
						'product_id' => $item->id,
						'qty' => $item->qty,
						'price' => $item->price,
						'subtotal' => $item->subtotal,
						'created_at' => $created_at
					)
				);
			}
			
			 $ordersMail = Orders::find($orderedID);
			 try{
				// try
				 Mail::send('emails.orders',
					 array('order' => $ordersMail)
					 ,function($message) use ($ordersMail) {
						 $message->from( env('MAIL_USERNAME','Lifeforce') );
						 $message->to( Auth::user()->email )
							 ->cc(env('MAIL_USERNAME'))
							 ->subject(config('app.sitename').' - Thanks for order:#'.$ordersMail->id);
					 });
			 }
			 catch(Exception $e){
				// fail
			 }

			 Cart::destroy();
			 return view('front.checkout_success',array('orderID' => $orderedID ) );

		}
		return view('front.checkout_fail');
	

    }//end function




}//end class
