<?php

namespace App\Http\Livewire;

use Exception;
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
            DB::table('Formulario')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Utilizador_Projecto')->where('id_projecto', '=', $this->idU)->delete();
            DB::table('Projecto')->where('id', '=', $this->idU)->delete();

            return redirect('/admin/proj');

        } catch (\Illuminate\Database\QueryException $ex) {

//            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $this->closeModal();
    }
}
