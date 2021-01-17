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

Route::middleware(['auth','admin'])->group(function(){
    
    Route::get('/admin','TestController@admin');
    
});

Route::middleware('vermail')->group(function(){
    
    Route::get('/vermail', 'TestController@ver_email');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/route-1', function(){
    return 'Terima Kasih Email Anda Sudah Terverifikasi';
})->middleware(['auth','email_verified']);

Route::get('/route-2', function(){
    return 'Anda Masuk Sebagai Admin';
})->middleware(['auth','email_verified','admin']);