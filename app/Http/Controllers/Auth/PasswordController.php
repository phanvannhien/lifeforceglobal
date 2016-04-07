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
        //dd($email);
        if ($email == 0){
            Session::flash('message', 'Email does not exist!'); 
            return redirect()
                ->back()
                ->withInput();
        }

        $this->validate($request, ['email' => 'required|email']);

        $response = $this->passwords->sendResetLink($request->only('email'), function($m) {
            $m->subject(config('app.appname').'Request change your password' );
        });

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('success_msg',"Please check your email to reset password.");

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
            
        }
    }

    public function getReset($token = null)
    {
        if (is_null($token))
        {
            throw new NotFoundHttpException;
        }

        return view('users.resetpass')->with('token', $token);
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
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
    }
}
