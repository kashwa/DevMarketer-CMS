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

Route::middleware('auth:api')->group(function () {

    # link will be :- [devmarketer.com/api/posts/unique/....]
    Route::get('/posts/unique', 'PostController@apiCheckUnique')->name('api.posts.unique');
    
    # Counter increase route API.
    Route::put('posts/{id}', 'PostController@commentCounter')->name('manage.post');

    # Resource route for the Posts api.
    Route::apiResource('/posts', 'PostController');

    # Resource route for Users api.
    Route::apiResource('/users', 'UserController');
});
