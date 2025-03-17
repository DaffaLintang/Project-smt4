<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/users', UserController::class);
