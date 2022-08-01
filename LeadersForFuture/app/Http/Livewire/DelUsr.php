<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DelUsr extends ModalComponent
{

    public $idU;

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {
        return view('livewire.del-usr');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {

        try {
            $q = DB::select('exec buscaProjProf ?', [$this->idU]);

            if (!empty($q)) {
                //$this->emit("openModal", "error1", ["message" => 'Não é possivel eliminar este utilizador. Visto que este está inscrito em projetos']);
                $this->emit("openModal", "apagar-userproj", ['id' => $this->idU]);
            } else {
                \App\Models\User::destroy($this->idU);

                return redirect('/admin/users');
            }
        } catch (\Illuminate\Database\QueryException $ex) {

            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
    }
}

