<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class HomeController extends Controller
{
    //
    public function index(){
    	return view('front.index');
    }
    
    public function category($id){
    	$category = DB::table('categories')->where('id',$id)->first();
    	$products =  DB::table('product')->where('category_id',$category->id)->paginate(9);
    	return view('front.category',array('category' => $category, 'products' => $products));
    }

    public function product($id,$slug){
        
    	$product =  DB::table('product')->where('id',$id)->first();
    	return view('front.product',array('product' => $product));
    }

    public function login(){
        return view('front.login');
    }
}
