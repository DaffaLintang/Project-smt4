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

public function update(Request $request, $id) {
    $user = User::findOrFail($id); // Pastikan user ditemukan
    $authUser = Auth::user(); // User yang sedang login

    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email,' . $id,
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
        'name' => $authUser->name,
        'role' => strtolower($authUser->role),
        'email' => $request->email,
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'birth' => $request->birth,
        'weight' => $request->weight,
        'height' => $request->height,
    ];

    // Jika ada file gambar yang diunggah
    if ($request->hasFile('image')) {
        if ($user->image) {
            Storage::delete(str_replace('storage/', 'public/', $user->image));
        }

        $image = $request->file('image');
        $imagePath = $image->store('profiles', 'public');
        $data['image'] = 'storage/' . $imagePath;
    }

    $user->update($data);

    return new UserResource(true, 'Data User Berhasil Diubah!', $user);
}

public function destroy($id){
    $user = User::find($id);

    $user->delete();

    return new UserResource(true, 'Data User Berhasil Dihapus!', null);
}
}
