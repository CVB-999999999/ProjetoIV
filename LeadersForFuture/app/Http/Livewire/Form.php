<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Form extends Component
{
    // Data to be access in the livewire form
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
    public $sure = false;

    function mount($id)
    {
        $this->formID = $id;

        // To make life easy in the form
        if (Auth::user()->id_tipoUtilizador == 2) {
            $this->aluno = true;
        } elseif (Auth::user()->id_tipoUtilizador == 1) {
            $this->prof = true;
        }
    }

    public function render()
    {
        try {
            // Verifies the state of the form
            $this->estado = DB::select("exec buscaEstado ?", [$this->formID]);
            // Get the questions
            $this->perguntas = DB::select("exec buscaPerguntasCondForm ?", [$this->formID]);
            // Get the answers (if any)
            $respostas = DB::select("exec buscaRespostasForm ?", [$this->formID]);
            // Gets user data
            $this->dadosUsers = DB::select("exec buscaAlunosForms1 ?", [$this->formID]);
            // Gets project data
            $this->dadosForm = DB::select("exec buscaDadosFormProj1 ?", [$this->formID]);
            // Gets course data
            $this->dadosCurso = DB::select("exec buscaCursoForm1 ?", [$this->formID]);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        array_multisort($this->perguntas, $respostas);
//        array_multisort($this->perguntas);
//        ddd($respostas);

        // Section to verify if user has permission to access the form
        $found = false;

        if (Auth::user()->id_tipoUtilizador == 3) {
            $found = true;
        }

        foreach ($this->dadosUsers as $d) {
            if ($d->numero == Auth::user()->numero) {
                $found = true;
                break;
            }
        }

        // User does not have permission to access the form
        if (!$found) {
            return view('livewire.no-permission');
        }

        // Reformats the Respostas array
        foreach ($respostas as $resposta) {
            array_push($this->respostas, $resposta->Resposta);
        }

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

//      Student Submission
        if (Auth::user()->id_tipoUtilizador == 2) {

            // Verify if user owns the form
            // Gets all forms that the user owns and compares with current forms id
            try {
                $dadosF = DB::select("exec buscaFormsDados ?", [Auth::user()->username]);
            } catch (\Illuminate\Database\QueryException $ex) {
                $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                return;
            }

            foreach ($dadosF as $dados) {
                if ($this->formID == $dados->id) {

                    $allowed = true;

                    // Verify if a field is empty
                    // Only runs the first time the page loads
                    $mpt = false;
                    if (!$this->sure) {
                        foreach ($this->perguntas as $index => $r) {
                            if ($this->respostas[$index] == "" || empty($this->respostas[$index])) {
                                $mpt = true;
                            }
                        }
                    }
                    // Sends the warning only once
                    // Emits the warning
                    if ($mpt && !$this->sure) {
                        $this->emit("openModal", "warn", [
                            "message" => 'Existe pelo menos um campo vazio no formulário! Na próxima vez que tentar submeter o formulário este aviso não irá aparecer.'
                        ]);

                        $this->sure = true;
                        return;
                    }

                    // Updates DB with the answers
                    foreach ($this->perguntas as $index => $pergunta) {
                        DB::update("exec saveResposta ?, ?, ?", [
                            $this->formID,
                            trim($this->respostas[$index]),
                            trim($this->perguntas[$index]['id'])
                        ]);
                    }
//                    $this->emit("openModal", "error1", ["message" => 'Descomentar o SP para alterar o estado e enviar o email']);
                    // Updates form status
                    DB::update("exec alterarEstadoForm ?, ?", ['2', $this->formID]);

                    $this->emit("openModal", "success", ["message" => 'Formulário submetido com sucesso!']);

                    break;
                }
            }
//        Teacher Submission
        } elseif (Auth::user()->id_tipoUtilizador == 1) {

            $allowed = true;

            if (trim($this->obs) == null) {
                // None selected
                $this->emit("openModal", "error1", ["message" => 'O campo "Observação" é um campo obrigatorio!']);
                return;
            }

            // Form status selection
            if ($this->apr == null || $this->obs == null) {
                // None selected
                $this->emit("openModal", "error1", ["message" => 'O campo "Estado do Formulário" é um campo obrigatorio!']);
                return;
                // Approved
            } elseif ($this->apr == 'true') {
                $state = 1;
                // Not approved
            } else {
                $state = 0;
            }

            // Insert Observation
            // Form ID | Teacher ID | Observation Content | Approved
            DB::update("exec insertObservacao ?, ?, ?, ?", [$this->formID, Auth::user()->numero, $this->obs, $state]);

//            $this->emit("openModal", "error1", ["message" => 'Descomentar o SP para alterar o estado e enviar o email']);

            // Form Approved
            if ($this->apr == 'true') {
                DB::update("exec alterarEstadoForm ?, ?", ['3', $this->formID]);
                // Form Not Approved
            } else {
                DB::update("exec alterarEstadoForm ?, ?", ['1', $this->formID]);
            }

            $this->emit("openModal", "success", ["message" => 'Observação submetida com sucesso!']);
        }

        // No permissions
        if (!$allowed) {
            $error = "O utilizador não tem permissões para alterar este formulário";

            $this->emit("openModal", "error1", ["message" => $error]);
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
        // Verify if its a student tring to save
        if (Auth::user()->id_tipoUtilizador == 2) {
            // Save the answer
            DB::update("exec saveResposta ?, ?, ?", [
                $this->formID,
                trim($this->respostas[$index]),
                trim($this->perguntas[$index]['id'])
            ]);
            // Open Success Popup
            $this->emit("openModal", "success", [
                "message" => 'A resposta ao campo número ' . $index + 1 . ' foi guardada com sucesso!'
            ]);
        } else {
            // Open Error Popup
            $this->emit("openModal", "error1", [
                "message" => "O utilizador não tem permissões para efetuar alterações"
            ]);
        }
    }
}
