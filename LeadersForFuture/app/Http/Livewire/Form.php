<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Form extends Component
{
    /*public $form;
    public $disciplinas;*/
    public $perguntas;
    public $respostas = [];
    public $formID;
    public $estado;

    function mount($id)
    {
        $this->formID = $id;
    }

    public function render()
    {
        // Verifies the state of the form
        $this->estado = DB::select("exec buscaEstado ?", [$this->formID]);

        // Impossible to answer the form or form ready to answer
        if ($this->estado[0]->estado == 0 || $this->estado[0]->estado == '1') {
            $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [$this->formID]);
            // Student answered or teacher responded
        } else {
            $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [$this->formID]);
            $this->respostas = DB::select("exec buscaRespostasCondForm ?", [$this->formID]);
        }

        return view('livewire.form', [
            'name' => "nome",
            'number' => "123",
            'email' => "mail",
            'course' => "mail",
            'year' => "mail",
            'schoolYear' => "mail",
            'task' => "mail"
        ]);
    }

    public function submit()
    {
        foreach ($this->perguntas as $index => $pergunta) {


            if ((($index + 1) < count($this->perguntas))) {
                DB::update("exec insertResposta2 ?, ?, ?", [$this->respostas[$index], trim($pergunta['id']), $this->formID]);
            } else {

                DB::update("exec insertResposta2 ?, ?, ?", [' ', trim($pergunta['id']), $this->formID]);
            }


        }
        $tipo = Session::get('tipo');

        if ($tipo == 2) {

            DB::update("exec alterarEstadoForm ?, ?", ['2', $this->formID]);

        } elseif ($tipo == 1) {
            DB::update("exec alterarEstadoForm ?, ?", ['3', $this->formID]);

        }

        return redirect()->to('/menu');

    }


}
