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


Route::group(['prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin', 'middleware' => 'admin'], function ()
{
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('posts', 'PostController');
    Route::get('posts/{slug}/del-img', 'PostController@delImg')->name('img-post-del');
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'guest'], function ()
{
    Route::get('register', 'UserController@regCreate')->name('user.registration.create');
    Route::post('register', 'UserController@regStore')->name('user.registration.store');
    Route::get('login', 'UserController@authCreate')->name('user.login.create');
    Route::post('login', 'UserController@authStore')->name('user.login.store');
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function ()
{
    Route::get('logout', 'UserController@logout')->name('user.logout');
});


Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

