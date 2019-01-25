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

Route::get('/problems/create', 'ProblemsController@create')->middleware(['auth', 'is_admin']);
Route::get('/problems', 'ProblemsController@index');
Route::get('/problems/{id}', 'ProblemsController@show')->middleware(['problem']);
Route::post('/problems', 'ProblemsController@store')->middleware(['auth', 'is_admin']);
Route::get('/problems/{id}/edit', 'ProblemsController@edit')->middleware(['auth', 'is_admin']);
Route::put('/problems/{id}', 'ProblemsController@update')->middleware(['auth', 'is_admin']);
Route::put('/problems/{id}/status', 'ProblemsController@updateStatus')->middleware(['auth', 'is_admin']);
Route::delete('/problems/{id}', 'ProblemsController@destroy')->middleware(['auth', 'is_admin']);

Route::get('/scoreboard', 'ScoreboardController@index');

Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users', 'UsersController@store');

Route::get('/submissions', 'SubmissionsController@index');
Route::get('/submissions/{id}', 'SubmissionsController@show')->middleware(['auth', 'is_admin']);
Route::get('/problems/{id}/submit', 'SubmissionsController@create')->middleware(['auth', 'problem']);
Route::post('/problems/{id}/submit', 'SubmissionsController@store')->middleware(['auth', 'problem']);
Route::get('/submissions/{id}/edit', 'SubmissionsController@edit')->middleware(['auth', 'is_admin']);
Route::put('/submissions/{id}', 'SubmissionsController@update')->middleware(['auth', 'is_admin']);

Route::get('pdf/{folder}/{filename}', function ($folder, $filename)
{
    $path = storage_path('app/problems/'.$folder.'/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    if ($type!=="application/pdf") {
        abort(403);
    }

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;


});


Route::get('code/{id}', function ($id)
{
    $submission = \App\Submission::where('id', $id)->first();
    $path = storage_path('app\\submissions\\'.$submission->file_path);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;


})->middleware(['auth', 'is_admin']);

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


