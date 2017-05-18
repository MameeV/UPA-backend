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

//Route::get('getPhysician', 'MembershipsController@index');

Route::get('getRoles', 'RolesController@index');
Route::post('storeRole', 'RolesController@store');
Route::post('updateRole/{id}', 'RolesController@update');
Route::get('showRole/{id}', 'RolesController@show');
Route::post('deleteRole/{id}', 'RolesController@destroy');

//Route::post('signup', 'UsersController@signup');
//Route::post('signin', 'UsersController@signin');
Route::get('getUser', 'UsersController@getUser');

//Enter more routes here, leaving below as last route!
Route::any('{path}', 'UsersController@index')->where('path', '.+');
