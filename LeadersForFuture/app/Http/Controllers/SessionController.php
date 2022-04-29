<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function logout()
    {
        session()->flush();

        return redirect()->to('/login');
    }

    public function login()
    {
        return view('sessions.login');
    }
}