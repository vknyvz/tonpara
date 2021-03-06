<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
  Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
  
  Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
    Route::get('/list',           ['as' => 'index',        'uses' => 'UserController@index']);
    Route::any('/create',         ['as' => 'create',       'uses' => 'UserController@create']);
    Route::any('/update/{user}',  ['as' => 'update',       'uses' => 'UserController@update']);
    
    Route::get('/bind/{user_id}/{admin_id}', ['as' => 'bind',       'uses' => 'UserController@bindUser']);
    Route::get('/unbind/{id}', ['as' => 'unbind',       'uses' => 'UserController@unbindUser']);
    
    Route::any('/data',           ['as' => 'data',         'uses' => 'UserController@data']);
  });
  
  Route::group(['prefix' => 'log', 'as' => 'log.'], function() {
    Route::get('/list',           ['as' => 'index',        'uses' => 'LogController@index']);
  });
});