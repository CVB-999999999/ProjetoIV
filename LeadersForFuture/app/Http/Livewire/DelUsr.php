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
                $obs = DB::table('Observacao')
                    ->where('idProf', '=', $this->idU)
                    ->get();

                foreach ($obs as $o) {
                    DB::table('ObservacaoFormulario')
                        ->where('idObservacao', '=', $o->idObservacao)
                        ->delete();
                }

                DB::table('Observacao')
                    ->where('idProf', '=', $this->idU)
                    ->delete();

                DB::DELETE("DELETE FROM Utilizador_Projecto WHERE numero_utilizador = ?", [$this->idU]);
                DB::DELETE("DELETE FROM Utilizador WHERE numero = ?", [$this->idU]);

                return redirect('/');
            }
        } catch (\Illuminate\Database\QueryException $ex) {

//            ddd($ex);
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }
    }
}

