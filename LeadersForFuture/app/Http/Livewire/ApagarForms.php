<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApagarForms extends ModalComponent
{
    public $idU;

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {
        return view('livewire.apagar-forms');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {
        try {
            $query = DB::table('Formulario')->where('id', '=', $this->idU)->first();

            // Verifies if the form exists
            if ($query == null) {
                $this->emit("openModal", "error1", ["message" => 'O formulário pretendido não existe!']);
                return;
            }

            if ($query->estado == 0) {
                $this->emit("openModal", "error1", ["message" => 'Não é possivel apoagar formulários que não estejam no estado "Bloqueado"!']);
                return;
            } else {
                // deletes the form
                $query = DB::table('Formulario')->where('id', '=', $this->idU)->delete();
            }

            return redirect(url()->previous());


        } catch (\Illuminate\Database\QueryException $ex) {

//            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
    }
}
