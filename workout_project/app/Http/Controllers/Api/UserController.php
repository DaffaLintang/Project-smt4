<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::get();

        return new UserResource(true, 'List User', $user);
    }

    public function store(Request $request)
{
    // Validasi input termasuk role
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|string|in:admin,user', // Validasi role
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan ke database MongoDB
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password), // Enkripsi password
        'role'     => strtolower($request->role), // Simpan role dalam format lowercase
    ]);

    return new UserResource(true, 'User berhasil ditambahkan!', $user);
}

public function show($id)
{
    $user = User::find($id); // Jenssegers sudah mendukung ObjectId otomatis

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    return new UserResource(true, 'Detail Data User', $user);
}

public function update(Request $request, $id){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|string|in:admin,user',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::find($id);

    $user->update([
        'name'     => $request->name,
        'email'    => $request->email,
        'role'     => strtolower($request->role),
    ]);

    return new UserResource(true, 'Data Post Berhasil Diubah!', $user);
}

public function destroy($id){
    $user = User::find($id);

    $user->delete();

    return new UserResource(true, 'Data User Berhasil Dihapus!', null);
}
}
