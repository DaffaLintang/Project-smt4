<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriResource;
use App\Models\Histori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoritController extends Controller
{
    public function index()
    {
        $histori = Histori::with(['user', 'result'])->get();

        return new HistoriResource(true, 'List Histori Workout', $histori);
    }
        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer',
            'id_result' => 'required|integer',
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
            'id_user'     => $request->id_user,
            'id_result'    => $request->id_result,
            'durasi'    => $request->durasi,
            'kesulitan'    => $request->kesulitan,
            'repetisi'    => $request->repetisi,
            'catatan'    => $request->catatan,
        ]);

        return new HistoriResource(true, 'Histori berhasil ditambahkan!', $histori);
    }

    public function show($id)
    {
        $histori = Histori::with(['user', 'result'])->find($id); // Jenssegers sudah mendukung ObjectId otomatis

        if (!$histori) {
            return response()->json([
                'success' => false,
                'message' => 'Result tidak ditemukan'
            ], 404);
        }

        return new HistoriResource(true, 'Detail Data Resul tWorkout', $histori);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer',
            'id_result' => 'required|integer',
            'durasi' => 'required|integer',
            'repetisi' => 'required|integer',
            'kesulitan' => 'required|string',
            'catatan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $histori = Histori::findOrFail($id);

        $data = [
            'id_user'     => $request->id_user,
            'id_result'    => $request->id_result,
            'durasi'    => $request->durasi,
            'kesulitan'    => $request->kesulitan,
            'repetisi'    => $request->repetisi,
            'catatan'    => $request->catatan,
        ];

        $histori->update($data);

        return new HistoriResource(true, 'Data Result Workout Berhasil Diubah!', $histori);
    }

    public function destroy($id){
        $user = Histori::find($id);

        $user->delete();

        return new HistoriResource(true, 'Data Result Workout Berhasil Dihapus!', null);
    }
}
