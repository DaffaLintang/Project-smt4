<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Event untuk proses registrasi
            event(new Registered($user));

            // Login user
            Auth::login($user);

            // Jika request dari AJAX, kembalikan response JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => url('/landingpage')
                ], 200);
            }

            // Redirect ke landing page jika bukan AJAX
            return redirect('/landingpage');

        } catch (ValidationException $e) {
            // Tangani error validasi
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Tangani error lainnya
            \Log::error('Registration failed', ['error' => $e->getMessage()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Something went wrong. Please try again.'
                ], 500);
            }

            return back()->withErrors(['registration' => 'Something went wrong.']);
        }
    }
}
