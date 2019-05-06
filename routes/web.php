<?php

// use Illuminate\Support\Facades\Redis;

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

Route::get('/', 'HomeController@index');

// Route::get('/', function () {
//     Redis::set('fal', 'mal');

//     return Redis::get('fal');
// });

// Route::get('/', function () {
//     phpinfo();
// });


Route::get('/statuses', 'StatusesController@index');

Route::post('/statuses', 'StatusesController@store');

// Route::get('/statuses', function () {
//     return App\Status::with('user')->latest()->get();
// });