<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;

class AddPerguntas extends Component
{
    public $pergunta;
    public $idform;

    public function render()
    {
        return view('livewire.add-perguntas');
    }

    public function submitForm()
    {

        if ($this->pergunta == "") {
            $this->emit("openModal", "error1", ["message" => 'Pergunta é um campo obrigatório!']);
            return;
        }
        try{
            $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Pergunta;");
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $new = $newid[0]->id + 1;
        try{
        DB::insert("INSERT INTO Pergunta (id,Pergunta) Values (?, ?)",
            [$new, $this->pergunta]);

        DB::insert("INSERT INTO PerguntasFormulario (id_formulario, id_pergunta) Values (?, ?)",
            [$this->idform, $new]);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $idred = trim($this->idform);

        return redirect("form/$idred");
    }
}
