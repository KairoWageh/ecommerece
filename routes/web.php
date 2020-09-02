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
	Route::get('lang/{lang}', function($lang){
		session()->has('lang')? session()->forget('lang'): '';
		$lang == 'ar'? session()->put('lang', 'ar'): session()->put('lang', 'en');
		return back();
	});

	//if and only if user is authenticated
	// user:web ====> middleware:guard
	Route::group(['middleware' => 'user:web'], function(){

		Route::get('/', function () {
		    return view('site.home');
		});
		Route::get('/departments', 'DepartmentsController@index')->name('user.departments');	
	});


});

Route::group(['middleware' => 'maintenance'], function(){
	Route::get('/', function () {
	    return view('site.home');
	});
});

Route::get('maintenance', function(){
	if(setting()->status == 'open'){
		return redirect('/');
	}
	return view('site.maintenance');
});
