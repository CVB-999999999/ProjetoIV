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
    try{
        $user = DB::selectOne("exec buscaUtiliz ?", [$this->mNumber]);
    }catch(\Illuminate\Database\QueryException $ex){
        $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
        return;
    }

        if ($user == null) {
            return view('livewire.error1', ['message' => 'Utilizador não encontrado']);
        }

//        ddd($user);

        $this->firstN = $user->nome;
        $this->lastN = $user->apelido;
        $this->emailA = $user->email;
//        $this->typeA = $user;
//        $this->nif = $user->nif;
//        $this->pass = $user->password;

        return view('livewire.user-edit');
    }

    public function submitForm()
    {
    try{
        DB::update('UPDATE Utilizador SET password = ? WHERE numero = ?', [$this->pass, $this->mNumber]);
    }catch(\Illuminate\Database\QueryException $ex){
        $this->emit("openModal", "error1", ["message" => 'Ocorreu um erro!']);
        return;
    }

        $this->emit("openModal", "success", ["message" => 'A password do utilizador foi alterada com sucesso!']);
    }

    public function del() {
        $this->emit("openModal", "del-usr", ["id" => $this->mNumber]);
    }
}
