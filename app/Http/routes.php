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
        'middleware' => ['web']
    ),function () {
        Route::get('/',array('as'=>'front.index', 'uses' => 'HomeController@index'));
        Route::get('/category/{id}',array('as'=>'front.category', 'uses' => 'HomeController@category'));
        Route::get('/product/{id}/{slug}',array('as'=>'front.product', 'uses' => 'HomeController@product'));


        Route::get('/user/forgot',array('as'=>'user.forgot', 'uses' => 'UserController@forgot'));
        Route::post('/user/forgot',array('as'=>'user.forgot.submit', 'uses' => 'Auth\PasswordController@forgotSubmit'));
        Route::get('/user/password/reset/{token}',array('as' => 'user.reset.password', 'uses' => 'Auth\PasswordController@getReset'));
        Route::post('/user/password/reset/',array('as' => 'user.post.reset.password', 'uses' => 'Auth\PasswordController@postReset'));


        Route::post('/user/login',array('as'=>'user.login', 'uses' => 'UserController@login'));
        
        Route::post('/user/register',array('as'=>'user.register', 'uses' => 'UserController@register'));
        Route::get('/user/register/success',array('as'=>'user.register.success', 'uses' => 'UserController@registerSuccess'));
        Route::get('/user/verify/{code}',array('as'=>'user.verify', 'uses' => 'UserController@userVerify'));
        Route::get('/user/resend-verify',array('as'=>'user.verify.resend', 'uses' => 'UserController@resendActivationCode'));
        
        

        Route::get('/login',array('as'=>'home.login', 'uses' => 'HomeController@login'));
        Route::post('/login',array('as'=>'home.login.post', 'uses' => 'UserController@login'));


        /*
        |--------------------------------------------------------------------------
        | Blog
        |--------------------------------------------------------------------------
        |*/

         Route::get('/about-us',array('as'=>'front.aboutus', 'uses' => 'BlogController@aboutUs'));
         Route::get('/contact-us',array('as'=>'front.contactus', 'uses' => 'BlogController@contactUs'));
       
});


Route::group( 
    array( 
        'middleware' => array('web','auth')

    ),function () {
        Route::get('/cart',array('as'=>'front.cart.page', 'uses' => 'CartController@getCart'));
        Route::post('/cart',array('as'=>'front.cart', 'uses' => 'CartController@cart'));
        Route::post('/cart/update',array('as'=>'front.cart.update', 'uses' => 'CartController@updateCart'));
        Route::get('/cart/del/{pid}',array('as'=>'front.cart.delete', 'uses' => 'CartController@delCart'));

        Route::get('/checkout',array('as'=>'front.checkout', 'uses' => 'CheckoutController@checkout'));        
        Route::post('/checkout',array('as'=>'front.checkout.final', 'uses' => 'CheckoutController@checkoutFinal'));  

        Route::get('/order/status/{id}',array('as'=>'front.order.status', 'uses' => 'UserController@orderStatus'));  

        Route::get('/user/my-account',array('as'=>'user.dashboard', 'uses' => 'UserController@myAccount'));
        Route::get('/user/address',array('as'=>'user.address', 'uses' => 'UserController@userAddress'));
        Route::post('/user/address',array('as'=>'user.address.add', 'uses' => 'UserController@userAddressAdd'));
        Route::get('/user/address/edit/{id}',array('as'=>'user.address.edit', 'uses' => 'UserController@userAddressEdit'));
        Route::get('/user/address/remove/{id}',array('as'=>'user.address.remove', 'uses' => 'UserController@userAddressRemove'));
        Route::get('/user/order-history',array('as'=>'user.order.history', 'uses' => 'UserController@orderHistory'));
        Route::get('/user/logout',array('as'=>'user.logout', 'uses' => 'UserController@logout'));
    });

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
|*/

Route::group( 
    array( 
        //'middleware' => 'web'
    ),function () {
        Route::get('/admin/product/create',array('as'=>'back.product.create', 'uses' => 'AdminController@createProduct'));
        Route::post('/admin/product/create',array('as'=>'back.product.save', 'uses' => 'AdminController@saveProduct'));
        Route::get('/admin/product',array('as'=>'back.product', 'uses' => 'AdminController@allProduct'));
        Route::get('/admin/product/{id}',array('as'=>'back.product.edit', 'uses' => 'AdminController@editProduct'));
        Route::post('/admin/product/{id}',array('as'=>'back.product.update', 'uses' => 'AdminController@updateProduct'));
        Route::get('/admin/product/delete/{id}',array('as'=>'back.product.delete', 'uses' => 'AdminController@deleteProduct'));
        

    });




