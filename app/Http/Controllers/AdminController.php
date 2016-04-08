<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;

class AdminController extends Controller
{
    //
	public function allProduct(){
		return view('back.products.product', array('products'=> DB::table('product')->get() ));
	}

    public function createProduct(){
    	return view('back.products.create');
    }

    public function saveProduct(Request $request){
    	$isCreated = DB::table('product')->insert(
    		array(
    			'category_id' => $request->input('category_id'),
    			'product_name' => $request->input('product_name'),
    			'product_sort_description' => $request->input('product_sort_description'),
    			'product_description' => $request->input('product_description'),
    			'price_RPP' => $request->input('price_RPP'),
    			'price_discount' => $request->input('price_discount'),
    			'download_file' => $request->input('download_file'),
    			'product_thumbnail' => $request->input('product_thumbnail'),
    			'product_images' => $request->input('product_images'),
    			'category_id' => $request->input('category_id'),
    			'created_at' => date('Y-m-d H:s:i')
    		)
    	);

    	if($isCreated){
    		Session::flash('msg','Created successful!');
    		return view('back.products.create',array('product' => DB::table('product')->where('id',$isCreated)->first()) );
    	}

    }
}
