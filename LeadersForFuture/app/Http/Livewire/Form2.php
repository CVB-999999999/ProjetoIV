<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use PDF;

class Form2 extends Component
{
    public $perguntas;

    public function index(){

        $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [1]);

       
        $perguntas = DB::select("exec buscaPerguntasCondForm ?", [1]);
       

        // share data to view
        $pdf = PDF::loadView('livewire.form2', compact('perguntas'));
        
        //dd($pdf);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
        
    }
    public function render()
    {
        return view('livewire.form2');
    }
}
