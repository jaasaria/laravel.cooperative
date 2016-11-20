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


// Category
	Route::delete('category/delete', ['uses' => 'refCategoryController@delete','as' => 'category.delete']);
	Route::get('category/data', ['uses' => 'refCategoryController@data','as' => 'category.data']);
	Route::resource('category', 'refCategoryController');


//Units
	Route::delete('unit/delete', ['uses' => 'refUnitController@delete','as' => 'unit.delete']);
	Route::get('unit/data', ['uses' => 'refUnitController@data','as' => 'unit.data']);
	Route::resource('unit', 'refUnitController');

//Supplier
	Route::delete('supplier/delete', ['uses' => 'RefSupplierController@delete','as' => 'supplier.delete']);
	Route::get('supplier/data', ['uses' => 'RefSupplierController@data','as' => 'supplier.data']);
	Route::resource('supplier', 'RefSupplierController');




});




// Make Auth
Auth::routes();











