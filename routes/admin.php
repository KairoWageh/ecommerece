<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
	// default guard is web but we need to use admin guard if url contains admin
	Config::set('auth.default', 'admin');
	Route::get('getToken', 'AdminAuth@getToken');
	Route::get('login', 'AdminAuth@login')->name('adminLogin');
	Route::post('login', 'AdminAuth@doLogin');
	Route::get('forgot/password', 'AdminAuth@forgotPassword');
	Route::post('forgot/password', 'AdminAuth@forgotPasswordPost');
	Route::get('reset/password/{token}', 'AdminAuth@resetPassword');
	Route::post('reset/password/{token}', 'AdminAuth@resetPasswordPost');

	// change language of site using url
	Route::get('lang/{lang}', function($lang){
		session()->has('lang')? session()->forget('lang'): '';
		$lang == 'ar'? session()->put('lang', 'ar'): session()->put('lang', 'en');
		return back();
	});

	//if and only if admin is authenticated
	// admin:admin ====> middleware:guard
	Route::group(['middleware' => 'admin:admin'], function(){
		Route::resource('admins', 'AdminController');
		Route::delete('admins/destroy/all', 'AdminController@multi_delete');
		Route::get('/', 'HomeController@home')->name('home');
		// Route::get('/', function(){
		// 	return view('admin.home');
		// })->name('home');
		Route::any('logout', 'AdminAuth@logout');

		// control users from admin panel
		Route::resource('users', 'UsersController');
		Route::delete('users/destroy/all', 'UsersController@multi_delete');

		// control countries from admin panel
		Route::resource('countries', 'CountriesController');
		Route::delete('countries/destroy/all', 'CountriesController@multi_delete');

		// control cities from admin panel
		Route::resource('cities', 'CitiesController');
		Route::delete('cities/destroy/all', 'CitiesController@multi_delete');

		// control states from admin panel
		Route::resource('states', 'StatesController');
		Route::get('states/getCountryCities/{country}', 'StatesController@get_country_cities');
		Route::delete('states/destroy/all', 'StatesController@multi_delete');

		// control departments from admin panel
		Route::resource('departments', 'DepartmentsController');
		Route::delete('departments/destroy/all', 'DepartmentsController@multi_delete');

		// control trademarks from admin panel
		Route::resource('trademarks', 'TrademarksController');
		Route::delete('trademarks/destroy/all', 'TrademarksController@multi_delete');

		// control manufacturers from admin panel
		Route::resource('manufacturers', 'ManufacturersController');
		Route::delete('manufacturers/destroy/all', 'ManufacturersController@multi_delete');

		// control shippingCompanies from admin panel
		Route::resource('shippingCompanies', 'ShippingCompaniesController');
		Route::delete('shippingCompanies/destroy/all', 'ShippingCompaniesController@multi_delete');

		// control malls from admin panel
		Route::resource('malls', 'MallsController');
		Route::delete('malls/destroy/all', 'MallsController@multi_delete');

		// control colors from admin panel
		Route::resource('colors', 'ColorsController');
		Route::delete('colors/destroy/all', 'ColorsController@multi_delete');

		// control sizes from admin panel
		Route::resource('sizes', 'SizesController');
		Route::delete('sizes/destroy/all', 'SizesController@multi_delete');

		// control weights from admin panel
		Route::resource('weights', 'WeightsController');
		Route::delete('weights/destroy/all', 'WeightsController@multi_delete');

		// control products from admin panel
		Route::resource('products', 'ProductsController');
		Route::delete('products/destroy/all', 'ProductsController@multi_delete');
		Route::post('products/copy/{pid}', 'ProductsController@copy_product');
		Route::post('update/image/{pid}', 'ProductsController@update_product_image');
		Route::post('delete/product/image/{pid}', 'ProductsController@delete_main_image');
		Route::post('upload/image/{pid}', 'ProductsController@upload_file');
		Route::post('delete/image', 'ProductsController@delete_file');
		Route::post('products/{id}/load/shippingInfo', 'ProductsController@loadShippingInfo');
		Route::post('products/search', 'ProductsController@search_product');

		// site settings
		Route::get('settings', 'SettingsController@settings')->name('admin.settings');
		Route::post('settings', 'SettingsController@settings_save');
	});



    /**
     * a way to include language translation of data table using route url
    */
	// Route::get('dataTable/lang', function(){
	// 	$langJson = [
 //            "sProcessing" => __("admin.sProcessing"),
 //            "sLengthMenu" => __("admin.sLengthMenu"),
 //            "sZeroRecords" => __("admin.sZeroRecords"),
 //            "sEmptyTable" => __("admin.sEmptyTable"),
 //            "sInfo" => __("admin.sInfo"),
 //            "sInfoEmpty" => __("admin.sInfoEmpty"),
 //            "sInfoFiltered" => __("admin.sInfoFiltered"),
 //            "sInfoPostFix" => __("admin.sInfoPostFix"),
 //            "sSearch" => __("admin.sSearch"),
 //            "sUrl" => __("admin.sUrl"),
 //            "sInfoThousands" => __("admin.sInfoThousands"),
 //            "sLoadingRecords" => __("admin.sLoadingRecords"),
 //            "oPaginate" => [
 //                "sFirst" => __("admin.sFirst"),
 //                "sLast" => __("admin.sLast"),
 //                "sNext" => __("admin.sNext"),
 //                "sPrevious" => __("admin.sPrevious")
 //            ],
 //            "oAria" => [
 //                "sSortAscending" => __("admin.sSortAscending"),
 //                "sSortDescending" => __("admin.sSortDescending")
 //            ]
 //        ];
 //        return response($langJson);
	// });
});
