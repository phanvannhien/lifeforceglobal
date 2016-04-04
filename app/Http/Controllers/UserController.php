<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;

class UserController extends Controller
{
    //
    public function forgot(){

    }

    public function login(Request $request){
    	// Authentication data
        $authData = array(
        	'email' =>  $request->input( 'email' ), 
        	'password' => $request->input( 'password' ), 
        );
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
    	    return response()->json(array('success'=> false, 'msg' => "Email already exitst!"));
    	}

    	//Creating user
    	$userCreated = User::create([
    	    'email' =>  $request->input('email'),
    	    'password' => bcrypt($request->input('password')),
    	    'user_level_id' => 1 ,
    	]);
    }
}
