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
        $filename = 'hello_world.pdf';
    	$html = '<h1 style="color:red;">Hello World</h1>';
        
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }
}
