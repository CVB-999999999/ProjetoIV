<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Elibyy\TCPDF\Facades\TCPDF;

class Menu extends Component
{
    public $formularios = "";
    
    public $aluno = false;
    public $prof = false;
    public $anoLetivo = 2021;
    public $semestre = 1;
    public $datatable;

    public function mount(){

        if(!Session::has('user')){

            return redirect()->to('/');

        }
        
        
    }
    public function render()
    {

        $utilizador = Session::get('user');
        

        $teste = Session::get('tipo');  

    
        if($teste == 2){

            $this->aluno = true;
            $this -> formularios = DB::select("exec buscaFormulariosAsAluno2 ?, ?, ?", [$utilizador, $this->anoLetivo,  1]);
           
        }elseif($teste == 1){
    
            $this->prof = true;
            DB::update("exec buscaFormulariosAsProfessor2 ?, ?, ?", [$utilizador, $this->anoLetivo,  1]);
            $this -> formularios = DB::select("exec buscaFormulariosAsProfessor");

        }
        return view('livewire.menu');
    }

    

    public function logout(){

        session()->flush();
        
        return redirect()->to('/');

    }
    
    public function geraPDF($id){


        $filename = 'test.pdf';


        $perguntas = DB::select("exec buscaPerguntasRespostasCondForm ?", [$id]);
        
    	$html = \View::make('livewire.pdfgenerator',compact('perguntas'));
        
    
    	$pdf = new TCPDF;
        
        $pdf::SetTitle('TESTE');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }
}
