<?php

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

Route::get('/', function () {
    return view('frontend.layouts.master');
});

Route::auth();

Route::get('/logout', ['uses' => 'Auth\SessionsController@logout', 'as' => 'logout']);

Route::get('/login', ['uses' => 'Auth\SessionsController@showLoginForm', 'as' => 'login']);

Route::post('/login', ['uses' => 'Auth\SessionsController@login', 'as' => 'auth.login']);

Route::get('/register', ['uses' => 'Auth\AuthController@showRegistrationForm', 'as' => 'register']);

Route::post('/register', ['uses' => 'Auth\AuthController@register', 'as' => 'auth.register']);


Route::get('register/verify/{id}/{validationCode}', [
    'as' => 'auth.verify',
    'uses' => 'Auth\AuthController@confirm'
]);
