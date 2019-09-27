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

Route::get('/', 'HomeController@index')->name('dashboard');
Auth::routes();

/* Account settings */
Route::middleware(['auth'])->group(function () {
	Route::get('/user/settings', 'UserController@show')
        ->name('user.index');
	Route::post('/user/settings/update', 'UserController@update')
        ->name('user.update');
	Route::get('/dashboard', 'HomeController@dashboard')
        ->name('dashboard');
});

Route::get('/tournament/{id}/join', 'TournamentUserRoleController@joinParticipant')
    ->name('tournament.join');

Route::resources([
    'tournament' => 'TournamentController',
]);
