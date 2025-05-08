<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Contracts\Session\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dinbandon', function () {
    return view('bandon');
});

Route::get('/meetroom', function () {
    return view('meetroom');
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
