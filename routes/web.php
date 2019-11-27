<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['setLanguage'])->group(function () {
    Auth::routes();

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
    Route::get('/widget', 'HomeController@widget')
        ->name('widget.index');
    Route::get('/widget/{widgetName}, HomeController@widgetEdit')
        ->name('widget.edit');
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
    Route::get('/tournament/{tournamentId}/admin/add/{userId}', 'TournamentAdminController@addReferee')
        ->name('tournament.addReferee');
    Route::get('/tournament/{tournamentId}/admin/deny/{userId}', 'TournamentAdminController@denyReferee')
        ->name('tournament.denyReferee');
    Route::get('/tournament/{tournamentId}/admin/referee', 'TournamentAdminController@showReferee')
        ->name('tournament.showReferee');   
    Route::get('/tournament/{tournamentId}/admin/starttournament', 'TournamentAdminController@adminStartTournament')
        ->name('tournament.admin.start');    
});

// 'Widget' from dashboard
Route::get('/stats','HomeController@stats')->name('stats');
});