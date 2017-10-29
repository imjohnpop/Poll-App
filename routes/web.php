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
Route::get('/poll/{id}', 'listController@view');
Route::post('/poll/{id}', 'listController@vote');
Route::get('/profile', 'profileController@show')->middleware('auth');
Route::post('/profile', 'profileController@store');
Route::get('/profile/{idcko}', 'profileController@destroy');
Route::get('/edit/{idcko}', 'profileController@edit_view')->middleware('auth');
Route::post('/edit/{idcko}', 'profileController@update');

Auth::routes();

Route::get('/homepage', function () {
    return redirect('/');
});
Route::get('/home', function () {
    return redirect('/');
});