<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/workout', [WorkoutController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users', function () {
    return view('users.index'); // Buat file ini nanti jika diperlukan
})->name('users.index');

Route::get('/settings', function () {
    return view('settings'); // Buat file ini nanti jika diperlukan
})->name('settings');

Route::get('/logout', function () {
    // Tambahkan logika logout di sini
    return redirect('/login');
})->name('logout');



