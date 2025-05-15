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
    Route::get('{id}/edit', [MeetingController::class, 'edit'])->where('id', '[0-9]+');
    Route::post('/', [MeetingController::class, 'store']);
    Route::patch('{id}', [MeetingController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('{id}', [MeetingController::class, 'destroy'])->where('id', '[0-9]+');
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
