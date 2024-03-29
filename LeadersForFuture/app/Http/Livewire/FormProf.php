<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FormProf extends Component
{
    public $projetos = [];
    public $titulo;
    public $projeto;
    public $semestre;
    public $anocurricular;
    public $ano_letivo;
    public $estado = 0;
    public $idform;
    public $profnumber;
    public $forms = [];


    public function render()
    {
        // Gets the Tipo_Formulario
        try {
            $this->profnumber = Auth::user()->numero;
//        $this->tpForms = DB::select("exec buscaTipoForm");

            // Gets the projects
            $this->projetos = DB::select("SELECT p.*  From Projecto p, Utilizador_Projecto up WHERE up.numero_utilizador = ? AND up.id_projecto = p.id", [$this->profnumber]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        return view('livewire.form-criar');
    }

    public function proj()
    {

        $this->forms = DB::table('Formulario')
            ->where('id_projecto', '=', trim($this->projeto))
            ->get();
    }

    public function submitForm()
    {
        $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Formulario");

        $this->idform = $newid[0]->id + 1;

        $this->ano_letivo = (explode("/", $this->ano_letivo));

        if (!is_numeric($this->ano_letivo[0])) {
            $this->emit("openModal", "error1", ["message" => 'O ano letivo não está no formato correto! Deveria ser do tipo ANO ou ANO/ANO']);
        }

        if (/*$this->tpForm == null || */ $this->projeto == null || $this->semestre == null || $this->anocurricular == null || $this->ano_letivo[0] == null) {
//            return redirect("admin/erro");
            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }
        try {
            DB::insert("INSERT INTO Formulario (id,estado,id_projecto,ano_letivo,ano_curricular,semestre,titulo) Values (?, ?, ?, ?, ?, ?, ?)",
                [$this->idform, $this->estado, $this->projeto, $this->ano_letivo[0], $this->anocurricular, $this->semestre, $this->titulo]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        return redirect("prof/proj/");
    }
}
