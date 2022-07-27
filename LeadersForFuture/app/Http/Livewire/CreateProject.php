<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateProject extends Component
{
    public $name;
    public $theme;
    public $cid;
    public $alunoId;

    public function mount($id)
    {
        $this->alunoId = $id;
    }

    public function render()
    {
        return view('livewire.create-project');
    }

    public function submit()
    {
        if($this->name == "" || $this->theme == "" || $this->cid) {
            $this->emit("openModal", "error1", ["message" => 'Um ou mais campos obrigatórios encontram-se vazios!']);
            return;
        }

        $query = DB::table('Disciplina')
            ->where('cd_discip', $this->cid)
            ->first();

        if (empty($query)) {
            // emit error
            $this->emit("openModal", "error1", ["message" => 'Disciplina não encontrada!']);
            return back();
        } else {
            // calcs current year
            if (now()->month < 8) {
                $date = now()->year - 1;
            } else {
                $date = now()->year;
            }
            DB::update('exec insertProjeto ?,?,?,?,?,?', [$this->name, $this->theme, $this->cid, $date, Auth::user()->numero, $this->alunoId]);

//            $this->emit("openModal", "success", ["message" => 'Projeto criado com sucesso!']);
            if (Auth::user()->id_tipoUtilizador == 1) {
                return redirect('/admin/proj');
            } elseif (Auth::user()->id_tipoUtilizador == 3) {
                return redirect('/prof/proj');
            }
        }
    }
}
