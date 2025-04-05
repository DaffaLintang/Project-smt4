<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultWorkoutController extends Controller
{
    public function index()
{
    $results = Result::with('user')->get();

    return new ResultResource(true, 'List Result Workout', $results);
}
    public function store(Request $request)
{
    // Validasi input termasuk role
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'desc' => 'required|string',
        'type' => 'required|string',
        'bodyPart' => 'required|string',
        'equipment' => 'required|string',
        'level' => 'required|string',
        'id_user' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan ke database MongoDB
    $result = Result::create([
        'title'     => $request->title,
        'desc'    => $request->desc,
        'type'    => $request->type,
        'bodyPart'    => $request->bodyPart,
        'equipment'    => $request->equipment,
        'level'    => $request->level,
        'id_user'    => $request->id_user,
    ]);

    return new ResultResource(true, 'Result Workout berhasil ditambahkan!', $result);
}

public function show($userId)
{
    $results = Result::with('user')->where('id_user', $userId)->get();

    if ($results->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada result untuk user ini'
        ], 404);
    }

    return new ResultResource(true, 'List Result Milik User', $results);
}


public function update(Request $request, $id){
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
        'desc' => 'required|string',
        'type' => 'required|string',
        'bodyPart' => 'required|string',
        'equipment' => 'required|string',
        'level' => 'required|string',
        'id_user' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $result = Result::findOrFail($id); // Pastikan user ditemukan

    $data = [
        'title'     => $request->title,
        'desc'    => $request->desc,
        'type'    => $request->type,
        'bodyPart'    => $request->bodyPart,
        'equipment'    => $request->equipment,
        'level'    => $request->level,
        'id_user'    => $request->id_user,
    ];

    // Update user dengan semua data yang sudah disiapkan
    $result->update($data);

    return new ResultResource(true, 'Data Result Workout Berhasil Diubah!', $result);
}

public function destroy($id){
    $user = Result::find($id);

    $user->delete();

    return new ResultResource(true, 'Data Result Workout Berhasil Dihapus!', null);
}
}
