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
    Route::get('/list',               ['as' => 'index',        'uses' => 'UserController@index']);
    Route::any('/create',         ['as' => 'create',       'uses' => 'UserController@create']);
    Route::any('/update/{skin}',  ['as' => 'update',       'uses' => 'UserController@update']);
    Route::any('/data',           ['as' => 'data',         'uses' => 'UserController@data']);
  });
});