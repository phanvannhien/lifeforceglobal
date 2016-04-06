<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Cart;

class CartController extends Controller
{
    //
   public function cart(Request $request) {
       if ($request->isMethod('post')) {
           $product_id = $request->input('product_id');
           $product = DB::table('product')->where('id',$product_id)->first();
           if($product){
           		Cart::add(array('id' => $product_id, 'name' => $product->product_name, 'qty' => $request->input('qty'), 'price' => $product->price_RPP));
           }
           
       }


       return redirect()->route('front.cart.page');
   }


   public function getCart(){
   		$cart = Cart::content();
   		return view('front.cart', array('cart' => $cart)); 
   }

   public function delCart($pid){
   		Cart::remove($pid);
   		return redirect()->route('front.cart.page');
   }

   public function destroyCart($pid){
   		Cart::destroy();
   		return redirect()->route('front.cart.page');
   }

   public function updateCart(Request $request){
   		
   		foreach ($request->input('qty') as $key => $value) {
   			# code...
   			Cart::update($key, $value);
   		}
   		return redirect()->route('front.cart.page');

   }

}

