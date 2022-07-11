<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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

    public function render(){
        $this->disciplinas = DB::select("SELECT * FROM Disciplina");
        return view('livewire.criar-proj');
    }
    public function submitForm()
    {
        $this->estado = 0;

        $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Projecto");

        $this->idproj = $newid[0]->id + 1;

        if ($this->nome == null || $this->tema == null || $this->semestre == null || $this->ano_letivo == null || $this->disciplina == null) {

            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }

        DB::insert("INSERT INTO Projecto (id,estado,nome,tema,ano_letivo,semestre,id_Disciplina) Values (?, ?, ?, ?, ?, ?, ?)",
            [$this->idproj, $this->estado, $this->nome, $this->tema, $this->ano_letivo, $this->semestre, $this->disciplina]);
        return view('livewire.criar-proj');
    }
}
