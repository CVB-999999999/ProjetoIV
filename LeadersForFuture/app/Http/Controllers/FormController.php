<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

//use PDF;

class FormController extends Controller
{
    // -----------------------------------------------------------------------------------------------------------------
    // --- FormSelection
    // --- --- Gets the necessary data and return the view to enable the student to select a form
    // -----------------------------------------------------------------------------------------------------------------
    public function formSelection()
    {
        return view('forms.form-selection');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Form
    // --- --- Return the view for the form
    // -----------------------------------------------------------------------------------------------------------------
    public function form($id)
    {

        return view('forms.form-page', ['id' => $id]);
    }

    public function addPerguntas($id)
    {
        return view('forms.addPerguntas', ['idform' => $id]);
    }

    public function generatePDF($id)
    {
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

        if (/*empty($perguntas) || empty($respostas) || empty($dadosUsers) || */ empty($dadosForm) || empty($dadosCurso)) {
            return back();
        }

        $pdf = PDF::loadView('layouts.pdf', [
            'perguntas' => $perguntas,
            'respostas' => $respostas,
            'dadosUsers' => $dadosUsers,
            'dadosForms' => $dadosForm,
            'dadosCurso' => $dadosCurso
        ]);

        return $pdf->download('LFF-' . md5($id) . '.pdf');

//        return $pdf->download('invoice.pdf');

//        PDF::SetTitle('LFF-' . $id);

//        PDF::AddPage();
//        PDF::writeHTML($html, true, false, true, false, '');

//        PDF::Output(public_path($filename), 'F');

//        return response()->download(public_path($filename));
    }

    public function formActivate($id)
    {

        DB::update("exec alterarEstadoForm ?, ?", ['1', $id]);

        return back();
    }
}
