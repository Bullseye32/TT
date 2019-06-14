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

// Telephone management
Route::group(['prefix' => 'telephone', 'as'=>'telephone.'], function(){
    Route::get('/list', ['uses' => 'TelephoneController@index', 'as' => 'list']);
    Route::get('/register',['uses'=> 'TelephoneController@showRegister', 'as'=>'register']);
    Route::post('/register',['uses' => 'TelephoneController@store', 'as' => 'register']);

    // edit telephone
    Route::get('/edit/{id}',['uses' => 'TelephoneController@edit', 'as' => 'edit']);
    Route::post('/update',['uses' => 'TelephoneController@update', 'as' => 'update']);

    // delete
    Route::post('/delete',['uses' => 'TelephoneController@destroy', 'as' => 'delete']);
});

// Task management
Route::group(['prefix' => 'task', 'as' => 'task.'], function(){
    // create new task
    Route::get('/create', ['uses' => 'TaskController@create', 'as' => 'create'])->middleware(['auth', 'admin']);
    Route::post('/create', ['uses' => 'TaskController@store', 'as' => 'store'])->middleware(['auth', 'admin']);

    Route::get('/list', ['uses' => 'TaskController@index', 'as' => 'list'])->middleware(['auth']);
    Route::get('/completed', ['uses' => 'TaskController@completedTask', 'as' => 'completed'])->middleware(['auth']);
    Route::get('view/{id}',['uses' => 'TaskController@viewTask', 'as' => 'view']);

    Route::get('/edit/{id}', ['uses' => 'TaskController@edit', 'as' => 'edit'])->middleware(['auth','admin']);
    Route::post('/edit/{id}', ['uses' => 'TaskController@update'])->middleware(['auth','admin']);

    Route::post('/delete', ['uses' => 'TaskController@delete', 'as' => 'delete'])->middleware(['auth']);
});
