<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/bookmeeting', [MeetingController::class, 'avaiableTime']);
Route::post('/avaiablepeople', [MeetingController::class, 'avaiablePeople']);
