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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('messages', 'MessageController')->middleware('auth');
Route::resource('notifications', 'NotificationController')->middleware('auth');
Route::put('notifications/read/{id}','NotificationController@read')->name('notifications.read');
Route::get('event_notifications','NotificationController@event')->name('notifications.event');
