<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    $query = Workout::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('Title', 'like', "%{$search}%")
              ->orWhere('Type', 'like', "%{$search}%")
              ->orWhere('BodyPart', 'like', "%{$search}%")
              ->orWhere('Equipment', 'like', "%{$search}%")
              ->orWhere('Level', 'like', "%{$search}%");
        });
    }

    $workouts = $query->paginate(25)->appends(['search' => $search]);

    return view('admin.workouts.index', compact('workouts'));
}

    public function create()
    {
        return view('admin.workouts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Title' => 'required|string|max:255',
            'Desc' => 'required|string',
            'Type' => 'required|string',
            'BodyPart' => 'required|string',
            'Equipment' => 'required|string',
            'Level' => 'required|string',
            'Rating' => 'required|numeric',
            'RatingDesc' => 'required|string'
        ]);

        Workout::create($validated);

        return redirect()->route('workouts.index')
            ->with('success', 'Workout berhasil ditambahkan');
    }

    public function edit(Workout $workout)
    {
        return view('admin.workouts.edit', compact('workout'));
    }

    public function update(Request $request, Workout $workout)
    {
        try {
            $validated = $request->validate([
                'Title' => 'required|string|max:255',
                'Desc' => 'required|string',
                'Type' => 'required|string',
                'BodyPart' => 'required|string',
                'Equipment' => 'required|string',
                'Level' => 'required|string',
                'Rating' => 'required|numeric|min:1|max:5',
                'RatingDesc' => 'required|string'
            ]);

            $workout->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Workout berhasil diperbarui',
                    'data' => $workout
                ]);
            }

            return redirect()->route('workouts.index')
                ->with('success', 'Workout berhasil diperbarui');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 422);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Workout $workout)
    {
        $workout->delete();

        return redirect()->route('workouts.index')
            ->with('success', 'Workout berhasil dihapus');
    }
}
