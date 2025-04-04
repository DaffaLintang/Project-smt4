<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
class WorkoutController extends Controller
{
    public function index(Request $request)
{
    $query = Workout::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('desc', 'like', "%{$search}%");
    }

    $workouts = $query->paginate(25);

    return view('admin.workouts.index', [
        'workouts' => $workouts
    ]);
}



}
