<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Buat token
        $token = $user->createToken('Token-' . $user->id)->plainTextToken;


        // Return response dengan ID dan Token
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'user_id' => $user->id,
            'token' => $token
        ], 200);
    }

}
