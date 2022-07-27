<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApagarUserproj extends ModalComponent
{
    public $idU;
    public function mount($id)
    {
        $this->idU = $id;
    }
    public function render()
    {
        return view('livewire.apagar-userproj');
    }
    public function func()
    {
        try {
            
            DB::DELETE("DELETE FROM Utilizador_Projecto WHERE numero_utilizador = ?", [$this->idU]);
            DB::DELETE("DELETE FROM Utilizador WHERE numero = ?", [$this->idU]);
            return redirect(url()->previous());

        } catch (\Illuminate\Database\QueryException $ex) {

//            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $this->closeModal();
    }
}
