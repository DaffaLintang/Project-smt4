<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId;

class ResultWorkoutController extends Controller
{
    public function index()
    {
        $results = Result::with('user')->get();

        // Gunakan collection dengan metadata tambahan
        return ResultResource::collection($results)->additional([
            'success' => true,
            'message' => 'List Result Workout',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'type' => 'required|string',
            'bodyPart' => 'required|string',
            'equipment' => 'required|string',
            'level' => 'required|string',
            'id_user' => 'required|string|size:24', // harus string 24 karakter (ObjectId)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan ke database
        $result = Result::create([
            'title'     => $request->title,
            'desc'      => $request->desc,
            'type'      => $request->type,
            'bodyPart'  => $request->bodyPart,
            'equipment' => $request->equipment,
            'level'     => $request->level,
            'id_user'   => new ObjectId($request->id_user),
        ]);

        return new ResultResource($result, true, 'Result Workout berhasil ditambahkan!');
    }

    public function show($userId)
    {
        // Validasi id_user
        if (!preg_match('/^[a-f\d]{24}$/i', $userId)) {
            return response()->json([
                'success' => false,
                'message' => 'ID User tidak valid'
            ], 400);
        }

        $results = Result::with('user')->where('id_user', new ObjectId($userId))->get();

        if ($results->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada result untuk user ini'
            ], 404);
        }

        return new ResultResource($results, true, 'List Result Milik User');
    }

    public function update(Request $request, $id)
    {
        // Validasi id
        if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID Result tidak valid'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'type' => 'required|string',
            'bodyPart' => 'required|string',
            'equipment' => 'required|string',
            'level' => 'required|string',
            'id_user' => 'required|string|size:24',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $result = Result::findOrFail(new ObjectId($id));

        $data = [
            'title'     => $request->title,
            'desc'      => $request->desc,
            'type'      => $request->type,
            'bodyPart'  => $request->bodyPart,
            'equipment' => $request->equipment,
            'level'     => $request->level,
            'id_user'   => new ObjectId($request->id_user),
        ];

        $result->update($data);

        return new ResultResource($result, true, 'Data Result Workout Berhasil Diubah!');
    }

    public function destroy($id)
    {
        // Validasi id
        if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID Result tidak valid'
            ], 400);
        }

        $result = Result::find(new ObjectId($id));

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Result tidak ditemukan'
            ], 404);
        }

        $result->delete();


        return response()->json([
            'success' => true,
            'message' => 'Data Result Workout Berhasil Dihapus!',
        ]);
    }
}
