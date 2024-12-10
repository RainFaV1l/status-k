<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\PostController;

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

Route::group([
    'middleware' => ['auth.ban'],
], function () {
    Route::controller(PostController::class)->name('post.')->prefix('posts')->group(function () {
       Route::get('/', 'index')->name('index');
       Route::get('/filters/{category?}', 'index')->name('filter');
       Route::get('/show/{id}', 'show')->name('show');
       Route::get('/create', 'create')->name('create');
       Route::get('{id}/edit', 'edit')->name('edit');
       Route::post('{id}/update', 'update')->name('update');
       Route::post('{id}/destroy', 'destroy')->name('destroy');
       Route::post('/', 'store')->name('store');
    });
});
