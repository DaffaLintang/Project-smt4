<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $profile = Profile::get();

        return new ProfileResource(true, 'List profile', $profile);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'full_name' => 'required|string|max:255',
    'email' => 'required|email|unique:profiles,email',
    'phone' => 'required|digits_between:10,15',
    'birth' => 'required|date',
    'weight' => 'required|integer',
    'height' => 'required|integer',

    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $image = $request->file('image');
    $imagePath = $image->store('posts', 'public');


    // Simpan ke database MongoDB
    $profile = Profile::create([
        'image' => 'storage/' . $imagePath,
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'birth' => $request->birth,
        'weight' => $request->weight,
        'height' => $request->height,
    ]);

    return new ProfileResource(true, 'profile berhasil ditambahkan!', $profile);
}

public function show($id)
{
    $Profile = Profile::find($id);

    if (!$Profile) {
        return response()->json([
            'success' => false,
            'message' => 'Profile tidak ditemukan'
        ], 404);
    }

    return new ProfileResource(true, 'Detail Data Profile', $Profile);
}

public function update(Request $request, $id){
    $validator = Validator::make($request->all(), [
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'full_name' => 'required|string|max:255',
    'email' => 'required|email|unique:profiles,email' . $id,
    'phone' => 'required|digits_between:10,15',
    'birth' => 'required|date',
    'weight' => 'required|integer',
    'height' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $image = $request->file('image');
    $image->storeAs('public/posts', $image->hashName());


    $Profile = Profile::find($id);

    $Profile->update([
        'image' => $image->hashName(),
        'full_name' => $request->fulle_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'birth' => $request->birth,
        'weight' => $request->weight,
        'height' => $request->height,
    ]);

    return new ProfileResource(true, 'Data Post Berhasil Diubah!', $Profile);
}

public function destroy($id){
    $Profile = Profile::find($id);

    $Profile->delete();

    return new ProfileResource(true, 'Data Profile Berhasil Dihapus!', null);
}
}
