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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes([
    'register' => false
]);

//HomeController
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

//KategoriController
Route::get('kategori', 'KategoriController@index')->name('kategori');
Route::get('create/kategori', 'KategoriController@create')->name('create.kategori');
Route::post('save/kategori', 'KategoriController@store')->name('store.kategori');
Route::get('edit/kategori/{id}', 'KategoriController@edit')->name('edit.kategori')->where('id', '[0-9]+');
Route::post('update/kategori/{id}', 'KategoriController@update')->name('update.kategori')->where('id', '[0-9]+');
Route::post('delete/kategori/{id}', 'KategoriController@destroy')->name('destroy.kategori')->where('id', '[0-9]+');

//TransaksiController
Route::get('transaksi', 'TransaksiController@index')->name('transaksi');
Route::get('create/transaksi', 'TransaksiController@create')->name('create.transaksi');
Route::post('save/transaksi', 'TransaksiController@store')->name('store.transaksi');
Route::get('edit/transaksi/{id}', 'TransaksiController@edit')->name('edit.transaksi')->where('id', '[0-9]+');
Route::post('update/transaksi/{id}', 'TransaksiController@update')->name('update.transaksi')->where('id', '[0-9]+');
Route::get('delete/transaksi/{id}', 'TransaksiController@destroy')->name('destroy.transaksi')->where('id', '[0-9]+');
