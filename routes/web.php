<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

<<<<<<< Updated upstream
=======
Route::middleware(['setLanguage'])->group(function () {
    Auth::routes();
>>>>>>> Stashed changes

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
});

    // Tournament controller routes.
    Route::resource('tournament', 'TournamentController');
    Route::get('/tournament/{tournamentId}/join', 'TournamentController@join')
        ->name('tournament.join');
    Route::get('/tournament/{tournamentId}/requestReferee', 'TournamentController@requestReferee')
        ->name('tournament.requestReferee');
    Route::get('/tournament/{tournamentId}/deleteReferee', 'TournamentController@deleteReferee')
        ->name('tournament.deleteReferee');
    Route::get('/tournament/{tournamentId}/tournamentStartDateTime/{tournamentStartDateTime}/leave', 'TournamentController@leave')
        ->name('tournament.leave');

    // Temporary
    // Route::get('/tournament/sort', 'SortController@sortTournaments')->name('tournament.sort');

    // Tournament admin controller routes.
    Route::middleware(['auth', 'hasOrganizerRole'])->group(function () {
        Route::get('/tournament/{tournamentId}/admin', 'TournamentAdminController@show')
            ->name('tournament.admin.show');
        Route::delete('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@deleteUser')
            ->name('tournament.admin.deleteUser');
        Route::post('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@storeUser')
            ->name('tournament.admin.storeUser');
    });

<<<<<<< Updated upstream
// Temporary
Route::get('/tournament/sort', 'SortController@sortTournaments')->name('tournament.sort');

// Tournament admin controller routes.
Route::middleware(['auth', 'hasOrganizerRole'])->group(function () {
    Route::get('/tournament/{tournamentId}/admin', 'TournamentAdminController@show')
        ->name('tournament.admin.show');
    Route::delete('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@deleteUser')
        ->name('tournament.admin.deleteUser');
    Route::post('/tournament/{tournamentId}/admin/user/{userId}/role/{roleName}', 'TournamentAdminController@storeUser')
        ->name('tournament.admin.storeUser');

        
=======
    Route::get('/*', function($request, $statusCode) {
        return view('errors.custom', [], $statusCode);
    })->name('errors.custom');

    // test error 500 page
    Route::get('/error500','HomeController@testingError500');
>>>>>>> Stashed changes
});

// 'Widget' from dashboard
Route::get('/stats','HomeController@stats')->name('stats');
