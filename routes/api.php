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
Route::get('getSpeciality', 'SpecialityController@index');
Route::post('selectSpeciality', 'SpecialityController@selectSpeciality');

//Enter more routes here, leaving below as last route!
Route::any('{path}', 'UsersController@index')->where('path', '.+');
