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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::get('/list/{id}', 'TicketController@list')->name('list');
    Route::get('/createticket/{id}', 'TicketController@createticket')->name('ticketonly');
    Route::post('/ticketstore', 'TicketController@ticketstore')->name('ticketstore');
    Route::post('/update/{id}', 'TicketController@updateticket')->name('ticketupdate');
    // Route::post('/list/{$id}', 'TicketController@list')->name('list');
    Route::resource('tickets', 'TicketController');
    Route::resource('comments', 'CommentController');
    Route::get('/search','SearchController@index')->name('search');
    Route::get('/search/find','SearchController@search');
});


