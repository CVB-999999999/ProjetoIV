<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------------------------
    public function homeAluno()
    {
        $id = \Request::segment(3);
        try {
            $proj = DB::select("SELECT * FROM Projecto WHERE id = ?", [$id]);

            $forms = DB::table('Formulario')
                ->where('id_projecto', '=', $id)
                ->get();

        } catch (\Illuminate\Database\QueryException $ex) {
//            ddd($ex);

//            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return redirect('/');
        }
        return view('homealuno', ['proj' => $proj[0], 'forms' => $forms]);
    }
    public function eliminarUserProj()
    {
        $id = \Request::segment(3);
        $idproj = \Request::segment(4);
        try {
            DB::DELETE("DELETE FROM Utilizador_Projecto WHERE numero_utilizador = ? AND id_projecto = ?", [$id, $idproj]);
            return view('homeproj');
        } catch (\Illuminate\Database\QueryException $ex) {
//            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return redirect('/');
        }
    }
}
