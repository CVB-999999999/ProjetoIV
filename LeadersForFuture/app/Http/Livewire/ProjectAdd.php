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
        $this->query = DB::select("exec buscaProjProf ?", [Auth::user()->numero]);

//        ddd($this->query);

        return view('livewire.project-add');
    }

    public function submit()
    {
        DB::insert('INSERT INTO Utilizador_Projecto(id_projecto, numero_utilizador) VALUES (?,?)', [$this->projId, $this->alunoId]);

        $this->emit("openModal", "success", ["message" => 'Projeto Adicionado com sucesso!']);
    }
}
