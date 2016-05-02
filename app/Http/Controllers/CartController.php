<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Cart;
use Auth;

class CartController extends Controller
{
    //
   public function cart(Request $request) {
       if ($request->isMethod('post')) {
           $product_id = $request->input('product_id');
           $product = DB::table('product')->where('id',$product_id)->first();
           $price = (Auth::check()) ? $product->price_discount : $product->price_RPP;

           if($product){
           		Cart::add(array('id' => $product_id, 
                'thumbnail' => $product->product_thumbnail,
                'name' => $product->product_name, 
                'qty' => $request->input('qty'), 
                'price' => $price ));
           }
           
       }


       return redirect()->back();
   }


   public function getCart(){
   		$cart = Cart::content();
   		return view('front.cart', array('cart' => $cart)); 
   }

   public function delCart($pid){
   		Cart::remove($pid);
   		return back();
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

