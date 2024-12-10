<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Models\User;
use Modules\Auth\Http\Controllers\ChatController;

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

Route::get('/email/verify', fn () => view('auth::verify-email'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::redirect('login', 'loginView')->name('login');

Route::controller(ChatController::class)->middleware(['auth', 'auth.ban'])->name('chat.')->prefix('chat')->group(function () {
    Route::get('/messages/{user}', 'message')->name('messages')->middleware('auth.chat');
    Route::post('/messages/{user}', 'send')->name('send')->middleware('auth.chat');
    Route::get('/', 'index')->name('index');
    Route::get('/{user}', 'show')->name('show')->middleware('auth.chat');
});


Route::controller(AuthController::class)->name('auth.')->middleware('auth.ban')->group(function () {
    Route::get('/login', 'loginView')->name('loginView');
    Route::get('/register', 'registerView')->name('registerView');
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/profile', 'profile')->middleware(['auth', 'verified'])->name('profile');
});
