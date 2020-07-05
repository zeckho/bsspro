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

Route::get('/status', 'UserController@userOnlineStatus');

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles','RoleController');
});
Route::group(['middleware' => ['role:superadmin|admin|trainer']], function () {
    Route::resource('courses', 'CourseController');
    Route::resource('lessons', 'LessonController');
    Route::resource('libraries', 'LibraryController');
    Route::resource('classes', 'ClassController', ['except' => 'index']);
    Route::get('/lessons/create/{course?}', 'LessonController@create')->name('lessons.create');
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function() {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
Route::group(['middleware' => ['auth', 'role:user|superadmin']], function () {
    Route::get('classes', 'ClassController@index')->name('classes.index');
    Route::get('/myclass', 'ClassController@myClasses')->name('classes.myClasses');
    Route::get('classes/learn/{id}', 'ClassController@learn')->name('classes.learn');
    Route::get('classes/view/{id}', 'ClassController@view')->name('classes.view');
});