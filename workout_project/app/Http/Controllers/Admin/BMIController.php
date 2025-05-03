<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BMI;
use DB;


class BMIController extends Controller
{
    public function index(Request $request)
    {
        $bmis = DB::connection('mongodb')->table('obesity')->paginate(10);
    
        return view('admin.bmi.index', [
            'bmis' => $bmis
        ]);
    }
    
}
