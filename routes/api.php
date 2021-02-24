<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('token/{secret}', 'APIAuthController@validateClient');
Route::middleware('auth.partner')->get('/videos/{partner}','PartnerController@getVideos');
Route::post('user_registrations','DashboardController@createUser');
Route::post('user_login','DashboardController@loginUser');
Route::post('user_update_address','DashboardController@updateUserAddress');
Route::post('save_order_items','DashboardController@updateOrderItems');
Route::middleware('auth:api')->get('/user',function(Request $request){
    return $request->user();
});
