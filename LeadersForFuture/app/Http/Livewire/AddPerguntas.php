<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;

class AddPerguntas extends Component
{
    public $pergunta;
    public $idform;
    public $idcol = 1235678;
    public function render()
    {
        return view('livewire.add-perguntas');
    }
    public function submitForm()
    {
        //dd($this->pergunta);
        $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Pergunta;");
        $new = $newid[0]->id + 1;
        DB::insert("INSERT INTO Pergunta (id,Pergunta) Values (?, ?)",
            [$new, $this->pergunta]);
        
            DB::insert("INSERT INTO PerguntasFormulario (id_formulario, id_pergunta) Values (?, ?)",
            [$this->idform,$new]);
        return redirect("form/{{$this->idform}}");
    }
}
