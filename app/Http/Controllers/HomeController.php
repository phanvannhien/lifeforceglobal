<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Hash;
use App\User;
use App\Models\Products;
use Illuminate\Database\Schema\Blueprint;
use Schema;

class HomeController extends Controller
{
    //
    public function index(){
    	return view('front.index');
    }
    
    public function category($id){
    	$category = DB::table('categories')
        ->where('id',$id)
        ->where('category_status',1)
        ->first();
    	$products =  DB::table('product')
        ->where('category_id',$category->id)
        ->where('status',1)
        ->paginate(9);
    	return view('front.category',array('category' => $category, 'products' => $products));
    }

    public function product($id,$slug){
        
    	$product =  DB::table('product')
        ->where('status',1)
        ->where('id',$id)
        ->first();
    	return view('front.product',array('product' => $product));
    }

    public function productAll(){
        return view('front.products');
    }

    public function login(){
        return view('front.login');
    }

    public function setAdmin(){
       return true;
    }
    
    public function initializeSite(){

        Schema::drop('configuration');
        Schema::create('configuration', function (Blueprint $table) {
           $table->string('name',50);
           $table->text('value');
           $table->string('type');
           $table->string('label');
           $table->primary('name');
           
        });

        $arrReturn = array();
        $exitsAdminUser = DB::table('users')->where('email', 'info@lifeforceglobal.com.au')->count();
        
        if($exitsAdminUser > 0){
             $inserted = DB::table('users')
                 ->where('email', 'info@lifeforceglobal.com.au')
                 ->update([
                    'name' => 'Admin',
                    'password' =>  Hash::make('123456'),
                    'user_status' =>  1,
                    'admin' => 1
                ]);
        
        }else{
            
             $inserted = DB::table('users')
                 ->insert([
                    'name' => 'Admin',
                    'password' =>  Hash::make('123456'),
                    'email'=> 'info@lifeforceglobal.com.au',
                    'user_status' =>  1,
                    'admin' => 1
            
                ]);
        
        }
       
        if($inserted){
            array_push($arrReturn,'Set admin for info@lifeforce.com successful.');
         
        }
        
        DB::table('configuration')->truncate();
        
        $insertedConfig = DB::table('configuration')->insert(
        	array(
	        	array(
	        		'name' => 'bank',
	        		'value' => 'Bank info',
	        		'type' => 'textarea',
	        		'label' => 'Bank'
	        	),
	        	array(
	        		'name' => 'register_fee',
	        		'value' => '50',
	        		'type' => 'text',
	        		'label' => 'Register fee'
	        	)
	        )	
        );
        if($insertedConfig){
            array_push($arrReturn, 'Set configuration for info@lifeforce.com successful.');
        }


        
        
        dd($arrReturn);
        return true;
        
    }
   
}
