<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = strtolower($request->input('search'));
    
        $users = User::when($search, function ($query) use ($search) {
            return $query->where(DB::raw('LOWER(name)'), 'like', "%{$search}%")
                         ->orWhere(DB::raw('LOWER(email)'), 'like', "%{$search}%")
                         ->orWhere(DB::raw('LOWER(full_name)'), 'like', "%{$search}%")
                         ->orWhere(DB::raw('LOWER(phone)'), 'like', "%{$search}%");
        })->paginate(5);
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.users.index', compact('users'))->render()
            ]);
        }
    
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'full_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:15',
        'birth' => 'nullable|date',
        'weight' => 'nullable|numeric',
        'height' => 'nullable|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->full_name = $request->full_name;
    $user->phone = $request->phone;
    $user->birth = $request->birth;
    $user->weight = $request->weight;
    $user->height = $request->height;

    // Jika ada upload gambar baru
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('users', 'public');
        $user->image = $imagePath;
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
}

}
