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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/search/{search_term}', 'TradesController@search');
Route::post('/add_trade/{ticker}', 'TradesController@addTrade');
Route::post('/delete_trade/{ticker}', 'TradesController@deleteTrade');
Route::get('/trades', 'TradesController@tradeHistory');

Route::get('/settings', 'SettingsController@index');
Route::post('/update_profile', 'SettingsController@updateProfile');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');