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
            DB::insert("INSERT INTO Utilizador_Projecto (id_projecto,numero_utilizador) Values (?, ?)",
            [$this->projeto, $this->user]);
              // Closures include ->first(), ->get(), ->pluck(), etc.
          } catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
            // Note any method of class PDOException can be called on $ex.
          }
        
        return view('livewire.add-toproj');
    }
}
