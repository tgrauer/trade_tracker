<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');
Route::view('/login', 'auth.login');
Auth::routes();

Route::get('/home', 'StockController@index')->name('home');

Route::post('/search/{search_term}', 'StockController@search');
Route::post('/add_trade/{ticker}', 'StockController@addTrade');
Route::get('/trades', 'StockController@tradeHistory');

Route::get('/settings', 'SettingsController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');