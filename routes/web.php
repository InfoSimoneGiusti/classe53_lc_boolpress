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





//www.miosito.it/login
Auth::routes();


//www.miosito.it/admin/*
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {

        // /admin
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('posts', 'PostController');

        Route::resource('tags', 'TagController');


        Route::get('user', 'UserController@edit')->name('user.edit');
        Route::put('user', 'UserController@update')->name('user.update');

        Route::get('user/getMyAvatar', 'UserController@getMyAvatar')->name('user.getMyAvatar');

    });

//www.miosito.it/qualsiasi cosa non precedentemente definita
Route::get('{any?}', function() {
    return view('guests.home');
})->where('any', '.*');

