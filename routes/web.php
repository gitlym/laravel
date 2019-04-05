<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# User Management Group
Route::group([ 'prefix' => 'users'], function(){
    #Create a user
    Route::post('/create', 'UserController@store')->name('createUser');
    #Update a user information
    Route::post('/update/{id}', 'UserController@update')->name('updateUser');
    #Get User List
    Route::get('/', 'UserController@index')->name('listUser');
});
