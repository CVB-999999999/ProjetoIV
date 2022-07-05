<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // --- userCreate
    // --- --- Loads thee view
    // -----------------------------------------------------------------------------------------------------------------
    public function userCreate()
    {
        return view('admin.create-user');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- userInfo
    // --- --- Loads the view where the admin selects the user (data on a separate table)
    // -----------------------------------------------------------------------------------------------------------------
    public function userInfo()
    {
        return view('admin.user');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- userDetail
    // --- --- Gets the user data and his forms and loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function userDetail($id)
    {
        // Gets the user
        $user = DB::select("exec buscaUtiliz ?", [$id]);

        // Gets forms associated with user
        $forms = DB::select("exec buscaTodosDadosForms ?", [$id]);

        return view('admin.user-detail', ['user' => $user, 'forms' => $forms]);
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Stats
    // --- --- Loads stats view
    // -----------------------------------------------------------------------------------------------------------------
    public function stats()
    {
        return view('admin.stats');
    }
    public function statsprof()
    {
        
        return view('prof.stats');
    }
}
