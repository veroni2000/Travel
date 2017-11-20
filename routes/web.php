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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','HomeController@show')->name('get_flights');

Route::get('user/create', 'UserController@create')->name('add_new_user');
Route::get('user', 'UserController@index')->name('get_all_users');
Route::get('user/{$id}/edit', 'UserController@edit')->name('edit_user_info');
Route::get('user/{user_id}/delete', [
			'uses'	=> 'UserController@destroy',
			'as'	=> 'delete_user'
			]);
Route::get('Travel/index', 'TravelController@index')->name('moreinfo');


Route::resource('travel', 'TravelController');