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

Route::group(['prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin'], function ()
{
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
}
);
