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

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login_page');
});

Route::get('/home', 'DashboardController@Home');

//Route::get('/sayhello/{firstname}/{age}', 'HelloController@Index')->where(['age'=>'[0-9]+']);


Route::get('google', function () {
    return view('googleAuth');
});
    
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');