<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MongoDB\BSON\ObjectId;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all(); // Ambil semua user tanpa memuat relasi yang tidak perlu

        return UserResource::collection($users);
    }

    // Menambahkan user baru
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            function ($attribute, $value, $fail) {
                if (User::where('email', $value)->exists()) {
                    $fail('The email has already been taken.');
                }
            },
        ],
        'password' => 'required|min:6',
        'role' => 'required|string|in:admin,user', // Validasi role
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Membuat user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => strtolower($request->role),
    ]);

    return new UserResource($user, true, 'User berhasil ditambahkan!');
}

    // Menampilkan detail user berdasarkan ID
    public function show($id)
    {
        // Validasi manual: panjang harus 24 dan karakter hex
        if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
            return response()->json(['success' => false, 'message' => 'ID tidak valid'], 400);
        }

        $objectId = new ObjectId($id);

        $user = User::with(['historis', 'results'])->where('_id', $objectId)->first();

        if (!$user) {
            Log::error('User tidak ditemukan untuk ID: ' . $id);
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }

        return new UserResource($user, true, 'Detail Data User');
    }

    // Mengupdate data user
    public function update(Request $request, $id)
{
    // Validasi ID agar ObjectId valid
    if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
        return response()->json(['success' => false, 'message' => 'ID tidak valid'], 400);
    }

    $objectId = new ObjectId($id);
    $user = User::findOrFail($objectId); // MongoDB _id pakai ObjectId

    $authUser = Auth::user();

    // Validasi input
    $validator = Validator::make($request->all(), [
        'name' => 'string|max:255',
        'email' => 'required|email|unique:users,email,' . $objectId . ',_id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'full_name' => 'required|string|max:255',
        'phone' => 'required|digits_between:10,15',
        'birth' => 'required|date',
        'weight' => 'required|integer',
        'height' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $data = [
        'name' => $request->name,
        'role' => strtolower($authUser->role),
        'email' => $request->email,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'birth' => $request->birth,
        'weight' => $request->weight,
        'height' => $request->height,
    ];

    // Proses upload gambar
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($user->image && Storage::exists(str_replace('storage/', 'public/', $user->image))) {
            Storage::delete(str_replace('storage/', 'public/', $user->image));
        }

        $image = $request->file('image');
        $imagePath = $image->store('profiles', 'public');
        $data['image'] = 'storage/' . $imagePath;
    }

    $user->update($data);

    return new UserResource($user, true, 'Data User Berhasil Diubah!');
}

    // Menghapus user
    public function destroy($id)
    {
        // Validasi ID
        if (!preg_match('/^[a-f\d]{24}$/i', $id)) {
            return response()->json([
                'success' => false,
                'message' => 'ID tidak valid'
            ], 400);
        }

        $objectId = new ObjectId($id);

        $user = User::find($objectId);

        if ($user) {
            $user->delete();  // delete() aman untuk MongoDB Eloquent

            return new UserResource(null, true, 'Data User Berhasil Dihapus!');
        }

        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }
}

