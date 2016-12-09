

<?php

use App\Models\TrPurchases;
use App\User;

Route::get('check_user', function() {

	return  User::all();

});





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


//Customer
	Route::delete('customer/delete', ['uses' => 'RefCustomerController@delete','as' => 'customer.delete']);
	Route::get('customer/data', ['uses' => 'RefCustomerController@data','as' => 'customer.data']);
	Route::resource('customer', 'RefCustomerController');


//Item
	Route::delete('item/delete', ['uses' => 'RefItemController@delete','as' => 'item.delete']);
	Route::get('item/data', ['uses' => 'RefItemController@data','as' => 'item.data']);
	Route::resource('item', 'RefItemController');

//user
	Route::delete('user/delete', ['uses' => 'RefUserController@delete','as' => 'user.delete']);

	Route::put('user/{id}', ['uses' => 'RefUserController@updatePassword','as' => 'user.pass']);
	Route::post('user/avatar/{id}', ['uses' => 'RefUserController@avatar','as' => 'user.avatar']);
	Route::post('user/deleteAvatar/{id}', ['uses' => 'RefUserController@deleteAvatar','as' => 'user.deleteAvatar']);

	Route::get('user/data', ['uses' => 'RefUserController@data','as' => 'user.data']);
	Route::resource('user', 'RefUserController');


//Purchases
	Route::delete('purchase/delete', ['uses' => 'TrPurchasesController@delete','as' => 'purchase.delete']);
	Route::get('purchase/data', ['uses' => 'TrPurchasesController@data','as' => 'purchase.data']);
	Route::resource('purchase', 'TrPurchasesController');


//Role
	Route::delete('role/delete', ['uses' => 'RefRoleController@delete','as' => 'role.delete']);
	Route::get('role/data', ['uses' => 'RefRoleController@data','as' => 'role.data']);
	

	Route::get('role/permission/{roleId}', ['uses' => 'RefRoleController@createPermission','as' => 'role.createPermission']);

	Route::post('role/permission', ['uses' => 'RefRoleController@storePermission','as' => 'role.storePermission']);
	Route::put('role/permission/{roleID}', ['uses' => 'RefRoleController@updatePermission','as' => 'role.updatePermission']);


	Route::resource('role', 'RefRoleController');



});




// Make Auth
Auth::routes();











