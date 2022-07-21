<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DelQuestions extends ModalComponent
{

    public $idU;
    public $query;
    public $apr;

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {
        $this->query = DB::table('PerguntasFormulario')->where('id_formulario', '=', $this->idU)
            ->join('pergunta', 'id', '=', 'PerguntasFormulario.id_pergunta')
            ->get();

        return view('livewire.del-questions');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {
        if ($this->apr == null || intval($this->apr) <= 0) {
            return;
        } else {
            $q = DB::table('PerguntasFormulario')
                ->where('id_pergunta', '=', $this->apr)
                ->where('id_formulario', '=', $this->idU)
                ->delete();

            if( $q < 1) {
                $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro! Não foi possivel apagar a pergunta. Por favor tente de novo mais tarde.']);
            } else {
                $this->emit("openModal", "success", ["message" => 'Pergunta eliminada com sucesso!']);
            }
        }
    }
}

