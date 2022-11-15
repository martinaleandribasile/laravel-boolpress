<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('guests.home');
})->name('index');


Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('index');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
    });
Auth::routes();


// va messa alla fine (il file viene letto dall alto al basso), -> quando si verificano rotte non sopra delineate any-> prende qualsiasi parametro dopo lo /
Route::get('{any?}', function () {
    return redirect()->route('index');
})->where('any', '.*');
