<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Menampilkan form lupa password
     */
    public function create()
    {
        return view('auth.halamanforgotpw');
    }

    /**
     * Menangani request reset password
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status == Password::RESET_LINK_SENT
    //                 ? back()->with('status', __($status))
    //                 : back()->withInput($request->only('email'))
    //                         ->withErrors(['email' => __($status)]);
    // }
        public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Deteksi AJAX atau JSON request
        if ($request->ajax() || $request->isJson()) {
            if ($status == Password::RESET_LINK_SENT) {
                return response()->json(['message' => __($status)], 200);
            }

            return response()->json([
                'errors' => ['email' => [trans($status)]]
            ], 422);
        }

        // Fallback untuk request biasa (non-AJAX)
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }

}
