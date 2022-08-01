<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;

class FormCriar extends Component
{
    public $projetos = [];
    public $titulo;
    public $projeto;
    public $semestre;
    public $anocurricular;
    public $ano_letivo;
    public $estado = 0;
    public $idform;
    public $forms = [];


    public function render()
    {
        try {
            // Gets the Tipo_Formulario
//        $this->tpForms = DB::select("exec buscaTipoForm");

            // Gets the projects
            $this->projetos = DB::select("exec buscaProjetos");
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
        $this->estado = 0;

        $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Formulario");

        $this->idform = $newid[0]->id + 1;

        $this->ano_letivo = (explode("/", $this->ano_letivo))[0];

        if (!is_numeric($this->ano_letivo)) {
            $this->emit("openModal", "error1", ["message" => 'O Ano Letivo não está no formato correto! Deveria ser do tipo ANO ou ANO/ANO']);
            return;
        }

        if (!is_numeric($this->anocurricular)) {
            $this->emit("openModal", "error1", ["message" => 'O Ano Curricular deve ser um número!']);
            return;
        }

        if (/*$this->tpForm == null || */ $this->projeto == null || $this->semestre == null || $this->anocurricular == null || $this->ano_letivo == null) {
//            return redirect("admin/erro");

            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }
        try {
            DB::insert("INSERT INTO Formulario (id,estado,id_projecto,ano_letivo,ano_curricular,semestre, titulo) Values (?, ?, ?, ?, ?, ?, ?)",
                [$this->idform, $this->estado, $this->projeto, $this->ano_letivo, $this->anocurricular, $this->semestre, $this->titulo]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
        return redirect("admin/users/");
    }
}
