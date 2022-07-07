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
    public $nif;
    public $mNumber;

    public function render()
    {
        return view('livewire.user-create');
    }

    public function submitForm()
    {
        $user = DB::selectOne("exec buscaUtiliz ?", [$this->mNumber]);

        if ((!empty($user) || !$user == null) || ($this->typeA == null)) {
            $this->emit("openModal", "error1", ["message" => 'Utilizador já existe']);
            return back();
        } else {
            $username = explode("@", $this->emailA);

            DB::insert("INSERT INTO Utilizador (numero, password, nome, apelido, nif, id_tipoUtilizador, email, username) Values (?, ?, ?, ?, ?, ?, ?, ?)",
                [$this->mNumber, md5($this->emailA), $this->firstN, $this->lastN, $this->nif, $this->typeA, $this->emailA, $username[0]]);

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
