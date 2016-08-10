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
use App\Models\Products;
use App\Models\Categories;
use App\Models\Configurations;
use Validator;
use Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class AdminController extends Controller
{
    //

    const DEFAULT_PASSSWORD = '123456';

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

    /*
    * Categories
    */
    public function categories(){
        return view('back.categories.view',array('categories' => Categories::paginate(50)) );
    }
    public function categoriesCreate(){
        $category = Categories::create(array(
            'category_name' => 'Untitle',
            'parent_id' => 0,
            'category_status' => 0
        ));
        return redirect()->route('back.categories.edit',$category->id);
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

    public function categoriesDelete($id){
         DB::table('categories')->where('id', $id)->delete();
        return $this->allProduct();
    }


    /*
     * Products
     */
	public function allProduct(){
		return view('back.products.product', array('products'=> Products::all() ));
	}

    public function createProduct(){
        $product = new Products();
        $product->status = 0;
        $product->save();
    	return redirect()->route('back.product.edit',$product->id);
    }

    public function editProduct($id){
        return view('back.products.edit',array('product' => Products::find($id) ));
    }

    public function updateProduct(Request $request, $id){
  
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

    /*
     * Users
     */
    public function userCommission(Request $request,$id){

        // Filter by purchase date
        $date['startDate'] = date('Y-m-01');
        $date['endDate'] = date('Y-m-d');
        $whereOrder = " AND DATE(orders.created_at) >= '{$date['startDate']}' AND DATE(orders.created_at) <= '{$date['endDate']}'";

        if( $request->isMethod('post') && $request->has('date_range')){
            $arrDate =  explode('-', $request->input('date_range'));
            $date['startDate'] = date('Y-m-d',strtotime($arrDate[0]));
            $date['endDate'] = date('Y-m-d',strtotime($arrDate[1]));
            $whereOrder = " AND DATE(orders.created_at) >= '{$date['startDate']}' AND DATE(orders.created_at) <= '{$date['endDate']}'";
        }

        // Get purchase from start date of month to now
        $membersPurchase = User::getTotalPurchaseMembers(User::all(),$whereOrder);
        // Get upline members by current user
        $currentUser = DB::table('users')->where('id',$id)->first();
        $currentUser->commission = 0;
        $currentUser->class = 'treegrid-'.$currentUser->user_code;
        $currentUser->parent_class = '';
        $currentUser->totals = 0;
        $tempArr = array();
        array_push($tempArr,$currentUser);
        $members = User::getUplineMembers($membersPurchase,$currentUser->user_code,$tempArr);

        return view('back.users.commission', array(
            'members' => $members,
            'date' => $date,
            'id' => $id
        ));

    }
    public function allUsers(Request $request){

        $whereOrder = ' ';
        $whereUser = ' ';
        $perPage = 20;
        // Has filter
        if ($request->isMethod('post')){
            $arrFilter = $request->input('filter');
           
            foreach ($arrFilter as $key => $value) {
                if( $value != '' ){
                    if( $key == 'registration_date' ){
                        $arrDate =  explode('-', $value);
                        $startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
                        $endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));
                        $whereUser .= "AND DATE(u.registration_date) >= '{$startDate}' AND DATE(u.registration_date) <= '{$endDate}' ";

                    }
                    elseif( $key == 'perpage' ){
                        $perPage = (int)$value;
                    }
                    elseif($key == 'purchase_date'){
                        $arrDatePurchase =  explode('-', $value);
                        $startDatePurchase = date('Y-m-d H:s:i',strtotime($arrDatePurchase[0]));
                        $endDatePurchase = date('Y-m-d H:s:i',strtotime($arrDatePurchase[1]));
                        $whereOrder .= "AND DATE(orders.created_at) >= '{$startDatePurchase}' AND DATE(orders.created_at) <= '{$endDatePurchase}'";
                    }
                    else{
                        $whereUser .= "AND u.{$key} = '{$value}'";
                    }
                    
                }
            }

            $results = User::getTotalPurchaseMembers(User::all(),$whereOrder,$whereUser);
        }else{
            $date['startDatePurchase'] = date('Y-m-01');
            $date['endDatePurchase'] = date('Y-m-d');
            $whereOrder .= "AND DATE(orders.created_at) >= '{$date['startDatePurchase']}' AND DATE(orders.created_at) <= '{$date['endDatePurchase']}'";
            $results = User::getTotalPurchaseMembers(User::all(),$whereOrder);
        }

        //$currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPage = $request->input('page', 1) - 1;
        $collection = new Collection($results);
        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));

        return view('back.users.dashboard',array('users' => $paginatedSearchResults) );
    }
    
    public function editUsers($id){
        return view('back.users.update')->with('user',User::find($id));
    }
    public function createUsers(){
        return view('back.users.create');
    }
    public function saveUsers(Request $request ){
        $userCode = '';
        //Validate Email
        $rule = array(
            'email' => 'required',
        );

        $v = Validator::make($request->all(),$rule);
        if ($v->fails())
        {
            return view('back.users.create')->withErrors($v->errors());
        }

        if(User::where('email', $request->input('email'))->count() > 0){
            Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Email already exitst !') );
            return view('back.users.create');
        }
        $user_level = 0;
        $user_uplinepath = '';
        if( $request->input('user_refferal') != '' ){
            $userFind = DB::table('users')->where('user_code',$request->input('user_refferal'))->first();
            if ( count($userFind) <= 0 ){
                Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'User refferal not found !') );
                return view('back.users.create');
            }else{
                $userCode = $userFind->membership_number;
                $user_level = (int)$userFind->user_level + 1;
                $user_uplinepath = $userFind->uplinepath.$userFind->id;
            }

        }

        $userCreated = new User();
        $userCreated->name_suffix = '_a_w';
        $userCreated->email =  $request->input('email');
        $userCreated->password = Hash::make(self::DEFAULT_PASSSWORD);
        $userCreated->user_code = str_random(32);
        $userCreated->membership_number = User::getUserCode($userCode,$request->input('user_city'));
        $userCreated->user_role = 'OM';
        $userCreated->user_level = $user_level;
        $userCreated->uplinepath = $user_uplinepath;
        $userCreated->user_refferal = $request->input('user_refferal');
        $userCreated->registration_date = date('Y-m-d H:s:i');
        $userCreated->user_verify_code = str_random(64);
        $userCreated->register_fee = \App\Helpers\SiteHelper::getConfig('register_fee');
        $userCreated->save();

        if($userCreated){
            // Email to registed user
            $dataEmail =  array(
                'email' => $userCreated->email,
                'user_code' => $userCreated->user_code,
                'user_verify_code' => $userCreated->user_verify_code
            );

            try{
                Mail::send('emails.new_register',
                    array('mail' => $dataEmail)
                    ,function($message) use ($dataEmail) {
                        $message->from( env('MAIL_USERNAME','Lifeforce') );
                        $message->to( $dataEmail['email'] )
                            ->cc(env('MAIL_USERNAME'))
                            ->subject(config('app.sitename').' - Wellcome new register');
                    });
            }

            catch(Exception $e){
                // fail
            }
            Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'User created successful !') );
            return view('back.users.update')->with('user',$userCreated);
        }
        Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'User created failed !') );
        return view('back.users.create');
    }

    public function updateUsers(Request $request,$id){
        if ($request->isMethod('post')){
            $user = User::find($request->input('id'));

            if($user){
                $user->name = $request->input('name');
                $user->user_role = $request->input('user_role');
                //$user->user_refferal = $request->input('user_refferal');
                //reduce user member code
                $user->membership_number = $request->input('user_role').substr($user->membership_number,2);
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
    /*
    * Orders
    */
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
            }
            return view('back.orders.dashboard')->with('orders',$orders);
        }
        $orders =  Orders::paginate(50);
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
                             $message->to( $orders->orderable->email )
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
                             $message->to( $orders->orderable->email )
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
                             $message->to( $orders->orderable->email )
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

    /*
     * Configurations
     */
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
