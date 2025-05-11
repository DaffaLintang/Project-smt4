<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriResource;
use App\Models\Histori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId; // << WAJIB! Untuk bikin ObjectId

class HistoritController extends Controller
{
    public function index()
    {
        $histori = Histori::with(['user', 'result'])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Histori Workout',
            'data' => HistoriResource::collection($histori)
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|string|size:24',   // <<< MongoDB id_user harus string panjang 24
            'id_result' => 'required|string|size:24', // <<< MongoDB id_result harus string panjang 24
            'durasi' => 'required|integer',
            'repetisi' => 'required|integer',
            'kesulitan' => 'required|string',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $histori = Histori::create([
            'id_user'     => new ObjectId($request->id_user),
            'id_result'   => new ObjectId($request->id_result),
            'durasi'      => $request->durasi,
            'repetisi'    => $request->repetisi,
            'kesulitan'   => $request->kesulitan,
            'catatan'     => $request->catatan,
        ]);

        return new HistoriResource($histori,true, 'Histori berhasil ditambahkan!');
    }

    public function show($userId)
    {
        if (!preg_match('/^[a-f\d]{24}$/i', $userId)) {
            return response()->json([
                'success' => false,
                'message' => 'ID tidak valid'
            ], 400);
        }

        $histori = Histori::with(['user', 'result'])->where('id_user', new ObjectId($userId))->get();

        if (!$histori) {
            return response()->json([
                'success' => false,
                'message' => 'Histori tidak ditemukan'
            ], 404);
        }

        return HistoriResource::collection($histori)->additional([
            'success' => true,
            'message' => 'Detail Histori Workout'
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID tidak valid'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'id_user' => 'required|string|size:24',
            'id_result' => 'required|string|size:24',
            'durasi' => 'required|integer',
            'repetisi' => 'required|integer',
            'kesulitan' => 'required|string',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $histori = Histori::find(new ObjectId($id));

        if (!$histori) {
            return response()->json([
                'success' => false,
                'message' => 'Histori tidak ditemukan'
            ], 404);
        }

        $histori->update([
            'id_user'    => new ObjectId($request->id_user),
            'id_result'  => new ObjectId($request->id_result),
            'durasi' => (int) $request->durasi,
            'repetisi' => (int) $request->repetisi,
            'kesulitan'  => $request->kesulitan,
            'catatan'    => $request->catatan,
        ]);

        return new HistoriResource($histori, true, 'Data Histori Workout Berhasil Diubah!');
    }

    public function destroy($id)
{
    if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
        return response()->json([
            'success' => false,
            'message' => 'ID tidak valid'
        ], 400);
    }

    $histori = Histori::find(new ObjectId($id));

    if (!$histori) {
        return response()->json([
            'success' => false,
            'message' => 'Histori tidak ditemukan'
        ], 404);
    }

    $histori->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data Histori Workout Berhasil Dihapus!',
        'data' => null
    ], 200);
}
}
