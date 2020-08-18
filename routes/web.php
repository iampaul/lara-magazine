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

Route::group(['prefix' => 'admin'], function () { 

	Route::get('/login', 'admin\Admin@getLogin')->name('get:admin:login');
	Route::post('/login', 'admin\Admin@postLogin')->name('post:admin:login');

	Route::group(['middleware' => ['admin_auth']], function () 
	{
		Route::get('/logout', 'admin\Admin@getLogout')->name('get:admin:logout');
		Route::get('/', 'admin\Admin@getDashboard')->name('get:admin:dashboard');
		Route::resource('magazines', 'admin\Magazines');
	});	

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::post('createSubscription', 'HomeController@postCreateSubscription')->name('createSubscription');
	Route::get('mysubscriptions', 'HomeController@getmysubscriptions')->name('mysubscriptions');
});