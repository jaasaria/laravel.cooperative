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
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


Route::get('item', ['uses' => 'RefItemController@apiItem','as' => 'api.item']);

Route::get('item/{id}', ['uses' => 'RefItemController@apiItemId','as' => 'api.itemId']);


// route::get('test',function(){
// 	// return response(,200);
// });

