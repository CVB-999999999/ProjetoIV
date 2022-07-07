<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserEdit extends Component
{
    public $firstN;
    public $lastN;
    public $emailA;
    public $typeA;
    public $nif;
    public $mNumber;
    public $pass;


    public function mount($id) {
        $this->mNumber = $id;
    }

    public function render()
    {
        $user = DB::selectOne("exec buscaUtiliz ?", [$this->mNumber]);

        if ($user == null) {
            return view('livewire.error1', ['message' => 'Utilizador não encontrado']);
        }

//        ddd($user);

        $this->firstN = $user->nome;
        $this->lastN = $user->apelido;
        $this->emailA = $user->email;
//        $this->typeA = $user;
        $this->nif = $user->nif;
//        $this->pass = $user->password;

        return view('livewire.user-edit');
    }

    public function submitForm()
    {
        DB::update('UPDATE Utilizador SET password = ? WHERE numero = ?', [$this->pass, $this->mNumber]);

        $this->emit("openModal", "success", ["message" => 'A password do utilizador foi alterada com sucesso!']);
    }
}
