<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoritController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ResultWorkoutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

Route::apiResource('/users', UserController::class)->except(['store'])->middleware('auth:sanctum');
Route::post('/users', [UserController::class, 'store']);

Route::apiResource('/resultWo', ResultWorkoutController::class)->middleware('auth:sanctum');
Route::apiResource('/historiWo', HistoritController::class)->middleware('auth:sanctum');

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
});
