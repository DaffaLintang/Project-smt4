<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histori;

class LatihanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $history = Histori::with('user')
        ->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%');
            })->orWhere('durasi', 'like', '%' . $search . '%')
              ->orWhere('repetisi', 'like', '%' . $search . '%')
              ->orWhere('kesulitan', 'like', '%' . $search . '%')
              ->orWhere('catatan', 'like', '%' . $search . '%');
        })
        ->paginate(10); // Ubah dari get() menjadi paginate()

    return view('admin.latihan.history', compact('history'));
}
}
