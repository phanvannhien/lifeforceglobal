<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;
use Hash;
use Mail;
use App\User;
use Session;
use App\Models\Orders;
use Site;
use Cart;
use CustomerHelper;

class UserController extends Controller
{
    // View forgot password
    public function forgot(){
        return view('front.users.forgot');
    }
    public function forgotSubmit(Request $request){
        
    }

    public function login(Request $request){
    	// Authentication data
         $authData = array(
            'email' =>  $request->input( 'email' ), 
            'password' => $request->input( 'password' ), 
        );
        if($request->ajax()){
            // Check if login with username
            if ( strpos($authData['email'],'@') == false ) {
                return response()->json( array('msg' => 'Email wrong!'));
                
            }else{
                $userLogin = DB::table('users')->where( 'email', $request->input('email') )->first();
            }
          
            if( $userLogin ){
                if($userLogin->user_status == 0){
                    return response()->json(array('msg' => 'Account is locked!'));
                }

                if (Auth::attempt($authData))
                {
                    CustomerHelper::reduceCart();
                    return response()->json(array('msg' => 'success'));
                }
            }
            return response()->json(array('msg' => 'Email or password wrong!'));
        }

        // Check if login with username
        if ( strpos($authData['email'],'@') == false ) {
            Session::flash('message', 'Wrong email format!');
            return back()->withInput();
        }else{
            $userLogin = DB::table('users')->where( 'email', $request->input('email') )->first();
        }
        
        if( $userLogin ){
            if($userLogin->user_status == 0){
                Session::flash('message', 'Account is locked!');
                return back()->withInput();
            }

            if (Auth::attempt($authData))
            {
                CustomerHelper::reduceCart();
                return redirect('/');
            }
        }

        Session::flash('message', 'Email or password wrong!');
        return back()->withInput();
    }

    // User logout
    public function logout(){
    	Auth::logout();
        CustomerHelper::reduceCart();
    	return redirect('/');
    }

