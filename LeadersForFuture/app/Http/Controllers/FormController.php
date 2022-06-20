<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
{

    public function formSelection() {
        $id = Auth::user()->numero;

//        $forms = DB::select("exec buscaFormsDados ?", [$username]);

        $forms = DB::select("exec buscaTodosDadosForms ?", [$id]);
//        ddd($forms);

        return view('forms.form-selection', ['forms' => $forms]);
    }

    public function form($id) {

        return view('forms.form-page', ['id'=>$id]);
    }
}
