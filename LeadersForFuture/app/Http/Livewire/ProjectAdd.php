<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProjectAdd extends Component
{
    public $projId;
    public $query;
    public $alunoId;

    public function mount($id)
    {
        $this->alunoId = $id;
    }

    public function render()
    {
        try{
            $this->query = DB::select("exec buscaProjProf ?", [Auth::user()->numero]);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
//        ddd($this->query);

        return view('livewire.project-add');
    }

    public function submit()
    {
        if ($this->projId == null) {
            $this->emit("openModal", "error1", ["message" => 'Projeto selecionado inválido!']);
            return;
        }
        try {
            $isThere = DB::select('SELECT * FROM Utilizador_Projecto WHERE  id_projecto = ? AND numero_utilizador = ?',[$this->projId, $this->alunoId]);
            if($isThere == null){
                DB::insert('INSERT INTO Utilizador_Projecto(id_projecto, numero_utilizador) VALUES (?,?)', [$this->projId, $this->alunoId]);
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
        $this->emit("openModal", "success", ["message" => 'Projeto Adicionado com sucesso!']);
    }
}
