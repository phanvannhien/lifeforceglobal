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
/*
|--------------------------------------------------------------------------
| Init Setting Site
|--------------------------------------------------------------------------
|*/

Route::get('initialize-site',array('as' => 'init', 'uses' => 'HomeController@initializeSite' ));


Route::group( 
    array( 
        'middlewareGroups' => ['web']
    ),function () {

        Route::get('/',array('as'=>'front.index', 'uses' => 'HomeController@index'));

        Route::get('/category/{id}/{slug}',array('as'=>'front.category', 'uses' => 'HomeController@category'));
        Route::get('/products',array('as'=>'front.products', 'uses' => 'HomeController@productAll'));
        Route::get('/product/{id}/{slug}',array('as'=>'front.product', 'uses' => 'HomeController@product'));


        Route::get('/user/forgot',array('as'=>'user.forgot', 'uses' => 'UserController@forgot'));
        Route::post('/user/forgot',array('as'=>'user.forgot.submit', 'uses' => 'Auth\PasswordController@forgotSubmit'));
        Route::get('/password/reset/{token}',array('as' => 'user.resetpassword', 'uses' => 'Auth\PasswordController@getReset'));
        Route::post('/password/reset',array('as' => 'user.postresetpassword', 'uses' => 'Auth\PasswordController@postReset'));
        // Ajax login and register
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
         Route::post('/contact-us',array('as'=>'front.contactus.post', 'uses' => 'BlogController@feedbackUsSubmit'));
         
         Route::get('/feedback-us',array('as'=>'front.feedback', 'uses' => 'BlogController@feedbackUs'));
         Route::post('/feedback-us',array('as'=>'front.feedback.submit', 'uses' => 'BlogController@feedbackUsSubmit'));

    
        /*
        |--------------------------------------------------------------------------
        | Checkout
        |--------------------------------------------------------------------------
        |*/
        Route::get('/cart',array('as'=>'front.cart.page', 'uses' => 'CartController@getCart'));
        Route::post('/cart',array('as'=>'front.cart', 'uses' => 'CartController@cart'));
        Route::post('/cart/update',array('as'=>'front.cart.update', 'uses' => 'CartController@updateCart'));
        Route::get('/cart/del/{pid}',array('as'=>'front.cart.delete', 'uses' => 'CartController@delCart'));
        //Checkout Users
        Route::get('/checkout',array('as'=>'front.checkout', 'uses' => 'CheckoutController@checkout'));        
        Route::post('/checkout',array('as'=>'front.checkout.final', 'uses' => 'CheckoutController@checkoutFinal'));  

       
        
});


Route::group(
    array( 
        'middlewareGroups' => array('web','auth')

    ),function () {
       
        Route::get('/user/membersof',array('as'=>'user.memberssof', 'uses' => 'UserController@getMembersOf')); 
        Route::post('/user/membersof',array('as'=>'user.memberssof.filter', 'uses' => 'UserController@getMembersOf')); 
        Route::get('/order/status/{id}',array('as'=>'front.order.status', 'uses' => 'UserController@orderStatus'));  
        Route::get('/user/my-account',array('as'=>'user.dashboard', 'uses' => 'UserController@myAccount'));
        Route::post('/user/my-account',array('as'=>'user.dashboard.post', 'uses' => 'UserController@myAccount'));
        // User address book
        Route::get('/user/address',array('as'=>'user.address', 'uses' => 'UserController@userAddress'));
        Route::post('/user/address',array('as'=>'user.address.add', 'uses' => 'UserController@userAddressAdd'));
        Route::get('/user/address/edit/{id}',array('as'=>'user.address.edit', 'uses' => 'UserController@userAddressEdit'));
        Route::get('/user/address/remove/{id}',array('as'=>'user.address.remove', 'uses' => 'UserController@userAddressRemove'));
        Route::get('/user/order-history',array('as'=>'user.order.history', 'uses' => 'UserController@orderHistory'));
        Route::post('/user/order-history',array('as'=>'user.order.history.filter', 'uses' => 'UserController@orderHistory'));

        Route::get('/user/my-info',array('as'=>'user.info', 'uses' => 'UserController@userInfo'));
        Route::post('/user/my-info',array('as'=>'user.info.post', 'uses' => 'UserController@userInfoSave'));
        Route::get('/user/logout',array('as'=>'user.logout', 'uses' => 'UserController@logout'));
        Route::get('/user/commision',array('as'=>'user.commision', 'uses' => 'UserController@commission'));


    });

/*
|--------------------------------------------------------------------------
| Backend
|--------------------------------------------------------------------------
|*/


