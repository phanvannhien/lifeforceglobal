<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Feedback;

class BlogController extends Controller
{
    //
    public function aboutUs(){
    	return view('front.about_us');
    }

    public function contactUs(){
    	return view('front.contact_us');
    }

    public function feedbackUs(){
    	return view('front.feedback');
    }

    public function feedbackUsSubmit(Request $request){
    	$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
    	$site_key    = '6LdY6yMTAAAAAGCtPNCbafSyjvqYe7HF8fNAc5T8';
    	$secret_key  = '6LdY6yMTAAAAAIu68eEHZiBLhp49h8IuAKGlo4K7';
    	$site_key_post    = $request->input('g-recaptcha-response');


 
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
	        $remoteip = $_SERVER['REMOTE_ADDR'];
	    }
    	
	    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
	       
        $response = @file_get_contents($api_url);
        $response = json_decode($response);
        if(!isset($response->success))
        {
        	$msg = array(
        		'class' => 'alert-danger',
        		'detail' => 'Captcha is valid'
        	);
            return view('front.feedback',array('message' => $msg));
        }
        if($response->success == true)
        {
            $dataFeedback = $request->all();

            Feedback::create(array(
            	'fullname' => $dataFeedback['fullname'],
            	'email' => $dataFeedback['email'],
            	'subject' => $dataFeedback['subject'],
            	'message' => $dataFeedback['message'],
            ));

            try{
            	// try mail to customer
            	 Mail::send('emails.feedback',
            		 array('data' => $dataFeedback)
            		 ,function($message) use ($dataFeedback) {
            			 $message->from( env('MAIL_USERNAME','Lifeforce') );
            			 $message->to( $dataFeedback['email'] )
            				 ->cc(env('MAIL_USERNAME'))
            				 ->subject(config('app.sitename').' - Thanks for feedback');
            		 });
            	// try mail to customer
            	 Mail::send('emails.feedbackAdmin',
            		 array('data' => $dataFeedback)
            		 ,function($message) use ($dataFeedback) {
            			 $message->from( $dataFeedback['email'] );
            			 $message->to(  env('MAIL_USERNAME','Lifeforce') )
            				 ->cc(env('MAIL_USERNAME'))
            				 ->subject(config('app.sitename').' - Feedback from customer'.$dataFeedback['fullname']);
            		 }); 

             }
             catch(Exception $e){
            	// fail
             }
             $msg = array(
        		'class' => 'alert-success',
        		'detail' => 'Thanks for your feedback'
        	);
            return view('front.feedback',array('message' => $msg));
        }else{
            $msg = array(
        		'class' => 'alert-danger',
        		'detail' => 'Captcha is valid'
        	);
            return view('front.feedback',array('message' => $msg));
        }
	    
   
    }
}
