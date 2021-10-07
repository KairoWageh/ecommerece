<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// access User folder in controller  ===> using namespace User
Route::group(['prefix' => '', 'namespace' => 'User'], function(){

	Route::get('/login', 'UserAuth@login')->name('login');
	Route::post('/login', 'UserAuth@doLogin');
	Route::get('/logout', 'UserAuth@logout')->name('logout');


	 // change language of site using url
	Route::get('/lang/{lang}', function($lang){
		//return session('lang');
		session()->has('lang')? session()->forget('lang'): '';
		$lang == 'ar'? session()->put('lang', 'ar'): session()->put('lang', 'en');
		return back();
	})->name('lang');

	//if and only if user is authenticated
	// user:web ====> middleware:guard
	Route::group(['middleware' => 'user:web'], function(){
		Route::get('/', 'HomeController@home')->name('user_home');
		Route::get('account', 'AccountController@index')->name('account');
		Route::get('shop', 'ShopController@index')->name('shop');
		Route::get('product/{product}', 'ProductsController@single_product')->name('user.single_product');
		Route::get('/departments', 'DepartmentsController@index')->name('user.departments');
		Route::get('/departments/{dep_name}', 'DepartmentsController@single_dep')->name('user.single_dep');


		// cart routes
		Route::get('/cart', 'CartController@getCart')->name('cart');
		Route::get('/cart/item/{id}/add', 'CartController@addToCart')->name('cart.add');
		Route::get('/cart/item/{id}/remove', 'CartController@removeFromCart')->name('cart.remove');
		Route::get('/cart/clear', 'CartController@clearCart')->name('cart.clear');
		// Route::post('/cart/checkOut', 'CartController@checkOut')->name('cart.checkOut');
		Route::get('/cart/checkOut', 'CartController@checkOut')->name('cart.checkOut');
		Route::post('/cart/pay', 'CartController@pay')->name('cart.pay');
		// Route::get('checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');
		Route::get('cart/payment/complete', 'CartController@complete')->name('cart.payment.complete');

		// Route::get('account/orders', 'Site\AccountController@getOrders')->name('account.orders');


		// Route::get('/plans', 'PlanController@index')->name('plans.index');
		// Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');

		// Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');
	});


});


// un logged in users can see home page
Route::group(['middleware' => 'maintenance'], function(){
	Route::get('/', 'User\HomeController@home');
});

Route::get('maintenance', function(){
	if(setting()->status == 'open'){
		return redirect('/');
	}
	return view('site.maintenance');
});
