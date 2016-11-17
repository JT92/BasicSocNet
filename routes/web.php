<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * USER CONTROLLER ROUTES
 * These routes are used by the user controller
 * These include account settings and login/logouts
 */

Route::post('/register', [
    'uses' => 'UserController@postRegister',
    'as' => 'register'
]);

Route::post('/login', [
    'uses' => 'UserController@postLogIn',
    'as' => 'account.login'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'account.logout'
]);

Route::get('/account', [
    'uses' => 'UserController@getShowAccount',
    'as' => 'account.edit'
])->middleware('auth');;

Route::post('/editaccount', [
    'uses' => 'UserController@postEditAccount',
    'as' => 'account.save'
]);

Route::get('/userimage/{filename}', [
    'uses' => 'UserController@getUserImage',
    'as' => 'account.image'
]);

/**
 * POST CONTROLLER ROUTES
 * These routes are used by the post controller
 * they allow for the manipulation of post objects
 */

Route::get('/dashboard', [
   'uses' => 'PostController@getDashboard',
    'as' => 'dashboard'
])->middleware('auth');

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create'
]);

Route::post('/like', [
    'uses' => 'PostController@postLikePost',
    'as' => 'post.like'
]);

Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete'
]);

Route::post('/edit-post', [
    'uses' => 'PostController@postEditPost',
    'as' => 'post.edit'
]);