// Login
Route::group( 
    array( 
        'middleware' => ['web'],
        'prefix' => 'admin'
    ),function () {
    Route::get('/login',array('as'=>'back.admin.login', 'uses' => 'AdminController@adminLogin'));
    Route::post('/login',array('as'=>'back.admin.login.post', 'uses' => 'AdminController@adminLoginPost'));
});

Route::group( 
    array( 
        'middlewareGroups' => ['web','auth','admin'],
        'prefix' => 'admin'
    ),function () {


        Route::post('/report/bm-not-purchase-2-month',array('as'=>'back.admin.send.mail', 'uses' => 'AdminController@sendmail'));
        Route::get('/report/bm-not-purchase-2-month',array('as'=>'admin.bmreportnotpurchase2motnth', 'uses' => 'AdminController@reportBMnotPurchase2Month'));
        Route::get('/',array('as'=>'back.admin.dashboard', 'uses' => 'AdminController@adminDashboard'));
        Route::post('ajax/uploadfile',array('as'=>'back.admin.upload', 'uses' => 'MediaController@uploadFile'));
        Route::post('ajax/category/uploadfile',array('as'=>'back.categories.upload', 'uses' => 'MediaController@categoriesUpload'));
        // Categories
        Route::get('product/categories',array('as'=>'back.categories', 'uses' => 'AdminController@categories'));
        Route::get('product/categories/create',array('as'=>'back.categories.create', 'uses' => 'AdminController@categoriesCreate'));
        Route::get('product/categories/edit/{id}',array('as'=>'back.categories.edit', 'uses' => 'AdminController@categoriesEdit'));
        Route::post('product/categories/edit/{id}',array('as'=>'back.categories.update', 'uses' => 'AdminController@categoriesUpdate'));
        Route::get('product/categories/delete/{id}',array('as'=>'back.categories.delete', 'uses' => 'AdminController@categoriesDelete'));

        // Product
        Route::get('product/create',array('as'=>'back.product.create', 'uses' => 'AdminController@createProduct'));
        Route::get('product',array('as'=>'back.product', 'uses' => 'AdminController@allProduct'));
        Route::get('product/{id}',array('as'=>'back.product.edit', 'uses' => 'AdminController@editProduct'));
        Route::post('product/{id}',array('as'=>'back.product.update', 'uses' => 'AdminController@updateProduct'));
        Route::get('product/delete/{id}',array('as'=>'back.product.delete', 'uses' => 'AdminController@deleteProduct'));
        
        // Users
        Route::get('users',array('as'=>'back.users', 'uses' => 'AdminController@allUsers'));
        Route::post('users',array('as'=>'back.users.post', 'uses' => 'AdminController@allUsers'));
        Route::get('users/create',array('as'=>'back.users.create', 'uses' => 'AdminController@createUsers'));
        Route::post('users/create',array('as'=>'back.users.save', 'uses' => 'AdminController@saveUsers'));
        Route::get('users/edit/{id}',array('as'=>'back.users.edit', 'uses' => 'AdminController@editUsers'));
        Route::post('users/edit/{id}',array('as'=>'back.users.edit.save', 'uses' => 'AdminController@updateUsers'));
        Route::get('users/delete/{id}',array('as'=>'back.users.delete', 'uses' => 'AdminController@deleteUsers'));
        Route::get('users/active/{id}',array('as'=>'back.users.active', 'uses' => 'AdminController@activeUsers'));

        // Orders
        Route::get('orders',array('as'=>'back.orders', 'uses' => 'AdminController@allOrders'));
        Route::post('orders',array('as'=>'back.orders.post', 'uses' => 'AdminController@allOrders'));
        Route::get('orders/edit/{id}',array('as'=>'back.orders.edit', 'uses' => 'AdminController@editOrders'));
        Route::get('orders/delete/{id}',array('as'=>'back.orders.delete', 'uses' => 'AdminController@deleteOrders'));
        Route::post('orders/changestatus',array('as'=>'back.order.changestatus', 'uses' => 'AdminController@changeStatusOrders'));
        
        // Configuration
        Route::get('configuration',array('as'=>'back.configuration', 'uses' => 'AdminController@configuration'));
        Route::post('configuration',array('as'=>'back.configuration.save', 'uses' => 'AdminController@configurationSave'));
        
        // Report
        Route::get('reportation/wm',array('as'=>'back.report', 'uses' => 'ReportController@reportboard'));
        Route::post('reportation/wm',array('as'=>'admin.sendmail.wm', 'uses' => 'ReportController@reportWMSendMail'));
        Route::get('user/commission/{id}',array('as'=>'back.users.commission', 'uses' => 'AdminController@userCommission'));
        Route::post('user/commission/{id}',array('as'=>'back.users.commission.post', 'uses' => 'AdminController@userCommission'));

        Route::resource('city','CityController');


    });




