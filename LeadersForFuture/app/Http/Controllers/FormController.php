<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
{

    public function formSelection() {
        $username = Session::get('user');

        $forms = DB::select("exec buscaFormsDados ?", [$username]);

        return view('forms.form-selection', ['forms' => $forms]);
    }

    public function form($id) {

//        ddd($id);

        return view('forms.form-page', ['id'=>$id]);
    }
}
