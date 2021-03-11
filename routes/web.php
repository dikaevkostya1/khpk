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
Route::post('/ajax/feedback', 'HomeController@feedback');
Route::get('/ajax/filter', 'HomeController@filter');

Route::get('/request', 'RequestController@index');

Route::get('/request/enrolle', 'EnrolleController@index')->name('enrolle');
Route::post('/ajax/request/enrolle', 'EnrolleController@enrolle');
Route::get('/request/enrolle/email/verified', 'EnrolleController@email_verified_show')->name('email_verified');
