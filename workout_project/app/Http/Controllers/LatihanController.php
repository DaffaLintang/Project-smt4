<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Histori;

class LatihanController extends Controller
{
    public function index(Request $request)
    {
        $history = Histori::orderBy('created_at', 'desc')->paginate(10); // paginate 10 per halaman
        return view('admin.latihan.history', compact('history'));
    }
}
