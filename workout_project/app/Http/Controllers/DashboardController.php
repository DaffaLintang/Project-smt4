<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Result;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWorkouts = Workout::count();
        $totalUsers = User::count();
        $totalResults = Result::count(); 
        $totalBMI = DB::connection('mongodb')->table('obesity')->count(); // Ambil dari MongoDB

        return view('admin.dashboard', [
            'totalWorkouts' => $totalWorkouts,
            'totalBMI' => $totalBMI,
            'totalUsers' => $totalUsers,
            'totalResults' => $totalResults 
        ]);
    }
}
