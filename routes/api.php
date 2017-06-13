<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::get('getSpeciality', 'SpecialityController@index');
Route::post('selectSpeciality', 'SpecialityController@selectSpeciality');
Route::get('showPhysician/{id}', 'MembershipsController@show');

Route::get('getPhysician', 'MembershipsController@index');
Route::post('selectPhysician', 'MembershipsController@selectPhysician');
Route::post('deleteMember/{id}', 'MembershipsController@destroy');
Route::post('updateMember/{id}', 'MembershipsController@update');

Route::get('getRoles', 'RolesController@index');
Route::post('storeRole', 'RolesController@store');
Route::post('updateRole/{id}', 'RolesController@update');
Route::get('showRole/{id}', 'RolesController@show');
Route::post('deleteRole/{id}', 'RolesController@destroy');

Route::post('signup', 'UsersController@SignUp');
Route::post('signin', 'UsersController@SignIn');
Route::get('getUser', 'UsersController@getUser');
//Route::post('contact', 'UsersController@contact');

Route::any('{path}', 'UsersController@index')->where('path', '.+');
