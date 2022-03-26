<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;

class Form1 extends Component
{
    public $perguntas;
    public $respostas=[];
    
    public function mount()
    {
        

    }
    
    
       
    public function render()
    {
        $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [1]);
        foreach($this->perguntas as $index){
            $this->respostas[] = $index;
        }

        return view('livewire.form1');
    }

    
}
