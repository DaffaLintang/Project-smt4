<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
//     public function store(LoginRequest $request): RedirectResponse
// {
//     $credentials = $request->only('email', 'password');

//     if (!Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
//         return back()->withErrors([
//             'email' => 'Email atau password salah.',
//         ]);
//     }

//     $request->session()->regenerate();

//     $user = Auth::guard('web')->user();

//     // Flash message untuk SweetAlert
//     Session::flash('login_success', 'Login berhasil!');

//     if ($user->role === 'admin') {
//         return redirect()->route('admin.dashboard');
//     } elseif ($user->role === 'user') {
//         return redirect()->route('landingpage');
//     }

//     return redirect()->route('home');
// }
public function store(LoginRequest $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');

    if (!Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::guard('web')->user();

    // Jika role admin
    if ($user->role === 'admin') {
        Session::flash('login_success', 'Login berhasil!');
        return redirect()->route('admin.dashboard');
    }

    // Jika role user
    if ($user->role === 'user') {
        // Simpan pesan dan logout
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash message sebelum logout
        Session::flash('login_warning', 'Anda login sebagai user, silahkan login melalui aplikasi mobile.');

        return redirect()->route('landingpage'); // Atau route lain jika diperlukan
    }

    return redirect()->route('home');
}




    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
