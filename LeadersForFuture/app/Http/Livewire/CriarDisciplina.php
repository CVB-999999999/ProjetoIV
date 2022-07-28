<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class CriarDisciplina extends Component
{
    public $nome;
    public $cod;
    public $sigla;

    public function render()
    {
       
        return view('livewire.criar-disciplina');
    }

    public function submitForm()
    {
        $ativo = 'S';
        if (!is_numeric($this->cod)) {
            $this->emit("openModal", "error1", ["message" => 'O codigo não está no formato correto! Deveria ser um número']);
            return;
        }

       
        if ($this->cod == null || $this->nome == null || $this->sigla == null) {

            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
        }
        try {
            DB::insert("INSERT INTO Disciplina (cd_discip, ds_discip, sigla, ativo) Values (?, ?, ?, ?)",
                [$this->cod, $this->nome, $this->sigla, $ativo]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Os dados que introduziu são inválidos!']);
            return;
            // Note any method of class PDOException can be called on $ex.
        }

            return redirect('/admin/disc');
    }
}
