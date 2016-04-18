<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Session;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
 
    
    public function __construct(Guard $auth, PasswordBroker $passwords)
    {

        $this->auth = $auth;
        $this->passwords = $passwords;

        //$this->middleware('guest');
    }

    public function forgotSubmit(Request $request) {

        $email = User::where('email',$request->input('email'))->count();
        
        if ($email <= 0){
            Session::flash( 'message', array('class' => 'alert-danger', 'detail' => 'Email not found!') );
            return view('front.users.forgot');
        }
       
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->passwords->sendResetLink($request->only('email'), function($m) {
            $m->subject(config('app.appname').'Request change your password' );
        });

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                Session::flash( 'message', array('class' => 'alert-success', 'detail' => 'Please check your email to reset password.!') );
                return view('front.users.forgot');

            case PasswordBroker::INVALID_USER:
                return view('front.users.forgot')->withErrors(['email' => $response]);
               
        }
    }

    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;
        }

        return view('front.users.reset')->with('token', $token);
    }


    public function postReset(Request $request)
    {


        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);




        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );


        $response = $this->passwords->reset($credentials, function($user, $password)
        {
            $user->password = bcrypt($password);

            $user->save();

            $this->auth->login($user);
        });


        switch ($response)
        {
            case PasswordBroker::PASSWORD_RESET:
                return redirect('/');

            default:
                Session::flash( 'message', array('class' => 'alert-success', 'detail' => $response) );
                //return redirect('/');
                return view('front.users.reset')->with('token', $request->input('token'));
                

        }
    }
}
