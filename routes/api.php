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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list all users
Route::get('users', 'UserController@index');
//list single user
Route::get('user/{id}', 'UserController@show');
//create user
Route::post('create-user', 'UserController@store');
//delete user
Route::delete('delete-user/{id}', 'UserController@destroy');
//list single user
Route::get('login/{id}', 'LoginController@show');
//list all users
Route::get('login', 'LoginController@index');