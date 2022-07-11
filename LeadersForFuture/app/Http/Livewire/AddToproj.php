<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


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

        DB::insert("INSERT INTO Utilizador_Projecto (id_projecto,numero_utilizador) Values (?, ?)",
            [$this->projeto, $this->user]);
        return view('livewire.add-toproj');
    }
}
