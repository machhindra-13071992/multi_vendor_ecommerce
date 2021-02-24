<?php

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

	/*Route::get('/', function () {
	    return view('welcome');
	});*/
	Route::auth();
	Auth::routes();
	Route::group(['middleware' => 'auth'], function () {
	  // All route your need authenticated
		Route::resource('users','UserController');
		Route::resource('countries', 'CountryController');
		Route::resource('video_statuses', 'VideoStatusController');
		Route::resource('states', 'StateController');
		Route::resource('cities', 'CityController');
		Route::resource('roles', 'RoleController');
		Route::resource('categories','CategoryController');
		Route::resource('products','ProductController');
		Route::resource('quantities','QuantityController');
		Route::resource('order_items','OrderItemController');
		Route::resource('orders','OrderController');
	});

	Route::get('/', function () {
	    return view('pages.admin_login_page');
	});
	Route::post('login', ['as' => 'login','uses' =>'LoginController@redirectToGoogle']);
	Route::get('/login', function () {
	    return view('pages.admin_login_page');
	});
	Route::get('/admin_login', function () {
	    return view('pages.admin_login_page');
	});
	Route::get('/home', 'DashboardController@Home');
	Route::get('/admin_home', 'DashboardController@home');
	Route::get('google', function () {
	    return view('googleAuth');
	});
	Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
	Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
	Route::get('logout','\App\Http\Controllers\Auth\LoginController@logout');
	Route::get('/admin_login_backend',['as'=>'adminLoginbackend','uses' =>'UserController@admin_login_backend']);
	Route::get('/rest_api/categories/{id?}','DashboardController@all_product_categories')->defaults('id',0);
	Route::get('/rest_api/products_by_category/{category_id?}','DashboardController@all_products_by_categories')->defaults('id',0);
	Route::get('/rest_api/products_by_id/{category_id?}','DashboardController@all_products_by_id')->defaults('id',0);
	Route::get('/rest_api/get_wallet_amount_by_user_id/{user_id?}','DashboardController@wallet_amounts')->defaults('id',0);
	Route::post('/post_sales_info','CategoryController@post_sales_worker_data')->name('post_sales_info');
	Route::get('/users/wallet_transaction/{user_id?}','UserController@user_money_transactions')->defaults('user_id',0);
	Route::post('/post_wallet_transaction','UserController@post_money_transactions')->name('post_wallet_transaction');
	Route::get('update_order_status/{order_id}/{order_status_id}','OrderController@update_order_status');
	