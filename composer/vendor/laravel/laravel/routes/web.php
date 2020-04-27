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

Route::get('test/show', 'TestController@show');

Route::match(['get', 'post'], 'test/form', 'TestController@form');

//Route::get('test/form', 'TestController@form');
//Route::post('test/form', 'TestController@form');

//Route::post('test/result', 'TestController@result');

Route::get('test/show1', 'TestController@show1');

Route::get('test/show2/{param}', 'TestController@show2');
