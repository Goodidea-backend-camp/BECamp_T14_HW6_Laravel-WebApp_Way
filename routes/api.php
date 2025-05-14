<?php

use App\Http\Controllers\MeetingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/meetings/availability', [MeetingController::class, 'avaiableTime']);
Route::post('/people/availability', [MeetingController::class, 'avaiablePeople']);
