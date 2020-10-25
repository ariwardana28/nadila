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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','BayarController@index');


// Route::get('/', 'MenuController@index'); // localhost:8000/
Route::get('/getUsers/{id}','MenuController@getUsers');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Menu
Route::prefix('/menu')->group(function(){
    Route::get('/','MenuController@index')->name('menu.index');
    Route::get('/create','MenuController@create')->name('menu.create');
    Route::post('/create/store','MenuController@store')->name('menu.store');
    Route::get('/edit/{id}','MenuController@edit')->name('menu.edit');
    Route::post('/update/{id}','MenuController@update')->name('menu.update');
    Route::delete('/destroye/{$id}','MenuController@destroy')->name('menu.destroy');
});

// penjualan User
Route::prefix('/penjualan')->group(function(){
    Route::get('/','PenjualanController@index')->name('penjualan.index');
    Route::get('/create','PenjualanController@create')->name('penjualan.create');
    Route::post('/store','PenjualanController@store')->name('penjualan.store');
    Route::post('/storeBayar','PenjualanController@storeBayar')->name('penjualan.storeBayar');
    Route::post('/storeBayarDet','PenjualanController@storeBayarDet')->name('penjualan.storeBayarDet');
    Route::get('/menuBayar','PenjualanController@menuBayar')->name('penjualan.menuBayar');
    Route::get('/show/{id}','PenjualanController@show')->name('penjualan.show');
    Route::post('/bayar/{id}','PenjualanController@bayar')->name('penjualan.bayar');
    Route::get('/detail/{id}','PenjualanController@detail')->name('penjualan.detail');
    Route::post('/{id}/hapus', 'PenjualanController@shapus')->name('barang.hapus');
});

Route::prefix('/admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});

Route::prefix('/kasir')->group(function(){
    Route::get('/', 'KasirController@index')->name('kasir');
    Route::get('/login', 'Auth\KasirLoginController@showLoginForm')->name('kasir.login');
    Route::post('/login', 'Auth\KasirLoginController@login')->name('kasir.login.submit');
    Route::get('/penjualan', 'KasirController@penjualan')->name('kasir.penjualan');
    Route::get('/penjualan/show/{id}', 'KasirController@show')->name('kasir.show');
    Route::post('/penjualan/bayar/{id}', 'KasirController@bayar')->name('kasir.bayar');
    Route::post('/penjualan/kirim/{id}', 'KasirController@kirim')->name('kasir.kirim');
    Route::get('/print/{id}', 'KasirController@print')->name('kasir.print');
    
});


Route::prefix('/laporan')->group(function(){
    Route::get('/', 'LaporanPenjualanController@index')->name('laporan.index');
});
