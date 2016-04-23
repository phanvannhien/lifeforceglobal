<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Auth;
use App\User;
use App\Models\Orders;

class AdminController extends Controller
{
    //

    public function adminDashboard(){
        return view('back.dashboard');
    }

    public function adminLogin(){
        return view('back.login');
    }

    public function showPage($page = 'dashboard', $action = 'get',$id = null , $orderby = null, $search = null ){

        switch ($page) {
            case 'users':
                # code...
                if( $action == 'get' ){

                }
                break;
            
            default:
                # code...
                return view('back.dashboard');
                break;
        }

    }

    // Product
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

    // Users

    public function allUsers(Request $request){
        $users = DB::table('users');
        if ($request->isMethod('post')){
            $arrFilter = $request->input('filter');
            foreach ($arrFilter as $key => $value) {
                if( $value != '' ){
                    if( $key == 'registration_date' ){
                        $users->whereBetween($key, explode('-', $value));
                    }else{
                        $users->where($key,'like',$value.'%');
                    }
                    
                }
            }

            return view('back.users.dashboard')->with('users', $users->paginate(50));
           
        }

        return view('back.users.dashboard',array('users' => $users->paginate(50)) );
    }
    
    public function editUsers($id){

        return view('back.users.update')->with('user',User::find($id));
    }
    public function createUsers(){
        return view('back.users.update');
    }

    public function updateUsers(Request $request,$id){
        if ($request->isMethod('post')){
            $user = User::find($request->input('id'));
            if($user){
                $user->name = $request->input('name');
                $user->user_status = $request->input('user_status');
                $user->save();
                Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Update successful!') );
                return view('back.users.update')->with('user',$user);

            }
        }

    }

    public function deleteUsers(Request $request,$id){
        return;
    }

    /**
     * @return mixed
     */

    public function allOrders(Request $request){

        if ($request->isMethod('post')){
            $orders = Orders::where('id','<>','');
            $arrFilter = $request->input('filter');
            if (count($arrFilter) > 0){
                foreach ($arrFilter as $key => $value) {
                    if ($value != '') {
                        if ($key == 'created_at') {
                            $orders->whereBetween($key, explode('-', $value));
                        } elseif ($key == 'email') {
                            $user = User::where('email', $value)->first();
                            if ($user->count() > 0) {
                                $orders->where('user_id', $user->id);
                            }

                        } else {
                            $orders->where($key, $value);
                        }

                    }
                }
                $orders =  $orders->paginate(50);
            }else{

            }

        }else{
            $orders =  Orders::paginate(50);
        }

        return view('back.orders.dashboard')->with('orders',$orders);
    }

    /**
     * Get order by ID
     * @return orders
     */

    public function editOrders($id){

        return view('back.orders.edit')->with('order', Orders::find($id));
    }

    public function deleteOrders($id){
        //return view('back.orders.delete')->with('orders',Order::find($id));
    }
}
