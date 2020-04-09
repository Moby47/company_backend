<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/posts', 'BlogController');
Route::apiResource('/projects', 'ProjectController');
Route::apiResource('/reviews', 'ReviewController');
//Route::apiResource('/contact', 'ContactController');

//view all blog posts
Route::get('/posts', 'BlogController@index')->middleware('auth.apikey');
//view a single post
Route::get('/posts/{id}/{slug?}', 'BlogController@show')->middleware('auth.apikey');


//view all projects
Route::get('/projects', 'ProjectController@index')->middleware('auth.apikey');
//Counts projects
Route::get('/project-count', 'ProjectController@project_count')->middleware('auth.apikey');

//view all reviews
Route::get('/reviews', 'ReviewController@index')->middleware('auth.apikey');