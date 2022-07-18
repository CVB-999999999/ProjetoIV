<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use function Livewire\str;

class PasswdReset extends Component
{

    public $passO;
    public $pass;
    public $passC;

    public function render()
    {
        return view('livewire.passwd-reset');
    }

    public function submitForm()
    {
        // Verify if password is not empty
        if ($this->pass == null || $this->passC == null) {
            $this->emit("openModal", "error1", ["message" => 'A password é um campo obrigatorio!']);
            return;
        }

        // Verify if old password is correct
        if ($this->passO != null) {
            try{
                $query = DB::selectOne('SELECT numero FROM Utilizador WHERE numero = ? AND password = ?', [Auth::user()->numero, $this->passO]);
            }catch(\Illuminate\Database\QueryException $ex){ 
                $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                return;
            }
        } else {
            $this->emit("openModal", "error1", ["message" => 'A password antiga é um campo obrigatorio!']);
            return;
        }

        // Update password
        if (!empty($query)) {
            if ($this->pass == $this->passC) {
                try{
                    DB::update('UPDATE Utilizador SET password = cast(? as varchar) WHERE numero = cast(? as varchar)', [$this->pass, Auth::user()->numero]);
                }catch(\Illuminate\Database\QueryException $ex){ 
                    $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                    return;
                }
                $this->emit("openModal", "success", ["message" => 'A password do utilizador foi alterada com sucesso!']);
            } else {
                $this->emit("openModal", "error1", ["message" => 'As passwords novas não coincidem!']);
            }
        } else {
            $this->emit("openModal", "error1", ["message" => 'A password está incorreta!']);
        }
        return;
    }
}
