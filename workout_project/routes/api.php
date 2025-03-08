<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/recomend', [WorkoutController::class, 'recomend']);
