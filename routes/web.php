<?php

use App\Models\TrPurchases;
use App\Models\TrMessages;
use App\User;


Route::get('check_user', function() {
	return  User::all();
});

Route::get('allmessage', function() {
        $data = TrMessages::all();
        return $data;
});




// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// class TestEvent implements ShouldBroadcast
// {
//     public $text;
//     public function __construct($text)
//     {
//         $this->text = $text;
//     }
//     public function broadcastOn()
//     {
//         return ['test-channel'];
//     }
// }
route::get('/broadcast', function() {

$data = TrMessages::where('id',1)->
                     with('userSender','userReceiver')->first();

    event(new \App\Events\ChatMessageReceived($data));

    return $data;
});












//Events
Event::listen('auth.last_login', function($user){
	$user->last_login = new DateTime;
	$user->save();
});



// For Guest
Route::group(['middleware' => 'guest'],function(){
	Route::get('/', ['uses'=>'\App\Http\Controllers\Auth\LoginController@showLoginForm'] );
	Route::get('register/token/{token}', 'Auth\RegisterController@verifylink');
	Route::get('register/resend/{mail}', 'Auth\RegisterController@SendMail');	
});


Route::group(['middleware' => 'auth'],function(){



// Pages	
	Route::get('/dashboard', 'PagesController@dashboard');
	Route::get('/settings', 'PagesController@settings');
	Route::post('/settings/update', ['uses' => 'PagesController@settingsUpdate','as' => 'settings.Update']);
	Route::get('/help', 'PagesController@help');
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

	Route::put('user/user/{id}', ['uses' => 'RefUserController@updatePassword','as' => 'user.pass']);
	Route::post('user/avatar/{id}', ['uses' => 'RefUserController@avatar','as' => 'user.avatar']);
	Route::post('user/deleteAvatar/{id}', ['uses' => 'RefUserController@deleteAvatar','as' => 'user.deleteAvatar']);

	Route::get('user/data', ['uses' => 'RefUserController@data','as' => 'user.data']);
	Route::get('user/profile/{id}', ['uses' => 'RefUserController@editProfile','as' => 'user.profile']);

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



//Sales
	Route::delete('sales/delete', ['uses' => 'TrSalesController@delete','as' => 'sales.delete']);
	Route::get('sales/data', ['uses' => 'TrSalesController@data','as' => 'sales.data']);
	Route::resource('sales', 'TrSalesController');




//Messages
	Route::get('messages', ['uses' => 'TrMessagesController@index','as' => 'messages.index']);

	Route::post('messages', ['uses' => 'TrMessagesController@store','as' => 'messages.store']);

	Route::post('messages/updateStatus', ['uses' => 'TrMessagesController@updateStatus','as' => 'messages.updateStatus']);
	Route::get('messages/userStat', ['uses' => 'TrMessagesController@userStat','as' => 'messages.userStat']);	
	Route::get('messages/userList', ['uses' => 'TrMessagesController@userList','as' => 'messages.userList']);

	Route::get('messages/data', ['uses' => 'TrMessagesController@data','as' => 'messages.data']);
	Route::get('messages/dataMessage', ['uses' => 'TrMessagesController@dataMessage','as' => 'messages.dataMessage']);
	Route::get('messages/dataReceivedMessage', ['uses' => 'TrMessagesController@dataReceivedMessage','as' => 'messages.dataReceivedMessage']);




});




// Make Auth
Auth::routes();











