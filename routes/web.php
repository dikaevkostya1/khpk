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

// главная страница
Route::get('/', 'HomeController@index')->name('home'); 
Route::post('/ajax/feedback', 'HomeController@feedback');
// главная страница

// страница отправки заявки
Route::match(['get', 'post'], '/request', 'RequestController@index')->name('request');
Route::post('/request/push', 'RequestController@push');
Route::prefix('request/verify')->group(function () {
    Route::view('/change', 'change_mail')->middleware('auth'); 
    Route::post('/change', 'ChangeMailController');
    Route::get('/code', 'CodeSendMailController');
});
// страница отправки заявки

// страница входа 
Route::get('/login', 'LoginEnrolleController@index')->name('login');
Route::prefix('login/enrolle')->group(function () {
    Route::post('', 'LoginEnrolleController@login');
    Route::post('/reset/password', 'LoginEnrolleResetPasswortController@push');
    Route::view('/reset/password', 'reset_password_token')->name('reset_password_view');
    Route::get('/reset/password/{token}', 'LoginEnrolleResetPasswortController@auth')->name('reset_password');
    Route::post('/reset/password/{token}', 'LoginEnrolleResetPasswortController@reset');
});
Route::get('/logout/enrolle', 'LoginEnrolleController@logout')->middleware('auth');
// страница входа

// страница входа администратора
Route::get('/admin', 'LoginAdminController@index')->name('login_admin');
Route::post('/login/admin', 'LoginAdminController@enrolle');
// страница входа администратора

// странца личного кабинета
Route::get('/rating', 'RatingController@index')->name('rating');
// странца личного кабинета