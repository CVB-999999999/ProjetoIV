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
    public $dadosUsers = [];
    public $dadosForm = [];
    public $dadosCurso = [];
    public $obs;
    public $apr;
    public $prof = false;
    public $aluno = false;

    function mount($id)
    {
        $this->formID = $id;

        if (Session::get('tipo') == 2) {
            $this->aluno = true;
        } elseif (Session::get('tipo') == 1) {
            $this->prof = true;
        }
    }

    public function render()
    {
        // Verifies the state of the form
        $this->estado = DB::select("exec buscaEstado ?", [$this->formID]);
        // Get the questions
        $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [$this->formID]);
        // Get the answers (if any)
        $respostas = DB::select("exec buscaRespostasForm ?", [$this->formID]);
        // Gets user data
        $this->dadosUsers = DB::select("exec buscaAlunosForms ?", [$this->formID]);
        // Gets project data
        $this->dadosForm = DB::select("exec buscaDadosFormProj ?", [$this->formID]);
        // Gets course data
        $this->dadosCurso = DB::select("exec buscaCursoForm ?", [$this->formID]);

        foreach ($respostas as $resposta) {
            array_push($this->respostas, $resposta->Resposta);
        }

//        ddd($this->respostas);

        // Creates the page with Student info
        return view('livewire.form');
    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Submition Funtion
    // -----------------------------------------------------------------------------------------------------------------
    // --- Inserts forms data in DB
    // --- Only works if form status = 1 or 2
    // -----------------------------------------------------------------------------------------------------------------
    public function submitForm()
    {
        $allowed = false;

//        sleep(10);
//        ddd('Stop Right There');

//      Student Submission
        if (Session::get('tipo') == 2) {

            // Verify if user owns the form
            // Gets all forms that the user owns and compares with current forms id
            $dadosF = DB::select("exec buscaFormsDados ?", [Session::get('user')]);

            foreach ($dadosF as $dados) {
                if ($this->formID == $dados->id) {

                    $allowed = true;

                    // Updates DB with the answers
                    foreach ($this->perguntas as $index => $pergunta) {
                        DB::update("exec saveResposta ?, ?, ?", [
                            $this->formID,
                            trim($this->respostas[$index]),
                            trim($this->perguntas[$index]['id'])
                        ]);
                    }
                    ddd("Descomentar o SP para alterar o estado e enviar o email");
                    // Updates form status
//                    DB::update("exec alterarEstadoForm ?, ?", ['2', $this->formID]);

                    break;
                }
            }
//        Teacher Submission
        } elseif (Session::get('tipo') == 1) {

            $allowed = true;
            $state = 0;

            if ($this->apr == null) {
                // TODO -> pop
                ddd('Colocar aqui um pop');
                return;
            } elseif ($this->apr == 'true') {
                $state = 1;
            } else {
                $state = 0;
            }

            // Insert Observation
            // Form ID | Teacher ID | Observation Content | Approved
            DB::update("exec insertObservacao ?, ?, ?, ?", [$this->formID, Session::get('numero'), $this->obs, $state]);

            ddd("Descomentar o SP para alterar o estado e enviar o email" . $state);
/*
            // Form Approved
            if ($this->apr == 'true') {
                DB::update("exec alterarEstadoForm ?, ?", ['3', $this->formID]);
                // Form Not Approved
            } else {
                DB::update("exec alterarEstadoForm ?, ?", ['2', $this->formID]);
            }*/
        }

        if (!$allowed) {
            $error = "O utilizador não tem permissões para alterar este formulário";
//            $this->dispatchBrowserEvent('noPermission', ['error' => $error]);
            ddd('Não tem permissões');
        }

    }

    // -----------------------------------------------------------------------------------------------------------------
    // --- Save Funtion
    // -----------------------------------------------------------------------------------------------------------------
    // --- Updates a field
    // --- Only works if form status == 1 && tipo == student
    // -----------------------------------------------------------------------------------------------------------------
    public function save($index)
    {
//        ddd(trim($this->perguntas[$index]['id']));
//        ddd($this->respostas[$index]);
//        ddd($this->formID);

        if (Session::get('tipo') == 2) {

            DB::update("exec saveResposta ?, ?, ?", [
                $this->formID,
                trim($this->respostas[$index]),
                trim($this->perguntas[$index]['id'])
            ]);
        }
    }
}
