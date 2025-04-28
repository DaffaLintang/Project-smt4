<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        return view('admin.dashboard');
    }

    //public function index()
    //{
        //$totalUser = User::count(); // hitung total user

        //return view('admin.dashboard', compact('totalUser'));
    //}
}
