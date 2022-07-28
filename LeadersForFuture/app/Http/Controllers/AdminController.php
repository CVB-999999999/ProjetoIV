<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
    // --- ProjUser
    // --- --- Loads the view
    // -----------------------------------------------------------------------------------------------------------------
    public function projUser()
    {
        return view('admin.ProjStudent');
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
        try {
            $user = DB::select("exec buscaUtiliz ?", [$id]);
//            $forms = DB::select("exec buscaProjProf ?", [$id]);

            $forms = DB::table('Utilizador_Projecto')
                ->where('numero_utilizador', '=', $id)
                ->join('Projecto', 'id_projecto', '=', 'id')
                ->join('Disciplina', 'id_disciplina', '=', 'cd_discip')
                ->get();

//            ddd($forms);

        }catch(\Illuminate\Database\QueryException $ex){
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

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
    public function download(Request $request)
    {
        return Storage::download('public/LDF-User-Manual.pdf');
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
    public function criarProj()
    {
        return view('admin.criar-proj');
    }
    public function addToproj()
    {
        return view('admin.add-toproj');
    }

    public function statsprof()
    {
        return view('prof.stats');
    }

}
