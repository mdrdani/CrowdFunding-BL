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

Route::middleware(['auth','admin','vermail'])->group(function(){
    
    Route::get('/admin','TestController@admin');
    Route::get('/vermail', 'TestController@ver_email');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');