<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function userCreate()
    {
        return view('admin.create-user');
    }

    public function userInfo()
    {
        return view('admin.user');
    }

    public function userDetail($id)
    {

        $user = DB::select("exec buscaUtiliz ?", [$id]);

        $forms = DB::select("exec buscaTodosDadosForms ?", [$id]);

        return view('admin.user-detail', ['user' => $user, 'forms' => $forms]);
    }
    
}
