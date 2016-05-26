<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Auth;
use App\User;
use Mail;
use App\Models\Orders;
use App\Models\Categories;
use App\Models\Configurations;
use Validator;

class AdminController extends Controller
{
    //

    

    public function adminDashboard(){
        return view('back.dashboard');
    }

    public function adminLogin(){
        return view('back.login');
    }

    public function adminLoginPost(Request $request){
        // Authentication data
         $authData = array(
            'email' =>  $request->input( 'email' ), 
            'password' => $request->input( 'password' ), 
        );

        $userLogin = DB::table('users')->where( 'email', $request->input('email') )->first();
        
        if( $userLogin ){
            if($userLogin->user_status == 0){
                Session::flash('message', 'Account is locked!');
                return back()->withInput();
            }

            if (Auth::attempt($authData))
            {
                return redirect()->route('back.admin.dashboard');
                
            }
        }
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

    // Categories

    public function categories(){
        return view('back.categories.view',array('categories' => Categories::paginate(50)) );
    }

    public function categoriesCreate(){
        return view('back.categories.create');
    }

    public function categoriesSave(Request $request){
        $rule = array(
            'category_name' => 'required',
        );

        $v = Validator::make($request->all(),$rule);
        if ($v->fails())
        {
            return view('back.categories.create')->withErrors($v);
        }

        $category = new Categories;
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->category_status = $request->input('category_status');
        $category->category_image = $request->input('category_image');
        $category->category_color = $request->input('category_color');
        $category->image_position = $request->input('image_position');
        $category->save();


        return redirect()->route('back.categories.edit', $category->id);

    }

    public function categoriesEdit($id){
        return view('back.categories.edit',array( 'category' => Categories::find($id)) );
    }

    public function categoriesUpdate(Request $request,$id){
        $rule = array(
            'category_name' => 'required',
        );

        $v = Validator::make($request->all(),$rule);
        if ($v->fails())
        {
            return back()->withErrors($v);
        }

        $category = Categories::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->category_status = $request->input('category_status');
        $category->category_image = $request->input('category_image');
        $category->category_color = $request->input('category_color');
        $category->image_position = $request->input('image_position');
        $category->save();

        Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Updated successful!') );
        return view('back.categories.edit',array( 'category' => $category));

    }

    // Product
	public function allProduct(){
		return view('back.products.product', array('products'=> DB::table('product')->get() ));
	}

    public function createProduct(){
    	return view('back.products.create');
    }

    public function saveProduct(Request $request){

        $gallery = implode(array_filter($request->input('product_images')), ',');

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
        $gallery = implode( array_filter($request->input('product_images')), ',');


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
                        $arrDate =  explode('-', $value);
                        $startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
                        $endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));
                        $users->whereBetween( $key,array($startDate,$endDate) );
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

    public function activeUsers($id){
        $user = User::find($id);
        $user->user_status = 1;
        $user->save();     
      
        try {
            Mail::send('emails.user_verified',
                 array('user' => $user)
                 ,function($message) use ($user) {
                     $message->from( env('MAIL_USERNAME','Lifeforce') );
                     $message->to( $user->email )
                         //->cc()
                         ->subject(config('app.sitename').' - Account actived');
                 });

        } catch (Exception $e) {
            
        }        
        Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'User: '.$user->email.' actived!') );
        return view('back.users.dashboard')->with('users', User::paginate(50));

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
                            $arrDate =  explode('-', $value);
                            $startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
                            $endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));
                            $orders->whereBetween($key, array($startDate,$endDate));
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

    public function changeStatusOrders(Request $request){
        $status = $request->input('status');
        $orders = Orders::find($request->input('id'));

        switch ($status) {
            case 'processing':
                # code...
                $orders->status = 'processing';
                // try
                try {
                    Mail::send('emails.order_processing',
                         array('order' => $orders)
                         ,function($message) use ($orders) {
                             $message->from( env('MAIL_USERNAME','Lifeforce') );
                             $message->to( $orders->user->email )
                                 //->cc()
                                 ->subject(config('app.sitename').' - Your orders :#'.$orders->id.' are processing');
                         });

                } catch (Exception $e) {
                    
                }
                $orders->save();
                break;

            case 'done':
                $orders->status = 'done';
                // try
                try {
                    Mail::send('emails.order_processing',
                         array('order' => $orders)
                         ,function($message) use ($orders) {
                             $message->from( env('MAIL_USERNAME','Lifeforce') );
                             $message->to( $orders->user->email )
                                 //->cc()
                                 ->subject(config('app.sitename').' - Thanks for your orders :#'.$orders->id.' are done');
                         });

                } catch (Exception $e) {
                    
                }
                $orders->save();
                break;    

            case 'cancel':
                $orders->status = 'cancel';
                // try
                try {
                    Mail::send('emails.order_processing',
                         array('order' => $orders)
                         ,function($message) use ($orders) {
                             $message->from( env('MAIL_USERNAME','Lifeforce') );
                             $message->to( $orders->user->email )
                                 //->cc()
                                 ->subject(config('app.sitename').' - Thanks for your orders :#'.$orders->id.' are done');
                         });

                } catch (Exception $e) {
                    
                }
                $orders->save();
                break;    
            
            default:
                # code...
                break;
        }//end switch

        Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Orders status updated to: '. $status) );
        return view('back.orders.edit')->with('order',$orders);

    }

    public function configuration(){
        return view('back.configuration',array('configuration' => DB::table('configuration')->get()) );
    }
    public function configurationSave(Request $request){
        $arrConfigs = $request->input('config');
        
        foreach ($arrConfigs as $key => $value) {
            # code...
            $config = Configurations::where('name',$key)->update(
                array( 'value' => $value)
            );
         
        }
        
        Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Update successful!') );
        return view('back.configuration',array('configuration' => DB::table('configuration')->get()) ); 
        
    }


}
