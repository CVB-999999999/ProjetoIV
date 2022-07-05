<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class FormController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // --- FormSelection
    // --- --- Gets the necessary data and return the view to enable the student to select a form
    // -----------------------------------------------------------------------------------------------------------------
    public function formSelection() {
        $id = Auth::user()->numero;

        // Gets the data to fill the form selection page
        $forms = DB::select("exec buscaTodosDadosForms ?", [$id]);

        return view('forms.form-selection', ['forms' => $forms]);
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Form
    // --- --- Return the view for the form
    // -----------------------------------------------------------------------------------------------------------------
    public function form($id) {

        return view('forms.form-page', ['id'=>$id]);
    }
    public function generatePDF()
    {
        $id = 1;
        // Get the questions
        $perguntas = DB::select("exec buscaPerguntasCondForm ?", [$id]);
        // Get the answers (if any)
        $respostas = DB::select("exec buscaRespostasForm ?", [$id]);
        // Gets user data
        $dadosUsers = DB::select("exec buscaAlunosForms1 ?", [$id]);
        // Gets project data
        $dadosForm = DB::select("exec buscaDadosFormProj1 ?", [$id]);
        // Gets course data
        $dadosCurso = DB::select("exec buscaCursoForm1 ?", [$id]);
        //ddd($respostas[0]->Resposta);
        //ddd($perguntas[0]);
        
        $filename = 'lff.pdf';
        $html = null;
        foreach ($perguntas as $index => $pergunta){
            $html = $html . '<h1>'.$pergunta->pergunta.'</h1>';
            $html = $html . $respostas[$index]->Resposta;
        }
        PDF::SetTitle('Hello World');

        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }
}
