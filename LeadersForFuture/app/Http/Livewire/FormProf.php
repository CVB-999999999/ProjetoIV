<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use function Livewire\str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FormProf extends Component
{
    public $projetos = [];
    public $tpForms = [];
    public $projeto;
    public $tpForm;
    public $semestre;
    public $anocurricular;
    public $ano_letivo;
    public $estado = 0;
    public $idform;
    public $profnumber;
   

    public function render()
    {
        // Gets the Tipo_Formulario
        
        $this->profnumber = Auth::user()->numero;
        $this->tpForms = DB::select("exec buscaTipoForm");
        // Gets the projects
        $this->projetos = DB::select("SELECT p.*  From Projecto p, Utilizador_Projecto up WHERE up.numero_utilizador = ? AND up.id_projecto = p.id", [$this->profnumber]);
        return view('livewire.form-criar');
    }
    public function submitForm()
    {
        $newid = DB::select("SELECT id = max(cast(id as integer)) FROM Formulario");
        $this->idform = $newid[0]->id + 1;
        if($this->tpForm == null || $this->projeto == null || $this->semestre == null || $this->anocurricular == null || $this->ano_letivo == null){
            return redirect("admin/erro");
        }
        DB::insert("INSERT INTO Formulario (id,estado,tipo_formulario,id_projecto,ano_letivo,ano_curricular,semestre) Values (?, ?, ?, ?, ?, ?, ?)",
            [$this->idform,$this->estado,$this->tpForm,$this->projeto,$this->ano_letivo,$this->anocurricular,$this->semestre]);
        return redirect("admin/users/");
    }
}
