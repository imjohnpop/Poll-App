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

Route::get('/homepage', 'indexController@index');
Route::get('/list', 'listController@list');
Route::post('/list', 'listController@vote');
Route::get('/profile', 'profileController@show');

Auth::routes();

Route::get('/', function () {
    return redirect('/homepage');
});
Route::get('/home', function () {
    return redirect('/homepage');
});