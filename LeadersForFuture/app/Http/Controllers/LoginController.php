<?php

namespace App\Http\Controllers;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class LoginController extends Component
{
    public $username;
    public $password;
    public $verifier = true;
    public $user;

    public function loginLoad() {
        return view('sessions.login');
    }

    public function login()
    {
        $this->user = DB::select("exec buscaUser_numero_pw ?, ?",[$this->username, $this->password]);

        if(empty($this->user)){
            $this -> verifier = false;
        }else{

            $name = $this->user[0]->nome . $this->user[0]->apelido;

            Session::put('user', $this->username);
            Session::put('name', $name);
            Session::put('tipo', $this->user[0]->tipo);

            return redirect()->to('/menu');
        }
    }
}