    // User register
    public function register(Request $request){
    	$userReferalID = '';
    	//Validate Email
        $userCode = '';
    	if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) === false) {
    		return response()->json(array('success'=> false, 'msg' => "Email wrong format!"));
    	}
    	if(DB::table('users')->where('email', $request->input('email'))->count() > 0){
    	    return response()->json(array('success'=> false, 'msg' => "Email already exist!"));
    	}
        
        if( $request->input('user_city') == '-1' ){
            return response()->json(array('success'=> false, 'msg' => "Please select your city"));
        }

        if( $request->input('user_refferal') != '' ){
            $userFind = DB::table('users')->where('user_code',$request->input('user_refferal'))->first();
            if ( count($userFind) <= 0 ){
                return response()->json(array('success'=> false, 'msg' => "User Referal Code not found"));
            }else{
                $userCode = $userFind->membership_number;
            }

        }

        $userCreated = new User();
        $userCreated->name_suffix = '_a_w';
        $userCreated->email =  $request->input('email');
        $userCreated->password = Hash::make($request->input('password'));
        $userCreated->user_code = str_random(32);
        $userCreated->membership_number = User::getUserCode($userCode,$request->input('user_city'));
        $userCreated->user_role = 'OM';
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

            session()->put('user_registered',$dataEmail);

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
            
            return response()->json(array('success'=> true));
        }
        return response()->json(array('success'=> false, 'msg' => "Registration fails!"));
          
            
    }

    public function registerSuccess(){
        return view('front.users.register_success');
    }

    public function resendActivationCode(){
        if( session()->has('user_registered') ){
            $dataEmail = session()->get('user_registered');
            try{
                Mail::send('emails.new_register',
                    array('mail' => $dataEmail)
                   ,function($message) use ($dataEmail) {
                            $message->from( env('MAIL_USERNAME','Lifeforce') );
                            $message->to( $dataEmail['email'] )
                            //->cc()
                            ->subject(config('app.sitename').' - Wellcome new register');  
                   });
            }
            catch(Exception $e){
				// fail
			 }
            Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Resend successful!') );
            return view('front.users.register_success');
        }

        Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Resend fail!') );
        return view('front.users.register_success');

    }

    public function userVerify($code){
        $exitsUser = DB::table('users')->where('user_verify_code',$code)->first();
        $isSuccessVerify = false;
        if($exitsUser){
            $isSuccessVerify = true;
            DB::table('users')
                ->where('user_verify_code',$code)
                ->update(array('user_status'=> 1));

            return view('front.users.verify')->with('isSuccessVerify',$isSuccessVerify ) ;   
        }
        return view('front.users.verify')->with('isSuccessVerify',$isSuccessVerify ) ;   
    }

    public function myAccount(Request $request){
        

        if ($request->isMethod('post') && $request->has('submit') ){
            $arrDate =  explode('-', $request->input('date_range'));
            $startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
            $endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));
            $commission = CustomerHelper::getCommissionWMUserByDate(Auth::user()->id,$startDate,$endDate);
            return view('front.customer.dashboard',['commission' => $commission]);
        }

        return view('front.customer.dashboard');


    }

    public function orderHistory(Request $request){
        $orders = DB::table('orders');
        $orders->where('user_id', Auth::user()->id );
        if($request->isMethod('post')){
            $arrDate =  explode('-', $request->input('date_range'));
            $startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
            $endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));

            $orders->whereBetween('created_at', array($startDate,$endDate));
        }
        $orders = $orders->orderBy('id','DESC')->paginate(10);
       
        return view('front.customer.order_history',array('orders' => $orders));
    }

    public function orderStatus($id){
        $order = Orders::find($id);
        //dd($order);
        return view('front.customer.order_status',array('order' => $order) );
    }

    public function userAddress(){

        $address = DB::table('customers_address')->where('user_id', Auth::user()->id )->get();
        return view('front.customer.address',array('address' =>  $address));
    }

    public function userInfo(){

        return view('front.customer.info',array('user' => User::find(Auth::user()->id) ));
    }

    public function userInfoSave(Request $request){
        $user = User::find(Auth::user()->id);
        $old_password = $request->input('InputPasswordCurrent');
        $new_password = $request->input('InputPasswordnew');

        if( !empty($old_password) ){
            // test input password against the existing one
            if( Hash::check($old_password, $user->getAuthPassword()) ){
                $user->password = Hash::make($new_password);
                // save the new password
                if($user->save()) {
                     Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Update successful!') );
                    return $this->userInfo();
                }
            } else {
                Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Current password does not match!') );
               
            }
        }else{
            $user->name = $request->input('name');
            if($user->save()) {
                Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Update successful!') );
               
            }
        }
        return view('front.customer.info',array('user' => User::find(Auth::user()->id) ));

    }

    public function userAddressEdit($id){
        $address = DB::table('customers_address')->where('user_id', Auth::user()->id )->get();
        $addressEdit = DB::table('customers_address')->where('id',$id)->first();
        if($address){
            return view('front.customer.address',
                array('address' =>  $address, 'address_edit' 
                => $addressEdit )); 
        }

    }

    public function userAddressRemove($id){
        
        $removed = DB::table('customers_address')
            ->where('id',$id)
            ->where('user_id',Auth::user()->id)
            ->delete();
        if ($removed){
            Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Removed successful!') );
            return $this->userAddress();
        }  
        Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Removed fail!') );
        return $this->userAddress();
    }

    public function userAddressAdd(Request $request){
        if( $request->has('address') ){

            if( $request->has('mode_edit') ){
                $updated = DB::table('customers_address')
                    ->where('user_id', Auth::user()->id)
                    ->where('id',$request->input('id'))
                    ->update(
                        array(
                            'address' => $request->input('address'),
                        )
                    );
                if ($updated){
                    Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Updated successful!') );
                    
                }else{
                    Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Updated fail!') );
                }
                return $this->userAddress();
            }else{
                $inserted = DB::table('customers_address')->insert(
                    array(
                        'user_id' => Auth::user()->id,
                        'address' => $request->input('address'),
                        'created_at' => date('Y-m-d H:s:i')
                    )
                );
                if ($inserted){
                    Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Add successful!') );
                    return $this->userAddress();
                }else{
                    Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Add fail!') );
                }
                return $this->userAddress();
            }

           
        }    
        
        return back();
    }

    public function getMembersOf(Request $request){


        $user = DB::table('users')->get();
        $members = User::getUplineMembers($user, Auth::user()->user_code);
        if( count($members) > 0){
            $members = array_values(array_sort($members, function ($value) {
                return $value->user_level;
            }));
        }else{
            $members = DB::table('users')->where('id',Auth::user()->id)->get();

        }

        
        $date['startDate'] = date('Y-m-01');
        $date['endDate'] = date('Y-m-d');

        if( $request->isMethod('post') && $request->has('date_range')){
            $arrDate =  explode('-', $request->input('date_range'));
            $date['startDate'] = date('Y-m-d',strtotime($arrDate[0]));
            $date['endDate'] = date('Y-m-d',strtotime($arrDate[1]));
        }

        // Get purchase from start date of month to now
        $membersPurchase = User::getTotalPurchaseMembers($members,$date['startDate'],$date['endDate']);
        return view('front.customer.membersof', array(
            'members' => $membersPurchase,
            'date' => $date
        ));
    }



    //public function 
}
