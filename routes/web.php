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


