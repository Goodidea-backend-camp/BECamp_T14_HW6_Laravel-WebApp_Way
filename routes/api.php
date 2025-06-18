<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/meetings/availability', [MeetingController::class, 'getAvaiableTime']);
Route::post('/people/availability', [MeetingController::class, 'getAvaiablePeople']);
