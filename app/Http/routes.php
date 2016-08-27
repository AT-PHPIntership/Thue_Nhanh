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

Route::get('register/verify/{id}/{validationCode}', [
    'as' => 'auth.verify',
    'uses' => 'Auth\AuthController@confirm'
]);
