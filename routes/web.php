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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//admin routes

Route::post('/create-post', 'BlogController@create_post')->name('create-post');
Route::get('/get-post', 'BlogController@getPosts');
Route::get('/delete/{id}', 'BlogController@deletePost')->name('delete-post');

Route::post('/new-project', 'ProjectController@addProject')->name('add-project');
Route::get('/get-projects', 'ProjectController@getProjects');
Route::get('/delete-project/{id}', 'ProjectController@deleteProject');