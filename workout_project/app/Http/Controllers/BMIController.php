<?php

namespace App\Http\Controllers;

use App\Models\BMI;
use Illuminate\Http\Request;

class BMIController extends Controller
{
    public function index()
    {
        $bmiData = BMI::all();
        return view('bmi.index', compact('bmiData'));
    }

    public function show($id)
    {
        $bmi = BMI::find($id);
        return view('bmi.show', compact('bmi'));
    }

    public function create()
    {
        return view('bmi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Age' => 'required',
            'Gender' => 'required',
            'Height' => 'required|numeric',
            'Weight' => 'required|numeric',
            'PhysicalActivityLevel' => 'required',
        ]);

        // Calculate BMI
        $height_m = $validated['Height'] / 100; // convert cm to m
        $bmi = $validated['Weight'] / ($height_m * $height_m);
        
        // Determine Obesity Category
        $category = $this->determineObesityCategory($bmi);

        $bmiRecord = new BMI([
            'Age' => $validated['Age'],
            'Gender' => $validated['Gender'],
            'Height' => $validated['Height'],
            'Weight' => $validated['Weight'],
            'BMI' => round($bmi, 2),
            'PhysicalActivityLevel' => $validated['PhysicalActivityLevel'],
            'ObesityCategory' => $category
        ]);

        $bmiRecord->save();

        return redirect()->route('bmi.index')->with('success', 'BMI data has been saved successfully.');
    }

    private function determineObesityCategory($bmi)
    {
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'Normal Weight';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }
} 