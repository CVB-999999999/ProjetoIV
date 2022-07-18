<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class AddToproj extends Component
{
    public $projetos = [];
    public $users = [];
    public $user;
    public $projeto;

    public function render(){
        $this->projetos = DB::select("SELECT * FROM Projecto");
        $this->users = DB::select("SELECT * FROM Utilizador");
        return view('livewire.add-toproj');
    }
    public function submitForm()
    {
        

        if ($this->user== null || $this->projeto == null ) {

            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }
        try {
            $isThere = DB::select('SELECT * FROM Utilizador_Projecto WHERE  id_projecto = ? AND numero_utilizador = ?',[$this->projeto, $this->user]);
            if($isThere == null){
                DB::insert("INSERT INTO Utilizador_Projecto (id_projecto,numero_utilizador) Values (?, ?)",
            [$this->projeto, $this->user]);
            }
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
        $this->emit("openModal", "success", ["message" => 'Projeto Adicionado com sucesso!']);
    }
}
