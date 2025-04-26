<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BMI; // pastikan kamu punya model BMI

class BMIController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $bmi = Bmi::when($search, function ($query) use ($search) {
        return $query->where('Age', 'like', '%' . $search . '%')
                     ->orWhere('Gender', 'like', '%' . $search . '%')
                     ->orWhere('Height', 'like', '%' . $search . '%')
                     ->orWhere('Weight', 'like', '%' . $search . '%')
                     ->orWhere('BMI', 'like', '%' . $search . '%')
                     ->orWhere('PhysicalActivityLevel', 'like', '%' . $search . '%')
                     ->orWhere('ObesityCategory', 'like', '%' . $search . '%');
    })->paginate(10); // Menggunakan paginate(), misalnya 10 item per halaman

    return view('admin.bmi.index', compact('bmi'));
}
}

