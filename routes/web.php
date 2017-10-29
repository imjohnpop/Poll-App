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

Route::get('/', 'indexController@index');
Route::get('/list', 'listController@list');
Route::post('/list', 'listController@store');
Route::get('/list/{id}', 'listController@list');
Route::post('/list/{id}', 'listController@vote');
Route::get('/profile', 'profileController@show');
Route::get('/profile/{idcko}', 'profileController@destroy');
Route::post('/profile', 'profileController@store');



Auth::routes();

Route::get('/homepage', function () {
    return redirect('/');
});
Route::get('/home', function () {
    return redirect('/');
});