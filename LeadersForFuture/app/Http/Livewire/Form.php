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

        $this->dadosUsers = DB::select("exec buscaAlunosForms ?", [$this->formID]);

        $this->dadosForm = DB::select("exec buscaDadosFormProj ?", [$this->formID]);

        $this->dadosCurso = DB::select("exec buscaCursoForm ?", [$this->formID]);

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

        sleep(10);
        ddd('Stop Right There');

//      Student Submission
        if (Session::get('tipo') == 2) {

            // Verify if user owns the form
            // Gets all forms that the user owns and compares with current forms id
            $dadosF = DB::select("exec buscaFormsDados ?", [Session::get('user')]);

            foreach ($dadosF as $dados) {
                if ($this->formID == $dados->id) {

                    $allowed = true;
                    ddd("You shall not pass");
                    // TODO -> Modificar os sps para verificar se já existem as respostas guardas
                    // provavelmete usar o sp de guardar para guardar e manter o sps de alterar o estado
                    // e apagar os sps de inserir respostas

                    // Updates DB with the answers
                    foreach ($this->perguntas as $index => $pergunta) {
                        if ((($index + 1) < count($this->perguntas))) {
                            DB::update("exec insertResposta2 ?, ?, ?", [$this->respostas[$index], trim($pergunta['id']), $this->formID]);
                        } else {
                            DB::update("exec insertResposta2 ?, ?, ?", [' ', trim($pergunta['id']), $this->formID]);
                        }
                    }
                    // Updates form status
                    DB::update("exec alterarEstadoForm ?, ?", ['2', $this->formID]);

                    break;
                }
            }
//        Teacher Submission
        } elseif (Session::get('tipo') == 1) {

            $allowed = true;

            ddd("Not finished");

            // Insert Observation
            // Form ID | Teacher ID | Observation Content | Aproved
            DB::update("exec insertObservacao ?, ?, ?, ?", [$this->formID, Session::get('numero'), "jndfkjsdnffs jkfsfsdkjnsnf", 1]);
        }


//        sleep(1);

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
        ddd($this->respostas[$index]);
//        TODO -> guardar o campo na BD (atualizar, se não existir a resposta criar)
    }

    public function teste()
    {
        ddd("teste123");
    }
}
