<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // --- Logout
    // --- --- Performs the logout
    // -----------------------------------------------------------------------------------------------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Login
    // --- --- Return the Login View
    // -----------------------------------------------------------------------------------------------------------------
    public function login()
    {
        return view('sessions.login');
    }
}
