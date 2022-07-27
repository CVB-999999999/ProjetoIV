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

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {
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
            $query = DB::table('Formulario')->where('id_projecto', '=', $this->idU)->get();

            // Verifyt if any form in the project is active
            foreach ($query as $q) {
                if ($q->estado != 0) {
                    $this->emit("openModal", "error1", ["message" => 'Não é possivel apagar projetos em que os seus formulários não se encontrem no estado Bloqueado!']);
                    return;
                }
            }

            // Delete rows in question "link" table
            foreach ($query as $q) {
                DB::table('PerguntasFormulario')->where('id_formulario', '=', $q->id)->delete();
            }

            // deletes the rows
            DB::table('Formulario')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Utilizador_Projecto')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Projecto')->where('id', '=', $this->idU)->delete();

            return redirect(url()->previous());

        } catch (\Illuminate\Database\QueryException $ex) {

//            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $this->closeModal();
    }
}
