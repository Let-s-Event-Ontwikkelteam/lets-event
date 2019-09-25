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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminPanelController@index')->name('admin.index');
Route::get('/admin/show/{id}', 'AdminPanelController@show')->name('admin.show');
Route::post('/admin/edit/{id}', 'AdminPanelController@edit')->name('admin.edit');
Route::get('/admin/destroy/{id}', 'AdminPanelController@destroy')->name('admin.destroy');
