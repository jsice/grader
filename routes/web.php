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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/problems', 'ProblemsController@index');
Route::get('/problems/{id}', 'ProblemsController@show');
Route::put('/problems/{id}', 'ProblemsController@update');

Route::get('/scoreboard', 'ScoreboardController@index');

Route::get('/users', 'UsersController@index');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/users', 'UsersController@create');

Route::get('/submissions', 'SubmissionsController@index');
Route::get('/submissions/{id}', 'SubmissionsController@show');

