<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/workout', [WorkoutController::class, 'index']);

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

use App\Http\Controllers\DashboardController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware([])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});


