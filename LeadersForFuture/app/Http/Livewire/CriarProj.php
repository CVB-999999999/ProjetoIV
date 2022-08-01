<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class CriarProj extends Component
{
    public $disciplinas = [];
    public $nome;
    public $tema;
    public $semestre;
    public $ano_letivo;
    public $estado = 0;
    public $idproj;
    public $disciplina;

    public function render()
    {
        // Select Available Disciplines (Ignore Broken Ones)
        $this->disciplinas = DB::select("SELECT d.* FROM Disciplina d, cursos_disciplinas c WHERE d.cd_discip = c.cd_discip");

        return view('livewire.criar-proj');
    }

    public function submitForm()
    {
        $this->estado = 0;

        // Verifies if any field is empty
        if ($this->nome == null || $this->tema == null || $this->ano_letivo == null || $this->disciplina == null) {
            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }

        // Convert YYYY/YYYY+1 to YYYY
        $ano = explode("/", $this->ano_letivo);
        if (!is_numeric($ano[0])) {
            $this->emit("openModal", "error1", ["message" => 'O ano letivo não está no formato correto! Deveria ser do tipo ANO ou ANO/ANO']);
            return;
        }

        // Gets previous old max id
        try {
            $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Projecto");
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        // Generates new ID
        $this->idproj = $newid[0]->id + 1;

        // Insert Project in DB
        try {
            DB::insert("INSERT INTO Projecto (id,estado,nome,tema,ano_letivo,id_Disciplina) Values (?, ?, ?, ?, ?, ?)",
                [$this->idproj, $this->estado, $this->nome, $this->tema, $ano[0], $this->disciplina]);

            // If teacher also assignes the project to him
            if (Auth::user()->id_tipoUtilizador == 1) {
                DB::insert("INSERT INTO Utilizador_Projecto (id_projecto,numero_utilizador) Values (?, ?)", [$this->idproj, Auth::user()->numero]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos! Um dos campos pode ser muito grande ou utiliza caracteres inválidos']);
            return;
        }
//        $this->emit("openModal", "success", ["message" => 'Projeto criado com sucesso!']);

        // Redirects to correct pages
        if (Auth::user()->id_tipoUtilizador == 1) {
            return redirect('/prof/proj');
        } elseif (Auth::user()->id_tipoUtilizador == 3) {
            return redirect('/admin/proj');
        }
    }
}
