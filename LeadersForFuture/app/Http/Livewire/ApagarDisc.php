<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApagarDisc extends ModalComponent
{
    public $idU;
    public $query;
    public $aux;

    public function mount($cd_discip)
    {
        $this->idU = $cd_discip;
    }

    public function render()
    {

        return view('livewire.apagar-disc');
    }
    
    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function func()
    {
        try {
            $projs = DB::SELECT("SELECT * FROM Projecto WHERE id_Disciplina = ?",[$this->idU]);
            foreach($projs as $proj){
                $id = $proj->id;
                $this->query = DB::table('Formulario')->where('id_projecto', '=', $id)->get();

                // Verify if any form in the project is active
                foreach ($this->query as $q) {
                    if ($q->estado != 0) {
                        $this->aux = true;
                        break;
                    }
                }
                try {        
                    foreach ($this->query as $q) {
                        //ddd($q);
                        //$obs = DB::table('ObservacaoFormulario')->where('idFormulario', '=', trim($q["id"]))->get();
                        $obs = (DB::table('ObservacaoFormulario')->where('idFormulario', '=', trim($q->id))->get());
                        DB::table('ObservacaoFormulario')->where('idFormulario', '=', trim($q->id))->delete();
        
                        foreach ($obs as $o) {
                            DB::table('Observacao')->where('idObservacao', '=', trim($o->idObservacao))->delete();
                        }
        
                        $fs = DB::table('PerguntasFormulario')->where('id_formulario', '=', trim($q->id))->get();
                        DB::table('PerguntasFormulario')->where('id_formulario', '=', trim($q->id))->delete();
        
                        foreach ($fs as $f) {
                            DB::table('Resposta')->where('id', '=', trim($f->id_resposta))->delete();
                        }
                    }
        
                    // deletes the rows
                    DB::table('Formulario')->where('id_projecto', '=', $id)->delete();
                    DB::table('Utilizador_Projecto')->where('id_projecto', '=', $id)->delete();
                    DB::table('Projecto')->where('id', '=', $id)->delete();

                    DB::DELETE("DELETE FROM cursos_disciplinas Where cd_discip = ?",[$this->idU]);
                    DB::DELETE("DELETE FROM Disciplina Where cd_discip = ?",[$this->idU]);
        
                } catch (\Illuminate\Database\QueryException $ex) {
        
                    $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                    return;
                }
            }
            try{
                DB::DELETE("DELETE FROM cursos_disciplinas Where cd_discip = ?",[$this->idU]);
                DB::DELETE("DELETE FROM Disciplina Where cd_discip = ?",[$this->idU]);
            }catch (\Illuminate\Database\QueryException $ex) {
        
                $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                return;
            }

            return redirect(url()->previous());

        } catch (\Illuminate\Database\QueryException $ex) {

            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        $this->closeModal();
    }
    
}
