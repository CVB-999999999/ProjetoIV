<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function logout(Request $request)
    {
//        session()->flush();
//
//        return redirect()->to('/login');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login()
    {
        return view('sessions.login');
    }
}
