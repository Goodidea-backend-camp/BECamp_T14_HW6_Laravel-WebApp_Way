<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MeetingController;
use Illuminate\Contracts\Session\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('meetings')->group(function () {
    Route::get('/', [MeetingController::class, 'index']);
    Route::post('/', [MeetingController::class, 'store']);
    Route::get('rooms/', function () {
        return view('login');
    });
});



Route::middleware('auth')->prefix('dinbandon')->group(function () {
    Route::get('/', function () {
        return view('bandon');
    });
});

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);
