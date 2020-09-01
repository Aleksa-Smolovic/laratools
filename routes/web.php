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
});

// access to everyone
Route::get('/open-channel', function () {
    return view('index');
});

Route::get('send-to-all/', 'WebsocketController@sendPublicNotification');
Route::get('send-to-app-users/', 'WebsocketController@sendAppUsersNotification');
Route::get('send-to-specific-user/', 'WebsocketController@sendSpecifiUserNotification');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
