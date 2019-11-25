<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function()
{
   Route::post('details', 'UserController@details');
   Route::post('deals', 'Api\DealsController@createDeal');
   Route::post('deal', 'Api\DealsController@store');
});



Route::post('register', 'UserController@registerUser');
 
Route::post('login', 'UserController@userLogin');

//Deals Rest Controller API

// Route::get('deals', 'Api\DealsController@index');
// Route::post('deals', 'Api\DealsController@store');
// Route::get('deal\{id}', 'Api\DealsController@show');
// Route::put('deals', 'Api\DealsController@update');
// Route::delete('deals\{id}', 'Api\DealsController@destroy');

Route::get('role',[
    'middleware' => 'Role:editor',
    'uses' => 'TestRoleController@index',
    ]);
