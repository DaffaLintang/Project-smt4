<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        $imagePath = $request->file('image')->store('profiles', 'public');
        $user->image = $imagePath;
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

    return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');

    if ($request->has('croppedImage')) {
        $base64Image = $request->input('croppedImage');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $fileName = 'profiles/' . uniqid() . '.png';
        Storage::disk('public')->put($fileName, $imageData);
    
        $user->image = $fileName;
        $user->save();
    }
    
}

            // Jika ada upload gambar baru
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('users', 'public');
                $user->image = $imagePath;
            }

            $user->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data pengguna berhasil diperbarui.'
                ]);
            }

            return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui data.'
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
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
