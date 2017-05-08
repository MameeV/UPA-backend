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
Route::get('getSpeciality', 'MembershipsController@getSpeciality');
Route::post('selectSpeciality', 'MembershipsController@selectSpeciality');
//Enter more routes here, leaving below as last route!
//Route::any('{path}', 'UsersController@index')->where('path', '.+');
