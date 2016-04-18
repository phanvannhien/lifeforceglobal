<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Auth;

class AdminController extends Controller
{
    //

    public function __construct(){
        
        if (Auth::user()->role != 'admin'){

            return $this->adminLogin();
        }
    }

    public function adminDashboard(){

    }

    public function adminLogin(){
        return view('back.login');
    }

	public function allProduct(){
		return view('back.products.product', array('products'=> DB::table('product')->get() ));
	}

    public function createProduct(){
    	return view('back.products.create');
    }

    public function saveProduct(Request $request){

        $gallery = implode($request->input('product_images'), ',');


    	$id = DB::table('product')->insertGetId(
    		array(
    			'category_id' => $request->input('category_id'),
    			'product_name' => $request->input('product_name'),
    			'product_sort_description' => $request->input('product_sort_description'),
    			'product_description' => $request->input('product_description'),
    			'price_RPP' => $request->input('price_RPP'),
    			'price_discount' => $request->input('price_discount'),
    			'download_file' => $request->input('download_file'),
    			'product_thumbnail' => $request->input('product_thumbnail'),
    			'product_images' => $gallery ,
    			'category_id' => $request->input('category_id'),
    			'created_at' => date('Y-m-d H:s:i')
    		)
    	);

    	if($id){
    		Session::flash('message','Created successful!');
    		return redirect()->route('back.product.edit',$id);
    	}

    }

    public function editProduct($id){
        return view('back.products.edit',array('product' => DB::table('product')->where('id',$id)->first()) );
    }

    public function updateProduct(Request $request, $id){
        $gallery = implode($request->input('product_images'), ',');
        $id = $request->input('id');

        $updated = DB::table('product')
            ->where('id', $id )
            ->update(

                array(
                    'category_id' => $request->input('category_id'),
                    'product_name' => $request->input('product_name'),
                    'product_sort_description' => $request->input('product_sort_description'),
                    'product_description' => $request->input('product_description'),
                    'price_RPP' => $request->input('price_RPP'),
                    'price_discount' => $request->input('price_discount'),
                    'download_file' => $request->input('download_file'),
                    'product_thumbnail' => $request->input('product_thumbnail'),
                    'product_images' => $gallery,
                    'category_id' => $request->input('category_id'),
                    'created_at' => date('Y-m-d H:s:i')
                )
            );



        if($updated){
            Session::flash('message','Update successful!');
            return view('back.products.edit',array('product' => DB::table('product')->where('id',$id)->first()) );
        }
       
    }

    public function deleteProduct($id){
        DB::table('product')->where('id', $id)->delete();
        return $this->allProduct();
    }
    
}
