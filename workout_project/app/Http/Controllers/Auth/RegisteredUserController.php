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

        // Buat user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'image' => null,
            'full_name' => null,
            'role' => 'user',
            'password' => Hash::make($validatedData['password']),
        ]);

        event(new Registered($user)); // Event opsional
        Auth::login($user); // Auto-login

        // AJAX request
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Selamat datang, ' . $user->name,
                'redirect' => url('/dashboard')
            ]);
        }

        // Redirect dengan session flash untuk request biasa
        return redirect()->intended('/dashboard')->with('register_success', 'Registrasi berhasil! Selamat datang, ' . $user->name);

    } catch (ValidationException $e) {
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
        throw $e;

    } catch (\Exception $e) {
        \Log::error('Registration failed', ['error' => $e->getMessage()]);
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }

        return redirect()->back()->withErrors(['general' => 'Terjadi kesalahan. Silakan coba lagi.']);
    }
}


}
