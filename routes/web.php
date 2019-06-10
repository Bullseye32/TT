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
if(!defined('STATIC_DIR')) define("STATIC_DIR","");
if(!defined('DEFAULT_USER')) define('DEFAULT_USER','assets/uploads/icons/default-user-1.png');

Route::get('/',['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// staff Management
Route::group(['prefix' => 'staff', 'as'=>'staff.'], function(){
    Route::get('/list',['uses' => 'Auth\RegisterController@show', 'as' => 'show']);
    Route::get('/register',['uses' => 'Auth\RegisterController@showRegistrationForm', 'as' => 'register']);

    Route::get('/edit/{id}', ['uses' => 'Auth\RegisterController@getEdit', 'as' =>'edit'] );
    Route::post('/edit/{id}', ['uses' => 'Auth\RegisterController@updateStaff'] );

    Route::get('/view/{id}', ['uses' => 'Auth\RegisterController@getView', 'as' => 'view'] );

    Route::post('/delete',['uses' => 'Auth\RegisterController@delete', 'as' => 'delete']);
});

// profile
Route::get('/profile/view/{id}', ['uses' => 'ProfileController@view','as' => 'profile.view']);
Route::get('/password/edit', ['uses' => 'ProfileController@editPassword','as' => 'password.edit']);
Route::post('password/edit/{id}', ['uses' => 'ProfileController@updatePassword', 'as' => 'password.update']);
