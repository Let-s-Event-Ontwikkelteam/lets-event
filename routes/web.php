<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Todo: Twee dezelfde routes die door dezelfde controller method worden aangeroepen?
Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/', 'HomeController@index')->name('home');

/* Account en dashboard routes. */
Route::middleware(['auth'])->group(function () {
        Route::get('/user/settings', 'UserController@show')
        ->name('user.index');
        Route::post('/user/settings/update', 'UserController@update')
        ->name('user.update');
        Route::get('/dashboard', 'HomeController@dashboard')
        ->name('dashboard');
        Route::get('/dashboard/{id}/{tourneyTime}/leave', 'HomeController@leave')
            ->name('dashboard.leave');
});

// Tournament controller routes.
Route::resource('tournament', 'TournamentController');
Route::get('/tournament/{tournament}/join', 'TournamentController@join')
    ->name('tournament.join');

// Tournament admin controller routes.
Route::get('/tournament/{tournamentId}/admin', 'TournamentAdminController@show')
    ->name('tournament.admin.show');
Route::delete('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@deleteUser')
    ->name('tournament.admin.deleteUser');
Route::post('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@storeUser')
    ->name('tournament.admin.storeUser');

