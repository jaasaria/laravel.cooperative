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

// Route::get('/', function () {
//     return view('auth.login');

// });

Route::get('/', ['uses'=>'\App\Http\Controllers\Auth\LoginController@showLoginForm','as' => 'user.login'] );


Route::group(['middleware' => 'auth'],function(){
	Route::get('/dashboard', 'PagesController@dashboard');
});


Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');
Route::get('register/token/{token}', 'Auth\RegisterController@verifylink');
Route::get('register/resend/{mail}', 'Auth\RegisterController@SendMail');











