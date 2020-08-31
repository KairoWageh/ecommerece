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
	Route::get('/', function () {
	    return view('site.home');
	});
	// user:web ====> middleware:guard
	Route::group(['middleware' => 'user:web'], function(){
		Route::get('/categories', 'DepartmentsController@index')->name('user.categories');	
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
