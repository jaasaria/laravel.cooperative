<?php





// For Guest
Route::group(['middleware' => 'guest'],function(){
	Route::get('/', ['uses'=>'\App\Http\Controllers\Auth\LoginController@showLoginForm'] );
	Route::get('register/token/{token}', 'Auth\RegisterController@verifylink');
	Route::get('register/resend/{mail}', 'Auth\RegisterController@SendMail');	
});


// For Authenticated User
Route::group(['middleware' => 'auth'],function(){
	Route::get('/dashboard', 'PagesController@dashboard');
	Route::get('logout', 'Auth\LoginController@logout');


	Route::resource('category', 'categoryController');

});




// Make Auth
Auth::routes();











