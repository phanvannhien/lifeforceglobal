<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group( 
    array( 
        'middleware' => 'web'
    ),function () {
        Route::get('/',array('as'=>'front.index', 'uses' => 'HomeController@index'));
        Route::get('/category/{id}',array('as'=>'front.category', 'uses' => 'HomeController@category'));
        Route::get('/product/{id}',array('as'=>'front.product', 'uses' => 'HomeController@product'));


        Route::get('/user/forgot',array('as'=>'user.forgot', 'uses' => 'UserController@forgot'));
        Route::post('/user/login',array('as'=>'user.login', 'uses' => 'UserController@login'));
        Route::get('/user/logout',array('as'=>'user.logout', 'uses' => 'UserController@logout'));
        Route::post('/user/register',array('as'=>'user.register', 'uses' => 'UserController@register'));

        

       
});



