<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use DB;
use Auth;
use App\Models\CustomersAddress;
use App\Models\Orders;
use App\Models\Guest;
use App\User;
use Mail;
use Session;
use Site;

class CheckoutController extends Controller
{
    //

	public function __construct(){
		
	}

    public function checkout(){
        $exitsCart = Cart::count(); 
        if($exitsCart <= 0){
            return redirect('/');
        }
    	return view('front.checkout');
    }

    public function checkoutFinal(Request $request){

    	// Check if exits cart
    	$exitsCart = Cart::count(); 
    	if($exitsCart <= 0){
    		return redirect('/');
    	}

        if($request->input('add') == 'current_address'){
            if( $request->input('SelectAddress') == '' ){
                Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Please selected your shipping address!') );
                return back();
            }
        }
    	// Get cart
    	$cart = Cart::content();
    	$orderID = '';
    	$addedAddress = '';
    	$created_at = date('Y-m-d H:s:i');

    	if ($request->has('checkout_type') && $request->input('checkout_type') == 'guest_checkout'){
    		$orderID = 'GEST'.time();
    		// Save guest info
    		$guest = new Guest();
    		$guest->fullname = $request->input('fullname');
			$guest->email = $request->input('email');
			$guest->phone = $request->input('phone');
			$guest->country = $request->input('country');
			$guest->cityname = $request->input('city');
			$guest->suburb = $request->input('suburb');
			$guest->postalcode = $request->input('postalcode');
			$guest->address = $request->input('address');
			$guest->save();
            $addedAddress = $guest->getaddress();

    	}else{// checkout user
    		$orderID = 'MEM'.time();
    		if($request->input('add') == 'new_address'){
    			// Saving new address
    			$newAddress = new CustomersAddress;
    			$newAddress->user_id =  Auth::user()->id;
    			$newAddress->address =  $request->input('address');
    			$newAddress->country =  $request->input('country');
    			$newAddress->cityname =  $request->input('city');
    			$newAddress->suburb =  $request->input('suburb');
    			$newAddress->postalcode =  $request->input('postalcode');
    			$newAddress->created_at = $created_at;
    			$newAddress->save();
    			$addedAddress = $newAddress->getaddress();
    		}else{
    			$addedAddress = CustomersAddress::find((int)$request->input('SelectAddress'))->getaddress();
    		}
    		
    	}

    	// Save Order
    	$order = new Orders();
    	$order->id = $orderID;
    	$order->user_id = (Auth::check()) ? Auth::user()->id : $guest->id;
        $order->checkout_type = (Auth::check()) ? 'member' : 'guest';
    	$order->total = Cart::total();
    	$order->total_include_tax = number_format(Cart::total() + Cart::total()*Site::getConfig('gst_tax')/100,2);
    	$order->shipping_fee = Site::getConfig('shipping_fee');
		$order->gst_tax = Cart::total()*Site::getConfig('gst_tax')/100;
    	$order->status = 'pending';
    	$order->updated_by =  (Auth::check()) ? Auth::user()->id : $guest->id;
    	$order->address = $addedAddress;
    	if ( Auth::check() ){
    		User::find(Auth::user()->id)->orders()->save($order);
    	}else{
    		$guest->orders()->save($order);
    	}

		// saving detail
		if($order){

			foreach ($cart as $item) {
				# code...
				DB::table('orders_detail')->insert(
					array(
						'order_id' => $order->id ,
						'product_id' => $item->id,
						'qty' => $item->qty,
						'price' => $item->price,
						'subtotal' => $item->subtotal,
						'created_at' => $created_at
					)
				);
			}

			 try{
				// try
				$to = (Auth::check()) ? Auth::user()->email : $guest->email ;
				 Mail::send('emails.orders',
					 array('order' => $order)
					 ,function($message) use ( $order,$to ) {
						 $message->from( env('MAIL_USERNAME','Lifeforce') );
						 $message->to( $to )
							 ->cc(env('MAIL_USERNAME'))
							 ->subject(config('app.sitename').' - Thanks for order:#'.$order->id);
					 });
			 }
			 catch(Exception $e){
				// fail
			 }
			 Cart::destroy();
			 //Return checkout success page
			 return view('front.checkout_success',array('orderID' => $order->id ) );
		}
		//Return checkout fail page
		return view('front.checkout_fail');
    }//end function

}//end class
