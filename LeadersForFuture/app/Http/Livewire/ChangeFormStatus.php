<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ChangeFormStatus extends ModalComponent
{
    public $idF;
    public $idP;
    public $estadoA;
    public $apr;

    public function mount($id, $idP)
    {
        $this->idF = $id;
        $this->idP = $idP;
    }

    public function render()
    {
        // Gets current form status
        $this->estadoA = DB::select('exec buscaEstado ?', [$this->idF]);

        foreach ($this->estadoA as $e) {
            return view('livewire.change-form-status');
        }

        $this->emit("openModal", 'error1', ['message' => "Ocorreu um erro"]);

        if (Auth::user()->id_tipoUtilizador == 3) {
            return redirect('/admin/aluno/' . $this->idP);
        } else {
            return redirect('/prof/aluno/' . $this->idP);
        }
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {
        // Verifies if inputted status is valid
        if ($this->apr < 4 && $this->apr > -1) {

            // Only updates DB if status has changed
            if ($this->apr != $this->estadoA[0]) {
                DB::update("exec alterarEstadoForm ?, ?", [$this->apr, trim($this->idF)]);
            }

            // Redirects to correct page
            if (Auth::user()->id_tipoUtilizador == 3) {
                return redirect('/admin/aluno/' . $this->idP);
            } else {
                return redirect('/prof/aluno/' . $this->idP);
            }
        } else {
            $this->emit("openModal", 'error1', ['message' => "O estado do formulário inserido é invalido"]);
        }
    }
}
