<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


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
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        $user = User::findOrFail($id);
        
        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->birth = $request->birth;
        $user->weight = $request->weight;
        $user->height = $request->height;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('profiles', $imageName, 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Data pengguna berhasil diperbarui',
            'user' => $user
        ]);

    } catch (\Exception $e) {
        \Log::error('Error updating user: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()
        ], 500);
    }
}

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna berhasil dihapus.'
                ]);
            }

            return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data.'
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
