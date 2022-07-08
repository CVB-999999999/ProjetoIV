<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // --- userCreate
    // --- --- Loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function userCreate()
    {
        return view('admin.create-user');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- projectCreate
    // --- --- Loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function projectCreate($id)
    {
        return view('admin.create-project', ['id' => $id]);
    }
    // -----------------------------------------------------------------------------------------------------------------
    // --- projectAdd
    // --- --- Loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function projectAdd($id)
    {
        return view('admin.add-project', ['id' => $id]);
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- userEdit
    // --- --- Loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function userEdit($id)
    {
        return view('admin.edit-user', ['id' => $id]);
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
    public function formCriar()
    {
        // Gets the Tipo_Formulario
        $tpForms = DB::select("exec buscaTipoForm");
        // Gets the projects
        $projetos = DB::select("exec buscaProjetos");

        return view('admin.form-criar', ['tpForms' => $tpForms, 'projetos' => $projetos]);
    }
    public function formCriarProf()
    {
        // Gets the Tipo_Formulario
        $tpForms = DB::select("exec buscaTipoForm");
        // Gets the projects
        $projetos = DB::select("exec buscaProjetos");

        return view('prof.form-criar', ['tpForms' => $tpForms, 'projetos' => $projetos]);
    }
    
    public function statsprof()
    {  
        return view('prof.stats');
    }

}
