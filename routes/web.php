<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', 'WelcomeController@index')
    ->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::resource('/task_statuses', 'TaskStatusController');

Route::resource('/tasks', 'TaskController');

Route::resource('/labels', 'LabelController');

Route::resource('/tasks.comments', 'Task\CommentController');
