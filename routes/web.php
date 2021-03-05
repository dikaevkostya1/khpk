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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/feedback', 'HomeController@feedback');
Route::get('/ajax/filter', 'HomeController@filter');

Route::match(['get', 'post'], '/request', 'RequestController@index')->name('request');