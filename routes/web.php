<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('dashboard');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin/{tournament_id}', 'AdminPanelController@index')->name('admin.index');
Route::get('/admin/{tournament_id}/show/{user_id}', 'AdminPanelController@show')->name('admin.show');
Route::get('/admin/{tournament_id}/create/{user_id}', 'AdminPanelController@create')->name('admin.show');
Route::post('/admin/{tournament_id}/edit/{user_id}', 'AdminPanelController@edit')->name('admin.edit');
Route::get('/admin/{tournament_id}/destroy/{user_id}', 'AdminPanelController@destroy')->name('admin.destroy');


/* Account settings */
Route::middleware(['auth'])->group(function () {
        Route::get('/user/settings', 'UserController@show')
        ->name('user.index');
        Route::post('/user/settings/update', 'UserController@update')
        ->name('user.update');
        Route::get('/dashboard', 'HomeController@dashboard')
        ->name('dashboard');
});

// Route::get('/tournament/{id}/admin');

Route::get('/tournament/{id}/join', 'TournamentUserRoleController@joinParticipant')
    ->name('tournament.join');
Route::get('/tournament/{id}/edit', 'TournamentController@edit')
    ->name('tournament.edit');
Route::get('/tournament/{id}/destroy', 'TournamentController@destroy')
    ->name('tournament.destroy');
Route::resources([
    'tournament' => 'TournamentController',
]);
