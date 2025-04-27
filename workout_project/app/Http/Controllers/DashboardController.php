<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\BMI;
use App\Models\User; // Import model User
use Illuminate\Http\Request;
use App\Models\Result;
class DashboardController extends Controller
{
    public function index()
    {
        $totalWorkouts = Workout::count();
        $totalBMI = BMI::count();
        $totalUsers = User::count(); // Menghitung total user
        $totalResults = Result::count(); 
        return view('admin.dashboard', [
            'totalWorkouts' => $totalWorkouts,
            'totalBMI' => $totalBMI,
            'totalUsers' => $totalUsers,
            'totalResults' => $totalResults 
        ]);
    }
}