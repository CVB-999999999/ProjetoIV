<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApagarProjeto extends ModalComponent
{
    public $idU;
    public $query;
    public $aux;

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {

        $this->query = DB::table('Formulario')->where('id_projecto', '=', $this->idU)->get();

        // Verify if any form in the project is active
        foreach ($this->query as $q) {
            if ($q->estado != 0) {
                $this->aux = true;
                break;
            }
        }

        return view('livewire.apagar-projeto');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {
        try {
            // Delete rows in question "link" table
//            ddd($this->query);

            foreach ($this->query as $q) {
                $obs = DB::table('ObservacaoFormulario')->where('idFormulario', '=', trim($q["id"]))->get();
                DB::table('ObservacaoFormulario')->where('idFormulario', '=', trim($q["id"]))->delete();

                foreach ($obs as $o) {
                    DB::table('Observacao')->where('idObservacao', '=', trim($o->idObservacao))->delete();
                }

                $fs = DB::table('PerguntasFormulario')->where('id_formulario', '=', trim($q["id"]))->get();
                DB::table('PerguntasFormulario')->where('id_formulario', '=', trim($q["id"]))->delete();

                foreach ($fs as $f) {
                    DB::table('Resposta')->where('id', '=', trim($f->id_resposta))->delete();
                }
            }

            // deletes the rows
            DB::table('Formulario')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Utilizador_Projecto')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Projecto')->where('id', '=', $this->idU)->delete();

            return redirect(url()->previous());

        } catch (\Illuminate\Database\QueryException $ex) {

            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $this->closeModal();
    }
}
