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

class UserController extends Controller
{
    //
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
                return redirect('/');
                
            }
        }

        Session::flash('message', 'Email or password wrong!');
        return back()->withInput();
               
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }


    public function register(Request $request){
    	
    	//Validate Email

    	if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) === false) {
    		return response()->json(array('success'=> false, 'msg' => "Email wrong format!"));
    	}

    	if(DB::table('users')->where('email', $request->input('email'))->count() > 0){
    	    return response()->json(array('success'=> false, 'msg' => "Email already exist!"));
    	}

        $userCreated =  array(
            'name_suffix' => '_a_w',
            'email' =>  $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_code' => str_random(32),
            'user_refferal' => $request->input('user_refferal'),
            'registration_date' => date('Y-m-d H:s:i'),
            'user_verify_code' => str_random(64),
            'register_fee' => 50
        );


    	//Creating user
    	$createad = DB::table('users')->insert($userCreated);

        if($createad){
            
            // Email to registed user
            $dataEmail =  array(
                'email' => $userCreated['email'], 
                'user_code' => $userCreated['user_code'],
                'user_verify_code' => $userCreated['user_verify_code']
            );

            session()->put('user_registered',$dataEmail);

            
            Mail::send('emails.new_register',
                array('mail' => $dataEmail)
               ,function($message) use ($dataEmail) {
                        $message->from( env('MAIL_USERNAME','Lifeforce') );
                        $message->to( $dataEmail['email'] )
                        //->cc()
                        ->subject(config('app.sitename').' - Wellcome new register');  
            });
            
            return response()->json(array('success'=> true));
        }
        return response()->json(array('success'=> false, 'msg' => "Registration fails!"));
          
            
    }

    public function registerSuccess(){
        return view('front.users.register_success');
    }

    public function resendActivationCode(){
        if( session()->has('user_registered') ){
            Mail::send('emails.new_register',
                session()->get('user_registered')
               ,function($message) use ($dataEmail) {
                        $message->from( config('email.username') );
                        $message->to($dataEmail['email'])
                        //->cc()
                        ->subject(config('app.sitename').' - Wellcome new register');  
            });

        }
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

    public function myAccount(){
        return view('front.customer.dashboard');
    }

    public function orderHistory(){
        
        
        return view('front.customer.order_history');
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
}
