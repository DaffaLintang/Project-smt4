<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

        // Auto login setelah registrasi
        Auth::login($user);

        // **Pastikan Laravel hanya merespons JSON jika request adalah AJAX**
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
                'redirect' => url('/dashboard')
            ], 200);
        }

        // Redirect hanya untuk request non-AJAX
        return redirect('/dashboard');

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        \Log::error('Registration failed', ['error' => $e->getMessage()]);

        return response()->json([
            'success' => false,
            'error' => 'Something went wrong. Please try again.'
        ], 500);
    }
}
}
