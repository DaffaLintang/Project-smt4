<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\DashboardController;
use App\Models\Histori;

// Halaman Landing Page
Route::get('/', function () {
    return view('landingpage');
});

// Admin Dashboard (Hanya untuk Admin)
Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', AdminMiddleware::class])
    ->name('admin.dashboard');

// Halaman Profile (Untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman BMI Admin
Route::get('/admin/bmi', [App\Http\Controllers\Admin\BMIController::class, 'index'])->name('admin.bmi');

// Halaman Login dan Register (Guest)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Admin Users
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::resource('users', UserController::class);

// Admin Results
Route::get('/admin/results', [ResultController::class, 'index'])->name('admin.results');
Route::resource('results', ResultController::class);

// Admin Workouts
Route::get('/admin/workouts', [WorkoutController::class, 'index'])->name('admin.workouts');
Route::resource('workouts', WorkoutController::class);

Route::get('/workout-distribution', function () {
    $data = Histori::select('kesulitan')
        ->get()
        ->groupBy('kesulitan')
        ->map(fn($group) => $group->count());

    return response()->json([
        'Beginner' => $data['Beginner'] ?? 0,
        'Intermediate' => $data['Intermediate'] ?? 0,
        'Expert' => $data['Expert'] ?? 0,
    ]);
});

// Admin Latihan
Route::get('/admin/latihan', [LatihanController::class, 'index'])->name('admin.latihan');

Route::get('/test-mongodb', function () {
    try {
        // Cek koneksi MongoDB
        $databaseName = DB::connection('mongodb')->getDatabaseName();
        
        // Cek apakah model User dapat diakses
        $user = \App\Models\User::first(); // Mengambil data pengguna pertama

        if ($user) {
            return "Koneksi MongoDB berhasil ke database: " . $databaseName . ". Pengguna pertama: " . $user->name;
        } else {
            return "Koneksi MongoDB berhasil ke database: " . $databaseName . ". Tidak ada pengguna yang ditemukan.";
        }
        
    } catch (\Exception $e) {
        return "Gagal terhubung ke MongoDB: " . $e->getMessage();
    }
});

// Test route untuk melihat halaman reset password
Route::get('/test-reset-password', function () {
    return view('auth.halamanforgotpw', [
        'token' => 'test-token',
        'email' => 'test@example.com'
    ]);
});

// Pastikan untuk memuat file auth
require __DIR__.'/auth.php';
