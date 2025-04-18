<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dinbandon', function () {
    return view('bandon');
});

Route::get('/meetroom', function () {
    return view('meetroom');
});
