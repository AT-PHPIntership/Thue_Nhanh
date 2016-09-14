<?php

/*
|--------------------------------------------------------------------------
| Admin dashboard Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['Admin', 'Webmaster', 'Mod']], function () {
        Route::get('/post/waitcensor', ['uses' => 'Backend\PostController@waitCensor', 'as' => 'admin.post.waitcensor']);
    });
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['uses' => 'PostController@index', 'as' => 'home']);

Route::auth();

Route::get('/logout', ['uses' => 'Auth\SessionsController@logout', 'as' => 'logout']);

Route::get('/login', ['uses' => 'Auth\SessionsController@showLoginForm', 'as' => 'login']);

Route::post('/login', ['uses' => 'Auth\SessionsController@login', 'as' => 'auth.login']);

Route::get('/register', ['uses' => 'Auth\AuthController@showRegistrationForm', 'as' => 'register']);

Route::post('/register', ['uses' => 'Auth\AuthController@register', 'as' => 'auth.register']);

Route::get('register/verify/{id}/{validationCode}', ['uses' => 'Auth\AuthController@confirm', 'as' => 'auth.verify']);

// Signin via facebook api
Route::get('social/login/redirect/{provider}', ['uses' => 'Auth\AuthController@redirectToProvider', 'as' => 'social.login']);

Route::get('social/login/{provider}', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('post', 'PostController', ['except' => ['show', 'index']]);

    Route::resource('comment', 'CommentController', ['except' => ['destroy']]);

    Route::delete('/comment/{id?}', ['uses' => 'CommentController@destroy', 'as' => 'comment.destroy']);

    Route::get('/post/need/create/', ['uses' => 'PostController@showCreatingForm', 'as' => 'post.need_rent.create']);

    Route::post('/vote/create', ['uses' => 'VoteController@create', 'as' => 'vote.create']);

    Route::post('/report/store', ['uses' => 'ReportController@store', 'as' => 'report.store']);
});

Route::get('/post/{id}', ['uses' => 'PostController@show', 'as' => 'post.show']);

Route::get('/posts', ['uses' => 'PostController@index', 'as' => 'post.index']);

Route::get('/{category}/{post}.html', ['uses' => 'PostController@read', 'as' => 'post.read']);
