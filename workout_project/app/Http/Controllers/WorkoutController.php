<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WorkoutController extends Controller
{
    public function recomend(Request $request){
        $response = Http::post('http://127.0.0.1:5000/recommend', [
            'Type'=>$request->Type,
            'BodyPart'=>$request->BodyPart,
            'Equipment'=>$request->Equipment,
            'Level'=>$request->Level
        ]);
        return response()->json($response->json());
    }
}
