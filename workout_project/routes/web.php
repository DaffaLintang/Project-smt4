<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Doctrine\DBAL\Logging\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('landingpage');
});

//Route::get('/dashboard', function () {
  //  return view('user.dashboardUser');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', AdminMiddleware::class])->name('admin.dashboard');

Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', AdminMiddleware::class]) // Pastikan namespace middleware benar
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/admin/bmi', [App\Http\Controllers\Admin\BMIController::class, 'index'])->name('admin.bmi');

// Route::middleware('guest')->group(function () {
//     Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
//     Route::post('register', [RegisteredUserController::class, 'store']);

//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('login', [AuthenticatedSessionController::class, 'store']);
// });
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');


    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


});

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::resource('users', UserController::class);
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/admin/results', [ResultController::class, 'index'])->name('admin.results');
Route::resource('results', ResultController::class);

// Menampilkan daftar workout di halaman admin
Route::get('/admin/workouts', [WorkoutController::class, 'index'])->name('admin.workouts');

// Resource Controller untuk CRUD Workout
Route::resource('workouts', WorkoutController::class);


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); // Redirect ke halaman login
})->name('logout');
Route::get('/admin/latihan', [LatihanController::class, 'index'])->name('admin.latihan');




// Route::get('/landingpage', function () {
//     return view('landingpage');
// });
require __DIR__.'/auth.php';
