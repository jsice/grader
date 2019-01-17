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

Route::redirect('/', '/problems');

Auth::routes();

Route::get('/problems/create', 'ProblemsController@create');
Route::get('/problems', 'ProblemsController@index');
Route::get('/problems/{id}', 'ProblemsController@show');
Route::post('/problems', 'ProblemsController@store');
Route::get('/problems/{id}/edit', 'ProblemsController@edit');
Route::put('/problems/{id}', 'ProblemsController@update');
Route::delete('/problems/{id}', 'ProblemsController@destroy');

Route::get('/scoreboard', 'ScoreboardController@index');

Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users', 'UsersController@store');

Route::get('/submissions', 'SubmissionsController@index');
Route::get('/submissions/{id}', 'SubmissionsController@show');
Route::get('/problems/{id}/submit', 'SubmissionsController@create');
Route::post('/submissions', 'SubmissionsController@store');
Route::get('/submissions/{id}/edit', 'ProblemsController@edit');
Route::put('/submissions/{id}', 'ProblemsController@update');

Route::get('{folder}/{filename}', function ($folder, $filename)
{
    $path = storage_path('app/public/'.$folder.'/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;


});
