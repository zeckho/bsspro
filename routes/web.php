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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles','RoleController');
});
Route::group(['middleware' => ['role:superadmin|admin|trainer']], function () {
    Route::resource('courses', 'CourseController');
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function() {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
