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
    Route::resource('lightning', 'LightningController');
    Route::resource('users', 'UserController');
    Route::delete('posts/{slug}/img', 'PostController@delImg')->name('post-img-del');
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
    Route::get('profile', 'UserController@index')->name('user.index');
    Route::put('profile', 'UserController@update')->name('user.update');
    Route::get('logout', 'UserController@logout')->name('user.logout');
    Route::delete('users/{id}/avatar', 'UserController@deleteAvatar')->name('user-avatar-del');
    Route::post('post/{slug}/comment', 'CommentController@store')->name('comment.store');
    Route::put('post/{slug}/comment/{id}', 'CommentController@update')->name('comment.update');
    Route::delete('post/{slug}/comment/{id}', 'CommentController@destroy')->name('comment.destroy');
});

Route::group(['namespace' => 'App\Http\Controllers'], function ()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('category', 'CategoryController');
    Route::get('categories', 'HomeController@categoryIndex')->name('category.index');
    Route::get('categories/{slug}', 'HomeController@categoryShow')->name('category.show');
    Route::get('post/{slug}', 'HomeController@postShow')->name('post.show');
    Route::get('tag/{slug}', 'HomeController@tagShow')->name('tag.show');
    Route::get('search', 'HomeController@search')->name('post.search');
});


