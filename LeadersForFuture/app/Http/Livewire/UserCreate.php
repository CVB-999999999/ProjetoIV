<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use function Livewire\str;

class UserCreate extends Component
{
    public $firstN;
    public $lastN;
    public $emailA;
    public $typeA;
//    public $nif;
    public $mNumber;

    public function render()
    {
        return view('livewire.user-create');
    }

    public function submitForm()
    {
        try{
            $user = DB::selectOne("exec buscaUtiliz ?", [$this->mNumber]);
        }catch(\Illuminate\Database\QueryException $ex){
            $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
            return;
        }

        if ((!empty($user) || !$user == null) || ($this->typeA == null)) {
            $this->emit("openModal", "error1", ["message" => 'Utilizador já existe']);
            return back();
        } else {
            $username = explode("@", $this->emailA);
            try{
                DB::insert("INSERT INTO Utilizador (numero, password, nome, apelido, id_tipoUtilizador, email, username) Values (?, ?, ?, ?, ?, ?, ?, ?)",
                    [$this->mNumber, md5($this->emailA), $this->firstN, $this->lastN, $this->typeA, $this->emailA, $username[0]]);
            }catch(\Illuminate\Database\QueryException $ex){
                $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
                return;
            }

            switch ($this->typeA) {
                case 1:
                    $tipo = "Professor";
                    break;
                case 2:
                    $tipo = "Aluno";
                    break;
                case 3:
                    $tipo = "Administrador";
                    break;
                default:
                    $tipo = "Desconhecido";
                    break;
            }

            $this->emit("openModal", "success", ["message" => 'Utilizador do tipo ' . $tipo . ' e com o email ' . $this->emailA . ' foi criado com sucesso!']);

            $this->firstN = "";
            $this->lastN = "";
            $this->emailA = "";
            $this->typeA = "";
            $this->nif = "";
            $this->mNumber = "";
//            return redirect("admin/users/" . $this->mNumber);
        }
    }
}
